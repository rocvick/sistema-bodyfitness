<?php

include('../app/config.php');
session_start();

$usuario_user= $_POST['usuario'];
$password_user= $_POST['password_user'];
$form_login = "";
if ($_POST['form_login']){
    $form_login ='true';
}

//echo $usuario." - ".$password_user;
$email_tabla = ''; $password_tabla = '';

$contador = 0;
$query_login = $pdo->prepare("SELECT * FROM tb_usuarios WHERE email = '$usuario_user' ");
$query_login->execute();
$usuarios = $query_login-> fetchALL(PDO::FETCH_ASSOC);
foreach($usuarios as $usuario){
    $contador = $contador+1;
    $email_tabla = $usuario['email'];
    $password_user_tabla = $usuario['password_user'];
    $nombres_tabla =  $usuario['nombres'];
}

if (($contador > 0) && (password_verify($password_user, $password_user_tabla)) ) {
    if ($form_login ==""){?>
        <div class="alert alert-success" role="alert">
        Usuario Correcto
    </div>
    <script>location.href = "principal.php"</script>
    <?php
    }else{?>
     <div class="alert alert-success" role="alert">
        Usuario Correcto
    </div>
    <script>location.href = "../principal.php"</script>
    <?php
    }
    ?>
   
    <?php
    $_SESSION['usuario_sesion'] = $email_tabla;

}else{
    ?>
    <div class="alert alert-danger" role="alert">
        Error al introducir sus datos
    </div>
    <script>$('#password').val(""); $('#password').focus();</script>
    <?php

}





/*

if (($contador > 0) && (password_verify($password_user, $password_user_tabla)) ) {
   echo "Datos Correctos";
   session_start();
    $_SESSION['sesion_email'] = $usuario_user;
    header('Location: ' .$URL.'principal.php');
}else{
    echo "Datos Incorrectos, por favor vuelva a intentarlo";
    session_start();
    $_SESSION['Mensaje'] = "error Datos Incorrectos";
    header('Location: ' .$URL.'/login');

}


/*

//if($usuario == "www@gmail.com"){
//  ?>
<!-- <div class="alert alert-success" role="alert">
     Usuario Correcto
</div> -->
<?php
//}else{
?>
<!--  <div class="alert alert-danger" role="alert">
      Usuario Incorrecto
  </div> -->
<?php
//}
?>

*/