CREATE TABLE tb_clasesdiarias(
                             id_cd                     INT(20)       NULL       PRIMARY KEY,
                             nombre_apellido           VARCHAR(100)  NULL,
                             email                     VARCHAR(100)  NULL,
                             precio_div                DECIMAL(10,2)  NULL,
                             precio_bs                 DECIMAL(10,2)  NULL,
                             subtotal                  DECIMAL(10,2)  NULL,
                             monto_de_cancelacion      DECIMAL(10,2)  NULL,
                             iva_calc                  DECIMAL(10,2)  NULL,
                             fyh_registro              DATE  NULL,
                             fyh_eliminacion           DATE  NULL,
                             estado                    VARCHAR(10)

);