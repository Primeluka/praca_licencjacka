<?php

    session_start();

    if(!isset($_POST['email']) || !isset($_POST['pass'])){
        $_SESSION['error'] = 'Błędny login lub hasło. Spróbuj ponownie.';
        header('Location: login_form.php');
    }



/*    if (!isset($connectError)) {*/

        $email = $_POST['email'];
        $pass = $_POST['pass'];

        require_once('connect.php');

        $sth = $pdo->prepare('SELECT * FROM users WHERE email=:email');
        $sth->bindParam(':email', $email);
        $sth->execute();
        
        if ($sth->execute()) {
            $count = $sth->rowCount();

            if ($count == 1) {
               $row = $sth->fetch();

               if(password_verify($pass ,$row['password'])) {
                    
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['surname'] = $row['surname'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['login'] = true;
                    $_SESSION['permissions'] = $row['permissions'];

                    unset($_SESSION['error']);
                    header('Location: profile.php');

               } else {
                    $_SESSION['error'] = 'Błędny login lub hasło. Spróbuj ponownie.';
                    header('Location: login_form.php');
                }

            } else {
                $_SESSION['error'] = 'Błędny login lub hasło. Spróbuj ponownie.';
                header('Location: login_form.php');
            }


        }

/*    }
    else {
        echo $connectError->getMessage();
    }
*/
?>