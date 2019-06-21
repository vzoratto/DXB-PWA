INSERT INTO `rol` (`idRol`, `descripcionRol`) VALUES (1, 'corredor');
INSERT INTO `rol` (`idRol`, `descripcionRol`) VALUES (2, 'administrador');
INSERT INTO `rol` (`idRol`, `descripcionRol`) VALUES (3, 'gestor');
INSERT INTO `rol` (`idRol`, `descripcionRol`) VALUES (4, 'invitado');

INSERT INTO `usuario` (`idUsuario`,`dniUsuario`,`claveUsuario`,`mailUsuario`,`authkey`,`activado`,`idRol`) VALUES
(1,12600600,'1234','prueba1@gmail.com','1',1,1),
(2,12600601,'1234','prueba2@gmail.com','1',1,1),
(3,12600602,'1234','prueba3@gmail.com','1',1,1),
(4,12600603,'1234','prueba4@gmail.com','1',1,1),
(5,12600604,'1234','prueba5@gmail.com','1',1,1),
(6,12620605,'1234','prueba6@gmail.com','1',1,1),
(7,30600606,'1234','prueba7@gmail.com','1',1,1),
(8,12600607,'1234','prueba8@gmail.com','1',1,1),
(9,25600608,'1234','prueba9@gmail.com','1',1,1),
(10,14657609,'1234','prueba10@gmail.com','1',1,1),
(11,12600610,'1234','prueba11@gmail.com','1',1,1),
(12,16607611,'1234','prueba12@gmail.com','1',1,1),
(13,82630612,'1234','prueba13@gmail.com','1',1,1),
(14,72634613,'1234','prueba14@gmail.com','1',1,1),
(15,32300614,'1234','prueba15@gmail.com','1',1,1);

INSERT INTO `fichamedica` (`obraSocial`,`peso`,`altura`,`frecuenciaCardiaca`,`idGrupoSanguineo`,`evaluacionMedica`,`intervencionQuirurgica`,`tomaMedicamentos`,`suplementos`,`observaciones`) VALUES
('ISSN',80,1.23,60,1,1,1,1,1,'creo que voy a ganar'),
('ISSN',89,2.23,62,2,1,1,1,1,'creo que voy a ganar'),
('pamy',60,1.73,64,3,1,1,1,1,'creo que voy a ganar'),
('coso',80,1.75,66,4,1,1,1,1,'creo que voy a ganar'),
('ISSN',71,1.78,80,5,1,1,1,1,'creo que voy a ganar'),
('coso',80,1.72,100,6,1,1,1,1,'creo que voy a ganar'),
('ISSN',80,1.74,40,1,1,1,1,1,'creo que voy a ganar'),
('ISSN',99,1.68,46,7,1,1,1,1,'creo que voy a ganar'),
('pamy',80,1.69,67,8,1,1,1,1,'creo que voy a ganar'),
('ISSN',102,1.89,89,8,1,1,1,1,'creo que voy a ganar'),
('ISSN',120,1.84,66,3,1,1,1,1,'creo que voy a ganar'),
('ISSN',87,1.63,69,5,1,1,1,1,'creo que voy a ganar'),
('coso',86,1.87,83,2,1,1,1,1,'creo que voy a ganar'),
('ISSN',67,1.45,59,7,1,1,1,1,'creo que voy a ganar'),
('ISSN',84,1.69,90,5,1,1,1,1,'creo que voy a ganar');

INSERT INTO `personadireccion` (`idPersonaDireccion`,`idLocalidad`,`direccionUsuario`) VALUES
(1,2365,'direcion 1234'),
(2,18,'direcion 1234'),
(3,1586,'direcion 1234'),
(4,82,'direcion 1234'),
(5,268,'direcion 1234'),
(6,846,'direcion 1234'),
(7,12,'direcion 1234'),
(8,698,'direcion 1234'),
(9,234,'direcion 1234'),
(10,489,'direcion 1234'),
(11,325,'direcion 1234'),
(12,259,'direcion 1234'),
(13,856,'direcion 1234'),
(14,864,'direcion 1234'),
(15,658,'direcion 1234');

INSERT INTO `personaemergencia` (`idPersonaEmergencia`,`nombrePersonaEmergencia`,`apellidoPersonaEmergencia`,`telefonoPersonaEmergencia`,`idVinculoPersonaEmergencia`) VALUES
(1,'juan','perez','2991234567',1),
(2,'marcelo','cos','2991234567',2),
(3,'edith','mimo','2991234567',3),
(4,'maria','suarez','2991234567',4),
(5,'digo','rubio','2991234567',2),
(6,'ricardo','flaco','2991234567',2),
(7,'marco','gordo','2991234567',4),
(8,'cristian','kilo','2991234567',3),
(9,'oscar','hernan','2991234567',2),
(10,'hipolito','rios','2991234567',2),
(11,'sebatia','perez','2991234567',3),
(12,'gol','prato','2991234567',1),
(13,'josefina','pez','2991234567',1),
(14,'delfina','fua','2991234567',2),
(15,'alfred','otroperez','2991234567',2);

