CREATE TABLE tb_ticket(
                            num_fact                  INT(100)       NULL       PRIMARY KEY,
                            ci                        int(20)  NULL,
                            nombres                   VARCHAR(100)  NULL,
                            apellidos                 VARCHAR(100)  NULL,
                            email                     VARCHAR(100)  NULL,
                            telefono                  VARCHAR(20)  NULL,
                            direccion                 VARCHAR(255)  NULL,
                            nombre_memb               VARCHAR(255)  NULL,
                            precio_div                DECIMAL(10,2)  NULL,
                            precio_bs                 DECIMAL(10,2)  NULL,
                            monto_de_cancelacion      DECIMAL(10,2)  NULL,
                            iva_calc                  DECIMAL(10,2)  NULL,
                            subtotal                  DECIMAL(10,2)  NULL,
                            fecha_fac                 DATE  NULL,
                            fecha_act                 DATE  NULL,
                            fyh_elim                  DATE  NULL,
                            estado                    VARCHAR(10)
);