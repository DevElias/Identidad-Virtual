ALTER TABLE cargo 
  ADD COLUMN detalle VARCHAR(255) NOT NULL COLLATE utf8_general_ci COMMENT 'Detalle de lo Cargo' AFTER nombre;
  
 ALTER TABLE AREA 
  ADD COLUMN detalle VARCHAR(255) NOT NULL COLLATE utf8_general_ci COMMENT 'Detalle de la Area' AFTER codigo; 
