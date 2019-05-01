<?php


    if (isset($_POST['id'])) {

        require_once('connect.php');

        $sth = $pdo->prepare('DELETE FROM articles WHERE id=:id');
        $sth->bindParam(':id', $_POST['id']);
        $sth->execute();

        header('Location: index.php');
    } else {
        header('Location: index.php');
    }

?>