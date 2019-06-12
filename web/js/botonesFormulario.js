function myFunction() {
    // Get the checkbox
    var checkBox =$('input[name="swichtCapitan"]:checked').val();
    //var radioInput = document.getElementById("swichtCapitan").val();
    // Get the output text
    var text = document.getElementById("opcionesNoSoyCapitan");
    var cap = document.getElementById("opcionesCapitan");


    // If the checkbox is checked, display the output text
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
        text.style.display = "block";
        cap.style.display = "none";
        $('#idTipocarrera').val(null).trigger("change");
        $('#idParametrosCantPersonas').val(null).trigger("change");
        $('.field-idNombreCapitan').removeClass('has-success');
        $('.field-idCantidadPersonas').removeClass('has-success');

    }
}

$('#telefonoPersonaEmergencia').keyup(function(){
    var telPersona = document.getElementById('persona-telefonopersona').value;
    var telPersonaEmergencia = document.getElementById('personaemergencia-telefonopersonaemergencia').value;
    var botonNextCuartoPaso = document.getElementById('stepwizard_step4_next');
    if(telPersona == telPersonaEmergencia){
        $("#msjTelefonoIgual").append("<small style='color:red'>El contacto de emergencia debe ser distinto a su numero</small>");
        botonNextCuartoPaso.setAttribute('disabled',true);
    }else{
        $("#msjTelefonoIgual").empty();
        botonNextCuartoPaso.removeAttribute('disabled');


    }
})

//cosas nuevas

//Control ingreso de calle
$('#calle').keyup(function(){
    var calle = document.getElementById("calle").value;
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

//Control ingreso numero de calle
$('#numero').keyup(function(){
    var numero = document.getElementById("numero").value;
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
    $('#stepwizard_step1_next').attr('disabled',true);
    $('#stepwizard_step2_next').attr('disabled',true);
    $('#stepwizard_step3_next').attr('disabled',true);
    $('#stepwizard_step4_next').attr('disabled',true);



    

})

// control de llenado del primer paso
$('#primerStep').change(function(){
    var nombrePersona = document.getElementById("persona-nombrepersona").value;
    var apellidoPersona = document.getElementById("persona-apellidopersona").value;
    var fechaPersona = document.getElementById("datepicker").value;
    var sexoPersona = $('input[name="Persona[sexoPersona]"]:checked').val()
    var talleRemeraPersona = document.getElementById("talleremera-idtalleremera").value;
    var nacionalidadPersona = document.getElementById("persona-nacionalidadpersona").value;

    if (nombrePersona !=="" && apellidoPersona !=="" && fechaPersona !=="" && talleRemeraPersona !=="" && sexoPersona !==""  && nacionalidadPersona !==""){
        $('#stepwizard_step1_next').removeAttr('disabled');
    }else{
        $('#stepwizard_step1_next').attr('disabled',true);
    }

})

// control de llenado del segundo paso
$('#segundoStep').change(function(){
    var calleDire = document.getElementById("calle").value;
    var numeroDire = document.getElementById("numero").value;
    var telContacto = document.getElementById("persona-telefonopersona").value;

    if (calleDire !=="" && numeroDire !=="" && telContacto !=="" ){
        $('#stepwizard_step2_next').removeAttr('disabled');
    }else{
        $('#stepwizard_step2_next').attr('disabled',true);
    }
})

// control de llenado del tercer paso
$('#tercerStep').change(function(){
    var obraSocfichaMed = document.getElementById("fichamedica-obrasocial").value;
    var pesofichaMed = document.getElementById("fichamedica-peso").value;
    var alturafichaMed = document.getElementById("fichamedica-altura").value;
    var frecfichaMed = document.getElementById("fichamedica-frecuenciacardiaca").value;
    var tipoSangrefichaMed = document.getElementById("fichamedica-idgruposanguineo").value;
    var donadorfichaMed = $('input[name="Persona[donador]"]:checked').val()
    var evalmedifichaMed = $('input[name="Fichamedica[evaluacionMedica]"]:checked').val()
    var intquirfichaMed = $('input[name="Fichamedica[intervencionQuirurgica]"]:checked').val()
    var suplementosfichaMed = $('input[name="Fichamedica[suplementos]"]:checked').val()
    var medicamentosfichaMed = $('input[name="Fichamedica[tomaMedicamentos]"]:checked').val()

    if (obraSocfichaMed !=="" && pesofichaMed !=="" && alturafichaMed !==""  && frecfichaMed !==""  && tipoSangrefichaMed !==""  && donadorfichaMed !==undefined  && evalmedifichaMed !==undefined  && intquirfichaMed !==undefined  && suplementosfichaMed !==undefined  && medicamentosfichaMed !==undefined ){
        $('#stepwizard_step3_next').removeAttr('disabled');
    }else{
        $('#stepwizard_step3_next').attr('disabled',true);
    }
})

// control de llenado del cuarto paso
$('#cuartoStep').change(function(){
    var nomPerEme = document.getElementById("personaemergencia-nombrepersonaemergencia").value;
    var appePerEme = document.getElementById("personaemergencia-apellidopersonaemergencia").value;
    var telPerEme = document.getElementById("persona-personaemergencia-telefonopersonaemergencia").value;
    var vinPerEme = document.getElementById("personaemergencia-idvinculopersonaemergencia").value;


    if (nomPerEme !=="" && appePerEme !=="" && telPerEme !=="" && vinPerEme !==""){
        $('#stepwizard_step4_next').removeAttr('disabled');
    }else{
        $('#stepwizard_step4_next').attr('disabled',true);
    }
})

