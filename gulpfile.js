var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.less([
        'app.less',
        'admin.less'
    ]);

    mix.scripts([
        'vendor/jquery-1.11.3.min.js',
        'vendor/bootstrap-3.3.4.min.js',
        'vendor/bootbox.4.4.0.min.js',
        'bootbox.js',
        'approve-recipe.js',
        'add-ingredients.js'
    ], null, './resources/assets/js');

});
