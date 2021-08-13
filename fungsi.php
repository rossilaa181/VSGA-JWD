<?php
function perkenalan($nama, $salam){
echo $salam.", ";
echo "Perkenalkan, Nama saya ".$nama."<br/>";
echo "Senang Berkenalan dengan Anda<br/>";
}

perkenalan("Komang", "Hi");
echo "<hr>";
$saya = "Rosi";
$ucapanSalam = "Selamat pagi";
perkenalan($saya, $ucapanSalam);
?>