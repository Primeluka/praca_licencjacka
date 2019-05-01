<?php
	try{
		$pdo = new PDO('mysql:host=localhost;dbname=licencjat;charset=utf8','root','');

		$pdo->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	}
	catch(PDOException $connectError)
	{
		echo $connectError->getMessage();
	}
?>