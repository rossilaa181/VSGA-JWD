<?php
$server = "localhost";
$user = "root";
$password = "";
$nama_database = "dbpus";//nama database

    $db = mysqli_connect(
        $server,
        $user,
        $password,
        $nama_database
    );//mengkoneksikan dengan database   
   
    if(!$db){
        die("Gagal terhubung dengan database : ".mysqli_connect_error());
    } 
    else {               
        echo "<script>alert('Koneksi Berhasil');</script>";
        // echo "<script>document.write('Connection Successful');</script>";
    }
?>