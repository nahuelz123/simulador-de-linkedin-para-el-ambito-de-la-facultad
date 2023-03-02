-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-02-2023 a las 17:00:49
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tp_final`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `applications`
--

CREATE TABLE `applications` (
  `studentId` int(11) NOT NULL,
  `id_JobOfert` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `applications`
--

INSERT INTO `applications` (`studentId`, `id_JobOfert`) VALUES
(0, 71),
(0, 72),
(0, 74),
(2, 65),
(2, 66),
(2, 67),
(2, 68),
(2, 70);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `career`
--

CREATE TABLE `career` (
  `careerId` int(11) NOT NULL,
  `DESCRIPTION` varchar(100) NOT NULL,
  `activo` tinyint(1) DEFAULT NULL CHECK (`activo` in (1,0))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `career`
--

INSERT INTO `career` (`careerId`, `DESCRIPTION`, `activo`) VALUES
(1, 'Naval engineering', 1),
(2, 'Fishing engineering', 0),
(3, 'University technician in programming', 1),
(4, 'University technician in computer systems', 1),
(5, 'University technician in textile production', 1),
(6, 'University technician in administration', 1),
(7, 'Bachelor in environmental management', 0),
(8, 'University technician in environmental procedures and technologies', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company`
--

CREATE TABLE `company` (
  `id_company` int(11) NOT NULL,
  `CompanyName` varchar(50) NOT NULL,
  `BusinessName` varchar(50) NOT NULL,
  `CompanyAdress` varchar(100) NOT NULL,
  `cuil` float NOT NULL,
  `telephone` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `web` varchar(50) NOT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `company`
--

INSERT INTO `company` (`id_company`, `CompanyName`, `BusinessName`, `CompanyAdress`, `cuil`, `telephone`, `email`, `web`, `password`) VALUES
(1, 'acer', 'acer', 'Deán Funes 3350', 4444240, 4695038, 'acer@outlook.com', 'acer.com.ar', '123'),
(3, 'Mercado Libre', 'Mercado Libre SRL', 'Caseros 3.039, piso 2°, de la Ciudad Autónoma de Buenos Aires', 30703100000, 4014800, 'mercadolibre@outlook.com', 'https://www.mercadolibre.com.ar', '123'),
(4, 'Don Saturnino', 'don satur', 'Av. del Libertador 110 1º A, B1638BEN Vicente López, Provincia de Buenos Aires', 30516000000, 1147187910, 'donsatur@outlook.com', 'www.donsatur.com.ar', '123'),
(5, 'chuker', 'chuker', 'Deán Funes 33515', 88962, 27788, 'chuker@gmail.com', 'chuker.com', '123'),
(18, 'uala', 'uala', 'Nicaragua 4677, C1414BVG, Ciudad Autónoma de Buenos Aires, Argentina.', 30716300000, 1152633563, 'uala@outlook.com', 'uala.com.ar', '123'),
(19, 'indico', 'indico', ' San Juan 1829, B7600BWF Mar del Plata, Provincia de Buenos Aires', 33716300000, 2147483647, 'indico@outlook.com', 'indico.com.ar', '123'),
(20, 'Pampa Fish ', 'Pampa Fish S.A.', ' Talcahuano, B7600 Mar del Plata, Provincia de Buenos Aires', 30709500000, 2147483647, 'pamapfish@outlook.com', 'pampafish.com.ar', '123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job`
--

CREATE TABLE `job` (
  `jobPositionId` int(11) NOT NULL,
  `careerId` int(11) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `job`
--

INSERT INTO `job` (`jobPositionId`, `careerId`, `description`) VALUES
(1, 1, 'Jr naval engineer'),
(2, 1, 'Ssr naval engineer'),
(3, 1, 'Sr naval engineer'),
(4, 2, 'Jr fisheries engineer'),
(5, 2, 'Ssr fisheries engineer'),
(6, 2, 'Sr fisheries engineer'),
(7, 3, 'Java Jr developer'),
(8, 3, 'PHP Jr developer'),
(9, 3, 'Ssr developer'),
(10, 4, 'Full Stack developer'),
(11, 4, 'Sr developer'),
(12, 4, 'Project manager'),
(13, 4, 'Scrum Master'),
(14, 5, 'Jr textile operator'),
(15, 5, 'Textile production assistant manager'),
(16, 5, 'Textile design assistant'),
(17, 5, 'Textile production supervisor'),
(18, 6, 'Head of administration'),
(19, 6, 'Management analyst'),
(20, 6, 'Administration intern'),
(21, 7, 'Environmental management specialist'),
(22, 7, 'Environmental management coordinator'),
(23, 8, 'Received technician');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_ofert`
--

CREATE TABLE `job_ofert` (
  `id_JobOfert` int(11) NOT NULL,
  `id_company` int(11) NOT NULL,
  `jobPositionId` int(11) NOT NULL,
  `cargaHoraria` int(11) NOT NULL,
  `activo` tinyint(1) DEFAULT NULL CHECK (`activo` in (1,0)),
  `titulo` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `puesto` varchar(100) NOT NULL,
  `imagen` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `job_ofert`
--

INSERT INTO `job_ofert` (`id_JobOfert`, `id_company`, `jobPositionId`, `cargaHoraria`, `activo`, `titulo`, `descripcion`, `puesto`, `imagen`) VALUES
(61, 20, 1, 48, 1, 'ingeniero pesquero', 'Diseñar barcos y otros equipos de pesca, incluyendo sistemas de manejo de captura, sistemas de refrigeración y preservación de pescado.  Investigar y desarrollar tecnologías para mejorar la eficiencia', 'Jr naval engineer', 'joboffer1.jpg'),
(62, 20, 2, 48, 1, 'Ingeniero de proyectos pesqueros', ' responsable de planificar y supervisar proyectos relacionados con la industria pesquera, incluyendo la construcción y el diseño de barcos y otros equipos de pesca', 'Ssr naval engineer', 'joboffer2.jpg'),
(63, 1, 1, 48, 1, 'Consultor pesquero', 'rabaja con comunidades de pescadores y empresas pesqueras para identificar y resolver desafíos y mejorar la eficiencia y la rentabilidad de la industria pesquera.', 'Jr naval engineer', 'joboffer1.jpg'),
(64, 1, 2, 48, 1, 'Investigador pesquero', ' lleva a cabo investigaciones y estudios para mejorar el conocimiento sobre la biología y la ecología de las especies de peces, la gestión de los recursos marinos y la sostenibilidad de la pesca.', 'Ssr naval engineer', 'joboffer1.jpg'),
(65, 1, 14, 48, 1, 'Ingeniero de procesos textiles', 'responsable de diseñar y optimizar los procesos de fabricación de productos textiles, incluyendo la selección de materiales, el diseño de maquinaria y el control de calidad.', 'Jr textile operator', 'joboffer1.jpg'),
(66, 19, 16, 48, 1, 'Ingeniero de productos textiles', 'responsable de desarrollar y mejorar productos textiles, incluyendo tejidos, prendas de vestir y materiales técnicos.', 'Textile design assistant', 'joboffer2.jpg'),
(67, 19, 15, 48, 1, 'Ingeniero de tecnología textil:', 'encargado de investigar y desarrollar nuevas tecnologías y materiales para la industria textil, incluyendo tejidos inteligentes, materiales biodegradables y técnicas de producción sostenibles.', 'Textile production assistant manager', 'joboffer2.jpg'),
(68, 19, 17, 48, 1, 'Ingeniero de calidad textil', 'responsable de garantizar la calidad de los productos textiles a lo largo de todo el proceso de fabricación, incluyendo la inspección de materias primas, el monitoreo de los procesos y la evaluación d', 'Textile production supervisor', 'joboffer3.jpg'),
(69, 1, 10, 48, 1, 'programador acer ', 'esponsable de desarrollar y mantener aplicaciones web complejas que incluyen tanto el lado del cliente como el lado del servidor. Esto significa que un programador full-stack debe ser capaz de diseñar', 'Full Stack developer', 'joboffer3.jpg'),
(70, 19, 17, 48, 1, 'Ingeniero de productos', 'responsable de desarrollar y mejorar productos textiles, incluyendo tejidos, prendas de vestir y materiales técnicos.', 'Textile production supervisor', 'joboffer2.jpg'),
(71, 1, 4, 48, 1, 'Gerente de pesquería', 'responsable de la gestión y planificación de la pesca, así como de la implementación de medidas sostenibles y regulaciones ambientales.', 'Jr fisheries engineer', 'joboffer1.jpg'),
(72, 1, 4, 48, 1, 'Técnico de pesquería', ' responsable de la implementación práctica de las regulaciones y medidas sostenibles en la pesca, así como de la supervisión y monitoreo de la pesca en el mar.', 'Jr fisheries engineer', 'joboffer2.jpg'),
(73, 20, 1, 48, 1, 'Educador marino', 'responsable de la educación y sensibilización sobre la conservación y gestión sostenible de los recursos marinos a través de programas educativos y actividades comunitarias.', 'Jr naval engineer', 'joboffer1.jpg'),
(74, 1, 6, 48, 1, 'Biólogo marino', 'responsable de la investigación y monitoreo de los ecosistemas marinos y la biología marina, así como de la identificación y solución de problemas relacionados con la conservación de los recursos mari', 'Sr fisheries engineer', 'joboffer2.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `student`
--

CREATE TABLE `student` (
  `studentId` int(11) NOT NULL,
  `careerId` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `dni` varchar(50) NOT NULL,
  `fileNumber` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `birthDate` date DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `phoneNumber` varchar(50) NOT NULL,
  `activo` tinyint(1) DEFAULT NULL CHECK (`activo` in (1,0)),
  `password` varchar(50) NOT NULL,
  `url` varchar(2000) NOT NULL,
  `fileName` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `student`
--

INSERT INTO `student` (`studentId`, `careerId`, `firstName`, `lastName`, `dni`, `fileNumber`, `gender`, `birthDate`, `email`, `phoneNumber`, `activo`, `password`, `url`, `fileName`) VALUES
(0, 2, 'pepe', 'perez', '151818', '1125185', 'Agender', '0000-00-00', 'nahuelarielz1234@outlook.com', '5998419', 1, '123', 'upload/Cv pepe perez.docx', 'Cv pepe perez.docx'),
(2, 5, 'Wyatan', 'Lorant', '63-025-8112', '01-777-6891', 'Non-binary', '2021-02-23', 'wlorant1@sbwire.com', '171-448-9062', 1, '123', 'upload/Cv Wyatan Lorant.docx', 'Cv Wyatan Lorant.docx'),
(3, 2, 'Alanson', 'Seemmonds', '06-684-0100', '89-621-0940', 'Agender', '2021-07-03', 'aseemmonds2@upenn.edu', '961-404-8720', 1, '123', '', ''),
(5, 2, 'jun', 'alonzo', '5615961', '5261561', 'agender', '2021-11-18', 'arielz1234@outlook.com', '56156', 1, '123', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `useadmin`
--

CREATE TABLE `useadmin` (
  `idAdmin` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `useadmin`
--

INSERT INTO `useadmin` (`idAdmin`, `email`, `password`) VALUES
(1, 'admin@gmail.com', '123'),
(2, 'admin@outlook.com', '123');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`studentId`,`id_JobOfert`),
  ADD KEY `fk_id_JobOfert` (`id_JobOfert`);

--
-- Indices de la tabla `career`
--
ALTER TABLE `career`
  ADD PRIMARY KEY (`careerId`);

--
-- Indices de la tabla `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id_company`),
  ADD UNIQUE KEY `unq_cuil` (`cuil`),
  ADD UNIQUE KEY `unq_name` (`CompanyName`);

--
-- Indices de la tabla `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`jobPositionId`),
  ADD KEY `fk_careerId` (`careerId`);

--
-- Indices de la tabla `job_ofert`
--
ALTER TABLE `job_ofert`
  ADD PRIMARY KEY (`id_JobOfert`),
  ADD KEY `fk_id_compan` (`id_company`),
  ADD KEY `fk_id_jobPosition` (`jobPositionId`);

--
-- Indices de la tabla `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentId`),
  ADD UNIQUE KEY `unq_dni` (`dni`),
  ADD UNIQUE KEY `unq_email` (`email`),
  ADD UNIQUE KEY `unq_fileNumber` (`fileNumber`),
  ADD KEY `fk_career` (`careerId`);

--
-- Indices de la tabla `useadmin`
--
ALTER TABLE `useadmin`
  ADD PRIMARY KEY (`idAdmin`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `company`
--
ALTER TABLE `company`
  MODIFY `id_company` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `job_ofert`
--
ALTER TABLE `job_ofert`
  MODIFY `id_JobOfert` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT de la tabla `useadmin`
--
ALTER TABLE `useadmin`
  MODIFY `idAdmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `fk_id_JobOfert` FOREIGN KEY (`id_JobOfert`) REFERENCES `job_ofert` (`id_JobOfert`),
  ADD CONSTRAINT `fk_id_student` FOREIGN KEY (`studentId`) REFERENCES `student` (`studentId`);

--
-- Filtros para la tabla `job`
--
ALTER TABLE `job`
  ADD CONSTRAINT `fk_careerId` FOREIGN KEY (`careerId`) REFERENCES `career` (`careerId`);

--
-- Filtros para la tabla `job_ofert`
--
ALTER TABLE `job_ofert`
  ADD CONSTRAINT `fk_id_compan` FOREIGN KEY (`id_company`) REFERENCES `company` (`id_company`),
  ADD CONSTRAINT `fk_id_jobPosition` FOREIGN KEY (`jobPositionId`) REFERENCES `job` (`jobPositionId`);

--
-- Filtros para la tabla `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `fk_career` FOREIGN KEY (`careerId`) REFERENCES `career` (`careerId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
