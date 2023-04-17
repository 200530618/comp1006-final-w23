<?php
require('inculde/auth.db');
$title = 'Saving Publisher...';
require 'include/header.php';
$name = $_POST['name'];
$publisherId = $_POST['publisherId'];
$ok = true;

if (empty(trim($name))) { 
    echo 'Name is required<br />';
    $ok = false;
}

if ($ok == true) {
    // save code goes here

    require('include/db.php');

    $sql = "UPDATE exampublishers SET name = :name";

    $cmd = $db->prepare($sql);
    $cmd->bindParam(':name',$name, PDO::PARAM_STR, 50);
    $cmd->bindParam(':publisherId', $publisherId, PDO::PARAM_INT);

    $cmd->execute();

    $db =null;


    


    echo 'Publisher Saved';
    echo '<a href="publishers.php">Publishers</a>';
}

?>
</body>
</html>
