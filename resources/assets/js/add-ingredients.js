// Define addIngredients plugin
(function( $ ) {
    $.fn.addIngredients = function() {
        this.click(function(event){
            event.preventDefault();

            var html =
                '<div class="form-group ingredient">\
                    <input class="form-control" name="ingredients[]" type="text">\
                </div>';

            $(".ingredient:last").after(html);
        });

        // Return 'this' so that the plugin can be chained
        return this;

    };

}( jQuery ));

// Implement
$( "#add-ingredient").addIngredients();