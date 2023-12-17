<?php
require '../koneksi.php';

if(isset($_POST["proses"])){
    $id_fasilitas = $_POST['id_fasilitas'];
    $nama_fasilitas = $_POST["nama_fasilitas"];
    $ket_fasilitas = $_POST["ket_fasilitas"];


    if($_FILES["gambar_fasilitas"]["error"] == 4){
            echo
            "<script> alert('Image Does Not Exist'); </script>"
            ;
        }
    else{
        $fileName = $_FILES["gambar_fasilitas"]["name"];
        $fileSize = $_FILES["gambar_fasilitas"]["size"];
        $tmpName = $_FILES["gambar_fasilitas"]["tmp_name"];

        $validImageExtension = ['jpg','jpeg','png'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));
        if( !in_array($imageExtension, $validImageExtension) ){
            echo
            "
            <script> 
            alert('Invalid Image Extension');
            </script>
            ";
         }
        else if($fileSize > 1000000){
            echo
            "
            <script>
            alert('Image Size Is Too Large'); 
            </script>
            ";
        }
        else{
        $newImageName = uniqid();
        $newImageName .= '.' . $imageExtension;

        move_uploaded_file($tmpName, '../img/' . $newImageName);
        $query = "UPDATE fasilitas1 SET nama_fasilitas='$nama_fasilitas',ket_fasilitas='$ket_fasilitas',
        gambar_fasilitas='$newImageName' WHERE id_fasilitas = '$id_fasilitas'";
        mysqli_query ($koneksi, $query);
        echo
        "
        <script>
        alert('Successfully Added'); 
        document.location.href = 'admin.php?page=fasilitas';
        </script>
        ";
        }
     }
 }
        else{
        echo
        "<script> alert('No Image File Submitted'); </script>"
        ;
        }
?>