const elixir = require('laravel-elixir');


require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {

    // Framework directory
    var medusaDir = 'vendor/pbbg/medusa/src/resources/';

    // NPM
    var npmFolder = 'node_modules/';

    // Javascript folder in the framework directory
    var jsFolder = medusaDir + 'assets/js/';

    elixir.config.assetsPath = '';
    elixir.config.js.folder = '';
    elixir.config.css.sass.folder = '';
    
    // Frontend
    mix.sass(medusaDir + 'assets/sass/app.scss', 'public/css');

    // Admin
    mix.sass(medusaDir + 'assets/sass/admin/admin.scss', 'public/css');

    // Mix generic vendor
    mix.scripts([
            npmFolder + 'jquery/dist/jquery.min.js',
            // npmFolder + 'jquery-migrate/dist/jquery-migrate.min.js',
            npmFolder + 'bootstrap-sass/assets/javascripts/bootstrap.min.js',
            npmFolder + '@sergiovilar/jquery-pjax/jquery.pjax.js'
        ], 'public/js/vendor.js');

    // Mix the front application
    mix.scripts([
            jsFolder + 'app.js'
        ], 'public/js/app.js');

    // Mix the admin application
    mix.scripts([
            jsFolder + 'admin.js'
        ], 'public/js/admin.js');

    mix.copy(
        npmFolder + 'font-awesome/fonts',
        'public/build/fonts/'
    );

    // Version everything
    mix.version([
        'css/app.css',
        'css/admin.css',
        'js/vendor.js',
        'js/app.js',
        'js/admin.js'
    ]);

});
