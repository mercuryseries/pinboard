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

    mix.copy(paths.bootstrap + 'stylesheets/', 'resources/assets/sass')
    	 .copy(paths.bower_base_path + '/sweetalert/dist/sweetalert.css', 'resources/assets/css/vendor/sweetalert.css'
        )
    	 .copy(paths.bower_base_path + '/sweetalert/dist/sweetalert.min.js', 'resources/assets/js/vendor/sweetalert.min.js'
        )
			 .copy(paths.bootstrap + 'fonts/bootstrap', 'public/build/fonts/bootstrap')
			 .copy(paths.bootstrap + 'javascripts/bootstrap.js', 'resources/assets/js/vendor/bootstrap.js')
			 .copy(paths.bower_base_path + 'jquery/dist/jquery.min.js', 'resources/assets/js/vendor/jquery.min.js')
			 .copy(paths.bower_base_path + 'jquery-masonry/dist/masonry.pkgd.js', 'resources/assets/js/vendor/jquery.masonry.js')
			 .copy(paths.bower_base_path + 'imagesloaded/imagesloaded.pkgd.js', 'resources/assets/js/vendor/imagesloaded.pkgd.js');

		mix.sass('app.scss', "resources/assets/css");

		mix.styles([
    	'vendor/masonry.css',
    	'vendor/sweetalert.css',
    	'app.css',
    ]);

		mix.scripts([
			'vendor/jquery.min.js',
			'vendor/bootstrap.js',
			'vendor/imagesloaded.pkgd.js',
			'vendor/jquery.masonry.js',
			'vendor/sweetalert.min.js',
			'larails.js',
			'app.js'
		]);

		mix.version(["css/all.css", "js/all.js"]);

});
