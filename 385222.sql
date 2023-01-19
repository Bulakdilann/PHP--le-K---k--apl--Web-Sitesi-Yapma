-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 04 Şub 2021, 19:58:17
-- Sunucu sürümü: 10.4.11-MariaDB
-- PHP Sürümü: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `php_final`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `385222_tbl_firmalar`
--

CREATE TABLE `385222_tbl_firmalar` (
  `id` int(11) NOT NULL,
  `firma_adi` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `firma_adres` varchar(500) COLLATE utf8_turkish_ci NOT NULL,
  `firma_telefon` bigint(11) NOT NULL,
  `firma_eposta` varchar(500) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `385222_tbl_users`
--

CREATE TABLE `385222_tbl_users` (
  `id` int(11) NOT NULL,
  `ad` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `soyad` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `e_posta` varchar(500) COLLATE utf8_turkish_ci NOT NULL,
  `sifre` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `fotograf` varchar(500) COLLATE utf8_turkish_ci NOT NULL,
  `aktif_mi` int(11) NOT NULL DEFAULT 0,
  `aktivasyon` varchar(1000) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `385222_tbl_yazicilar`
--

CREATE TABLE `385222_tbl_yazicilar` (
  `id` int(11) NOT NULL,
  `Yazici_Markasi` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `Yazici_Cesiti` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `Yazici_Kagit_Tercihi` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `Yazici_Fiyati` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `385222_tbl_yazici_firma`
--

CREATE TABLE `385222_tbl_yazici_firma` (
  `id` int(11) NOT NULL,
  `yazici_id` int(11) NOT NULL,
  `firma_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `385222_tbl_firmalar`
--
ALTER TABLE `385222_tbl_firmalar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `385222_tbl_users`
--
ALTER TABLE `385222_tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `385222_tbl_yazicilar`
--
ALTER TABLE `385222_tbl_yazicilar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `385222_tbl_yazici_firma`
--
ALTER TABLE `385222_tbl_yazici_firma`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `385222_tbl_firmalar`
--
ALTER TABLE `385222_tbl_firmalar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `385222_tbl_users`
--
ALTER TABLE `385222_tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Tablo için AUTO_INCREMENT değeri `385222_tbl_yazicilar`
--
ALTER TABLE `385222_tbl_yazicilar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Tablo için AUTO_INCREMENT değeri `385222_tbl_yazici_firma`
--
ALTER TABLE `385222_tbl_yazici_firma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
