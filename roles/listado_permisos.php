<?php
            $sql_permisos = "SELECT * FROM tb_permisos WHERE estado = '1' ORDER BY nombre_url asc";
            $query_permisos = $pdo->prepare($sql_permisos);
            $query_permisos->execute();
            $permisos = $query_permisos-> fetchALL(PDO::FETCH_ASSOC);
           
                       
            ?>