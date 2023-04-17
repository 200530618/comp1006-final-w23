<?php
$title = 'Publishers';
require('include/header.php');
?>
<main>
    <h1>Publishers</h1>
    <?php
    if (!empty($_SESSION['username'])) {
        echo '<a href="publisher-details.php">Add a Publisher</a>';
    }
    try {
        // connect to db
        require('include/db.php');

        // set up the SQL SELECT command
        $sql = "SELECT * FROM exampublishers ORDER BY publisherId DESC";

        // if there is a user param in the url, use it as a filter
        if (!empty($_GET['user'])) {
            $sql = "SELECT * FROM exampublishers WHERE user = :user 
                     ORDER BY publisherId DESC";
        }

        // execute the select query
        $cmd = $db->prepare($sql);

        // bind the username param if viewing 1 user's travel plans only
        

        $cmd->execute();

        // store the query results in an array. use fetchAll for multiple records, fetch for 1.
        $exampublishers = $cmd->fetchAll();

        echo '<table>';
        echo '<thead><th>Name</th><th>Edit</th></thead>';
        
        // display travel plan data in a loop. $travels = all data, $travel = the current item in the loop
        foreach ($exampublishers as $exampublisher) {
            echo '<tr>'; //create a new row
        
            echo '<td>' . $exampublisher['name'];
            if (!empty($_SESSION['username'])) {
                echo ' <a href="publisher-details.php?publisherId=' . $exampublisher['publisherId'] . '">Edit</a>';
            }
            echo '</td>';
        
            echo '</tr>';
        }
        
        echo '</table>';
        

        // disconnect
        $db = null;
    } catch (Exception $error) {
        header('location:error.php');
        exit();
    }
    ?>
</main>
