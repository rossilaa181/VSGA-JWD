<!DOCTYPE html>
<html>
<head>
	<title>Membuat Kalkulator Sederhana Dengan PHP</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php 
	// function isset() berfungsi untuk memeriksa ketersediaan data submit dari form
	// kemudian masing-masing inputan disimpan dlaam variabel bil1, bil2, dan operator
	if(isset($_POST['hitung'])){
		$bil1 = (double) @$_POST['bil1'];
		$bil2 = (double) @$_POST['bil2'];
		$operasi = @$_POST['operasi'];
		// dilakukan pengecekan terkait operasi yang dipilih saat sebelum form disubmit
		//setelah dilakukan filtering operator, maka bil1 & bil2 akan dieksekusi berdasarkan operatornya dan disimpan dalam variabel $hasil
		switch ($operasi) {
			case 'tambah':
				$hasil = $bil1+$bil2;
			break;
			case 'kurang':
				$hasil = $bil1-$bil2;
			break;
			case 'kali':
				$hasil = $bil1*$bil2;
			break;
			case 'bagi':
				$hasil = $bil1/$bil2;
			break;	
			case 'modulus':
				$hasil = $bil1%$bil2;
			break;		
		}
	}
	?>
	<div class="kalkulator">
		<h2 class="judul">KALKULATOR</h2>
		<a class="brand" href="">Rosi Latansa Salsabela</a>
		<!-- penanganan inputan menggunakan method post.
        action diarahkan kedalam index.php itu sendiri atau bisa dikosongi saja, karena akan otomatis memproses file form tersebut sendiri -->
        <form method="post" action="index.php">			
			<input type="text" name="bil1" class="bil" autocomplete="off" placeholder="Masukkan Bilangan Pertama" value="<?php echo @$_POST['bil1'] ?>">
			<input type="text" name="bil2" class="bil" autocomplete="off" placeholder="Masukkan Bilangan Kedua" value="<?php echo @$_POST['bil2'] ?>">
			<select class="opt" name="operasi">
				<option <?php echo !@$_POST['operasi'] ? 'selected' : '' ?> disabled>Pilih Operator</option>	
				<option <?php echo @$_POST['operasi'] === 'tambah' ? 'selected' : '' ?> value="tambah">+</option>
				<option <?php echo @$_POST['operasi'] === 'kurang' ? 'selected' : '' ?> value="kurang">-</option>
				<option <?php echo @$_POST['operasi'] === 'kali' ? 'selected' : '' ?> value="kali">x</option>
				<option <?php echo @$_POST['operasi'] === 'bagi' ? 'selected' : '' ?> value="bagi">/</option>
				<option <?php echo @$_POST['operasi'] === 'modulus' ? 'selected' : '' ?> value="modulus">%</option>
			</select>
			<input type="submit" name="hitung" value="Hitung" class="tombol">											
		</form>
		<!-- dilakukan pengecekan terhadap data hasil submit dengan function isset(),
		jika sudah disubmit maka akan menapilkan hasil dari perhitungan, 
		namun jika belum dilakukan submit maka menampilkan nilai 0 -->
		<?php if(isset($_POST['hitung'])){ ?>
			<input type="text" value="<?php echo $hasil; ?>" class="bil">
		<?php }else{ ?>
			<input type="text" value="0" class="bil">
		<?php } ?>
		<button class="tombol-clr" type="button" onclick="location.href = '?clear'">Clear</button>			
	</div>
</body>
</html>