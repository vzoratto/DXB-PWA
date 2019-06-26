var value = $('#editar').val();
if (value == 0) {
    $(document).ready(function() {
        //Remuevo la clase "next-step" en el primer paso para que no puedan pasar de step sin antes controlar los datos
        $('#stepwizard_step1_next').removeClass('next-step');
        $('#usuario-dniusuario').attr('siguiente', 'false');

        //Si se registra un cambio en cualquier input valido lo ingresado
        //Valido el ingreso cuando hay un cambio en Nombre
        $('#persona-nombrepersona').change(function() {
            controlNombre();
        })

        //Valido el ingreso cuando hay un cambio en Apellido
        $('#persona-apellidopersona').change(function() {
            controlApellido();
        })

        //Valido el ingreso cuando hay un cambio en Fecha de nacimiento
        $('#datepicker').change(function() {
            controlFechaNac();
        })

        //Valido el ingreso cuando hay un cambio en sexo persona
        $('input[name="Persona[sexoPersona]"]').change(function() {
            controlSexo();
        })

        //Valido el ingreso cuando hay un cambio en talle remera
        $('#talleremera-idtalleremera').change(function() {
            controlTalleRemera();
        })

        //Valido el ingreso cuando hay un cambio en nacionalidad persona
        $('#persona-nacionalidadpersona').change(function() {
            controlNacionalidad();
        })

        //Valido el ingreso cuando hay un cambio en las opciones de corredor
        $('#opcionesNoSoyCapitan').change(function() {
            controlCapitanCorredor();
        })

        //Valido el ingreso cuando hay un cambio en las opciones de capitan
        $('#opcionesCapitan').change(function() {
                controlCapitanCorredor();
            })
            //Valido el ingreso cuando hay un cambio en las opciones de dni
        $('#usuario-dniusuario').change(function() {
            controlNumDoc();
        })

        $('#usuario-dniusuario').change(function() {
                controlarExistenciaDni();
            })
            //Valido el ingreso del dni usuario
        $('#usuario-dniusuario').keyup(function() {
            controlarExistenciaDni();
        })
        controlarExistenciaDni();
    })

    //Si se clickea en siguiente controlo los valores ingresados. En caso correcto pasa al siguiente step
    $('#stepwizard_step1_next').click(function() {
        //var checkBox = $('input[name="swichtCapitan"]:checked').val(); //Valor del checkbox capitan
        var validoNombre = controlNombre(); //Valido el nombre
        var validoApellido = controlApellido(); //Valido el apellido
        var validoNacionalidad = controlNacionalidad(); //Valido la nacionalidad
        var validoSexo = controlSexo(); //Valido el sexo
        var validoTalleRemera = controlTalleRemera(); //Valido el talle remera
        var validoFechaNac = controlFechaNac(); //Valido fecha nacimiento
        var validoCapitanCorredor = controlCapitanCorredor(); //Valido el ingreso de las opciones de capitan o corredor
        var validoNumDoc = controlNumDoc(); //Valido el ingreso del numero de docuemento
        var validacionExistenciaDni = $('#usuario-dniusuario').attr('siguiente');
        //Si los campos estan correcto agrego la clase "next-step" para pasar al siguiente step
        if (validoNombre && validoApellido && validoNacionalidad && validoSexo && validoTalleRemera && validoFechaNac && validoCapitanCorredor && validoNumDoc && validacionExistenciaDni == 'true') {
            $('#stepwizard_step1_next').addClass('next-step'); //Agrego la clase
        } else {
            $('#stepwizard_step1_next').removeClass('next-step'); //En caso contrario remuevo la clase
        }
    })

    //Funcion que control el ingreso del nombre la persona
    function controlNombre() {
        var nombrePersona = $('#persona-nombrepersona').val(); //Tomo el valor del input
        var patron = /^[a-z-A-Z\D]+$/; //Patron que debe respetarse
        var cantCaracteresNombre = nombrePersona.length; //Cantidad de caracteres ingresado
        siguiente = false;
        if (patron.test(nombrePersona) && nombrePersona !== '' && cantCaracteresNombre > 1) {
            //Si es corecto el patron y distinto de vacio seteo la variable siguiente siguiente en true
            $('#persona-nombrepersona').css('border', 'none'); //Quito el borde rojo para indicar que ya no hay error
            $('.field-persona-nombrepersona').addClass('has-success');
            $('.field-persona-nombrepersona').removeClass('has-error');
            siguiente = true;
        } else {
            //Si el patron es incorrecto o vacio seteo la variable siguiente en false
            $('#persona-nombrepersona').css('border', '1px solid #a94442'); //Agrego un borde rojo para indicar que hay un error
            $('.field-persona-nombrepersona').addClass('has-error');
            $('.field-persona-nombrepersona').removeClass('has-success');
            siguiente = false;
        }
        return siguiente;
    }
    //Funcion que controla el ingreso del apellido
    function controlApellido() {
        var apellidoPersona = $('#persona-apellidopersona').val(); //Valor del input apellido persona
        var patron = /^[a-z-A-Z\D]+$/; //Patron que debe respetarse
        var cantCaracteresApellido = apellidoPersona.length;
        siguiente = false;
        if (patron.test(apellidoPersona) && apellidoPersona !== '' && cantCaracteresApellido > 1) {
            //Si es corecto el patron y distinto de vacio seteo la variable siguiente en true
            $('#persona-apellidopersona').css('border', 'none'); //Quito el borde rojo para indicar que ya no hay error
            $('.field-persona-apellidopersona').addClass('has-success');
            $('.field-persona-apellidopersona').removeClass('has-error');
            siguiente = true;
        } else {
            //Si el patron es incorrecto o vacio seteo la variable siguiente en false
            $('#persona-apellidopersona').css('border', '1px solid #a94442'); //Agrego un borde rojo para indicar que hay un error
            $('.field-persona-apellidopersona').addClass('has-error');
            $('.field-persona-apellidopersona').removeClass('has-success');
            siguiente = false;
        }
        return siguiente;

    }
    //Funcion que controla la fecha de nacimiento. En este caso solo se controla que no este vacio ya que el widget controla el formato
    function controlFechaNac() {
        var fechaPersona = $('#datepicker').val(); // Valor de la fecha
        siguiente = false;
        if (fechaPersona == "") {
            //Si la fehca de nacimiento esta vacio seteo la variable en false
            $('#datepicker').css('border', '1px solid #a94442'); //Agrego un borde rojo para indicar que hay un error
            $('.field-datepicker').addClass('has-error');
            $('.field-datepicker').removeClass('has-success');
            siguiente = false;
        } else {
            //En caso contrario lo seteo en true
            $('#datepicker').css('border', 'none'); //Quito el borde rojo para indicar que ya no hay error
            $('.field-datepicker').addClass('has-success');
            $('.field-datepicker').removeClass('has-error');
            siguiente = true;
        }
        return siguiente;

    }
    //Funcion que controla la seleccion del sexo
    function controlSexo() {
        var sexoPersona = $('input[name="Persona[sexoPersona]"]:checked').val(); // Valor del checkbox sexo persona
        siguiente = false;
        if (sexoPersona !== undefined) {
            //Si se selecciono un sexo seteo la variable en true
            $('#labelSexoDatoPersonal').css('color', '#3c763d'); //Quito el color rojo para indicar que ya no hay error
            siguiente = true;
        } else {
            //En caso contrario en false
            $('#labelSexoDatoPersonal').css('color', '#a94442'); //Agrego un color rojo para indicar que hay un error
            siguiente = false;
        }
        return siguiente;
    }
    //Funcion que controla la seleccion del talle de la remera
    function controlTalleRemera() {
        var talleRemeraPersona = $('#talleremera-idtalleremera').val(); // Valor del talle de la remera
        siguiente = false;
        if (talleRemeraPersona > 0) {
            //Si se selecciono un talle seteo la variable en true
            $('#talleremera-idtalleremera').css('border', 'none'); //Quito el borde rojo para indicar que ya no hay error
            $('.field-talleremera-idtalleremera').addClass('has-success');
            $('.field-talleremera-idtalleremera').removeClass('has-error');
            siguiente = true;
        } else {
            //En caso contrario lo seteo en false
            $('#talleremera-idtalleremera').css('border', '1px solid #a94442'); //Agrego un borde rojo para indicar que hay un error
            $('.field-talleremera-idtalleremera').addClass('has-error');
            $('.field-talleremera-idtalleremera').removeClass('has-success');
            siguiente = false;
        }
        return siguiente;

    }
    //Funcion que controla el ingreso de la nacionalidad
    function controlNacionalidad() {
        var nacionalidadPersona = $('#persona-nacionalidadpersona').val(); // Valor de la nacionalidad de la persona
        var patron = /^[a-z-A-Z\D]+$/; //Patron que debe respetarse
        siguiente = false;
        if (patron.test(nacionalidadPersona) && nacionalidadPersona !== "") {
            //Si el patron es correcto seteo la varibale en true
            $('#persona-nacionalidadpersona').css('border', 'none'); //Quito el borde rojo para indicar que ya no hay error
            $('.field-persona-nacionalidadpersona').addClass('has-success');
            $('.field-persona-nacionalidadpersona').removeClass('has-error');
            siguiente = true;
        } else {
            //En caso contrario lo seteo en false
            $('#persona-nacionalidadpersona').css('border', '1px solid #a94442'); //Agrego un borde rojo para indicar que hay un error
            $('.field-persona-nacionalidadpersona').addClass('has-error');
            $('.field-persona-nacionalidadpersona').removeClass('has-success');
            siguiente = false;
        }
        return siguiente;
    }

    //Funcion que controla la informacion de capitan o el ingreso de dni capitan
    function controlCapitanCorredor() {
        var valorCheckBox = $('input[name="swichtCapitan"]:checked').val(); //Valor del checkbox capitan
        siguiente = false;
        //Si el checkbox es uno controlo las opciones de capitan
        if (valorCheckBox == 1) {
            tipoCarreraSiguiente = false;
            cantPersonasSiguiente = false;
            siguiente = false;
            var tipoCarrera = $('#idTipocarrera').val(); //Control ingreso tipo carrera
            var cantPersonas = $('#idParametrosCantPersonas').val(); //Control ingreso cantidad de personas
            if (tipoCarrera > 0) {
                $('#idTipocarrera').find('label[class=".select2-container--krajee .select2-selection--single"]').css('border', '0px solid #606060'); //Quito el borde rojo para indicar que ya no hay error
                $('.field-idTipocarrera').addClass('has-success');
                $('.field-idTipocarrera').removeClass('has-error');
                tipoCarreraSiguiente = true;
            } else {
                $('#idTipocarrera').find('label[class=".select2-container--krajee .select2-selection--single"]').css('border', '1px solid #a94442'); //Agrego un borde rojo para indicar que hay un error
                $('.field-idTipocarrera').addClass('has-error');
                $('.field-idTipocarrera').removeClass('has-success');
                tipoCarreraSiguiente = false;
            }
            if (cantPersonas > 0) {
                $('#idParametrosCantPersonas').find('label[class=".select2-container--krajee .select2-selection--single"]').css('border', '0px solid #606060'); //Quito el borde rojo para indicar que ya no hay error
                $('.field-idParametrosCantPersonas').addClass('has-success');
                $('.field-idParametrosCantPersonas').removeClass('has-error');
                cantPersonasSiguiente = true;
            } else {
                $('#idParametrosCantPersonas').find('label[class=".select2-container--krajee .select2-selection--single"]').css('border', '1px solid #a94442'); //Agrego un borde rojo para indicar que hay un error
                $('.field-idParametrosCantPersonas').addClass('has-error');
                $('.field-idParametrosCantPersonas').removeClass('has-success');
                cantPersonasSiguiente = false;
            }
            //Si ambos ingresos son correctos seteo la varibale siguiente en true
            if (tipoCarreraSiguiente && cantPersonasSiguiente) {
                siguiente = true;
            } else {
                siguiente = false;
            }

        } else {
            //Si el checkbox es cero controlo las opciones que no son de capitan
            var dniCapitan = $('#idEquipo').val(); //Control del ingreso del dni capitan -idequipo

            siguiente = false;
            if (dniCapitan > 0) {
                $('.select2-container--krajee .select2-selection--single').css('border', '0px solid #606060'); //Quito el borde rojo para indicar que ya no hay error
                $('.field-idEquipo').addClass('has-success');
                $('.field-idEquipo').removeClass('has-error');
                $('.field-idNombreCapitan').addClass('has-success');
                $('.field-idNombreCapitan').removeClass('has-error');
                $('.field-idTipoDeCarrera').addClass('has-success');
                $('.field-idTipoDeCarrera').removeClass('has-error');
                $('.field-idCantidadPersonas').addClass('has-success');
                $('.field-idCantidadPersonas').removeClass('has-error');
                siguiente = true;
            } else {
                $('.select2-container--krajee .select2-selection--single').css('border', '1px solid #a94442'); //Agrego un borde rojo para indicar que hay un error
                $('.field-idEquipo').addClass('has-error');
                $('.field-idEquipo').removeClass('has-success');
                $('.field-idNombreCapitan').addClass('has-error');
                $('.field-idNombreCapitan').removeClass('has-success');
                $('.field-idTipoDeCarrera').addClass('has-error');
                $('.field-idTipoDeCarrera').removeClass('has-success');
                $('.field-idCantidadPersonas').addClass('has-error');
                $('.field-idCantidadPersonas').removeClass('has-success');
                siguiente = false;
            }
        }
        return siguiente;
    }

    //Funcion que controla el ingreso del dni
    function controlNumDoc() {
        var dniUsuario = $('#usuario-dniusuario').val(); //Valor del input dni
        var patron = /^[0-9]+$/; //Patron que debe respetarse
        var tambienEstaBien = $('#usuario-dniusuario').attr('siguiente');
        siguiente = false;
        if (patron.test(dniUsuario) && dniUsuario !== '' && tambienEstaBien == "true") {
            //Si es corecto el patron y distinto de vacio seteo la variable siguiente en true
            $('#usuario-dniusuario').css('border', 'none'); //Quito el borde rojo para indicar que ya no hay error
            $('.field-usuario-dniusuario').addClass('has-success');
            $('.field-usuario-dniusuario').removeClass('has-error');
            siguiente = true;
        } else {
            //Si el patron es incorrecto o vacio seteo la variable siguiente en false
            $('#usuario-dniusuario').css('border', '1px solid #a94442'); //Agrego un borde rojo para indicar que hay un error
            $('.field-usuario-dniusuario').addClass('has-error');
            $('.field-usuario-dniusuario').removeClass('has-success');
            siguiente = false;
        }
        return siguiente;
    }


    //Esta funcion controla si existe el dni ingresado en la inscripcion
    function controlarExistenciaDni() {
        var dniIngresado = $('#usuario-dniusuario').val();
        if (dniIngresado !== "") {
            var ajax = new XMLHttpRequest();
            //uso del método GET
            ajax.open("GET", "index.php?r=inscripcion/existedni&dniUsuario=" + dniIngresado);

            // --Ahora estamos esperando a recibir la respuesta, para eso tenemos la siguiente función que llamamos cada vez que ocurre que el estado cambia.
            ajax.onreadystatechange = function() {
                    //función anónima a ejecutar cada vez que el estado de la petición cambia. Cuando el estado es 4 se completo

                    if (ajax.readyState == 4) {
                        //mostrar resultado en esta capa
                        dato = ajax.responseText; //transformamos la cadena de texto en un JSON
                        if (dato == 1) {
                            //Si el patron es incorrecto o vacio seteo la variable siguiente en false
                            $('#usuario-dniusuario').css('border', '1px solid #a94442'); //Agrego un borde rojo para indicar que hay un error
                            $('#usuario-dniusuario').attr('siguiente', 'false');

                        } else {
                            //Si es corecto el patron y distinto de vacio seteo la variable siguiente en true
                            $('#usuario-dniusuario').css('border', 'none'); //Quito el borde rojo para indicar que ya no hay error
                            $('#usuario-dniusuario').attr('siguiente', 'true');
                        }

                    }
                }
                // como hacemos uso del método GET colocamos null
                // Con Post en lugar de null debería mandarle la cadena de los parámetros y sus valores serian "Provincia"= +provincia
            ajax.send(null);
        }
    }


}