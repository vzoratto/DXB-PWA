$(document).ready(function() {
    //Remuevo la clase "next-step" en el primer paso para que no puedan pasar de step sin antes controlar los datos
    $('#stepwizard_step3_next').removeClass('next-step');

    //Valido el ingreso cuando hay un cambio en obra social
    $('#fichamedica-obrasocial').change(function() {
        controlObraSocial();
    })

    //Valido el ingreso cuando hay un cambio en peso
    $('#fichamedica-peso').change(function() {
        controlPeso();
    })

    //Valido el ingreso cuando hay un cambio en altura
    $('#fichamedica-altura').change(function() {
        controlAltura();
    })

    //Valido el ingreso cuando hay un cambio en frecuencia cardiaca
    $('#fichamedica-frecuenciacardiaca').change(function() {
        controlFrecuenciaCardiaca();
    })

    //Valido el ingreso cuando hay un cambio en sangre
    $('#fichamedica-idgruposanguineo').change(function() {
        controlSangre();
    })

    //Valido el ingreso cuando hay un cambio en Donador
    $('input[name="Persona[donador]"]').change(function() {
        controlDonador();
    })

    //Valido el ingreso cuando hay un cambio en evaluacion ficha medica
    $('input[name="Fichamedica[evaluacionMedica]"]').change(function() {
        controlEvalFichaMedica();
    })

    //Valido el ingreso cuando hay un cambio en intervencion quirurgica
    $('input[name="Fichamedica[intervencionQuirurgica]"]').change(function() {
        controlInterQuirurgica();
    })

    //Valido el ingreso cuando hay un cambio en toma suplemtos
    $('input[name="Fichamedica[suplementos]"]').change(function() {
        controlTomaSuplementos();
    })

    //Valido el ingreso cuando hay un cambio en toma medicamentos
    $('input[name="Fichamedica[tomaMedicamentos]"]').change(function() {
        controlTomaMedicamento();
    })
})

//Se ejecuta cada vez que hago click en el boton "siguiente" del tercer step
$('#stepwizard_step3_next').click(function() {
    var validoObraSocial = controlObraSocial(); //Valido obra social
    var validoPeso = controlPeso(); //Valido peso
    var validoAltura = controlAltura(); //Valido altura
    var validoFrecuenciaCardiaca = controlFrecuenciaCardiaca(); //Valido frecuencia cardiaca
    var validoTipoSangre = controlSangre(); //Valido tipo de sangre
    var validoDonador = controlDonador(); //Valido donador
    var validoFicaMedica = controlEvalFichaMedica(); //Valido ficha medica
    var validoIntQui = controlInterQuirurgica(); //Valido intervencion quirurgica
    var validoSuplemento = controlTomaSuplementos(); //Valido suplemtentos
    var validpMedicamentos = controlTomaMedicamento(); //Valido toma medicamentos

    //Si los campos estan correcto agrego la clase "next-step" para pasar al siguiente step
    if (validoAltura && validoDonador && validoFicaMedica && validoFrecuenciaCardiaca && validoIntQui && validoObraSocial && validoPeso && validoSuplemento && validoTipoSangre && validpMedicamentos) {
        $('#stepwizard_step3_next').addClass('next-step'); //Agrego la clase
    } else {
        $('#stepwizard_step3_next').removeClass('next-step'); //En caso contrario remuevo la clase
    }
})


