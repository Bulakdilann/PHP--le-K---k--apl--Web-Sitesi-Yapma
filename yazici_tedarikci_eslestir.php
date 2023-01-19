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
<title>phpders</title>
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
<h3>Eşleştirme Sayfası</h3>
<form action="" method="post">
   <label for="yazicilar">Lütfen Yazıcı Markası Ve Çeşidini Seçiniz:</label>
   <select id="yazicilar" name="yazici">
      <?php
	  $yazicilar_=$database->select("385222_tbl_yazicilar","*");
	  foreach($yazicilar_ as $yazici_){
		  echo "<option value='".$yazici_["id"]."'>".$yazici_["Yazici_Markasi"]. " - ".$yazici_["Yazici_Cesiti"]. " </option>";
	  }
	  ?>
	  </select>
	  <br><br>
	  <label for="firmalar">Lütfen Tedarikçi Firmayı Seçiniz:</label>
      <select id="firmalar" name="firma">
        <?php
	       $firmalar_=$database->select("385222_tbl_firmalar","*");
	       foreach($firmalar_ as $firma_){
		     echo "<option value='".$firma_["id"]."'>".$firma_["firma_adi"]."</option>";
	  }
	  ?>
	  </select>
	  <br><br>
	  
	  <input type="submit" value="KAYDET"></input><br>

</form>
<?php
$yazici="";
$firma="";



if(isset($_POST["yazici"]) && isset($_POST["firma"])){
	if($_POST["yazici"]!="" && $_POST["firma"]!=""){
	$yazici=$_POST["yazici"];
	$firma=$_POST["firma"];
	$database->insert("385222_tbl_yazici_firma",["yazici_id" => $yazici, "firma_id" => $firma]);
	$sonkayit=0;
	$sonkayit=$database->id();
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
<th>id</th>
<th>Yazici id</th>
<th>Yazici Markası</th>
<th>Yazici Çeşiti</th>
<th>Firma id</th>
<th>Firma Adı</th>
<th>Firma Adresi</th>
<th>Sil</th>
</tr>
<thead>
<tbody>

<?php

$kayitlar = $database->select("385222_tbl_yazici_firma", "*");

foreach($kayitlar as $kayit){
	$yazici_bilgileri=$database->get("385222_tbl_yazicilar","*",["id"=>$kayit["yazici_id"]]);
    $firma_bilgileri=$database->get("385222_tbl_firmalar","*",["id"=> $kayit["firma_id"]]);
	echo '<tr>';
	echo '<td>'.$kayit["id"].'</td>';
	echo '<td>'.$kayit["yazici_id"].'</td>';
    echo '<td>'.$yazici_bilgileri["Yazici_Markasi"].'</td>';
    echo '<td>'.$yazici_bilgileri["Yazici_Cesiti"].'</td>';
	echo '<td>'.$kayit["firma_id"].'</td>';
	echo'<td>'.$firma_bilgileri["firma_adi"].'</td>';
	echo '<td>'.$firma_bilgileri["firma_adres"].'</td>';
	echo '<td> <a href="sil3.php?id='.$kayit['id'].'" onclick="return uyari();">Sil</a> </td>';
	
	
	'</tr>';
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


