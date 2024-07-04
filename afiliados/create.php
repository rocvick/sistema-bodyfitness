<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php include('../layout/admin/head.php');?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <?php include('../layout/admin/menu.php');?>

    <div class="content-wrapper">
        <br>
        <div class="content">
            <form action="controller_create.php" method="post" enctype="multipart/form-data" onsubmit="return validarForm();">
                <div class="row">
                    <div class="card col-md-12" style= "border: 1px solid #606060" >
                        <div class="card-header" style= "background-color: #007bff; color: #ffffff">
                            <h4>Nuevo Afiliado</h4>
                        </div>
                    </div>
                    <div class="card col-md-8" style= "border: 1px solid #606060" >
                        <div class="card-body">
                            <div class="container-fluid">

                                <?php
                                //date_default_timezone_set("America/Caracas");
                                //$fecha_reg  = date("d-m-Y H:i");
                                //?>
                                <!-- <div class="col-md-3">
                                    <label for="fecha_reg">Fecha de Registro:</label>
                                    <input type="datetime" class="form-control" id="fecha_reg" name="fecha_reg" value="<?php //echo $fecha_reg;?>">
                                </div> -->
                                <div class="col-md-6" >
                                    <label for="fecha_reg" >Fecha de Registro (xx-xx-xxxx):</label>
                                    <input  type="datetime" class="form-control" id="fecha_reg" name="fecha_reg" >
                                </div>
                                <br>
                                <div class="row">
                                <div class="col-md-3">
                                    <label for="ci">CI:</label>
                                    <input type="text" class="form-control" name="ci" id="ci">
                                   
                                 </div>
                                <div class="col-md-4">
                                    <label for="nombres">Nombres:</label>
                                    <input type="text" style="text-transform: uppercase" class="form-control" id= "nombres" name="nombres">
                                    <?php
                                        // Validar el nombre
                                            if (empty($_POST['name'])) {
                                            $errors[] = "El campo Nombres es obligatorio";
                                            }
                                    ?>
                                </div>
                                <div class="col-md-4">
                                    <label for="apellidos" >Apellidos:</label>
                                    <input type="text"  style="text-transform: uppercase" class="form-control" id="apellidos" name="apellidos">
                                </div>
                                </div>
                                <br>
                                <div class="row">
                                <div class="col-md-4">
                                    <label for="email" >Email:</label>
                                    <input type="email"  class="form-control" id="email" name="email">
                                </div>
                                <div class="col-md-5">
                                    <label for="direccion" >Dirección:</label>
                                    <input type="text" style="text-transform: uppercase" class="form-control" name="direccion">
                                </div>
                                <div class="col-md-3">
                                    <label for="telefonos">Teléfono:</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono">
                                </div>
                                </div>
                                <br>
                                <div class="row">
                                <div class="col-md-4">
                                    <label for="fyh_nacimiento">Fecha de Nac.:</label>
                                    <input type="date" class="form-control" name="fyh_nacimiento">
                                </div>
                                <div class="col-md-3">
                                    <label for="sexo" >Genero:</label>
                                    <div class="form-group">
                                        <select class="form-control form-control-sm" name="sexo">
                                            <option value="Femenino">Femenino</option>
                                            <option value="Masculino">Masculino</option>
                                            <option value="Otro">Otro</option>
                                        </select>
                                    </div>
                                </div>
                                    <div class="col-md-4">
                                        <label for="tel_emergencia" >Tlf(s). de Emergencia:</label>
                                        <input type="text" class="form-control"name="tel_emergencia">
                                    </div>
                                </div>
                            <br>
                                <div class="form-group">
                                    <label for="enfermedad" >Indique Observación Adicional y/o Enfermedad que Padece:</label>
                                    <input type="text"  style="text-transform: uppercase" class="form-control" name="enfermedad">
                                </div>



                            </div>
                        </div>
                    </div>
                    <div class="card col-md-4" style= "border: 1px solid #606060" >

                        <div class="card-body">
                            <div class="container-fluid">
                                <div class="form-group">
                                    <label  class="form-label">Membrecia en la cual se registra:  </label>
                                    <select class="form-control" id="membrecia_registro" name="membrecia_registro" onchange="cargarValor(this.value)">
                                    
                                        <option value="0">--Seleccione una Opción:--</option>
                                        <?php
                                        $query_membrecia = $pdo->prepare("SELECT * FROM tb_membrecias ");
                                        $query_membrecia->execute();
                                        $membrecias = $query_membrecia-> fetchALL(PDO::FETCH_ASSOC);
                                        ?>
                                        <?php foreach($membrecias as $membrecia):?>
                                           
                                            <option value="<?php echo $membrecia['id'] . '-' . $membrecia['nombre']?>"><?php echo $membrecia['nombre']?></option>
                                            
                                        <?php endforeach ?>
                                                                              
                                    </select>
                                    
                                </div>
                                <div class="form-group" id="valor_div"></div>

                                <div class="row">
                                    <div class="form-group">
                                        <label for="">Foto de Perfil</label>
                                        <center>
                                            <input type="file" class="form-control" id="file" name="file"> <br> <br>
                                        </center>
                                        <output id="list" style="margin-top: 0px"></output>
                                    </div>
                                </div>

                                <center>
                                    <input type="submit" class="btn btn-primary btn-lg" value="Registrar" onclick="return validarFormulario();">
                                    <a href="../afiliados/" class= "btn btn-default btn-lg">Cancelar</a>
                                </center>
                                <divid= "respuesta"></div>

                        </div>
                    </div>
                </div>
        </div>
        </form>
    </div>

