//Funcion para mostrar/ocultar informacion de capitan
function myFunction() {
    var checkBox =$('input[name="swichtCapitan"]:checked').val(); //Valor del checkbox capitan
    var text = document.getElementById("opcionesNoSoyCapitan"); //Div de las opciones que no son para capitan
    var cap = document.getElementById("opcionesCapitan"); //Div de las opciones de capitan

    //Si el checkbox es uno muestra las opciones de capitan
    if (checkBox == 1) {
        text.style.display = "none";
        cap.style.display = "block";
        $('#idEquipo').val(null).trigger("change");
        $('#idTipoDeCarrera').val(null).trigger("change");
        $('#idCantidadPersonas').val(null).trigger("change");
        $('#idNombreEquipo').val(null).trigger("change");
        $('#idNombreCapitan').val(null).trigger("change");
        $('.field-idParametrosCantPersonas').removeClass('has-success');

    } else {
        //Si el checkbox es uno muestra las opciones que no son de capitan
        text.style.display = "block";
        cap.style.display = "none";
        $('#idTipocarrera').val(null).trigger("change");
        $('#idParametrosCantPersonas').val(null).trigger("change");
        $('.field-idNombreCapitan').removeClass('has-success');
        $('.field-idCantidadPersonas').removeClass('has-success');

    }
}

//Control telefono de emergencia. Este telefono tiene que ser distinto al ingresado como telefono personal
var telefonoCorrecto = false; //Variable para control
$('#telefonoPersonaEmergencia').keyup(function(){
    var telPersona = document.getElementById('persona-telefonopersona').value;//Valor del telefono personal
    var telPersonaEmergencia = document.getElementById('personaemergencia-telefonopersonaemergencia').value;//Valor telefono de emergencia
    if(telPersona == telPersonaEmergencia){
        if ($('#msjTelefonoIgual').children().length < 1){
            $("#msjTelefonoIgual").append("<small style='color:#a94442'>El contacto de emergencia debe ser distinto a su numero</small>");
            telefonoCorrecto = false;
        }
    }else{
        $("#msjTelefonoIgual").empty();
        telefonoCorrecto = true;
    }
})

//Control ingreso de calle. Entra en esta funcion cada vez que agrega un caracter
$('#calle').keyup(function(){
    var calle = document.getElementById("calle").value;//Valor del input numero
    if (calle ==""){
        if ($('#msjErrorCalle').children().length < 1){
            $("#msjErrorCalle").append("<small style='color:#a94442'>Este campo es obligatorio.</small>");
            $('#calleDireccion').addClass('has-error');
            $('#calleDireccion').removeClass('has-success');
        }
        }else{
            $("#msjErrorCalle").empty();
            if (/^[A-Za-z\_\-\.\s\xF1\xD1]+$/.test(calle)){
                $('#calleDireccion').addClass('has-success');
                $('#calleDireccion').removeClass('has-error');
            }
            else{
                $('#calleDireccion').addClass('has-error');
                $('#calleDireccion').removeClass('has-success');
                $("#msjErrorCalle").append("<small style='color:#a94442'>Debe contener solo letras.</small>");

            }
        }
})

//Control ingreso numero de calle. Entra en esta funcion cada vez que agrega un caracter
$('#numero').keyup(function(){
    var numero = document.getElementById("numero").value; //Valor del input numero
    if (numero ==""){
        if ($('#msjErrorNumero').children().length < 1){
            $("#msjErrorNumero").append("<small style='color:#a94442'>Este campo es obligatorio.</small>");
            $('#numeroDireccion').addClass('has-error');
            $('#numeroDireccion').removeClass('has-success');
        }
        }else{
            $("#msjErrorNumero").empty();
            if (/^([0-9])*$/.test(numero)){
                $('#numeroDireccion').addClass('has-success');
                $('#numeroDireccion').removeClass('has-error');
            }
            else{
                $('#numeroDireccion').addClass('has-error');
                $('#numeroDireccion').removeClass('has-success');
                $("#msjErrorNumero").append("<small style='color:#a94442'>Debe contener solo numeros.</small>");
            }
        }
})

$(document).ready(function(){
    //Remuevo la clase "next-step" en los primero cuatro pasos para que no puedan pasar de step
    $('#stepwizard_step1_next').removeClass('next-step');
    $('#stepwizard_step2_next').removeClass('next-step');
    $('#stepwizard_step3_next').removeClass('next-step');
    $('#stepwizard_step4_next').removeClass('next-step');
})

