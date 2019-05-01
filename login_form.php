<?php
session_start();
if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
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
    <title>Logowanie</title>
</head>
<body>

<?php
    nav('login');
    require_once 'header.php';
?>


<div class="container">
    <div class="display-4 text-center mb-5">Logowanie</div>
    <div class="col-md-6 mb-5">    
        <form action="login.php" method="POST">
            <div class="form-group">
                <label>E-Mail:</label>
                <input type="text" name="email" class="form-control">
            </div>
            <div class="form-group">    
            <label>Hasło:</label>
            <input type="password" name="pass" class="form-control">
            </div>
        <input type="submit" value="Zaloguj" class="btn btn-primary mt-2 px-5">
        </form>    
        <?php
            if (isset($_SESSION['error'])) {
                echo '<div class="text-danger mt-2">' . $_SESSION['error'] .'</div>';
                unset($_SESSION['error']);
            }
        ?>  
    </div>
</div>

</body>
</html>