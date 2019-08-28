$(document).ready(function() {
    //Remuevo la clase "next-step" en el primer paso para que no puedan pasar de step sin antes controlar los datos
    $('#stepwizard_step4_next').removeClass('next-step');

    //Si hay un cambio telefono de emergencia hago el control.
    $('#telefonoPersonaEmergencia').keyup(function() {
        controlTelefono();
    })

    //Si hay un cambio en el ingreso del nombre hago un control.
    $('#personaemergencia-nombrepersonaemergencia').change(function() {
        controlNomPersonaEmergencia();
    })

    //Si hay un cambio en el ingreso en el apellido hago un control
    $('#personaemergencia-apellidopersonaemergencia').change(function() {
        controlApellidoEmergencia();
    })

    //Si hay un cambio en el tipo de vinculo hago el control
    $('#personaemergencia-idvinculopersonaemergencia').change(function() {
        controlVinculoEmergencia();
    })
})



//Se ejecuta cada vez que hago click en el boton "siguiente" del cuarto step
$('#stepwizard_step4_next').click(function() {
    var validoNombreEmergencia = controlNomPersonaEmergencia(); //Valido nombre persona de emergencia
    var validoApellidoEmergencia = controlApellidoEmergencia(); //Valido apellido persona de emergencia
    var validoVinculoEmergencia = controlVinculoEmergencia(); //Valido vinculo persona de emergencia
    var validoTelEmergencia = controlTelefono(); //Valido telefono de emergencia

    if (validoApellidoEmergencia && validoNombreEmergencia && validoTelEmergencia && validoVinculoEmergencia) {
        //Si esta todo correcto agrego la clase para pasar al siguiente paso
        $('#stepwizard_step4_next').addClass('next-step');
    } else {
        //En caso contrario se lo remuevo
        $('#stepwizard_step4_next').removeClass('next-step');
    }
})

//Control nombre persona de emergencia
function controlNomPersonaEmergencia() {
    var nomPerEme = $('#personaemergencia-nombrepersonaemergencia').val(); //Valor del nombre de la persona emergencia
    //var patron = /^[a-zA-Z.,-]+(?:\s[a-zA-Z.,-]+)*$/; //Patron a respetar
    var cantCaracteresNombreEmergenia = nomPerEme.length; //Cantidad de caracteres del nombre persona de emergencia
    var siguiente = false;
    if (nomPerEme !== "" && cantCaracteresNombreEmergenia > 1) {
        //Si el valor es distinto a vacio y se respeta el patron se borra el borde para mostrar que no hay error
        $('#personaemergencia-nombrepersonaemergencia').css('border', 'none');
        $('.field-personaemergencia-nombrepersonaemergencia').removeClass('has-error');
        $('.field-personaemergencia-nombrepersonaemergencia').addClass('has-success');
        siguiente = true; //Y si setea la variabnle en true
    } else {
        //En caso contrario se agrega un borde rojo para indicar que hay un error
        $('#personaemergencia-nombrepersonaemergencia').css('border', '1px solid #a94442');
        $('.field-personaemergencia-nombrepersonaemergencia').removeClass('has-success');
        $('.field-personaemergencia-nombrepersonaemergencia').addClass('has-error');
        siguiente = false; //Y se setea la variable en false
    }
    return siguiente;
}

//Control apellido persona de emergencia
function controlApellidoEmergencia() {
    var appePerEme = $('#personaemergencia-apellidopersonaemergencia').val(); //Valor del apellido del nombre de la persona de emergencia
    //var patron = /^[a-zA-Z.,-]+(?:\s[a-zA-Z.,-]+)*$/; //Patron a respetar
    var cantCaracteresApellidoEmergenia = appePerEme.length; //Cantidad de caracteres del apellido emergencia
    var siguiente = false;
    if (appePerEme !== "" && cantCaracteresApellidoEmergenia > 1) {
        //Si el valor es distinto a vacio y se respeta el patron se borra el borde para mostrar que no hay error
        $('#personaemergencia-apellidopersonaemergencia').css('border', 'none');
        $('.field-personaemergencia-apellidopersonaemergencia').removeClass('has-error');
        $('.field-personaemergencia-apellidopersonaemergencia').addClass('has-success');
        siguiente = true; //Y si setea la variabnle en true
    } else {
        //En caso contrario se agrega un borde rojo para indicar que hay un error
        $('#personaemergencia-apellidopersonaemergencia').css('border', '1px solid #a94442');
        $('.field-personaemergencia-apellidopersonaemergencia').removeClass('has-success');
        $('.field-personaemergencia-apellidopersonaemergencia').addClass('has-error');
        siguiente = false; //Y se setea la variable en false
    }
    return siguiente;
}
//Control vinculo con persona emergencia
function controlVinculoEmergencia() {
    var vinPerEme = $('#personaemergencia-idvinculopersonaemergencia').val(); //Valor vinculo de la persona de emergencia
    var siguiente = false;
    if (vinPerEme > 0) {
        //Si el valor es distinto a vacio y se respeta el patron se borra el borde para mostrar que no hay error
        $('#personaemergencia-idvinculopersonaemergencia').css('border', 'none');
        $('.field-personaemergencia-idvinculopersonaemergencia').removeClass('has-error');
        $('.field-personaemergencia-idvinculopersonaemergencia').addClass('has-success');
        siguiente = true; //Y si setea la variabnle en true
    } else {
        //Si esta vacio se agrega un borde rojo para indicar que hay un error
        $('#personaemergencia-idvinculopersonaemergencia').css('border', '1px solid #a94442');
        $('.field-personaemergencia-idvinculopersonaemergencia').removeClass('has-success');
        $('.field-personaemergencia-idvinculopersonaemergencia').addClass('has-error');
        siguiente = false; //Y se setea la variable en false
    }
    return siguiente;
}
//Control telefono de emergencia
function controlTelefono() {
    var telPersona = $('#persona-telefonopersona').val(); //Valor del telefono personal
    var telPersonaEmergencia = $('#personaemergencia-telefonopersonaemergencia').val(); //Valor telefono de emergencia
    var siguiente = false;
    if (telPersonaEmergencia == "") {
        $('#personaemergencia-telefonopersonaemergencia').css('border', '1px solid #a94442');
        $('#telefonoContactoEmergenciaLabel').css('color', '#a94442'); //Color rojo al label por que hay un error
        siguiente = false; //Y seteo la variable en false
    } else {
        if (telPersona == telPersonaEmergencia) {
            //Si los telefonos son iguales muestro un mensaje de error
            if ($('#msjTelefonoIgual').children().length < 1) {
                $("#msjTelefonoIgual").append("<small style='color:#a94442'>El contacto de emergencia debe ser distinto a su numero</small>");
                $('#personaemergencia-telefonopersonaemergencia').css('border', '1px solid #a94442');
                $('#telefonoContactoEmergenciaLabel').css('color', '#a94442'); //Color rojo al label por que hay un error
                siguiente = false; //Y seteo la variable en false
            }
        } else {
            //Si son distintos borro el mensaje
            $("#msjTelefonoIgual").empty();
            $('#personaemergencia-telefonopersonaemergencia').css('border', 'none');
            $('#telefonoContactoEmergenciaLabel').css('color', '#3c763d'); //Color verde por que esta correcto
            siguiente = true; //Y seteo la variable en true
        }
    }
    return siguiente;
}