let path = location.pathname.slice(1);
let moduleName = path.split('/');

if (moduleName[1] !== 'calendar' && moduleName[1] !== 'booking') {
    require ('./../left-block');
}


