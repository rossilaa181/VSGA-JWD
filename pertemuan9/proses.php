<?php 
    // include "koneksi.php";
    // $cek_user=mysql_num_rows(mysql_query("SELECT * FROM tb_user WHERE userid='$_POST[userid]'"));
    // if ($cek_user > 0) {
    //     echo '<script language="javascript">
    //           alert ("Username Sudah Ada Yang Menggunakan");
    //           window.location="index.php";
    //           </script>';
    //           exit();
    // }
    // else {
    //     $password    =md5('$_POST[password]');
    //     mysql_query("INSERT INTO tb_user (userid, nama, alamat, email, hp, password)
    //     VALUES ('$_POST[userid]', '$_POST[nama]', '$_POST[alamat]', '$_POST[email]', '$_POST[hp]', '$password')");
        
    //     echo '<script language="javascript">
    //           alert ("Registrasi Berhasil Di Lakukan!");
    //           window.location="index.php";
    //           </script>';
    //           exit();
    // }
              
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello Page</title>
    <link rel="stylesheet" href="css/style.css">  
</head>
<body>
    <div class="container">
        <?php
        $username = $_POST['username'];
        $nama = $_POST['nama'];   
            if($username == ""){
                echo "<h2 style='color:orange'>Username Belum Di Masukkan!</h2>";
            } else{
                echo "<h2 style='color:white'><b>HI!</b></h2>";
                echo "<h3 style='color:white'><b>".$nama."</b></h3>";
                echo "<h4><marquee scrollamount='6'>Hello World-Let's Start It!<marquee></h4>";           
            }          
        ?>
    </div>    
    <script>
        alert ("Registrasi Berhasil Di Lakukan!");
    </script>
</body>
</html>





