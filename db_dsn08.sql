-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-04-2023 a las 06:41:20
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_dsn08`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistente_cobranza`
--

CREATE TABLE `asistente_cobranza` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `correoelectronico` varchar(200) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `identificacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asistente_cobranza`
--

INSERT INTO `asistente_cobranza` (`id`, `nombre`, `apellido`, `correoelectronico`, `telefono`, `identificacion`) VALUES
(1, 'Dominik', 'Torero', 'correo@correo.com', '1234567895', 923896591),
(2, 'Andres', 'Garcia', 'correo2@correo.com', '0945678912', 923654789),
(3, 'Karla', 'Sanchez', 'correo3@correo.com', '0912345678', 909876543),
(4, 'Maria', 'Gonzalez', 'correo4@correo.com', '0909898989', 901234567),
(5, 'Pedro', 'Lopez', 'correo5@correo.com', '0901122334', 909876543),
(6, 'Laura', 'Villagomez', 'correo6@correo.com', '0934567890', 907654321),
(7, 'Jose', 'Molina', 'correo7@correo.com', '0921345678', 909876543),
(8, 'Rocio', 'Santos', 'correo8@correo.com', '0921456789', 923567890),
(9, 'Jorge', 'Vallejo', 'correo9@correo.com', '0945678901', 923456789),
(10, 'Carla', 'Torres', 'correo10@correo.com', '0909898989', 912345678),
(11, 'Laura', 'Valencia', 'laurav@gmail.com', '0923456789', 912345678),
(12, 'Jorge', 'Rivas', 'jorgerivas@hotmail.com', '0912345678', 923456789),
(13, 'Angie', 'García', 'angiegarcia@gmail.com', '0923456789', 912345678),
(14, 'Sebastián', 'Mendoza', 'sebastianm@hotmail.com', '0912345678', 923456789),
(15, 'Sofía', 'Rodríguez', 'sofiarodriguez@yahoo.com', '0923456789', 912345678),
(16, 'David', 'Hernández', 'davidhernandez@gmail.com', '0912345678', 923456789),
(17, 'Isabella', 'Martínez', 'isabellamartinez@hotmail.com', '0923456789', 912345678),
(18, 'Luis', 'Castillo', 'luiscastillo@gmail.com', '0912345678', 923456789),
(19, 'Valeria', 'Vargas', 'valeriavargas@yahoo.com', '0923456789', 912345678),
(20, 'Carlos', 'Ramírez', 'carlosramirez@hotmail.com', '0912345678', 923456789),
(21, 'Florencia', 'Vega', 'florencia.vega@gmail.com', '0987654321', 903344466),
(22, 'Juan', 'López', 'juan.lopez@hotmail.com', '0976543210', 956789012),
(23, 'Camila', 'Herrera', 'camila.herrera@yahoo.com', '0932109876', 923456789),
(24, 'Lucas', 'García', 'lucas.garcia@gmail.com', '0998765432', 901122334),
(25, 'Sofía', 'Díaz', 'sofia.diaz@hotmail.com', '0976543210', 923456789),
(26, 'Diego', 'Pérez', 'diego.perez@yahoo.com', '0932109876', 903344466),
(27, 'Julieta', 'Romero', 'julieta.romero@gmail.com', '0987654321', 956789012),
(28, 'Lautaro', 'Martínez', 'lautaro.martinez@hotmail.com', '0998765432', 901122334),
(29, 'Valentina', 'González', 'valentina.gonzalez@yahoo.com', '0932109876', 903344466),
(30, 'Miguel', 'Silva', 'miguel.silva@gmail.com', '0976543210', 956789012);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre`, `apellido`, `telefono`, `correo`, `direccion`, `estado`) VALUES
(1, 'Carlos', 'Pesantes', '0912345678', 'carlospesantes@gmai.com', 'portete', 1),
(2, 'Juanito', 'Piguave', '1234567895', 'correo@correo.com', 'guayaquil pedro carbo y 10 de agosto', 1),
(3, 'Carlos', 'Mendez', '0987654321', 'carlos.mendez@gmail.com', 'Quito, Calle 10 de Agosto y 9 de Octubre', 1),
(4, 'Maria', 'Lopez', '0998765432', 'maria.lopez@hotmail.com', 'Guayaquil, Av. Las Aguas y Los Rios', 1),
(5, 'Pedro', 'Garcia', '0976543210', 'pedro.garcia@yahoo.com', 'Cuenca, Calle Juan Montalvo y Luis Cordero', 1),
(6, 'Ana', 'Fernandez', '0932546789', 'ana.fernandez@gmail.com', 'Manta, Av. 24 de Mayo y 13 de Junio', 1),
(7, 'Luis', 'Perez', '0987456321', 'luis.perez@hotmail.com', 'Portoviejo, Calle Olmedo y Sucre', 1),
(8, 'Sofia', 'Gutierrez', '0998765432', 'sofia.gutierrez@yahoo.com', 'Loja, Av. 24 de Mayo y 10 de Agosto', 1),
(9, 'Andres', 'Ramirez', '0976543210', 'andres.ramirez@gmail.com', 'Ambato, Calle Bolivar y Juan Montalvo', 1),
(10, 'Gabriela', 'Velasquez', '0932546789', 'gabriela.velasquez@hotmail.com', 'Esmeraldas, Av. Los Almendros y Los Pinos', 1),
(11, 'Juan', 'Morales', '0987456321', 'juan.morales@yahoo.com', 'Guaranda, Calle 5 de Junio y 24 de Mayo', 1),
(12, 'Luisa', 'Garcia', '0998765432', 'luisa.garcia@gmail.com', 'Santo Domingo, Av. 29 de Mayo y 9 de Octubre', 1),
(13, 'Eduardo', 'Vallejo', '0987654321', 'eduardo.vallejo@gmail.com', 'Quito, Av. Amazonas y Naciones Unidas', 1),
(14, 'Marta', 'Guzman', '0998765432', 'marta.guzman@hotmail.com', 'Guayaquil, Calle Alejo Lascano y Velez', 1),
(15, 'Javier', 'Martinez', '0976543210', 'javier.martinez@yahoo.com', 'Cuenca, Av. Loja y Huayna Capac', 1),
(16, 'Lucia', 'Sanchez', '0932546789', 'lucia.sanchez@gmail.com', 'Manta, Calle 24 de Mayo y Av. 4 de Noviembre', 1),
(17, 'Roberto', 'Diaz', '0987456321', 'roberto.diaz@hotmail.com', 'Portoviejo, Av. 13 de Junio y Olmedo', 1),
(18, 'Camila', 'Gomez', '0998765432', 'camila.gomez@yahoo.com', 'Loja, Calle Bolivar y 18 de Noviembre', 1),
(19, 'Jorge', 'Rodriguez', '0976543210', 'jorge.rodriguez@gmail.com', 'Ambato, Av. Cevallos y Sucre', 1),
(20, 'Fernanda', 'Garcia', '0932546789', 'fernanda.garcia@hotmail.com', 'Esmeraldas, Calle 10 de Agosto y Av. Esmeraldas', 1),
(21, 'Patricio', 'Ortiz', '0987456321', 'patricio.ortiz@yahoo.com', 'Guaranda, Av. 24 de Mayo y Olmedo', 1),
(22, 'Laura', 'Moreno', '0998765432', 'laura.moreno@gmail.com', 'Santo Domingo, Calle 5 de Junio y Av. Quito', 1),
(23, 'Diego', 'Gomez', '0976543210', 'diego.gomez@hotmail.com', 'Quito, Av. Eloy Alfaro y La Coruna', 1),
(24, 'Sara', 'Perez', '0932546789', 'sara.perez@yahoo.com', 'Guayaquil, Calle Malecon y Av. 9 de Octubre', 1),
(25, 'Johana', 'Lopez', '0987456321', 'johana.lopez@gmail.com', 'Cuenca, Calle Larga y Av. Huayna Capac', 1),
(26, 'Manuel', 'Velez', '0998765432', 'manuel.velez@hotmail.com', 'Manta, Av. 24 de Mayo y Av. 7 de Agosto', 1),
(27, 'Marcela', 'Gonzalez', '0976543210', 'marcela.gonzalez@gmail.com', 'Portoviejo, Av. 13 de Junio y Av. Reales Tamarindos', 1),
(28, 'Ana', 'Flores', '0987654321', 'ana.flores@gmail.com', 'Quito, Calle Wilson E10-12 y Reina Victoria', 1),
(29, 'Pedro', 'Vega', '0998765432', 'pedro.vega@hotmail.com', 'Guayaquil, Av. Francisco de Orellana y Av. Juan Tanca Marengo', 1),
(30, 'Isabel', 'García', '0976543210', 'isabel.garcia@yahoo.com', 'Cuenca, Av. 12 de Abril y Av. Solano', 1),
(31, 'Luis', 'Hernández', '0932546789', 'luis.hernandez@gmail.com', 'Manta, Av. 24 de Mayo y Calle 15', 1),
(32, 'María', 'Carrasco', '0987456321', 'maria.carrasco@yahoo.com', 'Portoviejo, Av. Metropolitana y Av. Reales Tamarindos', 1),
(33, 'Carlos', 'Martínez', '0998765432', 'carlos.martinez@hotmail.com', 'Loja, Av. Isidro Ayora y Av. Manuel Agustín Aguirre', 1),
(34, 'Julieta', 'Sánchez', '0976543210', 'julieta.sanchez@gmail.com', 'Ambato, Av. Cevallos y Av. Bolívar', 1),
(35, 'Mario', 'Lara', '0932546789', 'mario.lara@hotmail.com', 'Esmeraldas, Av. 15 de Agosto y Av. Juan de Dios Martínez', 1),
(36, 'Paola', 'Romero', '0987456321', 'paola.romero@yahoo.com', 'Guaranda, Calle Sucre y Av. 9 de Octubre', 1),
(37, 'Gustavo', 'Paredes', '0998765432', 'gustavo.paredes@gmail.com', 'Santo Domingo, Av. Tsáchila y Av. Lauro Guerrero', 1),
(38, 'Miguel', 'Yance', '0955163530', 'mayance2@itb.edu.ec', 'huancavilca sur', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `convenio`
--

CREATE TABLE `convenio` (
  `id_convenio` int(11) NOT NULL,
  `id_asesor` int(11) NOT NULL,
  `num_fact` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `total` float NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `cuotas` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `convenio`
--

INSERT INTO `convenio` (`id_convenio`, `id_asesor`, `num_fact`, `id_cliente`, `total`, `fecha`, `cuotas`, `estado`) VALUES
(1, 1, 35, 38, 4090, '2023-04-08 05:35:29', 5, 1),
(2, 1, 33, 8, 298664, '2023-04-08 05:41:38', 5, 3),
(3, 1, 33, 8, 298664, '2023-04-08 05:43:18', 5, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacion`
--

