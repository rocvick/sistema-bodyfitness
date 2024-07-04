<?php
include('app/config.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link href="public/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    
    <title>Document</title>
    <style>
        @media only screen and (max-width: 150px) {
            video {
                max-width: 80%;
            }
        }
        
    </style>
   
</head>
<body style= "background-image: url('public/imagenes/logobf2.jpg')" >
       
<nav class="navbar navbar-expand-lg bg-success" data-bs-theme="dark">
  <div class="container-fluid">
  <a class="navbar-brand" href="#">
  <img src="<?php echo $URL;?>/public/imagenes/logogym.png" width="30" height="24" class="d-inline-block align-text-top">
      BODYFITNESS GYM
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">INICIO</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">QUIENES SOMOS</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          MENU PRINCIPAL
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">AFILIADOS</a></li>
            <li><a class="dropdown-item" href="#">PAGOS</a></li>
            <li><a class="dropdown-item" href="#">ASISTENCIA</a></li>
            <li><a class="dropdown-item" href="#">CLASES DIARIAS</a></li>
            <li><a class="dropdown-item" href="#">REPORTES</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">CONTACTANOS</a>
        </li>
        </ul>
     <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
     </form>   
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
             INGRESAR
      </button>
    </div>
  </div>
</nav>

<script src="public/js/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="public/js/jquery-3.7.1.min.js"></script>
<script src="public/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>


</body>
</html>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Inicio de Sesión</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Usuario/Email:</label>
                    <input type="email" id="usuario" class="form-control"> 
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Contraseña:</label>
                    <input type="password" id="password" class="form-control"> 
                </div>
            </div>
        </div>
       
        <div id= "respuesta">

        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCELAR</button>
        <button type="button" class="btn btn-primary" id="btn_ingresar">INGRESAR</button>
      </div>
    </div>
  </div>
</div>

<script>
    $('#btn_ingresar').click(function(){
        login();
    });

    $('#password').keypress(function(e){
        if(e.which == 13){
            login();
            //alert('Estas presionando la tecla ENTER');
        }        
     });
     function login(){
        var usuario= $('#usuario').val();
        var password_user= $('#password').val();
        
        if( usuario == ""){
            alert('Debe introducir su usuario...');
            $('#usuario').focus();

        }else if(password_user == ""){
            alert('Debe introducir su contraseña...');
            $('#password').focus();
        }else{
            var url = 'login/controller_login.php'
             $.post(url , {usuario:usuario , password_user:password_user} , function(datos){
            $('#respuesta').html(datos);
        });  
        }
    }  
      
</script>
