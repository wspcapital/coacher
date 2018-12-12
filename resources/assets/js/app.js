window.Laravel = {csrfToken: '{{ csrf_token() }}'};
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

let path = location.pathname.slice(1);
let moduleName = path.split('/');

let mainHandler;
let handler;
//console.log(moduleName);
try {
    if (moduleName[0] == 'intranet') {
        if (moduleName[1] != 'booking') {
            mainHandler = require("bundle-loader!./intranet/" + moduleName[0] + '.js');
        }
        handler = require("bundle-loader!./intranet/" + moduleName[1] + '.js');
    }
    else if (moduleName[0] == 'portal') {
        mainHandler = require("bundle-loader!./portal/" + moduleName[0] + '.js');
        handler = require("bundle-loader!./portal/" + moduleName[1] + '.js');
    }
    else if (moduleName[0] == 'vcoach') {
        mainHandler = require("bundle-loader!./vcoach/" + moduleName[0] + '.js');
        handler = require("bundle-loader!./vcoach/" + moduleName[1] + '.js');
    }
    else if (moduleName[0] == 'docs') {
        handler = require("bundle-loader!./docs/" + moduleName[1] + '.js');
    }
    else {
        if (moduleName[0] == '') {
            handler = require("bundle-loader!./homepage/index.js");
        }
        else {
            handler = require("bundle-loader!./homepage/" + moduleName[0] + '.js');
        }
    }
} catch (e) {
    console.log("No such path");
}

