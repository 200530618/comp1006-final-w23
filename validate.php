<?php
$username = $_POST['username'];
$password = $_POST['password'];

require 'include/db.php';
$sql = "SELECT * FROM examusers WHERE username = :username";
$cmd = $db->prepare($sql);
$cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);

$cmd->execute();
$user = $cmd->fetch();

if (!empty($user)) {
    if (password_verify($password, $user['password'])) {
        session_start(); 
        $_SESSION['username'] = $username; 
        header('location:games.php');
        exit();
    }
    else { 
        header('location:login.php?invalid=true');
    }
}
else {
    header('location:login.php?invalid=true');
}

?>