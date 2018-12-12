// Require elixir
var _ = require('lodash'),
        elixir = require('laravel-elixir');

// Define required paths
elixir.config = _.merge(elixir.config, {
    css: {
        autoprefix: {
            options: {
                browsers: ['last 25 versions']
            }
        },
        sass: {
            folder: 'sass'
        }
    },
    paths: {
        public : elixir.config.publicPath + '/assets'
    }
});