<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');
include('../roles/listado_permisos.php');
?>

<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('../layout/admin/head.php');?>
    <?php include('../layout/admin/footer_link.php');?>
</head>

<body class="hold-transition sidebar-mini">
 <div class="wrapper">
    <?php include('../layout/admin/menu.php');?>

    <div class="content-wrapper">
    <div class="card-header" style= "background-color: #007bff; color: #ffffff">
                 <h4>Emisión de Reportes</h4>
            </div>
<div class="card col-md-12" style= "border: 1px solid #606060" >
           
<form action="controller_generar_reporte.php" method="post">

  <div class="form-row align-items-center">
  <?php
                            date_default_timezone_set("America/Caracas");
                            $originalDate = date("d/m/Y H:i");
                            $DateTime = DateTime::createFromFormat('d/m/Y H:i', $originalDate);
                            $fecha = $DateTime->format('d/m/Y H:i');
                            ?>
                            <div class="col-md-2">
                                <label for="fecha" class="form-lavel">Fecha:</label>
                                <input readonly type="datetime" class="form-control" id="fecha_reg" name="fecha" value="<?php echo $fecha;?>">
                            </div>
                            <br>

<div class="card col-md-8">  
<div class="row">    
    <h3><center>REPORTE A SER EMITIDO</center></h3>
    <br>
 
      <select name="opcion" class="form-control">
      <option  value="0">Seleccione una opción:</option>
        <option  value="AFILIADOS ACTIVOS">AFILIADOS ACTIVOS</option>
        <option  value="AFILIADOS INACTIVOS">AFILIADOS INACTIVOS</option>
        <option  value="PLAN USUAL">PLAN USUAL</option>
        <option  value="CLASES DIARIAS">CLASES DIARIAS</option>
        <option  value="TAEKWONDO">TAEKWONDO</option>
        <option  value="YOGA">YOGA</option>
        <option  value="PAGOS RECIBIDOS DEL DIA">PAGOS RECIBIDOS DEL DIA</option>
        <option  value="EXONERADOS">EXONERADOS</option>
      </select>

    </div>
    
    <div class="col-auto my-1">
        <a href="generar_reporte.php" class= "btn btn-primary">Generar Reporte<i class="fa fa">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-bar-graph" viewBox="0 0 16 16">
        <path d="M10 13.5a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-6a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zm-2.5.5a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5zm-3 0a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5z"/>
        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
        </svg>
        </i>
        </a>
    </div>
  </div>
</form>
        </div>

    </div>
</div>

<?php include('../layout/admin/footer_link.php');?>

</body>
</html>
