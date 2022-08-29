-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Creato il: Gen 04, 2022 alle 17:11
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
-- Database: `AutoAsta`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Account`
--

CREATE TABLE `Account` (
  `id_Account` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(500) NOT NULL,
  `email` varchar(100) NOT NULL,
  `isAdmin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `Account`
--

INSERT INTO `Account` (`id_Account`, `username`, `password`, `email`, `isAdmin`) VALUES
(1, 'matteopillon', 'Matteo', 'matteopillon98@gmail.com', 1),
(2, 'mariorossi72', 'Mario', 'mariorossi@email.com', 0),
(3, 'luigiMagnifico93', 'Luigi', 'luigibianchi@email.com', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `Asta`
--

CREATE TABLE `Asta` (
  `id_Asta` int(11) NOT NULL,
  `base_Asta` float NOT NULL,
  `venduto` tinyint(1) NOT NULL,
  `prezzo_Finale` float NOT NULL,
  `targa_Veicolo` varchar(7) NOT NULL,
  `data` date NOT NULL,
  `email_Acquirente` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `Asta`
--

INSERT INTO `Asta` (`id_Asta`, `base_Asta`, `venduto`, `prezzo_Finale`, `targa_Veicolo`, `data`, `email_Acquirente`) VALUES
(1, 35000, 1, 40000, 'AB001CD', '2021-12-19', 'matteopillon98@gmail.com');

-- --------------------------------------------------------

--
-- Struttura della tabella `Biglietto`
--

CREATE TABLE `Biglietto` (
  `Id_Biglietto` int(11) NOT NULL,
  `evento` int(11) NOT NULL,
  `utente` varchar(100) NOT NULL,
  `data_Acquisto` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `Biglietto`
--

INSERT INTO `Biglietto` (`Id_Biglietto`, `evento`, `utente`, `data_Acquisto`) VALUES
(1, 1, 'luigibianchi@email.com', '2021-12-19'),
(2, 3, 'luigibianchi@email.com', '2021-12-19');

-- --------------------------------------------------------

--
-- Struttura della tabella `Evento`
--

CREATE TABLE `Evento` (
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
-- Dump dei dati per la tabella `Evento`
--

INSERT INTO `Evento` (`id_Evento`, `capienza`, `data`, `indirizzo`, `nome`, `descrizione`, `prezzo`, `url_immagine`) VALUES
(1, 250, '2022-02-12', 1, 'AutoAsta Padova', 'Auto Asta arriva nella città del Santo. Venite a visitare le nostre auto in un weekend all\'insegna dei motori', 7.5, 'Padova.jpg'),
(2, 1000, '2022-04-16', 2, 'AutoAsta Milano', 'Auto Asta arriva nella metropoli, capitale della Moda: Milano. Per questa speciale occasione il salone sarà completamente rinnovato nella sua esposizione, in collaborazione con i marchi più prestigiosi del mondo della moda, venite a trovarci!', 15.99, 'Milano.jpg'),
(3, 2500, '2022-05-28', 3, 'AutoAsta Roma', 'AutoAsta arriva anche nella capitale. Simbolo in tutto il mondo di storia e culturale, vi aspettiamo per un weekend all\'insegna dei motori in uno dei luoghi più storici al mondo, mi raccomando non mancate!', 17.99, 'Roma.jpg'),
(4, 500, '2022-09-16', 4, 'AutoAsta Bologna', 'AutoAsta arriva finalmente anche a Bologna! Non potevamo saltare la terra dei motori, venite a trovarci in questa avvincente giornata esposizione, all\'esposizione ci sarà un\'auto speciale per celebrare l\'occasione. ', 13, 'Bologna.jpg');

-- --------------------------------------------------------

--
-- Struttura della tabella `Indirizzo`
--

CREATE TABLE `Indirizzo` (
  `id_Indirizzo` int(11) NOT NULL,
  `via` varchar(50) NOT NULL,
  `città` varchar(100) NOT NULL,
  `cap` int(11) NOT NULL,
  `num_Civico` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `Indirizzo`
--

INSERT INTO `Indirizzo` (`id_Indirizzo`, `via`, `città`, `cap`, `num_Civico`) VALUES
(1, 'Niccolò Tommaseo', 'Padova', 35131, '59'),
(2, 'Statale Sempione', 'Rho (Milano)', 20017, '28'),
(3, 'Portuense', 'Roma', 148, '1645'),
(4, 'Piazza della Costituzione', 'Bologna', 40128, '5');

-- --------------------------------------------------------

--
-- Struttura della tabella `Utente`
--

CREATE TABLE `Utente` (
  `Email` varchar(100) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `cognome` varchar(250) NOT NULL,
  `data_Creazione` date NOT NULL,
  `url_Immagine` varchar(1000) NOT NULL,
  `data_nascita` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `Utente`
--

INSERT INTO `Utente` (`Email`, `nome`, `cognome`, `data_Creazione`, `url_Immagine`, `data_nascita`) VALUES
('luigibianchi@email.com', 'Luigi', 'Bianchi', '2021-12-18', '', '1972-05-01'),
('mariorossi@email.com', 'Mario', 'Rossi', '2021-12-18', '', '1994-12-06'),
('matteopillon98@gmail.com', 'Matteo', 'Pillon', '2021-12-19', '', '1998-10-17');

-- --------------------------------------------------------

--
-- Struttura della tabella `Veicolo`
--

CREATE TABLE `Veicolo` (
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
  `disponibile` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `Veicolo`
--

INSERT INTO `Veicolo` (`Targa`, `marca`, `modello`, `cilindrata`, `anno`, `posti`, `cambio`, `carburante`, `colore_Esterni`, `url_Immagine`, `descrizione`, `chilometri_Percorsi`, `disponibile`) VALUES
('AB001CD', 'Audi', 'A5', 2000, 2019, 5, 'Automatico', 'Benzina', 'Nero brillante', 'AudiA5.jpg', 'Bellissima AUDI A5, utilizzata prevalentemente come auto aziendale', 100000, 0),
('AB002CD', 'McLaren', '570S', 3799, 2018, 2, 'Automatico', 'Benzina', 'Nero metallizzato', 'McLaren570S.jpg', 'Spettacolare McLaren dotata dei seguenti optional: Lift sollevatore anteriore  Freni carboceramici  Pacchetto carbonio interno totale  Fari anteriori FULL LED  Climatizzatore automatico   Cerchi in lega 19 pollici anteriore 20 pollici posteriore  Navigatore  Bluetooth   Sedili in pelle e alcantara regolabili elettricamente con memorie  Volante in alcantara  Sensori luci e pioggia automatici  Telecamera di parcheggio  Sensori parcheggio anteriori e posteriori', 40000, 1),
('AB003CD', 'Mercedes', 'G63 AMG ', 3982, 2020, 5, 'Automatico', 'Benzina', 'Grigio Metallizzato', 'MercedesC63AMG.jpg', 'Direttamente dal futuro questo fantastico esemplare di AMG G63 in grado di affrontare qualunque terreno o situazione le si porga davanti ', 15000, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `veicoloEsposto`
--

CREATE TABLE `veicoloEsposto` (
  `id_Esposizione` int(11) NOT NULL,
  `veicolo` varchar(7) NOT NULL,
  `evento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `veicoloEsposto`
--

INSERT INTO `veicoloEsposto` (`id_Esposizione`, `veicolo`, `evento`) VALUES
(1, 'AB001CD', 1),
(2, 'AB002CD', 2),
(4, 'AB003CD', 3);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `Account`
--
ALTER TABLE `Account`
  ADD PRIMARY KEY (`id_Account`),
  ADD UNIQUE KEY `Email` (`email`);

--
-- Indici per le tabelle `Asta`
--
ALTER TABLE `Asta`
  ADD PRIMARY KEY (`id_Asta`),
  ADD KEY `Veicolo` (`targa_Veicolo`),
  ADD KEY `Compratore` (`email_Acquirente`);

--
-- Indici per le tabelle `Biglietto`
--
ALTER TABLE `Biglietto`
  ADD PRIMARY KEY (`Id_Biglietto`),
  ADD KEY `chiaveEsternaEvento` (`evento`),
  ADD KEY `Utente` (`utente`);

--
-- Indici per le tabelle `Evento`
--
ALTER TABLE `Evento`
  ADD PRIMARY KEY (`id_Evento`),
  ADD KEY `Indirizzo` (`indirizzo`);

--
-- Indici per le tabelle `Indirizzo`
--
ALTER TABLE `Indirizzo`
  ADD PRIMARY KEY (`id_Indirizzo`);

--
-- Indici per le tabelle `Utente`
--
ALTER TABLE `Utente`
  ADD PRIMARY KEY (`Email`);

--
-- Indici per le tabelle `Veicolo`
--
ALTER TABLE `Veicolo`
  ADD PRIMARY KEY (`Targa`),
  ADD KEY `marca` (`marca`) USING BTREE;

--
-- Indici per le tabelle `veicoloEsposto`
--
ALTER TABLE `veicoloEsposto`
  ADD PRIMARY KEY (`id_Esposizione`),
  ADD KEY `Veicolo` (`veicolo`),
  ADD KEY `Evento` (`evento`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `Account`
--
ALTER TABLE `Account`
  MODIFY `id_Account` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `Asta`
--
ALTER TABLE `Asta`
  MODIFY `id_Asta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `Biglietto`
--
ALTER TABLE `Biglietto`
  MODIFY `Id_Biglietto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `Evento`
--
ALTER TABLE `Evento`
  MODIFY `id_Evento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `Indirizzo`
--
ALTER TABLE `Indirizzo`
  MODIFY `id_Indirizzo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `veicoloEsposto`
--
ALTER TABLE `veicoloEsposto`
  MODIFY `id_Esposizione` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `Account`
--
ALTER TABLE `Account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`email`) REFERENCES `Utente` (`Email`);

--
-- Limiti per la tabella `Asta`
--
ALTER TABLE `Asta`
  ADD CONSTRAINT `asta_ibfk_2` FOREIGN KEY (`targa_Veicolo`) REFERENCES `Veicoli` (`Targa`),
  ADD CONSTRAINT `asta_ibfk_3` FOREIGN KEY (`email_Acquirente`) REFERENCES `Utente` (`Email`);

--
-- Limiti per la tabella `Biglietto`
--
ALTER TABLE `Biglietto`
  ADD CONSTRAINT `biglietto_ibfk_1` FOREIGN KEY (`utente`) REFERENCES `Utente` (`Email`),
  ADD CONSTRAINT `chiaveEsternaEvento` FOREIGN KEY (`evento`) REFERENCES `Evento` (`id_Evento`);

--
-- Limiti per la tabella `Evento`
--
ALTER TABLE `Evento`
  ADD CONSTRAINT `evento_ibfk_1` FOREIGN KEY (`indirizzo`) REFERENCES `Indirizzo` (`id_Indirizzo`);

--
-- Limiti per la tabella `veicoloEsposto`
--
ALTER TABLE `veicoloEsposto`
  ADD CONSTRAINT `veicoloesposto_ibfk_1` FOREIGN KEY (`veicolo`) REFERENCES `Veicoli` (`Targa`),
  ADD CONSTRAINT `veicoloesposto_ibfk_2` FOREIGN KEY (`evento`) REFERENCES `Evento` (`id_Evento`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
