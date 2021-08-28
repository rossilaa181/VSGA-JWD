<?php
session_start(); //menjalankan session PHP, rekomendasi situlis dibaris paling awal kode program
$_SESSION['sesi'] = NULL; //Set variabel global $_SESSION

include "koneksi.php"; //Memanggil file koneksi.php untuk koneksi data dengan database
	if( isset($_POST['submit'])) //mengecek apakah ada request post yang masuk (mengeklik tombol submit)
	{
			$user	= isset($_POST['user']) ? $_POST['user'] : "";
			$pass	= isset($_POST['pass']) ? $_POST['pass'] : "";
			$qry	= mysqli_query($db,"SELECT * FROM admin WHERE username = '$user' AND password = '$pass'"); //untuk menyeleksi data pada DB yang sesuai dengan inputan (username & password)
			$sesi	= mysqli_num_rows($qry); //untuk mengetahui banyak baris data dari hasil query database
			
			//untuk memfilter dan menentukan bahwa ada data username & password yang sesuai dan jumlahnya tepat 1 (untuk mastikan tidak ada redundansi data)
			if ($sesi == 1) 
			{
				//mengambil data pada field yang sama dengan hasil query
				$data_admin	= mysqli_fetch_array($qry);
				$_SESSION['id_admin'] = $data_admin['id_admin'];
				$_SESSION['sesi'] = $data_admin['nm_admin'];
				$_SESSION['nama'] = $data_admin['username'];
				
				echo "<script>alert('Anda berhasil Log In');</script>";
				echo "<meta http-equiv='refresh' content='0; url=index.php?user=$sesi'>";
			}
			else
			{
				echo "<meta http-equiv='refresh' content='0; url=login.php'>";
				echo "<script>alert('Anda Gagal Log In');</script>";
			}				
	}
	else
	{
	  include "login.php"; //jika to]idak ada request POST yang masuk, alihkan ke form login
	}
?>
