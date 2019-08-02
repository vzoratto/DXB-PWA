
INSERT INTO `usuario` (`idUsuario`,`dniUsuario`,`claveUsuario`,`mailUsuario`,`authkey`,`activado`,`idRol`) VALUES
(1,14780341,'capXGYjL7lKE.','lilianapaez@gmail.com','1',1,2),
(2,35178582,'ca5MeixRJe8SM','alexisbascuñan@gmail.com','1',1,3);



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

