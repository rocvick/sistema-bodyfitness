CREATE TABLE tb_afiliados(
                            ci                        INT(20)       NULL       PRIMARY KEY,
                            nombres                   VARCHAR(100)  NULL,
                            apellidos                 VARCHAR(100)  NULL,
                            email                     VARCHAR(100)  NULL,
                            telefono                  VARCHAR(20)  NULL,
                            direccion                 VARCHAR(255)  NULL,
                            fyh_nacimiento            DATE  NULL,
                            edad                      INT(10) NULL,
                            sexo                      VARCHAR(10)  NULL,
                            enfermedad                VARCHAR(100)  NULL,
                            tel_emergencia            VARCHAR(20)  NULL,
                            membrecia_registro        VARCHAR(100)  NULL,
                            token                     VARCHAR(100)  NULL,
                            fyh_registro              DATE  NULL,
                            fyh_actualizacion         DATE  NULL,
                            fyh_eliminacion           DATE  NULL,
                            estado                    VARCHAR(10)

);
