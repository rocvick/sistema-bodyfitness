<?php
            $sql_permisos = "SELECT * FROM tb_permisos WHERE estado = '1' AND id_permiso = '$id_permiso'";
            $query_permisos = $pdo->prepare($sql_permisos);
            $query_permisos->execute();
            $permisos = $query_permisos-> fetchALL(PDO::FETCH_ASSOC);
            foreach($permisos as $permiso){
                $nombre_url = $permiso['nombre_url'];
                $url_url = $permiso['url_url'];
                 }    
            ?>