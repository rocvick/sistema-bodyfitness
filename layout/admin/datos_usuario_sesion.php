<?php
session_start();

if (isset ($_SESSION ['usuario_sesion'])) {
    $usuario_sesion = $_SESSION ['usuario_sesion'];
            $query_usuario_sesion = $pdo->prepare("SELECT * FROM tb_usuarios WHERE email = '$usuario_sesion' AND estado = '1' ");
            $query_usuario_sesion->execute();
            $usuarios_sesions= $query_usuario_sesion->fetchALL(PDO::FETCH_ASSOC);
            foreach($usuarios_sesions as $usuario_sesion){
                $id_sesion = $usuario_sesion['id'];
                $nombres_sesion = $usuario_sesion['nombres'];
                $email_sesion = $usuario_sesion['email'];
                $rol_sesion = $usuario_sesion['rol'];
            }
           
           
            $url = $_SERVER["PHP_SELF"];
            $conta = strlen($url);
            $rest = substr($url, 12, $conta);

            $sql_roles_permisos = "SELECT * FROM tb_roles_permisos AS rolper 
            INNER JOIN tb_permisos as per ON per.id_permiso = rolper.permiso_id 
            INNER JOIN tb_roles as rol ON rol.id_rol = rolper.rol_id 
            WHERE rolper.estado = '1' ";
            $query_roles_permisos = $pdo->prepare($sql_roles_permisos);
            $query_roles_permisos->execute();
            $roles_permisos = $query_roles_permisos-> fetchALL(PDO::FETCH_ASSOC);
            $contadorpermiso = 0;
            foreach($roles_permisos as $roles_permiso){
                if ($rol_sesion == $roles_permiso['nombre_rol']){
                            
                    if ($rest == $roles_permiso['url_url']){
                     //  echo "permiso autorizado";
                        $contadorpermiso = $contadorpermiso + 1;
                    }else{
                        //echo "permiso no autorizado";
                        
                    }
                }

            }

if ($contadorpermiso > 0){
    //echo "ruta autorizada";
}else{
   //echo "usuario no autorizado";
   header('Location: ' .$URL.'/no_autorizado.php' );
  
}

/*}else{
     echo "Para Ingresar a esta Plataforma debe iniciar Sesión";
     header('Location: ' .$URL.'/login' );*/
 };


?>

