CREATE TABLE tb_membrecias(
                            id           INT(11)   NOT NULL     AUTO_INCREMENT    PRIMARY KEY,
                            nombre                   VARCHAR(255)  NULL,
                            precio_div               FLOAT(50)  NULL,
                            precio_bs                FLOAT(50)  NULL,
                            fyh_cracion              DATETIME  NULL,
                            fyh_actualizacion        DATETIME  NULL,
                            estado                   VARCHAR(10)
);