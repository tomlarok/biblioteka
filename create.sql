CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL COMMENT 'Klucz główny przydzielony automatycznie',
  `login` varchar(50) COLLATE utf8_polish_ci NOT NULL COMMENT 'Nazwa administratora potrzebna przy logowaniu',
  `haslo` varchar(50) COLLATE utf8_polish_ci NOT NULL COMMENT 'Hasło niezaszyfrowane'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci COMMENT='Posiada informacje o administratorach zarejestrowanych w programie.';


CREATE TABLE `bibliotekarz` (
  `id_bibliotekarz` int(11) NOT NULL COMMENT 'Klucz główny przydzielony automatycznie',
  `login` varchar(50) COLLATE utf8_polish_ci NOT NULL COMMENT 'Nazwa bibliotekarza potrzebna przy logowaniu',
  `haslo` varchar(50) COLLATE utf8_polish_ci NOT NULL COMMENT 'Hasło niezaszyfrowane'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci COMMENT='Posiada informacje o bibliotekarzach zarejestrowanych w programie.';


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


CREATE TABLE `czytelnik` (
  `id_czytelnik` int(11) NOT NULL COMMENT 'Klucz główny przydzielony automatycznie',
  `login` varchar(50) COLLATE utf8_polish_ci NOT NULL COMMENT 'Nazwa czytelnika potrzeba przy logowaniu.',
  `haslo` varchar(45) COLLATE utf8_polish_ci NOT NULL COMMENT 'Hasło niezaszyfrowane',
  `imie_czytelnik` varchar(100) COLLATE utf8_polish_ci NOT NULL COMMENT 'Imię ',
  `nazwisko_czytelnik` varchar(100) COLLATE utf8_polish_ci NOT NULL COMMENT 'Nazwisko',
  `adres_czytelnik` varchar(200) COLLATE utf8_polish_ci NOT NULL COMMENT 'Adres zamieszkania np.: ul. Przykład 3/12',
  `miasto_czytelnik` varchar(45) COLLATE utf8_polish_ci NOT NULL COMMENT 'Miasto',
  `wojewodztwo_czytelnik` varchar(100) COLLATE utf8_polish_ci NOT NULL COMMENT 'Nazwa województwa',
  `telefon_czytelnik` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL COMMENT 'Telefony',
  `kod_pocztowy_czytelnik` varchar(45) COLLATE utf8_polish_ci NOT NULL COMMENT 'Kod pocztowy',
  `email_czytelnik` varchar(100) COLLATE utf8_polish_ci NOT NULL COMMENT 'Adres e-mail'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci COMMENT='Posiada informacje o czytelnikach zarejestrowanych w programie.';


CREATE TABLE `kategoria` (
  `id_kategoria` int(11) NOT NULL COMMENT 'Klucz główny przydzielony automatycznie',
  `nazwa` varchar(200) COLLATE utf8_polish_ci NOT NULL COMMENT 'Nazwa kategorii'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci COMMENT='Tabela zawierająca wszystkie kategorie książek w systemie.';


CREATE TABLE `ksiazka` (
  `id_ksiazka` int(11) NOT NULL COMMENT 'Klucz główny przydzielony automatycznie',
  `id_kategoria` int(11) NOT NULL COMMENT 'Klucz obcy z tabeli kategoria',
  `isbn` varchar(13) COLLATE utf8_polish_ci NOT NULL COMMENT 'Niepowtarzalny 13-cyfrowy identyfikator książki',
  `tytul` varchar(200) COLLATE utf8_polish_ci NOT NULL COMMENT 'Tytuł książki',
  `autor` varchar(70) COLLATE utf8_polish_ci NOT NULL COMMENT 'Imię i Nazwisko autora książki',
  `stron` int(4) NOT NULL COMMENT 'Liczba stron książki',
  `wydawnictwo` varchar(50) COLLATE utf8_polish_ci NOT NULL COMMENT 'Nazwa wydawnictwa, w którym wydano książkę',
  `rok_wydania` int(4) NOT NULL COMMENT 'Rok wydania książki',
  `opis` text COLLATE utf8_polish_ci COMMENT 'Opis książki'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci COMMENT='Wszystkie książki dodane do bazy danych.';


CREATE TABLE `logowanie` (
  `id` int(11) NOT NULL,
  `login` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `password` varchar(30) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;


CREATE TABLE `wypozyczenia` (
  `id_wypozyczenia` int(10) NOT NULL,
  `id_ksiazka` int(11) NOT NULL,
  `data_wypozyczenia` datetime NOT NULL,
  `data_zwrotu` datetime NOT NULL,
  `id_czytelnik` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;


CREATE TABLE `zamowienie` (
  `id_zamowienie` int(11) NOT NULL COMMENT 'Klucz główny przydzielony automatycznie',
  `id_czytelnik` int(11) NOT NULL COMMENT 'Klucz obcy z tabeli czytelnik',
  `id_ksiazka` int(11) NOT NULL COMMENT 'Klucz obcy z tabeli ksiazka',
  `data_zamowienia` datetime NOT NULL COMMENT 'Data złożenia zamówienia w bibliotece',
  `data_odbioru` datetime DEFAULT NULL COMMENT 'Data odbioru książki z biblioteki ',
  `data_zwrotu` datetime DEFAULT NULL COMMENT 'Data zwrotu książki do biblioteki'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci COMMENT='Posiada informacje o zamówionych, wypożyczonych czy oddanych książkach w bibliotece.';
