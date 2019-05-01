<?php

    session_start();

    if (isset($_POST['email'])) {
        
        $validation = true;

        $email = $_POST['email'];
		$name= $_POST['name'];
		$surname=$_POST['surname'];
		$city=$_POST['city'];
		$street=$_POST['street'];
		$building_no=$_POST['building_no'];
		$flat_no=$_POST['flat_no'];
		$telephone=$_POST['telephone'];
		$post_code=$_POST['post_code'];
		$pass=$_POST['pass'];
		$re_pass=$_POST['repeatpass'];

		$filteredEmail = filter_var($email, FILTER_SANITIZE_EMAIL);

		if ((filter_var($filteredEmail, FILTER_VALIDATE_EMAIL)!=true) || ($filteredEmail!=$email)) 
		{
            $validation = false;
            $_SESSION['emailError'] = 'Niepoprawny adres e-mail.';
        }

		if((strlen($name)==0) || (strlen($name)>30))
		{
			$validation=false;
            $_SESSION['nameError']="Wprowadź imię (maksymalnie 30 znaków)";
		}
		
		if((strlen($surname)==0) || (strlen($surname)>30))
		{
			$validation=false;
            $_SESSION['surnameError']="Wprowadź nazwisko (maksymalnie 30 znaków)";
        }
		
		if((strlen($street)==0) || (strlen($street)>50))
		{
			$validation=false;
            $_SESSION['streetError']="Wprowadź ulicę (maksymalnie 50 znaków)";
		}
		
		if((strlen($building_no)==0) || (strlen($building_no)>4))
		{
			$validation=false;
			$_SESSION['building_noError']="Wprowadź numer domu (maksymalnie 4 znaków)";
        }
		
		if(strlen($flat_no)>4)
		{
			$validation=false;
            $_SESSION['flat_noError']="Wprowadź numer mieszkania (maksymalnie 4 znaków)";
		}
		
		if (!preg_match('/^[0-9]{2}-?[0-9]{3}$/Du', $post_code))
		{
			$validation=false;
            $_SESSION['post_codeError']="Wprowadź kod pocztowy (xx-xxx)";
		}
		
    	if((strlen($city)==0) || (strlen($city)>50))
		{
			$validation=false;
            $_SESSION['cityError']="Wprowadź miasto (maksymalnie 50 znaków)";
		}
		
		if((strlen($telephone)!=9) || (!is_numeric($telephone)))
		{
			$validation=false;
			$_SESSION['telephoneError']="Wprowadź numer telefonu (telefon musi mieć 9 cyfr)";
        }
						
		if((strlen($pass)<8) || (strlen($pass)>50))
		{
			$validation=false;
			$_SESSION['passError']="Hasło musi zawierać od 8 do 50 znaków";
		}
		
		if($pass!=$re_pass)
		{
			$validation=false;
            $_SESSION['passError']="Podane hasła nie są takie same";
		}
		
		$pass_hash = password_hash($pass, PASSWORD_DEFAULT);

		if(!isset($_POST['rules']))
		{
			$validation=false;
            $_SESSION['rulesError']="Rejestracja wymaga zaakceptowania regulaminu";
		}
		
$secret_key = '6Ld6wCMTAAAAANn6TvUgx_YZ5dPp587SRSBwsAgg';
$recaptcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response']);
$recaptcha_response = json_decode($recaptcha);

if (!$recaptcha_response->success) {
	$validation=false;
	$_SESSION['recaptchaError']='Zaznacz pole recaptcha.';
}

		require_once 'connect.php';

			$sth = $pdo->prepare('SELECT id FROM users WHERE email=:email');
			$sth->bindParam(':email', $email);	
			$sth->execute();
		
			$count = $sth->rowCount();

			if($count == 1) {
				$validation=false;
				$_SESSION['emailError']="Użytkownik o takim mailu istnieje już w bazie.";
			} 
		
if($validation==true){
	try{
		$sth = $pdo->prepare('INSERT INTO users VALUES (NULL, :email, :pass, :name, :surname, 0)');
		$sth->bindParam(':email', $email);
		$sth->bindParam(':pass', $pass_hash);
		$sth->bindParam(':name', $name);
		$sth->bindParam(':surname', $surname);	
		$result = $sth->execute();

					if(!$result){
						throw new Exception ('Błąd w zapytaniu');
					} else {
						$tbl = $pdo->prepare('SELECT id FROM users WHERE email=:email');
						$tbl->bindParam(':email', $email);
						$tbl->execute();
						$row = $tbl->fetch();

						$sth2 = $pdo->prepare('INSERT INTO adresses VALUES (NULL, :user_id, :street, :building_no, :flat_no, :post_code, :city, :telephone)');
						$sth2->bindParam(':user_id', $row['id']);
						$sth2->bindParam(':street', $street);	
						$sth2->bindParam(':building_no', $building_no);
						$sth2->bindParam(':flat_no', $flat_no);
						$sth2->bindParam(':post_code', $post_code);
						$sth2->bindParam(':city', $city);
						$sth2->bindParam(':telephone', $telephone);
						$result2 = $sth2->execute();
						
						if(!$result2){
							throw new Exception ('Błąd w zapytaniu');
						} else {
							$_SESSION['newuser']=true;
							header('Location: index.php');
						}
					}
				}
				catch(exception $err)
				{
					echo '<div class="err">Błąd serwera, spróbuj później.</div>';
					echo 'Info dev: '.$err;
				}
			}

    }
	
	if ($validation==false) {
		header('Location: form.php');
	}
    

?>