INSERT INTO `persona` (`idPersona`, `idTalleRemera`, `nombrePersona`, `apellidoPersona`, `fechaNacPersona`, `sexoPersona`, `nacionalidadPersona`, `telefonoPersona`, `mailPersona`, `idUsuario`, `idPersonaDireccion`, `idFichaMedica`, `fechaInscPersona`, `idPersonaEmergencia`, `idResultado`, `donador`, `deshabilitado`) VALUES
(NULL, '2', 'juan', 'wacho', '2019-06-11', 'M', 'argentino', '2991234567', 'prueba1@gmail.com', '1', '1', '1', CURRENT_TIMESTAMP, '1', NULL, '1', '0'),
(NULL, '3', 'emili', 'perez', '2019-06-11', 'M', 'argentino', '2991234567', 'prueba2@gmail.com', '2', '2', '2', CURRENT_TIMESTAMP, '2', NULL, '1', '0'),
(NULL, '4', 'emiliano', 'moncho', '2019-06-11', 'M', 'argentino', '2991234567', 'prueba3@gmail.com', '3', '3', '3', CURRENT_TIMESTAMP, '3', NULL, '1', '0'),
(NULL, '5', 'jose', 'pepe', '2019-06-11', 'M', 'argentino', '2991234567', 'prueba4@gmail.com', '4', '4', '4', CURRENT_TIMESTAMP, '4', NULL, '1', '0'),
(NULL, '6', 'alu', 'apellidofeo', '2019-06-11', 'M', 'argentino', '2991234567', 'prueba5@gmail.com', '5', '5', '5', CURRENT_TIMESTAMP, '5', NULL, '1', '0'),
(NULL, '7', 'sofia', 'miranda', '2019-06-11', 'F', 'argentino', '2991234567', 'prueba6@gmail.com', '6', '6', '6', CURRENT_TIMESTAMP, '6', NULL, '1', '0'),
(NULL, '5', 'lili', 'mirinda', '2019-06-11', 'M', 'argentino', '2991234567', 'prueba7@gmail.com', '7', '7', '7', CURRENT_TIMESTAMP, '7', NULL, '1', '0'),
(NULL, '5', 'julia', 'cocas', '2019-06-11', 'F', 'argentino', '2991234567', 'prueba8@gmail.com', '8', '8', '8', CURRENT_TIMESTAMP, '8', NULL, '1', '0'),
(NULL, '5', 'julian', 'poncho', '2019-06-11', 'M', 'argentino', '2991234567', 'prueba9@gmail.com', '9', '9', '9', CURRENT_TIMESTAMP, '9', NULL, '1', '0'),
(NULL, '4', 'julieta', 'perez', '2019-06-11', 'F', 'argentino', '2991234567', 'prueba10@gmail.com', '10', '10', '10', CURRENT_TIMESTAMP, '10', NULL, '1', '0'),
(NULL, '3', 'mariano', 'berlingo', '2019-06-11', 'F', 'argentino', '2991234567', 'prueba11@gmail.com', '11', '11', '11', CURRENT_TIMESTAMP, '11', NULL, '1', '0'),
(NULL, '3', 'pepe', 'fiat', '2019-06-11', 'M', 'argentino', '2991234567', 'prueba12@gmail.com', '12', '12', '12', CURRENT_TIMESTAMP, '12', NULL, '1', '0'),
(NULL, '1', 'leopoldo', 'nosequeponer', '2019-06-11', 'M', 'argentino', '2991234567', 'prueba13@gmail.com', '13', '13', '13', CURRENT_TIMESTAMP, '13', NULL, '1', '0'),
(NULL, '1', 'esteban', 'gregoria', '2019-06-11', 'M', 'argentino', '2991234567', 'prueba14@gmail.com', '14', '14', '14', CURRENT_TIMESTAMP, '14', NULL, '1', '0'),
(NULL, '2', 'mia', 'matorras', '2019-06-11', 'M', 'argentino', '2991234567', 'prueba15@gmail.com', '15', '15', '15', CURRENT_TIMESTAMP, '15', NULL, '1', '0');

INSERT INTO `equipo` (`idEquipo`, `nombreEquipo`, `cantidadPersonas`, `idTipoCarrera`, `dniCapitan`, `deshabilitado`) VALUES
(NULL, 'elMaMejor', '4', '1', '12600600', '0'),
(NULL, 'corredoresDeBolsa', '4', '2', '12600601', '0'),
(NULL, 'Los Pantera', '4', '1', '12600602', '0'),
(NULL, 'mas rapido que vos', '2', '1', '12600603', '0'),
(NULL, 'Los correcaminos', '2', '2', '12600604', '0');

INSERT INTO `grupo` (`idEquipo`, `idPersona`) VALUES
-- capitanes de los equipos
 ('1', '1'),
 ('2', '2'),
 ('3', '3'),
 ('4', '4'),
 ('5', '5'),
-- equipo 1 de cuatro personas
 ('1', '6'),
 ('1', '7'),
 ('1', '8'),
-- equipo 2 de cuatro personas
 ('2', '9'),
 ('2', '10'),
 ('2', '11'),
-- equipo 3 de tres personas
 ('3', '12'),
 ('3', '13'),
 ('3', '14'),
-- equipo 4 de dos personas
 ('4', '15');
 
INSERT INTO `parametros` (`idParametros`, `cantidadCorredores`) VALUES 
(NULL, '4'),
(NULL, '2');