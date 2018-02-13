USE techo_id;

CREATE TABLE usuario (
   id INT(10) NOT NULL AUTO_INCREMENT,
   id_sede INT(10) DEFAULT NULL COMMENT 'ID Sede',
   id_area INT(10) DEFAULT NULL COMMENT 'ID Area',
   id_cargo INT(10) DEFAULT NULL COMMENT 'ID Cargo',
   nombre VARCHAR(100) NOT NULL COLLATE utf8_general_ci COMMENT 'Nombre de los usuarios',
   email VARCHAR(100) NOT NULL COLLATE utf8_general_ci COMMENT 'Email de los usuarios',
   picture VARCHAR(200) NOT NULL COLLATE utf8_general_ci COMMENT 'Foto de los usuarios',
   STATUS INT(1) NOT NULL COMMENT 'Activo ou Inactivo',
   id_alterador INT(10) UNSIGNED NOT NULL COMMENT 'Id del Alterador',
   fecha_inc DATETIME NOT NULL COMMENT 'Fecha de inclusion del registro',
   fecha_alt DATETIME NOT NULL COMMENT 'fecha de modificacion del registro',
  PRIMARY KEY (id),
  FOREIGN KEY (id_sede) REFERENCES sede (id) ON DELETE CASCADE,
  FOREIGN KEY (id_area) REFERENCES AREA (id) ON DELETE CASCADE,
  FOREIGN KEY (id_cargo) REFERENCES cargo (id) ON DELETE CASCADE
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Tabla del usuarios';