CREATE TABLE `cotizacion` (
  `cotizacion_id` int(11) NOT NULL,
  `idproveedor` int(11) NOT NULL,
  `idPedido` int(11) NOT NULL,
  `garantia` tinyint(1) NOT NULL,
  `valor` float NOT NULL,
  `fecha_hora` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` int(100) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cotizacion`
--

INSERT INTO `cotizacion` (`cotizacion_id`, `idproveedor`, `idPedido`, `garantia`, `valor`, `fecha_hora`, `estado`, `descripcion`) VALUES
(36, 8, 9, 1, 6567, '2023-04-02 08:40:49', 3, '1234476457567'),
(39, 6, 6, 0, 123, '2023-04-02 09:07:18', 1, '12123123123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuotas_convenio`
--

CREATE TABLE `cuotas_convenio` (
  `id_convenio` int(11) NOT NULL,
  `num_cuota_convenio` int(11) NOT NULL,
  `valor_pagado` float NOT NULL,
  `valor_cuota` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cuotas_convenio`
--

INSERT INTO `cuotas_convenio` (`id_convenio`, `num_cuota_convenio`, `valor_pagado`, `valor_cuota`) VALUES
(0, 1, 0, 818),
(0, 2, 0, 818),
(0, 3, 0, 818),
(0, 4, 0, 818),
(0, 5, 0, 818),
(2, 1, 0, 59732.8),
(2, 2, 0, 59732.8),
(2, 3, 0, 59732.8),
(2, 4, 0, 59732.8),
(2, 5, 0, 59732.8),
(3, 1, 59732.8, 59732.8),
(3, 2, 0, 59732.8),
(3, 3, 0, 59732.8),
(3, 4, 0, 59732.8),
(3, 5, 0, 59732.8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `num_fact` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `fechahora` timestamp NOT NULL DEFAULT current_timestamp(),
  `metodo_pago` int(11) NOT NULL,
  `id_cajero` int(11) NOT NULL,
  `iva` int(11) NOT NULL,
  `subtotal` float NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`num_fact`, `id_cliente`, `fechahora`, `metodo_pago`, `id_cajero`, `iva`, `subtotal`, `total`) VALUES
(32, 3, '2023-04-02 03:19:07', 3, 1, 12, 0, 0),
(33, 8, '2023-04-02 03:21:52', 3, 1, 12, 266664, 298664),
(34, 19, '2023-04-02 03:41:03', 1, 1, 12, 2000000, 2240000),
(35, 38, '2023-04-06 18:33:54', 3, 1, 12, 4090, 4090);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodo_pago`
--

CREATE TABLE `metodo_pago` (
  `id_num` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `detalles` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `metodo_pago`
--

INSERT INTO `metodo_pago` (`id_num`, `nombre`, `detalles`) VALUES
(1, 'Efectivo', 'Pago directo en caja'),
(2, 'Tarjeta de crédito/debito', 'Pago con tajerta'),
(3, 'Crédito interno', 'Pago con crédito interno estableciendo convenio de pago a cuotas fijas');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistente_cobranza`
--
ALTER TABLE `asistente_cobranza`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `convenio`
--
ALTER TABLE `convenio`
  ADD PRIMARY KEY (`id_convenio`);

--
-- Indices de la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  ADD PRIMARY KEY (`cotizacion_id`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`num_fact`);

--
-- Indices de la tabla `metodo_pago`
--
ALTER TABLE `metodo_pago`
  ADD PRIMARY KEY (`id_num`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistente_cobranza`
--
ALTER TABLE `asistente_cobranza`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `convenio`
--
ALTER TABLE `convenio`
  MODIFY `id_convenio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  MODIFY `cotizacion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `num_fact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `metodo_pago`
--
ALTER TABLE `metodo_pago`
  MODIFY `id_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
