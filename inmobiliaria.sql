-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 08-03-2025 a las 21:26:34
-- Versión del servidor: 8.0.40
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inmobiliaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `antiguedad`
--

CREATE TABLE `antiguedad` (
  `AntiguedadId` int NOT NULL,
  `AntiguedadNombre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `antiguedad`
--

INSERT INTO `antiguedad` (`AntiguedadId`, `AntiguedadNombre`) VALUES
(1, 'A Estrenar'),
(2, 'De 1 a 5 Años'),
(3, 'De 5 a 10 Años'),
(4, 'De 10 a 15 Años'),
(5, 'De 15 a 20 Años'),
(6, 'De 20 a 25 Años'),
(7, 'De 25 a 30 Años'),
(8, 'De 30 a 35 Años'),
(9, 'De 35 a 40 Años');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asesores`
--

CREATE TABLE `asesores` (
  `AsesorId` int NOT NULL,
  `AsesorFoto` longblob,
  `AsesorNombre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `AsesorApellidoPaterno` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `AsesorApellidoMaterno` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `AsesorCorreo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `AsesorAlta` date NOT NULL,
  `AsesorRfc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `AsesorNss` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `AsesorTipoSangre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `AsesorEspecialidad` int NOT NULL,
  `AsesorZona` int NOT NULL,
  `AsesorTelefono` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `AsesorCelular` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `AsesorDireccion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `AsesorObservaciones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `AsesorUsuario` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `AsesorPass` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `AsesorActivo` tinyint NOT NULL,
  `AsesorAdmin` tinyint NOT NULL,
  `AsesorVigente` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asesores`
--

INSERT INTO `asesores` (`AsesorId`, `AsesorFoto`, `AsesorNombre`, `AsesorApellidoPaterno`, `AsesorApellidoMaterno`, `AsesorCorreo`, `AsesorAlta`, `AsesorRfc`, `AsesorNss`, `AsesorTipoSangre`, `AsesorEspecialidad`, `AsesorZona`, `AsesorTelefono`, `AsesorCelular`, `AsesorDireccion`, `AsesorObservaciones`, `AsesorUsuario`, `AsesorPass`, `AsesorActivo`, `AsesorAdmin`, `AsesorVigente`) VALUES
(1, NULL, 'JOSé DEL CARMEN', 'DE DIOS', 'DE LA CRUZ', 'terry_jose_406@hotmail.com', '2025-03-07', 'DICC000624HTCSRRA7', '05160019849', 'O+', 1, 1, '9934687746', '9934687746', 'Colonia Carrizal Calle Felipe Carillo puerto #282', '.', 'JCDC', '$2y$10$54nnnDSCpRwdTa7ohQpA9uH7E6sy./TVJA59vDKpjYuOSr1m5jAfe', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caracteristicas`
--

CREATE TABLE `caracteristicas` (
  `CaracteristicaId` int NOT NULL,
  `CaracteristicaDescripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `CaracteristicaTipo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `CaracteristicaMedible` tinyint NOT NULL,
  `CaracteristicaUnidadMedida` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `caracteristicas`
--

INSERT INTO `caracteristicas` (`CaracteristicaId`, `CaracteristicaDescripcion`, `CaracteristicaTipo`, `CaracteristicaMedible`, `CaracteristicaUnidadMedida`) VALUES
(1, 'M2 de Construcción', 'Característica', 1, 'Metros'),
(2, 'Recámaras', 'Característica', 1, 'Cantidad'),
(3, 'Baños', 'Característica', 1, 'Cantidad'),
(4, 'Medio Baño', 'Característica', 1, 'Cantidad'),
(5, 'Estacionamiento', 'Característica', 1, 'Cantidad'),
(6, 'Seguridad Privada', 'Servicio', 0, 'N/A'),
(7, 'Cocina Integral', 'Característica ', 0, 'N/A'),
(8, 'Cuarto de Lavado', 'Característica', 0, 'N/A'),
(9, 'Cuarto de Servicio', 'Característica', 1, 'Cantidad'),
(10, 'Alberca Privada', 'Característica', 0, 'N/A'),
(11, 'Sala de TV', 'Característica', 0, 'N/A'),
(12, 'Área de Blancos', 'Característica', 0, 'N/A'),
(13, 'CCTV', 'Servicio', 0, 'N/A'),
(14, 'Patio', 'Característica', 0, 'N/A'),
(15, 'Cisterna', 'Característica', 0, 'N/A'),
(16, 'Cocineta', 'Característica', 0, 'N/A'),
(17, 'Calentador de Agua', 'Servicio', 0, 'N/A'),
(18, 'Tinaco', 'Servicio', 0, 'N/A'),
(19, 'Jardín', 'Característica', 1, 'Cantidad'),
(20, 'Tanque de Gas Estacionario', 'Servicio', 0, 'N/A'),
(21, 'Portón', 'Servicio', 0, 'N/A'),
(22, 'Área Deportiva', 'Amenidad', 0, 'N/A'),
(23, 'Gimnasio Privado', 'Característica', 0, 'N/A'),
(24, 'Gimnasio de uso común', 'Amenidad', 0, 'N/A'),
(25, 'Parques / Áreas verdes', 'Amenidad', 0, 'N/A'),
(26, 'Alberca de uso común', 'Amenidad', 0, 'N/A'),
(27, 'Lavadora Secadora', 'Servicio', 0, 'N/A'),
(28, 'INTERNET', 'Servicio', 0, 'N/A'),
(29, 'Vivero', 'Característica', 0, 'N/A'),
(30, 'Caverna', 'Característica', 0, 'N/A'),
(31, 'Jacuzzi', 'Equipamiento', 1, 'Cantidad'),
(32, 'M2 de Terreno', 'Característica', 1, 'Metros'),
(33, 'Frente', 'Característica', 1, 'Metros'),
(34, 'Fondo', 'Característica', 1, 'Metros'),
(35, 'Forma Regular', 'Característica', 0, 'N/A'),
(36, 'Forma Irregular', 'Característica', 0, 'N/A'),
(37, 'Requiere Relleno', 'Característica', 0, 'N/A'),
(38, 'Energía Eléctrica', 'Servicio', 0, 'N/A'),
(39, 'Agua Potable', 'Servicio', 0, 'N/A'),
(40, 'Desván', 'Característica', 0, 'N/A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `ContactoId` int NOT NULL,
  `ContactoNombre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`ContactoId`, `ContactoNombre`) VALUES
(1, 'Esfera de Influencia'),
(2, 'Instagram'),
(3, 'Web'),
(4, 'Mailing'),
(5, 'Lona'),
(6, 'Portal Inmobiliario Nocnok'),
(7, 'Facebook página Red Inmobiliaria'),
(8, 'Facebook del Asesor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto_emergencia`
--

CREATE TABLE `contacto_emergencia` (
  `CEmergenciaId` int NOT NULL,
  `CEAsesor` int DEFAULT NULL,
  `CENombre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `CEApellidoPaterno` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `CEApellidoMaterno` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `CETelefono` int DEFAULT NULL,
  `CECelular` int DEFAULT NULL,
  `CEParentesco` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contacto_emergencia`
--

INSERT INTO `contacto_emergencia` (`CEmergenciaId`, `CEAsesor`, `CENombre`, `CEApellidoPaterno`, `CEApellidoMaterno`, `CETelefono`, `CECelular`, `CEParentesco`) VALUES
(1, 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contrato`
--

CREATE TABLE `contrato` (
  `ContratoId` int NOT NULL,
  `ContratoNombre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contrato`
--

INSERT INTO `contrato` (`ContratoId`, `ContratoNombre`) VALUES
(1, 'Opción'),
(2, 'Broker'),
(3, 'Exclusiva');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentacion`
--

CREATE TABLE `documentacion` (
  `DocumentacionId` int NOT NULL,
  `DocumentacionNombre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `DocumentacionClasificacion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `documentacion`
--

INSERT INTO `documentacion` (`DocumentacionId`, `DocumentacionNombre`, `DocumentacionClasificacion`) VALUES
(1, 'INE Propietario', 'PROPIETARIO/PROPIEDAD'),
(2, 'Contrato de Trabajo', 'PROPIETARIO/PROPIEDAD'),
(3, 'IMSS', 'ASESOR/ADMINISTRADOR'),
(4, 'Avalúo', 'PROPIETARIO/PROPIEDAD'),
(5, 'Plano', 'PROPIETARIO/PROPIEDAD'),
(6, 'INE Asesor', 'ASESOR/ADMINISTRADOR'),
(7, 'GRAVAMEN', 'PROPIETARIO/PROPIEDAD');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentacion_asesor`
--

CREATE TABLE `documentacion_asesor` (
  `DocumentoId` int NOT NULL,
  `AsesorId` int NOT NULL,
  `TipoDocumentacion` int NOT NULL,
  `Documento` longblob NOT NULL,
  `TipoDocumento` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentacion_propiedad`
--

CREATE TABLE `documentacion_propiedad` (
  `DocumentoId` int NOT NULL,
  `PropiedadId` int NOT NULL,
  `TipoDocumentacion` int NOT NULL,
  `Documento` longblob NOT NULL,
  `TipoDocumento` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

CREATE TABLE `especialidad` (
  `EspecialidadId` int NOT NULL,
  `EspecialidadNombre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `especialidad`
--

INSERT INTO `especialidad` (`EspecialidadId`, `EspecialidadNombre`) VALUES
(1, 'Residencial'),
(2, 'Infonavit'),
(3, 'PEMEX'),
(4, 'Luxury'),
(5, 'Sector Industrial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `financiamiento`
--

CREATE TABLE `financiamiento` (
  `FinanciamientoId` int NOT NULL,
  `FinanciamientoNombre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `financiamiento`
--

INSERT INTO `financiamiento` (`FinanciamientoId`, `FinanciamientoNombre`) VALUES
(1, 'Bancario'),
(2, 'Infonavit'),
(3, 'Fovisste'),
(4, 'PEMEX'),
(5, 'Recursos propios (Efectivo)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos`
--

CREATE TABLE `fotos` (
  `FotoId` int NOT NULL,
  `FotoArchivo` longblob NOT NULL,
  `FotoPropiedad` int NOT NULL,
  `FotoPrincipal` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `llave`
--

CREATE TABLE `llave` (
  `LlaveId` int NOT NULL,
  `LlaveNombre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `llave`
--

INSERT INTO `llave` (`LlaveId`, `LlaveNombre`) VALUES
(1, 'Llave en la oficina'),
(2, 'Llave con el Propietario'),
(3, 'Acceso libre a Terreno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `moneda`
--

CREATE TABLE `moneda` (
  `MonedaId` int NOT NULL,
  `MonedaNombre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `moneda`
--

INSERT INTO `moneda` (`MonedaId`, `MonedaNombre`) VALUES
(1, 'MXN Pesos Mexicanos'),
(2, 'USD Dólar Estadounidense'),
(3, 'EUR Euros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operacion`
--

CREATE TABLE `operacion` (
  `OperacionId` int NOT NULL,
  `OperacionNombre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `operacion`
--

INSERT INTO `operacion` (`OperacionId`, `OperacionNombre`) VALUES
(1, 'Venta'),
(2, 'Renta'),
(3, 'Traspaso'),
(4, 'Vacacional'),
(5, 'Venta o Renta'),
(6, 'Compra');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parentesco`
--

CREATE TABLE `parentesco` (
  `ParentescoId` int NOT NULL,
  `ParentescoNombre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `parentesco`
--

INSERT INTO `parentesco` (`ParentescoId`, `ParentescoNombre`) VALUES
(1, 'Esposo'),
(2, 'Esposa'),
(3, 'Madre'),
(4, 'Padre'),
(5, 'Hijo'),
(6, 'Hija');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedades`
--

CREATE TABLE `propiedades` (
  `PropiedadId` int NOT NULL,
  `PropiedadFolio` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `PropiedadTitulo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `PropiedadTipo` int NOT NULL,
  `PropiedadOperacion` int NOT NULL,
  `PropiedadFinanciamiento` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `PropiedadGravamen` tinyint NOT NULL,
  `PropiedadUso` int NOT NULL,
  `PropiedadAntiguedad` int NOT NULL,
  `PropiedadAsesor` int NOT NULL,
  `PropiedadStatus` int NOT NULL,
  `PropiedadPublicar` tinyint NOT NULL,
  `PropiedadVenta` bigint NOT NULL,
  `PropiedadRenta` bigint NOT NULL,
  `PropiedadMoneda` int NOT NULL,
  `PropiedadDescripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `PropiedadPropietario` int DEFAULT NULL,
  `PropiedadLlaves` int DEFAULT NULL,
  `PropiedadComisionSolicitada` int DEFAULT NULL,
  `PropiedadContrato` int DEFAULT NULL,
  `PropiedadNotificacion` tinyint DEFAULT NULL,
  `PropiedadFechaCierre` date DEFAULT NULL,
  `PropiedadMonto` double DEFAULT NULL,
  `PropiedadAsesorCierre` int DEFAULT NULL,
  `PropiedadProspecto` int DEFAULT NULL,
  `PropiedadComisionCierre` int DEFAULT NULL,
  `PropiedadDiasComision` int DEFAULT NULL,
  `PropiedadVigencia` int NOT NULL,
  `PropiedadCp` int DEFAULT NULL,
  `PropiedadEstado` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `PropiedadMunicipio` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `PropiedadColonia` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `PropiedadCalle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `PropiedadNumero` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `PropiedadReferencia` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedad_caracteristicas`
--

CREATE TABLE `propiedad_caracteristicas` (
  `PropiedadId` int NOT NULL,
  `CaracteristicaId` int NOT NULL,
  `Valor` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `propiedad_caracteristicas`
--

INSERT INTO `propiedad_caracteristicas` (`PropiedadId`, `CaracteristicaId`, `Valor`) VALUES
(21, 1, NULL),
(21, 2, NULL),
(21, 3, NULL),
(21, 4, NULL),
(21, 5, NULL),
(21, 6, NULL),
(21, 7, NULL),
(21, 8, NULL),
(21, 9, NULL),
(21, 10, NULL),
(21, 11, NULL),
(21, 12, NULL),
(21, 13, NULL),
(21, 14, NULL),
(21, 15, NULL),
(21, 16, NULL),
(21, 17, NULL),
(21, 18, NULL),
(21, 19, NULL),
(21, 20, NULL),
(21, 21, NULL),
(21, 22, NULL),
(21, 23, NULL),
(21, 24, NULL),
(21, 25, NULL),
(21, 26, NULL),
(21, 27, NULL),
(21, 28, NULL),
(21, 29, NULL),
(21, 30, NULL),
(21, 31, NULL),
(21, 32, NULL),
(21, 33, NULL),
(21, 34, NULL),
(21, 35, NULL),
(21, 36, NULL),
(21, 37, NULL),
(21, 38, NULL),
(21, 39, NULL),
(21, 40, NULL),
(23, 1, NULL),
(23, 2, NULL),
(23, 3, NULL),
(23, 4, NULL),
(23, 5, NULL),
(23, 6, NULL),
(23, 7, NULL),
(23, 8, NULL),
(23, 9, NULL),
(23, 10, NULL),
(23, 11, NULL),
(23, 12, NULL),
(23, 13, NULL),
(23, 14, NULL),
(23, 15, NULL),
(23, 16, NULL),
(23, 17, NULL),
(23, 18, NULL),
(23, 19, NULL),
(23, 20, NULL),
(23, 21, NULL),
(23, 22, NULL),
(23, 23, NULL),
(23, 24, NULL),
(23, 25, NULL),
(23, 26, NULL),
(23, 27, NULL),
(23, 28, NULL),
(23, 29, NULL),
(23, 30, NULL),
(23, 31, NULL),
(23, 32, NULL),
(23, 33, NULL),
(23, 34, NULL),
(23, 35, NULL),
(23, 36, NULL),
(23, 37, NULL),
(23, 38, NULL),
(23, 39, NULL),
(23, 40, NULL),
(25, 1, NULL),
(25, 2, NULL),
(25, 3, NULL),
(25, 4, NULL),
(25, 5, NULL),
(25, 6, NULL),
(25, 7, NULL),
(25, 8, NULL),
(25, 9, NULL),
(25, 10, NULL),
(25, 11, NULL),
(25, 12, NULL),
(25, 13, NULL),
(25, 14, NULL),
(25, 15, NULL),
(25, 16, NULL),
(25, 17, NULL),
(25, 18, NULL),
(25, 19, NULL),
(25, 20, NULL),
(25, 21, NULL),
(25, 22, NULL),
(25, 23, NULL),
(25, 24, NULL),
(25, 25, NULL),
(25, 26, NULL),
(25, 27, NULL),
(25, 28, NULL),
(25, 29, NULL),
(25, 30, NULL),
(25, 31, NULL),
(25, 32, NULL),
(25, 33, NULL),
(25, 34, NULL),
(25, 35, NULL),
(25, 36, NULL),
(25, 37, NULL),
(25, 38, NULL),
(25, 39, NULL),
(25, 40, NULL),
(27, 1, NULL),
(27, 2, NULL),
(27, 3, NULL),
(27, 4, NULL),
(27, 5, NULL),
(27, 6, NULL),
(27, 7, NULL),
(27, 8, NULL),
(27, 9, NULL),
(27, 10, NULL),
(27, 11, NULL),
(27, 12, NULL),
(27, 13, NULL),
(27, 14, NULL),
(27, 15, NULL),
(27, 16, NULL),
(27, 17, NULL),
(27, 18, NULL),
(27, 19, NULL),
(27, 20, NULL),
(27, 21, NULL),
(27, 22, NULL),
(27, 23, NULL),
(27, 24, NULL),
(27, 25, NULL),
(27, 26, NULL),
(27, 27, NULL),
(27, 28, NULL),
(27, 29, NULL),
(27, 30, NULL),
(27, 31, NULL),
(27, 32, NULL),
(27, 33, NULL),
(27, 34, NULL),
(27, 35, NULL),
(27, 36, NULL),
(27, 37, NULL),
(27, 38, NULL),
(27, 39, NULL),
(27, 40, NULL),
(29, 1, NULL),
(29, 2, NULL),
(29, 3, NULL),
(29, 4, NULL),
(29, 5, NULL),
(29, 6, NULL),
(29, 7, NULL),
(29, 8, NULL),
(29, 9, NULL),
(29, 10, NULL),
(29, 11, NULL),
(29, 12, NULL),
(29, 13, NULL),
(29, 14, NULL),
(29, 15, NULL),
(29, 16, NULL),
(29, 17, NULL),
(29, 18, NULL),
(29, 19, NULL),
(29, 20, NULL),
(29, 21, NULL),
(29, 22, NULL),
(29, 23, NULL),
(29, 24, NULL),
(29, 25, NULL),
(29, 26, NULL),
(29, 27, NULL),
(29, 28, NULL),
(29, 29, NULL),
(29, 30, NULL),
(29, 31, NULL),
(29, 32, NULL),
(29, 33, NULL),
(29, 34, NULL),
(29, 35, NULL),
(29, 36, NULL),
(29, 37, NULL),
(29, 38, NULL),
(29, 39, NULL),
(29, 40, NULL),
(31, 1, NULL),
(31, 2, NULL),
(31, 3, NULL),
(31, 4, NULL),
(31, 5, NULL),
(31, 6, NULL),
(31, 7, NULL),
(31, 8, NULL),
(31, 9, NULL),
(31, 10, NULL),
(31, 11, NULL),
(31, 12, NULL),
(31, 13, NULL),
(31, 14, NULL),
(31, 15, NULL),
(31, 16, NULL),
(31, 17, NULL),
(31, 18, NULL),
(31, 19, NULL),
(31, 20, NULL),
(31, 21, NULL),
(31, 22, NULL),
(31, 23, NULL),
(31, 24, NULL),
(31, 25, NULL),
(31, 26, NULL),
(31, 27, NULL),
(31, 28, NULL),
(31, 29, NULL),
(31, 30, NULL),
(31, 31, NULL),
(31, 32, NULL),
(31, 33, NULL),
(31, 34, NULL),
(31, 35, NULL),
(31, 36, NULL),
(31, 37, NULL),
(31, 38, NULL),
(31, 39, NULL),
(31, 40, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propietarios`
--

CREATE TABLE `propietarios` (
  `PropietariosId` int NOT NULL,
  `PropietariosNombre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `PropietariosAPaterno` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `PropietariosAMaterno` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `PropietariosCorreo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `PropietariosTelefono` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `PropietariosCelular` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `PropietariosDireccion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `PropietariosVigencia` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `propietarios`
--

INSERT INTO `propietarios` (`PropietariosId`, `PropietariosNombre`, `PropietariosAPaterno`, `PropietariosAMaterno`, `PropietariosCorreo`, `PropietariosTelefono`, `PropietariosCelular`, `PropietariosDireccion`, `PropietariosVigencia`) VALUES
(1, 'LUIS MIGUEL', 'VILLA', 'PORTAL', 'LUISMIGUEL', '9934687746', '9934687746', 'IHQWDASIUDBAWBDAUBWD', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prospectos`
--

CREATE TABLE `prospectos` (
  `ProspectoId` int NOT NULL,
  `ProspectoNombre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ProspectoAPaterno` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ProspectoAMaterno` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ProspectoCorreo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ProspectoTelefono` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ProspectoCelular` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ProspectoContacto` int NOT NULL,
  `ProspectoOperacion` int NOT NULL,
  `ProspectoAsesor` int NOT NULL,
  `ProspectoDomicilio` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ProspectoComentario` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ProspectoPropiedades` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ProspectoVigencia` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status`
--

CREATE TABLE `status` (
  `StatusId` int NOT NULL,
  `StatusNombre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `status`
--

INSERT INTO `status` (`StatusId`, `StatusNombre`) VALUES
(1, 'Disponible'),
(2, 'Apartado'),
(3, 'Cancelado'),
(4, 'Rentado'),
(5, 'Vendido'),
(6, 'Es complicado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `TipoId` int NOT NULL,
  `TipoNombre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`TipoId`, `TipoNombre`) VALUES
(1, 'Casa'),
(2, 'Departamento'),
(3, 'Terreno'),
(4, 'Local Comercial'),
(5, 'Bodega Comercial'),
(6, 'Rancho'),
(7, 'Hacienda'),
(8, 'Quinta'),
(9, 'Villa'),
(10, 'Townhouse'),
(11, 'Cabaña'),
(12, 'Casa en Condominio'),
(13, 'Oficina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_caracteristicas`
--

CREATE TABLE `tipo_caracteristicas` (
  `TipoId` int NOT NULL,
  `CaracteristicaId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_caracteristicas`
--

INSERT INTO `tipo_caracteristicas` (`TipoId`, `CaracteristicaId`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 38),
(1, 39),
(1, 40),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(2, 11),
(2, 12),
(2, 13),
(2, 14),
(2, 15),
(2, 16),
(2, 17),
(2, 18),
(2, 19),
(2, 20),
(2, 21),
(2, 22),
(2, 23),
(2, 24),
(2, 25),
(2, 26),
(2, 27),
(2, 28),
(2, 30),
(2, 31),
(2, 32),
(2, 33),
(2, 34),
(2, 35),
(2, 36),
(2, 38),
(2, 39),
(3, 1),
(3, 6),
(3, 15),
(3, 22),
(3, 25),
(3, 26),
(3, 29),
(3, 32),
(3, 33),
(3, 34),
(3, 35),
(3, 36),
(3, 37),
(3, 38),
(4, 1),
(4, 3),
(4, 4),
(4, 5),
(4, 6),
(4, 7),
(4, 13),
(4, 14),
(4, 15),
(4, 16),
(4, 17),
(4, 18),
(4, 19),
(4, 20),
(4, 21),
(4, 22),
(4, 25),
(4, 26),
(4, 28),
(4, 32),
(4, 33),
(4, 34),
(4, 35),
(4, 36),
(4, 38),
(4, 39),
(5, 1),
(5, 3),
(5, 4),
(5, 5),
(5, 6),
(5, 7),
(5, 13),
(5, 14),
(5, 15),
(5, 16),
(5, 17),
(5, 18),
(5, 19),
(5, 20),
(5, 21),
(5, 22),
(5, 23),
(5, 24),
(5, 25),
(5, 26),
(5, 28),
(5, 32),
(5, 33),
(5, 34),
(5, 35),
(5, 36),
(5, 38),
(5, 39),
(6, 1),
(6, 2),
(6, 3),
(6, 4),
(6, 5),
(6, 6),
(6, 7),
(6, 8),
(6, 9),
(6, 10),
(6, 11),
(6, 12),
(6, 13),
(6, 14),
(6, 15),
(6, 16),
(6, 17),
(6, 18),
(6, 19),
(6, 20),
(6, 21),
(6, 22),
(6, 23),
(6, 24),
(6, 25),
(6, 26),
(6, 27),
(6, 28),
(6, 31),
(6, 32),
(6, 33),
(6, 34),
(6, 35),
(6, 36),
(6, 37),
(6, 38),
(6, 39),
(6, 40),
(7, 1),
(7, 2),
(7, 3),
(7, 4),
(7, 5),
(7, 6),
(7, 8),
(7, 9),
(7, 10),
(7, 11),
(7, 12),
(7, 13),
(7, 14),
(7, 15),
(7, 16),
(7, 17),
(7, 18),
(7, 19),
(7, 20),
(7, 21),
(7, 22),
(7, 23),
(7, 25),
(7, 26),
(7, 27),
(7, 28),
(7, 31),
(7, 32),
(7, 33),
(7, 34),
(7, 35),
(7, 36),
(7, 38),
(7, 39),
(7, 40),
(8, 1),
(8, 2),
(8, 3),
(8, 4),
(8, 5),
(8, 6),
(8, 7),
(8, 8),
(8, 9),
(8, 10),
(8, 11),
(8, 12),
(8, 13),
(8, 14),
(8, 15),
(8, 16),
(8, 17),
(8, 18),
(8, 19),
(8, 20),
(8, 21),
(8, 22),
(8, 23),
(8, 25),
(8, 26),
(8, 27),
(8, 28),
(8, 29),
(8, 31),
(8, 32),
(8, 33),
(8, 34),
(8, 35),
(8, 36),
(8, 38),
(8, 40),
(8, 39),
(9, 1),
(9, 2),
(9, 3),
(9, 4),
(9, 5),
(9, 6),
(9, 7),
(9, 8),
(9, 9),
(9, 10),
(9, 11),
(9, 12),
(9, 13),
(9, 14),
(9, 15),
(9, 16),
(9, 18),
(9, 19),
(9, 20),
(9, 21),
(9, 22),
(9, 23),
(9, 24),
(9, 25),
(9, 26),
(9, 27),
(9, 28),
(9, 31),
(9, 32),
(9, 33),
(9, 34),
(9, 35),
(9, 36),
(9, 38),
(9, 39),
(10, 1),
(10, 2),
(10, 3),
(10, 4),
(10, 5),
(10, 6),
(10, 7),
(10, 8),
(10, 9),
(10, 10),
(10, 11),
(10, 12),
(10, 13),
(10, 14),
(10, 15),
(10, 16),
(10, 17),
(10, 18),
(10, 19),
(10, 20),
(10, 21),
(10, 22),
(10, 23),
(10, 24),
(10, 25),
(10, 26),
(10, 27),
(10, 28),
(10, 31),
(10, 32),
(10, 33),
(10, 34),
(10, 35),
(10, 36),
(10, 38),
(10, 39),
(11, 1),
(11, 2),
(11, 3),
(11, 4),
(11, 5),
(11, 6),
(11, 7),
(11, 8),
(11, 9),
(11, 10),
(11, 11),
(11, 12),
(11, 13),
(11, 14),
(11, 15),
(11, 16),
(11, 17),
(11, 18),
(11, 19),
(11, 20),
(11, 21),
(11, 22),
(11, 23),
(11, 24),
(11, 25),
(11, 26),
(11, 27),
(11, 28),
(11, 31),
(11, 32),
(11, 33),
(11, 34),
(11, 35),
(11, 36),
(11, 38),
(11, 39),
(11, 40),
(12, 1),
(12, 2),
(12, 3),
(12, 4),
(12, 5),
(12, 6),
(12, 7),
(12, 8),
(12, 9),
(12, 10),
(12, 11),
(12, 12),
(12, 13),
(12, 14),
(12, 15),
(12, 16),
(12, 17),
(12, 18),
(12, 19),
(12, 20),
(12, 21),
(12, 22),
(12, 23),
(12, 24),
(12, 25),
(12, 26),
(12, 27),
(12, 28),
(12, 31),
(12, 32),
(12, 33),
(12, 34),
(12, 35),
(12, 36),
(12, 38),
(12, 39),
(12, 40),
(13, 1),
(13, 3),
(13, 4),
(13, 5),
(13, 6),
(13, 7),
(13, 13),
(13, 14),
(13, 15),
(13, 16),
(13, 17),
(13, 18),
(13, 19),
(13, 20),
(13, 21),
(13, 22),
(13, 25),
(13, 26),
(13, 28),
(13, 30),
(13, 31),
(13, 32),
(13, 33),
(13, 34),
(13, 35),
(13, 36),
(13, 38),
(13, 39);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `uso`
--

CREATE TABLE `uso` (
  `UsoId` int NOT NULL,
  `UsoNombre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `uso`
--

INSERT INTO `uso` (`UsoId`, `UsoNombre`) VALUES
(1, 'Residencial'),
(2, 'Comercial'),
(3, 'Mixto'),
(4, 'Industrial'),
(5, 'Actividades Productivas'),
(6, 'Forestal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zona`
--

CREATE TABLE `zona` (
  `ZonaId` int NOT NULL,
  `ZonaNombre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `zona`
--

INSERT INTO `zona` (`ZonaId`, `ZonaNombre`) VALUES
(1, 'Villahermosa'),
(2, 'Centro, Villahermosa'),
(3, 'Zona Country'),
(4, 'Zona Ciudad Industrial'),
(5, 'Tabasco 2000');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `antiguedad`
--
ALTER TABLE `antiguedad`
  ADD PRIMARY KEY (`AntiguedadId`);

--
-- Indices de la tabla `asesores`
--
ALTER TABLE `asesores`
  ADD PRIMARY KEY (`AsesorId`),
  ADD KEY `AsesorEspecialidad` (`AsesorEspecialidad`),
  ADD KEY `AsesorZona` (`AsesorZona`);

--
-- Indices de la tabla `caracteristicas`
--
ALTER TABLE `caracteristicas`
  ADD PRIMARY KEY (`CaracteristicaId`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`ContactoId`);

--
-- Indices de la tabla `contacto_emergencia`
--
ALTER TABLE `contacto_emergencia`
  ADD PRIMARY KEY (`CEmergenciaId`),
  ADD KEY `CEParentesco` (`CEParentesco`),
  ADD KEY `CEAsesor` (`CEAsesor`);

--
-- Indices de la tabla `contrato`
--
ALTER TABLE `contrato`
  ADD PRIMARY KEY (`ContratoId`);

--
-- Indices de la tabla `documentacion`
--
ALTER TABLE `documentacion`
  ADD PRIMARY KEY (`DocumentacionId`);

--
-- Indices de la tabla `documentacion_asesor`
--
ALTER TABLE `documentacion_asesor`
  ADD PRIMARY KEY (`DocumentoId`),
  ADD KEY `TipoDocumentacion` (`TipoDocumentacion`),
  ADD KEY `AsesorId` (`AsesorId`);

--
-- Indices de la tabla `documentacion_propiedad`
--
ALTER TABLE `documentacion_propiedad`
  ADD PRIMARY KEY (`DocumentoId`),
  ADD KEY `TipoDocumentacion` (`TipoDocumentacion`),
  ADD KEY `PropiedadId` (`PropiedadId`);

--
-- Indices de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  ADD PRIMARY KEY (`EspecialidadId`);

--
-- Indices de la tabla `financiamiento`
--
ALTER TABLE `financiamiento`
  ADD PRIMARY KEY (`FinanciamientoId`);

--
-- Indices de la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`FotoId`),
  ADD KEY `FotoPropiedad` (`FotoPropiedad`);

--
-- Indices de la tabla `llave`
--
ALTER TABLE `llave`
  ADD PRIMARY KEY (`LlaveId`);

--
-- Indices de la tabla `moneda`
--
ALTER TABLE `moneda`
  ADD PRIMARY KEY (`MonedaId`);

--
-- Indices de la tabla `operacion`
--
ALTER TABLE `operacion`
  ADD PRIMARY KEY (`OperacionId`);

--
-- Indices de la tabla `parentesco`
--
ALTER TABLE `parentesco`
  ADD PRIMARY KEY (`ParentescoId`);

--
-- Indices de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  ADD PRIMARY KEY (`PropiedadId`),
  ADD KEY `PropiedadFinanciamiento` (`PropiedadFinanciamiento`),
  ADD KEY `PropiedadMoneda` (`PropiedadMoneda`),
  ADD KEY `PropiedadAntiguedad` (`PropiedadAntiguedad`),
  ADD KEY `PropiedadOperacion` (`PropiedadOperacion`),
  ADD KEY `PropiedadStatus` (`PropiedadStatus`),
  ADD KEY `PropiedadUso` (`PropiedadUso`),
  ADD KEY `PropiedadTipo` (`PropiedadTipo`),
  ADD KEY `PropiedadLlaves` (`PropiedadLlaves`),
  ADD KEY `PropiedadContrato` (`PropiedadContrato`),
  ADD KEY `PropiedadPropietario` (`PropiedadPropietario`),
  ADD KEY `PropiedadAsesor` (`PropiedadAsesor`),
  ADD KEY `PropiedadAsesorCierre` (`PropiedadAsesorCierre`);

--
-- Indices de la tabla `propiedad_caracteristicas`
--
ALTER TABLE `propiedad_caracteristicas`
  ADD KEY `CaracteristicaId` (`CaracteristicaId`),
  ADD KEY `PropiedadId` (`PropiedadId`);

--
-- Indices de la tabla `propietarios`
--
ALTER TABLE `propietarios`
  ADD PRIMARY KEY (`PropietariosId`);

--
-- Indices de la tabla `prospectos`
--
ALTER TABLE `prospectos`
  ADD PRIMARY KEY (`ProspectoId`),
  ADD KEY `ProspectoContacto` (`ProspectoContacto`),
  ADD KEY `ProspectoOperacion` (`ProspectoOperacion`),
  ADD KEY `ProspectoAsesor` (`ProspectoAsesor`);

--
-- Indices de la tabla `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`StatusId`);

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`TipoId`);

--
-- Indices de la tabla `tipo_caracteristicas`
--
ALTER TABLE `tipo_caracteristicas`
  ADD KEY `CaracteristicaId` (`CaracteristicaId`),
  ADD KEY `TipoId` (`TipoId`);

--
-- Indices de la tabla `uso`
--
ALTER TABLE `uso`
  ADD PRIMARY KEY (`UsoId`);

--
-- Indices de la tabla `zona`
--
ALTER TABLE `zona`
  ADD PRIMARY KEY (`ZonaId`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `antiguedad`
--
ALTER TABLE `antiguedad`
  MODIFY `AntiguedadId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `asesores`
--
ALTER TABLE `asesores`
  MODIFY `AsesorId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `caracteristicas`
--
ALTER TABLE `caracteristicas`
  MODIFY `CaracteristicaId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `ContactoId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `contacto_emergencia`
--
ALTER TABLE `contacto_emergencia`
  MODIFY `CEmergenciaId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `contrato`
--
ALTER TABLE `contrato`
  MODIFY `ContratoId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `documentacion`
--
ALTER TABLE `documentacion`
  MODIFY `DocumentacionId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `documentacion_asesor`
--
ALTER TABLE `documentacion_asesor`
  MODIFY `DocumentoId` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `documentacion_propiedad`
--
ALTER TABLE `documentacion_propiedad`
  MODIFY `DocumentoId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  MODIFY `EspecialidadId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `financiamiento`
--
ALTER TABLE `financiamiento`
  MODIFY `FinanciamientoId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `fotos`
--
ALTER TABLE `fotos`
  MODIFY `FotoId` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `llave`
--
ALTER TABLE `llave`
  MODIFY `LlaveId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `moneda`
--
ALTER TABLE `moneda`
  MODIFY `MonedaId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `operacion`
--
ALTER TABLE `operacion`
  MODIFY `OperacionId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `parentesco`
--
ALTER TABLE `parentesco`
  MODIFY `ParentescoId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  MODIFY `PropiedadId` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `propietarios`
--
ALTER TABLE `propietarios`
  MODIFY `PropietariosId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `prospectos`
--
ALTER TABLE `prospectos`
  MODIFY `ProspectoId` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `status`
--
ALTER TABLE `status`
  MODIFY `StatusId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tipo`
--
ALTER TABLE `tipo`
  MODIFY `TipoId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `uso`
--
ALTER TABLE `uso`
  MODIFY `UsoId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `zona`
--
ALTER TABLE `zona`
  MODIFY `ZonaId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asesores`
--
ALTER TABLE `asesores`
  ADD CONSTRAINT `asesores_ibfk_1` FOREIGN KEY (`AsesorEspecialidad`) REFERENCES `especialidad` (`EspecialidadId`),
  ADD CONSTRAINT `asesores_ibfk_2` FOREIGN KEY (`AsesorZona`) REFERENCES `zona` (`ZonaId`);

--
-- Filtros para la tabla `contacto_emergencia`
--
ALTER TABLE `contacto_emergencia`
  ADD CONSTRAINT `contacto_emergencia_ibfk_2` FOREIGN KEY (`CEParentesco`) REFERENCES `parentesco` (`ParentescoId`),
  ADD CONSTRAINT `contacto_emergencia_ibfk_3` FOREIGN KEY (`CEAsesor`) REFERENCES `asesores` (`AsesorId`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `documentacion_asesor`
--
ALTER TABLE `documentacion_asesor`
  ADD CONSTRAINT `documentacion_asesor_ibfk_2` FOREIGN KEY (`TipoDocumentacion`) REFERENCES `documentacion` (`DocumentacionId`),
  ADD CONSTRAINT `documentacion_asesor_ibfk_3` FOREIGN KEY (`AsesorId`) REFERENCES `asesores` (`AsesorId`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `documentacion_propiedad`
--
ALTER TABLE `documentacion_propiedad`
  ADD CONSTRAINT `documentacion_propiedad_ibfk_2` FOREIGN KEY (`TipoDocumentacion`) REFERENCES `documentacion` (`DocumentacionId`);

--
-- Filtros para la tabla `propiedades`
--
ALTER TABLE `propiedades`
  ADD CONSTRAINT `propiedades_ibfk_11` FOREIGN KEY (`PropiedadLlaves`) REFERENCES `llave` (`LlaveId`),
  ADD CONSTRAINT `propiedades_ibfk_12` FOREIGN KEY (`PropiedadContrato`) REFERENCES `contrato` (`ContratoId`),
  ADD CONSTRAINT `propiedades_ibfk_14` FOREIGN KEY (`PropiedadPropietario`) REFERENCES `propietarios` (`PropietariosId`),
  ADD CONSTRAINT `propiedades_ibfk_15` FOREIGN KEY (`PropiedadAsesor`) REFERENCES `asesores` (`AsesorId`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `propiedades_ibfk_16` FOREIGN KEY (`PropiedadAsesorCierre`) REFERENCES `asesores` (`AsesorId`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `propiedades_ibfk_2` FOREIGN KEY (`PropiedadMoneda`) REFERENCES `moneda` (`MonedaId`),
  ADD CONSTRAINT `propiedades_ibfk_3` FOREIGN KEY (`PropiedadAntiguedad`) REFERENCES `antiguedad` (`AntiguedadId`),
  ADD CONSTRAINT `propiedades_ibfk_4` FOREIGN KEY (`PropiedadOperacion`) REFERENCES `operacion` (`OperacionId`),
  ADD CONSTRAINT `propiedades_ibfk_5` FOREIGN KEY (`PropiedadStatus`) REFERENCES `status` (`StatusId`),
  ADD CONSTRAINT `propiedades_ibfk_6` FOREIGN KEY (`PropiedadUso`) REFERENCES `uso` (`UsoId`),
  ADD CONSTRAINT `propiedades_ibfk_8` FOREIGN KEY (`PropiedadTipo`) REFERENCES `tipo` (`TipoId`);

--
-- Filtros para la tabla `propiedad_caracteristicas`
--
ALTER TABLE `propiedad_caracteristicas`
  ADD CONSTRAINT `propiedad_caracteristicas_ibfk_2` FOREIGN KEY (`CaracteristicaId`) REFERENCES `caracteristicas` (`CaracteristicaId`);

--
-- Filtros para la tabla `prospectos`
--
ALTER TABLE `prospectos`
  ADD CONSTRAINT `prospectos_ibfk_1` FOREIGN KEY (`ProspectoContacto`) REFERENCES `contacto` (`ContactoId`),
  ADD CONSTRAINT `prospectos_ibfk_3` FOREIGN KEY (`ProspectoOperacion`) REFERENCES `operacion` (`OperacionId`);

--
-- Filtros para la tabla `tipo_caracteristicas`
--
ALTER TABLE `tipo_caracteristicas`
  ADD CONSTRAINT `tipo_caracteristicas_ibfk_1` FOREIGN KEY (`CaracteristicaId`) REFERENCES `caracteristicas` (`CaracteristicaId`),
  ADD CONSTRAINT `tipo_caracteristicas_ibfk_2` FOREIGN KEY (`TipoId`) REFERENCES `tipo` (`TipoId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
