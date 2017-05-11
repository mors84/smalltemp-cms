const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    // Admin files
    .copyDirectory('resources/assets/fonts/', 'public/fonts/')
    .copyDirectory('resources/assets/images/', 'public/images/')
    .copy('resources/assets/vendors/admin/css/chosen/', 'public/css/admin/chosen/')
    .copy('resources/assets/sass/admin/patterns/', 'public/css/admin/patterns/')
    .sass('resources/assets/sass/admin/app.scss', 'public/css/admin/app.css')
    .combine([
        'resources/assets/vendors/admin/css/bootstrap.css',
        'resources/assets/vendors/admin/css/font-awesome.css',
        'resources/assets/vendors/admin/css/animate.css',
        'resources/assets/vendors/admin/css/bootstrap-chosen.css',
        'resources/assets/vendors/admin/css/summernote.css',
        'resources/assets/vendors/admin/css/summernote-bs3.css',
        'resources/assets/vendors/admin/css/toastr.min.css',
    ], 'public/css/admin/vendors.css')
    .combine([
        'resources/assets/js/admin/main.js',
        'resources/assets/js/admin/ajax.js',
        'resources/assets/js/admin/passwordMeter.js',
        'resources/assets/js/admin/summernote.js',
    ], 'public/js/admin/app.js')
    .combine([
        'resources/assets/vendors/admin/js/jquery-3.1.1.min.js',
        'resources/assets/vendors/admin/js/bootstrap.min.js',
        'resources/assets/vendors/admin/js/jquery.metisMenu.js',
        'resources/assets/vendors/admin/js/jquery.slimscroll.min.js',
        'resources/assets/vendors/admin/js/inspinia.js',
        'resources/assets/vendors/admin/js/pace.min.js',
        'resources/assets/vendors/admin/js/chosen.jquery.js',
        'resources/assets/vendors/admin/js/summernote.min.js',
        'resources/assets/vendors/admin/js/toastr.min.js',
        'resources/assets/vendors/admin/js/pwstrength-bootstrap.min.js',
        'resources/assets/vendors/admin/js/zxcvbn.js',
    ], 'public/js/admin/vendors.js')

    .disableNotifications();