// Control de llenado del primer paso
$('#primerStep').change(function(){
    var nombrePersona = document.getElementById("persona-nombrepersona").value; //Valor del input nombre de la persona
    var apellidoPersona = document.getElementById("persona-apellidopersona").value; //Valor del input apellido persona
    var fechaPersona = document.getElementById("datepicker").value; // Valor de la fecha
    var sexoPersona = $('input[name="Persona[sexoPersona]"]:checked').val() // Valor del checkbox sexo persona
    var talleRemeraPersona = document.getElementById("talleremera-idtalleremera").value; // Valor del talle de la remera
    var nacionalidadPersona = document.getElementById("persona-nacionalidadpersona").value; // Valor de la nacionalidad de la persona

    //Si los campos esta vacio remuvo la clase "next-step" para que no pueda pasar al siguiente paso, en caso contrario se lo agrego
    if (nombrePersona !=="" && apellidoPersona !=="" && fechaPersona !=="" && talleRemeraPersona !=="" && sexoPersona !==""  && nacionalidadPersona !==""){
        $('#stepwizard_step1_next').addClass('next-step');

    }else{
        $('#stepwizard_step1_next').removeClass('next-step');
    }
    //Remover el error. De otra forma no lo tomaba y seguia pintado de rojo
    if(talleRemeraPersona > 0){
        $('.field-talleremera-idtalleremera').removeClass('has-error');
    }
})

//Control de msj error de los distintos campos del primer paso
//Se ejecuta cada vez que hago click en el boton "siguiente" del primer step
$('#stepwizard_step1_next').click(function(){
    var nombrePersona = document.getElementById("persona-nombrepersona").value; //Valor del input nombre de la persona
    var apellidoPersona = document.getElementById("persona-apellidopersona").value; //Valor del input apellido persona
    var fechaPersona = document.getElementById("datepicker").value; // Valor de la fecha
    var sexoPersona = $('input[name="Persona[sexoPersona]"]:checked').val() // Valor del checkbox sexo persona
    var talleRemeraPersona = document.getElementById("talleremera-idtalleremera").value; // Valor del talle de la remera
    var nacionalidadPersona = document.getElementById("persona-nacionalidadpersona").value; // Valor de la nacionalidad de la persona

    //Si el campo esta vacio agrego la clase "has-error" para indicar a la persona que le falta completar el campo
    //en caso contrario le remuevo la clase
    if(nombrePersona == ""){
        $('.field-persona-nombrepersona').addClass('has-error');  
    }else{
        $('.field-persona-nombrepersona').removeClass('has-error');  
    }
    if(apellidoPersona == ""){
        $('.field-persona-apellidopersona').addClass('has-error');  
    }else{
        $('.field-persona-apellidopersona').removeClass('has-error');  
    }
    if(fechaPersona == ""){
        $('.field-datepicker').addClass('has-error');  
    }else{
        $('.field-datepicker').removeClass('has-error');  
    }
    if(sexoPersona == undefined){
        $('.field-persona-sexopersona').addClass('has-error');  
    }else{
        $('.field-persona-sexopersona').removeClass('has-error');  
    }
    if(talleRemeraPersona > 0){
        $('.field-talleremera-idtalleremera').removeClass('has-error');  
    }else{
        $('.field-talleremera-idtalleremera').addClass('has-error');  
    }
    if(nacionalidadPersona == ""){
        $('.field-persona-nacionalidadpersona').addClass('has-error');  
    }else{
        $('.field-persona-nacionalidadpersona').removeClass('has-error');  
    }
})

// Control de llenado del segundo paso
$('#segundoStep').change(function(){
    var calleDire = document.getElementById("calle").value; //Valor de la direccion de la calle
    var numeroDire = document.getElementById("numero").value; //Valor del numero de la calle
    var telContacto = document.getElementById("persona-telefonopersona").value; //Valor del telefono de contacto

    //Si los campos esta vacio remuvo la clase "next-step" para que no pueda pasar al siguiente paso, en caso contrario se lo agrego
    if (calleDire !=="" && numeroDire !=="" && telContacto !=="" ){
        $('#stepwizard_step2_next').addClass('next-step');

    }else{
        $('#stepwizard_step2_next').removeClass('next-step');
    }
})

