<?php
require '../koneksi.php';

if(isset($_POST["proses"])){
    $id_kamar = $_POST['id_kamar'];
    $nama_kamar = $_POST["nama_kamar"];
    $fasilitas_kamar = $_POST["fasilitas_kamar"];
    $jumlah = $_POST["jumlah"];

    if($_FILES["gambar_kamar"]["error"] == 4){
            echo
            "<script> alert('Image Does Not Exist'); </script>"
            ;
        }
    else{
        $fileName = $_FILES["gambar_kamar"]["name"];
        $fileSize = $_FILES["gambar_kamar"]["size"];
        $tmpName = $_FILES["gambar_kamar"]["tmp_name"];

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
        $query = "UPDATE kamar1 SET nama_kamar='$nama_kamar',fasilitas_kamar='$fasilitas_kamar',jumlah_kasur='$jumlah',
        gambar_kamar='$newImageName' WHERE id_kamar = '$id_kamar'";
        mysqli_query($koneksi, $query);
        echo
        "
        <script>
        alert('Successfully Added'); 
        document.location.href = 'admin.php?page=kamar';
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