<?php
require_once 'connect.php';

if (isset($_POST['confirm'])) {
	$session_id = $_POST['session_id'];
	$sth = $pdo->prepare('UPDATE orders SET status=4 WHERE session_id=:session_id');
	$sth->bindParam(':session_id', $session_id);
    $sth->execute();
    header('Location: admin_shipped.php');
}

?>