//Control de msj error de los distintos campos del segundo paso
//Se ejecuta cada vez que hago click en el boton "siguiente" del segundo step
$('#stepwizard_step2_next').click(function(){
    var calleDire = document.getElementById("calle").value; //Valor de la direccion de la calle
    var numeroDire = document.getElementById("numero").value; //Valor del numero de la calle
    var telContacto = document.getElementById("persona-telefonopersona").value; //Valor del telefono de contacto

    //Si el campo esta vacio agrego la clase "has-error" para indicar a la persona que le falta completar el campo
    //en caso contrario le remuevo la clase
    if(calleDire == ""){
        $('#calleDireccion').addClass('has-error');  
    }else{
        $('#calleDireccion').removeClass('has-error');  
    }
    if(numeroDire == ""){
        $('#numeroDireccion').addClass('has-error');  
    }else{
        $('#numeroDireccion').removeClass('has-error');  
    }
    if(telContacto == ""){
        $('.field-persona-telefonopersona').addClass('has-error');  
    }else{
        $('.field-persona-telefonopersona').removeClass('has-error');  
    }

})

// control de llenado del tercer paso
$('#tercerStep').change(function(){
    var obraSocfichaMed = document.getElementById("fichamedica-obrasocial").value; //Valor de la obra social
    var pesofichaMed = document.getElementById("fichamedica-peso").value; //Valor de la ficha medica
    var alturafichaMed = document.getElementById("fichamedica-altura").value; //Valor altura
    var frecfichaMed = document.getElementById("fichamedica-frecuenciacardiaca").value; //Valor frecuencia cardiaca
    var tipoSangrefichaMed = document.getElementById("fichamedica-idgruposanguineo").value; //Valor grupo sanguinieo
    var donadorfichaMed = $('input[name="Persona[donador]"]:checked').val() //Valor checkbox donador
    var evalmedifichaMed = $('input[name="Fichamedica[evaluacionMedica]"]:checked').val() //Valor checkbox evaluacion medica
    var intquirfichaMed = $('input[name="Fichamedica[intervencionQuirurgica]"]:checked').val() //Valor intervencion quirurjica
    var suplementosfichaMed = $('input[name="Fichamedica[suplementos]"]:checked').val() //Valor checkbox suplementos
    var medicamentosfichaMed = $('input[name="Fichamedica[tomaMedicamentos]"]:checked').val() //Valor checkbox medicamentos

    //Si los campos esta vacio remuvo la clase "next-step" para que no pueda pasar al siguiente paso, en caso contrario se lo agrego
    if (obraSocfichaMed !=="" && pesofichaMed !=="" && alturafichaMed !==""  && frecfichaMed !==""  && tipoSangrefichaMed !==""  && donadorfichaMed !==undefined  && evalmedifichaMed !==undefined  && intquirfichaMed !==undefined  && suplementosfichaMed !==undefined  && medicamentosfichaMed !==undefined ){
        $('#stepwizard_step3_next').addClass('next-step');
    }else{
        $('#stepwizard_step3_next').removeClass('next-step');
    }
})

//Control de msj error de los distintos campos del tercer paso
//Se ejecuta cada vez que hago click en el boton "siguiente" del tercer step
$('#stepwizard_step3_next').click(function(){
    var obraSocfichaMed = document.getElementById("fichamedica-obrasocial").value; //Valor de la obra social
    var pesofichaMed = document.getElementById("fichamedica-peso").value; //Valor de la ficha medica
    var alturafichaMed = document.getElementById("fichamedica-altura").value; //Valor altura
    var frecfichaMed = document.getElementById("fichamedica-frecuenciacardiaca").value; //Valor frecuencia cardiaca
    var tipoSangrefichaMed = document.getElementById("fichamedica-idgruposanguineo").value; //Valor grupo sanguinieo
    var donadorfichaMed = $('input[name="Persona[donador]"]:checked').val() //Valor checkbox donador
    var evalmedifichaMed = $('input[name="Fichamedica[evaluacionMedica]"]:checked').val() //Valor checkbox evaluacion medica
    var intquirfichaMed = $('input[name="Fichamedica[intervencionQuirurgica]"]:checked').val() //Valor intervencion quirurjica
    var suplementosfichaMed = $('input[name="Fichamedica[suplementos]"]:checked').val() //Valor checkbox suplementos
    var medicamentosfichaMed = $('input[name="Fichamedica[tomaMedicamentos]"]:checked').val() //Valor checkbox medicamentos

    //Si el campo esta vacio agrego la clase "has-error" para indicar a la persona que le falta completar el campo
    //en caso contrario le remuevo la clase
    if(obraSocfichaMed == ""){
        $('.field-fichamedica-obrasocial').addClass('has-error');  
    }else{
        $('.field-fichamedica-obrasocial').removeClass('has-error');  
    }
    if(pesofichaMed == ""){
        $('.field-fichamedica-peso').addClass('has-error');  
    }else{
        $('.field-fichamedica-peso').removeClass('has-error');  
    }
    if(alturafichaMed == ""){
        $('.field-fichamedica-altura').addClass('has-error');  
    }else{
        $('.field-fichamedica-altura').removeClass('has-error');  
    }
    if(frecfichaMed == ""){
        $('.field-fichamedica-frecuenciacardiaca').addClass('has-error');  
    }else{
        $('.field-fichamedica-frecuenciacardiaca').removeClass('has-error');  
    }
    if(tipoSangrefichaMed > 0){
        $('.field-fichamedica-idgruposanguineo').removeClass('has-error');  
    }else{
        $('.field-fichamedica-idgruposanguineo').addClass('has-error');  
    }
    if(donadorfichaMed == undefined){
        $('.field-persona-donador').addClass('has-error');  
    }else{
        $('.field-persona-donador').removeClass('has-error');  
    }
    if(evalmedifichaMed == undefined){
        $('.field-fichamedica-evaluacionmedica').addClass('has-error');  
    }else{
        $('.field-fichamedica-evaluacionmedica').removeClass('has-error');  
    }
    if(intquirfichaMed == undefined){
        $('.field-fichamedica-intervencionquirurgica').addClass('has-error');  
    }else{
        $('.field-fichamedica-intervencionquirurgica').removeClass('has-error');  
    }
    if(suplementosfichaMed == undefined){
        $('.field-fichamedica-suplementos').addClass('has-error');  
    }else{
        $('.field-fichamedica-suplementos').removeClass('has-error');  
    }
    if(medicamentosfichaMed == undefined){
        $('.field-fichamedica-tomamedicamentos').addClass('has-error');  
    }else{
        $('.field-fichamedica-tomamedicamentos').removeClass('has-error');  
    }
})


