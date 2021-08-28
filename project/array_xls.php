<?php
require("vendor/autoload.php"); //laod file autolaod.php dari composer
// require("koneksi.php");         //laod konfigurasi untuk koneksi ke DB

use FontLib\Table\Type\head;
use PhpOffice\PhpSpreadsheet\Spreadsheet;              //panggil referensi namespacevdari library Spreadsheet
use PhpOffice\PhpSpreadsheet\IOFactory;

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

$spreadsheet = new Spreadsheet();                        //instansiasi class Spreadsheet

//Font Color
$spreadsheet->getActiveSheet()->getStyle('A3:G3')
    ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
 
// Background color
    $spreadsheet->getActiveSheet()->getStyle('A3:D3')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('FFFF7700');

$spreadsheet->getActiveSheet()->mergeCells('A1:B1');
$spreadsheet -> setActiveSheetIndex(0)            //set altif sheet pada excel
             -> setCellValue('A1', 'Daftar Menu') //isi data excel sesuia baris dan kolom
             -> setCellValue('A3', 'No')
             -> setCellValue('B3', 'Nama')
             -> setCellValue('C3', 'Jenis')
             -> setCellValue('D3', 'Harga');

$sheet = $spreadsheet->getActiveSheet();
$index = 4; //baris mulai isi data dinamis, mulai baris 4

if(count($menu) > 0){
    foreach($menu as $idx => $val){
        $idx++;
        $sheet->setCellValue('A'.$index, $idx);
        $sheet->setCellValue('B'.$index, $val['nama']);
        $sheet->setCellValue('C'.$index, $val['jenis']);
        $sheet->setCellValue('D'.$index, $val['harga']);

        $index++;
    }
} else {
    $html .='<tr><td colspan="4" align="center">Ttidak Ada Data</td></tr>';
}

$sheet -> setTitle('Daftar Menu Saya'); //set name sheet 
$spreadsheet->setActiveSheetIndex(0);

$filename = 'Daftar-Menu-Saya.xlsx';

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