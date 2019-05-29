-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-05-2019 a las 22:47:55
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `carrera`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuesta`
--

CREATE TABLE `encuesta` (
  `idEncuesta` int(5) NOT NULL,
  `encTitulo` varchar(150) CHARACTER SET latin1 NOT NULL,
  `encDescripcion` varchar(250) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadopago`
--

CREATE TABLE `estadopago` (
  `idEstadoPago` int(8) NOT NULL,
  `descripcionEstadoPago` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadopagopersona`
--

CREATE TABLE `estadopagopersona` (
  `idEstadoPago` int(8) NOT NULL,
  `idPersona` int(8) NOT NULL,
  `fechaPago` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

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
-- Estructura de tabla para la tabla `gruposanguineo`
--

CREATE TABLE `gruposanguineo` (
  `idGrupoSanguineo` int(2) NOT NULL,
  `tipoGrupoSanguineo` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `gruposanguineo`
--

INSERT INTO `gruposanguineo` (`idGrupoSanguineo`, `tipoGrupoSanguineo`) VALUES
(1, 'A+'),
(2, 'A-'),
(3, 'B+'),
(4, 'B-'),
(5, 'AB+'),
(6, 'AB-'),
(7, '0+'),
(8, '0-');

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
  `dniCapitan` int(15) NOT NULL,
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
  `fechaInscPersona` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
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
  `respTipoDescripcion` varchar(30) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `respuesta_tipo`
--

INSERT INTO `respuesta_tipo` (`idRespTipo`, `respTipoDescripcion`) VALUES
(1, 'Texto'),
(2, 'Lista desplegable'),
(3, 'Selección múltiple'),
(4, 'Selección única');

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

-- --------------------------------------------------------

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
-- Estructura de tabla para la tabla `vinculopersona`
--

CREATE TABLE `vinculopersona` (
  `idVinculo` int(1) NOT NULL,
  `nombreVinculo` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `vinculopersona`
--

INSERT INTO `vinculopersona` (`idVinculo`, `nombreVinculo`) VALUES
(1, 'Familiar'),
(2, 'Pareja'),
(3, 'Amigo/a'),
(4, 'Otro');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  ADD PRIMARY KEY (`idEncuesta`);

--
-- Indices de la tabla `estadopago`
--
ALTER TABLE `estadopago`
  ADD PRIMARY KEY (`idEstadoPago`);

--
-- Indices de la tabla `estadopagopersona`
--
ALTER TABLE `estadopagopersona`
  ADD PRIMARY KEY (`idEstadoPago`,`idPersona`),
  ADD KEY `idPersona` (`idPersona`);

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
  ADD KEY `idPregunta` (`idPregunta`);

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
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  MODIFY `idEncuesta` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
  MODIFY `idPregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  MODIFY `idRespuesta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `respuesta_opcion`
--
ALTER TABLE `respuesta_opcion`
  MODIFY `idRespuestaOpcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

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
  MODIFY `idTalleRemera` int(1) NOT NULL AUTO_INCREMENT;

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
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `estadopagopersona`
--
ALTER TABLE `estadopagopersona`
  ADD CONSTRAINT `estadopagopersona_ibfk_1` FOREIGN KEY (`idEstadoPago`) REFERENCES `estadopago` (`idEstadoPago`),
  ADD CONSTRAINT `estadopagopersona_ibfk_2` FOREIGN KEY (`idPersona`) REFERENCES `persona` (`idPersona`);

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
-- Filtros para la tabla `usuario`
--
ALTER TABLE `respuesta_opcion`
  ADD CONSTRAINT `respuesta_opcion_ibfk_1` FOREIGN KEY (`idPregunta`) REFERENCES `pregunta` (`idPregunta`);

ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`);

ALTER TABLE `respuesta`
  ADD CONSTRAINT `respuesta_ibfk_1` FOREIGN KEY (`idPersona`) REFERENCES `persona` (`idPersona`),
  ADD CONSTRAINT `respuesta_ibfk_2` FOREIGN KEY (`idPregunta`) REFERENCES `pregunta` (`idPregunta`);

ALTER TABLE `pregunta`
  ADD CONSTRAINT `pregunta_ibfk_1` FOREIGN KEY (`idEncuesta`) REFERENCES `encuesta` (`idEncuesta`),
  ADD CONSTRAINT `pregunta_ibfk_2` FOREIGN KEY (`idRespTipo`) REFERENCES `respuesta_tipo` (`idRespTipo`);


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
