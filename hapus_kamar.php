<?php 
    include '../koneksi.php';

    $id_kamar = $_GET['id'];
    
    $query ="DELETE FROM kamar1 WHERE id_kamar ='$id_kamar'";
    mysqli_query ($koneksi, $query);

    header ("location:admin.php?page=kamar");
    
    ?>