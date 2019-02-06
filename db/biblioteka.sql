-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 06 Lut 2019, 11:02
-- Wersja serwera: 10.1.26-MariaDB
-- Wersja PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `biblioteka`
--

DELIMITER $$
--
-- Procedury
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `bibliotekarz_S` (`bibliotekarz_idS` INT(11))  BEGIN
SELECT * FROM biblioteka.bibliotekarze WHERE bibliotekarz_id = bibliotekarz_idS;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `bibliotekarz_Sczytelnik` (`id_czytelnikS` INT(11))  BEGIN
SELECT * FROM biblioteka.czytelnik WHERE id_czytelnik = id_czytelnikS;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `bibliotekarz_Sksiazka` (`id_ksiazkaS` INT(11))  BEGIN
SELECT * FROM biblioteka.ksiazka WHERE id_ksiazka = id_ksiazkaS;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `bibliotekarz_wypozyczenia` ()  BEGIN
SELECT * FROM `wypozyczenia_razem_view`;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `bibliotekarz_zamowienia` ()  BEGIN
SELECT * FROM `zamowienie_razem_view`;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `czytelnik_dodajIczytelnik` (`imie_czytelnikI` VARCHAR(100), `nazwisko_czytelnikI` VARCHAR(100), `email_czytelnikI` VARCHAR(100), `adres_czytelnikI` VARCHAR(200), `loginI` VARCHAR(50))  BEGIN
INSERT INTO biblioteka.czytelnik (imie_czytelnik, nazwisko_czytelnik, email_czytelnik, adres_czytelnik, login) VALUES (imie_czytelnikI, nazwisko_czytelnikI, email_czytelnikI , adres_czytelnikI, loginI);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `czytelnik_dodajSczytelnik` (IN `nazwisko_czytelnikS` VARCHAR(100), IN `imie_czytelnikS` VARCHAR(100), IN `adres_czytelnikS` VARCHAR(200), IN `loginS` VARCHAR(100))  BEGIN
SELECT * FROM czytelnik WHERE nazwisko_czytelnik = nazwisko_czytelnikS AND imie_czytelnik = imie_czytelnikS AND adres_czytelnik = adres_czytelnikS AND login = loginS;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `czytelnik_dodajSLogin` (`loginS` VARCHAR(30))  BEGIN
SELECT * FROM logowanie WHERE login = loginS;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `czytelnik_S` (IN `loginS` VARCHAR(100))  BEGIN
SELECT * FROM biblioteka.czytelnik WHERE login = loginS;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `czytelnik_Sksiazka` (`id_ksiazkaS` INT(11))  BEGIN
SELECT * FROM biblioteka.ksiazka WHERE id_ksiazka = id_ksiazkaS;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `czytelnik_Swypozyczenia` (`id_czytelnikS` INT(11))  BEGIN
SELECT * FROM biblioteka.wypozyczenia WHERE id_czytelnik = id_czytelnikS;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `czytelnik_Szamowienie` (`id_czytelnikS` INT(11))  BEGIN
SELECT * FROM biblioteka.zamowienie WHERE id_czytelnik = id_czytelnikS;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `czytelnik_S_aktywny` (IN `loginS` VARCHAR(100))  BEGIN
    SELECT * FROM czytelnik WHERE login = loginS;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `konto_aktualizujU` (IN `imie_czytelnikU` VARCHAR(100), IN `nazwisko_czytelnikU` VARCHAR(100), IN `adres_czytelnikU` VARCHAR(200), IN `email_czytelnikU` VARCHAR(100), IN `loginU` VARCHAR(100))  BEGIN
