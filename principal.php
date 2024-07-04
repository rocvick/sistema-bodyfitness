<?php
include('app/config.php');
include('layout/admin/datos_usuario_sesion.php');
   if (isset($_SESSION['usuario_sesion'])){
             ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <?php include('layout/admin/head.php');?>
        </head>
        <body class="hold-transition sidebar-mini">
        <div class="wrapper">
        <?php include('layout/admin/menu.php');?>
         
            <div class="content-wrapper">
           
          
            </div>
            <?php include('layout/admin/footer.php');?> 
        </div>
        <?php include('layout/admin/footer_link.php');?> 
        </body>
        </html>
                        
        <?php
    }else{
         echo "Para ingresar a esta plataforma debe iniciar sesion";
    }

   // echo "Bienvenido administrador";
?>

