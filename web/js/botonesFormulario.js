$(function() {
    var $tabs = $('#tabs').tabs();

    $(".ui-tabs-panel").each(function(i) {

        var totalSize = $(".ui-tabs-panel").length - 1;

        if (i != totalSize) {
            next = i + 2;
            $(this).append("<a href='#w2-tabs" + next + "' class='next-tab mover' rel='" + next + "'>Next Page &#187;</a>");


        }

        if (i != 0) {
            prev = i;
            $(this).append("<a href='#w2-tabs" + i + "' class='prev-tab mover' rel='" + prev + "'>&#171; Prev Page</a>");

        }

    });

    $('.next-tab, .prev-tab').click(function() {
        $tabs.tabs('select', $(this).attr("rel"));
        $('#w2-tab' + next).setAttribute('aria-hidden', false);
        $('#w2-tab' + next).removeAttribute('style');

        return false;
    });


});