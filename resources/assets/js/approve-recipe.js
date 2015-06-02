/**
 * Approve one recipe
 */

// Define approveRecipe plugin
(function( $ ) {
    $.fn.approveRecipe = function() {

        this.click(function(event){
            event.preventDefault();

            // Set loading icon
            $(this).find('a').replaceWith('<span class="glyphicon glyphicon-refresh glyphicon-refresh-animate" id="loading"></span>');

            var recipeId = $(this).attr('id');
            var csrfToken = $('input[name=_token]').val();

            $.post(
                "/admin/recipes/approve",
                {id: recipeId, '_token': csrfToken},
                function(data){
                    if (data === 'approved') {
                        // Replace loading icon with checkmark
                        $('#loading').replaceWith('<a href="#" title="Unapprove"><span class="glyphicon glyphicon-ok"></span></a>');
                    } else {
                        // Replace loading icon with checkbox
                        $('#loading').replaceWith('<a href="#" title="Approve"><span class="glyphicon glyphicon-unchecked"></span></a>');
                    }
                }
            );
        });

        // Return 'this' so that the plugin can be chained
        return this;

    };

}( jQuery ));

// Implement
$( ".approve-recipe").approveRecipe();