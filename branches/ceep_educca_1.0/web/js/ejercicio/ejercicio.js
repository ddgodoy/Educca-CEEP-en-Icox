// JavaScript Document

function abrirVentanaExp(tipo, cuestion, id, divid, target) {
  var popup_handler = window.open('/ejercicio/editorMatematico?tipo='+tipo+'&cuestion='+cuestion+'&id='+id+'&divid='+divid, 'ventana_editor_matematico', 'width=660,height=600,directories=0,location=0,menubar=0,status=0,titlebar=0,toolbar=0,resizable=0,scrollbars=0');
  popup_handler.focus();    
}
  

// Editor matematico

function insertText( txt, pos )
{
	// pos = optional parameter defining where in inserted text to put the caret
	// if undefined put at end of inserted text
	// if pos=1000 then using style options and move to just before final }
	// startPos = final position of caret in complete text
	if (pos==1000)
  {
    pos=txt.length-1;
  }
	if (pos==undefined)
  {
    pos=txt.length;
  }

	// my textarea is called latex_formula
	myField = document.getElementById('latex_formula');
	if (document.selection) 	{
		// IE
		myField.focus();
		var sel = document.selection.createRange();
		// find current caret position
		var i = myField.value.length+1;
		theCaret = sel.duplicate();
		while (theCaret.parentElement()==myField
		&& theCaret.move("character",1)==1) --i;

		// take account of line feeds
		var startPos = i - myField.value.split('\n').length + 1 ;

		if (txt.substring(1,5) == "left" && sel.text.length)	{
			// allow highlighted text to be bracketed
			pos = txt.length + sel.text.length + 1;
			sel.text = txt.substring(0,7) + sel.text + txt.substr(6);
		} else {
			sel.text = txt;
		}
		// put caret in correct position to start editing
		var range = myField.createTextRange();
		range.collapse(true);
		range.moveEnd('character', startPos + pos);
		range.moveStart('character', startPos + pos);
		range.select();
	}
	else
	{
		// MOZILLA
		if (myField.selectionStart || myField.selectionStart == '0')	{
			var startPos = myField.selectionStart;
			var endPos = myField.selectionEnd;
			var cursorPos = startPos + txt.length;
			if (txt.substring(1,5) == "left" && endPos > startPos)	{
				// allow highlighted text to be bracketed
				pos = txt.length + endPos - startPos + 1;
				txt = txt.substring(0,7) + myField.value.substring(startPos, endPos) + txt.substr(6);
			}
			myField.value = myField.value.substring(0, startPos) + txt
							+ myField.value.substring(endPos, myField.value.length);

			myField.selectionStart = cursorPos;
			myField.selectionEnd = cursorPos;

						// put caret in correct position to start editing
			myField.focus();
			myField.setSelectionRange(startPos + pos,startPos + pos);
		}
		else
		{
			myField.value += txt;
		}
	}
	myField.focus();
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