// Control de llenado del cuarto paso
$('#cuartoStep').change(function(){
    var nomPerEme = document.getElementById("personaemergencia-nombrepersonaemergencia").value; //Valor del nombre de la persona emergencia
    var appePerEme = document.getElementById("personaemergencia-apellidopersonaemergencia").value; //Valor del apellido del nombre de la persona de emergencia
    var vinPerEme = document.getElementById("personaemergencia-idvinculopersonaemergencia").value; //Valor vinculo de la persona de emergencia
    var telPerEme = document.getElementById("personaemergencia-telefonopersonaemergencia").value; //Valor telefono de la persona de emergencia

    //Si los campos esta vacio remuvo la clase "next-step" para que no pueda pasar al siguiente paso, en caso contrario se lo agrego
    if (nomPerEme !=="" && appePerEme !=="" && telPerEme !=="" && vinPerEme !=="" && telefonoCorrecto){
        $('#stepwizard_step4_next').addClass('next-step');
        $('.field-personaemergencia-telefonopersonaemergencia').removeClass('has-error');  

    }else{
        $('#stepwizard_step4_next').removeClass('next-step');
        $('.field-personaemergencia-telefonopersonaemergencia').addClass('has-error');  

    }
})

//Control de msj error de los distintos campos del cuarto paso
//Se ejecuta cada vez que hago click en el boton "siguiente" del cuarto step
$('#stepwizard_step4_next').click(function(){    
    var nomPerEme = document.getElementById("personaemergencia-nombrepersonaemergencia").value; //Valor del nombre de la persona emergencia
    var appePerEme = document.getElementById("personaemergencia-apellidopersonaemergencia").value; //Valor del apellido del nombre de la persona de emergencia
    var vinPerEme = document.getElementById("personaemergencia-idvinculopersonaemergencia").value; //Valor vinculo de la persona de emergencia
    var telPerEme = document.getElementById("personaemergencia-telefonopersonaemergencia").value; //Valor telefono de la persona de emergencia

    //Si el campo esta vacio agrego la clase "has-error" para indicar a la persona que le falta completar el campo
    //en caso contrario le remuevo la clase
    if(nomPerEme == ""){
        $('.field-personaemergencia-nombrepersonaemergencia').addClass('has-error');  
    }else{
        $('.field-personaemergencia-nombrepersonaemergencia').removeClass('has-error');  
    }
    if(appePerEme == ""){
        $('.field-personaemergencia-apellidopersonaemergencia').addClass('has-error');  
    }else{
        $('.field-personaemergencia-apellidopersonaemergencia').removeClass('has-error');  
    }
    if(telPerEme == ""){
        $('.field-personaemergencia-telefonopersonaemergencia').addClass('has-error');  
    }else{
        $('.field-personaemergencia-telefonopersonaemergencia').removeClass('has-error');
    }
    if(vinPerEme > 0){
        $('.field-personaemergencia-idvinculopersonaemergencia').removeClass('has-error');  
    }else{
        $('.field-personaemergencia-idvinculopersonaemergencia').addClass('has-error');  
    }

})