//Funcion que controla el dato de la obra social
function controlObraSocial() {
    var obraSocfichaMed = $('#fichamedica-obrasocial').val(); //Valor de la obra social
    var patron = /^[a-zA-Z0-9\s]+$/; //Patron alfanumerico a respetar
    var siguiente = false;
    if (patron.test(obraSocfichaMed) && obraSocfichaMed !== '') {
        //Si el valor es distinto a vacio y se respeta el patron se borra el borde para mostrar que no hay error
        $('#fichamedica-obrasocial').css('border', 'none');
        siguiente = true; //Y se setea en true la variable
    } else {
        //En caso contrario se agrega un borde rojo para indicar que hay un error
        $('#fichamedica-obrasocial').css('border', '1px solid #a94442');
        siguiente = false; //Y se setea la variable en false
    }
    return siguiente;
}
//Funcion que controla el dato del peso
function controlPeso() {
    var pesofichaMed = $('#fichamedica-peso').val(); //Valor de la ficha medica
    var patron = /^\s*[-+]?[0-9]*[.,]?[0-9]+([eE][-+]?[0-9]+)?\s*$/; //Patron a respetar
    var siguiente = false;
    if (patron.test(pesofichaMed) && pesofichaMed !== '') {
        //Si el valor es distinto a vacio y se respeta el patron se borra el borde para mostrar que no hay error
        $('#fichamedica-peso').css('border', 'none');
        siguiente = true; //Y se setea en true la variable
    } else {
        $('#fichamedica-peso').css('border', '1px solid #a94442');
        siguiente = false; //Y se setea la variable en false
    }
    return siguiente
}
//Funcion que controla el dato de la altura
function controlAltura() {
    var alturafichaMed = $('#fichamedica-altura').val(); //Valor altura
    var patron = /^\s*[-+]?[0-9]*[.,]?[0-9]+([eE][-+]?[0-9]+)?\s*$/; //Patron a respetar
    var siguiente = false;
    if (patron.test(alturafichaMed) && alturafichaMed !== '') {
        //Si el valor es distinto a vacio y se respeta el patron se borra el borde para mostrar que no hay error
        $('#fichamedica-altura').css('border', 'none');
        siguiente = true; //Y se setea en true la variable
    } else {
        $('#fichamedica-altura').css('border', '1px solid #a94442');
        siguiente = false; //Y se setea la variable en false
    }
    return siguiente;
}
//Funcion que controla el dato de la frecuencia cardiaca
function controlFrecuenciaCardiaca() {
    var frecfichaMed = $('#fichamedica-frecuenciacardiaca').val(); //Valor frecuencia cardiaca
    var patron = /^[0-9]*$/; //Patron a respetar
    var siguiente = false;
    if (patron.test(frecfichaMed) && frecfichaMed !== '') {
        //Si el valor es distinto a vacio y se respeta el patron se borra el borde para mostrar que no hay error
        $('#fichamedica-frecuenciacardiaca').css('border', 'none');
        siguiente = true; //Y se setea en true la variable
    } else {
        $('#fichamedica-frecuenciacardiaca').css('border', '1px solid #a94442');
        siguiente = false; //Y se setea la variable en false
    }
    return siguiente;
}
//Funcion que controla si se selecciono un tipo de sangre
function controlSangre() {
    var tipoSangrefichaMed = $('#fichamedica-idgruposanguineo').val(); //Valor grupo sanguinieo
    var siguiente = false;
    if (tipoSangrefichaMed > 0) {
        //Si el valor es distinto a vacio y se respeta el patron se borra el borde para mostrar que no hay error
        $('#fichamedica-idgruposanguineo').css('border', 'none');
        siguiente = true; //Y se setea en true la variable
    } else {
        $('#fichamedica-idgruposanguineo').css('border', '1px solid #a94442');
        siguiente = false; //Y se setea la variable en false
    }
    return siguiente;
}
//Funcion que controla si se selecciono una opcion de donador sangre
function controlDonador() {
    var donadorfichaMed = $('input[name="Persona[donador]"]:checked').val() //Valor checkbox donador
    var siguiente = false;
    if (donadorfichaMed !== undefined) {
        //Si se selecciono un sexo seteo la variable en true
        $('.field-persona-donador .control-label').css('color', '#606060'); //Quito el borde rojo para indicar que ya no hay error
        siguiente = true;
    } else {
        //En caso contrario en false
        $('.field-persona-donador .control-label').css('color', '#a94442'); //Agrego un borde rojo para indicar que hay un error
        siguiente = false;
    }
    return siguiente;
}
//Controla si se selecciono una opcion en ficha medica
function controlEvalFichaMedica() {
    var evalmedifichaMed = $('input[name="Fichamedica[evaluacionMedica]"]:checked').val() //Valor checkbox evaluacion medica
    var siguiente = false;
    if (evalmedifichaMed !== undefined) {
        $('.field-fichamedica-evaluacionmedica .control-label').css('color', '#606060'); //Quito el borde rojo para indicar que ya no hay error
        siguiente = true;
    } else {
        $('.field-fichamedica-evaluacionmedica .control-label').css('color', '#a94442'); //Agrego un borde rojo para indicar que hay un error
        siguiente = false;
    }
    return siguiente;
}
//Controla si se selecciono una opcion en intervencion quirurgica
function controlInterQuirurgica() {
    var intquirfichaMed = $('input[name="Fichamedica[intervencionQuirurgica]"]:checked').val() //Valor intervencion quirurjica
    var siguiente = false;
    if (intquirfichaMed !== undefined) {
        $('.field-fichamedica-intervencionquirurgica .control-label').css('color', '#606060'); //Quito el borde rojo para indicar que ya no hay error
        siguiente = true;
    } else {
        $('.field-fichamedica-intervencionquirurgica .control-label').css('color', '#a94442'); //Agrego un borde rojo para indicar que hay un error
        siguiente = false;
    }
    return siguiente;
}
//Controla si se selecciono una opcion en toma suplemtentos
function controlTomaSuplementos() {
    var suplementosfichaMed = $('input[name="Fichamedica[suplementos]"]:checked').val() //Valor checkbox suplementos
    var siguiente = false;
    if (suplementosfichaMed !== undefined) {
        $('.field-fichamedica-suplementos .control-label').css('color', '#606060'); //Quito el borde rojo para indicar que ya no hay error
        siguiente = true;
    } else {
        $('.field-fichamedica-suplementos .control-label').css('color', '#a94442'); //Agrego un borde rojo para indicar que hay un error
        siguiente = false;
    }
    return siguiente;
}
//Controla si se selecicono una opcion en toma medicamentos
function controlTomaMedicamento() {
    var medicamentosfichaMed = $('input[name="Fichamedica[tomaMedicamentos]"]:checked').val() //Valor checkbox medicamentos
    var siguiente = false;
    if (medicamentosfichaMed !== undefined) {
        $('.field-fichamedica-tomamedicamentos .control-label').css('color', '#606060'); //Quito el borde rojo para indicar que ya no hay error
        siguiente = true;
    } else {
        $('.field-fichamedica-tomamedicamentos .control-label').css('color', '#a94442'); //Agrego un borde rojo para indicar que hay un error
        siguiente = false
    }
    return siguiente;
}