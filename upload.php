<?php
require '../koneksi.php';

if(isset($_POST["proses"])){
    $jenis_kamar = $_POST["jenis_kamar"];
    $fasilitas_kamar = $_POST["fasilitas_kamar"];
    $jumlah = $_POST["jumlah"];

    // cek apakah file gambar ada
    if(isset($_FILES["gambar_kamar"])){
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
                $query = "INSERT INTO kamar1 VALUES('', '$jenis_kamar', '$fasilitas_kamar', '$jumlah', '$newImageName')";
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
}
?>