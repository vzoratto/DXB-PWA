$(document).ready(function(){

    //Remuevo la clase para que no puedan seguir de step
    $('#stepwizard_step5_next').removeClass('next-step');
    validarEncuesta();



});
//Si se clickea en siguiente controlo los valores ingresados. En caso correcto pasa al siguiente step
$('#stepwizard_step5_next').click(function() {
    var validoEncuesta = validarEncuesta();

    if(validoEncuesta==true){
        $('#stepwizard_step5_next').addClass('next-step'); //Agrego la clase
        $("#error-encuesta").hide();
    }else{
        $("#error-encuesta").show();
    }


});
function validarEncuesta(){
    siguiente = false;
    //pregunta

    var pregunta1=$('input[name="5"]:checked').val();
    var pregunta2=$('input[name="6"]:checked').val();
    var pregunta3=$('input[name="7"]:checked').val();
    var pregunta4=$('input[name="8"]:checked').val();
    var pregunta5=$('input[name="9"]:checked').val();

    if(pregunta1!==undefined){
        siguiente=true;
    }else{
        siguiente=false;
    }

    if(pregunta2!==undefined){
        siguiente=true;
    }else{
        siguiente=false;
    }

    if(pregunta3!==undefined){
        siguiente=true;
    }else{
        siguiente=false;
    }
    if(pregunta4!==undefined){
        siguiente=true;
    }else{
        siguiente=false;
    }
    if(pregunta5!==undefined){
        siguiente=true;
    }else{
        siguiente=false;
    }
    return siguiente;
}