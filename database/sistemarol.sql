-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 02-07-2025 a las 04:18:01
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistemarol`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `id_departamento` int NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `ubicacion` varchar(30) DEFAULT NULL,
  `area` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`id_departamento`, `nombre`, `ubicacion`, `area`) VALUES
(1, 'UBE', 'SEGUNDO PISO', 'ATENCION '),
(3, 'VINCULACION', 'CENTRO', 'PSICOLOGIA'),
(4, 'TIC', 'NORTE', 'INFORMACION'),
(5, 'CENTRO IDIOMAS', 'BLOQUE H', 'IDIOMAS'),
(8, 'C. ADMINISTRATIVA', 'CAMPUS NORTE', 'COORDINACION'),
(9, 'Nuevo nombre', 'nueva ub', 'nueva area');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE `documento` (
  `id` int NOT NULL,
  `mes` varchar(30) DEFAULT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `archivo` varchar(250) DEFAULT NULL,
  `fecha_carga` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ci_empleado` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `documento`
--

INSERT INTO `documento` (`id`, `mes`, `descripcion`, `archivo`, `fecha_carga`, `ci_empleado`) VALUES
(9, 'Junio', 'Reporte Junio', 'uploads/ReporteRolJunio.pdf', '2025-07-02 03:36:23', 1983657845),
(10, 'Enero', 'Reporte Febrero', 'uploads/ReporteRolFebrero.pdf', '2025-07-02 03:39:39', 1983657845);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `ci_empleado` int NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `apellido` varchar(30) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `correo` varchar(30) DEFAULT NULL,
  `id_departamento` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`ci_empleado`, `nombre`, `apellido`, `telefono`, `direccion`, `correo`, `id_departamento`) VALUES
