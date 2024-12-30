const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
.js("resources/js/back/back.js", "public/back.js")
   .vue({ version: 3 })  
   .postCss('resources/css/app.css', 'public/css', [
       require('postcss-import'),
       require('tailwindcss'),
       require('autoprefixer'),
   ])
   .version();
