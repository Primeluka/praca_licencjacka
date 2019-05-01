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
        nav('admin');
        require_once 'header.php';
    ?>

    <div class="container">
<?php

require_once 'connect.php';

$session_id = session_id();
$sth = $pdo->query('SELECT DISTINCT session_id FROM orders WHERE status=3 ORDER BY date ASC');
$count=$sth->rowCount();

if ($count > 0) {
    echo '<h2 class="text-danger">Wysłane zamówienia</h2>';

    foreach ($sth->fetchAll() as $value) {
        $tbl=$pdo->query('SELECT products.name, products.details, products.price, categories.name AS category_name FROM orders INNER JOIN products INNER JOIN categories ON orders.product_id=products.id AND categories.id=products.category_id WHERE session_id="'.$value['session_id'].'"');
        echo '<h4 class="text-danger">Zamówienie nr '. $count.'</h4>';
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

        $tbl2=$pdo->query('SELECT users.name, users.surname, adresses.street, adresses.building_no, adresses.flat_no, adresses.post_code, adresses.city, adresses.telephone FROM users INNER JOIN adresses INNER JOIN orders ON users.id=adresses.user_id AND users.id=orders.user_id WHERE session_id="'.$value['session_id'].'"');
        $row2=$tbl2->fetch();
        echo '<h3>Adres dostawy</h3>';
        echo '<div class="ml-2">'.$row2['name'].' '.$row2['surname'].'<br>'.$row2['street'].' '.$row2['building_no'];
        if(strlen($row2['flat_no'])>0){
            echo '/'.$row2['flat_no'];
        }
        echo '<br>'.$row2['post_code'].' '.$row2['city'].'<br> Nr. tel.: '.$row2['telephone'];

        echo '<h5 class="text-center">Kwota do zapłaty: '. $totalPrice . ' zł</h5><br></div>';
        echo '<br>  <form action="admin_shipped_done.php" method="post">
                        <input type="hidden" name="session_id" value='. $value['session_id'] .'>
                        <input type="submit" name="confirm" value="Dostarczono" />
                    </form><hr>';

        $count-=1;
    }
} else {
    echo 'Brak zamówień w doręczeniu.';
}



?>
    </div>
</body>
</html>