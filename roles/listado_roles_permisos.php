<?php
            $sql_roles_permisos = "SELECT * FROM tb_roles_permisos AS rolper 
            INNER JOIN tb_permisos as per ON per.id_permiso = rolper.permiso_id 
            INNER JOIN tb_roles as rol ON rol.id_rol = rolper.rol_id 
            WHERE rolper.estado = '1' ORDER BY per.nombre_url asc";
            $query_roles_permisos = $pdo->prepare($sql_roles_permisos);
            $query_roles_permisos->execute();
            $roles_permisos = $query_roles_permisos-> fetchALL(PDO::FETCH_ASSOC);
            
                      
            ?>