USE techo_id;

CREATE TABLE sede (
   id INT(10) NOT NULL AUTO_INCREMENT,
   nombre VARCHAR(100) NOT NULL COLLATE utf8_general_ci COMMENT 'Nombre de las Sedes',
   id_pais INT(1) NOT NULL COMMENT 'ID Pais',
   STATUS INT(1) NOT NULL COMMENT 'Activo ou Inactivo',
   id_creador INT(10) UNSIGNED NOT NULL COMMENT 'Id del Creador',
   id_alterador INT(10) UNSIGNED NOT NULL COMMENT 'Id del Alterador',
   fecha_inc DATETIME NOT NULL COMMENT 'Fecha de inclusion del registro',
   fecha_alt DATETIME NOT NULL COMMENT 'fecha de modificacion del registro',
  PRIMARY KEY (id),
  FOREIGN KEY (id_pais) REFERENCES pais (id) ON DELETE CASCADE
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Tabla de las Sedes';