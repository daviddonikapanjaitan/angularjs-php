<?php
    include "connect.php";

    $id_data = $_GET['id_data'];
    $sql = $db->prepare("select * from kota where id = '" . $id_data ."'");
    $sql->execute();

    $murid = $sql->fetchall(PDO::FETCH_ASSOC);

    print json_encode($murid);
?>