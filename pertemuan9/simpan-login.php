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
                echo "<h3 style='color:white'><b>".$username."</b></h3>";
                echo "<h4><marquee scrollamount='6'>Hello World-Let's Start It!<marquee></h4>";
            }          
        ?>
    </div>    
    <script>
         alert("Welcome to Our Page:)");
    </script>
</body>
</html>





