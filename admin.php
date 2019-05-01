<?php

    session_start();
    require_once 'nav.php';

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/my.css">
    <title>Panel Administatora</title>
</head>
<body>


    <?php
        nav('admin');
        require_once 'header.php';
    ?>

    <div class="container">

        <h2 class="text-danger">Panel Administatora</h2>
        <h3 class="mt-4">Zamówienia</h3>
        <div class="ml-2">        
            <a href="admin_orderslist.php">Podgląd zamówień</a><br>
            <a href="admin_shipped.php">Wysłane zamówienia</a><br>
            <a href="admin_history.php">Historia zamówień</a><br>
        </div>
        <h3 class="mt-4">Strona główna</h3>
        <div class="ml-2">
            <a href="admin_new_article.php">Nowy artykuł</a><br>
            <a href="index.php">Usuń artykuł</a><br>
        </div>
        <h3 class="mt-4">Produkty</h3>
        <div class="ml-2">
            <a href="admin_new_product.php">Nowy produkt</a><br>
            <a href="menu.php">Usuń produkt</a><br>
        </div>
        

    </div>
</body>
</html>