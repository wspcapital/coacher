const NODE_ENV = process.env.NODE_ENV || 'development';
const webpack = require('webpack');

module.exports = {
    context: __dirname + '/resources/assets/js',
    entry: {
        app: './app.js'
    },
    output: {
        path: __dirname + '/public/assets/dist/js',
        publicPath: "/assets/dist/js/",
        filename: "[name].js",
        library: "[name]"
    },

    watch: NODE_ENV === 'development',
    //   watch: true,
    watchOptions: {
        aggregateTimeout: 100
    },

    devtool: "cheap-inline-module-source-map",

    plugins: [
       /* new webpack.optimize.UglifyJsPlugin({
           compress: {
               warnings: false,
               drop_console: true,
               unsafe: true
           }
        }),*/
        // new webpack.NoEmitOnErrorsPlugin(),
        new webpack.DefinePlugin({
            NODE_ENV: JSON.stringify(NODE_ENV)
        }),
        /*new webpack.optimize.CommonsChunkPlugin({
         name: "common",
         chunks: ['about', 'home'],
         minChunks: 2
         })*/
    ],

    resolve: {
        alias: {
            vue: 'vue/dist/vue.js'
        }

    },

    module: {
        loaders: [
            {
                test: /\.vue$/,
                loader: 'vue-loader',
            },
            {
                test: /\.js$/,
                loader: 'babel-loader',
                exclude: /node_modules/,
            }
        ],
    }
};
