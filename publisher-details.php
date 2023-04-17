<?php
require('include/auth.php');
$title = 'Publisher Details';
require 'include/header.php'; ?>
<main>
    <form method="post" action="save-publisher.php">
        <fieldset class="p-2">
            <label for="name" class="col-2">Publisher: </label>
            <input name="name" id="name" required maxlength="100"/>
        </fieldset>
        <button class="offset-2 btn btn-primary p-2">Save</button>
    </form>
</main>
</body>
</html>
<?php
    try {
        // get the travelId from the url parameter using $_GET
        $publisherId = $_GET['publisherId'];
        if (empty($pubisherId)) {
            header('location:404.php');
            exit();
        }

        // connect - we can re-use for the 2nd query later
        require('include/db.php');

        // set up & run SQL query to fetch the selected travel plan record.  fetch for 1 record only
        $sql = "SELECT * FROM exampublishers WHERE publisherId = :publisherId";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':publisherId', $publisherId, PDO::PARAM_INT);
        $cmd->execute();
        $exampublisher = $cmd->fetch();

        // check query returned a valid travel plan record
        if (empty($exampublisher)) {
            header('location:404.php');
            exit();
        }

        // access control check: is logged user the owner of this travel plan?
        if (empty( $_SESSION['username'])){
            header('location:403.php'); // 403 = HTTP Forbidden Error
            exit();
        }
    } catch (Exception $error) {
        header('location:error.php');
        exit();
    }
    ?>
    <h1>Edit Publisher</h1>
    <form action="save-publisher.php" method="post" enctype="multipart/form-data">
        <fieldset>
            <label for="name">Name:</label>
        </fieldset>
        
        <button class="btnOffset">Save Publisher</button>
        <input name="publisherId" id="publisherId" value="<?php echo $publisherId; ?>" type="hidden" />
    </form>
</main>
<?php require('shared/footer.php'); ?>