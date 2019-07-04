CREATE TABLE `provincia` (
  `idProvincia` tinyint(3) UNSIGNED NOT NULL,
  `nombreProvincia` varchar(50) NOT NULL,
  `codigoIso31662` char(4) NOT NULL,
  PRIMARY KEY (`idProvincia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `localidad` (
  `idLocalidad` int(8)  NOT NULL AUTO_INCREMENT,
  `idProvincia` tinyint(3) UNSIGNED NOT NULL,
  `nombreLocalidad` varchar(50) NOT NULL,
  `codigoPostal` smallint(6) NOT NULL,
  PRIMARY KEY (`idLocalidad`),
  FOREIGN KEY (`idProvincia`) REFERENCES provincia (`idProvincia`)  
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `parametros` (
	  `idParametros` int(8) NOT NULL AUTO_INCREMENT,
	  `cantidadCorredores` int(8) NOT NULL,
      PRIMARY KEY (`idParametros`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `grupoSanguineo` (
	  `idGrupoSanguineo` int(2) NOT NULL AUTO_INCREMENT,
	  `tipoGrupoSanguineo` varchar(8),
      PRIMARY KEY (`idGrupoSanguineo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `vinculoPersona` (
	  `idVinculo` int(1) NOT NULL AUTO_INCREMENT,
	  `nombreVinculo` varchar(32),
	  PRIMARY KEY (`idVinculo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `personaEmergencia`(
	  `idPersonaEmergencia` int(8) NOT NULL AUTO_INCREMENT,
	  `nombrePersonaEmergencia` varchar(64),
	  `apellidoPersonaEmergencia` varchar(64),
	  `telefonoPersonaEmergencia` varchar(32),
	  `idVinculoPersonaEmergencia` int(1),
	  PRIMARY KEY (`idPersonaEmergencia`),
	  FOREIGN KEY (`idVinculoPersonaEmergencia`) REFERENCES vinculoPersona (`idVinculo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


 CREATE TABLE `fichaMedica` (
 	  `idFichaMedica` int(8) NOT NULL AUTO_INCREMENT,
 	  `obraSocial` varchar(32),
 	  `peso` FLOAT(5,2),
 	  `altura` FLOAT(3,2),
 	  `frecuenciaCardiaca` int,
 	  `idGrupoSanguineo` int(2),
 	  `evaluacionMedica` BOOLEAN,
 	  `intervencionQuirurgica` BOOLEAN,
 	  `tomaMedicamentos` BOOLEAN,
 	  `suplementos` BOOLEAN,
 	  `observaciones` varchar(256),
 	  PRIMARY KEY (`idFichaMedica`),
	  FOREIGN KEY (`idGrupoSanguineo`) REFERENCES grupoSanguineo (`idGrupoSanguineo`)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
 
CREATE TABLE `talleremera` (
  `idTalleRemera` int(1)  NOT NULL AUTO_INCREMENT,
  `deshabilitado` tinyint(1) UNSIGNED NOT NULL,
  `talleRemera` varchar(4) NOT NULL,
  PRIMARY KEY (`idTalleRemera`)	  
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `personaDireccion` (
		`idPersonaDireccion` int(8) NOT NULL AUTO_INCREMENT,
		`idLocalidad` int(8),
		`direccionUsuario` varchar (64),
		PRIMARY KEY (`idPersonaDireccion`),
		FOREIGN KEY (`idLocalidad`) REFERENCES localidad (`idLocalidad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE table  `rol` (
	  `idRol` int(8) NOT NULL AUTO_INCREMENT,
	  `descripcionRol` varchar(64),
	  PRIMARY KEY (`idRol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE table  `usuario` (
	`idUsuario` int(8) NOT NULL AUTO_INCREMENT,
	`dniUsuario` int(15) NOT NULL,
	`claveUsuario` varchar(100) NOT NULL,
	`mailUsuario` varchar(100) NOT NULL,
	`authkey` varchar(250) NOT NULL,
	`activado` tinyint(1) NOT NULL DEFAULT '0',
	`idRol` int(8) NOT NULL,
	PRIMARY KEY (`idUsuario`),
    FOREIGN KEY (`idRol`) REFERENCES rol (`idRol`)	
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE table  `resultado` (
	  `idResultado` int(4) NOT NULL AUTO_INCREMENT,
	  PRIMARY KEY (`idResultado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE table  `encuesta` (
	  `idEncuesta` int(4) NOT NULL AUTO_INCREMENT,
	  PRIMARY KEY (`idEncuesta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `persona` (
	  `idPersona` int(8) NOT NULL AUTO_INCREMENT,
	  `idTalleRemera` int(1),
	  `dniCapitan` int(15),
	  `nombrePersona` varchar(64),
	  `apellidoPersona` varchar(64),
	  `fechaNacPersona` DATE,
	  `sexoPersona` varchar(1),
	  `nacionalidadPersona` varchar(64),
	  `telefonoPersona` varchar (32),
	  `mailPersona` varchar(64) NOT NULL,
	  `idUsuario` int(8) NOT NULL,
	  `idPersonaDireccion` int(8),
	  `idFichaMedica` int(8),
	  `fechaInscPersona` timestamp,
	  `idPersonaEmergencia` int(8),
	  `idResultado` int(4),
	  `donador` tinyint(1),
	  `deshabilitado` tinyint(1),  
	  PRIMARY KEY (`idPersona`),
	  FOREIGN KEY (`idUsuario`) REFERENCES usuario (`idUsuario`),
	  FOREIGN KEY (`idPersonaEmergencia`) REFERENCES personaEmergencia (`idPersonaEmergencia`),
	  FOREIGN KEY (`idPersonaDireccion`) REFERENCES personaDireccion (`idPersonaDireccion`),
	  FOREIGN KEY (`idFichaMedica`) REFERENCES fichaMedica (`idFichaMedica`),
	  FOREIGN KEY (`idResultado`) REFERENCES resultado (`idResultado`),
	  FOREIGN KEY (`idTalleRemera`) REFERENCES talleremera (`idTalleRemera`)  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `gestores` (
	  `idGestor` int(8) NOT NULL AUTO_INCREMENT,
	  `nombreGestor` varchar(64),
	  `apellidoGestor` varchar(64),
	  `telefonoGestor` varchar (32),
	  `idUsuario` int(8) NOT NULL,
	  PRIMARY KEY (`idGestor`),
	  FOREIGN KEY (`idUsuario`) REFERENCES usuario (`idUsuario`) 	  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-----------------------------------------------------------------------------
CREATE table  `importeinscripcion` (
	  `idImporte` int(4) NOT NULL AUTO_INCREMENT,
	  `importe` int(7) NOT NULL,
	  `deshabilitado` tinyint(1) DEFAULT NULL,
	  `idTipoCarrera` int(2) NOT NULL,
	  PRIMARY KEY(`idImporte`),
	  FOREIGN KEY (IdTipoCarrera) REFERENCES tipocarrera (idTipoCarrera)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE table  `estadopago` (
	  `idEstadoPago` int(8) NOT NULL AUTO_INCREMENT,
	  `descripcionEstadoPago` varchar(64),
	  PRIMARY KEY(`idEstadoPago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

`deshabilitado` tinyint(1) DEFAULT NULL,
	  `idTipoCarrera` int(2) NOT NULL,

CREATE table  `pago` (
	  `idPago` int(8) NOT NULL AUTO_INCREMENT,
      importePagado int(7) NOT NULL,
	  entidadPago varchar(64) NOT NULL,
	  imagenComprobante varchar(255) NOT NULL,
	  idPersona int(8) NOT NULL,
	  idImporte int(4) NOT NULL,
	  idEquipo int(8) DEFAULT NULL,
	  PRIMARY KEY (idPago),
	  FOREIGN KEY (`idPersona`) REFERENCES persona (`idPersona`),
	  FOREIGN KEY (`idImporte`) REFERENCES importeinscripcion (`idImporte`),
	  FOREIGN KEY (`idEquipo`) REFERENCES equipo (`idEquipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE table  `controlpago` (
	  `idControlpago` int(8) NOT NULL AUTO_INCREMENT,
	   idPago int(8) NOT NULL,
	  `fechaPago`  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	  fechachequeado date default 0,
	  idUsuario int(8) not null default 0,
	  PRIMARY KEY (idControlpago),
	  FOREIGN KEY (`idPago`) REFERENCES pago (`idPago`),
	  FOREIGN KEY (`idUsuario`) REFERENCES usuario (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;