(1657486151, 'Nataly', 'Iza', '0986534518', 'Av. de los Cedros y Calle de los Robles, Edificio Mirador', 'nataliaiz@gmail.com', 1),
(1658798465, 'Joselito', 'Suarez', '0986525478', 'Graciela Escudero y calle oe132', 'joselito2@gmail.com', 3),
(1786542312, 'Carlitos', 'Suarez', '98657512', 'Calle quito sur', 'carulitos@gjsa.com', 3),
(1786542313, 'Lucho', 'Portuano', '984321545', 'Av. Siempredura', 'lucho@hotmail.com', 1),
(1983657845, 'Sofia', 'Cardenas', '0984546416', 'Calle del Cóndor 1583, Barrio El Mirador', 'sofiC@live.com', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int NOT NULL,
  `mes` varchar(10) DEFAULT NULL,
  `hora25` decimal(10,2) DEFAULT NULL,
  `hora50` decimal(10,2) DEFAULT NULL,
  `hora100` decimal(10,2) DEFAULT NULL,
  `bonos` decimal(10,2) DEFAULT NULL,
  `sueldo` decimal(10,2) DEFAULT NULL,
  `totalIngreso` decimal(10,2) DEFAULT NULL,
  `iess` decimal(10,2) DEFAULT NULL,
  `multas` decimal(10,2) DEFAULT NULL,
  `atrasos` decimal(10,2) DEFAULT NULL,
  `alimentacion` decimal(10,2) DEFAULT NULL,
  `anticipos` decimal(10,2) DEFAULT NULL,
  `otros` decimal(10,2) DEFAULT NULL,
  `totalEgreso` decimal(10,2) DEFAULT NULL,
  `totalPagar` decimal(10,2) DEFAULT NULL,
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ci_empleado` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `mes`, `hora25`, `hora50`, `hora100`, `bonos`, `sueldo`, `totalIngreso`, `iess`, `multas`, `atrasos`, `alimentacion`, `anticipos`, `otros`, `totalEgreso`, `totalPagar`, `fecha_registro`, `ci_empleado`) VALUES
(14, 'Junio', 18.75, 56.25, 105.00, 120.00, 1200.00, 1500.00, 5.40, 20.00, 30.00, 40.00, 50.00, 50.00, 195.40, 1304.60, '2025-06-12 16:53:26', 1657486151),
(15, 'Abril', 12.50, 7.50, 50.00, 50.00, 800.00, 920.00, 3.60, 100.00, 20.00, 80.00, 100.00, 60.00, 363.60, 556.40, '2025-06-16 15:59:40', 1658798465),
(17, 'Junio', 3.91, 9.39, 25.04, 0.00, 500.00, 538.34, 2.25, 50.00, 0.00, 10.00, 0.00, 0.00, 62.25, 476.09, '2025-06-29 15:57:43', 1983657845),
(18, 'Febrero', 3.91, 9.39, 18.78, 40.00, 500.00, 572.08, 2.25, 80.00, 10.00, 70.00, 50.00, 5.00, 217.25, 354.83, '2025-07-02 02:46:56', 1983657845),
(19, 'Agosto', 9.38, 16.88, 7.50, 40.00, 600.00, 673.75, 2.70, 50.00, 60.00, 10.00, 10.00, 10.00, 142.70, 531.05, '2025-07-02 03:45:03', 1786542312);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `rol` enum('admin','empleado') NOT NULL,
  `ci_empleado` int DEFAULT NULL,
  `fecha_user` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `clave`, `rol`, `ci_empleado`, `fecha_user`) VALUES
(10, '1657486151', '$2y$10$C2dI3Z.PeFYcw70dEfm/C.V5e.e7vjAC42uVc7F9gTpYaeTEtsWZi', 'empleado', 1657486151, '2025-06-19 16:43:33'),
(11, 'eladminx', '$2y$10$TLXNkARxKqdQwZcnJkurteE.o9neMivKJ2UYk8BVk5I3RHhaif8rG', 'admin', NULL, '2025-06-25 04:33:05'),
(12, '1786542312', '$2y$10$0s7bI6TQjF/tTYYbl8.keuyhtwLXKn5sdcwzfhXlTNNUbLU74tdLe', 'empleado', 1786542312, '2025-07-02 03:49:10'),
(14, '1983657845', '$2y$10$iXNCxuqTvAEipXQzSJLAJOPyPPcInu4GERLqLFAH7a7Gmcgszy/Gq', 'empleado', 1983657845, '2025-07-02 04:11:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacaciones`
--

CREATE TABLE `vacaciones` (
  `id` int NOT NULL,
  `ci_empleado` int NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `dias` int NOT NULL,
  `pago` decimal(10,2) NOT NULL,
  `fecha_emision` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `aprobado` enum('Pendiente','Sí','No') DEFAULT 'Pendiente',
  `observaciones` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`id_departamento`);

--
-- Indices de la tabla `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documento_empleado` (`ci_empleado`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`ci_empleado`),
  ADD KEY `FK_departamento_empleado` (`id_departamento`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`),
  ADD KEY `fk_empleado` (`ci_empleado`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD KEY `ci_empleado` (`ci_empleado`);

--
-- Indices de la tabla `vacaciones`
--
ALTER TABLE `vacaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_empleado` (`ci_empleado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `id_departamento` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `documento`
--
ALTER TABLE `documento`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `vacaciones`
--
ALTER TABLE `vacaciones`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `documento`
--
ALTER TABLE `documento`
  ADD CONSTRAINT `documento_empleado` FOREIGN KEY (`ci_empleado`) REFERENCES `empleado` (`ci_empleado`);

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `FK_departamento_empleado` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`id_departamento`);

--
-- Filtros para la tabla `rol`
--
ALTER TABLE `rol`
  ADD CONSTRAINT `fk_empleado` FOREIGN KEY (`ci_empleado`) REFERENCES `empleado` (`ci_empleado`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`ci_empleado`) REFERENCES `empleado` (`ci_empleado`);

--
-- Filtros para la tabla `vacaciones`
--
ALTER TABLE `vacaciones`
  ADD CONSTRAINT `vacaciones_ibfk_1` FOREIGN KEY (`ci_empleado`) REFERENCES `empleado` (`ci_empleado`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
