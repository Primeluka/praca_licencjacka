<?php
    session_start();
    if (!isset($_SESSION['login'])) {
        header('Location: index.php');
    }
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
    <title>Profil</title>
</head>
<body>


<?php
    nav('');
    require_once 'header.php';
?>


    <div class="container">
    <div class="display-4 text-center mb-5">Mój profil</div>

<?php



    echo '<h3>Witaj '. $_SESSION['name'].' '.$_SESSION['surname'].'</h3>';
    echo '<h5 class="mt-3 text-danger">Adres e-mail</h5>';
    echo '<div class="ml-2">'.$_SESSION['email'].'</div>';

    require_once 'connect.php';
    $tbl=$pdo->query('SELECT adresses.street, adresses.building_no, adresses.flat_no, adresses.post_code, adresses.city, adresses.telephone, users.id AS user_id FROM users INNER JOIN adresses ON users.id=adresses.user_id WHERE user_id="'. $_SESSION['id'] .'"');
    $row=$tbl->fetch();
    echo '<h5 class="mt-3 text-danger">Adres dostawy</h5>';
    echo '<div class="ml-2">'.$row['street'].' '.$row['building_no'];
    if(strlen($row['flat_no'])>0){
        echo '/'.$row['flat_no'];
    }
    echo '<br>'.$row['post_code'].' '.$row['city'].'<br> Nr. tel.: '.$row['telephone'].'</div>';    
    
    if ($_SESSION['permissions']==1) {
        echo '<h5 class="text-success mt-3">Posiadasz uprawnienia administratora</h5>';
    }    

?>


    </div>
</body>
</html>