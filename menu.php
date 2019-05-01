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
    <title>Menu</title>
</head>
<body>
    
    <?php
        nav('menu');
        require_once 'header.php';
    ?>

    <div class="container">
    <div class="display-4 text-center mb-5">Menu</div>

<?php

require_once 'connect.php';
echo '<div class="mb-5"><h2 class="text-danger">Pizza</h2>';
$tbl = $pdo->query('SELECT products.id, products.name, products.details, products.price, categories.name AS category_name, categories.id AS category_id FROM products LEFT JOIN categories ON products.category_id = categories.id WHERE category_id=1');

echo '<table class="table table-responsive table-striped p-2 mx-1 my-2">
    <thead class="table-warning">
    <th scope="col">ID</th><th scope="col">Nazwa</th><th scope="col">Szczegóły</th><th scope="col">Cena</th><th scope="col">Kategoria</th>';
    if (isset($_SESSION['login']) && $_SESSION['login'] = true) { echo '<th scope="col">Zamów</th>';}
    if (isset($_SESSION['permissions']) && ($_SESSION['permissions'] == 1)) { echo '<th scope="col" class="text-danger">Usuń</th>';}
    echo '</thead><tbody>';
$i=1;
foreach ($tbl->fetchAll() as $value) {
	echo '<tr>' .
		'<td>' . $i . '</td><td>' . $value['name'] . '</td><td>' . $value['details'] . '</td><td>' . $value['price'] . '</td><td>' . $value['category_name'] . '</td>';
	if (isset($_SESSION['login']) && $_SESSION['login'] = true) {
		echo "<td>
                <form action='add.php' method='post'>
                    <input type='hidden' name='product_id' value=" . $value['id'] . ">
                    <input type='submit' value='Do koszyka' name='add'>
                </form>
            </td>";
    }
    if (isset($_SESSION['permissions']) && ($_SESSION['permissions'] == 1)) { 
		echo "<td>
                    <form action='admin_remove_product.php' method='post'>
                        <input type='hidden' name='product_id' value=" . $value['id'] . ">
                        <input type='submit' value='Usuń' name='remove'>
                    </form>
                </td>";
    }
    echo '</tr>';
    $i+=1;
}
echo '</tbody></table></div>';


echo '<div class="mb-5"><h2 class="text-danger">Obiady</h2>';
$tbl = $pdo->query('SELECT products.id, products.name, products.details, products.price, categories.name AS category_name, categories.id AS category_id FROM products LEFT JOIN categories ON products.category_id = categories.id WHERE category_id=2');

echo '<table class="table table-responsive table-striped p-2 mx-1 my-2">
    <thead class="table-warning">
    <th scope="col">ID</th><th scope="col">Nazwa</th><th scope="col">Szczegóły</th><th scope="col">Cena</th><th scope="col">Kategoria</th>';
    if (isset($_SESSION['login']) && $_SESSION['login'] = true) { echo '<th scope="col">Zamów</th>';}
    if (isset($_SESSION['permissions']) && ($_SESSION['permissions'] == 1)) { echo '<th scope="col" class="text-danger">Usuń</th>';}
    echo '</thead><tbody>';
$i=1;
foreach ($tbl->fetchAll() as $value) {
	echo '<tr>' .
		'<td>' . $i . '</td><td>' . $value['name'] . '</td><td>' . $value['details'] . '</td><td>' . $value['price'] . '</td><td>' . $value['category_name'] . '</td>';
	if (isset($_SESSION['login']) && $_SESSION['login'] = true) {
		echo "<td>
                    <form action='add.php' method='post'>
                        <input type='hidden' name='product_id' value=" . $value['id'] . ">
                        <input type='submit' value='Do koszyka' name='add'>
                    </form>
                </td>";
    }
    if (isset($_SESSION['permissions']) && ($_SESSION['permissions'] == 1)) { 
		echo "<td>
                    <form action='admin_remove_product.php' method='post'>
                        <input type='hidden' name='product_id' value=" . $value['id'] . ">
                        <input type='submit' value='Usuń' name='remove'>
                    </form>
                </td>";
    }
    echo '</tr>';
    $i+=1;
}
echo '</tbody></table></div>';

