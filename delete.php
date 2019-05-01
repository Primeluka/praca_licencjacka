<?php

if (isset($_POST['order_id'])) {
    require_once('connect.php');

	$sth2 = $pdo->prepare('DELETE FROM orders WHERE id=:id');
	$sth2->bindParam(':id', $_POST['order_id']);
	$sth2->execute();
	header('Location: order.php');
}

?>