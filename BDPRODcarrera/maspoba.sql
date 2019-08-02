
INSERT INTO `usuario` (`idUsuario`,`dniUsuario`,`claveUsuario`,`mailUsuario`,`authkey`,`activado`,`idRol`) VALUES
(1,14780341,'capXGYjL7lKE.','lilianapaez@gmail.com','1',1,2),
(2,35178582,'ca5MeixRJe8SM','alexisbascuñan@gmail.com','1',1,3),
(3, 27894458, 'caqVPE9ZitkGw', 'pablo.kogan@gmail.com', 'aerrarcrcraddbredardcarrarrraraarberrcaadaraeearra', 0, 1),
(4, 37951821, 'caISdp22WPROc', 'carolinamariel14@hotmail.com', '087x8b00WW97xzAx08bb6986xzz89Wx686x997x9686bAWb09b', 1, 1),
(5, 39881326, 'camnpIIaIHJ1Y', 'danielassf98@gmail.com', 'zbAW607bx7x87zA6bxA609bx8908677b0x8A6zb6x7z96xW7AA', 1, 1),
(6, 23890156, 'caytdyeWoDNR2', 'clausy2012@hotmail.com', 'AW67A8A67bz86xx0xWAWx9WbA766Ax9W76WbAA8bb88x6Ax8x6', 1, 1),
(7, 39868898, 'caJY6jFfAJofU', 'Valeria1995elizabeth@gmail.com', 'radrbrrbardcraaradarebraecaaerrrbrararbdreararraab', 0, 1),
(8, 20917491, 'caMp86DbE.C/s', 'dasemenzato@hotmail.com', 'W877906bWxWb79z8WA7960b9W9W686xz0798zAzA6bW7Wb0bW0', 1, 1),
(9, 36693318, 'caJ7T2yCWsql2', 'riveromarielandrea@gmail.com', '99986A89W8x7009WW9978zAxA08Wz98A06bWWAWb9A7zzA997A', 1, 1),
(10, 32199315, 'ca2GEqwF7zCBc', 'francoanalia781@gmail.com', '6079789xWW076WWx9z0Ax8z80x06988W66xWzW79670WA608zx', 1, 1),
(11, 32610365, 'caQcR0F0n0AJs', 'juanjosetorres333@gmail.com', '0z66x66W687A8b9zz7b8A6Wx667W0WA97960AxWx0Azx0876W7', 1, 1),
(12, 34514591, 'caCkHa6lffLpI', 'Marirome8907@gmail.com', 'W9zxAW6Az9W0788W087bbz9z7A8b607x90A870bAWbbbAbAz8A', 1, 1),
(13, 28839771, 'cai0OrNzIAJdc', 'Claumoraga2@gmail.com', '6zbzWA9bb76A7AAxb89WA90b98x69b6zAz70W8AWA97x80A9Wb', 1, 1),
(14, 33677741, 'ca5pGka3j30SA', 'Krlu_88@live.com', 'A9A7A8WA77zbzb78z69zA78Wx87bA8bzzWz96z8W89zWW07Wx0', 1, 1);



INSERT INTO `gestores`(`idGestor`, `nombreGestor`, `apellidoGestor`, `telefonoGestor`, `idUsuario`) VALUES 
(1,'Liliana', 'Paez', '2994704242',1),
(3,'Alexis','Bascuñan','2994523212',2);




--
-- Volcado de datos para la tabla `encuesta`
--


INSERT INTO `encuesta` (`idEncuesta`, `encTitulo`, `encDescripcion`, `encTipo`, `encPublica`) VALUES
(1, 'Actividad Física y Salud', '', 'encuesta', 1);

--
-- Volcado de datos para la tabla `pregunta`
--



INSERT INTO `pregunta` (`idPregunta`, `pregDescripcion`, `idEncuesta`, `idRespTipo`) VALUES
(1, 'Hace actividad física de forma cotidiana?', 1, 4),
(2, 'Se realiza exámenes médicos de forma periódica?', 1, 4),
(3, 'Presenta alguna enfermedad crónica o factor de riesgo cardiovascular? ', 1, 4),
(4, 'Tuvo alguna vez dolor de pecho,sensación de ahogo o perdida de conocimiento durante la actividad física?', 1, 4),
(5, 'Presenta algún inconveniente patológico que le dificulte realizar actividad física?', 1, 4);



--
-- Volcado de datos para la tabla `respuesta_opcion`
--



INSERT INTO `respuesta_opcion` (`idRespuestaOpcion`, `opRespvalor`, `idPregunta`) VALUES
(1, 'SI', 1),
(2, 'NO', 1),
(3, 'SI', 2),
(4, 'NO', 2),
(5, 'SI', 3),
(6, 'NO', 3),
(7, 'SI', 4),
(8, 'NO', 4),
(9, 'SI', 5),
(10,'NO', 5);


INSERT INTO `estadopago` (`idEstadoPago`, `descripcionEstadoPago`) VALUES
(1, 'total'),
(2, 'parcial'),
(3, 'cancelo');

INSERT INTO `importeinscripcion` (`idImporte`, `importe`, `deshabilitado`, `idTipoCarrera`) VALUES
(1, 300, NULL, 1),
(2, 300, NULL, 2);

--poblacional para la fecha limite pago
INSERT INTO `fechacarrera` (`idFechaCarrera`, `fechaCarrera`, `fechaLimiteUno`, `fechaLimiteDos`,`deshabilitado`,`idTipoCarrera`) VALUES
(1, '2019-09-08','2019-08-29',0,0,1),
(2, '2019-09-08','2019-08-29',0,0,2)