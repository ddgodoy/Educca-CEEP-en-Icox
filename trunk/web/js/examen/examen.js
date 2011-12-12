function refresh()
{
  window.location.href = window.location.href;
  // window.location.reload(true);
}

function borrar_upload(clave)
{
  if (confirm('Desea borrar esta hoja de respuestas?'))
  {
    new Ajax.Updater('deletion_div', '/ejercicio/deleteUpload', {asynchronous:true, evalScripts:false, parameters:'clave=' + clave});
    setTimeout( "refresh()", 2000 );
  }

}
