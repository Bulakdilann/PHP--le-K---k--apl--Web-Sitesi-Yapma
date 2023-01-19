<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'Medoo.php';
session_start();
// Using Medoo namespace
use Medoo\Medoo;
 
$database = new Medoo([
	// required
	'database_type' => 'mysql',
	'database_name' => 'php_final',
	'server' => 'localhost',
	'username' => 'root',
	'password' => '',
 
	// [optional]
	'charset' => 'utf8mb4',
	'collation' => 'utf8mb4_general_ci',
	'port' => 3306
]);

if(!isset($_SESSION["kullaniciID"]) || $_SESSION["kullaniciID"]==""){
    header('Location: giris.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Admin Sayfası</h1>
    <?php
    $user = $database->get("385222_tbl_users", "*", ["id" => $_SESSION["kullaniciID"]]);
    ?>
    <?php echo '<img src="'.$user["fotograf"]. '" style="width:100px" alt="">';?>
    <h3>Merhaba sayın, <?php echo $user["ad"] .' '.$user["soyad"]; ?></h3>
    
    <a href="cikis.php" style="color:white; background-color:black; text-decoration:none; font-size:20px; position: absolute;left: 1220px;top: 20px;">Çıkış Yap</a>
    <?php include("baglantılar.html"); ?><br>
<h3>Yazici Ekle </h3>
<form action="" method="post">
	Yazıcının Markası:<input type="text" name="Yazici_Markasi"  pattern="[a-zA-Z-]+" title="Sayısal Değer Girmeyiniz" value="" >
	Yazıcının Çeşiti:<input type="text" name="Yazici_Cesiti"  pattern="[a-zA-Z-]+" title="Sayısal Değer Girmeyiniz"  value="">
	Yazıcının Kağit Tercihi:<input type="text" name="Yazici_Kagit_Tercihi" value="">
  Yazıcının Fiyatı:<input type="number" name="Yazici_Fiyati" value="" ">
  <a href="guncelle.php" style="color:white; background-color:black; text-decoration:none; font-size:15px; position: absolute;left: 1100px;top:220px;">Değerleri Güncellemek için Tıklayın</a>
	<input type="submit" value="KAYDET">
	</form>
	<br><br>
<?php
$markaa="";
$cesitt="";
$tercihh="";
$fiyatt="";

if(isset($_POST["Yazici_Markasi"]) && isset($_POST["Yazici_Cesiti"]) && isset($_POST["Yazici_Kagit_Tercihi"]) && isset($_POST["Yazici_Fiyati"])){
	if($_POST["Yazici_Markasi"]!="" && $_POST["Yazici_Cesiti"]!="" && $_POST["Yazici_Kagit_Tercihi"]!="" && $_POST["Yazici_Fiyati"]!=""){
	$markaa=$_POST["Yazici_Markasi"];
	$cesitt=$_POST["Yazici_Cesiti"];
	$tercihh=$_POST["Yazici_Kagit_Tercihi"];
	$fiyatt=$_POST["Yazici_Fiyati"];
	$database->insert("385222_tbl_yazicilar",["Yazici_Markasi" => $markaa, "Yazici_Cesiti" => $cesitt, "Yazici_Kagit_Tercihi" => $tercihh, "Yazici_Fiyati" => $fiyatt]);
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
<th>Yazici Markasi</th>
<th>Yazici Cesiti</th>
<th>Yazici Kagit Tercihi</th>
<th>Yazici Fiyati</th>
<th>Sil</th>



</tr>
<thead>
<tbody>

<?php

$kayitlar = $database->select("385222_tbl_yazicilar", "*");
$artıs=1;
foreach($kayitlar as $kayit){
	echo '<tr>';
	echo '<td>'.$artıs.'</td>';
	echo '<td>'.$kayit['Yazici_Markasi'].'</td>';
	echo '<td>'.$kayit['Yazici_Cesiti'].'</td>';
	echo '<td>'.$kayit['Yazici_Kagit_Tercihi'].'</td>';
	echo '<td>'.$kayit['Yazici_Fiyati'].'</td>';
	echo '<td> <a href="sil1.php?id='.$kayit['id'].'" onclick="return uyari();">Sil</a> </td>';
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
