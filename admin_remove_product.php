<?php

    if (isset($_POST['product_id'])) {

        require_once('connect.php');

        $sth = $pdo->prepare('DELETE FROM products WHERE id=:id');
        $sth->bindParam(':id', $_POST['product_id']);
        $sth->execute();

		header('location: menu.php');
    } else {
        header('Location: menu.php');
    }

?>