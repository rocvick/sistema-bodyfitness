
"use strict";

//capturar video ó imagen
const video = document.querySelector(".video");
const canvas = document.querySelector(".canvas");

//tomar foto
const button = document.querySelector(".start-btn");

//mostrar foto
const photo = document.querySelector(".photo");

//constrains
/*
Aquí enviamos las caracteristicas del video y
audio que solicitamos
*/

const constraints = {
    video: { width: 210, height: 170 },
    audio: false,
};


//acceso a la webcam
/*
Aquí recibimos la respuesta del navegador, es una promesa
 */
const getVideo = async () => {
    try {
        const stream = await navigator.mediaDevices.getUserMedia(constraints);
        handleSucces(stream);
        console.log(stream);
    } catch (error) {
        console.log(error);
    }
};

//3. -----------> si la promesa tiene exito
const handleSucces = (stream) => {
    video.srcObject = stream;
    video.play();
};


//4.------------>Llamada a la función get
getVideo();

//4. ----------> Button y foto
button.addEventListener("click", () => {
    let context = canvas.getContext("2d");
    context.drawImage(video, 0, 0, 210, 170);
    let data = canvas.toDataURL("image/jpg");
    photo.setAttribute("src", data);

});


$('#btn_guardar').click(function(){
    var ci = $('#ci').val();
    var nombres = $('#nombres').val();
    var apellidos = $('#apellidos').val();
    var email = $('#email').val();
    var telefono = $('#telefono').val();
    var direccion = $('#direccion').val();
    var fyh_nacimiento = $('#fyh_nacimiento').val();
    var sexo = $('#sexo').val();
    var enfermedad = $('#enfermedad').val();
    var tel_emergencia = $('#tel_emergencia').val();
    var membrecia_registro = $('#membrecia_registro').val();
    var fyh_registro = $('#fyh_registro').val();
    var fyh_actualizacion = $('#fyh_actualizacion').val();
    var photo = $('#photo').val();
    // var password_user = $('#password_user').val();

    if(ci == ""){
        alert('el campo CI es obligatorio');
        $('#ci').focus();
    }else if(nombres == ""){
        alert('el campo NOMBRES es obligatorio');
        $('#nombres').focus();
    }else if(apellidos == ""){
        alert('el campo APELLIDOS es obligatorio');
        $('#apellidos').focus();
    }else if(email == ""){
        alert('el campo EMAIL es obligatorio');
        $('#email').focus();
    }else if(tel_emergencia == ""){
        alert('el campo TELEFONO de EMERGENCIA es obligatorio');
        $('#tel_emergencia').focus();
    }else if(membrecia_registro == ""){
        alert('el campo MEMBRECIA es obligatorio');
        $('#membrecia_registro').focus();
    }else{
        var url = 'controller_create.php';
        $.post(url , {ci:ci , nombres:nombres , apellidos:apellidos , email:email , telefono:telefono ,
            direccion:direccion , fyh_nacimiento:fyh_nacimiento ,sexo:sexo ,
            enfermedad:enfermedad , tel_emergencia:tel_emergencia , membrecia_registro:membrecia_registro ,
            fyh_registro:fyh_registro , fyh_actualizacion:fyh_actualizacion , photo:photo} , function(datos){
            $('#respuesta').html(datos);
        });
    }
});