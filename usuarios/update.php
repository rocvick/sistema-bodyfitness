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

                <?php
                $id_get= $_GET['id'];
                $query_usuario = $pdo->prepare("SELECT * FROM tb_usuarios WHERE id = '$id_get' AND estado = '1' ");
                $query_usuario->execute();
                $usuarios = $query_usuario-> fetchALL(PDO::FETCH_ASSOC);
                foreach($usuarios as $usuario){
                    $id = $usuario['id'];
                    $nombres = $usuario['nombres'];
                    $email = $usuario['email'];
                    $password_user = $usuario['password_user'];
                }
                ?>

                <h2>Actualización  del Usuario</h2>
                <div class="container">
                    <div class="row">
                        <div class="col md-6*2">

                            <div class="card card-success" style="border: 1px solid #777777">
                                <div class="card-header">
                                    <h3 class="card-title">Edición del Usuario</h3>

                                </div>

                                <div class="card-body">
                                    <div class="formgroup">
                                        <label for="">Nombres:</label>
                                        <input type="text" class="form-control" id="nombres" value="<?php echo $nombres;?>">
                                    </div>
                                    <div class="formgroup">
                                        <label for="">Email:</label>
                                        <input type="email" class="form-control"  id="email" value="<?php echo $email;?>">
                                    </div>
                                    <div class="formgroup">
                                        <label for="">Password:</label>
                                        <input type="text" class="form-control"  id="password_user" value="<?php echo $password_user;?>">
                                    </div>
                                    <br>

                                    <div class="formgroup">
                                        <button class= "btn btn-success" id= "btn_editar">Actualizar</button>
                                        <a href="../usuarios/" class= "btn btn-default">Cancelar</a>
                                    </div>
                                    <div   id= "respuesta">  </div>

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
    $('#btn_editar').click(function(){
        var nombres = $('#nombres').val();
        var email = $('#email').val();
        var password_user = $('#password_user').val();
        var id_user = '<?php echo $id_get= $_GET['id'];?>';
        if(nombres == ""){
            alert('Debe de  llenar el  campo NOMBRES');
            $('#nombres').focus();
        }else  if(email == ""){
            alert('Debe de  llenar el campo  de EMAIL');
            $('#email').focus();
        }else if(password_user == ""){
            alert('Debe de  llenar el campo PASSWORD');
            $('#password_user').focus();
        }else{
            var url = 'controller_update.php';
            $.post(url , {nombres:nombres , email:email, password_user:password_user, id_user:id_user} , function(datos){
                $('#respuesta').html(datos);
            });
        }

    });


</script>
