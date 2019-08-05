$(document).ready(function(){

    $( 'input[name="1"]:radio' ).change(function () {
        //console.log('click pregunta 1');
        //alert(this.value);
        //si en la primera pregunta selecciona "SI"
        if(this.value==2){
            //console.log('toco 2');
            var input1='<br id="salto1"> <label class="label1" id="label1">Cual</label><input style="width: 50%" id="justificacion1" type="text" class="justificacion1 form-control input-sm" name="justificacion1">';
            //si selecciona SI se agrega el input para que justifique su respuesta
            var pregunta1=$('div[name="1"]').append(input1);
        }else if(this.value==1){
            $("#justificacion1").remove();
            $("#label1").remove();
            $("#salto1").remove();
        }




    });
    $( 'input[name="3"]:radio' ).change(function () {
        //console.log('click pregunta 3');
        //alert(this.value);
        //si en la primera pregunta selecciona "SI"
        //el valor 6 es SI
        if(this.value==6){
            console.log('toco 2');
            var input3='<br id="salto3"> <label class="label3" id="label3">Cual</label><input style="width: 50%" id="justificacion3" type="text" class="justificacion3 form-control input-sm" name="justificacion3">';
            //si selecciona SI se agrega el input para que justifique su respuesta
            var pregunta3=$('div[name="3"]').append(input3);
        //el valor 5 es NO
        }else if(this.value==5){
            $("#justificacion3").remove();
            $("#label3").remove();
            $("#salto3").remove();
        }




    });

    $( 'input[name="5"]:radio' ).change(function () {
        //console.log('click pregunta 5');
        //alert(this.value);
        //si en la primera pregunta selecciona "SI"
        //el valor 10 es SI
        if(this.value==10){
            //console.log('toco 2');
            var input5='<br id="salto5"> <label class="label5" id="label5">Cual</label><input style="width: 50%" id="justificacion5" type="text" class="justificacion5 form-control input-sm" name="justificacion5">';
            //si selecciona SI se agrega el input para que justifique su respuesta
            var pregunta5=$('div[name="5"]').append(input5);
            //el valor 9 es NO
        }else if(this.value==9){
            $("#justificacion5").remove();
            $("#label5").remove();
            $("#salto5").remove();
        }




    });


   // var input3='<br> <label>Cual</label><input type="text" class="form-control" name="justificacion3">';
    //var input5='<br> <label>Cual</label><input type="text" class="form-control" name="justificacion5">';
    //$('#respuesta-respvalor').append(input);


    //var pregunta3=$('div[name="3"]').append(input3);
    //var pregunta5=$('div[name="5"]').append(input5);




   // console.log(input);


});