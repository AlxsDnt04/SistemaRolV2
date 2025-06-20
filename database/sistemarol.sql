-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 20-06-2025 a las 13:09:25
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
(4, 'CNT1', 'NORTE', 'CONTABILIDAD'),
(5, 'CNT2', 'SUR', 'CONTABILIDAD');

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
(5, 'Diciembre', 'Manejo de IAS', 'uploads/EJERCICIO PRÁCTICO 17_6_2025.pdf', '2025-06-16 15:55:33', 1658798465);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `ci_empleado` int NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `apellido` varchar(30) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `correo` varchar(30) DEFAULT NULL,
  `id_departamento` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`ci_empleado`, `nombre`, `apellido`, `telefono`, `direccion`, `correo`, `id_departamento`) VALUES
(1657486151, 'Natalia', 'Ceviche', '0986534518', 'caupichuuuu', 'natalizajsk@gmail.com', 4),
(1658798465, 'Joselito', 'Suarez', '8287808078', 'cas jfalsjdf kjs d', 'sdfas@gmail.com', 1),
(1786542312, 'Carlitos', 'Suarez', '98657512', 'Calle quito sur', 'carulitos@gjsa.com', 3),
(1786542313, 'Lucho', 'Portuano', '984321545', 'Av. Siempredura', 'lucho@hotmail.com', 1),
(1983657845, 'Hola ', 'Que hace', '0984546416', 'El condado', 'hasdlj@live.com', 4);

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
(15, 'Abril', 12.50, 7.50, 50.00, 50.00, 800.00, 920.00, 3.60, 100.00, 20.00, 80.00, 100.00, 60.00, 363.60, 556.40, '2025-06-16 15:59:40', 1658798465);

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
(9, '1983657845', '$2y$10$KTDbqOjemZ/8gxE/JmvqxeQn99ALAkLJ/3sgx3HihKRheWZUA2oh2', 'empleado', 1983657845, '2025-06-19 16:04:38'),
(10, '1657486151', '$2y$10$C2dI3Z.PeFYcw70dEfm/C.V5e.e7vjAC42uVc7F9gTpYaeTEtsWZi', 'empleado', 1657486151, '2025-06-19 16:43:33');

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
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `id_departamento` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `documento`
--
ALTER TABLE `documento`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
