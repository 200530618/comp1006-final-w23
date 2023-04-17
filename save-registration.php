<?php
$title = "Registering...";
require 'include/header.php';

$username = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$ok = true;

if (empty($username)) {
    echo 'Username required<br />';
    $ok = false;
}

if (empty($password)) {
    echo 'Password required<br />';
    $ok = false;
}

if ($password != $confirm) {
    echo 'Passwords must match<br />';
    $ok = false;
}

if ($ok) {
    require 'include/db.php';

    $sql = "SELECT * FROM examusers WHERE username = :username";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd->execute();
    $user = $cmd->fetch();

    if (!empty($user)) {
        echo '<h5 class="alert alert-danger">User already exists</h5>';
        $db = null;
        exit(); 
    }

    $sql = "INSERT INTO examusers (username, password) VALUES (:username, :password)";

    $password = password_hash($password, PASSWORD_DEFAULT);
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd->bindParam(':password', $password, PDO::PARAM_STR, 255);

    $cmd->execute();

    $db = null;

    header('location:login.php');
}

?>

</body>
</html>
