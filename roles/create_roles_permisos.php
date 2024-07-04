<?php
include('../app/config.php');

$id = $_GET['rol_id'];
$nombre_rol = $_GET['nombre_rol'];
$permiso_id = $_GET['permiso_id'];

date_default_timezone_set("America/Caracas");
$fechahora = date("y-m-d H:i");

$sentencia = $pdo->prepare("INSERT INTO  tb_roles_permisos (rol_id, nombre_rol, permiso_id, fyh_cracion, estado) 
     VALUES (:rol_id, :nombre_rol, :permiso_id, :fyh_cracion, :estado)");
$sentencia->bindParam('rol_id', $id);
$sentencia->bindParam('nombre_rol', $nombre_rol);
$sentencia->bindParam('permiso_id', $permiso_id);
$sentencia->bindParam('fyh_cracion', $fechahora);
$sentencia->bindParam('estado', $estado_del_registro);


if ($sentencia->execute()){

    ?>
     <script>alert('Se  Registro el permiso con éxito')</script>
    
   
    <?php

}else{
    echo"No se pudo registrar el permiso";
}
?>
<div class="row">
<div class="col-md-12">
<table class="table table-bordered tale-sm table-striped table-hover"  id="tabla_res<?=$id;?>" >
<tr>
   <th styles="background-color: #dbcd59">Nro</th>
   <th styles="background-color: #dbcd59">Rol</th> 
   <th styles="background-color: #dbcd59">Permiso</th>
   <th styles="background-color: #dbcd59">Acción</th>
 
</tr>
<?php
           $contador = 0;
           $sql_roles_permisos = "SELECT * FROM tb_roles_permisos AS rolper 
            INNER JOIN tb_permisos as per ON per.id_permiso = rolper.permiso_id 
            INNER JOIN tb_roles as rol ON rol.id_rol = rolper.rol_id 
            WHERE rolper.estado = '1' ORDER BY per.nombre_url asc";
            $query_roles_permisos = $pdo->prepare($sql_roles_permisos);
            $query_roles_permisos->execute();
            $roles_permisos = $query_roles_permisos-> fetchALL(PDO::FETCH_ASSOC);
           foreach($roles_permisos as $rol_permiso){
                if ($id == $rol_permiso['rol_id'] ){
                $id_rol_permiso = $rol_permiso['id_rol_permiso']; 
                $contador = $contador + 1; ?>
           <tr>
           <td><center><?=$contador;?></center></td>
           <td><center><?=$rol_permiso['nombre'];?></center></td>
           <td><center><?=$rol_permiso['nombre_url'];?></center></td>
          </tr>
              <?php
                     }
                    }
                  ?> 
</table>
</div>
</div>
       