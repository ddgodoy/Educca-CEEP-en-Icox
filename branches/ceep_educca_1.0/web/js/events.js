/* Código para el rollover */

function rollover(id, image)
{
	document.images[id].src = image;
}

/* Fin rollover */


/* Código para quitar el boton de submit en formularios*/

 function bloqueaCapa(c)
  {
    cad= "document.getElementById('"+c+"').style.display='none';"
    eval(cad);
  }

  function desBloqueaCapa(c)
  {
    cad= "document.getElementById('"+c+"').style.display='' ;"
    eval(cad);
  }
  
  function ponerLoading(obj) {
	  
	  var hijos=obj.childNodes;
	      
	  for (var i=0; i< hijos.length; i++){
		if (hijos[i].tagName=='SPAN'){
			hijos[i].className= 'txt_desactivado';
		}
	  }	 
  }
    
/* Fin  */