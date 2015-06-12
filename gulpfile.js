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

var paths = {
	'bower_base_path': './vendor/bower_components/',
	'bootstrap': './vendor/bower_components/bootstrap-sass-official/assets/'
};

elixir(function(mix) {
    mix.sass('app.scss');

    mix.copy(paths.bootstrap + 'stylesheets/', 'resources/assets/sass')
			 .copy(paths.bootstrap + 'fonts/bootstrap', 'public/fonts')
			 .copy(paths.bootstrap + 'javascripts/bootstrap.min.js', 'resources/assets/js/vendor/bootstrap.min.js')
			 .copy(paths.bower_base_path + 'jquery/dist/jquery.min.js', 'resources/assets/js/vendor/jquery.min.js');

		mix.scripts([
			'vendor/jquery.min.js',
			'vendor/bootstrap.min.js',
			'app.js'
		]);

});
