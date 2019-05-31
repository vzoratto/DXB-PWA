function myFunction() {
    // Get the checkbox
    var checkBox = document.getElementById("myonoffswitch");
    // Get the output text
    var text = document.getElementById("opcionesCapitan");

    var dniCapitan = document.getElementById("console-event");

    // If the checkbox is checked, display the output text
    if (checkBox.checked == true) {
        text.style.display = "block";
        dniCapitan.style.display = "none";
        dniCapitan.setAttribute("required");
    } else {
        text.style.display = "none";
        dniCapitan.style.display = "block";
    }
}