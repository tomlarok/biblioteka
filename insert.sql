INSERT INTO `admin` (`id_admin`, `login`, `haslo`) VALUES
(1, 'admin', 'admin');

INSERT INTO `bibliotekarz` (`id_bibliotekarz`, `login`, `haslo`) VALUES
(1, 'bibliotekarz', 'bibliotekarz');

INSERT INTO `bibliotekarze` (`id_bibliotekarz`, `bibliotekarz_imie`, `bibliotekarz_nazwisko`, `bibliotekarz_ulica`, `bibliotekarz_miasto`, `bibliotekarz_kod`, `bibliotekarz_email`, `bibliotekarz_id`) VALUES
(1, 'Anna', 'Hałasz', 'Zielona 12/3', 'Londek Zdrój', '63-125', 'anna_halasz@biblioteka.pl', 2);

INSERT INTO `czytelnik` (`id_czytelnik`, `login`, `haslo`, `imie_czytelnik`, `nazwisko_czytelnik`, `adres_czytelnik`, `miasto_czytelnik`, `wojewodztwo_czytelnik`, `telefon_czytelnik`, `kod_pocztowy_czytelnik`, `email_czytelnik`) VALUES
(1, 'czytelnik_1', 'hasło_czytelnika', 'Piotr', 'Klimek', 'ul. Przykład 4/ 12', 'Lublin', 'Lubelskie', NULL, '20-998', 'przyklad_1@wiedzanaplus.pl'),
(2, 'czytelnik_2', 'hasło_czytelnika', 'Patryk', 'Klimek', 'ul. Przykład 10/300', 'Lublin', 'Lubelskie', NULL, '20-999', 'przyklad_2@wiedzanaplus.pl'),
(7, 'user', '', 'Jan', 'Kowalski', 'Zielona 43/1', '', '', NULL, '', 'jan.kowalski@poczta.pl'),
(8, 'user2', '', 'AdaÅ›', 'Niezg&oacute;dka', 'Kawowa 21/7', '', '', NULL, '', 'adas.niezgodka@poczta.pl'),
(9, 'user3', '', 'Grzegorz', 'GrÄ…gowski', 'G&oacute;rzysta 21', '', '', NULL, '', 'gg@gg.com');

INSERT INTO `kategoria` (`id_kategoria`, `nazwa`) VALUES
(1, 'Biznes'),
(2, 'Poradniki'),
(3, 'Programowanie'),
(4, 'Programowanie mobilne'),
(5, 'Webmasterstwo'),
(6, 'Systemy operacyjne');


INSERT INTO `ksiazka` (`id_ksiazka`, `id_kategoria`, `isbn`, `tytul`, `autor`, `stron`, `wydawnictwo`, `rok_wydania`, `opis`) VALUES
(1, 3, '9788324631773', 'PHP i MySQL. Tworzenie stron WWW. Vademecum profesjonalisty. Wydanie czwarte', 'Luke Welling, Laura Thomson', 856, 'Helion', 2009, 'Czwarte wydanie bestsellerowego podręcznika dla webmasterów wykorzystujących w swojej pracy funkcjonalność języka PHP i bazy danych MySQL.'),
(2, 3, '9788324685301', 'Język C++. Kompendium wiedzy', 'Bjarne Stroustrup', 1296, 'Helion', 2014, NULL),
(3, 3, '9788324675340', 'Mistrz czystego kodu. Kodeks postępowania profesjonalnych programistów', 'Robert C. Martin', 216, 'Helion', 2013, NULL),
(4, 6, '9788324690138', 'Kali Linux. Testy penetracyjne', 'Joseph Muniz, Aamir Lakhani', 336, 'Helion', 2014, NULL),
(5, 3, '9788324621880', 'Czysty kod. Podręcznik dobrego programisty', 'Robert C. Martin', 424, 'Helion', 2010, NULL),
(6, 3, '9788324632374', 'Pragmatyczny programista. Od czeladnika do mistrza', 'Andrew Hunt, David Thomas', 332, 'Helion', 2011, NULL),
(7, 3, '9788324683178', 'Praca z zastanym kodem. Najlepsze techniki', 'Michael Feathers', 440, 'Helion', 2014, NULL),
(8, 5, '9788324685042', 'Tajemnice JavaScriptu. Podręcznik ninja', 'John Resig, Bear Bibeault', 432, 'Helion', 2014, NULL),
(9, 3, '9788324689361', 'Java EE 6. Tworzenie aplikacji w NetBeans 7', 'David R. Heffelfinger', 352, 'Helion', 2014, NULL),
(10, 5, '9788324666676', 'Projektowanie stron internetowych. Przewodnik dla początkujących webmasterów po HTML5, CSS3 i grafice. Wydanie IV', 'Jennifer Niederst Robbins', 600, 'Helion', 2014, NULL);


INSERT INTO `logowanie` (`id`, `login`, `password`) VALUES
(1, 'user ', 'user'),
(2, 'bibliotekarz ', 'haslo'),
(4, 'user2 ', 'user2'),
(5, 'user3 ', 'USER3');

INSERT INTO `wypozyczenia` (`id_wypozyczenia`, `id_ksiazka`, `data_wypozyczenia`, `data_zwrotu`, `id_czytelnik`) VALUES
(1, 2, '2018-11-19 10:10:08', '2018-12-19 09:13:18', 1),
(2, 8, '2018-11-19 10:10:08', '2018-11-24 18:31:06', 1);

INSERT INTO `zamowienie` (`id_zamowienie`, `id_czytelnik`, `id_ksiazka`, `data_zamowienia`, `data_odbioru`, `data_zwrotu`) VALUES
(1, 1, 1, '2014-08-01 10:12:02', NULL, NULL),
(2, 1, 2, '2014-08-01 10:12:02', '2014-08-03 12:10:10', NULL),
(3, 1, 5, '2014-08-01 10:13:02', '2014-08-03 12:11:10', '2014-08-15 12:00:00'),
(4, 2, 3, '2014-08-02 12:00:02', NULL, NULL),
(5, 2, 4, '2014-08-03 09:12:02', '2014-08-05 15:20:00', NULL),
(24, 1, 7, '2018-11-25 00:31:00', NULL, NULL);