window.onscroll = function() {myFunction()};

var header = document.getElementById("bardasHeader");

var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}

$("#reveal-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");

  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }

});
