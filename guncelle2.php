<?php
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
	//'port' => 3306
]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    

</head>
<body>
<h1>Firma Güncelleme Sayfası</h1>
    <form action="" method="post">
        <label for="firma"></label><br><br>
        <select id="firma" name="firma">
            <?php
            $firmalar=$database->select("385222_tbl_firmalar","*");
            foreach($firmalar as $firma){
        
                echo "<option value='".$firma["id"]."'>".$firma["firma_adi"]." - ".$firma["firma_adres"]."- ".$firma["firma_telefon"]."- ".$firma["firma_eposta"]."</option>";
        } ?> 
        </select><br><br>
       
	Firma Adi:<input type="text" name="firma_adi"  value="" >
	Firma Adresi:<input type="text" name="firma_adres"   value="">
	Firma Telefon:<input type="number" name="firma_telefon" value="">
	Firma Eposta:<input type="email" name="firma_eposta" value="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
	
        

        
        <input type="submit" value=" Kaydet"><br><br>
        <a href="tedarikcifirma.php">Geri</a>
 
 </form>
 
</body>
</html>
<?php
$firma_adi="";
$firma_adres="";
$firma_telefon="";
$firma_eposta="";
$id="";

if(isset($_POST["firma_adi"]) && isset($_POST["firma_adres"]) && isset($_POST["firma_telefon"]) && isset($_POST["firma_eposta"])){
	if($_POST["firma_adi"]!="" && $_POST["firma_adres"]!="" && $_POST["firma_telefon"]!="" && $_POST["firma_eposta"]!=""){
	$firma_adi=$_POST["firma_adi"];
	$firma_adres=$_POST["firma_adres"];
	$firma_telefon=$_POST["firma_telefon"];
	$firma_eposta=$_POST["firma_eposta"];
    $id=$_POST["firma"];
    $guncelleme=$database->query("UPDATE 385222_tbl_firmalar SET firma_adi='$firma_adi',firma_adres='$firma_adres', firma_telefon='$firma_telefon',firma_eposta='$firma_eposta' WHERE id='$id'");
        
   
    }
}

?>
    

   