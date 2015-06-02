/**
 * Bulk-approve recipes
 * NOTE: as of 5/19/15 this is not being used - kept only in case we want to implement bulk actions later
 */

// Define approveRecipes plugin
(function( $ ) {
    $.fn.approveRecipes = function() {
        this.submit(function(event){
            event.preventDefault();

            var recipeIds = [];
            var csrfToken = $('input[name=_token]').val();

            // Get all the checked recipes
            $("input[name=approve]:checked").each(function(){
                recipeIds.push($(this).val());
            });

            $.post(
                "/admin/recipes/approve",
                {ids: recipeIds, '_token': csrfToken},
                function(data){
                    if (data === 'true') {
                        // Replace checkboxes with checkmark
                        $('<span class="glyphicon glyphicon-ok"></span>').replaceAll("input[name=approve]:checked");
                    }
                }
            );
        });

        // Return 'this' so that the plugin can be chained
        return this;

    };

}( jQuery ));

// Implement
$( "#approve-recipes").approveRecipes();