<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php include('../layout/admin/head.php');?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
<?php include('../layout/admin/menu.php');?>
 
    <div class="content-wrapper">
<br>
   <div class="content">

   <div class="container">
     <h2>Creación de un nuevo Usuario</h2>
        <div class="container">
            <div class="row">
            <div class="col md-6*2">
                <div class="card" style= "border: 1px solid #606060" >
                    <div class="card-header" style= "background-color: #007bff; color: #ffffff">
                    <h4>Nuevo Usuario</h4>
                     </div>
                <div class="card-body">
                    <div class="formgroup">
                        <label for="">Nombre (s) y Apellido (s):</label>
                        <input type="text" class="form-control" id="nombres">
                    </div>
                    <div class="formgroup">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" placeholder="ejemplo@um.es" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}"
                               title="El formato debe coincidir con 1 ARROBA @ y 1 punto." required >

                   </div>
                    <div class="formgroup">
                        <label for="">Contraseña:</label>
                        <input type="text" class="form-control"  id="password_user" >
                    </div>  
                    <div class="formgroup">
                        <label for="">Repita la Contraseña:</label>
                        <input type="text" class="form-control" id="repeat_password_user">
                    </div>
                    <br>
                    <div class="formgroup">
                        <button class= "btn btn-primary" id= "btn_guardar">Guardar</button>
                        <a href="../usuarios/"" class= "btn btn-default">Cancelar</a>
                    </div>
                    <div   id= "respuesta">
                        
                    </div>
                 </div>
                 </div>
            </div>
                <div class="col md-6*2"></div>
         </div>
        </div>
   </div>   
   </div>
  
    </div>
    <?php include('../layout/admin/footer.php');?> 
</div>
<?php include('../layout/admin/footer_link.php');?> 
</body>
</html>

<script>
      $('#btn_guardar').click(function(){
        
        var nombres = $('#nombres').val();
        var email = $('#email').val();
        var password_user = $('#password_user').val();
        var repeat_password_user = $('#repeat_password_user').val();
          var re = /[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}/igm;;

        if(nombres == ""){
            alert('Debe de  llenar el  campo NOMBRES');
            $('#nombres').focus();

        }else if (email == '' || !re.test(email)){
            alert('Debe de  llenar el campo  de EMAIL o el EMAIL ingresado es invalido');
            $('#email').focus();

        }else if(password_user == ""){
            alert('Debe de  llenar el campo para la Contraseña');
            $('#email').focus();

        }else if(repeat_password_user == ""){
            alert('Debe de  llenar el campo  para repetir la Contraseña');
            $('#email').focus();

      }else{
            var url = 'controller_create.php';
            $.post(url , {nombres:nombres , email:email, password_user:password_user, repeat_password_user:repeat_password_user} , function(datos){
            $('#respuesta').html(datos);
        });
      }         
    });

</script>


