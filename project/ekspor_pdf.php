<?php
require("vendor/autoload.php"); //laod file autolaod.php dari composer
require("koneksi.php");         //laod konfigurasi untuk koneksi ke DB

use Dompdf\Dompdf;              //panggil referensi namespacevdari library Dompdf 

$html = '<h1><center>Daftar Anggota SIPUS | by ROSI</center></h1>';
$html .= '<table width="100%" border="1" cellspacing="0" cellpadding="2">
            <thead>
                <tr style="background-color: chartreuse;">
                    <th>No</th>
                    <th>ID Anggota</th>
                    <th>Nama</th>
                    <th>Foto</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>';

$query = mysqli_query($db, "SELECT * FROM tbanggota"); //tag sql harus menggunakan huruf kapital
$idx = 0;
if(mysqli_num_rows($query) > 0){
    while($val=mysqli_fetch_array($query)){
        
        if(empty($val['foto'])or($val['foto']=='-')) //Mengatur penampilan foto anggota
			{ $foto = "admin-no-photo.jpg"; //jika anggota tidak menginputkan foto, maka akan menampilkan secara deafult foto yang telah ditentukan admin
        } else {
            $foto = $val['foto']; //jika anggota menginputkan foto, maka foto akan ditampilkan
        }
					
        $idx++;
        $html .='<tr>
                    <td>'.$idx.'</td>
                    <td>'.$val['idanggota'].'</td>
                    <td>'.$val['nama'].'</td>
                    <td><img src="http://localhost/JWD-VSGA/Pertemuan11/images/'.$foto.'" width=70px height=70px></td> 
                    <td>'.$val['jeniskelamin'].'</td>
                    <td>'.$val['alamat'].'</td>
                    <td>'.$val['status'].'</td>
                </tr>';
        //dalam menampilkan alamat foto harus lengkap
    }
} else {
    $html .='<tr><td colspan="4" align="center">Ttidak Ada Data</td></tr>';
}

$html .='</tbody></html>';
// echo $html;

$dompdf = new Dompdf();                         //instance class Dompdf 
ob_end_clean();                                 //Untuk mengatasi Error Failed to load PDF document.
$dompdf->set_option('isRemoteEnabled', TRUE);   //Untuk menampilkan gambar yang disimpan dalam DB dan mengatasi error 'Image not found or type unknown'
$dompdf->loadHtml($html);                       //isi konten (format HTML) untuk dokumen pdf
$dompdf->setPaper('a4', 'landscape');           //set ukuran dan orientasi dokumen pdf
$dompdf->render();                              //reder kode HTML menjadi PDF
$dompdf->stream();                              //stream PDF ke browser
?>