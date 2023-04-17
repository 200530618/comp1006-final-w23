<?php
$title = 'Saving Publisher...';
require 'include/header.php';
$name = $_POST['name'];
$ok = true;

if (empty(trim($name))) { 
    echo 'Name is required<br />';
    $ok = false;
}

if ($ok == true) {
    // save code goes here

    echo 'Publisher Saved';
}

?>
</body>
</html>
