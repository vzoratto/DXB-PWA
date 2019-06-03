function myFunction() {
    // Get the checkbox
    //var checkBox = document.getElementById("swichtCapitan");
    var radioInput = $('input:radio[name=multifeatured_module]:checked').val();
    // Get the output text
    var text = document.getElementById("opcionesNoSoyCapitan");

    var cap = document.getElementById("opcionesCapitan");


    // If the checkbox is checked, display the output text
    if (radioInput == 1) {
        text.style.display = "none";
        cap.style.display = "block";
        $('#idEquipo').val(null).trigger("change");
        $('#idTipoDeCarrera').val(null).trigger("change");
        $('#idCantidadPersonas').val(null).trigger("change");
        $('#idNombreEquipo').val(null).trigger("change");
        $('#idNombreCapitan').val(null).trigger("change");

    } else {
        text.style.display = "block";
        cap.style.display = "none";
        $('#idTipocarrera').val(null).trigger("change");
        $('#idParametrosCantPersonas').val(null).trigger("change");
    }
}