<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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
	'port' => 3306
]);

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

// aktivasyon kısmı için KOD ÜRETME

$kod_icin1=date('d.m.Y H:i:s');
$kod_icin2=rand(0,20000);
$aktivasyon_dkod=hash('sha256',$kod_icin1.$kod_icin2);

$adi="";
$soyadi="";
$ePosta="";
$sifree="";
//değişkenler varsa ve boş değilse değişkenleri boş değerlere aktardım
if(isset($_POST["ad"]) && isset($_POST["soyad"]) && isset($_POST["eposta"]) && isset($_POST["sifre"])){
    if($_POST["ad"]!="" && $_POST["soyad"]!="" && $_POST["eposta"]!="" && $_POST["sifre"]!=""){
        $adi=$_POST["ad"];
        $soyadi=$_POST["soyad"];
        $ePosta=$_POST["eposta"];
        $sifree=$_POST["sifre"];
//fotograf yükleme işlemi
$hedef_klasor="yuklenenler/";
$hedef_dosya=$hedef_klasor.basename($_FILES["fileToUpload"]["name"]);
$yuklemeyeUygunluk = 1;
$durum="";

//uygunluk kontrol dosya var mı //dosya varmı yokmu
if(file_exists($hedef_dosya)){
    $yuklemeyeUygunluk=0;
    $durum.="Aynı dosya Var.";
}

//uygunluk kontrol boyut max 10mb mı
if($_FILES["fileToUpload"]["size"]>10000000){
    $yuklemeyeUygunluk=0;
    echo "aa";
    $durum.="Dosya boyutu 10MB üstünde.";
}


//uygunluk kontrol dosya resim mi
$resimKontrol=getimagesize($_FILES["fileToUpload"]["tmp_name"]);

if(strpos($resimKontrol["mime"] ,"image")!= "false"){
    $yuklemeyeUygunluk=0;
    $durum.="Resim dosyası değil.";
}

//dosya uzantı uygunluk
$resimDosyaTur = strtolower(pathinfo($hedef_dosya,PATHINFO_EXTENSION));
if($resimDosyaTur!="jpg" && $resimDosyaTur!="jpeg" && $resimDosyaTur!="png" && $resimDosyaTur!="gif"){
    $yuklemeyeUygunluk=0;
    $durum.="png, jpg, jpeg ve gif uzantılı olmalı.";
}
// yukardaki kriterler sağlanıyorsa uygunluk 1 olursa dosya yuklensin
if($yuklemeyeUygunluk==1){
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $hedef_dosya)) {
       
      } else {
        echo "Hata";
      }
}else{
    echo "Kriterler sağlanmadı!";
    echo $durum;
}




        //yukardaki değişkenlerim de varsa Kayıt işlemi yapsın
        $database->insert("385222_tbl_users", ["ad" => $adi, "soyad" => $soyadi,"e_posta" => $ePosta,"sifre" => $sifree ,"fotograf"=>$hedef_dosya,"aktivasyon" => $aktivasyon_dkod]);
        $son_eklenen_id = $database->id();
        if($son_eklenen_id>0){
            echo '<script>alert("Kayıt oluşturuldu, aktif olunca giriş yapabilirsiniz.")</script>';
        }else{
            echo '<script>alert("Kayıt oluşturulurken hata!Lütfen tekrar deneyiniz.")</script>';
        }
    }else{
        echo '<script>alert("Eksik alanlar var. Lütfen bilgileri eksiksiz doldurunuz.")</script>';
        
    }    
}




try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'heavenssx61@gmail.com';                     // SMTP username
    $mail->Password   = 'Dilan.10';                               // SMTP password
    $mail->SMTPSecure = "tls";         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('heavenssx61@gmail.com', 'Mailer');
    $mail->addAddress( $ePosta, 'Yeni Kullanıcı');     // Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'kayıt olduğunuz için teşekkürler. <br>Hesabinizi aktif etmek için <a href="localhost/aktif_et.php?mail='.$ePosta.'&kod='.$aktivasyon_dkod.'">tıklayınız</a>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}



?>