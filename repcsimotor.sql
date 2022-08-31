-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2022. Aug 30. 15:37
-- Kiszolgáló verziója: 10.4.21-MariaDB
-- PHP verzió: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `repcsimotor`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `arak`
--

CREATE TABLE `arak` (
  `ar_id` int(4) NOT NULL,
  `t_id` int(4) NOT NULL,
  `ar` float NOT NULL,
  `tol` date DEFAULT NULL,
  `ig` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `arak`
--

INSERT INTO `arak` (`ar_id`, `t_id`, `ar`, `tol`, `ig`) VALUES
(1, 1, 5965710, '2022-08-28', '2023-12-31'),
(2, 2, 11931400, '2022-08-28', '2023-12-31'),
(3, 3, 17897100, '2022-08-28', '2023-12-31'),
(4, 4, 23862800, '2022-08-28', '2023-12-31'),
(5, 5, 29828600, '2022-08-28', '2023-12-31'),
(6, 6, 35794300, '2022-08-28', '2023-12-31'),
(7, 7, 41760000, '2022-08-28', '2023-12-31'),
(8, 8, 2981870, '2022-08-28', '2023-12-31'),
(9, 9, 3354610, '2022-08-28', '2023-12-31'),
(10, 10, 3727340, '2022-08-28', '2023-12-31'),
(11, 11, 4100080, '2022-08-28', '2023-12-31'),
(12, 12, 4472810, '2022-08-28', '2023-12-31'),
(13, 13, 4845550, '2022-08-28', '2023-12-31'),
(14, 14, 5218280, '2022-08-28', '2023-12-31'),
(15, 15, 5591010, '2022-08-28', '2023-12-31'),
(16, 16, 46237400, '2022-08-28', '2023-12-31'),
(17, 17, 49127200, '2022-08-28', '2023-12-31'),
(18, 18, 52017100, '2022-08-28', '2023-12-31'),
(19, 19, 54906900, '2022-08-28', '2023-12-31'),
(20, 20, 57796800, '2022-08-28', '2023-12-31'),
(21, 21, 60686600, '2022-08-28', '2023-12-31'),
(22, 22, 63576400, '2022-08-28', '2023-12-31'),
(23, 23, 66466300, '2022-08-28', '2023-12-31'),
(24, 24, 67778900, '2022-08-28', '2023-12-31'),
(25, 25, 70603000, '2022-08-28', '2023-12-31'),
(26, 26, 73427100, '2022-08-28', '2023-12-31'),
(27, 27, 76251200, '2022-08-28', '2023-12-31'),
(28, 28, 79075300, '2022-08-28', '2023-12-31'),
(29, 29, 81899400, '2022-08-28', '2023-12-31'),
(30, 30, 84723600, '2022-08-28', '2023-12-31'),
(31, 31, 19375100, '2022-08-28', '2023-12-31'),
(32, 32, 20000100, '2022-08-28', '2023-12-31'),
(33, 33, 20625100, '2022-08-28', '2023-12-31'),
(34, 34, 21250100, '2022-08-28', '2023-12-31'),
(35, 35, 1087900, '2022-08-28', '2023-12-31'),
(36, 36, 1118980, '2022-08-28', '2023-12-31'),
(37, 37, 1150070, '2022-08-28', '2023-12-31');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `category`
--

CREATE TABLE `category` (
  `kat_id` int(4) NOT NULL,
  `kat_nev1` varchar(40) NOT NULL,
  `kat_nev2` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `category`
--

INSERT INTO `category` (`kat_id`, `kat_nev1`, `kat_nev2`) VALUES
(1, 'Kereskedelmi', 'Szélestestű Jet'),
(2, 'Kereskedelmi', 'Keskenytestű Jet'),
(3, 'Kereskedelmi', 'Üzleti repülőgép'),
(4, 'Kereskedelmi', 'Turbo-propeller'),
(5, 'Kereskedelmi', 'Helikopter'),
(6, 'Katonai', 'Vadászgép'),
(7, 'Katonai', 'Harci helikopter'),
(8, 'Katonai', 'Szállító repülőgép'),
(9, 'Ipari gázturbina', '-');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalo`
--

CREATE TABLE `felhasznalo` (
  `felhasznalo_id` int(4) NOT NULL,
  `neve` varchar(40) NOT NULL,
  `jelszo` varchar(100) NOT NULL,
  `vez_nev` varchar(40) DEFAULT NULL,
  `ker_nev` varchar(40) DEFAULT NULL,
  `telefon` varchar(20) DEFAULT NULL,
  `email` varchar(40) NOT NULL,
  `ir_szam` int(6) DEFAULT NULL,
  `varos` varchar(60) DEFAULT NULL,
  `cim` varchar(90) DEFAULT NULL,
  `ip_cim` varchar(40) NOT NULL,
  `reg_datum` date DEFAULT NULL,
  `latest` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `felhasznalo`
--

INSERT INTO `felhasznalo` (`felhasznalo_id`, `neve`, `jelszo`, `vez_nev`, `ker_nev`, `telefon`, `email`, `ir_szam`, `varos`, `cim`, `ip_cim`, `reg_datum`, `latest`, `status`) VALUES
(1, 'admin', '$2y$10$QNo0ynEX7xs5Klv2KG7cGOV6EibTKCFMqnR3BOaIQJDDMtCGIpk3q', 'admin', 'pista', '20-454-2214', 'geza@freemail.hu', 5200, 'Gencs', 'Pille u 1.', '127.0.0.1', '2022-08-28', '2022-08-28 08:21:15', 'admin'),
(2, 'Oriza Triznyák', '$2y$10$dtzkVtJvAHrcpYW0V69ys.j9miWUBLMPrcsjqFYb.fiXBEgwM86ti', NULL, NULL, NULL, 'oriza@freemail.hu', NULL, NULL, NULL, '127.0.0.1', '2022-08-28', '2022-08-28 08:01:04', 'vásárló'),
(3, 'Shrek', '$2y$10$10Fjr3dkk9g6mUl790Qgd.bV3hfU33fgCfl4hYscD6q1RsbV/eLxS', 'Shrek', 'Ogre', '20-454-2214', 'odin@mail.hu', 6900, 'Makó', 'Karakutty 11.', '127.0.0.1', '2022-08-28', '2022-08-28 08:04:01', 'vásárló');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `images`
--

CREATE TABLE `images` (
  `kep_id` int(4) NOT NULL,
  `t_id` int(4) DEFAULT NULL,
  `path` varchar(60) DEFAULT NULL,
  `alt` varchar(40) DEFAULT NULL,
  `alap` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `images`
--

INSERT INTO `images` (`kep_id`, `t_id`, `path`, `alt`, `alap`) VALUES
(1, 8, 'CF34_1.webp', 'CF34_1.webp', 1),
(2, 8, 'CF34_BOMBARDIER.webp', 'CF34_BOMBARDIER.webp', NULL),
(3, 8, 'CF34_Challenger.webp', 'CF34_Challenger.webp', NULL),
(4, 8, 'CF34_EMBRAER.webp', 'CF34_EMBRAER.webp', NULL),
(5, 1, 'CF6_1.webp', 'CF6_1.webp', 1),
(6, 1, 'CF6_A300.webp', 'CF6_A300.webp', NULL),
(7, 1, 'CF6_B747.webp', 'CF6_B747.webp', NULL),
(8, 1, 'CF6_big.webp', 'CF6_big.webp', NULL),
(9, 9, 'CFM56_1.webp', 'CFM56_1.webp', 1),
(10, 9, 'CFM56_A320.webp', 'CFM56_A320.webp', NULL),
(11, 9, 'CFM56_BOEING.webp', 'CFM56_BOEING.webp', NULL),
(12, 25, 'EJ200_1.webp', 'EJ200_1.webp', 1),
(13, 25, 'EJ200_2.webp', 'EJ200_2.webp', NULL),
(14, 26, 'F110_1.webp', 'F110_1.webp', 1),
(15, 26, 'F110_2.jpg', 'F110_2.jpg', NULL),
(16, 27, 'F414_1.webp', 'F414_1.webp', 1),
(17, 27, 'F414_2.webp', 'F414_2.webp', NULL),
(18, 27, 'F414_3.webp', 'F414_3.webp', NULL),
(19, 4, 'GE90-110BB777.webp', 'GE90-110BB777.webp', NULL),
(20, 4, 'GE90-110B_1.webp', 'GE90-110B_1.webp', 1),
(21, 3, 'GE9X2.jpg', 'GE9X2.jpg', NULL),
(22, 3, 'GE9X_2.jpg', 'GE9X_2.jpg', NULL),
(23, 3, 'GE9x_1.webp', 'GE9x_1.webp', 1),
(24, 2, 'GEnx_1.webp', 'GEnx_1.webp', 1),
(25, 2, 'GEnx_2.webp', 'GEnx_2.webp', NULL),
(26, 2, 'GEnx_3.webp', 'GEnx_3.webp', NULL),
(27, 2, 'GEnx_B787.webp', 'GEnx_B787.webp', NULL),
(28, 5, 'GP7000_1.webp', 'GP7000_1.webp', 1),
(29, 5, 'GP7000_A380.webp', 'GP7000_A380.webp', NULL),
(30, 5, 'GP7000_A3802.webp', 'GP7000_A3802.webp', NULL),
(31, 10, 'GTF_1.webp', 'GTF_1.webp', 1),
(32, 10, 'GTF_A320neo.webp', 'GTF_A320neo.webp', NULL),
(33, 11, 'JT8DP.jpg', 'JT8DP.jpg', NULL),
(34, 11, 'JT8DP_2.jpg', 'JT8DP_2.jpg', NULL),
(35, 11, 'JT8D_1.webp', 'JT8D_1.webp', 1),
(36, 24, 'Klimov_RD33_1.webp', 'Klimov_RD33_1.webp', 1),
(37, 24, 'Klimov_RD33_2.jpg', 'Klimov_RD33_2.jpg', NULL),
(38, 24, 'Klimov_RD33_3.jpg', 'Klimov_RD33_3.jpg', NULL),
(39, 24, 'Klimov_RD33_4.jpg', 'Klimov_RD33_4.jpg', NULL),
(40, 12, 'LEAP-1A.jpg', 'LEAP-1A.jpg', NULL),
(41, 12, 'LEAP-1B_1.webp', 'LEAP-1B_1.webp', 1),
(42, 12, 'LEAP1B.webp', 'LEAP1B.webp', NULL),
(43, 35, 'LM2500_1.webp', 'LM2500_1.webp', 1),
(44, 35, 'LM2500_2.jpg', 'LM2500_2.jpg', NULL),
(45, 36, 'LM6000_1.webp', 'LM6000_1.webp', 1),
(46, 36, 'LM6000_2.jpg', 'LM6000_2.jpg', NULL),
(47, 28, 'Larzac04_1.webp', 'Larzac04_1.webp', 1),
(48, 28, 'Larzac04_2.webp', 'Larzac04_2.webp', NULL),
(49, 28, 'Larzac04_3.webp', 'Larzac04_3.webp', NULL),
(50, 31, 'MTR390_1.webp', 'MTR390_1.webp', 1),
(51, 31, 'MTR390_Tiger.webp', 'MTR390_Tiger.webp', NULL),
(52, 31, 'MTR390_Tiger_3.jpg', 'MTR390_Tiger_3.jpg', NULL),
(53, 31, 'MTR390_Tiger_4.webp', 'MTR390_Tiger_4.webp', NULL),
(54, 19, 'PT6A_1.webp', 'PT6A_1.webp', 1),
(55, 19, 'PT6A_2.jpg', 'PT6A_2.jpg', NULL),
(56, 23, 'PT6T_1.webp', 'PT6T_1.webp', 1),
(57, 23, 'PT6T_2.jpg', 'PT6T_2.jpg', NULL),
(58, 20, 'PW150_1.webp', 'PW150_1.webp', 1),
(59, 20, 'PW150_2.png', 'PW150_2.png', NULL),
(60, 13, 'PW2000.jpg', 'PW2000.jpg', NULL),
(61, 13, 'PW2000_1.webp', 'PW2000_1.webp', 1),
(62, 13, 'PW2000_2.jpg', 'PW2000_2.jpg', NULL),
(63, 21, 'PW200_1.webp', 'PW200_1.webp', 1),
(64, 21, 'PW200_2.png', 'PW200_2.png', NULL),
(65, 22, 'PW210_1.webp', 'PW210_1.webp', 1),
(66, 22, 'PW210_2.jpg', 'PW210_2.jpg', NULL),
(67, 16, 'PW300_1.webp', 'PW300_1.webp', 1),
(68, 16, 'PW300_2.webp', 'PW300_2.webp', NULL),
(69, 16, 'PW300_3.webp', 'PW300_3.webp', NULL),
(70, 6, 'PW4000_1.webp', 'PW4000_1.webp', 1),
(71, 6, 'PW4000_B777.webp', 'PW4000_B777.webp', NULL),
(72, 17, 'PW500_1.webp', 'PW500_1.webp', 1),
(73, 17, 'PW500_2.jpg', 'PW500_2.jpg', NULL),
(74, 17, 'PW500_3.webp', 'PW500_3.webp', NULL),
(75, 14, 'PW6000_1.webp', 'PW6000_1.webp', 1),
(76, 14, 'PW6000_3.jpg', 'PW6000_3.jpg', NULL),
(77, 18, 'PW600_1.webp', 'PW600_1.webp', 1),
(78, 18, 'PW600_2.jpg', 'PW600_2.jpg', NULL),
(79, 30, 'RB199_1.webp', 'RB199_1.webp', 1),
(80, 30, 'RB199_Tornado.webp', 'RB199_Tornado.webp', NULL),
(81, 30, 'RB199_Tornado2.webp', 'RB199_Tornado2.webp', NULL),
(82, 30, 'RB199_Tornado3.webp', 'RB199_Tornado3.webp', NULL),
(83, 37, 'SGT-800_1.webp', 'SGT-800_1.webp', 1),
(84, 29, 'Saturn_AL_41_1.webp', 'Saturn_AL_41_1.webp', 1),
(85, 29, 'Saturn_AL_41_2.jpg', 'Saturn_AL_41_2.jpg', NULL),
(86, 7, 'Soloviev_D-30_1.webp', 'Soloviev_D-30_1.webp', 1),
(87, 7, 'Soloviev_D-30_2.jpg', 'Soloviev_D-30_2.jpg', NULL),
(88, 33, 'T408_1.webp', 'T408_1.webp', 1),
(89, 33, 'T408_2.webp', 'T408_2.webp', NULL),
(90, 33, 'T408_3.webp', 'T408_3.webp', NULL),
(91, 32, 'T64_1.webp', 'T64_1.webp', 1),
(92, 32, 'T64_SikorskyCH.webp', 'T64_SikorskyCH.webp', NULL),
(93, 32, 'T64_SikorskyCH2.webp', 'T64_SikorskyCH2.webp', NULL),
(94, 34, 'TP400D6_1.webp', 'TP400D6_1.webp', 1),
(95, 34, 'TP400_2.webp', 'TP400_2.webp', NULL),
(96, 34, 'TP400_3.webp', 'TP400_3.webp', NULL),
(97, 15, 'V2500_1.webp', 'V2500_1.webp', 1),
(98, 15, 'V2500_2.jpg', 'V2500_2.jpg', NULL),
(99, 15, 'V2500_3.jpg', 'V2500_3.jpg', NULL),
(100, 37, 'sgt-800_2.png', 'sgt-800_2.png', NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `szamla`
--

CREATE TABLE `szamla` (
  `tetel` int(5) NOT NULL,
  `szamlaszam` int(6) NOT NULL DEFAULT 100,
  `email` varchar(40) NOT NULL,
  `comment` text DEFAULT NULL,
  `t_id` int(4) NOT NULL,
  `tipus` varchar(40) NOT NULL,
  `egyseg_ar` float NOT NULL,
  `mennyiseg` int(3) NOT NULL,
  `ossz_ar` float NOT NULL,
  `kezbesit` varchar(20) DEFAULT NULL,
  `fizet_mod` varchar(20) DEFAULT NULL,
  `teljes_osszeg` float DEFAULT NULL,
  `created` date NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `szamla`
--

INSERT INTO `szamla` (`tetel`, `szamlaszam`, `email`, `comment`, `t_id`, `tipus`, `egyseg_ar`, `mennyiseg`, `ossz_ar`, `kezbesit`, `fizet_mod`, `teljes_osszeg`, `created`, `modified`) VALUES
(10, 101, 'geza@freemail.hu', '', 1, '﻿CF6', 5965710, 3, 17897100, 'uzletben', 'paypal', 35794200, '2022-08-28', '2022-08-28 08:28:53');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `turbina`
--

CREATE TABLE `turbina` (
  `t_id` int(4) NOT NULL,
  `nev` varchar(60) NOT NULL,
  `kat` int(4) NOT NULL,
  `toloero` varchar(30) DEFAULT NULL,
  `teljesit` varchar(30) DEFAULT NULL,
  `bpr` varchar(20) DEFAULT NULL,
  `nyomasarany` varchar(20) DEFAULT NULL,
  `hossz` varchar(20) DEFAULT NULL,
  `ventilator_atmero` varchar(20) DEFAULT NULL,
  `suly` varchar(20) DEFAULT NULL,
  `gep` text DEFAULT NULL,
  `extras` text DEFAULT NULL,
  `descript` text DEFAULT NULL,
  `felv_datum` date DEFAULT NULL,
  `modositva` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `turbina`
--

INSERT INTO `turbina` (`t_id`, `nev`, `kat`, `toloero`, `teljesit`, `bpr`, `nyomasarany`, `hossz`, `ventilator_atmero`, `suly`, `gep`, `extras`, `descript`, `felv_datum`, `modositva`) VALUES
(1, '﻿CF6', 1, '94 636 Nm', '-', '5,3:1', '34,8:1', '168 in', '114 in', '5091.57 kg', 'Boeing 747, Airbus A300', 'Alacsony nyomású turbina aktív hézagszabályozással, Digitális vezérlőegység', 'A CF6 egy kéttengelyes turbóventilátor, amely közepes és hosszú távú Airbus és Boeing szélestörzsű repülőgépeket hajt meg. A sikeres modell kategóriájában az egyik legkelendőbb motor.', '2022-08-28', NULL),
(2, 'GEnx', 1, '90 161.89 Nm', '-', '9,3:1', '44,7:1', '185 in', '111 in', '-', 'Boeing B787, Boeing B747', 'Legjobb üzemanyag-hatékonyság, legalacsonyabb károsanyag-kibocsátás, Kiváló anyagok, legkisebb súly, Alacsony zajszint', 'A GE Aviation GEnx-ét közepes kapacitású, hosszú távú repülőgépekhez tervezték. A GE90 bevált architektúrájára alapozva a GEnx a GE rendkívül sikeres CF6 sorozatának, a széles törzsű repülőgépek legkeresettebb motorcsaládjának a utódja. A motor a legújabb generációs anyagokat és tervezési eljárásokat használja a tömeg csökkentése, a teljesítmény javítása, valamint a zajszint és a karbantartási költségek csökkentése érdekében.', '2022-08-28', NULL),
(3, 'GE9X', 1, '182 086.35 Nm', '-', '10:1', '60:1', '-', '134 in', '-', 'Boeing 777', 'A bevált GE90 és GEnx architektúrára épül, Jobb üzemanyag-hatékonyság, alacsonyabb károsanyag-kibocsátás, Fejlett anyagok, kisebb súly, Alacsonyabb zajkibocsátás', 'A GE Aviation GE9X-e a Boeing új 777X hosszú távú utasszállító repülőgépének motorja. A GE9X a bevált GE90 és GEnx architektúrára épít. A motor a legfejlettebb anyagokat és technológiát alkalmazza, és új rekordokat fog felállítani a hatékonyság tekintetében: A GE9X lesz a legüzemanyag-hatékonyabb motor, amelyet a GE valaha gyártott tolóerő-kilométerenkénti alapon. A motort úgy tervezték, hogy a mai GE90-115B-hez képest körülbelül tíz százalékos üzemanyag-megtakarítást érjen el. A CO2-, NOx- és zajkibocsátás is alacsonyabb.', '2022-08-28', NULL),
(4, 'GE90-110B', 1, '155 919 Nm', '-', '9:1', '42:1', '287 in', '128 in', '8282.59 kg', 'Boeing 777', 'Aerodinamikailag optimalizált ventilátorlapátok kompozit anyagokból, titán elülső élekkel, Négyfokozatú alacsony nyomású kompresszor, Kilenc fokozatú nagynyomású kompresszor, Kétfokozatú nagynyomású turbina, Hatfokozatú kisnyomású turbina', 'A GE90 Growth a világ egyik legnagyobb és legerősebb motorja. A GE90 Growth GE90-110B és -115B változatai az exkluzív motorok a Boeing 777-es repülőgép-családjának legújabb kiegészítőihez: a 777-200 LR (Long Range), a -300 ER (Extended Range) és a -200F (Freighter)', '2022-08-28', NULL),
(5, 'GP7000', 1, '110 499 Nm', '-', '9:1', '43.9:1', '187 in', '116 in', '6078.13 kg', 'Airbus A380', 'Ötfokozatú alacsony nyomású kompresszor, Kilenc fokozatú nagynyomású kompresszor, Kétfokozatú nagynyomású turbina, Hatfokozatú kisnyomású turbina, Magas üzemanyag-hatékonyság körutazáskor, Alacsony zaj, Alacsony súly', ' A GP7000-et a hosszú távú járatokban használják, és a világ legnagyobb utasszállító repülőgépét, az Airbus A380-at hajtja. A repüléstörténet két legsikeresebb szélestörzsű motorprogramjából – a GE90 és PW4000 családból – származik. A GP7000 alacsony üzemanyag-fogyasztásával, tömegével és zajkibocsátásával lenyűgöző.', '2022-08-28', NULL),
(6, 'PW4000', 1, '132 870 Nm', '-', '6.4:1', '42.8:1', '192 in', '112 in', '7068.78 kg', 'Boeing 777-300', 'Titán üreges lapátos ventilátor, Egykristályos nagynyomású turbinalapátok, Porfém tárcsák kompresszorokhoz és turbinákhoz, Aktív hézagszabályozás az alacsony nyomású turbinában, Digitális vezérlőegység, Moduláris kialakítás', 'A 74 000 és 98 000 font közötti tolóerővel a PW4000 a világ legerősebb és legnagyobb motorjai közé tartozik. Ventilátorátmérője majdnem akkora, mint egy Boeing 737 törzsátmérője. Ez hajtja a Boeing 777-200/-200ER/-300-ast, és ez volt az első hajtómű, amely 180 perces kiterjesztett hatótávolságú, kétmotoros működési szabványokkal (ETOPS) rendelkezett.', '2022-08-28', NULL),
(7, 'Szolovjov D-30', 1, '68 000 Nm', '-', '-', '18.4:1', '4855 mm', '1050 mm', '1980 kg', 'Tupoljev–134, Iljusin–76, MiG-25', 'A D–30 egy alacsony kétáramsági fokú gázturbina.Két tengelyes, kétrészes axiálkompresszorral. A kisnyomású kompresszor ötfokozatú, a nagynyomású kompresszor tíz kompresszor-fokozattal rendelkezik. A gyűrűs égéstér mögött két darab kétfokozatú turbina található.  Turbina típusa: axiális kétfokozatú', 'A D–30 szovjet kétáramú gázturbinás sugárhajtómű. PSZ–30 (PSZ – Pavel Szolovjov) típusjelzéssel is ismert. Az OKB–19 tervezőirodában fejlesztették ki Pavel Szolovjov vezetésével, és az Aviadvigatyel Rt. részeként működő Permi Motorgyár gyártja egyes változatait. ', '2022-08-28', NULL),
(8, 'CF34', 2, '27 658.69 Nm', '-', '-', '28:1', '145 in', '57 in', '1678.29kg', 'Embraer 190, Bombardier Challenger', 'Tizennégy fokozatú nyomáskompresszor, Kétfokozatú nagynyomású turbina, Négyfokozatú alacsony nyomású turbina, Minimális kibocsátás és zaj', 'A CF34-család kategóriájában a legnépszerűbb és legkeresettebb motorcsalád. Főbb alkalmazásai az üzleti repülőgépek és az 50, 70 vagy 100 üléses regionális repülőgépek. A motor az 50 üléses gépek éllovasa. Üzembe helyezése óta több mint 140 millió repült órát teljesítettek. A CF34-10E motor jelentős teljesítménynövekedést jelent a többi CF34 motormodellhez képest. Ugyanazt az alapvető fejlesztési filozófiát és működési jellemzőket tartalmazza, amelyek kivételes piaci sikereket értek el a CF34-3 és -8 sorozatú motoroknál: alacsony kockázatú, bevált technológia, alacsony üzemeltetési költségek a nagy megbízhatóság és a könnyű karbantartás révén.', '2022-08-28', NULL),
(9, 'CFM56', 2, '46 097.81 Nm', '-', '-', '25.2:1', '93 in', '63 in', '1950 kg', 'Boeing 737, Airbus A320', 'Négyfokozatú alacsony nyomású kompresszor, Kilenc fokozatú nagynyomású kompresszor, Egyfokozatú nagynyomású turbina, Kétfokozatú alacsony nyomású turbina', ' A CFM56 hajtóművek az Airbus A320 twinjeteket, az A340-200/-300 hosszú távú szállítóeszközök első generációját, valamint a klasszikus és a következő generációs Boeing 737-eseket szerelik fel. Több mint 30 000 szállított motorral és 550 különböző vásárlóval világszerte a CFM56 a legkelendőbb motor a kereskedelmi szállítási piacon.', '2022-08-28', NULL),
(10, 'GTF', 2, '31 183.81 Nm', '-', '-', '-', '-', '73 in', '-', 'Airbus A220, Embraer E-Jets Gen2', 'A zajszőnyeg 75 százalékos csökkentése, 55 százalékos NOx-kibocsátás csökkenés a 2009-es szabványhoz (CAEP6) képest, A motor üzemeltetési költségei több mint 20 százalékkal csökkentek', 'Az új motorok kétszámjegyű javulást tesznek lehetővé az üzemanyag elégetésében, a károsanyag- és zajkibocsátásban, valamint az üzemeltetési költségekben. Fan Drive Gear System rendszerrel rendelkeznek, amely leválasztja a ventilátort az alacsony nyomású kompresszorról, valamint a ventilátort meghajtó alacsony nyomású turbináról. Ez lehetővé teszi, hogy a ventilátor alacsonyabb sebességgel, az alacsony nyomású kompresszor és a turbina pedig sokkal gyorsabban forogjon.', '2022-08-28', NULL),
(11, 'JT8D', 2, '29 421.25 Nm', '-', '1.74:1', '19.4:1', '169 in', '54 in', '2047.96 kg', 'Boeing MD-80', 'Egyfokozatú ventilátor, Hatfokozatú alacsony nyomású kompresszor, Háromfokozatú alacsony nyomású turbina, Hétfokozatú nagynyomású kompresszor, Egyfokozatú nagynyomású turbina, Továbbfejlesztett tömítőrendszerek, A nagynyomású turbina hűtése, Kipufogógáz keverő', 'A JT8D-200 a Pratt & Whitney JT8D családjának sorozata, és több mint 14 750 eladott egységgel a világ egyik legkelendőbb sugárhajtómű-családja. Ezt a sorozatot a Boeing MD-80 repülőgépcsalád használja. A szolgálatba lépés óta a teljes JT8D család több mint 673 millió repült órát repült. Ma még 2400 motor áll szolgálatban, több mint 350 kezelővel. Az E-Kit, az új égetési rendszer 25 százalékkal csökkentette a JT8D-200 nitrogén-oxid-kibocsátását, biztosítva a mindenkori környezetvédelmi előírások betartását és a sorozat további üzemeltetését.', '2022-08-28', NULL),
(12, 'LEAP-1A/-1B', 2, '47 453.63 Nm', '-', '11:1', '40:1', '131 in', '100 in', '3007.77 kg', 'Boeing 737 MAX, Airbus A320neo', 'Tízfokozatú nagynyomású kompresszor, Kétfokozatú nagynyomású turbina, Hétfokozatú alacsony nyomású turbina', 'A LEAP motorcsalád három különböző modellt tartalmaz, amelyek tolóereje 23 000 és 35 000 font között van. A LEAP hajtóművek többek között az Airbus A320neo és a Boeing 737 MAX típusú repülőgépeket szerelik fel. A CFM International, a GE és a Safran Aircraft Engines konzorciuma által gyártott motor több mint 17 500 megrendelést és kötelezettségvállalást gyűjtött össze az elkövetkező években.', '2022-08-28', NULL),
(13, 'PW2000', 2, '58 300.17 Nm', '-', '6:1', '30:1', '141 in', '79 in', '3310.77 kg', 'Boeing 757, Boeing C-17', 'Aktív hézagszabályozás, Új szárnyprofilok, Új anyagok, Új égő konfiguráció, Moduláris kialakítás, Az első kereskedelmi motor digitális motorvezérléssel (FADEC)', 'A PW2000 hajtóműveket közép- és hosszú távú kereskedelmi és katonai repülőgépeken használják.  A PW2000 az első kereskedelmi forgalomban kapható alacsony nyomású turbina, amelyet az MTU saját felelősségére fejlesztett ki.', '2022-08-28', NULL),
(14, 'PW6000', 2, '32 539.63 Nm', '-', '4.8:1', '28.2:1', '108.2 in', '56.5 in', '2288.82 kg', 'Airbus A318', 'Kéttengelyes turbóventilátoros motor a tolóerő kategóriában 18 000 - 24 000 lbf, Négyfokozatú alacsony nyomású kompresszor, Hatfokozatú nagynyomású kompresszor, Egyfokozatú nagynyomású turbina, Háromfokozatú alacsony nyomású turbina, Keverő, Alacsony életciklus-költségek', 'A PW6000-t 1999 óta a Pratt & Whitney-vel együttműködve fejlesztették és gyártják. Az MTU által kifejlesztett hatfokozatú, transzonikus nagynyomású kompresszort pedig először alkalmazzák kereskedelmi alkalmazásokban. A motor kiemelkedik nagy hatásfokával és egyszerű kialakításával. A rövid távú szolgálatra tervezett PW6000-et az Airbus A318-ban használták. A PW6000 motort a leginnovatívabb gyártási technikák és anyagok alkalmazása jellemzi, a karbantartási költségek pedig jelentősen csökkentek.', '2022-08-28', NULL),
(15, 'V2500', 2, '44 742 Nm', '-', '4.5:1', '33.4:1', '126 in', '64 in', '2467 kg', 'Airbus A319, Airbus A320, Airbus A321, Boeing MD-90, C-390 Millennium', 'kéttengelyes turbóventilátoros motor a tolóerő kategóriában 22 000 - 33 000 lbf, Por-fém turbinatárcsák, Egykristályos turbinalapátok, Aktív hézagszabályozás, Moduláris kialakítás, Digitális motorvezérlő egység', 'Az IAE V2500 egy kéttengelyes turbóventilátor, amely rövid és közepes távolságú szállításokra szolgál, és többek között az Airbus A319, A320 és A321 repülőgépeken használják. A főbb fejlesztések közé tartozik az üzemanyag elégetésének egy százalékos csökkentése és a szárnyon töltött idő 20 százalékos növekedése.', '2022-08-28', NULL),
(16, 'PW300', 3, '8 677.23 Nm', '-', '-', '-', '86 in', '47 in', '-', 'Dassault Falcon, Bombardier Learjet, Hawker Beechcraft, Gulfstream G200, Fairchild Dornier, Cessna Citation Sovereign, Cessna Citation Latitude', 'Kéttengelyes turbóventilátor-motor 4700-7000 lbf tolóerővel, Egyfokozatú ventilátor nagy szárnymagassággal, Ötfokozatú kompresszor: négy axiális fokozat, egy radiális fokozat, Változtatható bemeneti vezetőlapátok, Kétfokozatú nagynyomású turbina hűtött egykristály lapátokkal, Háromfokozatú alacsony nyomású turbina, Moduláris kialakítás, Digitális vezérlőegység (FADEC)', 'A PW300 család az alkalmazások széles skáláját kínálja az üzleti és regionális repülőgépekhez. A PW300 család motorjai kéttengelyes turbóventilátoros motorok.', '2022-08-28', NULL),
(17, 'PW500', 3, '6 101.18 Nm', '-', '4.1:1', '15.5:1', '67 in', '27 in', '373.7 kg', 'Cessna Citation Bravo, Cessna Citation Excel, General Atomics Predator', 'Kéttengelyes turbóventilátoros motor 3000-4500 lbf tolóerővel, Egyfokozatú ventilátor beépített lapátokkal, Háromfokozatú nagynyomású kompresszor két axiális fokozattal (blick) és egy radiális fokozattal, Ellentétes áramlású gyűrű alakú égéstér, Egyfokozatú nagynyomású turbina hűtött lapátokkal, Bypass burkolat a motor teljes hosszában, Hideg és meleg gázáramok keverése a keverőben, Erősítő fokozat az alacsony nyomású kompresszorban és háromfokozatú alacsony nyomású turbinában, Háromfokozatú alacsony nyomású turbina, Digitális motorvezérlés (EEC) hidromechanikus tartalékkal', 'A PW500 család motorjai kéttengelyes turbóventilátorok.', '2022-08-28', NULL),
(18, 'PW600', 3, '2 372.68 Nm', '-', '-', '-', '50 in', '18 in', '-', 'Cessna Mustang, Eclipse 500, Embraer Phenom', 'Kéttengelyes turbóventilátoros motor a tolóerő kategóriában 950 - 1750 lbf, Kétfokozatú nagynyomású kompresszor, Egyfokozatú nagynyomású turbina, Egyfokozatú kisnyomású turbina, Teljes körű digitális motorvezérlés (FADEC), Kompakt, könnyű kialakítás', 'A piac alsó részén a PW600 a 900 és 1750 font közötti tolóerő kategóriában az új, nagyon könnyű fúvókákhoz készült. A kompakt és könnyű PW600 a hagyományos turbóventilátor alkatrészeinek felével készült, ami egyszerűvé és gyors karbantartást is tesz.', '2022-08-28', NULL),
(19, 'PT6A', 4, '-', '1416.82 kW', '-', '-', '76 in', '22 in', '-', 'Beechcraft King Air, Cessna Caravan, Pilatus, Piper Meridian', 'Turbótengelyes motor 1900 LE maximális teljesítménnyel, Szabad axiális és centrifugális turbina, Három fokozatú axiális áramlású kompresszor, Egyfokozatú gázgenerátoros turbina, Egyfokozatú axiális teljesítményturbina, kétfokozatú alacsony nyomású turbina', 'A PT6 egy kivételesen könnyű turbótengelyes motor. Többek között üzleti repülőgépeken használják. A motor speciális változatai erőátviteli és katonai repülőgépeket is tartalmaznak.', '2022-08-28', NULL),
(20, 'PW100/150A', 4, '-', '3728.5 kW', '-', '-', '81 - 95 in', '31 - 44 in', '-', 'Alenia Aeronautica, Bombardier Aerospace, Dornier 328, Embraer EMB120, Fokker 60', 'Kétfokozatú teljesítményturbina, Egyfokozatú kis- és nagynyomású turbinák, Vontatófokozatú/ négyfokozatú kompresszor, Minden rotor beépített pengéjű, Elektronikus motorvezérlés vagy FADEC (Fully-Authority Digital Engine Control), modelltől függően, Fejlett anyagok és hűtési technológia', 'A PW100 turbólégcsavaros hajtóművek családja 30-90 utas befogadására alkalmas regionális repülőgépeket hajt meg, hatótávolsága 750 mérföld. A motorok kiemelkedő megbízhatóságot, nagy hatásfokot és hosszú élettartamot kínálnak. Sokoldalúságuknak köszönhetően számos alkalmazási területen használhatók. Amióta a család 1984-ben szolgálatba állt, a motorok több mint 100 millió repült órát halmoztak fel.', '2022-08-28', NULL),
(21, 'PW200', 5, '-', '522 kW', '-', '8:1', '36 - 41in', '22 in', '-', 'Airbus Helicopters, Bell 427', 'Turbótengelyes motor 700 LE maximális teljesítménnyel, Ingyenes, egyfokozatú teljesítményturbina, Egyfokozatú centrifugális kompresszor titán-alumínium ötvözetből, Nagy sebességű egyfokozatú gázgenerátoros turbina', 'A kanadai Pratt & Whitney PW200 könnyű és közepes tömegű helikoptereket hajt meg. Többek között az egyszerű és robusztus kialakítás jellemzi, amely centrifugális kompresszorral, fordított áramlású égetővel és egyfokozatú turbinával rendelkezik. A motor teljes körű digitális motorvezérlő egységgel büszkélkedhet.', '2022-08-28', NULL),
(22, 'PW210', 5, '-', '745.7 kW', '-', '-', '43 in', '24 in', '-', 'Leonardo Helicopters, Sikorsky S-76D', 'Kéttengelyű turbóventilátor a tolóerő kategóriában 1.000 lóerő, Szabad teljesítményű turbina, Egyfokozatú nagynyomású turbina, FADEC (Dual Channel Full Authority Digital Engine Control)', 'A PW210 flotta több mint 360 000 repült órával rendelkezik, és ez a mérce a kétmotoros helikopterek új generációjának középkategóriás helikopterei számára. A sok fejlett technológia egyike, a motor segéderőegységként is működik, elektromos, hűtési és fűtési rendszereket táplál, miközben a repülőgép a földön van egy lezárt vagy kikapcsolt főrotorral. Az 1000 tengelyes lóerős PW210-es koncepció egyszerű, mindössze öt fő forgó alkatrésze és moduláris felépítése teszi lehetővé az egyszerű karbantartást.', '2022-08-28', NULL),
(23, 'PT6T', 5, '-', '1491.4 kW', '-', '-', '66 in', '23–25 in', '-', 'Augusta Bell Modell, Bell CFUTTH, Sikorsky S', 'Turbótengelyes motor 2000 LE maximális teljesítménnyel, Többfokozatú axiális kompresszor, Egyfokozatú centrifugális kompresszor, Szabad teljesítményű turbina, Fordított áramlású égető', 'A PT6 turbótengelyes motorokat egy- és kétmotoros helikopterek meghajtására tervezték. Az 1000-2000 lóerős osztályba tartozó motorok nagy népszerűségnek örvendenek, köszönhetően megbízhatóságuknak és tartósságuknak. Az új PT6C sorozatú motorok, mint például a PT6C-67, Full-Authority Digital Engine Control (FADEC) rendszerrel rendelkeznek.', '2022-08-28', NULL),
(24, 'Klimov_RD-33', 6, '81 300 Nm', '-', '0,49:1', '21:1', '4229 mm', '1040 mm', '1055 kg', 'Mikoyan MiG-29, MiG-33, MiG-35, Shenyang FC-31', 'Kompresszor: 2 orsó axiális -4 alacsony nyomású fokozat -9 nagynyomású fokozat, Égők : gyűrű alakú égőtér, Turbina : egyfokozatú nagynyomás - egyfokozatú alacsony nyomás', 'A Klimov RD-33 egy turbóventilátoros sugárhajtómű könnyű vadászrepülőgépekhez, amely a Mikoyan MiG-29 és a CAC/PAC JF-17 Thunder elsődleges motorja. A MiG-29 későbbi vagy továbbfejlesztett régi változatain, mint például a MiG-29M és a MiG-29SMT, átdolgozott modell hosszabb élettartammal.', '2022-08-28', NULL),
(25, 'EJ200', 6, '27116.36 Nm', '-', '0,4:1', '26:1', '157 in', '29 in', '999.71 kg', 'Eurofighter / Typhoon', 'Kéttengelyes turbóventilátoros motor utóégetővel a tolóerő kategóriában 20 000 lbf, Moduláris felépítés (15 teljesen cserélhető modul), Alacsony nyomású kompresszorok 3 fokozatú blisk kivitelben, Nagynyomású kompresszorok 5 fokozattal, részben bliszk kivitelben (3 fokozatú blisk, 2 fokozatú hagyományos), Egykristályos turbinalapátok, Konvergens/divergens fúvóka, Digitális vezérlés integrált állapotfigyeléssel és életciklus-figyeléssel', 'Ezt a fejlett, 20 000 font erejű, tolóerő-osztályú motort használják az Eurofighter és exportváltozata, a Typhoon meghajtására.', '2022-08-28', NULL),
(26, 'F110', 6, '39 318.72 Nm', '-', '0.76:1', '30.7:1', '182 in', '47 in', '1805.3 kg', 'Lockheed Martin F-16, Boeing F-15', 'Kéttengelyes turbóventilátoros motor utóégetővel a tolóerő kategóriában 29 000 lbf, Konvergens/divergens fúvóka, Digitális vezérlőegység, Állapotban végzett karbantartás', 'Az F110 az Egyesült Államok légierejének egyik legsikeresebb vadászgépének bizonyult. történelmét, és olyan kiválósági rekordot hozott létre, amelyhez kategóriájában egyetlen motor sem fér hozzá. Az F110-GE-129 a Boeing F-15 és a Lockheed Martin F-16 vadászrepülőgépeket hajtja meg.', '2022-08-28', NULL),
(27, 'F414', 6, '29 828 Nm', '-', '0.25:1', '30:1', '154 in', '35 in', '1111.3 kg', 'F414-GE, F414-INS6', 'Kéttengelyes turbóventilátoros motor utóégetővel a tolóerő kategóriában: 22 000 lbf, Por-fém turbinatárcsák, Egykristályos turbinalapátok, Konvergens/divergens fúvóka, Moduláris kialakítás, Digitális vezérlőegység', 'Az F414 a GE F404 továbbfejlesztett változata. A fejlett technológiát ötvözi sikeres elődje, az F404 bizonyított megbízhatóságával, karbantarthatóságával és működőképességével, miközben 35 százalékkal nagyobb tolóerőt biztosít. Az F414-et többek között a Boeing F/A-18 Super Hornet ikersugárzós vadászgépében és annak E/A-18G Growler elektronikus hadviselési változatában használják.', '2022-08-28', NULL),
(28, 'Larzac 04', 6, '4067.45 Nm', '-', '1:1.04', '11.1:1', '47 in', '30 in', '294.83 kg', 'Dornier-Dassault Alpha Jet', 'Kéttengelyes turbóventilátoros motor 3000 lbf tolóerővel, Teljesen automatikus vezérlőegység, Moduláris kialakítás', 'A Larzac 04-et, egy kéttengelyes turbóventilátoros motort 1969 és 1973 között fejlesztették ki, A Larzac 04 hajtja az Alpha Jet kiképzőgépet és könnyű vadászrepülőgépet. Az Alpha Jet még mindig szolgálatban van Franciaországban és tizenkét másik országban.', '2022-08-28', NULL),
(29, 'Izdeliye 117 Saturn', 6, '176 000 Nm', '-', '0.56:1', '23:1', '4942 mm', '932 mm', '1,604 kg', 'Szu-35S, Szu-57, MC-21', 'Kéttengelyes utóégető turbóventilátor, Axiális, 4 fokozatú ventilátor, 9 fokozatú kompresszor, 2db egyfokozatú turbina', 'Az „Изделие 30” ötödik generációs hajtómű a PAK FA Szu-57-es vadászgép számára készült. Ez az első orosz fejlesztésű hajtómű, amely alacsony észlelhetőségű, teljesen digitalizált, automatikus üzemmód szabályozással (FADEC) ellátott vezérlőrendszerrel készült orosz alkatrészekből. A tesztek során bizonyítást nyert, hogy a hajtómű teljesíti a harci repülőgépek hajtóműveire vonatkozó követelményeket. Az új turbinának javultak az áramlási jellemzői, mindazonáltal a megadott követelményeket jelentősen megnövekedett tolóerővel teljesítik és rendelkeznek teljesítmény tartalékkal.', '2022-08-28', NULL),
(30, 'RB199', 6, '23 048.91 Nm', '-', '1:1.3', '23:1', '126 in', '34 in', '1084 kg', 'Panavia Tornado', 'Háromtengelyes turbóventilátoros motor utóégetővel, 16 000 – 17 000 lbf tolóerő kategóriában, Integrált tolóerő irányváltó, Egykristályos turbinalapátok, Moduláris kialakítás, Digitális motorvezérlő egység', 'A Panavia Tornado volt a legnagyobb és legsikeresebb katonai repülőgép-program Európában az 1970-es és 1980-as években. Az összesen 2504 leszállított példány után a motor azóta több mint hétmillió repült órát halmozott fel. Az utóégetővel és a tolóerő irányváltóval ellátott háromtengelyes kialakítást úgy választották, hogy megfeleljen a Tornado sokrétű küldetési követelményeinek, különösen az extrém alacsony magasságú küldetéseknél. Az RB199 az egyetlen katonai motor a világon, amely integrált tolóerő irányváltóval rendelkezik.', '2022-08-28', NULL),
(31, 'MTR390', 7, '-', '1094 kW', '-', '14:1', '42.4 in', '26.85 in', '179.16 kg', 'Airbus Helicopters Tiger', 'Turbótengelyes motor két teljesítményváltozattal: MTR390-2C 1285 LE maximális teljesítménnyel', ' MTR390-E 1467 lóerő maximális teljesítménnyel, Szabad teljesítményű turbina, Moduláris kialakítás, Digitális vezérlő és felügyeleti rendszer', '2022-08-28', NULL),
(32, 'T64', 7, '-', '3228.88 kW', '-', '14:1', '79 in', '20 in', '327 kg', 'Sikorsky CH-53G', 'Turbótengelyes motor 4330 LE maximális teljesítménnyel, Egytengelyes kialakítás, Tizennégy fokozatú nagynyomású kompresszor, Változtatható bemeneti vezetőlapátok és vezetőlapátok az 1-től 4-ig, Gyűrűs égéskamra, Kétfokozatú gázgenerátor turbina, Kétfokozatú teljesítményturbina', 'A T64 egy turbótengelyes motor közepes méretű szállítóhelikoptereken alkalmazzák, mint például a Sikorsky CH-53.', '2022-08-28', NULL),
(33, 'T408', 7, '-', '5600 kW', '-', '-', '1460 mm', '685 mm', '-', 'Sikorsky CH-53K', 'Turbótengelyes motor 7500 LE maximális teljesítménnyel, Ötfokozatú axiális kompresszor, egyfokozatú centrifugális kompresszor, Gyűrűs égőtér, Kétfokozatú gázgenerátor turbina, Háromfokozatú szabad teljesítményű turbina, FADEC (Full Authority Digital Electronic Control) állapotfigyelő funkciókkal', 'A T408 egy turbótengelyes motor, amelyet eddig az amerikai tengerészgyalogság Sikorsky CH-53K nehézszállító helikopterébe szereltek be. Az úgynevezett \"King Stallion\"-t három-három motorral szerelik fel.', '2022-08-28', NULL),
(34, 'TP400-D6', 8, '-', '8200 kW', '-', '25:1', '3 500 mm', '5 330 mm', '1 900 kg', 'Airbus A400M', 'Háromtengelyes turbólégcsavar 8200 kW teljesítménnyel, A legerősebb nyugati turbópropeller, Alacsony felhasználási költségek, Polgári EASA jóváhagyás, moduláris felépítés, Alkatrészek élettartama a polgári szabványoknak megfelelően', 'A TP400-D6 hajtja az Airbus A400M katonai szállítóeszközt, amely 2009 végén fejezte be első repülését a spanyolországi Sevillában. A TP400-D6 2013 végén állt szolgálatba a francia légierőnél., Az A400M egyedi követelményeinek teljesítése érdekében a TP400-D6 fejlett aerodinamikai és alkatrész-kialakítással, alacsony üzemanyag-égetéssel és tömeggel, hatékonysággal rendelkezik a kiterjesztett alacsony szintrepüléstől a nagysebességű körutazásig, valamint az integrált motor- és légcsavarvezérlésig.', '2022-08-28', NULL),
(35, 'LM2500', 9, '-', '36,98 MW', '-', '-', '-', '-', '-', 'Áramtermelés,  Mechanikus hajtásrendszerek / olaj- és gázelszívás,  Kombinált hő és energia (\"Cogen\")', 'Egytengelyes gázgenerátor szabad teljesítményű turbinával, Teljesítményturbina fordulatszáma: 3.600 rpm', 'Az LM2500™ egy GE ipari gázturbina, amely a CF6-6 repülőgép-hajtóműből származik., Az LM2500™ egy tizenhat fokozatú kompresszorból, egy teljesen gyűrű alakú égőtérből, egy kétfokozatú nagynyomású turbinából és egy nagy hatásfokú teljesítményturbinából áll. Az LM2500™ gázturbina a legnépszerűbb repülőgép-származék a 20-25 MW-os osztályban.', '2022-08-28', NULL),
(36, 'LM6000', 9, '-', '57.1 MW', '-', '-', '-', '-', '-', 'Áramtermelés, Mechanikus hajtás (pl. szivattyúk)', 'Kéttengelyes kivitel közvetlen hajtással, külön erőturbina nélkül, a LM6000 -egy ötfokozatú alacsony nyomású kompresszorból (LPC), -egy 14 fokozatú nagynyomású kompresszorból (HPC), -egy gyűrű alakú égetőből, -egy kétfokozatú nagynyomású turbinából (HPT) és -egy ötfokozatú alacsony nyomású kompresszorból áll.', 'Az LM6000 ipari gázturbina a GE CF6-80 repülőgépmotorjából származik. Ezt az ipari gázturbinát elsősorban energiatermelési alkalmazásokhoz használják, de közvetlen mechanikus hajtásként is használják, például szivattyúk teljesítményéhez.', '2022-08-28', NULL),
(37, 'SGT-800', 9, '-', '62.5 MW', '-', '21.1 : 1', '-', '-', '-', 'Megfelel a hatékonyság, a megbízhatóság és a környezetbarát kompatibilitás követelményeinek, alacsony életciklus-költségeket és a lehető legjobb befektetési megtérülést kínálja. Rugalmas működésre tervezve, kiválóan alkalmas alap- és közbenső terhelésre.', 'Az egytengelyes motor egy 2 csapágyas forgórészből áll, 15 fokozatú kompresszorral és egy 3 fokozatú turbinával.', 'Az SGT-800 ipari gázturbina az egyszerű, robusztus kialakítást egyesíti a nagy megbízhatóság és az egyszerű karbantartás, valamint a nagy hatékonyság és az alacsony károsanyag-kibocsátás érdekében. Az SGT-800 egymást követő fejlesztése, amely a telepített flotta tapasztalatain és a bevált tervezési megoldásokon alapul, biztosítja, hogy Ön az optimális teljesítményt és élettartamot hozza ki gázturbinájából.', '2022-08-28', NULL);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `arak`
--
ALTER TABLE `arak`
  ADD PRIMARY KEY (`ar_id`),
  ADD KEY `t_id` (`t_id`);

--
-- A tábla indexei `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`kat_id`);

--
-- A tábla indexei `felhasznalo`
--
ALTER TABLE `felhasznalo`
  ADD PRIMARY KEY (`felhasznalo_id`),
  ADD KEY `email` (`email`);

--
-- A tábla indexei `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`kep_id`),
  ADD KEY `t_id` (`t_id`);

--
-- A tábla indexei `szamla`
--
ALTER TABLE `szamla`
  ADD PRIMARY KEY (`tetel`),
  ADD KEY `email` (`email`);

--
-- A tábla indexei `turbina`
--
ALTER TABLE `turbina`
  ADD PRIMARY KEY (`t_id`),
  ADD KEY `kat` (`kat`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `arak`
--
ALTER TABLE `arak`
  MODIFY `ar_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT a táblához `category`
--
ALTER TABLE `category`
  MODIFY `kat_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT a táblához `felhasznalo`
--
ALTER TABLE `felhasznalo`
  MODIFY `felhasznalo_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `images`
--
ALTER TABLE `images`
  MODIFY `kep_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT a táblához `szamla`
--
ALTER TABLE `szamla`
  MODIFY `tetel` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT a táblához `turbina`
--
ALTER TABLE `turbina`
  MODIFY `t_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `arak`
--
ALTER TABLE `arak`
  ADD CONSTRAINT `arak_ibfk_1` FOREIGN KEY (`t_id`) REFERENCES `turbina` (`t_id`);

--
-- Megkötések a táblához `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`t_id`) REFERENCES `turbina` (`t_id`);

--
-- Megkötések a táblához `szamla`
--
ALTER TABLE `szamla`
  ADD CONSTRAINT `szamla_ibfk_1` FOREIGN KEY (`email`) REFERENCES `felhasznalo` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
