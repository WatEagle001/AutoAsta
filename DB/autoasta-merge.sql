-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Creato il: Set 06, 2022 alle 09:20
-- Versione del server: 5.7.34
-- Versione PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `AutoAsta_merge`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `account`
--

CREATE TABLE `account` (
  `id_Account` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(500) NOT NULL,
  `email` varchar(100) NOT NULL,
  `isAdmin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `account`
--

INSERT INTO `account` (`id_Account`, `username`, `password`, `email`, `isAdmin`) VALUES
(1, 'matteopillon', '4ee8b3991aa777ebdbfc2b54a9163637', 'matteopillon98@gmail.com', 1),
(2, 'mariorossi72', '1cc477616bb182e87ec7285bfbf8c34b', 'mariorossi@email.com', 0),
(3, 'luigiMagnifico93', '8f58fe78bf209813d552e92f68d24974', 'luigibianchi@email.com', 0),
(4, 'giggiog', '16272a5dd83c63010e9f67977940e871', 'gigiogiacomo@gmail.com', 0),
(5, 'allelleb', 'a382e131ed798891b816f8d1e3ce1908', 'allellebrazof@live.it', 0),
(6, 'MarcoGino90', '7e5e77f2b21b573013d1f33515360d07', 'marcogino90@yandex.com', 0),
(7, 'Lillo', '38907befbdefbe570ffeddaa99bb4a8c', 'lillogreg60@yahoo.com', 0),
(8, 'CinoPistoia', '973110a7ac5f488b626fb2530c723049', 'cinodapistoia@gmail.com', 0),
(9, '17teo98', '81dc9bdb52d04dc20036dbd8313ed055', 'matteoplln@gmail.com', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `asta`
--

CREATE TABLE `asta` (
  `id_Asta` int(11) NOT NULL,
  `base_Asta` float NOT NULL,
  `venduto` tinyint(1) NOT NULL,
  `prezzo_Finale` float NOT NULL,
  `targa_Veicolo` varchar(7) NOT NULL,
  `data` date NOT NULL,
  `email_Acquirente` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `asta`
--

INSERT INTO `asta` (`id_Asta`, `base_Asta`, `venduto`, `prezzo_Finale`, `targa_Veicolo`, `data`, `email_Acquirente`) VALUES
(1, 35000, 1, 40000, 'AB001CD', '2021-12-19', 'matteopillon98@gmail.com'),
(2, 22000, 0, 0, 'FJ537TA', '0000-00-00', ''),
(3, 47000, 0, 0, 'DD001FF', '0000-00-00', ''),
(4, 25000, 0, 0, 'FY590WR', '0000-00-00', ''),
(5, 100000, 0, 0, 'AS957AZ', '0000-00-00', ''),
(8, 96000, 0, 0, 'DY738BF', '0000-00-00', ''),
(9, 13000, 0, 0, 'TP006AS', '0000-00-00', ''),
(10, 98000, 0, 0, 'FW098RW', '0000-00-00', ''),
(11, 12540, 0, 0, 'MP888PL', '2022-09-06', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `biglietto`
--

CREATE TABLE `biglietto` (
  `Id_Biglietto` int(11) NOT NULL,
  `evento` int(11) NOT NULL,
  `utente` varchar(100) NOT NULL,
  `data_Acquisto` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `biglietto`
--

INSERT INTO `biglietto` (`Id_Biglietto`, `evento`, `utente`, `data_Acquisto`) VALUES
(1, 1, 'luigibianchi@email.com', '2021-12-19'),
(2, 3, 'luigibianchi@email.com', '2021-12-19'),
(4, 2, 'matteopillon98@gmail.com', '2022-08-26');

-- --------------------------------------------------------

--
-- Struttura della tabella `evento`
--

CREATE TABLE `evento` (
  `id_Evento` int(11) NOT NULL,
  `capienza` int(11) NOT NULL,
  `data` date NOT NULL,
  `indirizzo` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descrizione` text NOT NULL,
  `prezzo` float NOT NULL,
  `url_immagine` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `evento`
--

INSERT INTO `evento` (`id_Evento`, `capienza`, `data`, `indirizzo`, `nome`, `descrizione`, `prezzo`, `url_immagine`) VALUES
(1, 250, '2022-12-12', 1, 'AutoAsta Padova', 'Auto Asta arriva nella città del Santo. Venite a visitare le nostre auto in un weekend all\'insegna dei motori', 7.5, 'Padova.jpg'),
(2, 999, '2025-12-16', 2, 'AutoAsta Milano', 'Auto Asta arriva nella metropoli, capitale della Moda: Milano. Per questa speciale occasione il salone sarà completamente rinnovato nella sua esposizione, in collaborazione con i marchi più prestigiosi del mondo della moda, venite a trovarci!', 15.99, 'Milano.jpg'),
(3, 2500, '2022-05-28', 3, 'AutoAsta Roma', 'AutoAsta arriva anche nella capitale. Simbolo in tutto il mondo di storia e culturale, vi aspettiamo per un weekend all\'insegna dei motori in uno dei luoghi più storici al mondo, mi raccomando non mancate!', 17.99, 'Roma.jpg'),
(4, 499, '2022-09-16', 4, 'AutoAsta Bologna', 'AutoAsta arriva finalmente anche a Bologna! Non potevamo saltare la terra dei motori, venite a trovarci in questa avvincente giornata esposizione, all\'esposizione ci sarà un\'auto speciale per celebrare l\'occasione. ', 13, 'Bologna.jpg'),
(5, 1200, '2023-10-10', 5, 'AutoAsta', 'AutoAsta arriva a Bolzano. Gustati belle auto e birroni Forst in totale armonia, e deliziati con i piatti a base di carne', 15, 'Bolzano.jpg'),
(6, 120, '2025-09-12', 8, 'AutoAsta', 'AutoAsta arriva nelle cita di Como. Acuqa e Auto sono un mix perfetto. Ammira le auto e se ti va sali a bordo del tuo bolide per andare nelle Bellissima Svizzera in poco tempo', 18, 'Como.jpg'),
(24, 123, '2022-09-22', 26, 'Pordenone AutoAsta', 'AutoAsta arriva anche nella piccola città di Pordenone ', 2, 'pordenone.jpeg');

-- --------------------------------------------------------

--
-- Struttura della tabella `indirizzo`
--

CREATE TABLE `indirizzo` (
  `id_Indirizzo` int(11) NOT NULL,
  `via` varchar(50) NOT NULL,
  `citta` varchar(100) NOT NULL,
  `cap` int(11) NOT NULL,
  `num_Civico` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `indirizzo`
--

INSERT INTO `indirizzo` (`id_Indirizzo`, `via`, `citta`, `cap`, `num_Civico`) VALUES
(1, 'Niccolò Tommaseo', 'Padova', 35131, '59'),
(2, 'Statale Sempione', 'Rho (Milano)', 20017, '28'),
(3, 'Portuense', 'Roma', 148, '1645'),
(4, 'Piazza della Costituzione', 'Bologna', 40128, '5'),
(5, 'Buccia', 'Bolzano', 28006, '89'),
(6, 'Buccia', 'Bolzano', 28006, '89'),
(7, 'Buccia', 'Bolzano', 28006, '89'),
(8, 'Crescente', 'Como', 30006, '29'),
(26, 'Cappuccini', 'Pordenone', 33170, '3');

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `Email` varchar(100) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `cognome` varchar(250) NOT NULL,
  `data_Creazione` date NOT NULL,
  `url_Immagine` varchar(1000) NOT NULL,
  `data_nascita` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`Email`, `nome`, `cognome`, `data_Creazione`, `url_Immagine`, `data_nascita`) VALUES
('allellebrazof@live.it', 'Allelle', 'Brazof', '2022-08-26', '', '1960-07-10'),
('cinodapistoia@gmail.com', 'Cino', 'Pistoia', '2022-08-26', '', '1993-10-09'),
('gigiogiacomo@gmail.com', 'Giacomo', 'Giggio', '2022-08-26', '', '1996-09-30'),
('lillogreg60@yahoo.com', 'Lillo', 'Greg', '2022-08-26', '', '1960-10-10'),
('luigibianchi@email.com', 'Luigi', 'Bianchi', '2021-12-18', '', '1972-05-01'),
('marcogino90@yandex.com', 'Marco', 'Gino', '2022-08-26', '', '1990-12-12'),
('mariorossi@email.com', 'Mario', 'Rossi', '2021-12-18', '../img/Andrea.jpg', '1994-12-06'),
('matteopillon98@gmail.com', 'Matteo', 'Pillon', '2021-12-19', '../img/MatteoP.jpg', '1998-10-17'),
('matteoplln@gmail.com', 'Mat', 'Pil', '2022-09-04', '', '1998-09-17');

-- --------------------------------------------------------

--
-- Struttura della tabella `veicolo`
--

CREATE TABLE `veicolo` (
  `Targa` varchar(7) NOT NULL,
  `marca` varchar(100) NOT NULL,
  `modello` varchar(64) NOT NULL,
  `cilindrata` int(11) NOT NULL,
  `anno` int(11) NOT NULL,
  `posti` int(11) NOT NULL,
  `cambio` varchar(50) NOT NULL,
  `carburante` varchar(50) NOT NULL,
  `colore_Esterni` varchar(50) NOT NULL,
  `url_Immagine` varchar(1000) NOT NULL,
  `descrizione` text NOT NULL,
  `chilometri_Percorsi` int(11) NOT NULL,
  `disponibile` tinyint(1) NOT NULL,
  `data_Aggiunta` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `veicolo`
--

INSERT INTO `veicolo` (`Targa`, `marca`, `modello`, `cilindrata`, `anno`, `posti`, `cambio`, `carburante`, `colore_Esterni`, `url_Immagine`, `descrizione`, `chilometri_Percorsi`, `disponibile`, `data_Aggiunta`) VALUES
('AB001CD', 'Audi', 'A5', 2000, 2020, 5, 'Automatico', 'Benzina', 'Nero brillante', 'AudiA5.jpg', 'Bellissima AUDI A5, utilizzata prevalentemente come auto aziendale', 100000, 1, '2022-08-25'),
('AB002CD', 'McLaren', '570S', 3799, 2018, 2, 'Automatico', 'Benzina', 'Nero metallizzato', 'McLaren570S.jpg', 'Spettacolare McLaren dotata dei seguenti optional: Lift sollevatore anteriore  Freni carboceramici  Pacchetto carbonio interno totale  Fari anteriori FULL LED  Climatizzatore automatico   Cerchi in lega 19 pollici anteriore 20 pollici posteriore  Navigatore  Bluetooth   Sedili in pelle e alcantara regolabili elettricamente con memorie  Volante in alcantara  Sensori luci e pioggia automatici  Telecamera di parcheggio  Sensori parcheggio anteriori e posteriori', 40000, 1, '2022-08-25'),
('AB003CD', 'Mercedes', 'G63 AMG ', 3982, 2020, 5, 'Automatico', 'Benzina', 'Grigio Metallizzato', 'MercedesC63AMG.jpg', 'Direttamente dal futuro questo fantastico esemplare di AMG G63 in grado di affrontare qualunque terreno o situazione le si porga davanti ', 15000, 1, '2022-08-25'),
('AS957AZ', 'Mercedes', '190', 2000, 1981, 5, 'Automatico', 'Benzina', 'Nero', 'mercedes_190.jpg', 'Fantastica Mercedes 190e, esemplare tenuto benissimo', 106350, 1, '2022-08-25'),
('DD001FF', 'Volvo', 'Polar', 1900, 1987, 5, 'Manuale', 'Diesel', 'Blu', 'Volvo-polar.jpg', 'Ottima volvo polar, indistruttibile motore 6 cilindi vecchia scuola. Consuma ma non si rompe nemmeno a pagarla', 500000, 1, '2022-08-23'),
('DY738BF', 'Toyota', 'Hilux', 2000, 1990, 7, 'Automatico', 'Diesel', 'Grigio Metalizzato', 'toyota_hylux.jpg', 'Classico Pick Up Toyota, indistruttibile e a prova di usura', 599000, 1, '2022-08-24'),
('FJ537TA', 'Audi', 'Quattro', 3000, 1990, 2, 'Manuale', 'Benzina', 'Rosso', 'Audi-quattro-179836866.jpg', 'Bellissima Audi Quattro, anno 1990, cambio sequenziale, motore 3000 5 cilindri, iniezione fasata sequenziale. ', 28000, 1, '2022-08-10'),
('FW098RW', 'Cadillac', 'Escalade', 5000, 2019, 7, 'Automatico', 'Benzina', 'Nero', 'cadillac.jpg', 'Enorme suv americano dotato di un 5.0 ad 8 cilindri a V. ', 20000, 1, '2022-08-24'),
('FY590WR', 'Opel', 'Corsa', 1600, 2019, 5, 'Automatico', 'Benzina', 'Blu chiaro', 'Corsa_opc.jpg', 'Nuovissima Opel Corsa OPC. 207 CV tutti davanti pronti a far divertire chiunque', 64000, 1, '2022-08-25'),
('MP888PL', 'Mercedes', 'a180', 2000, 2010, 5, 'Automatico', 'Benzina', 'Nero', 'mercedesA180.jpg', 'gewognieoiwngoiwengo', 12000, 1, '2022-09-06'),
('TP006AS', 'Volkswagen', 'Golf', 3200, 2004, 5, 'Automatico', 'Benzina', 'Blu', 'golf_4.jpg', 'Il classico VR6 marchiato Vokswagen non si smentisce mai. Auto estremamente divertente e affidabile', 209867, 1, '2022-08-21');

-- --------------------------------------------------------

--
-- Struttura della tabella `veicoloesposto`
--

CREATE TABLE `veicoloesposto` (
  `id_Esposizione` int(11) NOT NULL,
  `veicolo` varchar(7) NOT NULL,
  `evento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `veicoloesposto`
--

INSERT INTO `veicoloesposto` (`id_Esposizione`, `veicolo`, `evento`) VALUES
(1, 'AB001CD', 1),
(2, 'AB002CD', 2),
(4, 'AB003CD', 3);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id_Account`),
  ADD UNIQUE KEY `Email` (`email`);

--
-- Indici per le tabelle `asta`
--
ALTER TABLE `asta`
  ADD PRIMARY KEY (`id_Asta`),
  ADD KEY `Veicolo` (`targa_Veicolo`),
  ADD KEY `Compratore` (`email_Acquirente`);

--
-- Indici per le tabelle `biglietto`
--
ALTER TABLE `biglietto`
  ADD PRIMARY KEY (`Id_Biglietto`),
  ADD KEY `chiaveEsternaEvento` (`evento`),
  ADD KEY `Utente` (`utente`);

--
-- Indici per le tabelle `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id_Evento`),
  ADD KEY `Indirizzo` (`indirizzo`);

--
-- Indici per le tabelle `indirizzo`
--
ALTER TABLE `indirizzo`
  ADD PRIMARY KEY (`id_Indirizzo`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`Email`);

--
-- Indici per le tabelle `veicolo`
--
ALTER TABLE `veicolo`
  ADD PRIMARY KEY (`Targa`),
  ADD KEY `marca` (`marca`) USING BTREE;

--
-- Indici per le tabelle `veicoloesposto`
--
ALTER TABLE `veicoloesposto`
  ADD PRIMARY KEY (`id_Esposizione`),
  ADD KEY `Veicolo` (`veicolo`),
  ADD KEY `Evento` (`evento`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `account`
--
ALTER TABLE `account`
  MODIFY `id_Account` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT per la tabella `asta`
--
ALTER TABLE `asta`
  MODIFY `id_Asta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT per la tabella `biglietto`
--
ALTER TABLE `biglietto`
  MODIFY `Id_Biglietto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `evento`
--
ALTER TABLE `evento`
  MODIFY `id_Evento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT per la tabella `indirizzo`
--
ALTER TABLE `indirizzo`
  MODIFY `id_Indirizzo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT per la tabella `veicoloesposto`
--
ALTER TABLE `veicoloesposto`
  MODIFY `id_Esposizione` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`email`) REFERENCES `utente` (`Email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
