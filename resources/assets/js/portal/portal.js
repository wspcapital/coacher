let path = location.pathname.slice(1);
let moduleName = path.split('/');
if(moduleName.length > 1) {
    require('./../left-block');
}