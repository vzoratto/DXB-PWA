
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `carrera`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrerapersona`
--

CREATE TABLE `carrerapersona` (
  `idTipoCarrera` int(2) NOT NULL,
  `idPersona` int(8) NOT NULL,
  `reglamentoAceptado` tinyint(1) DEFAULT NULL,
  `retiraKit` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuesta`
--

CREATE TABLE `encuesta` (
  `idEncuesta` int(5) NOT NULL,
  `encTitulo` varchar(150) CHARACTER SET latin1 NOT NULL,
  `encDescripcion` varchar(250) CHARACTER SET latin1 NOT NULL,
  `encTipo` varchar(10) CHARACTER SET latin1 NOT NULL,
  `encPublica` TINYINT(1)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

CREATE TABLE `estadopago`(
    `idEstadoPago` INT(8) NOT NULL,
    `descripcionEstadoPago` VARCHAR(64)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;


--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `idEquipo` int(4) NOT NULL,
  `nombreEquipo` varchar(64) DEFAULT NULL,
  `cantidadPersonas` int(8) DEFAULT NULL,
  `idTipoCarrera` int(2) NOT NULL,
  `dniCapitan` int(15) NOT NULL,
  `deshabilitado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



--
-- Estructura de tabla para la tabla `fichamedica`
--

CREATE TABLE `fichamedica` (
  `idFichaMedica` int(8) NOT NULL,
  `obraSocial` varchar(32) DEFAULT NULL,
  `peso` float(5,2) DEFAULT NULL,
  `altura` float(3,2) DEFAULT NULL,
  `frecuenciaCardiaca` int(3) DEFAULT NULL,
  `idGrupoSanguineo` int(2) DEFAULT NULL,
  `evaluacionMedica` tinyint(1) DEFAULT NULL,
  `intervencionQuirurgica` tinyint(1) DEFAULT NULL,
  `tomaMedicamentos` tinyint(1) DEFAULT NULL,
  `suplementos` tinyint(1) DEFAULT NULL,
  `observaciones` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestores`
--

CREATE TABLE `gestores` (
  `idGestor` int(8) NOT NULL,
  `nombreGestor` varchar(64) DEFAULT NULL,
  `apellidoGestor` varchar(64) DEFAULT NULL,
  `telefonoGestor` varchar(32) DEFAULT NULL,
  `idUsuario` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `idEquipo` int(4) NOT NULL,
  `idPersona` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gruposanguineo`
--

CREATE TABLE `gruposanguineo` (
  `idGrupoSanguineo` int(2) NOT NULL,
  `tipoGrupoSanguineo` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidad`
--

CREATE TABLE `localidad` (
  `idLocalidad` int(8) NOT NULL,
  `idProvincia` tinyint(3) UNSIGNED NOT NULL,
  `nombreLocalidad` varchar(50) NOT NULL,
  `codigoPostal` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Estructura de tabla para la tabla `parametros`
--

CREATE TABLE `parametros` (
  `idParametros` int(8) NOT NULL,
  `cantidadCorredores` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `idPersona` int(8) NOT NULL,
  `idTalleRemera` int(1) NOT NULL,
  `nombrePersona` varchar(64) DEFAULT NULL,
  `apellidoPersona` varchar(64) DEFAULT NULL,
  `fechaNacPersona` date DEFAULT NULL,
  `sexoPersona` varchar(1) DEFAULT NULL,
  `nacionalidadPersona` varchar(64) DEFAULT NULL,
  `telefonoPersona` varchar(32) DEFAULT NULL,
  `mailPersona` varchar(64) NOT NULL,
  `idUsuario` int(8) NOT NULL,
  `idPersonaDireccion` int(8) DEFAULT NULL,
  `idFichaMedica` int(8) DEFAULT NULL,
  `fechaInscPersona` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idPersonaEmergencia` int(8) DEFAULT NULL,
  `idResultado` int(4) DEFAULT NULL,
  `donador` tinyint(1) DEFAULT NULL,
  `deshabilitado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personadireccion`
--

CREATE TABLE `personadireccion` (
  `idPersonaDireccion` int(8) NOT NULL,
  `idLocalidad` int(8) DEFAULT NULL,
  `direccionUsuario` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personaemergencia`
--

CREATE TABLE `personaemergencia` (
  `idPersonaEmergencia` int(8) NOT NULL,
  `nombrePersonaEmergencia` varchar(64) DEFAULT NULL,
  `apellidoPersonaEmergencia` varchar(64) DEFAULT NULL,
  `telefonoPersonaEmergencia` varchar(32) DEFAULT NULL,
  `idVinculoPersonaEmergencia` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE `pregunta` (
  `idPregunta` int(11) NOT NULL,
  `pregDescripcion` varchar(250) CHARACTER SET latin1 NOT NULL,
  `idEncuesta` int(5) NOT NULL,
  `idRespTipo` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE `provincia` (
  `idProvincia` tinyint(3) UNSIGNED NOT NULL,
  `nombreProvincia` varchar(50) NOT NULL,
  `codigoIso31662` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Estructura de tabla para la tabla `respuesta`
--

CREATE TABLE `respuesta` (
  `idRespuesta` int(11) NOT NULL,
  `respValor` varchar(250) CHARACTER SET latin1 NOT NULL,
  `idPregunta` int(11) NOT NULL,
  `idPersona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta_opcion`
--

CREATE TABLE `respuesta_opcion` (
  `idRespuestaOpcion` int(11) NOT NULL,
  `opRespvalor` varchar(250) CHARACTER SET latin1 NOT NULL,
  `idPregunta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta_tipo`
--

CREATE TABLE `respuesta_tipo` (
  `idRespTipo` int(4) NOT NULL,
  `respTipoDescripcion` varchar(15) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultado`
--

CREATE TABLE `resultado` (
  `idResultado` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idRol` int(8) NOT NULL,
  `descripcionRol` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `talleremera`
--

CREATE TABLE `talleremera` (
  `idTalleRemera` int(1) NOT NULL,
  `deshabilitado` tinyint(1) DEFAULT NULL,
  `talleRemera` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Estructura de tabla para la tabla `tipocarrera`
--

CREATE TABLE `tipocarrera` (
  `idTipoCarrera` int(2) NOT NULL,
  `descripcionCarrera` varchar(64) DEFAULT NULL,
  `reglamento` varchar(128) DEFAULT NULL,
  `deshabilitado` tinyint(1) DEFAULT NULL,
  `cantidadMaximaCorredores` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(8) NOT NULL,
  `dniUsuario` int(15) NOT NULL,
  `claveUsuario` varchar(100) NOT NULL,
  `mailUsuario` varchar(100) NOT NULL,
  `authkey` varchar(50) NOT NULL,
  `activado` tinyint(1) NOT NULL,
  `idRol` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listadeespera`
--

CREATE TABLE `listadeespera` (
  `idListaDeEspera` int(8) NOT NULL,
  `idPersona` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vinculopersona`
--

CREATE TABLE `vinculopersona` (
  `idVinculo` int(1) NOT NULL,
  `nombreVinculo` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta_trivia`
--

CREATE TABLE `respuesta_trivia` (
  `idRespTrivia` int(11) NOT NULL,
  `respTriviaValor` varchar(250) NOT NULL,
  `idPregunta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
CREATE table  `importeinscripcion` (
	  `idImporte` int(4) NOT NULL,
	  `importe` int(7) NOT NULL,
	  `deshabilitado` tinyint(1) DEFAULT NULL,
	  `idTipoCarrera` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
CREATE TABLE `pago`(
    `idPago` INT(8) NOT NULL,
    `importePagado` INT(7) NOT NULL,
    `entidadPago` VARCHAR(64) NOT NULL,
    `imagenComprobante` VARCHAR(255) NOT NULL,
    `idPersona` INT(8) NOT NULL,
    `idImporte` INT(4) NOT NULL,
    `idEquipo` INT(8) DEFAULT NULL 
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
-- --------------------------------------------------------
CREATE TABLE `controlpago`(
    `idControlpago` INT(8) NOT NULL,
    `idPago` INT(8) NOT NULL,
    `fechaPago` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `fechachequeado` DATE DEFAULT 0,
    `chequeado` TINYINT(1) NOT NULL,
    `idGestor` INT(8) NOT NULL DEFAULT 0
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
-- --------------------------------------------------------

CREATE TABLE `estadopagoequipo`(
    `idEstadoPago` INT(8) NOT NULL,
    `idEquipo` INT(8) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
-- --------------------------------------------------------

-- nuevas tablas lili para el limite de pago
CREATE table  `fechacarrera`(
	   idFechaCarrera int(8) NOT NULL AUTO_INCREMENT,
	   fechaCarrera date NOT NULL,
	   fechaLimiteUno date Default null,
	   fechaLimiteDos date Default null,
	  `deshabilitado` tinyint(1) DEFAULT NULL,
	  `idTipoCarrera` int(8) NOT NULL ,
	  PRIMARY KEY (idFechaCarrera),
	  FOREIGN KEY (`idTipoCarrera`) REFERENCES tipocarrera (`idTipoCarrera`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `carrerapersonacopia` (
  `idTipoCarrera` int(2) NOT NULL,
  `idPersona` int(8) NOT NULL,
  `reglamentoAceptado` tinyint(1) DEFAULT NULL,
  `retiraKit` tinyint(1) DEFAULT 0,
  PRIMARY KEY (idTipoCarrera,idPersona),
  FOREIGN KEY (idTipoCarrera) REFERENCES tipocarrera(idTipoCarrera),
  FOREIGN KEY (idPersona) REFERENCES persona(idPersona)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `grupocopia` (
  `idEquipo` int(4) NOT NULL,
  `idPersona` int(8) NOT NULL,
  PRIMARY KEY (idEquipo,idPersona),
  FOREIGN KEY (idEquipo) REFERENCES equipo(idEquipo),
  FOREIGN KEY (idPersona) REFERENCES persona(idPersona)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrerapersona`
--
ALTER TABLE `carrerapersona`
  ADD PRIMARY KEY (`idPersona`,`idTipoCarrera`),
  ADD KEY `idTipoCarrera` (`idTipoCarrera`);

ALTER TABLE `importeinscripcion`
  ADD PRIMARY KEY(`idImporte`),
	ADD KEY `idTipoCarrera` (`idTipoCarrera`);

ALTER TABLE `pago`
ADD PRIMARY KEY(`idPago`),
ADD KEY `idPersona` (`idPersona`),
ADD KEY `idImporte` (`idImporte`),
ADD KEY `idEquipo`  (`idEquipo`);


ALTER TABLE `controlpago`
  ADD PRIMARY KEY(`idControlpago`),
  ADD KEY `idPago` (`idPago`),
  ADD KEY `idGestor` (`idGestor`);



ALTER TABLE `estadopagoequipo`
  ADD PRIMARY KEY(`idEstadoPago`, `idEquipo`),
  ADD KEY `idEstadoPago` (`idEstadoPago`),
  ADD KEY `idEquipo` (`idEquipo`);


--
-- Indices de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  ADD PRIMARY KEY (`idEncuesta`);

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`idEquipo`),
  ADD KEY `idTipoCarrera` (`idTipoCarrera`);

--
-- Indices de la tabla `estadopago`
--
ALTER TABLE `estadopago`
  ADD PRIMARY KEY (`idEstadoPago`);



--
-- Indices de la tabla `fichamedica`
--
ALTER TABLE `fichamedica`
  ADD PRIMARY KEY (`idFichaMedica`),
  ADD KEY `idGrupoSanguineo` (`idGrupoSanguineo`);

--
-- Indices de la tabla `gestores`
--
ALTER TABLE `gestores`
  ADD PRIMARY KEY (`idGestor`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`idEquipo`,`idPersona`),
  ADD KEY `idPersona` (`idPersona`);

--
-- Indices de la tabla `gruposanguineo`
--
ALTER TABLE `gruposanguineo`
  ADD PRIMARY KEY (`idGrupoSanguineo`);

--
-- Indices de la tabla `localidad`
--
ALTER TABLE `localidad`
  ADD PRIMARY KEY (`idLocalidad`),
  ADD KEY `idProvincia` (`idProvincia`);

--
-- Indices de la tabla `parametros`
--
ALTER TABLE `parametros`
  ADD PRIMARY KEY (`idParametros`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idPersona`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idPersonaEmergencia` (`idPersonaEmergencia`),
  ADD KEY `idPersonaDireccion` (`idPersonaDireccion`),
  ADD KEY `idFichaMedica` (`idFichaMedica`),
  ADD KEY `idTalleRemera` (`idTalleRemera`),
  ADD KEY `idResultado` (`idResultado`);

--
-- Indices de la tabla `personadireccion`
--
ALTER TABLE `personadireccion`
  ADD PRIMARY KEY (`idPersonaDireccion`),
  ADD KEY `idLocalidad` (`idLocalidad`);

--
-- Indices de la tabla `personaemergencia`
--
ALTER TABLE `personaemergencia`
  ADD PRIMARY KEY (`idPersonaEmergencia`),
  ADD KEY `idVinculoPersonaEmergencia` (`idVinculoPersonaEmergencia`);

--
-- Indices de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD PRIMARY KEY (`idPregunta`),
  ADD KEY `idEncuesta` (`idEncuesta`),
  ADD KEY `idRespTipo` (`idRespTipo`);

--
-- Indices de la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`idProvincia`);

--
-- Indices de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD PRIMARY KEY (`idRespuesta`),
  ADD KEY `idPregunta` (`idPregunta`),
  ADD KEY `idPersona` (`idPersona`);

--
-- Indices de la tabla `respuesta_opcion`
--
ALTER TABLE `respuesta_opcion`
  ADD PRIMARY KEY (`idRespuestaOpcion`),
  ADD KEY `idPregunta` (`idPregunta`);

--
-- Indices de la tabla `respuesta_tipo`
--
ALTER TABLE `respuesta_tipo`
  ADD PRIMARY KEY (`idRespTipo`);

--
-- Indices de la tabla `resultado`
--
ALTER TABLE `resultado`
  ADD PRIMARY KEY (`idResultado`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `talleremera`
--
ALTER TABLE `talleremera`
  ADD PRIMARY KEY (`idTalleRemera`);

--
-- Indices de la tabla `tipocarrera`
--
ALTER TABLE `tipocarrera`
  ADD PRIMARY KEY (`idTipoCarrera`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `idRol` (`idRol`);

--
-- Indices de la tabla `vinculopersona`
--
ALTER TABLE `vinculopersona`
  ADD PRIMARY KEY (`idVinculo`);

--
-- Indices de la tabla `listadeespera`
--
ALTER TABLE `listadeespera`
  ADD PRIMARY KEY (`idListaDeEspera`);


--
-- Indices de la tabla `respuesta_trivia`
--
ALTER TABLE `respuesta_trivia`
  ADD PRIMARY KEY (`idRespTrivia`),
  ADD KEY `idPregunta` (`idPregunta`);


--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  MODIFY `idEncuesta` int(5) NOT NULL AUTO_INCREMENT;

ALTER TABLE `importeinscripcion`
  MODIFY `idImporte` int(4) NOT NULL AUTO_INCREMENT;

ALTER TABLE `pago`
  MODIFY `idPago` INT(8) NOT NULL AUTO_INCREMENT;

ALTER TABLE `controlpago`
  MODIFY `idControlpago` INT(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `idEquipo` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estadopago`
--
ALTER TABLE `estadopago`
  MODIFY `idEstadoPago` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fichamedica`
--
ALTER TABLE `fichamedica`
  MODIFY `idFichaMedica` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gestores`
--
ALTER TABLE `gestores`
  MODIFY `idGestor` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gruposanguineo`
--
ALTER TABLE `gruposanguineo`
  MODIFY `idGrupoSanguineo` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `localidad`
--
ALTER TABLE `localidad`
  MODIFY `idLocalidad` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22964;

--
-- AUTO_INCREMENT de la tabla `parametros`
--
ALTER TABLE `parametros`
  MODIFY `idParametros` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `idPersona` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personadireccion`
--
ALTER TABLE `personadireccion`
  MODIFY `idPersonaDireccion` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personaemergencia`
--
ALTER TABLE `personaemergencia`
  MODIFY `idPersonaEmergencia` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `idPregunta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  MODIFY `idRespuesta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `respuesta_opcion`
--
ALTER TABLE `respuesta_opcion`
  MODIFY `idRespuestaOpcion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `respuesta_tipo`
--
ALTER TABLE `respuesta_tipo`
  MODIFY `idRespTipo` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `resultado`
--
ALTER TABLE `resultado`
  MODIFY `idResultado` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `talleremera`
--
ALTER TABLE `talleremera`
  MODIFY `idTalleRemera` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tipocarrera`
--
ALTER TABLE `tipocarrera`
  MODIFY `idTipoCarrera` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `vinculopersona`
--
ALTER TABLE `vinculopersona`
  MODIFY `idVinculo` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `listadeespera`
--
ALTER TABLE `listadeespera`
  MODIFY `idListaDeEspera` int(8) NOT NULL AUTO_INCREMENT;



--
-- AUTO_INCREMENT de la tabla `respuesta_trivia`
--
ALTER TABLE `respuesta_trivia`
  MODIFY `idRespTrivia` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;


--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrerapersona`
--
ALTER TABLE `carrerapersona`
  ADD CONSTRAINT `carrerapersona_ibfk_1` FOREIGN KEY (`idPersona`) REFERENCES `persona` (`idPersona`),
  ADD CONSTRAINT `carrerapersona_ibfk_2` FOREIGN KEY (`idTipoCarrera`) REFERENCES `tipocarrera` (`idTipoCarrera`);

--
-- Filtros para la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD CONSTRAINT `equipo_ibfk_1` FOREIGN KEY (`idTipoCarrera`) REFERENCES `tipocarrera` (`idTipoCarrera`);


ALTER TABLE `importeinscripcion`
  ADD CONSTRAINT `importeinscripcion_ibfk_1` FOREIGN KEY (`idTipoCarrera`) REFERENCES `tipocarrera` (`idTipoCarrera`);


ALTER TABLE `pago`
  ADD CONSTRAINT `pago_ibfk_1` FOREIGN KEY (`idPersona`) REFERENCES `persona` (`idPErsona`),
  ADD CONSTRAINT `pago_ibfk_2` FOREIGN KEY (`idImporte`) REFERENCES `importeinscripcion` (`idImporte`),
  ADD CONSTRAINT `pago_ibfk_3` FOREIGN KEY (`idEquipo`) REFERENCES `equipo` (`idEquipo`);

ALTER TABLE `controlpago`
  ADD CONSTRAINT `controlpago_ibfk_1` FOREIGN KEY (`idPago`) REFERENCES `pago` (`idPago`),
  ADD CONSTRAINT `controlpago_ibfk_2` FOREIGN KEY (`idGestor`) REFERENCES `gestores` (`idGestor`);

ALTER TABLE `estadopagoequipo`
  ADD CONSTRAINT `estadopagoequipo_ibfk_1` FOREIGN KEY (`idEstadoPago`) REFERENCES `estadopago` (`idEstadoPago`),
  ADD CONSTRAINT `estadopagoequipo_ibfk_2` FOREIGN KEY (`idEquipo`) REFERENCES `equipo` (`idEquipo`);

--
-- Filtros para la tabla `fichamedica`
--
ALTER TABLE `fichamedica`
  ADD CONSTRAINT `fichamedica_ibfk_1` FOREIGN KEY (`idGrupoSanguineo`) REFERENCES `gruposanguineo` (`idGrupoSanguineo`);

--
-- Filtros para la tabla `gestores`
--
ALTER TABLE `gestores`
  ADD CONSTRAINT `gestores_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `grupo_ibfk_1` FOREIGN KEY (`idEquipo`) REFERENCES `equipo` (`idEquipo`),
  ADD CONSTRAINT `grupo_ibfk_2` FOREIGN KEY (`idPersona`) REFERENCES `persona` (`idPersona`);

--
-- Filtros para la tabla `localidad`
--
ALTER TABLE `localidad`
  ADD CONSTRAINT `localidad_ibfk_1` FOREIGN KEY (`idProvincia`) REFERENCES `provincia` (`idProvincia`);

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `persona_ibfk_2` FOREIGN KEY (`idPersonaEmergencia`) REFERENCES `personaemergencia` (`idPersonaEmergencia`),
  ADD CONSTRAINT `persona_ibfk_3` FOREIGN KEY (`idPersonaDireccion`) REFERENCES `personadireccion` (`idPersonaDireccion`),
  ADD CONSTRAINT `persona_ibfk_4` FOREIGN KEY (`idFichaMedica`) REFERENCES `fichamedica` (`idFichaMedica`),
  ADD CONSTRAINT `persona_ibfk_5` FOREIGN KEY (`idResultado`) REFERENCES `resultado` (`idResultado`),
  ADD CONSTRAINT `persona_ibfk_6` FOREIGN KEY (`idTalleRemera`) REFERENCES `talleremera` (`idTalleRemera`);

--
-- Filtros para la tabla `personadireccion`
--
ALTER TABLE `personadireccion`
  ADD CONSTRAINT `personadireccion_ibfk_1` FOREIGN KEY (`idLocalidad`) REFERENCES `localidad` (`idLocalidad`);

--
-- Filtros para la tabla `personaemergencia`
--
ALTER TABLE `personaemergencia`
  ADD CONSTRAINT `personaemergencia_ibfk_1` FOREIGN KEY (`idVinculoPersonaEmergencia`) REFERENCES `vinculopersona` (`idVinculo`);

--
-- Filtros para la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD CONSTRAINT `pregunta_ibfk_1` FOREIGN KEY (`idEncuesta`) REFERENCES `encuesta` (`idEncuesta`),
  ADD CONSTRAINT `pregunta_ibfk_2` FOREIGN KEY (`idRespTipo`) REFERENCES `respuesta_tipo` (`idRespTipo`);

--
-- Filtros para la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD CONSTRAINT `respuesta_ibfk_1` FOREIGN KEY (`idPersona`) REFERENCES `persona` (`idPersona`),
  ADD CONSTRAINT `respuesta_ibfk_2` FOREIGN KEY (`idPregunta`) REFERENCES `pregunta` (`idPregunta`);

--
-- Filtros para la tabla `respuesta_opcion`
--
ALTER TABLE `respuesta_opcion`
  ADD CONSTRAINT `respuesta_opcion_ibfk_1` FOREIGN KEY (`idPregunta`) REFERENCES `pregunta` (`idPregunta`);

--
-- Filtros para la tabla `listadeespera`
--
ALTER TABLE `listadeespera`
  ADD CONSTRAINT `listadeespera_ibfk_1` FOREIGN KEY (`idPersona`) REFERENCES `persona` (`idPersona`);


--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