UPDATE biblioteka.czytelnik SET imie_czytelnik = imie_czytelnikU, nazwisko_czytelnik = nazwisko_czytelnikU, adres_czytelnik = adres_czytelnikU, email_czytelnik = email_czytelnikU WHERE login = loginU;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ksiazka_dodajI` (IN `tytulI` VARCHAR(200), IN `autorI` VARCHAR(70), IN `isbnI` VARCHAR(13), IN `wydawnictwoI` VARCHAR(50), IN `opisI` TEXT, IN `stronI` INT(4), IN `rok_wydaniaI` INT(4), IN `id_kategoriaI` INT(4), IN `keywordsI` VARCHAR(200))  BEGIN
INSERT INTO `ksiazka` (`id_ksiazka`, `id_kategoria`, `isbn`, `tytul`, `autor`, `stron`, `wydawnictwo`, `rok_wydania`, `opis`, `keywords`, `dostepnosc`) VALUES (NULL, id_kategoriaI, isbnI, tytulI, autorI, stronI, wydawnictwoI, rok_wydaniaI, opisI, keywordsI, '');
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ksiazka_kategoria` ()  BEGIN
SELECT * FROM kategoria_view;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `przedluz_Iwypozyczenia` (`id_ksiazkaI` INT(11))  BEGIN
INSERT INTO biblioteka.wypozyczeniaa (id_ksiazka, data_zwrotu) VALUES (id_ksiazkaI, NOW() );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `przedluz_Swypozyczenia` (`id_ksiazkaS` INT(11))  BEGIN
SELECT * FROM biblioteka.wypozyczenia WHERE id_ksiazka = id_ksiazkaS;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `przedluz_Uwypozyczenia` (`id_ksiazkaI` INT(11), `data_zwrotuI` DATETIME)  BEGIN
UPDATE biblioteka.wypozyczenia SET data_zwrotu = data_zwrotuI WHERE id_ksiazka = id_ksiazkaI;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rejestracja_dodajIuser` (`loginI` VARCHAR(30), `passwordI` VARCHAR(30))  BEGIN
INSERT INTO biblioteka.logowanie (login, password) VALUES (loginI, passwordI);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usun_czytelnikaD` (IN `loginD` VARCHAR(50))  BEGIN
DELETE FROM biblioteka.czytelnik WHERE login = loginD;
DELETE FROM biblioteka.logowanie WHERE login = loginD;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `wypozyczeniaS` ()  BEGIN
SELECT * FROM biblioteka.wypozyczenia;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `wypozycz_Iwypozyczenia` (IN `id_czytelnikI` INT(11), IN `id_ksiazkaI` INT(11), IN `data_zwrotuI` DATETIME)  BEGIN
INSERT INTO biblioteka.wypozyczenia (id_czytelnik, id_ksiazka, data_wypozyczenia, data_zwrotu) VALUES (id_czytelnikI, id_ksiazkaI, NOW(), data_zwrotuI );
DELETE FROM biblioteka.zamowienie WHERE id_ksiazka = id_ksiazkaI;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `wypozycz_Szamowienie` (IN `id_ksiazkaS` INT(11), IN `id_czytelnikS` INT(11))  BEGIN
SELECT * FROM biblioteka.zamowienie WHERE id_ksiazka = id_ksiazkaS AND id_czytelnik = id_czytelnikS;
SELECT * FROM biblioteka.wypozyczenia WHERE id_ksiazka = id_ksiazkaS AND id_czytelnik = id_czytelnikS;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `wyszukajAutor` (IN `autorW` VARCHAR(70))  BEGIN
SELECT * FROM biblioteka.ksiazka WHERE autor LIKE CONCAT('%',autorW,'%');
-- SELECT * FROM biblioteka.ksiazka  WHERE autor = autorW;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `wyszukajKategoria` (`id_kategoriaW` INT(11))  BEGIN
SELECT * FROM biblioteka.kategoria WHERE id_kategoria = id_kategoriaW;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `wyszukajKeywords` (IN `keywordsW` VARCHAR(200))  BEGIN
SELECT * FROM biblioteka.ksiazka WHERE keywords  LIKE CONCAT('%',keywordsW,'%');
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `wyszukajRok` (`rokW` INT(4))  BEGIN
SELECT * FROM biblioteka.ksiazka WHERE rok_wydania = rokW;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `wyszukajTytul` (IN `tytulW` VARCHAR(200))  BEGIN
SELECT * FROM biblioteka.ksiazka WHERE tytul  LIKE CONCAT('%',tytulW,'%');
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `zamowienieS` ()  BEGIN
SELECT * FROM biblioteka.zamowienie;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `zamowienie_dodajI` (IN `id_czytelnikI` INT(11), IN `id_ksiazkaI` INT(11), IN `data_odbioruI` DATE)  BEGIN
INSERT INTO biblioteka.zamowienie (id_czytelnik, id_ksiazka, data_zamowienia, data_odbioru) VALUES (id_czytelnikI, id_ksiazkaI, NOW(), DATE_ADD( NOW(), INTERVAL 30 MINUTE));
-- INSERT INTO biblioteka.zamowienie (id_czytelnik, id_ksiazka, data_zamowienia, data_odbioru) VALUES (id_czytelnikI, id_ksiazkaI, NOW(), data_odbioruI);
UPDATE biblioteka.ksiazka SET dostepnosc = 'Nie' WHERE id_ksiazka = id_ksiazkaI;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `zamowienie_dodajSk_dostepnosc` (`id_ksiazkaS` INT(11))  BEGIN
SELECT dostepnosc FROM biblioteka.ksiazka WHERE id_ksiazka = id_ksiazkaS;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `zam_rezygnujD` (IN `id_ksiazkaD` INT(11))  BEGIN
DELETE FROM biblioteka.zamowienie WHERE id_ksiazka = id_ksiazkaD;
UPDATE biblioteka.ksiazka SET dostepnosc = 'Tak' WHERE id_ksiazka = id_ksiazkaD;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `zam_rezygnujS` (`id_ksiazkaS` INT(11))  BEGIN
SELECT * FROM biblioteka.zamowienie WHERE id_ksiazka = id_ksiazkaS;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `zwrot_D` (`id_ksiazkaD` INT(11))  BEGIN
DELETE FROM biblioteka.wypozyczenia WHERE id_ksiazka = id_ksiazkaD;
UPDATE biblioteka.ksiazka SET dostepnosc = 'Tak' WHERE id_ksiazka = id_ksiazkaD;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL COMMENT 'Klucz główny przydzielony automatycznie',
  `login` varchar(50) COLLATE utf8_polish_ci NOT NULL COMMENT 'Nazwa administratora potrzebna przy logowaniu',
  `haslo` varchar(50) COLLATE utf8_polish_ci NOT NULL COMMENT 'Hasło niezaszyfrowane'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci COMMENT='Posiada informacje o administratorach zarejestrowanych w programie.';

