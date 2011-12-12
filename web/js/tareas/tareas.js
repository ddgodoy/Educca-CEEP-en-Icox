// JavaScript Document
function checkAll()
{	
	var inputs = document.getElementsByTagName('input');
	var checkboxes = [];
	var cambiado = 0;
	var acambiar = 0;
	
	for (var i = 0; i < inputs.length; i++) {
	  if (inputs[i].type == 'checkbox') {		
		if (cambiado == 0) {			
			if (inputs[i].checked == true) {
				acambiar = 0;	
			} else {
				acambiar = 1;
			}
			cambiado = 1;
		}
		
		if (acambiar == 0) {
			inputs[i].checked = true;
		} else {
			inputs[i].checked = false;
		}		
	  }
	}
}

function contar_checks()
{	
	var inputs = document.getElementsByTagName('input');
	var count = 0;
	
	for (var i = 0; i < inputs.length; i++) {
	  if (inputs[i].type == 'checkbox') {		
		  if (inputs[i].checked == true) {count++;} 
	  }
	}
	
	if (!count) {
    alert('Debe elegir al menos un alumno');
    return false;
  }
	return true;
}

function confirmar_reclamacion ()
{
  return confirm('Desea solicitar una reclamaci\u00f3n de este ejercicio?');
}

function refresh()
{
  window.location.href = window.location.href;
}

function borrar_upload(clave)
{
  if (confirm('Desea borrar esta hoja de respuestas?'))
  {
    new Ajax.Updater('deletion_div', '/ejercicio/deleteUpload', {asynchronous:true, evalScripts:false, parameters:'clave=' + clave});
    setTimeout( "refresh()", 3000 );
  }

}
