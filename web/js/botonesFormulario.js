$(function() {
    var $tabs = $('.my-class').tabs();

    $(".tabs-container").each(function(i) {

        var totalSize = $(".tabs-container").length - 1;

        if (i != totalSize) {
            next = i + 2;
            $(this).append("<a href='#' class='next-tab mover' rel='ui-id-" + next + "'>Continue &#187;</a>");
        }
        if (i != 0) {
            prev = i;
            $(this).append("<a href='#' class='prev-tab mover' rel='" + prev + "'>&#171; Back</a>");

        }
    });
    $('.next-tab, .prev-tab').click(function() {
        $tabs.tabs('change', $(this).attr("rel"));

        return false;
    });
});