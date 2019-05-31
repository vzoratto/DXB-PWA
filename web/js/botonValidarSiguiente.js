  var form = $( "#w0" );
  form.validate();
  var boton = document.getElementById('stepwizard_step1_next');

  boton.setAttribute('disabled',false);

  $(".persona-form").on(function(){
    console.log('hola');

  });
  $( "#stepwizard_step1_next" ).click(function() {
    if(form[0].checkValidity() && form[1].checkValidity()){
        boton.setAttribute('disabled',true);

        alert( "Valid: " + form.valid() );
        }
      
  });
  

