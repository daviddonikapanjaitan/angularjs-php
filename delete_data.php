<?php

include "connect.php";

    $id_kota = $_GET['id_kota'];
    $sql = $db->prepare("delete from kota where id = '" .  + $id_kota . "'");
    $sql->execute();

    print json_encode($id_kota);
?>