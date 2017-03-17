const elixir = require('laravel-elixir');

elixir(function(mix) {
    mix.browserSync({
        proxy: 'soccerrecap:8888'
    });
});
