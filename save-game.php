<?php
require 'include/auth.php';
$title = 'Saving Game...';
require 'include/header.php';

$title = $_POST['title'];
$releaseYear = $_POST['releaseYear'];
$rating = $_POST['rating'];
$publisherId = $_POST['publisherId'];
$gameId = $_POST['gameId'];
$ok = true;

if (empty(trim($title))) { 
    echo 'Title is required<br />';
    $ok = false;
}

if (empty($releaseYear)) {
    echo 'Release Year is required<br />';
    $ok = false;
}
else {
    if (!is_numeric($releaseYear)) {
        echo 'Release Year must be numeric<br />';
        $ok = false;
    }
}

if (empty($publisherId)) {
    echo 'Publisher is required<br />';
    $ok = false;
}
else {
    if (!is_numeric($publisherId)) {
        echo 'Publisher Id must be numeric<br />';
        $ok = false;
    }
}

$photo = null;

if ($_FILES['photo']['name'] != null) {
    $photo = $_FILES['photo']['name'];

    $tmp_name = $_FILES['photo']['tmp_name'];

    $type = mime_content_type($tmp_name);
    if ($type != "image/png" && $type != "image/jpeg") {
        echo 'Please upload a .jpg or .png file<br />';
        $ok = false;
    }
    else {
        $photo = session_id() . "-" . $photo;
        move_uploaded_file($tmp_name, "img/game-uploads/$photo");
    }
}
else {
    $photo = $_POST['currentPhoto'];
}

if ($ok == true) {
    try {
        require 'include/db.php';

        if (!empty($gameId)) {
            $sql = "UPDATE examgames SET title = :title, releaseYear = :releaseYear,
                rating = :rating, publisherId = :publisherId,
                 photo = :photo WHERE gameId = :gameId";
        } else {
            $sql = "INSERT INTO examgames (title, releaseYear, rating, publisherId, photo) VALUES 
                    (:title, :releaseYear, :rating, :publisherId, :photo)";
        }

        $cmd = $db->prepare($sql);
        $cmd->bindParam(':title', $title, PDO::PARAM_STR, 50);
        $cmd->bindParam(':releaseYear', $releaseYear, PDO::PARAM_INT);
        $cmd->bindParam(':rating', $rating, PDO::PARAM_STR, 10);
        $cmd->bindParam(':publisherId', $publisherId, PDO::PARAM_INT);
        $cmd->bindParam(':photo', $photo, PDO::PARAM_STR,100);
        if (!empty($gameId)) {
            $cmd->bindParam(':gameId', $gameId, PDO::PARAM_INT);
        }

       $cmd->execute();

        $db = null;

        echo "Game Saved";
        header('location:games.php');
    }
    catch (exception $e) {
        header('location:error.php');
        exit(); 
    }
}
?>
</body>
</html>
