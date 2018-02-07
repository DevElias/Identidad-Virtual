CREATE TABLE region (
   id INT(10) NOT NULL AUTO_INCREMENT,
   nombre VARCHAR(100) NOT NULL COLLATE utf8_general_ci COMMENT 'Nombre del Region',
   codigo VARCHAR(100) NOT NULL COLLATE utf8_general_ci COMMENT 'Codigo del Region',
   STATUS INT(1) NOT NULL COMMENT 'Activo ou Inactivo',
   borrado INT(1) DEFAULT 0 COMMENT 'Borrado',
   id_creador INT(10) UNSIGNED NOT NULL COMMENT 'Id del Creador',
   id_alterador INT(10) UNSIGNED NOT NULL COMMENT 'Id del Alterador',
   fecha_inc DATETIME NOT NULL COMMENT 'Fecha de inclusion del registro',
   fecha_alt DATETIME NOT NULL COMMENT 'fecha de modificacion del registro',
  PRIMARY KEY (id)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Tabla de Region';