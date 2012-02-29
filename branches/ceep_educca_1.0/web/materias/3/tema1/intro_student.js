	
var mm_name;
var nameS;
	
var mm_apellido;
var mm_nombre;
var mm_time;
var mm_intentos;
var mm_raw_score;
var mm_puntuacion;
var child;
var mm_score;
var StartTime;
var status;
var icono;

function setElapsedTime() {
   var ThisTime = new Date().getTime();
   if (StartTime!=null) {
      var UsedTime = ThisTime - StartTime;
      var LMSTime = SetLMSTime(UsedTime);
      mm_adl_API.LMSSetValue("cmi.core.session_time", LMSTime);
   }
}

function SetLMSTime(Time) {
   var hms = "";
   var dtm = new Date();
   dtm.setTime(Time);
   var h = "000" + Math.floor(Time/3600000);
   var m = "0" + dtm.getMinutes();
   var s = "0" + dtm.getSeconds();
   var cs = "0" + Math.round(dtm.getMilliseconds() / 10);
   hms = h.substr(h.length-4) + ":" + m.substr(m.length-2) + ":" + s.substr(s.length-2) + "." + cs.substr(cs.length-2);
   return hms;
}

function abrirTeoria() {
	child = open ("teoria.html",'child','left=20,top=20,width=760,height=620,scrollbars=1,toolbar=0,resizable=1');
	mm_intentos = mm_adl_API.LMSGetValue("cmi.suspend_data");
	mm_intentos++;
	mm_adl_API.LMSSetValue("cmi.suspend_data",mm_intentos);
	StartTime = new Date().getTime();
}

function abrirCuestionario() {	
	child = open ("cuestionario.html",'child','left=20,top=20,width=760,height=620,scrollbars=1,toolbar=0,resizable=1');
	StartTime = new Date().getTime();
}

function start_interacting(valor){
	mm_puntuacion = valor;
	mm_raw_score = mm_adl_API.LMSGetValue("cmi.core.score.raw");
  
    if (mm_raw_score < mm_puntuacion)
    	mm_adl_API.LMSSetValue("cmi.core.score.raw",mm_puntuacion);
}

function status_completado(){
	// set status
    mm_adl_API.LMSSetValue("cmi.core.lesson_status", "completed");	
}
// call LMSInitialize()
function mm_adlOnload()
{
  if (mm_adl_API != null)
  {
    mm_adl_API.LMSInitialize("");
    // set status
	status = mm_adl_API.LMSGetValue("cmi.core.lesson_status");
	if (status == "not attempted")
      mm_adl_API.LMSSetValue("cmi.core.lesson_status", "incomplete");
	
	mm_name = mm_adl_API.LMSGetValue("cmi.core.student_name");
	nameS = mm_name.split(",");
	
	mm_apellido = nameS[0];
	mm_nombre = nameS[1];
	
	mm_intentos = mm_adl_API.LMSGetValue("cmi.suspend_data");
	mm_intentos++;
	mm_intentos--;
	if (mm_intentos < 0) {
		mm_intentos = 0;
		mm_adl_API.LMSSetValue("cmi.suspend_data",mm_intentos);
	} 
	
	
  }
  
  mm_score = mm_adl_API.LMSGetValue("cmi.core.score.raw");
  var contenido = '';
  
  contenido += '<table width="100%" border="0" cellspacing="0" cellpadding="0">';
  contenido += '<tr>\n'+'<td width="8%" height="32">&nbsp;</td>\n'+'<td width="92%"><p>Bienvenido/a, <strong>';
  contenido += mm_nombre;
  contenido += '</p>\n'+'</td>\n'+'</tr>\n'+'<tr>\n'+'<td>&nbsp;</td>\n'+'<td height="20"><img src="../shared/imagenes/biblio_p.jpg" alt="tema" width="20" height="25" hspace="2" align="absmiddle" />Te encuentras en la unidad de <strong>Stakeholders y vis&oacute;n  estrat&eacute;gica</strong></td>\n'+'</tr>\n'+'<tr>\n'+'<td>&nbsp;</td>\n'+'<td height="20"><img src="../shared/imagenes/lupa.jpg" alt="revisión" width="20" height="25" hspace="2" align="absmiddle" />Has revisado este tema <strong>';
  contenido += mm_intentos;
  contenido += '</strong> veces.</td>\n'+'</tr>\n'+'<tr>\n'+'<td>&nbsp;</td>\n'+'<td height="20"><img src="../shared/imagenes/ejercic_p.jpg" alt="puntuación" width="20" height="25" hspace="2" align="absmiddle" />Tu puntuaci&oacute;n m&aacute;xima en el cuestionario ha sido <strong>';
  if (mm_score == "")
  	mm_score = 0;
  contenido += mm_score;
  contenido += '</strong>. </td>\n'+'</tr>\n'+'<tr>\n'+'<td>&nbsp;</td>\n'+'<td height="20"><img src="../shared/imagenes/stats.jpg" alt="tiempo" width="20" height="25" hspace="2" align="absmiddle" />El tiempo invertido en esta unidad ha sido de <strong>'
  
  mm_time = mm_adl_API.LMSGetValue("cmi.core.total_time");
  contenido += mm_time;
  contenido += '</strong> </td>\n'+'</tr>\n'+'</table>';
  			
  document.getElementById('bienvenida').innerHTML = contenido;
  
  status = mm_adl_API.LMSGetValue("cmi.core.lesson_status");
  
  if (status == "completed") {
  	icono = "<a href=\"javascript:void(0)\" onclick=\"abrirCuestionario()\"><img src=\"../shared/imagenes/ejercicios.gif\" alt=\"Autoevaluaci&oacute;n\" width=\"217\" height=\"50\" vspace=\"10\" border=\"0\" /></a>";
	} else {
    icono = "<img src=\"../shared/imagenes/ejercicios_no.gif\" alt=\"Autoevaluaci&oacute;n\" width=\"257\" height=\"50\" vspace=\"10\" border=\"0\" />";
	}
  
    document.getElementById('autoev').innerHTML = icono;
  
}

// -->