CREATE TABLE tb_roles_permisos(
    id_rol_permiso                INT(11)   NOT NULL     AUTO_INCREMENT    PRIMARY KEY,
    rol_id                        INT(11)  NOT NULL,
    permiso_id                    INT(11)  NOT NULL,
    fyh_cracion                   DATETIME  NULL,
    fyh_actualizacion             DATETIME  NULL,
    estado                        VARCHAR(11)

)ENGINE=InnoDB;