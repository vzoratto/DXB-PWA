CREATE TABLE `result`(
  `idResultado` int(5) NOT NULL,
  `numEquipo` int(4) NOT NULL,
  `tiempoLlegada` int(124)  NULL,
  `respuestasCorrectas` int(4)  NULL,
  `bolsasCompletas` int(4) NOT NULL,
  `penalizacionBolsa` int(124) NULL,
  `trivia` int(124) NULL,
  `total` int(124) NULL,
  `categoria` int(5) NULL,
  `cantPersonas` int(5) NULL


) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `result`
  ADD PRiMARY KEY (`idResultado`);
ALTER TABLE `result`
  MODIFY `idResultado` int(5) NOT NULL AUTO_INCREMENT;