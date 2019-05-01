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
    <title>Nowy artykuł</title>
</head>
<body>


    <?php
        nav('admin');
        require_once 'header.php';
    ?>


    <div class="container">
        <div class="col-md-9">
            <h2 class="text-danger mb-3">Nowy artykuł</h2>
            <form method="POST" class="mb-4">
                <div class="form-group">
                    <label>Tytuł</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <label>Treść</label>
                    <textarea name="content" rows="4" cols="50" class="form-control"></textarea>
                </div>
                <input type="submit" name="add" value="Dodaj">
            </form>
            <?php
                if ((isset($_SESSION['newArticle'])) && ($_SESSION['newArticle']==true)) {
                    echo '<div class="alert alert-info">Dodano nowy artykuł!</div>';
                    unset($_SESSION['newArticle']);
                }

                if (isset($_SESSION['titleError'])) {
                    echo '<div class="alert alert-danger">' . $_SESSION['titleError'] . '</div>';
                    unset($_SESSION['titleError']);
                }

                if (isset($_SESSION['contentError'])) {
                    echo '<div class="alert alert-danger">' . $_SESSION['contentError'] . '</div>';
                    unset($_SESSION['contentError']);
                }
            ?>
        </div>
    </div>
<?php

    if(isset($_POST['title'])){

        $validation = true;
        $title = $_POST['title'];
        $content = $_POST['content'];
        
        if((strlen($title)==0) || (strlen($title)>100)){
            $validation=false;
            $_SESSION['titleError'] = 'Wprowadź tytuł. Maksymalnie 100 znaków.';
        }

        if((strlen($content)==0) || (strlen($content)>300)){
            $validation = false;
            $_SESSION['contentError'] = 'Wprowadź treść. Maksymalnie 300 znaków.';
        }        

        if ($validation == true) {
            
                require_once 'connect.php';
                $sth = $pdo->prepare('INSERT INTO articles VALUES (NULL, :title, :content, NOW(), :user_id)');
                $sth->bindParam(':title', $title);
                $sth->bindParam(':content', $content);
                $sth->bindParam(':user_id', $_SESSION['id']);
                $result = $sth->execute();

                $_SESSION['newArticle']=true;
                header('Location: admin_new_article.php');
 
        } else {
            header('Location: admin_new_article.php');
        }
    }

?>

</body>
</html>