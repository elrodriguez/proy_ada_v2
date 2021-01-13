//consola mensaje
console.log("%cAdvertencia! %cSolo desarrolladores", "color: #EB002E; font-size:35px;", "color: #3297E9; background-color:#292929;padding:10px; font-size:15px;"); 
//otra forma
var css = "font-size: 40px;color: #00B838; background-color:#222";
//console.log("%cEjemplo %s", css, 'Ventana peligrosa');
//otra forma
var styles = [
    'background: linear-gradient(#D33106, #571402)'
    , 'border: 1px solid #3E0E02'
    , 'color: white'
    , 'display: block'
    , 'text-shadow: 0 1px 0 rgba(0, 0, 0, 0.3)'
    , 'line-height: 40px'
    , 'text-align: center'
    , 'font-weight: bold'
].join(';');

//console.log('%c otro ejemplo ?', styles);