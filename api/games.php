<?php
$title = 'Our Games';
require 'include/header.php';
?>

<h1>Our Games</h1>
<?php
if (!empty($_SESSION['username'])) {
    echo '<a href="game-details.php">Add a New Game</a>';
}

try {
    require 'include/db.php';

    $sql = "SELECT examgames.*, exampublishers.name FROM examgames 
        INNER JOIN exampublishers ON examgames.publisherId = exampublishers.publisherId";

    $cmd = $db->prepare($sql);
    $cmd->execute();
    $examgames = $cmd->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($examgames);
}
catch (exception $e) {
    header('location:error.php');
}

$db = null;
?>
</body>
</html>
