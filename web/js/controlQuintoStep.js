$(document).ready(function(){

    //Remuevo la clase para que no puedan seguir de step
    $('#stepwizard_step5_next').removeClass('next-step');
    validarEncuesta();



});
//Si se clickea en siguiente controlo los valores ingresados. En caso correcto pasa al siguiente step
$('#stepwizard_step5_next').click(function() {
    var validoEncuesta = validarEncuesta();

    var validoJustificaciones=validarTotalJustificaciones();
        //si la validacion de la encuesta es ok y todas las justificaciones tienen valor deja pasar de step
    if(validoEncuesta==true && validoJustificaciones==true){
        $('#stepwizard_step5_next').addClass('next-step'); //Agrego la clase
        $("#error-encuesta").hide();
    }else{
        $("#error-encuesta").show();
    }


});
function validarEncuesta(){
    siguiente = false;
    //pregunta

    var pregunta1=$('input[name="1"]:checked').val();
    var pregunta2=$('input[name="2"]:checked').val();
    var pregunta3=$('input[name="3"]:checked').val();
    var pregunta4=$('input[name="4"]:checked').val();
    var pregunta5=$('input[name="5"]:checked').val();

    if(pregunta1!==undefined && pregunta2!==undefined && pregunta3!==undefined && pregunta4!==undefined && pregunta5!==undefined){
        siguiente=true;
    }else{
        siguiente=false;
    }

    return siguiente;
}
//valida la justificacion 1
//si esta vacio/sin respuesta pinta el borde rojo y no deja continuar de step
//si tiene valor el borde se pone verde
function validarJustificacion1(){
    var siguiente=false;
    var justifacion1=$('#justificacion1').val();
    //console.log(justifacion1);
    if(justifacion1!== ''){
        siguiente=true;
        $('#justificacion1').css('border', '1px solid #36c423');



    }else{
        $('#stepwizard_step5_next').removeClass('next-step');
        $('#justificacion1').css('border', '1px solid #a94442');
    }

    return siguiente;
}
//valida la justificacion 3
//si esta vacio/sin respuesta pinta el borde rojo y no deja continuar de step
//si tiene valor el borde se pone verde
function validarJustificacion3(){
    var siguiente=false;
    var justifacion3=$('#justificacion3').val();
    //console.log(justifacion1);
    if(justifacion3!== ''){
        siguiente=true;
        $('#justificacion3').css('border', '1px solid #36c423');



    }else{
        $('#stepwizard_step5_next').removeClass('next-step');
        $('#justificacion3').css('border', '1px solid #a94442');
    }
    return siguiente;
}
//valida la justificacion 5
//si esta vacio/sin respuesta pinta el borde rojo y no deja continuar de step
//si tiene valor el borde se pone verde
function validarJustificacion5(){
    var siguiente=false;
    var justifacion5=$('#justificacion5').val();
    //console.log(justifacion1);
    if(justifacion5!== ''){
        siguiente=true;
        $('#justificacion5').css('border', '1px solid #36c423');



    }else{
        $('#stepwizard_step5_next').removeClass('next-step');
        $('#justificacion5').css('border', '1px solid #a94442');
    }
    return siguiente;
}

//valida todas las justificaciones, si todas tienen valor devuelve true, de lo contrario false
function validarTotalJustificaciones(){
    var siguiente = false;
    //pregunta

    var justificacion1=validarJustificacion1();
    var justificacion3=validarJustificacion3();
    var justificacion5=validarJustificacion5();


    if(justificacion1==true && justificacion3==true && justificacion5==true){
        siguiente=true;
    }else{
        siguiente=false;
    }

    return siguiente;

}