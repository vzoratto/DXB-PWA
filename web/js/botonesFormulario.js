$(function() {
    var $tabs = $('.my-class').tabs();

    $(".tabs-container").each(function(i) {

        var totalSize = $(".tabs-container").length - 1;

        if (i != totalSize) {
            next = i + 2;
            $(this).append($('#botones-atras-siguiente'),"<a href='#' class='next-tab mover btn btn-info pull-right' rel='" + next + "' role='button'>Siguiente</a>");
        }
        if (i != 0) {
            prev = i;
            $(this).append($('#botones-atras-siguiente'),"<a href='#' class='prev-tab mover btn btn-info pull-left' rel='" + prev + "' role='button'>Volver</a>");

        }
    });
    $('.next-tab, .prev-tab').click(function() {
        $tabs.tabs('select', $(this).attr("rel"));

        return false;
    });
});