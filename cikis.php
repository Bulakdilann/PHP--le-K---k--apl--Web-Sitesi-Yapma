<?php
session_start();
$_SESSION["kullaniciID"]="";
header('Location: panel.php');
exit;
?>