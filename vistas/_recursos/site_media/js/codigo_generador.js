
  /*
  var cadena = "abcdefghij";
console.log("(2,4): "    + cadena.substr(0,1));
  */

    /**GENERAR CODIGO**/
  var nombree = document.getElementById("nombre_alumno").value;
  var apellidop = document.getElementById("ape_paterno").value;
  var apellidom = document.getElementById("ape_materno").value;
  var primera = nombree.substr(0,1);
  var segunda = apellidop.substr(0,1);
  var tercera = apellidom.substr(0,1);
    
    function generar_codigo(chars, lon){

    code = "";
      for (x=0; x < lon; x++){
      rand = Math.floor(Math.random()*chars.length);
      code += chars.substr(rand, 1);
      }
      return code;
    }
    caracteres = "0123456789abcdefghijklmnopqrstuvwxyz";
    longitud = 5;
    ///alert(rand_code(caracteres, longitud));    
    //MOSTRANDO CODIGO
    //var codigo = $("#codigo").val(primera);
    document.getElementById("codigo_alumno").value =primera+segunda+tercera+generar_codigo(caracteres, longitud) ;
      //var codigo = $("#codigo").val(primera+segunda+tercera+generar_codigo(caracteres, longitud));















      /*
      //otra forma

    function makeid()
    {
        var text = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

        for( var i=0; i < 5; i++ )
            text += possible.charAt(Math.floor(Math.random() * possible.length));

        return text;
    }

      */
