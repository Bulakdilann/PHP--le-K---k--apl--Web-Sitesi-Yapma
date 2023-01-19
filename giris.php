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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Sayfası</title>
</head>
<body>
    <form action="" method="post">
    E-posta<br><input type="email" name="eposta" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"></input><br>
    Şifre<br><input type="password" name="sifre" ></input><br><br>
    <input type="submit" value="Giriş Yap"></input><br>
    <a href="hatirlat.php">Şifremi Unuttum</a>

</body>
</html>
<?php 
$epostaa="";
$sifree="";

if(isset($_POST["eposta"]) && isset($_POST["sifre"])){
    if($_POST["eposta"]!="" && $_POST["sifre"]!=""){
        $epostaa=$_POST["eposta"];
        $sifree=$_POST["sifre"];
        $user =$database->get("385222_tbl_users","*",["AND" => ["e_posta" => $epostaa,"sifre" => $sifree,"aktif_mi"=>1]]);
        if($user['id']!=""){
              $_SESSION["kullaniciID"]=$user['id'];
                header('Location: panel.php');
                exit;

                
        }else{
            header("Location:giris.php?m=kullanıcı_hata");
        }
    }
}

?>