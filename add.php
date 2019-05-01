<?php

    if (isset($_POST['product_id'])) {
        session_start();
        $session_id = session_id();
        require_once('connect.php');

        $sth = $pdo->prepare('INSERT INTO orders VALUES (NULL, :session_id, :product_id, :user_id , NOW() , 1)');
        $sth->bindParam(':session_id', $session_id);
        $sth->bindParam(':product_id', $_POST['product_id']);
        $sth->bindParam(':user_id', $_SESSION['id']);
        $sth->execute();

		header('location: menu.php');
    } else {
        header('Location: menu.php');
    }

?>