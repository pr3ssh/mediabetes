SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


DROP TABLE IF EXISTS `categorias_receta`;
CREATE TABLE IF NOT EXISTS `categorias_receta` (
    `id` int(1) NOT NULL,
    `nombre` varchar(25) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `medidas`;
CREATE TABLE IF NOT EXISTS `medidas` (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `userid` int(10) NOT NULL,
    `valor` int(3) NOT NULL,
    `fecha` date NOT NULL,
    `hora` time NOT NULL,
    `tipo` int(1) NOT NULL,
    `observaciones` text NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1096 ;


DROP TABLE IF EXISTS `newsletter`;
CREATE TABLE IF NOT EXISTS `newsletter` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `email` varchar(100) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;


DROP TABLE IF EXISTS `recetas`;
CREATE TABLE IF NOT EXISTS `recetas` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `userid` int(11) unsigned NOT NULL,
    `categoria` int(11) NOT NULL,
    `titulo` varchar(50) NOT NULL,
    `imagen` varchar(16) NOT NULL,
    `receta` text NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `tipos_medida`;
CREATE TABLE IF NOT EXISTS `tipos_medida` (
    `id` int(1) NOT NULL,
    `nombre` varchar(25) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `first_name` varchar(25) NOT NULL,
    `last_name` varchar(25) NOT NULL,
    `username` varchar(25) NOT NULL,
    `password` varchar(32) NOT NULL,
    `email_address` varchar(50) NOT NULL,
    `role` int(1) unsigned NOT NULL COMMENT 'Role 1=Admin; Role 2=Editor; Role 3=Usuario',
    `email_medico` varchar(50) NOT NULL,
    `debut_diabetico` varchar(4) NOT NULL,
    `tipo_insulina` varchar(20) NOT NULL,
    `ciudad` varchar(50) NOT NULL,
    `provincia` varchar(20) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=92 ;

