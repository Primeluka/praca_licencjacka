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
    <title>Rejestracja</title>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>

    <?php
        nav('register');
        require_once 'header.php';
    ?>

    <div class="container">
        <div class="display-4 text-center mb-5">Rejestracja</div>
        <form action="register.php" method="POST">
            <div class="form-group">
                <label>E-Mail:</label>
                <input type="text" name="email" class="form-control">
                <?php
                    if (isset($_SESSION['emailError'])) {
                        echo '<div class="text-danger mt-1">' . $_SESSION['emailError'] . '</div>';
                        unset($_SESSION['emailError']);
                    }
                ?>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Hasło:</label> 
                    <input type="password" name="pass" class="form-control">
                    <?php
                        if (isset($_SESSION['passError'])) {
                            echo '<div class="text-danger mt-1">' . $_SESSION['passError'] . '</div>';
                            unset($_SESSION['passError']);
                        }
                    ?>
                </div>
                <div class="form-group col-md-6">
                    <label>Powtórz hasło:</label>
                    <input type="password" name="repeatpass" class="form-control">
                </div>                
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Imię:</label>
                    <input type="text" name="name" class="form-control">
                    <?php
                        if (isset($_SESSION['nameError'])) {
                            echo '<div class="text-danger mt-1">' . $_SESSION['nameError'] . '</div>';
                            unset($_SESSION['nameError']);
                        }
                    ?>
                </div>
                <div class="form-group col-md-6">    
                    <label>Nazwisko:</label>
                    <input type="text" name="surname" class="form-control">
                    <?php
                        if (isset($_SESSION['surnameError'])) {
                            echo '<div class="text-danger mt-1">' . $_SESSION['surnameError'] . '</div>';
                            unset($_SESSION['surnameError']);
                        }
                    ?>
                </div>
            </div>
            <div class="form-group">        
                <label>Ulica:</label>
                <input type="text" name="street" class="form-control">
                <?php
                    if (isset($_SESSION['streetError'])) {
                        echo '<div class="text-danger mt-1">' . $_SESSION['streetError'] . '</div>';
                        unset($_SESSION['streetError']);
                    }
                ?>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">    
                    <label>Numer budynku:</label>
                    <input type="text" name="building_no" class="form-control">
                    <?php
                        if (isset($_SESSION['building_noError'])) {
                            echo '<div class="text-danger mt-1">' . $_SESSION['building_noError'] . '</div>';
                            unset($_SESSION['building_noError']);
                        }
                    ?>
                </div>
                <div class="form-group col-md-6">    
                    <label>Numer mieszkania:</label>
                    <input type="text" name="flat_no" class="form-control">
                    <?php
                        if (isset($_SESSION['flat_noError'])) {
                            echo '<div class="text-danger mt-1">' . $_SESSION['flat_noError'] . '</div>';
                            unset($_SESSION['flat_noError']);
                        }
                    ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">        
                    <label>Kod pocztowy:</label>
                    <input type="text" name="post_code" class="form-control">
                    <?php
                        if (isset($_SESSION['post_codeError'])) {
                            echo '<div class="text-danger mt-1">' . $_SESSION['post_codeError'] . '</div>';
                            unset($_SESSION['post_codeError']);
                        }
                    ?>
                </div>
                <div class="form-group col-md-6">    
                    <label>Miejscowość:</label>
                    <input type="text" name="city" class="form-control">
                    <?php
                        if (isset($_SESSION['cityError'])) {
                            echo '<div class="text-danger mt-1">' . $_SESSION['cityError'] . '</div>';
                            unset($_SESSION['cityError']);
                        }
                    ?>
                </div>
            </div>
            <div class="form-group">        
                <label>Numer telefonu:</label>
                <input type="text" name="telephone" class="form-control">
                <?php
                    if (isset($_SESSION['telephoneError'])) {
                        echo '<div class="text-danger mt-1">' . $_SESSION['telephoneError'] . '</div>';
                        unset($_SESSION['telephoneError']);
                    }
                ?>
            </div>
            <div class="form-check">    
                <label>
                <input type="checkbox" name="rules" value="rules" class="form-check-input"> Akceptuje regulamin
                </label>
            </div>    
            <?php
                if (isset($_SESSION['rulesError'])) {
                    echo '<div class="text-danger mt-1">' . $_SESSION['rulesError'] . '</div>';
                    unset($_SESSION['rulesError']);
                }
            ?>
            <div class="mt-3 mb-3">
                <div class="g-recaptcha" data-sitekey="6Ld6wCMTAAAAANCSnncp4lQMaOjOkrKMBppBXaFR"></div>
                <?php
                    if (isset($_SESSION['recaptchaError'])) {
                        echo '<div class="text-danger mt-1">' . $_SESSION['recaptchaError'] . '</div>';
                        unset($_SESSION['recaptchaError']);
                    }
                ?>
            </div> 
            <input type="submit" value="Zarejestruj się" class="btn btn-primary mt-2 mb-5 px-5">
        </form>
    </div>
</body>
</html>