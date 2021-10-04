<?php

    include "connect.php";

    $name_city = $_POST['city'];
    $sql_text = "insert into kota (nama_kota) values ('" . $name_city . "')";
    $sql = $db->prepare($sql_text);
    $sql->execute();

    print json_encode($name_city);
?>