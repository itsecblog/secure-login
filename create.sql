--
-- Tabellenstruktur für Tabelle `sl_cache`
--

CREATE TABLE IF NOT EXISTS `sl_cache` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `salt` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sl_user`
--

CREATE TABLE IF NOT EXISTS `sl_user` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `salt` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indizes für die Tabelle `sl_cache`
--
ALTER TABLE `sl_cache`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `sl_user`
--
ALTER TABLE `sl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für Tabelle `sl_cache`
--
ALTER TABLE `sl_cache`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `sl_user`
--
ALTER TABLE `sl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

