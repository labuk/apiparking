--
-- Estructura de tabla para `plato`
--
CREATE TABLE IF NOT EXISTS `plato` (
  `id_plato` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_plato` varchar(255) NOT NULL,
  PRIMARY KEY (`id_plato`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
-- Datos iniciales tabla
INSERT INTO `plato` (`id_plato`, `nombre_plato`) VALUES
(1, "Yogurt con nueces");

--
-- Estructura de tabla para `ingrediente`
--
CREATE TABLE IF NOT EXISTS `ingrediente` (
  `id_ingrediente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_ingrediente` varchar(255) NOT NULL,
  PRIMARY KEY (`id_ingrediente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
-- Datos iniciales tabla
INSERT INTO `ingrediente` (`id_ingrediente`, `nombre_ingrediente`) VALUES
(1, "Yogurt"),
(2, "Nuez");

--
-- Estructura de tabla para `alergeno`
--
CREATE TABLE IF NOT EXISTS `alergeno` (
  `id_alergeno` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_alergeno` varchar(255) NOT NULL,
  PRIMARY KEY (`id_alergeno`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
-- Datos iniciales tabla
INSERT INTO `alergeno` (`id_alergeno`, `nombre_alergeno`) VALUES
(1, "Lactosa"),
(2, "Proteina leche"),
(3, "Fruto seco");
--
-- Estructura de tabla para la tabla `plato_ingrediente`
--
CREATE TABLE IF NOT EXISTS `plato_ingrediente` (
  `id_plato_ingrediente` int(11) NOT NULL AUTO_INCREMENT,
  `id_plato` int(11) NOT NULL,
  `id_ingrediente` int(11) NOT NULL,
  PRIMARY KEY (`id_plato_ingrediente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
-- Datos iniciales tabla
INSERT INTO `plato_ingrediente` (`id_plato_ingrediente`, `id_plato`, `id_ingrediente`) VALUES
(1, 1, 1),
(2, 1, 2);
--
-- Estructura de tabla para la tabla `ingrediente_alergeno`
--
CREATE TABLE IF NOT EXISTS `ingrediente_alergeno` (
  `id_ingrediente_alergeno` int(11) NOT NULL AUTO_INCREMENT,
  `id_ingrediente` int(11) NOT NULL,
  `id_alergeno` int(11) NOT NULL,
  PRIMARY KEY (`id_ingrediente_alergeno`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
INSERT INTO `ingrediente_alergeno` (`id_ingrediente_alergeno`, `id_ingrediente`, `id_alergeno`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 3);
