


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanici Kayit</title>
</head>
<body>
    <form action="eposta.php" method="post" enctype="multipart/form-data">
    Lütfen profil fotografınızı yükleyiniz.<br>
    <input type="file" name="fileToUpload" id="fileToUpload"><br><br>
    Ad<br><input type="text" name="ad" pattern="[a-zA-Z-]+" title="Sayısal Değer Girmeyiniz" required></input><br>
    Soyad<br><input type="text" name="soyad" pattern="[a-zA-Z-]+" title="Sayısal Değer Girmeyiniz" required></input><br>
    E-posta<br><input type="email" name="eposta" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"></input><br>
    Şifre<br><input type="password" name="sifre" ></input><br><br>
    
   <input type="submit" value="Kayıt Ol"></input><br>
   <a href="giris.php">Kullanıcı Giris Sayfası</a>
   </form>

</body>
</html>
 
