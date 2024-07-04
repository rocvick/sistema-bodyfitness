CREATE TABLE tb_asistencias(
                             ci                        INT(20)       NULL       PRIMARY KEY,
                             id                        INT(20)       NULL,
                             nombres                   VARCHAR(100)  NULL,
                             apellidos                 VARCHAR(100)  NULL,
                             membrecia_registro        VARCHAR(100)  NULL,
                             fecha_ultimo_pago         DATE  NULL,
                             fecha_actual              DATE  NULL,
                             fecha_prox_pago           DATE  NULL,
                             estado                    VARCHAR(10),
                             excepcion                 INT(20),
                             foto                      VARCHAR(10)

);
