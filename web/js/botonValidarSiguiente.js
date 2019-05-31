  $(document).ready(function() {
    //Siempre que salgamos de un campo de texto, se chequeará esta función
    $(".persona-form input").keyup(function() {
      var form = $(this).parents("#w0");
      var check = checkCampos(form);
      console.log(check);
      if(check) {
        $("#stepwizard_step1_next").prop("disabled", false);
      }
      else {
        $("#stepwizard_step1_next").prop("disabled", true);
      }
    });
  });
    
  //Función para comprobar los campos de texto
  function checkCampos(obj) {
    var camposRellenados = true;
    obj.find("input").each(function() {
      var $this = $(this);
        if( $this.val().length <= 0 ) {
          camposRellenados = false;
          return false;
        }
    });
    if(camposRellenados == false) {
      return false;
    }
    else {
      return true;
    }
  }