CREATE TABLE token (
   id INT(10) NOT NULL AUTO_INCREMENT,
   id_app VARCHAR(100) DEFAULT NULL COLLATE utf8_general_ci COMMENT 'appID',
   id_usuario INT(10) DEFAULT NULL COMMENT 'Id do usuario',
   access_token VARCHAR(100) DEFAULT NULL COMMENT 'Token',
   ip_request VARCHAR(100) DEFAULT NULL COLLATE utf8_general_ci COMMENT 'ip',
   start_session DATETIME DEFAULT NULL COMMENT 'Start Token',
   timeout_session DATETIME DEFAULT NULL COMMENT 'End Token',
  PRIMARY KEY (id),
  FOREIGN KEY (id_usuario) REFERENCES usuario (id) ON DELETE CASCADE
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Table de Token'