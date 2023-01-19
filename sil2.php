<?php
require 'Medoo.php';


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
<?php

$silinecekID= $_GET["id"];
$sil = $database->delete("385222_tbl_firmalar",["id" => $silinecekID]);
if($sil){
    echo "Başarıyla silindi";
    header( "Location:tedarikcifirma.php" ); 
     }
    else
    echo "Bir sorun oluştu silinemedi";
?>