--
-- Zrzut danych tabeli `admin`
--

INSERT INTO `admin` (`id_admin`, `login`, `haslo`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `bibliotekarze`
--

CREATE TABLE `bibliotekarze` (
  `id_bibliotekarz` int(11) NOT NULL,
  `bibliotekarz_imie` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `bibliotekarz_nazwisko` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `bibliotekarz_ulica` varchar(100) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `bibliotekarz_miasto` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `bibliotekarz_kod` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `bibliotekarz_email` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `bibliotekarz_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `bibliotekarze`
--

INSERT INTO `bibliotekarze` (`id_bibliotekarz`, `bibliotekarz_imie`, `bibliotekarz_nazwisko`, `bibliotekarz_ulica`, `bibliotekarz_miasto`, `bibliotekarz_kod`, `bibliotekarz_email`, `bibliotekarz_id`) VALUES
(1, 'Anna', 'Halasz', 'Zielona 12/3', 'Londek Zdroj', '63-125', 'anna_halasz@biblioteka.pl', 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `czytelnik`
--

CREATE TABLE `czytelnik` (
  `id_czytelnik` int(11) NOT NULL COMMENT 'Klucz główny przydzielony automatycznie',
  `login` varchar(50) COLLATE utf8_polish_ci NOT NULL COMMENT 'Nazwa czytelnika potrzeba przy logowaniu.',
  `imie_czytelnik` varchar(100) COLLATE utf8_polish_ci NOT NULL COMMENT 'Imię ',
  `nazwisko_czytelnik` varchar(100) COLLATE utf8_polish_ci NOT NULL COMMENT 'Nazwisko',
  `adres_czytelnik` varchar(200) COLLATE utf8_polish_ci NOT NULL COMMENT 'Adres zamieszkania np.: ul. Przykład 3/12',
  `telefon_czytelnik` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL COMMENT 'Telefony',
  `email_czytelnik` varchar(100) COLLATE utf8_polish_ci NOT NULL COMMENT 'Adres e-mail',
  `konto_aktywne` varchar(100) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci COMMENT='Posiada informacje o czytelnikach zarejestrowanych w programie.';

--
-- Zrzut danych tabeli `czytelnik`
--

INSERT INTO `czytelnik` (`id_czytelnik`, `login`, `imie_czytelnik`, `nazwisko_czytelnik`, `adres_czytelnik`, `telefon_czytelnik`, `email_czytelnik`, `konto_aktywne`) VALUES
(1, 'czytelnik_1', 'Piotr', 'Klimek', 'ul. Przykład 4/ 12', NULL, 'przyklad_1@wiedzanaplus.pl', 'Tak'),
(2, 'czytelnik_2', 'Patryk', 'Klimek', 'ul. Przykład 10/301', NULL, 'przyklad_pl@poczta.pl', 'Tak'),
(7, 'user', 'Jan', 'Kowalski', 'Zielona 43/1', NULL, 'jan.kowalski@poczta.pl', 'Nie'),
(8, 'user2', 'Adaś', 'Niezgódka', 'Kawowa 21/7', NULL, 'adas.niezgodka@poczta.pl', 'Tak'),
(9, 'user3', 'Grzegorz', 'Grągowski', 'Górzysta 21', NULL, 'gg@ggpoczta.com', 'Tak'),
(10, 'user4', 'Michał', 'Więckowski', 'Bąbelkowa 4/12', NULL, 'm.w@poczta.pl', 'Tak'),
(12, 'userT', 'John', 'Bigboss', 'ul Ruda', NULL, 'john.bigboss@poczta.pl', 'Tak'),
(13, 'user5', 'Mikołaj', 'Brzęszczykiewicz', 'Lipna 34/45a', NULL, 'mikolajb@poczta.pl', 'Tak'),
(14, 'user6', 'Ewa', 'Spięta', 'Niepodległośći', NULL, 'ewa_spieta@mail.com', 'Tak');

--
-- Wyzwalacze `czytelnik`
--
DELIMITER $$
CREATE TRIGGER `czytelnik_dodaj_trigger` BEFORE INSERT ON `czytelnik` FOR EACH ROW BEGIN 
set @aktywny = 'Tak'; 
SET NEW.konto_aktywne = @aktywny; 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategoria`
--

CREATE TABLE `kategoria` (
  `id_kategoria` int(11) NOT NULL COMMENT 'Klucz główny przydzielony automatycznie',
  `nazwa` varchar(200) COLLATE utf8_polish_ci NOT NULL COMMENT 'Nazwa kategorii'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci COMMENT='Tabela zawierająca wszystkie kategorie książek w systemie.';

--
-- Zrzut danych tabeli `kategoria`
--

INSERT INTO `kategoria` (`id_kategoria`, `nazwa`) VALUES
(1, 'Brak kategorii'),
(2, 'Poradniki'),
(3, 'Programowanie'),
(4, 'Programowanie mobilne'),
(5, 'Webmasterstwo'),
(6, 'Systemy operacyjne'),
(7, 'literatura faktu'),
(8, 'fantastyka'),
(9, 'literatura specjalistyczna'),
(10, 'fantasy'),
(11, 'biografia'),
(12, 'socjologia'),
(13, 'filozofia'),
(14, 'biznes, ekonomia'),
(15, 'dramat'),
(16, 'historia'),
(17, 'kino i teatr'),
(18, 'klasyka'),
(19, 'Literatura piękna');

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `kategoria_view`
-- (See below for the actual view)
--
CREATE TABLE `kategoria_view` (
`id_kategoria` int(11)
,`nazwa` varchar(200)
);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ksiazka`
--

CREATE TABLE `ksiazka` (
  `id_ksiazka` int(11) NOT NULL COMMENT 'Klucz główny przydzielony automatycznie',
  `id_kategoria` int(11) NOT NULL COMMENT 'Klucz obcy z tabeli kategoria',
  `isbn` varchar(13) COLLATE utf8_polish_ci NOT NULL COMMENT 'Niepowtarzalny 13-cyfrowy identyfikator książki',
  `tytul` varchar(200) COLLATE utf8_polish_ci NOT NULL COMMENT 'Tytuł książki',
  `autor` varchar(70) COLLATE utf8_polish_ci NOT NULL COMMENT 'Imię i Nazwisko autora książki',
  `stron` int(4) NOT NULL COMMENT 'Liczba stron książki',
  `wydawnictwo` varchar(50) COLLATE utf8_polish_ci NOT NULL COMMENT 'Nazwa wydawnictwa, w którym wydano książkę',
  `rok_wydania` int(4) NOT NULL COMMENT 'Rok wydania książki',
  `opis` text COLLATE utf8_polish_ci COMMENT 'Opis książki',
  `keywords` varchar(200) COLLATE utf8_polish_ci NOT NULL,
  `dostepnosc` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `prolongata` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci COMMENT='Wszystkie książki dodane do bazy danych.';

--
-- Zrzut danych tabeli `ksiazka`
--

INSERT INTO `ksiazka` (`id_ksiazka`, `id_kategoria`, `isbn`, `tytul`, `autor`, `stron`, `wydawnictwo`, `rok_wydania`, `opis`, `keywords`, `dostepnosc`, `prolongata`) VALUES
(1, 3, '9788324631773', 'PHP i MySQL. Tworzenie stron WWW. Vademecum profesjonalisty. Wydanie czwarte', 'Luke Welling, Laura Thomson', 856, 'Helion', 2009, 'Czwarte wydanie bestsellerowego podręcznika dla webmasterów wykorzystujących w swojej pracy funkcjonalność języka PHP i bazy danych MySQL.', '', 'Tak', 0),
(2, 3, '9788324685301', 'Język C++. Kompendium wiedzy', 'Bjarne Stroustrup', 1296, 'Helion', 2014, NULL, '', 'Tak', 0),
(3, 3, '9788324675340', 'Mistrz czystego kodu. Kodeks postępowania profesjonalnych programistów', 'Robert C. Martin', 216, 'Helion', 2013, NULL, '', 'Nie', 0),
(4, 6, '9788324690138', 'Kali Linux. Testy penetracyjne', 'Joseph Muniz, Aamir Lakhani', 336, 'Helion', 2014, NULL, '', 'Nie', 0),
(5, 3, '9788324621880', 'Czysty kod. Podręcznik dobrego programisty', 'Robert C. Martin', 424, 'Helion', 2010, NULL, '', 'Nie', 0),
(6, 3, '9788324632374', 'Pragmatyczny programista. Od czeladnika do mistrza', 'Andrew Hunt, David Thomas', 332, 'Helion', 2011, NULL, '', 'Tak', 0),
(7, 3, '9788324683178', 'Praca z zastanym kodem. Najlepsze techniki', 'Michael Feathers', 440, 'Helion', 2014, NULL, '', 'Nie', 0),
(8, 5, '9788324685042', 'Tajemnice JavaScriptu. Podręcznik ninja', 'John Resig, Bear Bibeault', 432, 'Helion', 2014, NULL, 'JavaScript', 'Nie', 0),
(9, 3, '9788324689361', 'Java EE 6. Tworzenie aplikacji w NetBeans 7', 'David R. Heffelfinger', 352, 'Helion', 2014, NULL, '', 'Tak', 0),
(10, 5, '9788324666676', 'Projektowanie stron internetowych. Przewodnik dla początkujących webmasterów po HTML5, CSS3 i grafice. Wydanie IV', 'Jennifer Niederst Robbins', 600, 'Helion', 2014, 'Tworzenie stron internetowych dla początkujących i średnio zaawansowanych.', 'webmastering', 'Nie', 0),
(13, 18, '9827127483214', 'Ogniem i mieczem', 'Henryk Sienkiewicz', 378, 'Polska Klasyka', 2007, NULL, '', 'Nie', 0),
(18, 18, '9283728148231', 'Pan Tadeusz', 'Adam Mickiewicz', 357, 'Polska Klasyka', 2007, 'Wielkaepopeja', 'epopeja', '', 0),
(19, 18, '9271837283451', 'Jądro Ciemności', 'Joseph Conrad', 420, 'Nowa Era', 2008, 'Jedno z największych dzieł‚ J.Conrada na podstawie, którego powstały liczne interpretacje artystyczne.', 'jądro ciemności conrad', 'Nie', 0),
(20, 8, '9788377583036', 'Władca Pierścieni. Drużyna Pierścienia', 'J R R Tolkien', 324, 'Muza', 2012, 'Wznowienie najsłynniejszego dzieła Tolkiena w jednym tomie. Wydanie z magicznymi ilustracjami A. Lee', 'fantastyka, trylogia, władca pierścieni', 'Nie', 0),
(21, 8, '234567831234', 'Władca Piercieni. Powrót Króla', 'J R R Tolkien', 423, 'Nowa Era', 2011, 'opis', 'fantastyka, trylogia, władca pierścieni', 'Nie', 0),
(22, 8, '9788375780642', 'Miecz przeznaczenia', 'Andrzej Sapkowski', 400, 'superNOWA', 2014, 'Cykl: Wiedźmin Geralt z Rivii (tom 2) ', 'Wiedźmin, Geralt, magia, potwory, literatura polska', 'Tak', 0),
(23, 8, '9788375780697', 'Pani Jeziora', 'Andrzej Sapkowski', 596, 'superNOWA', 2014, 'Cykl: Wiedźmin Geralt z Rivii (tom 7) ', 'Wiedźmin, Geralt, magia, potwory, literatura polska', 'Tak', 0),
(24, 18, '9788377915950', 'Proces', 'Franz Kafka', 192, 'Siedmior&oacute;g', 2017, 'Proces jest powieścią surrealistyczną Franza Kafki należącą do ścisłego kanonu literatury światowej.', 'Kafka, Proces, powieść, klasyka literatury', 'Tak', 0),
(25, 7, '9788324663897', 'Wałkowanie Ameryki', 'Marek Wałkuski', 312, 'Editio', 2012, 'Ameryka w oczach i uszach korespondenta Polskiego Radia.', 'Ameryka, Stany Zjednoczone, Marek Wałkuski, podr&oacute;że, Tr&oacute;jka, radio', 'Tak', 0);

--
-- Wyzwalacze `ksiazka`
--
DELIMITER $$
CREATE TRIGGER `ksiazka_dodaj_trigger` BEFORE INSERT ON `ksiazka` FOR EACH ROW BEGIN 
set @dost = 'Tak'; 
SET NEW.dostepnosc = @dost; 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `logowanie`
--

CREATE TABLE `logowanie` (
  `id` int(11) NOT NULL,
  `login` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `password` varchar(30) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `logowanie`
--

INSERT INTO `logowanie` (`id`, `login`, `password`) VALUES
(1, 'user ', 'user'),
(2, 'bibliotekarz ', 'haslo'),
(4, 'user2 ', 'user2'),
(5, 'user3 ', 'USER3'),
(14, 'user4 ', 'user4'),
(15, 'userT ', 'userT'),
(17, 'user5 ', 'user5'),
(18, 'user6 ', 'user6');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wypozyczenia`
--

CREATE TABLE `wypozyczenia` (
  `id_wypozyczenia` int(10) NOT NULL,
  `id_ksiazka` int(11) NOT NULL,
  `data_wypozyczenia` datetime NOT NULL,
  `data_zwrotu` datetime NOT NULL,
  `id_czytelnik` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `wypozyczenia`
--

INSERT INTO `wypozyczenia` (`id_wypozyczenia`, `id_ksiazka`, `data_wypozyczenia`, `data_zwrotu`, `id_czytelnik`) VALUES
(3, 19, '2019-02-02 18:06:21', '2019-01-30 00:00:00', 7),
(4, 13, '2019-02-04 17:44:38', '2019-03-06 00:00:00', 7);

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `wypozyczenia_razem_view`
-- (See below for the actual view)
--
CREATE TABLE `wypozyczenia_razem_view` (
`id_wypozyczenia` int(10)
,`id_czytelnik` int(11)
,`id_ksiazka` int(11)
,`data_wypozyczenia` datetime
,`data_zwrotu` datetime
,`isbn` varchar(13)
,`tytul` varchar(200)
,`autor` varchar(70)
,`imie_czytelnik` varchar(100)
,`nazwisko_czytelnik` varchar(100)
);

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `wypozyczenia_view`
-- (See below for the actual view)
--
CREATE TABLE `wypozyczenia_view` (
`id_wypozyczenia` int(10)
,`id_ksiazka` int(11)
,`data_wypozyczenia` datetime
,`data_zwrotu` datetime
,`id_czytelnik` int(11)
);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienie`
--

CREATE TABLE `zamowienie` (
  `id_zamowienie` int(11) NOT NULL COMMENT 'Klucz główny przydzielony automatycznie',
  `id_czytelnik` int(11) NOT NULL COMMENT 'Klucz obcy z tabeli czytelnik',
  `id_ksiazka` int(11) NOT NULL COMMENT 'Klucz obcy z tabeli ksiazka',
  `data_zamowienia` datetime NOT NULL COMMENT 'Data złożenia zamówienia w bibliotece',
  `data_odbioru` datetime DEFAULT NULL COMMENT 'Data odbioru książki z biblioteki ',
  `data_zwrotu` datetime DEFAULT NULL COMMENT 'Data zwrotu książki do biblioteki'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci COMMENT='Posiada informacje o zamówionych, wypożyczonych czy oddanych książkach w bibliotece.';

--
-- Zrzut danych tabeli `zamowienie`
--

INSERT INTO `zamowienie` (`id_zamowienie`, `id_czytelnik`, `id_ksiazka`, `data_zamowienia`, `data_odbioru`, `data_zwrotu`) VALUES
(3, 10, 10, '2018-12-24 13:28:29', NULL, NULL),
(12, 7, 21, '2019-02-01 20:34:05', '2019-02-01 00:00:00', NULL),
(13, 7, 7, '2019-02-04 10:11:12', '2019-02-04 10:41:12', '2019-02-14 10:11:12'),
(15, 10, 5, '2019-02-04 17:39:12', '2019-02-04 18:09:12', '2019-02-14 17:39:12'),
(16, 9, 20, '2019-02-04 18:13:04', '2019-02-04 18:43:04', '2019-02-14 18:13:04'),
(17, 8, 3, '2019-02-05 22:17:32', '2019-02-05 22:47:32', '2019-02-15 22:17:32'),
(18, 13, 4, '2019-02-06 09:38:07', '2019-02-06 10:08:07', '2019-02-16 09:38:07'),
(20, 14, 8, '2019-02-06 10:37:05', '2019-02-06 11:07:05', '2019-02-16 10:37:05');

--
-- Wyzwalacze `zamowienie`
--
DELIMITER $$
CREATE TRIGGER `zamowienie_oddanie_trigger` BEFORE INSERT ON `zamowienie` FOR EACH ROW BEGIN
        set @data_zam = DATE_ADD( NOW(), INTERVAL 10 DAY);
		SET NEW.data_zwrotu  = @data_zam;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `zamowienie_razem_view`
-- (See below for the actual view)
--
CREATE TABLE `zamowienie_razem_view` (
`id_zamowienie` int(11)
,`id_czytelnik` int(11)
,`id_ksiazka` int(11)
,`data_odbioru` datetime
,`data_zamowienia` datetime
,`data_zwrotu` datetime
,`tytul` varchar(200)
,`autor` varchar(70)
,`isbn` varchar(13)
,`imie_czytelnik` varchar(100)
,`nazwisko_czytelnik` varchar(100)
);

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `zamowienie_view`
-- (See below for the actual view)
--
CREATE TABLE `zamowienie_view` (
`id_zamowienie` int(11)
,`id_czytelnik` int(11)
,`id_ksiazka` int(11)
,`data_zamowienia` datetime
,`data_odbioru` datetime
,`data_zwrotu` datetime
);

-- --------------------------------------------------------

--
-- Struktura widoku `kategoria_view`
--
DROP TABLE IF EXISTS `kategoria_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kategoria_view`  AS  select `kategoria`.`id_kategoria` AS `id_kategoria`,`kategoria`.`nazwa` AS `nazwa` from `kategoria` ;

-- --------------------------------------------------------

--
-- Struktura widoku `wypozyczenia_razem_view`
--
DROP TABLE IF EXISTS `wypozyczenia_razem_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `wypozyczenia_razem_view`  AS  select `wypozyczenia`.`id_wypozyczenia` AS `id_wypozyczenia`,`wypozyczenia`.`id_czytelnik` AS `id_czytelnik`,`wypozyczenia`.`id_ksiazka` AS `id_ksiazka`,`wypozyczenia`.`data_wypozyczenia` AS `data_wypozyczenia`,`wypozyczenia`.`data_zwrotu` AS `data_zwrotu`,`ksiazka`.`isbn` AS `isbn`,`ksiazka`.`tytul` AS `tytul`,`ksiazka`.`autor` AS `autor`,`czytelnik`.`imie_czytelnik` AS `imie_czytelnik`,`czytelnik`.`nazwisko_czytelnik` AS `nazwisko_czytelnik` from ((`wypozyczenia` join `ksiazka` on((`wypozyczenia`.`id_ksiazka` = `ksiazka`.`id_ksiazka`))) join `czytelnik` on((`wypozyczenia`.`id_czytelnik` = `czytelnik`.`id_czytelnik`))) ;

-- --------------------------------------------------------

--
-- Struktura widoku `wypozyczenia_view`
--
DROP TABLE IF EXISTS `wypozyczenia_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `wypozyczenia_view`  AS  select `wypozyczenia`.`id_wypozyczenia` AS `id_wypozyczenia`,`wypozyczenia`.`id_ksiazka` AS `id_ksiazka`,`wypozyczenia`.`data_wypozyczenia` AS `data_wypozyczenia`,`wypozyczenia`.`data_zwrotu` AS `data_zwrotu`,`wypozyczenia`.`id_czytelnik` AS `id_czytelnik` from `wypozyczenia` ;

-- --------------------------------------------------------

--
-- Struktura widoku `zamowienie_razem_view`
--
DROP TABLE IF EXISTS `zamowienie_razem_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `zamowienie_razem_view`  AS  select `zamowienie`.`id_zamowienie` AS `id_zamowienie`,`zamowienie`.`id_czytelnik` AS `id_czytelnik`,`zamowienie`.`id_ksiazka` AS `id_ksiazka`,`zamowienie`.`data_odbioru` AS `data_odbioru`,`zamowienie`.`data_zamowienia` AS `data_zamowienia`,`zamowienie`.`data_zwrotu` AS `data_zwrotu`,`ksiazka`.`tytul` AS `tytul`,`ksiazka`.`autor` AS `autor`,`ksiazka`.`isbn` AS `isbn`,`czytelnik`.`imie_czytelnik` AS `imie_czytelnik`,`czytelnik`.`nazwisko_czytelnik` AS `nazwisko_czytelnik` from ((`zamowienie` join `ksiazka` on((`zamowienie`.`id_ksiazka` = `ksiazka`.`id_ksiazka`))) join `czytelnik` on((`zamowienie`.`id_czytelnik` = `czytelnik`.`id_czytelnik`))) ;

-- --------------------------------------------------------

--
-- Struktura widoku `zamowienie_view`
--
DROP TABLE IF EXISTS `zamowienie_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `zamowienie_view`  AS  select `zamowienie`.`id_zamowienie` AS `id_zamowienie`,`zamowienie`.`id_czytelnik` AS `id_czytelnik`,`zamowienie`.`id_ksiazka` AS `id_ksiazka`,`zamowienie`.`data_zamowienia` AS `data_zamowienia`,`zamowienie`.`data_odbioru` AS `data_odbioru`,`zamowienie`.`data_zwrotu` AS `data_zwrotu` from `zamowienie` ;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `bibliotekarze`
--
ALTER TABLE `bibliotekarze`
  ADD PRIMARY KEY (`id_bibliotekarz`);

--
-- Indexes for table `czytelnik`
--
ALTER TABLE `czytelnik`
  ADD PRIMARY KEY (`id_czytelnik`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Indexes for table `kategoria`
--
ALTER TABLE `kategoria`
  ADD PRIMARY KEY (`id_kategoria`);

--
-- Indexes for table `ksiazka`
--
ALTER TABLE `ksiazka`
  ADD PRIMARY KEY (`id_ksiazka`),
  ADD KEY `fk_ksiazka_kategoria1_idx` (`id_kategoria`);

--
-- Indexes for table `logowanie`
--
ALTER TABLE `logowanie`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Indexes for table `wypozyczenia`
--
ALTER TABLE `wypozyczenia`
  ADD PRIMARY KEY (`id_wypozyczenia`),
  ADD KEY `id_ksiazka` (`id_ksiazka`),
  ADD KEY `id_czytelnik` (`id_czytelnik`);

--
-- Indexes for table `zamowienie`
--
ALTER TABLE `zamowienie`
  ADD PRIMARY KEY (`id_zamowienie`),
  ADD KEY `fk_zamowienie_czytelnik1_idx` (`id_czytelnik`),
  ADD KEY `fk_zamowienie_ksiazka1_idx` (`id_ksiazka`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Klucz główny przydzielony automatycznie', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `bibliotekarze`
--
ALTER TABLE `bibliotekarze`
  MODIFY `id_bibliotekarz` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `czytelnik`
--
ALTER TABLE `czytelnik`
  MODIFY `id_czytelnik` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Klucz główny przydzielony automatycznie', AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT dla tabeli `kategoria`
--
ALTER TABLE `kategoria`
  MODIFY `id_kategoria` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Klucz główny przydzielony automatycznie', AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT dla tabeli `ksiazka`
--
ALTER TABLE `ksiazka`
  MODIFY `id_ksiazka` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Klucz główny przydzielony automatycznie', AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT dla tabeli `logowanie`
--
ALTER TABLE `logowanie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT dla tabeli `wypozyczenia`
--
ALTER TABLE `wypozyczenia`
  MODIFY `id_wypozyczenia` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `zamowienie`
--
ALTER TABLE `zamowienie`
  MODIFY `id_zamowienie` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Klucz główny przydzielony automatycznie', AUTO_INCREMENT=22;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `ksiazka`
--
ALTER TABLE `ksiazka`
  ADD CONSTRAINT `fk_ksiazka_kategoria1` FOREIGN KEY (`id_kategoria`) REFERENCES `kategoria` (`id_kategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `wypozyczenia`
--
ALTER TABLE `wypozyczenia`
  ADD CONSTRAINT `wypozyczenia_ibfk_1` FOREIGN KEY (`id_ksiazka`) REFERENCES `ksiazka` (`id_ksiazka`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wypozyczenia_ibfk_2` FOREIGN KEY (`id_czytelnik`) REFERENCES `czytelnik` (`id_czytelnik`);

--
-- Ograniczenia dla tabeli `zamowienie`
--
ALTER TABLE `zamowienie`
  ADD CONSTRAINT `fk_zamowienie_czytelnik1` FOREIGN KEY (`id_czytelnik`) REFERENCES `czytelnik` (`id_czytelnik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_zamowienie_ksiazka1` FOREIGN KEY (`id_ksiazka`) REFERENCES `ksiazka` (`id_ksiazka`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
