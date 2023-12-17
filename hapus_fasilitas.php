<?php 
    include '../koneksi.php';

    $id_fasilitas = $_GET['id'];
    
    $query ="DELETE FROM fasilitas1 WHERE id_fasilitas ='$id_fasilitas'";
    mysqli_query ($koneksi, $query);

    header ("location:admin.php?page=fasilitas");
    
    ?>