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
    <title>Moje zamówienie</title>
</head>
<body>

    <?php
        nav('orderlist');
        require_once 'header.php';
    ?>


    <div class="container">
<?php

if (isset($_SESSION['login'])) {

    require_once 'connect.php';

    $sth = $pdo->query('SELECT DISTINCT session_id FROM orders WHERE status=2 AND user_id='.$_SESSION['id'].' ORDER BY date DESC');
    $count=$sth->rowCount();

    if ($count > 0) {
        echo '<h2 class="text-danger">Aktualne zamówienia</h2>';

        foreach ($sth->fetchAll() as $value) {
            $tbl=$pdo->query('SELECT products.name, products.details, products.price, categories.name AS category_name FROM orders INNER JOIN products INNER JOIN categories ON orders.product_id=products.id AND categories.id=products.category_id WHERE session_id="'.$value['session_id'].'"');
            echo '<h4 class="text-warning">Zamówienie nr '. $count.'</h4>';
            echo '<h6 class="text-danger">Status zamówienia: W przygotowaniu</h6>';
            $i=1;
            $totalPrice=0;

            echo '<table class="table table-responsive table-striped p-2 mx-1 my-2">';
            echo '<thead class="table-warning"><th scope="col">Nr. poz.</th><th scope="col">Nazwa</th><th scope="col">Szczegóły</th><th scope="col">Cena</th><th scope="col">Kategoria</th></thead>
            <tbody>';
            foreach ($tbl->fetchAll() as $row) {
                echo '<tr>
                <td>'. $i . '</td>
                <td>'. $row['name'] .'</td>
                <td>'. $row['details'] .'</td>
                <td>'. $row['price'] .'</td>
                <td>'. $row['category_name'] .'</td>
                </tr>';
                $i+=1;
                $totalPrice+=$row['price'];
            }
            echo '</tbody></table>';
            echo '<h5>Kwota do zapłaty: '. $totalPrice . ' zł</h5><br><br>';

            $count-=1;
        }
    }

    $sth = $pdo->query('SELECT DISTINCT session_id FROM orders WHERE status=3 AND user_id='.$_SESSION['id'].' ORDER BY date DESC');
    $count=$sth->rowCount();

    if ($count > 0) {
        echo '<h2 class="text-danger">Aktualne zamówienia</h2>';

        foreach ($sth->fetchAll() as $value) {
            $tbl=$pdo->query('SELECT products.name, products.details, products.price, categories.name AS category_name FROM orders INNER JOIN products INNER JOIN categories ON orders.product_id=products.id AND categories.id=products.category_id WHERE session_id="'.$value['session_id'].'"');
            echo '<h4 class="text-warning">Zamówienie nr '. $count.'</h4>';
            echo '<h6 class="text-danger">Status zamówienia: W drodze do klienta</h6>';
            $i=1;
            $totalPrice=0;

            echo '<table class="table table-responsive table-striped p-2 mx-1 my-2">';
            echo '<thead class="table-warning"><th scope="col">Nr. poz.</th><th scope="col">Nazwa</th><th scope="col">Szczegóły</th><th scope="col">Cena</th><th scope="col">Kategoria</th></thead>
            <tbody>';
            foreach ($tbl->fetchAll() as $row) {
                echo '<tr>
                <td>'. $i . '</td>
                <td>'. $row['name'] .'</td>
                <td>'. $row['details'] .'</td>
                <td>'. $row['price'] .'</td>
                <td>'. $row['category_name'] .'</td>
                </tr>';
                $i+=1;
                $totalPrice+=$row['price'];
            }
            echo '</tbody></table>';
            echo '<h5>Kwota do zapłaty: '. $totalPrice . ' zł</h5><br><br>';

            $count-=1;
        }
    }

    $sth2 = $pdo->query('SELECT DISTINCT session_id FROM orders WHERE status=4 AND user_id='.$_SESSION['id'].' ORDER BY date DESC');
    $count2=$sth2->rowCount();

    if ($count2 > 0) {
        echo '<h2 class="text-primary">Zrealizowane zamówienia</h2>';

        foreach ($sth2->fetchAll() as $value) {
            $tbl2=$pdo->query('SELECT products.name, products.details, products.price, categories.name AS category_name FROM orders INNER JOIN products INNER JOIN categories ON orders.product_id=products.id AND categories.id=products.category_id WHERE session_id="'.$value['session_id'].'"');
            echo '<h4 class="text-warning">Zamówienie nr '. $count2.'</h4>';
            $i=1;
            $totalPrice=0;

            echo '<table class="table table-responsive table-striped p-2 mx-1 my-2">';
            echo '<thead class="table-warning"><th scope="col">Nr. poz.</th><th scope="col">Nazwa</th><th scope="col">Szczegóły</th><th scope="col">Cena</th><th scope="col">Kategoria</th></thead>
            <tbody>';
            foreach ($tbl2->fetchAll() as $row2) {
                echo '<tr>
                <td>'. $i . '</td>
                <td>'. $row2['name'] .'</td>
                <td>'. $row2['details'] .'</td>
                <td>'. $row2['price'] .'</td>
                <td>'. $row2['category_name'] .'</td>
                </tr>';
                $i+=1;
                $totalPrice+=$row2['price'];
            }
            echo '</tbody></table>';
            echo '<h5>Zapłacono: '. $totalPrice . ' zł</h5><br><br>';
            $count2-=1;
        }
    }

} else {
    echo '<h5><a href="login_form.php">Zaloguj się</a> by podglądnąć swoje zamówienia.</h5>';
}

?>
    </div>
</body>
</html>