echo '<div class="mb-5"><h2 class="text-danger">Fast-Food</h2>';
$tbl = $pdo->query('SELECT products.id, products.name, products.details, products.price, categories.name AS category_name, categories.id AS category_id FROM products LEFT JOIN categories ON products.category_id = categories.id WHERE category_id=3');

echo '<table class="table table-responsive table-striped p-2 mx-1 my-2">
    <thead class="table-warning">
    <th scope="col">ID</th><th scope="col">Nazwa</th><th scope="col">Szczegóły</th><th scope="col">Cena</th><th scope="col">Kategoria</th>';
    if (isset($_SESSION['login']) && $_SESSION['login'] = true) { echo '<th scope="col">Zamów</th>';}
    if (isset($_SESSION['permissions']) && ($_SESSION['permissions'] == 1)) { echo '<th scope="col" class="text-danger">Usuń</th>';}
    echo '</thead><tbody>';
$i=1;
foreach ($tbl->fetchAll() as $value) {
	echo '<tr>' .
		'<td>' . $i . '</td><td>' . $value['name'] . '</td><td>' . $value['details'] . '</td><td>' . $value['price'] . '</td><td>' . $value['category_name'] . '</td>';
	if (isset($_SESSION['login']) && $_SESSION['login'] = true) {
		echo "<td>
                    <form action='add.php' method='post'>
                        <input type='hidden' name='product_id' value=" . $value['id'] . ">
                        <input type='submit' value='Do koszyka' name='add'>
                    </form>
                </td>";
    }
    if (isset($_SESSION['permissions']) && ($_SESSION['permissions'] == 1)) { 
		echo "<td>
                    <form action='admin_remove_product.php' method='post'>
                        <input type='hidden' name='product_id' value=" . $value['id'] . ">
                        <input type='submit' value='Usuń' name='remove'>
                    </form>
                </td>";
    }
    echo '</tr>';
    $i+=1;
}
echo '</tbody></table></div>';

echo '<div class="mb-5"><h2 class="text-danger">Napoje</h2>';
$tbl = $pdo->query('SELECT products.id, products.name, products.details, products.price, categories.name AS category_name, categories.id AS category_id FROM products LEFT JOIN categories ON products.category_id = categories.id WHERE category_id=4');

echo '<table class="table table-responsive table-striped p-2 mx-1 my-2">
    <thead class="table-warning">
    <th scope="col">ID</th><th scope="col">Nazwa</th><th scope="col">Szczegóły</th><th scope="col">Cena</th><th scope="col">Kategoria</th>';
    if (isset($_SESSION['login']) && $_SESSION['login'] = true) { echo '<th scope="col">Zamów</th>';}
    if (isset($_SESSION['permissions']) && ($_SESSION['permissions'] == 1)) { echo '<th scope="col" class="text-danger">Usuń</th>';}
    echo '</thead><tbody>';
$i=1;
foreach ($tbl->fetchAll() as $value) {
	echo '<tr>' .
		'<td>' . $i . '</td><td>' . $value['name'] . '</td><td>' . $value['details'] . '</td><td>' . $value['price'] . '</td><td>' . $value['category_name'] . '</td>';
	if (isset($_SESSION['login']) && $_SESSION['login'] = true) {
		echo "<td>
                    <form action='add.php' method='post'>
                        <input type='hidden' name='product_id' value=" . $value['id'] . ">
                        <input type='submit' value='Do koszyka' name='add'>
                    </form>
                </td>";
    }
    if (isset($_SESSION['permissions']) && ($_SESSION['permissions'] == 1)) { 
		echo "<td>
                    <form action='admin_remove_product.php' method='post'>
                        <input type='hidden' name='product_id' value=" . $value['id'] . ">
                        <input type='submit' value='Usuń' name='remove'>
                    </form>
                </td>";
    }
    echo '</tr>';
    $i+=1;
}
echo '</tbody></table></div>';

?>

    </div>
</body>
</html>