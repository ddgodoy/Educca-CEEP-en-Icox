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


