<?php
require("vendor/autoload.php"); //laod file autolaod.php dari composer
// require("koneksi.php");         //laod konfigurasi untuk koneksi ke DB

use Dompdf\Dompdf;              //panggil referensi namespacevdari library Dompdf 

$menu = [
    ['nama' => 'Jeruk', 'jenis' => 'Buah', 'harga' => 14000],
    ['nama' => 'Pisang', 'jenis' => 'Buah', 'harga' => 12000],
    ['nama' => 'Nasi Goreng', 'jenis' => 'Makanan', 'harga' => 12000],
    ['nama' => 'Mie Goreng', 'jenis' => 'Makanan', 'harga' => 10000],
    ['nama' => 'Jus Jambu', 'jenis' => 'Minuman', 'harga' => 6000],
    ['nama' => 'Air Mineral', 'jenis' => 'Minuman', 'harga' => 3000],
    ['nama' => 'Wortel', 'jenis' => 'Sayur', 'harga' => 9000],
    ['nama' => 'Tomat', 'jenis' => 'Sayur', 'harga' => 5000],
    ['nama' => 'Seblak', 'jenis' => 'Makanan', 'harga' => 18000],
    ['nama' => 'Rujak Uleg', 'jenis' => 'Makanan', 'harga' => 7000]    
];

$html = '<h1>Daftar Menu Restaurant ROSI</h1>';
$html .= '<table width="100%" border="1" cellspacing="0" cellpadding="2">
            <thead>
                <tr style="background-color: chartreuse;">
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>';

if(count($menu) > 0){
    foreach($menu as $idx => $val){
        $idx++;
        $html .='<tr>
                    <td>'.$idx.'</td>
                    <td>'.$val['nama'].'</td>
                    <td>'.$val['jenis'].'</td>
                    <td>'.$val['harga'].'</td>
                </tr>';
    }
} else {
    $html .='<tr><td colspan="4" align="center">Ttidak Ada Data</td></tr>';
}

$html .='</tbody></html>';

$dompdf = new Dompdf();                  //instance class Dompdf 

$dompdf->load_html($html);              //isi konten (format HTML) untuk dokumen pdf
$dompdf->setPaper('a4', 'landscape');   //set ukuran dan orientasi dokumen pdf
$dompdf->render();                      //reder kode HTML menjadi PDF
$dompdf->stream();                      //stream PDF ke browser
?>