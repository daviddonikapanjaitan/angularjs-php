<?php 

	include "connect.php";

	$sql = $db->prepare("select * from kota");
	$sql->execute();

	$murid = $sql->fetchall(PDO::FETCH_ASSOC);

	print json_encode($murid);
?>