</div>
<?php include('../layout/admin/footer.php');?>
</div>
<?php include('../layout/admin/footer_link.php');?>
</body>
</html>



<script>
    $(document).ready(function(){
        $('#membrecia_registro').change(function(){
            var id_membrecia = $(this).val();
           
            cargarValor(id_membrecia);
        });
        function cargarValor(id_membrecia){
            $.ajax({
                url: 'filtrar.php',
                method: 'POST',
                data: {
                    id_membrecia:id_membrecia
                },
                success: function(data) {
                    $('#valor_div').html(data);
                }
            });
        }
        cargarValor('');
    })
</script>
<script>
    function archivo(evt) {
        var files = evt.target.files; // FileList object
        // Obtenemos la imagen del campo "file".
        for (var i = 0, f; f = files[i]; i++) {
            //Solo admitimos imágenes.
            if (!f.type.match('image.*')) {
                continue;
            }
            var reader = new FileReader();
            reader.onload = (function (theFile) {
                return function (e) {
                    // Insertamos la imagen
                    document.getElementById("list").innerHTML = ['<img class="thumb thumbnail" src="',e.target.result, '" width="200px" title="', escape(theFile.name), '"/>'].join('');
                };
            })(f);
            reader.readAsDataURL(f);
        }
    }
    document.getElementById('file').addEventListener('change', archivo, false);
</script>
<script>
function validarFormulario() {
        var fecha_reg = $('#fecha_reg').val();
        var ci = $('#ci').val();
        var nombres = $('#nombres').val();
        var apellidos = $('#apellidos').val();
        var email = $('#email').val();
        var telefono = $('#telefono').val();

        if(fecha_reg == ""){
            alert('Debe colocar la fecha del último pago realizado por el Afiliado');
            $('#fecha_reg').focus();
            return false; // Evita que se envíe el formulario 
        }else if (ci == ""){
            alert('El campo CI es obligatorio');
            $('#ci').focus();
            return false; // Evita que se envíe el formulario        
        }else if (nombres == ""){
            alert('El campo NOMBRES es obligatorio');
            $('#nombres').focus();
            return false; // Evita que se envíe el formulario
        }else if (apellidos == ""){
            alert('El campo APELLIDOS es obligatorio');
            $('#apellidos').focus();
            return false; // Evita que se envíe el formulario
        }else if (email == ""){
            alert('El campo EMAIL es obligatorio');
            $('#email').focus();
            return false; // Evita que se envíe el formulario
          }else if (telefono == ""){
            alert('El campo TELEFONO es obligatorio');
            $('#telefono').focus();
            return false; // Evita que se envíe el formulario
           
       }
       return true; // Permite que se envíe el formulario
    }

</script>
