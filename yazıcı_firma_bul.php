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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<a href="panel.php" style="color:white; background-color:black; text-decoration:none; font-size:20px; position: absolute;left: 1100px;top: 20px;">Profile Dön</a>
<a href="cikis.php" style="color:white; background-color:black; text-decoration:none; font-size:20px; position: absolute;left: 1220px;top: 20px;">Çıkış Yap</a>

<?php include("baglantılar.html"); ?><br>
<h3>Yazıcıların Hangi Firmadan Geldiklerini Bulma</h3>
<form action="" method="post">
   Yazıcı Adı: <br><input type="text" name="ad"></input><br><br>
  
   <br><input type="submit" value="ARA"></input>
</form>
</body>
</html>

<?php
$ad="";


if(isset($_POST["ad"])){
  if($_POST["ad"]!="" ){
      $ad=$_POST["ad"];
      
      $sonuclar=$database->select("385222_tbl_yazicilar","*",["Yazici_Markasi[~]" =>$ad]);
      if($sonuclar!=""){
          echo "bulunan yazıcılar: <br>";
          foreach($sonuclar as $sonuc){
              echo '<a href="?id='.$sonuc["id"].'">'.$sonuc["Yazici_Markasi"].' - '.$sonuc["Yazici_Cesiti"].'</a><br>';
          }
        }
      
      }
}
$yazici_id_="";
if(isset($_GET["id"])){
    if($_GET["id"]!=""){
        $yazici_id_=$_GET["id"];
        $firmalar=$database->query(
            "select * from 385222_tbl_firmalar where id in(select firma_id from 385222_tbl_yazici_firma where yazici_id=$yazici_id_)"
            )->fetchAll();//diziye dönüştürüyor
        if($firmalar!=""){
            
            foreach($firmalar as $firma){
                echo 'Firma Adı :'.$firma["firma_adi"]."- Firma Adresi :".$firma["firma_adres"]."<br>";
            }
          }
        
        }
  }

?>
