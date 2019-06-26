//Funcion para mostrar/ocultar informacion de capitan
function controlSwichtCapitan() {
    var valorCheckBox = $('input[name="swichtCapitan"]:checked').val(); //Valor del checkbox capitan
    var noCapitan = $('#opcionesNoSoyCapitan'); //Div de las opciones que no son para capitan
    var siCapitan = $('#opcionesCapitan'); //Div de las opciones de capitan

    //Si el checkbox es uno muestra las opciones de capitan
    if (valorCheckBox == 1) {
        noCapitan.hide(); //Oculto las opcion que no son para capitan
        siCapitan.show(); //Muestro las opciones de capitan
    } else {
        //Si el checkbox es cero muestra las opciones que no son de capitan
        noCapitan.show(); //Muestro las opcion que no son para capitan
        siCapitan.hide(); //Oculto las opciones de capitan
    }
}
//Limpio todos los campo si hay un cambio en el swicht
$('input[name="swichtCapitan"]').change(function() {
    $('#idTipocarrera').val(null).trigger("change"); //Limpira el campo de tipo carrera
    $('#idParametrosCantPersonas').val(null).trigger("change"); //Limpia el campo de la seleccion de la cantidad de corredores del equipo
    $('#idEquipo').val(null).trigger("change"); //Limpia el campo donde se ingresa el dni de capitan
    $('#idTipoDeCarrera').val(null).trigger("change"); //Limpia el campo donse se muestra el tipo de carrera
    $('#idCantidadPersonas').val(null).trigger("change"); //Limpia el campo donde se muesta la cantidad de corredores del equipo
    //$('#idNombreEquipo').val(null).trigger("change"); Descomentar en caso de que haya nombre de equipo. Limpia el campo nombre de equipo
    $('#idNombreCapitan').val(null).trigger("change"); //Limpia el campo donde se muesta el nombre de capitan
})