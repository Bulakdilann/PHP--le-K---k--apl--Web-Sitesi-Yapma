<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'Medoo.php';
session_start();
 

use Medoo\Medoo;
 
$database = new Medoo([
	
	'database_type' => 'mysql',
	'database_name' => 'php_final',
	'server' => 'localhost',
	'username' => 'root',
	'password' => '',
 
	
	'charset' => 'utf8mb4',
	'collation' => 'utf8mb4_general_ci',
	'port' => 3306
]);
if(!isset($_SESSION["kullaniciID"]) || $_SESSION["kullaniciID"]==""){
    header('Location: giris.php');
    exit;
}
?>
<html>
<head>
<title>Tedarikçiler</title>
<style>
table.minimalistBlack {
  border: 3px solid #000000;
  width: 100%;
  text-align: center;
  border-collapse: collapse;
}
table.minimalistBlack td, table.minimalistBlack th {
  border: 1px solid #000000;
  padding: 5px 4px;
}
table.minimalistBlack tbody td {
  font-size: 15px;
}
table.minimalistBlack thead {
  background: #CFCFCF;
  background: -moz-linear-gradient(top, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
  background: -webkit-linear-gradient(top, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
  background: linear-gradient(to bottom, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
  border-bottom: 3px solid #000000;
}
table.minimalistBlack thead th {
  font-size: 15px;
  font-weight: bold;
  color: #000000;
  text-align: center;
}
table.minimalistBlack tfoot {
  font-size: 14px;
  font-weight: bold;
  color: #000000;
  border-top: 3px solid #000000;
}
table.minimalistBlack tfoot td {
  font-size: 14px;
}

</style>
</head>
<body>
<a href="panel.php" style="color:white; background-color:black; text-decoration:none; font-size:20px; position: absolute;left: 1100px;top: 20px;">Profile Dön</a>
<a href="cikis.php" style="color:white; background-color:black; text-decoration:none; font-size:20px; position: absolute;left: 1220px;top: 20px;">Çıkış Yap</a>
 <?php include("baglantılar.html"); ?><br>
<h3>Tedarikçi Ekle Sayfası</h3>
<form action="" method="post">
	Firma Adi:<input type="text" name="firma_adi"  value="" >
	Firma Adresi:<input type="text" name="firma_adres"   value="">
	Firma Telefon:<input type="number" name="firma_telefon" value="">
	Firma Eposta:<input type="email" name="firma_eposta" value="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
	<a href="guncelle2.php" style="color:white; background-color:black; text-decoration:none; font-size:15px; position: absolute;left: 1100px;top:90px;">Değerleri Güncellemek için Tıklayın</a>
	<input type="submit" value="KAYDET">
	</form>
	<br><br>
<?php
$firma_adi="";
$firma_adres="";
$firma_telefon="";
$firma_eposta="";

if(isset($_POST["firma_adi"]) && isset($_POST["firma_adres"]) && isset($_POST["firma_telefon"]) && isset($_POST["firma_eposta"])){
	if($_POST["firma_adi"]!="" && $_POST["firma_adres"]!="" && $_POST["firma_telefon"]!="" && $_POST["firma_eposta"]!=""){
	$firma_adi=$_POST["firma_adi"];
	$firma_adres=$_POST["firma_adres"];
	$firma_telefon=$_POST["firma_telefon"];
	$firma_eposta=$_POST["firma_eposta"];
	$database->insert("385222_tbl_firmalar",["firma_adi" => $firma_adi, "firma_adres" => $firma_adres, "firma_telefon" => $firma_telefon, "firma_eposta" => $firma_eposta]);
	$sonkayit=0;
	$sonkayit=$database->Id();
	if($sonkayit>0){
		echo '<script>alert("Kaydınız Başarıyla Gerçekleşmiştir.");</script>';
	}
	else{
		echo 'script>alert("Hata!");</script>';
	}
	 }else{
	 echo '<script>alert("Eksik alanlar var. Lütfen bilgileri eksiksiz doldurunuz.")</script>';}
}
?>

<table class="minimalistBlack">
<thead>
<tr>
<th>Sıra Numarası</th>
<th>Firma Adı</th>
<th>Firma Adresi</th>
<th>Firma Telefon</th>
<th>Firma Eposta</th>
<th>Sil</th>

</tr>
<thead>
<tbody>

<?php

$kayitlar = $database->select("385222_tbl_firmalar", "*");
$artıs=1;
foreach($kayitlar as $kayit){
	echo '<tr>';
	echo '<td>'.$artıs.'</td>';
	echo '<td>'.$kayit['firma_adi'].'</td>';
	echo '<td>'.$kayit['firma_adres'].'</td>';
	echo '<td>'.$kayit['firma_telefon'].'</td>';
	echo '<td>'.$kayit['firma_eposta'].'</td>';
	echo '<td> <a href="sil2.php?id='.$kayit['id'].'" onclick="return uyari();">Sil</a> </td>';
   '</tr>';
   $artıs++;
    
  }
 
  ?>

	


</body>
</html>
<script language="JavaScript">
function uyari() {
 
if (confirm("Bu kaydı silmek istediğinize emin misiniz?"))
   return true;
else 
   return false;
}
</script>


