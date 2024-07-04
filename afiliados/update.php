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
                $id_get=$_GET['id'];
                $query_afiliado = $pdo->prepare("SELECT * FROM tb_afiliados WHERE ci = '$id_get' ");
                $query_afiliado->execute();
                $afiliados = $query_afiliado-> fetchALL(PDO::FETCH_ASSOC);
                foreach($afiliados as $afiliado){
                    $fecha_reg = $afiliado['fecha_reg'];
                    $ci = $afiliado['ci'];
                    $nombres = $afiliado['nombres'];
                    $apellidos = $afiliado['apellidos'];
                    $email = $afiliado['email'];
                    $telefono = $afiliado['telefono'];
                    $direccion = $afiliado['direccion'];
                    $fyh_nacimiento = $afiliado['fyh_nacimiento'];
                    $sexo = $afiliado['sexo'];
                    $enfermedad = $afiliado['enfermedad'];
                    $tel_emergencia = $afiliado['tel_emergencia'];
                    $membrecia_registro = $afiliado['membrecia_registro'];
                    $foto = $afiliado['foto'];
                    $estado = $afiliado['estado'];

                }


                ?>



                    <div class="row">
                        <div class="card col-md-12" style= "border: 1px solid #606060" >
                            <div class="card card-success" style="border: 1px solid #777777">
                                <div class="card-header">
                                    <h3 class="card-title">Actualización del Afiliado</h3>

                                </div>
                                </div>
                        </div>
                        <div class="card col-md-4" style= "border: 1px solid #606060" >
                            <div class="card-body">
                                <div class="container-fluid">
                                    <div class="form-group" >
                                        <label for="" >Fecha de Registro:</label>
                                        <input  type="date" id="fecha_reg" value="<?php echo $fecha_reg;?>"disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="">CI:</label>
                                        <input type="text"  id="ci" value="<?php echo $ci;?>"disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Nombres:</label>
                                        <input type="text" class="form-control" name="nombres" id="nombres" value="<?php echo $nombres;?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="" >Apellidos:</label>
                                        <input type="text" class="form-control" name="apellidos" id="apellidos" value="<?php echo $apellidos;?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Email:</label>
                                        <input type="email" class="form-control" name="email" id="email" value="<?php echo $email;?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="" >Direccion:</label>
                                        <input type="text" class="form-control" name="direccion" id="direccion" value="<?php echo $direccion;?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Fecha de Nac.:</label>
                                        <input type="date" class="form-control" id="fyh_nacimiento" name="fyh_nacimiento" value="<?php echo $fyh_nacimiento;?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card col-md-4" style= "border: 1px solid #606060" >
                            <div class="card-body">
                                <div class="container-fluid">
                                    <div class="form-group">
                                        <label for="" >Genero:</label>
                                        <input type="text" id="sexo" value="<?php echo $sexo;?>">

                                    </div>
                                    <div class="form-group">
                                        <label for="">Teléfono(s):</label>
                                        <input type="text" class="form-control" name="telefono" id="telefono" value="<?php echo $telefono;?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="" >Enfermedad que padece:</label>
                                        <input type="text" class="form-control" name="enfermedad" id="enfermedad" value="<?php echo $enfermedad;?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="" >Tlf. de Emergencia:</label>
                                        <input type="text" class="form-control" name="tel_emergencia" id="tel_emergencia" value="<?php echo $tel_emergencia;?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="" >Estado del Afiliado:</label>
                                        <input type="text" class="form-control" name="estado" id="estado" value="<?php echo $estado;?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label  class="form-label">Membrecia en la cual se registró:</label>
                                        <input type="text" class="form-control" name="membrecia_registro" id="membrecia_registro" value="<?php echo $membrecia_registro;?>">
                                        <label  class="" ><small><font color="red">Para cambiar la membrecia del afiliado
                                            debe eliminarlo y registrarlo nuevamente con otra membrecía</font> </small></label>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card col-md-4" style= "border: 1px solid #606060" >

                            <div class="card-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="">Foto de Perfil:</label>
                                               <div class="imagen">
                                                   <img decoding="async" src="fotos/jpg ><?php echo ($foto); ?>">
                                               </div>
                                         </div>

                                     <br>

                                        <div class="formgroup">
                                            <br>
                                            <br>
                                            <button class= "btn btn-success" id= "btn_editar">Actualizar</button>
                                            <a href="../afiliados/" class= "btn btn-default">Cancelar</a>
                                        </div>
                                        <div   id= "respuesta"> </div>
                                    </div>
                                 </div>
                             </div>
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
        var apellidos = $('#apellidos').val();
        var email = $('#email').val();
        var direccion = $('#direccion').val();
        var fyh_nacimiento = $('#fyh_nacimiento').val();
        var sexo = $('#sexo').val();
        var telefono = $('#telefono').val();
        var enfermedad = $('#enfermedad').val();
        var tel_emergencia = $('#tel_emergencia').val();
        var ci_afil = '<?php echo $id_get= $_GET['id'];?>';
        if(nombres == ""){
            alert('El  campo NOMBRES es obligatorio');
            $('#nombres').focus();
        }else if(email == ""){
            alert('El campo  de EMAIL es obligatorio');
            $('#email').focus();
        }else if(apellidos == ""){
            alert('El campo APELLIDOS es obligatorio');
            $('#apellidos').focus();
        }else{
            var url = 'controller_update.php';
            $.post(url , {ci_afil:ci_afil , nombres:nombres , apellidos:apellidos, email:email, direccion:direccion ,fyh_nacimiento:fyh_nacimiento
                    , sexo:sexo , telefono:telefono , enfermedad:enfermedad , tel_emergencia:tel_emergencia} , function(datos){

                $('#respuesta').html(datos);
            });
        }

    });

 </script>
