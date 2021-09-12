const mix = require("laravel-mix");
// require("dotenv").config();

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

const glob = require("glob");

/*
 |--------------------------------------------------------------------------
 | Vendor assets
 |--------------------------------------------------------------------------
 */

function mixAssetsDir(query, cb) {
  (glob.sync("resources/" + query) || []).forEach(f => {
    f = f.replace(/[\\\/]+/g, "/");
    cb(f, f.replace("resources", "public"));
  });
}

const sassOptions = {
  precision: 5
};

// plugins Core stylesheets
mixAssetsDir("sass/plugins/**/!(_)*.scss", (src, dest) =>
  mix.sass(
    src,
    dest.replace(/(\\|\/)sass(\\|\/)/, "$1css$2").replace(/\.scss$/, ".css"),
    { sassOptions: sassOptions }
  )
);

// themes Core stylesheets
mixAssetsDir("sass/themes/**/!(_)*.scss", (src, dest) =>
  mix.sass(
    src,
    dest.replace(/(\\|\/)sass(\\|\/)/, "$1css$2").replace(/\.scss$/, ".css"),
    { sassOptions: sassOptions }
  )
);

// pages Core stylesheets
mixAssetsDir("sass/pages/**/!(_)*.scss", (src, dest) =>
  mix.sass(
    src,
    dest.replace(/(\\|\/)sass(\\|\/)/, "$1css$2").replace(/\.scss$/, ".css"),
    { sassOptions: sassOptions }
  )
);

// Core stylesheets
mixAssetsDir("sass/core/**/!(_)*.scss", (src, dest) =>
  mix.sass(
    src,
    dest.replace(/(\\|\/)sass(\\|\/)/, "$1css$2").replace(/\.scss$/, ".css"),
    { sassOptions: sassOptions }
  )
);

// script js
mixAssetsDir("js/scripts/**/*.js", (src, dest) => mix.scripts(src, dest));

/*
 |--------------------------------------------------------------------------
 | Application assets
 |--------------------------------------------------------------------------
 */

mixAssetsDir("vendors/js/**/*.js", (src, dest) => mix.scripts(src, dest));
mixAssetsDir("vendors/css/**/*.css", (src, dest) => mix.copy(src, dest));
mixAssetsDir("vendors/css/editors/quill/fonts/", (src, dest) =>
  mix.copy(src, dest)
);
mix.copyDirectory("resources/images", "public/images");
mix.copyDirectory("resources/fonts", "public/fonts");

mix
  .js("resources/js/core/app-menu.js", "public/js/core")
  .js("resources/js/core/app.js", "public/js/core")
  .js("resources/js/app.js", "public/js").vue()
  .sass("resources/sass/colors.scss", "public/css")
  .sass("resources/sass/components.scss", "public/css")
  .sass("resources/sass/bootstrap.scss", "public/css")
  .sass("resources/sass/bootstrap-extended.scss", "public/css")
  .sass("resources/sass/custom-laravel.scss", "public/css");

// mix.copy('resources/vendors/css/vendors.min.css', 'public/vendors/css/vendors.min.css')
//   .sass("resources/sass/bootstrap.scss", "public/css")
//   .sass("resources/sass/bootstrap-extended.scss", "public/css")
//   .sass("resources/sass/colors.scss", "public/css")
//   .sass("resources/sass/components.scss", "public/css")
//   .sass("resources/sass/custom-laravel.scss", "public/css")
//   .sass('resources/sass/pages/authentication.scss', 'public/css/pages/authentication.css')
//   .js('resources/js/app.js', 'public/js').vue();

mix.version();
