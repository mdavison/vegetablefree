/**
 * New Vue instance to display preview of directions
 */
new Vue({
    el: '#markdown-editor',
    data: {
        input: ''
    },
    filters: {
        marked: marked
    }
});


/**
 * Run displayed directions on show-recipes through marked()
 */
var recipeDirections = $("#show-directions").html();
$("#show-directions").html(marked(recipeDirections));