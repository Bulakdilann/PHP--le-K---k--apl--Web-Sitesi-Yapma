
<?php
//medoo kütüphanesini kurduk
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'Medoo.php';
 
// Using Medoo namespace
use Medoo\Medoo;
 
$database = new Medoo([
    //veritabanımızı ekledik
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
?>
<?php
//mail ve kod değişkeni varsa. değişkenleri yeni değişkenlereatıyorum.
if(isset($_GET["mail"]) && isset($_GET["kod"])){
    $mail=$_GET["mail"];
    $kod=$_GET["kod"];
    //veritabanımdaki eposta ve aktıvasyon kodu birbiriyle uyuyorsa 
    $user=$database->get("385222_tbl_users","id", ["AND" => ["e_posta" => $mail,"aktivasyon" => $kod]]);
    
    if($user>0){
        //aktivasyon yap dıyorum  0 alanını 1 e çevir.
        $data=$database->update("385222_tbl_users",["aktif_mi" =>1],["id" => $user]);
        header("Location:giris.php");
    }else{
        //bilgiler uyuşmuyorsa hatalı kod tekrar kayıt ol
        header("Location:giris.php?m=kod hatalı");
    }
}

?>