<?php
session_start();
require_once 'nav.php';

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/my.css">
    <title>Aktualności</title>
</head>
<body>

<?php
    nav('index');
    require_once 'header.php';
?>


    <div class="container">

<?php

    if ((isset($_SESSION['newuser'])) && ($_SESSION['newuser']==true)) {
        echo '<div class="alert alert-success m-5">Pomyślnie zarejestrowano! Możesz się teraz zalogować!</div>';
        unset($_SESSION['newuser']);
    }    

?>

    <div class="display-4 text-center mb-5">Aktualności</div>

        
        <?php
            require_once 'connect.php';

            $tbl = $pdo->query('SELECT articles.id, articles.title, articles.contents, articles.date, users.name, users.surname FROM articles LEFT JOIN users ON articles.user_id=users.id ORDER BY id DESC');
            foreach ($tbl->fetchAll() as $value) {
                echo    '<div class="card mt-5 mb-5">
                            <div class="card-body">';
                                if (isset($_SESSION['permissions']) && ($_SESSION['permissions'] == 1)) {
                                    echo '<div class="text-right">
                                        <form action="admin_remove_article.php" method="POST">
                                            <input type="hidden" name="id" value="'. $value['id'] .'">    
                                            <input type="submit" name="usun" value="X">
                                        </form>
                                    </div>';
                                }
                echo            '<div class="card-title"><h3 class="text-danger">'. $value['title'] .'</h3></div>
                                <p class="ml-3">'. $value['contents'] .'</p>
                                <div class="text-muted text-right font-weight-light mt-4">'. $value['date'] .' <em>'. $value['name'] .' '. $value['surname'] .'</em></div>
                            </div>
                        </div>';
            }

        ?>
    </div>

</body>
</html>