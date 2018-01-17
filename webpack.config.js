// webpack.config.js
var Encore = require('@symfony/webpack-encore');

Encore
// the project directory where all compiled assets will be stored
    .setOutputPath('public/build/')

    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')

    // will create public/build/app.js and public/build/app.css
    .addEntry('js/materialize_js', './assets/js/materialize.min.js')
    .addEntry('css/materialize_css', './assets/css/materialize.min.css')
    .addEntry('css/main', './assets/css/main.scss')
    .addEntry('js/sumoselect_js', './node_modules/sumoselect/jquery.sumoselect.js')
    .addEntry('css/sumoselect_css', './node_modules/sumoselect/sumoselect.css')

    // allow sass/scss files to be processed
    .enableSassLoader()

    // allow legacy applications to use $/jQuery as a global variable
    .autoProvidejQuery()

    .enableSourceMaps(!Encore.isProduction())

    // empty the outputPath dir before each build
    .cleanupOutputBeforeBuild()

    // show OS notifications when builds finish/fail
    .enableBuildNotifications()

// create hashed filenames (e.g. app.abc123.css)
// .enableVersioning()
;

// export the final configuration
module.exports = Encore.getWebpackConfig();