<?php
require("vendor/autoload.php"); //laod file autolaod.php dari composer
require("koneksi.php");         //laod konfigurasi untuk koneksi ke DB

use FontLib\Table\Type\head;
use PhpOffice\PhpSpreadsheet\Spreadsheet;              //panggil referensi namespacevdari library Spreadsheet
use PhpOffice\PhpSpreadsheet\IOFactory;

$spreadsheet = new Spreadsheet();                        //instansiasi class Spreadsheet

//Font Color
$spreadsheet->getActiveSheet()->getStyle('A3:G3')
    ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
 
// Background color
    $spreadsheet->getActiveSheet()->getStyle('A3:G3')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('FFFF7700');

$spreadsheet->getActiveSheet()->mergeCells('A1:G1');
$spreadsheet -> setActiveSheetIndex(0)            //set altif sheet pada excel
             -> setCellValue('A1', 'Daftar Anggota Sistem Perpustakaan Umum |by ROSI') //isi data excel sesuia baris dan kolom
             -> setCellValue('A3', 'No')
             -> setCellValue('B3', 'ID Anggota')
             -> setCellValue('C3', 'Nama')
             -> setCellValue('D3', 'Foto')
             -> setCellValue('E3', 'Jenis Kelamin')
             -> setCellValue('F3', 'Alamat')
             -> setCellValue('G3', 'Status');

$sheet = $spreadsheet->getActiveSheet();
$index = 4; //baris mulai isi data dinamis, mulai baris 4
$query = mysqli_query($db, "SELECT * FROM tbanggota"); //tag sql harus menggunakan huruf kapital
$idx=0;

if(mysqli_num_rows($query) > 0){

    while($val=mysqli_fetch_array($query)){
        $idx++;
        $sheet->setCellValue('A'.$index, $idx);
        $sheet->setCellValue('B'.$index, $val['idanggota']);
        $sheet->setCellValue('C'.$index, $val['nama']);
        $sheet->setCellValue('D'.$index, $val['foto']);
        $sheet->setCellValue('E'.$index, $val['jeniskelamin']);
        $sheet->setCellValue('F'.$index, $val['alamat']);
        $sheet->setCellValue('G'.$index, $val['status']);

        $index++;
    }
} else {
    $html .='<tr><td colspan="4" align="center">Ttidak Ada Data</td></tr>';
}

$sheet -> setTitle('Daftar Anggota SIPUS'); //set name sheet 
$spreadsheet->setActiveSheetIndex(0);

$filename = 'DaftarAanggotaSIPUS.xlsx';

ob_end_clean(); //Untuk mengatasi excel cannot open the file format or file extension is not valid
header('Conetent-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="'.$filename.'"');
header('Chace-Control: max-age=0');
header('Chace-Control: max-age=1');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
header('Cache-Control: cache, must-revalidate');
header('Pragma: public');

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
exit();
?>