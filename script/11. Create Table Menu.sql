CREATE TABLE menu (
   status_menu VARCHAR(100) NOT NULL COLLATE utf8_general_ci COMMENT 'Status',
   id_usuario INT(1) DEFAULT NULL COMMENT 'ID Usuario'
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Status Menu';