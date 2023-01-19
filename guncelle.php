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
<h1>Yazıcı Güncelleme Sayfası</h1>
    <form action="" method="post">
        <label for="yazici"></label><br><br>
        <select id="yazici" name="yazici">
            <?php
            $yazicilar=$database->select("385222_tbl_yazicilar","*");
            foreach($yazicilar as $yazici){
        
                echo "<option value='".$yazici["id"]."'>".$yazici["Yazici_Markasi"]." - ".$yazici["Yazici_Cesiti"]."- ".$yazici["Yazici_Kagit_Tercihi"]."- ".$yazici["Yazici_Fiyati"]."</option>";
        } ?> 
        </select><br><br>
        Yazıcının Markası:<input type="text" name="Yazici_Markasi"  pattern="[a-zA-Z-]+" title="Sayısal Değer Girmeyiniz" value="" >
	    Yazıcının Çeşiti:<input type="text" name="Yazici_Cesiti"  pattern="[a-zA-Z-]+" title="Sayısal Değer Girmeyiniz"  value="">
	    Yazıcının Kağit Tercihi:<input type="text" name="Yazici_Kagit_Tercihi">
	    Yazıcının Fiyatı:<input type="number" name="Yazici_Fiyati" >
	
        

        
        <input type="submit" value=" Kaydet"><br><br>
        <a href="panel.php">Geri</a>
 
 </form>
 
</body>
</html>
<?php
$markaa="";
$cesitt="";
$tercihh="";
$fiyatt="";
$id="";

if(isset($_POST["Yazici_Markasi"]) && isset($_POST["Yazici_Cesiti"]) && isset($_POST["Yazici_Kagit_Tercihi"]) && isset($_POST["Yazici_Fiyati"])){
	if($_POST["Yazici_Markasi"]!="" && $_POST["Yazici_Cesiti"]!="" && $_POST["Yazici_Kagit_Tercihi"]!="" && $_POST["Yazici_Fiyati"]!=""){
	$markaa=$_POST["Yazici_Markasi"];
	$cesitt=$_POST["Yazici_Cesiti"];
	$tercihh=$_POST["Yazici_Kagit_Tercihi"];
    $fiyatt=$_POST["Yazici_Fiyati"];
    $id=$_POST["yazici"];
    $guncelleme=$database->query("UPDATE 385222_tbl_yazicilar SET Yazici_Markasi='$markaa',Yazici_Cesiti='$cesitt', Yazici_Kagit_Tercihi='$tercihh',Yazici_Fiyati='$fiyatt' WHERE id='$id'");
        
   
    }
}

?>
    

   