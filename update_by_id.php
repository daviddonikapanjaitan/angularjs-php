<?php
    include "connect.php";

    $id_data = $_GET['id_data'];
    $new_city = $_GET['new_city'];
    $sql = $db->prepare("update kota set nama_kota='" . $new_city ."' WHERE id='" . $id_data . "'");
    $sql->execute();

    $murid = $sql->fetchall(PDO::FETCH_ASSOC);

    print json_encode($murid);
?>