/**
 * Bootbox implementation
 */
$(".bootbox-confirm").click(function(e) {
    e.preventDefault();

    var form = $( e.target).closest("form");
    var confirmMessage = form.attr('data-bootbox-message') || 'Are you sure?';

    bootbox.confirm(confirmMessage, function(confirmed) {
        if (confirmed) {
            form.submit();
        }
    });
});