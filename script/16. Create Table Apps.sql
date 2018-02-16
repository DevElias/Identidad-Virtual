CREATE TABLE apps (
   id INT(10) NOT NULL AUTO_INCREMENT,
   app VARCHAR(200) DEFAULT NULL COLLATE utf8_general_ci COMMENT 'nombre de la aplicacion',
   id_app VARCHAR(255) DEFAULT NULL COMMENT 'Id da aplicacion',
   redirect VARCHAR(255) DEFAULT NULL COLLATE utf8_general_ci COMMENT 'Redirect',
  PRIMARY KEY (id)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Table de apps'