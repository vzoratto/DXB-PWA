//Funcion para mostrar/ocultar informacion de capitan
function myFunction() {
    var checkBox = $('input[name="swichtCapitan"]:checked').val(); //Valor del checkbox capitan
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