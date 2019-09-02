
// Spanish
var editar=$('#editar').val();


$.extend($.fn.pickadate.defaults, {
    monthsFull: [ 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre' ],
    monthsShort: [ 'ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic' ],
    weekdaysFull: [ 'Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado' ],
    weekdaysShort: [ 'dom', 'lun', 'mar', 'mié', 'jue', 'vie', 'sáb' ],
    today: 'Hoy',
    clear: 'Borrar',
    close: 'Cerrar',
    firstDay: 1,
    format: 'dddd d !de mmmm !de yyyy',
    formatSubmit: 'yyyy-mm-dd'
});


var input_date=$('#datepicker').pickadate({
    selectYears: 70,
    selectMonths: true,
    weekdaysFull: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],

    min: new Date(1920,3,20),
    max: new Date(2017,1,1),


});
//si el usuario esta editando sus datos la fechadeNac ya deberia aparecer en el formulario
if(editar==1){
    var fechaNac=$("input[name='Persona[fechaNacPersona]']").val();

    var newDate = fechaNac.split('-').join(',');

    var date_picker=input_date.pickadate('picker');

    date_picker.set('select', new Date(newDate))
}