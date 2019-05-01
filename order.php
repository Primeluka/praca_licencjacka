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
    <title>Koszyk</title>
</head>
<body>
    
    <?php
        nav('order');
        require_once 'header.php';
    ?>


    <div class="container">
<?php

require_once 'connect.php';

$session_id = session_id();
$tbl = $pdo->query('SELECT orders.id, orders.user_id, products.name, products.details, products.price, products.id AS product_id, categories.name AS category_name FROM orders LEFT JOIN products ON orders.product_id=products.id LEFT JOIN categories ON products.category_id=categories.id WHERE session_id="' . $session_id . '"');
$count = $tbl->rowCount();

if ($count>0) {
    echo '<h2 class="text-danger mb-4">Koszyk</h2>';
    echo '<table class="table table-responsive table-striped p-2 mx-1 my-2"><thead class="table-warning">
        <th scope="col">Nr. Poz.</thv><th scope="col">Nazwa</th><th scope="col">Szczegóły</th><th scope="col">Cena</th><th scope="col">Kategoria</th><th scope="col">Usuń</th>
        </thead><tbody>';

    $totalPrice=0;
    $i = 1;
    foreach ($tbl->fetchAll() as $value) {
        echo '<tr>' .
            '<td>' . $i . '</td><td>' . $value['name'] . '</td><td>' . $value['details'] . '</td><td>' . $value['price'] . '</td><td>' . $value['category_name'] . '</td>';
        echo "<td>
                    <form action='delete.php' method='post'>
                        <input type='hidden' name='order_id' value=" . $value['id'] . ">
                        <input type='submit' value='usuń'>
                    </form>
                    </td>";
        echo '</tr>';
        $totalPrice+=$value['price'];
        $i++;
    }
    echo '</tbody></table>';
    echo '<h4>Do zapłaty: '. $totalPrice .' zł</h4>';
    
    echo '<br><form method="post"><input type="submit" name="confirm" value="Potwierdź zamówienie" /></form>';
    echo '<br><form method="post"><input type="submit" name="cancel" value="Anuluj zamówienie" /></form>';
    } else {
        echo '<h5>Twój koszyk jest pusty.</h5>';
    }

if (isset($_POST['cancel'])) {
	$session_id = session_id();
	$sth = $pdo->prepare('DELETE FROM orders WHERE session_id=:session_id');
	$sth->bindParam(':session_id', $session_id);
	$sth->execute();
	header('Location: menu.php');
}

if (isset($_POST['confirm'])) {
	$session_id = session_id();
	$sth = $pdo->prepare('UPDATE orders SET status=2 WHERE session_id=:session_id');
	$sth->bindParam(':session_id', $session_id);
	$sth->execute();
	session_regenerate_id();
	header('Location: orderlist.php');
}

?>
    </div>
</body>
</html>