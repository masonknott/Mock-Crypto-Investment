mix.js('resources/js/app.js', 'public/js')
    .vue({ version: 2 }) // Specify Vue 2. If you're using Vue 3, you'll adjust accordingly
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ]);
