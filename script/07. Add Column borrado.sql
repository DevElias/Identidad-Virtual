ALTER TABLE pais
ADD COLUMN borrado INT(1) DEFAULT 0 AFTER STATUS;

ALTER TABLE AREA
ADD COLUMN borrado INT(1) DEFAULT 0 AFTER STATUS;

ALTER TABLE cargo
ADD COLUMN borrado INT(1) DEFAULT 0 AFTER STATUS;

ALTER TABLE sede
ADD COLUMN borrado INT(1) DEFAULT 0 AFTER STATUS;

ALTER TABLE usuario
ADD COLUMN borrado INT(1) DEFAULT 0 AFTER STATUS;