
INSERT INTO `usuario` (`idUsuario`,`dniUsuario`,`claveUsuario`,`mailUsuario`,`authkey`,`activado`,`idRol`) VALUES
(1,40960405,'caE6qCXEV/s2A','diegonmontes@gmail.com','1',1,1),
(2,39354991,'caDGuJRIWiRPs','aluderosa@gmail.com','1',1,1),
(3,34662680,'caVXPp5MKwxLQ','alewachu@gmail.com','1',1,1),
(4,39523328,'caw9VuCEKKmzs','arielvillalobos@gmail.com','1',1,1),
(5,14780341,'capXGYjL7lKE.','lilianapaez@gmail.com','1',1,2),
(6,32020624,'ca.qB0Uxiws5U','carolinasalgado@gmail.com','1',1,3),
(7,35178582,'ca5MeixRJe8SM','alexisbascuñan@gmail.com','1',1,3),
(8,40000000,'caf9l5OO9fegE','ciromartinez@gmail.com','1',1,1);


INSERT INTO `gestores`(`idGestor`, `nombreGestor`, `apellidoGestor`, `telefonoGestor`, `idUsuario`) VALUES 
(1,'Liliana', 'Paez', '2994704242',5),
(2,'Carolina','Salgado','2995624569',6),
(3,'Alexis','Bascuñan','2994523212',7);

INSERT INTO `fichamedica` (`idFichaMedica`,`obraSocial`,`peso`,`altura`,`frecuenciaCardiaca`,`idGrupoSanguineo`,`evaluacionMedica`,`intervencionQuirurgica`,`tomaMedicamentos`,`suplementos`,`observaciones`) VALUES
(1,'ISSN',80,1.73,60,1,1,1,1,1,'Me estoy haciendo los controles'),
(2,'ISSN',89,2.23,62,2,1,1,1,1,'Tengo tendinitis en la muñeca'),
(3,'PAMI',60,1.73,64,3,1,1,1,1,'Me hice analisis de sangre y tengo el colesterol alto'),
(4,'OSDEPYM',80,1.75,66,4,1,1,1,1,'Tuve una lesion de tobillo hace 2 meses'),
(5,'IOSFA',55,1.71,66,4,1,0,1,0,'Ninguna');


INSERT INTO `personadireccion` (`idPersonaDireccion`,`idLocalidad`,`direccionUsuario`) VALUES
(1,4634,'Cacheuta 1000'),
(2,4635,'Roca 1030'),
(3,4634,'Sarmiento 670'),
(4,4634,'Leguizamon 532'),
(5,4634,'Alderete 1200');


INSERT INTO `personaemergencia` (`idPersonaEmergencia`,`nombrePersonaEmergencia`,`apellidoPersonaEmergencia`,`telefonoPersonaEmergencia`,`idVinculoPersonaEmergencia`) VALUES
(1,'Juan Roman','Riquelme','2995954821',3),
(2,'Marcelo','Jara','2994623431',3),
(3,'Diego','Maradona','2995692312',1),
(4,'Juan','Perez','2996345678',3),
(5,'Omar','Solis','2996389273',3);


INSERT INTO `persona` (`idPersona`, `idTalleRemera`, `nombrePersona`, `apellidoPersona`, `fechaNacPersona`, `sexoPersona`, `nacionalidadPersona`, `telefonoPersona`, `mailPersona`, `idUsuario`, `idPersonaDireccion`, `idFichaMedica`, `fechaInscPersona`, `idPersonaEmergencia`, `idResultado`, `donador`, `deshabilitado`) VALUES
(1, 2, 'Diego', 'Montes', '1998-01-11', 'M', 'argentino', '2994232323', 'diegonmontes@gmail.com', 1, 1, 1, CURRENT_TIMESTAMP, 1, NULL, 1, 0),
(2, 2, 'Alumine', 'de Rosa', '1997-01-01', 'F', 'argentino', '2994732172', 'aluderosa@gmail.com', 2, 2, 2, CURRENT_TIMESTAMP, 2, NULL, 1, 0),
(3, 3, 'Alejandro', 'Wachu', '1997-04-11', 'M', 'argentino', '2995293245', 'alewachu@gmail.com', 3, 3, 3, CURRENT_TIMESTAMP, 3, NULL, 1, 0),
(4, 2, 'Ariel', 'Villalobos', '1992-01-10', 'M', 'argentino', '2994582623', 'arielvillalobos@gmail.com', 4, 4, 4, CURRENT_TIMESTAMP, 4, NULL, 0, 0),
(5, 2, 'Ciro', 'Martinez', '1982-03-04', 'M', 'argentino', '2994263518', 'ciromartinez@gmail.com', 8, 5, 5, CURRENT_TIMESTAMP, 5, NULL, 0, 0);


INSERT INTO `equipo` (`idEquipo`, `nombreEquipo`, `cantidadPersonas`, `idTipoCarrera`, `dniCapitan`, `deshabilitado`) VALUES
(1, '1', 2, 1, '34662680', 0),
(2, '2', 4, 2, '40960405', 0),
(3, '3', 2, 2, '40000000', 0);

INSERT INTO `grupo` (`idEquipo`, `idPersona`) VALUES
-- capitanes de los equipos
 (1, 3),
 (2, 1),
 (3, 5),
 
-- equipo 2 de cuatro personas
 (1, 2),
-- equipo 1 de dos personas
 (1, 4);

--
-- Volcado de datos para la tabla `carrerapersona`
--

INSERT INTO `carrerapersona`(`idTipoCarrera`, `idPersona`, `reglamentoAceptado`, `retiraKit`) VALUES 
(2,1,1,0), 
(2,2,1,0), 
(1,3,1,0), 
(1,4,1,0), 
(2,5,1,0);
 
--
-- Volcado de datos para la tabla `encuesta`
--

INSERT INTO `encuesta` (`idEncuesta`, `encTitulo`, `encDescripcion`, `encTipo`, `encPublica`) VALUES
(1, 'Página Web', 'Encuesta sobre el desarrollo de la página', 'encuesta', 1);

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`idPregunta`, `pregDescripcion`, `idEncuesta`, `idRespTipo`) VALUES
(1, '¿Le pareció fácil inscribirse?', 1, 4),
(2, '¿Qué le pareció el diseño?', 1, 3),
(3, '¿Cómo mejorarí­a la página?', 1, 1),
(4, 'Ponle un puntaje a esta página (10 excelente)', 1, 2);

--
-- Volcado de datos para la tabla `respuesta_opcion`
--

INSERT INTO `respuesta_opcion` (`idRespuestaOpcion`, `opRespvalor`, `idPregunta`) VALUES
(1, 'Si', 1),
(2, 'No', 1),
(3, 'Un poco', 1),
(4, 'No tanto', 1),
(5, 'Lindo', 2),
(6, 'Feo', 2),
(7, 'Regular', 2),
(8, 'Horrible', 2),
(9, 'Hermoso', 2),
(10, '1', 4),
(11, '2', 4),
(12, '3', 4),
(13, '4', 4),
(14, '5', 4),
(15, '6', 4),
(16, '7', 4),
(17, '8', 4),
(18, '9', 4),
(19, '10', 4);

--
-- Volcado de datos para la tabla `respuesta`
--

INSERT INTO `respuesta` (`idRespuesta`, `respValor`, `idPregunta`, `idPersona`) VALUES
(1, 'Si', 1, 1),
(2, 'Lindo', 2, 1),
(3, 'Nunca vi nada mas hermoso', 2, 1),
(4, 'No tanto', 2, 2),
(5, 'Si', 1, 3),
(6, 'Lindo', 2, 3);

