// JavaScript Document

function checkAll(nombre,principal) {
  //jacobo chaquet
	todos= document.forms[0];
	var check_principal = document.getElementById(principal);

  for (x=0;x<todos.length;x++)
  {
   if(todos[nombre+x])
   {

     if (check_principal.checked == true){todos[nombre+x].checked=true;}
	   else {todos[nombre+x].checked=false;}
   }
  }
}



function checkAllTest() {

	var inputs = document.getElementsByName('testgroup');
	var check_principal = document.getElementById('all_tests');

	for (var i = 0; i < inputs.length; i++) {
	  if (check_principal.checked == true) {inputs[i].checked = true;}
	  else {inputs[i].checked = false;}
	}
}

function checkAllCuestionario() {

	var inputs = document.getElementsByName('cuestgroup');
	var check_principal = document.getElementById('all_cuestionarios');

	for (var i = 0; i < inputs.length; i++) {
	  if (check_principal.checked == true) {inputs[i].checked = true;}
	  else {inputs[i].checked = false;}
	}
}

function checkAllProblemas() {

	var inputs = document.getElementsByName('problemgroup');
	var check_principal = document.getElementById('all_problemas');

	for (var i = 0; i < inputs.length; i++) {
	  if (check_principal.checked == true) {inputs[i].checked = true;}
	  else {inputs[i].checked = false;}
	}
}


function calcularMedias() {

  var inputs;
  var i;
  var count = 0;
  var count2 = 0;
  var sum_nota = 0;
  var sum_nota2 = 0;

  // Calculo para los test
  inputs = document.getElementsByName('testgroup');
  for (var i = 0; i < inputs.length; i++) {
	  if (inputs[i].checked == true) {
	    count++;
	    sum_nota += (inputs[i].value * 1);
    }
	}
	var nota_tests = document.getElementById('input_tests');
	if (count != 0) {
	  sum_nota2 += (sum_nota / count);
    nota_tests.value = (sum_nota / count);
    nota_tests.value = nota_tests.value.substring(0,4);
    count2++;
  }
	else {
    nota_tests.value = '---';
  }

  // Calculo para los cuestionarios
  count = 0;
  sum_nota = 0;
  inputs = document.getElementsByName('cuestgroup');
  for (var i = 0; i < inputs.length; i++) {
	  if (inputs[i].checked == true) {
	    count++;
	    sum_nota += (inputs[i].value * 1);
    }
	}
	var nota_cuestionarios = document.getElementById('input_cuestionarios');
	if (count != 0) {
	  sum_nota2 += (sum_nota / count);
    nota_cuestionarios.value = (sum_nota / count);
    nota_cuestionarios.value = nota_cuestionarios.value.substring(0,4);
    count2++;
  }
	else {
    nota_cuestionarios.value = '---';
  }

  // Calculo para los problemas
  count = 0;
  sum_nota = 0;
  inputs = document.getElementsByName('problemgroup');
  for (var i = 0; i < inputs.length; i++) {
	  if (inputs[i].checked == true) {
	    count++;
	    sum_nota += (inputs[i].value * 1);
    }
	}
	var nota_problemas = document.getElementById('input_problemas');
	if (count != 0) {
	  sum_nota2 += (sum_nota / count);
    nota_problemas.value = (sum_nota / count);
    nota_problemas.value = nota_problemas.value.substring(0,4);
    count2++;
  }
	else {
    nota_problemas.value = '---';
  }

  // Nota final
  var target = document.getElementById('nota_final');

  if (count2 > 0) {
    target.value = (sum_nota2 / count2);
    target.value = target.value.substring(0,4);
  }
}


function mostrarAyuda() {

  document.getElementById('explicacion_eval').style.display = 'block';
  document.getElementById('div_opciones_eval').style.display = 'none';

}


function ocultarAyuda() {

  document.getElementById('explicacion_eval').style.display = 'none';
  document.getElementById('div_opciones_eval').style.display = 'block';

}


function submitNotaFinal() {

  var target = document.getElementById('nota_final');
  var filtro_float = /^\d+\.\d+$/
  var filtro_entero = /^\d+$/
  if (target.value == '' || target.value == null) {alert('Deber poner una nota final'); return false;}
  if ((!filtro_float.test(target.value)) && (!filtro_entero.test(target.value))) {alert('La nota no es un n\u00famero v\u00e1lido'); return false;}

  var nota_anterior = document.getElementById('ultima_nota').value;

  if ((nota_anterior == null) || (nota_anterior == '')) {
    document.getElementById('form_eval').submit();
    alert('Nota guardada con \u00e9xito');
    window.opener.location.reload();
    window.close();
  }
  else {
    if (confirm('Desea cambiar la nota anterior '+nota_anterior+' por la nueva nota '+target.value)) {
      document.getElementById('form_eval').submit();
      alert('Nota guardada con \u00e9xito');
      window.opener.location.reload();
      window.close();
    }
  }


}


function conf_guardar_eval()
{
  return confirm('Si guarda esta nueva evaluaci\u00f3n se le enviar\u00e1 una notificaci\u00f3n al alumno inform\u00e1ndole que ya ha evaluado su ejercicio o bien que ha modificado la anterior evaluaci\u00f3n del mismo. Desea continuar?');
}


function conf_correccion_tests()
{
  return confirm('Cada vez que pulse este bot\u00f3n se corregir\u00e1n de nuevo (si ya estaban corregidos) todos los ejercicios de test. Se le enviar\u00e1 una notificaci\u00f3n a cada alumno indic\u00e1ndole el resultado de la nueva correcci\u00f3n. Desea continuar? ');
}
