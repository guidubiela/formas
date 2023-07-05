CREATE SCHEMA formas;
USE formas;

CREATE TABLE `quadro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `quadrado` (
  `idquadrado` int(11) NOT NULL AUTO_INCREMENT,
  `lado` int(11) NOT NULL,
  `cor` varchar(45) NOT NULL,
  `un` varchar(45) NOT NULL,
  `idquadro` int(11) NOT NULL,
  PRIMARY KEY (`idquadrado`),
  KEY `idquadro` (`idquadro`),
  CONSTRAINT `quadrado_ibfk_1` FOREIGN KEY (`idquadro`) REFERENCES `quadro` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `retangulo` (
  `idretangulo` int(11) NOT NULL AUTO_INCREMENT,
  `lado` int(11) NOT NULL,
  `lado2` int(11) NOT NULL,
  `cor` varchar(45) NOT NULL,
  `un` varchar(45) NOT NULL,
  `idquadro` int(11) NOT NULL,
  PRIMARY KEY (`idretangulo`),
  KEY `idquadro` (`idquadro`),
  CONSTRAINT `retangulo_ibfk_1` FOREIGN KEY (`idquadro`) REFERENCES `quadro` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `triangulo` (
  `idtriangulo` int(11) NOT NULL AUTO_INCREMENT,
  `lado` int(11) NOT NULL,
  `lado2` int(11) NOT NULL,
  `lado3` int(11) NOT NULL,
  `cor` varchar(45) NOT NULL,
  `un` varchar(45) NOT NULL,
  `idquadro` int(11) NOT NULL,
  PRIMARY KEY (`idtriangulo`),
  KEY `idquadro` (`idquadro`),
  CONSTRAINT `triangulo_ibfk_1` FOREIGN KEY (`idquadro`) REFERENCES `quadro` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `circulo` (
  `idcirculo` int(11) NOT NULL AUTO_INCREMENT,
  `raio` int(11) NOT NULL,
  `cor` varchar(45) NOT NULL,
  `un` varchar(45) NOT NULL,
  `idquadro` int(11) NOT NULL,
  PRIMARY KEY (`idcirculo`),
  KEY `idquadro` (`idquadro`),
  CONSTRAINT `idquadro` FOREIGN KEY (`idquadro`) REFERENCES `quadro` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




