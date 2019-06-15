// Setea la fecha que empieza a contar
var countDownDate = new Date("Sep 5, 2019 15:37:25").getTime();

// Actualiza la cuenta regresiva cada 1 segundo
var x = setInterval(function() {

  // Obtiene la fecha de hoy
  var now = new Date().getTime();
    
  // Encuentra la distancia entre la fecha elegida con la de hoy
  var distance = countDownDate - now;
    
  // Calculadora de tiempo para los días, horas, minutos y segundos
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Muestra los resultados del id="demo"
  document.getElementById("demo").innerHTML = days + " : " + hours + " : "
  + minutes + " " ;
  // + seconds + " ";
    
  // Si la cuenta regresiva llega a 0, muestra un mensaje
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "TIEMPO FINALIZADO";
  }
}, 1000);


