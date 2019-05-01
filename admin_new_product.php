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
    <title>Profil</title>
</head>
<body>


    <?php
        nav('admin');
        require_once 'header.php';
    ?>


    <div class="container">
        <div class="col-md-9">
            <h2 class="text-danger mb-3">Nowy produkt</h2>
            <form method="POST" class="mb-4">
                <div class="form-group">
                    <label>Nazwa</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label>Szczegóły</label>
                    <textarea name="details" rows="4" cols="50" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label>Cena</label>
                    <input type="text" name="price" class="form-control">
                </div>
                <div class="form-group">
                    <select name="category" class="form-control">
                        <?php
                            require_once 'connect.php';
                            $sth=$pdo->query('SELECT id, name FROM categories');
                            foreach ($sth->fetchAll() as $value) {
                                echo '<option value="'. $value['id'] .'">'. $value['name'] .'</option>';
                            }
                        ?>
                    </select>
                </div>
                <input type="submit" name="add" value="Dodaj">
            </form>
        </div>
        <?php
        
            if ((isset($_SESSION['newProduct'])) && ($_SESSION['newProduct']==true)) {
                echo '<div class="alert alert-info">Dodano nowy produkt!</div>';
                unset($_SESSION['newProduct']);
            }

            if (isset($_SESSION['nameError'])) {
                echo '<div class="alert alert-danger">' . $_SESSION['nameError'] . '</div>';
                unset($_SESSION['nameError']);
            }
            if (isset($_SESSION['detailsError'])) {
                echo '<div class="alert alert-danger">' . $_SESSION['detailsError'] . '</div>';
                unset($_SESSION['detailsError']);
            }
            if (isset($_SESSION['priceError'])) {
                echo '<div class="alert alert-danger">' . $_SESSION['priceError'] . '</div>';
                unset($_SESSION['priceError']);
            }
        
        ?>
    </div>

<?php

    if(isset($_POST['name'])){

        $validation = true;
        $name = $_POST['name'];
        $details = $_POST['details'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        
        if((strlen($name)==0) || (strlen($name)>30)){
            $validation=false;
            $_SESSION['nameError'] = 'Wprowadź nazwę. Maksymalnie 30 znaków.';
        }

        if((strlen($details)==0) || (strlen($details)>100)){
            $validation = false;
            $_SESSION['detailsError'] = 'Wprowadź szczegóły. Maksymalnie 100 znaków.';
        }
        
        if((strlen($price)==0) || (!is_numeric($price))){
            $validation = false;
            $_SESSION['priceError'] = 'Wprowadź cenę.';
        } 

        if ($validation == true) {
                
                $sth = $pdo->prepare('INSERT INTO products VALUES (NULL, :name, :details, :price, :category_id)');
                $sth->bindParam(':name', $name);
                $sth->bindParam(':details', $details);
                $sth->bindParam(':price', $price);
                $sth->bindParam(':category_id', $category);
                $sth->execute();

                $_SESSION['newProduct']=true;
                header('Location: admin_new_product.php');
                } else {
                header('Location: admin_new_product.php');
        }
    }

?>

</body>
</html>