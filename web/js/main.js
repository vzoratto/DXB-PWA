var header = document.getElementById("bardasHeader");

if (document.body.contains(header)) {

  var sticky = header.offsetTop;

  if (document.body.contains(document.getElementById("not-full"))) {
    window.onscroll = function() {
      menuColor();
    }
  } else {
    header.classList.add("sticky");
  };

}

function menuColor() {
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
