<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="title" content="Error del servidor" />
<meta name="robots" content="index, follow" />
<meta name="description" content="plataforma e-learning" />
<meta name="keywords" content="e-learning, plataforma" />
<meta name="language" content="es" />

<title>Plataforma Adra</title>

<link rel="shortcut icon" href="/favicon.ico" >
<link rel="icon" href="/icoanim.gif" type="image/gif" >
<script>
	function ajustarTamanoPantalla () {
		var htm = document.getElementsByTagName('html')[0];
		var tamano_pantalla= htm.scrollHeight;
		document.getElementById('truco').style.height= tamano_pantalla+'px';
	}

	function ajustarTamanoPantalla2 () {
		var htm = document.getElementsByTagName('html')[0];
		var tamano_contenido= htm.offsetHeight;
		var tamano_pantalla= htm.scrollHeight;
		var tamano_cliente= htm.clientHeight;
		if (tamano_contenido > tamano_pantalla){
			//el contenido es mas grande que la pantalla
			alert('op1');
			document.getElementById('contenido_wrap').style.height= 'auto';//tamano_contenido+'px';
		}
		if (tamano_contenido < tamano_pantalla){
			//el contenido es mas pequeño que la pantalla
			alert('op2');
			document.getElementById('contenido_wrap').style.height= tamano_pantalla+'px';
		}
	}
</script>

<link rel="stylesheet" type="text/css" media="screen" href="../css/main.css" />
</head>
<body onresize="ajustarTamanoPantalla();">

	<div id="contenido_wrap">
       <div id="contenido">
       	  <div id="truco"></div>
		  <div style="float:right;">
	          <div id="header"><a href="/frontend_dev.php/"><img alt="Plataforma Adra" src="../images/logo_adra.jpg" /></a></div>
	          <div id="contenedor_barra_enlaces">
			  	<div id="barra_enlaces"><img src="../images/bots_cierre.gif" alt="Bots_cierre" /></div>
			  </div>
	          <div id="col1">
	                 
	          </div> <!-- fin col1 -->
	          <div id="wrapper">
	              <div id="col2">


                  </div>
             </div>
          </div>
       </div>
       
     </div>
    </body>
</html>

