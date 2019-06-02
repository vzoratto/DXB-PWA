
// Spanish

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
    formatSubmit: 'yyyy/mm/dd'
});


var input_date=$('#datepicker').pickadate({
    selectYears: 70,
    selectMonths: true,
    weekdaysFull: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],

    min: new Date(1920,3,20),
    max: new Date(2007,1,1),


});