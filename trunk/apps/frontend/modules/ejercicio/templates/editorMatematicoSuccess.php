<?php use_helper('Javascript') ?>

<script language="javascript" type="text/javascript">

  var hayformula = 0;
  
  function mostrarSubmit()
  {
  document.getElementById('submit_editor').style.display = 'block';
  }
  
  function cerrarVentana()
  {
    var index;
    
    divtarget = window.opener.document.getElementById('<?php echo $divid?>');
    
    while (divtarget.hasChildNodes())
    {
      divtarget.removeChild(divtarget.firstChild);
    }

    
    var imagen = new Image();
    imagen.src = '<?php echo $ruta_imagen.'?'.time(); ?>';
    //divtarget.appendChild(imagen);
    divtarget.innerHTML='<img src="<?php echo $ruta_imagen.'?'.time(); ?>">'
    divtarget.className='formula_lleno';
    window.close();
  }
  
  function renderEquation()
  {
    new Ajax.Updater('equationview', '/ejercicio/mostrarFormula', {asynchronous:false, evalScripts:false, parameters:Form.serialize(document.form_editor_matematico)});
  
    if (!hayformula)
    {
      hayformula = 1;
      mostrarSubmit();
      //setTimeout('mostrarSubmit()',3000);
      
    }
  }


  function saveEquation()
  {

    if (confirm('Desea guardar esta ecuaci\u00f3n?'))
    {
  
      new Ajax.Updater('equationview', '/ejercicio/guardarFormula', {asynchronous:false, evalScripts:false, parameters:Form.serialize(document.form_editor_matematico)});
      cerrarVentana();
      
    }
  }


  function cleartext()
  {
    var id = document.getElementById('latex_formula');
    id.value = "";
    id.focus();
    
    if (hayformula)
    {
      hayformula = 0;
      document.getElementById('submit_editor').style.display = 'none';
      new Ajax.Updater('equationview', '/ejercicio/blank', {asynchronous:true, evalScripts:false});
    }
  }

</script>

<center>
<form name="form_editor_matematico">
<input type="hidden" name="cuestion" id="cuestion" value="<?php echo $cuestion?>">
<input type="hidden" name="tipo" id="tipo" value="<?php echo $tipo ?>">
<input type="hidden" name="id" id="id" value="<?php echo $id?>">
<table class="tabla_editor_matematico">
	<tr height="50">
	  <td width="100%"><center>
	    <table style="width: 586px; text-align: center;">
	    <tr>
	    <td width="25%">
    		<select name="spaces" id="spaces" class="select_editor_matematico" onChange="insertText(this.options[this.selectedIndex].value); this.selectedIndex=0;">
     			<option class="selected" selected value="0">Espacios</option>
     			<option class="not_selected" value="\,">peque&ntilde;o</option>
     			<option class="not_selected" value="\:">mediano</option>
     			<option class="not_selected" value="\;">grueso</option>
     			<option class="not_selected" value="\!">negativo</option>
    	  </select>
      </td>
      
      <td width="25%">
   			<select name="style" id="style" class="select_editor_matematico" onChange="insertText(this.options[this.selectedIndex].value, 1000); this.selectedIndex=0;">
     			<option class="selected" selected value="0" >Texto</option>
     			<option class="not_selected" value="\textrm{}">Normal</option>
     			<option class="not_selected" value="\textbf{}">Negrita</option>
     			<option class="not_selected" value="\textit{}">Cursiva</option>
     			<option class="not_selected" value="\textsc{}">May&uacute;sculas</option>
     			<option class="not_selected" value="\texttt{}">Imprenta</option>
   		  </select>
 		  </td>
 		  
      <td width="25%">
   			<select name="symbols" id="symbols" class="select_editor_matematico" onChange="insertText(this.options[this.selectedIndex].value); this.selectedIndex=0;">
     			<option class="selected" selected value="0">S&iacute;mbolos</option>
     			<option class="not_selected" value="\times">multiplicaci&oacute;n</option>
     			<option class="not_selected" value="\div">divisi&oacute;n</option>
     			<option class="not_selected" value="\star">estrella</option>
     			<option class="not_selected" value="\circ">c&iacute;rculo</option>
     			<option class="not_selected" value="\cdot">punto</option>
     			<option class="not_selected" value="\vee">uni&oacute;n</option>
     			<option class="not_selected" value="\wedge">intersecci&oacute;n</option>
     			<option class="not_selected" value="\diamond">rombo</option>
   		  </select>
 		  </td>
 		
 		  <td width="25%">
   		  <select name="tamano" id="tamano" class="select_editor_matematico">
     			<option class="selected" selected value="11">Tama&ntilde;o</option>
     			<option class="not_selected" value="11">11</option>
     			<option class="not_selected" value="12">12</option>
     			<option class="not_selected" value="13">13</option>
     			<option class="not_selected" value="14">14</option>
   		  </select>
   		</td>
    </tr>
    </table>
    </center>		
		<?php //&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.codecogs.com/pages/standards/commands.htm#equations" target="_blank"><img src="/editor/i.gif" align="absmiddle" width="13" height="13" border="0">&nbsp;Help</a> ?>
	  </td>
	</tr>
  <tr><td width="100%"><img src="/editor/equation_editor2.gif" width="550" height="79" border="0" usemap="#equationeditormap"></td></tr>
  
	<tr><td width="100%"><br><textarea class="textarea_editor_matematico" name="latex_formula" id="latex_formula"><?php echo $enunciado ?></textarea><br></td></tr>
	
  
  
	<tr height="40"><td width="100%">
  	<table style="width: 100%; text-align: center;">
	    <tr>
	      <td width="2%">&nbsp;</td>
    		<td width="32%"><input type="button" id="borrar_editor" class="boton_editor_matematico" onClick="cleartext()" value="Borrar expresi&oacute;n"></td>
    		<td width="32%"><input type="button" id="mostrar_editor" class="boton_editor_matematico" onClick="renderEquation()" value="Mostrar resultado"></td>
    		<td width="32%"><input type="button" id="submit_editor" class="submit_editor_matematico" onClick="saveEquation()" value="Guardar resultado"></td>
    		<td width="2%">&nbsp;</td>
    	</tr>
    </table>
  </td></tr>

	<tr height="271">
    <td style="width: 100%; vertical-align: top;">
      <br><br>
      <div id="equationview">
      &nbsp;
      <?php if ($modificar):?>
        <img src="<?php echo $ruta_imagen?>"/>
      <?php endif;?>
      </div>
    </td>
  </tr>

</table>
</form>
</center>
<map name="equationeditormap">
<area shape="rect" alt="\bigcap_a^b" title="\bigcap_a^b" coords="6,4,30,27" href="javascript:insertText('\\bigcap_{}^{}',9)">
<area shape="rect" alt="\bigcup_a^b" title="\bigcup_a^b" coords="35,4,59,27" href="javascript:insertText('\\bigcup_{}^{}',9)">
<area shape="rect" alt="\prod_a^b" title="\prod_a^b" coords="68,4,92,27" href="javascript:insertText('\\prod_{}^{}',7)">
<area shape="rect" alt="\coprod_a^b" title="\coprod_a^b" coords="97,4,121,27" href="javascript:insertText('\\coprod_{}^{}',9)">
<area shape="rect" alt="\int_a^b" title="\int_a^b" coords="130,4,154,27" href="javascript:insertText('\\int_{}^{}',6)">
<area shape="rect" alt="\oint_a^b" title="\oint_a^b" coords="159,4,183,27" href="javascript:insertText('\\oint_{}^{}',7)">
<area shape="rect" alt="\sum_a^b>" title="\sum_a^b>" coords="188,4,212,27" href="javascript:insertText('\\sum_{}^{}',6)">
<area shape="rect" alt="a_b" title="a_b" coords="221,4,245,27" href="javascript:insertText('{}_{}',1)">
<area shape="rect" alt="a^b" title="a^b" coords="250,4,274,27" href="javascript:insertText('{}^{}',1)">
<area shape="rect" alt="\sqrt[n]{x}" title="\sqrt[n]{x}" coords="279,4,303,27" href="javascript:insertText('\\sqrt[]{}',6)">
<area shape="rect" alt="\lim_{x \rightarrow 0}" title="\lim_{x \rightarrow 0}" coords="308,4,332,27" href="javascript:insertText('\\lim_{}',6)">
<area shape="rect" alt="\left[ \right]" title="\left[ \right]" coords="341,4,365,27" href="javascript:insertText('\\left[ \\right]',6)">
<area shape="rect" alt="\left( \right)" title="\left( \right)" coords="370,4,394,27" href="javascript:insertText('\\left( \\right)',6)">
<area shape="rect" alt="\left| \right|" title="\left| \right|" coords="399,4,423,27" href="javascript:insertText('\\left| \\right|',6)">
<area shape="rect" alt="\frac" title="\frac" coords="428,4,452,27" href="javascript:insertText('\\frac{}{}',6)">
<area shape="rect" alt="aligned equations" title="aligned equations" coords="461,4,485,27" href="javascript:insertText('\n\n\\begin{align}\n   a &= b \\\\ \n   c &= d \n\\end{align}\n',19)">
<area shape="rect" alt="matrix" title="matrix" coords="490,4,514,27" href="javascript:insertText('\n\\begin{pmatrix}\n   a & b  \\\\ \n   c & d \n\\end{pmatrix}\n',20)">
<area shape="rect" alt="determinant" title="determinant" coords="519,4,543,27" href="javascript:insertText('\n\\begin{vmatrix}\n   a & b  \\\\ \n   c & d \n\\end{vmatrix}\n',20)">
<area shape="rect" alt="\alpha" title="\alpha" coords="6,34,17,45" href="javascript:insertText('\\alpha')">
<area shape="rect" alt="\beta" title="\beta" coords="22,34,33,45" href="javascript:insertText('\\beta')">
<area shape="rect" alt="\gamma" title="\gamma" coords="38,34,49,45" href="javascript:insertText('\\gamma')">
<area shape="rect" alt="\delta" title="\delta" coords="54,34,65,45" href="javascript:insertText('\\delta')">
<area shape="rect" alt="\epsilon" title="\epsilon" coords="70,34,81,45" href="javascript:insertText('\\epsilon')">
<area shape="rect" alt="\varepsilon" title="\varepsilon" coords="86,34,97,45" href="javascript:insertText('\\varepsilon')">
<area shape="rect" alt="\zeta" title="\zeta" coords="102,34,113,45" href="javascript:insertText('\\zeta')">
<area shape="rect" alt="\eta" title="\eta" coords="118,34,129,45" href="javascript:insertText('\\eta')">
<area shape="rect" alt="\theta" title="\theta" coords="134,34,145,45" href="javascript:insertText('\\theta')">
<area shape="rect" alt="\vartheta" title="\vartheta" coords="150,34,161,45" href="javascript:insertText('\\vartheta')">
<area shape="rect" alt="\iota" title="\iota" coords="166,34,177,45" href="javascript:insertText('\\iota')">
<area shape="rect" alt="\kappa" title="\kappa" coords="182,34,193,45" href="javascript:insertText('\\kappa')">
<area shape="rect" alt="\lambda" title="\lambda" coords="198,34,209,45" href="javascript:insertText('\\lambda')">
<area shape="rect" alt="\mu" title="\mu" coords="214,34,225,45" href="javascript:insertText('\\mu')">
<area shape="rect" alt="\nu" title="\nu" coords="230,34,241,45" href="javascript:insertText('\\nu')">
<area shape="rect" alt="\leq" title="\leq" coords="300,34,311,45" href="javascript:insertText('\\leq')">
<area shape="rect" alt="\prec" title="\prec" coords="316,34,327,45" href="javascript:insertText('\\prec')">
<area shape="rect" alt="\preceq" title="\preceq" coords="332,34,343,45" href="javascript:insertText('\\preceq')">
<area shape="rect" alt="\ll" title="\ll" coords="348,34,359,45" href="javascript:insertText('\\ll')">
<area shape="rect" alt="\geq" title="\geq" coords="368,34,379,45" href="javascript:insertText('\\geq')">
<area shape="rect" alt="\succ" title="\succ" coords="384,34,395,45" href="javascript:insertText('\\succ')">
<area shape="rect" alt="\succeq" title="\succeq" coords="400,34,411,45" href="javascript:insertText('\\succeq')">
<area shape="rect" alt="\gg" title="\gg" coords="416,34,427,45" href="javascript:insertText('\\gg')">
<area shape="rect" alt="\equiv" title="\equiv" coords="436,34,447,45" href="javascript:insertText('\\equiv')">
<area shape="rect" alt="\sim" title="\sim" coords="452,34,463,45" href="javascript:insertText('\\sim')">
<area shape="rect" alt="\simeq" title="\simeq" coords="468,34,479,45" href="javascript:insertText('\\simeq')">
<area shape="rect" alt="\asymp" title="\asymp" coords="484,34,495,45" href="javascript:insertText('\\asymp')">
<area shape="rect" alt="\approx" title="\approx" coords="500,34,511,45" href="javascript:insertText('\\approx')">
<area shape="rect" alt="\neq" title="\neq" coords="516,34,527,45" href="javascript:insertText('\\neq')">
<area shape="rect" alt="\propto" title="\propto" coords="532,34,543,45" href="javascript:insertText('\\propto')">
<area shape="rect" alt="\xi" title="\xi" coords="6,48,17,59" href="javascript:insertText('\\xi')">
<area shape="rect" alt="\pi" title="\pi" coords="22,48,33,59" href="javascript:insertText('\\pi')">
<area shape="rect" alt="\varpi" title="\varpi" coords="38,48,49,59" href="javascript:insertText('\\varpi')">
<area shape="rect" alt="\rho" title="\rho" coords="54,48,65,59" href="javascript:insertText('\\rho')">
<area shape="rect" alt="\varrho" title="\varrho" coords="70,48,81,59" href="javascript:insertText('\\varrho')">
<area shape="rect" alt="\sigma" title="\sigma" coords="86,48,97,59" href="javascript:insertText('\\sigma')">
<area shape="rect" alt="\varsigma" title="\varsigma" coords="102,48,113,59" href="javascript:insertText('\\varsigma')">
<area shape="rect" alt="\tau" title="\tau" coords="118,48,129,59" href="javascript:insertText('\\tau')">
<area shape="rect" alt="\upsilon" title="\upsilon" coords="134,48,145,59" href="javascript:insertText('\\upsilon')">
<area shape="rect" alt="\phi" title="\phi" coords="150,48,161,59" href="javascript:insertText('\\phi')">
<area shape="rect" alt="\varphi" title="\varphi" coords="166,48,177,59" href="javascript:insertText('\\varphi')">
<area shape="rect" alt="\chi" title="\chi" coords="182,48,193,59" href="javascript:insertText('\\chi')">
<area shape="rect" alt="\psi" title="\psi" coords="198,48,209,59" href="javascript:insertText('\\psi')">
<area shape="rect" alt="\omega" title="\omega" coords="214,48,225,59" href="javascript:insertText('\\omega')">
<area shape="rect" alt="\omega" title="\omega" coords="252,48,263,59" href="javascript:insertText('\\subset')">
<area shape="rect" alt="\omega" title="\omega" coords="268,48,279,59" href="javascript:insertText('\\subseteq')">
<area shape="rect" alt="\omega" title="\omega" coords="284,48,295,59" href="javascript:insertText('\\supset')">
<area shape="rect" alt="\omega" title="\omega" coords="300,48,311,59" href="javascript:insertText('\\supseteq')">
<area shape="rect" alt="\omega" title="\omega" coords="316,48,327,59" href="javascript:insertText('\\cup')">
<area shape="rect" alt="\omega" title="\omega" coords="332,48,343,59" href="javascript:insertText('\\cap')">
<area shape="rect" alt="\leftarrow" title="\leftarrow" coords="374,48,398,59" href="javascript:insertText('\\leftarrow')">
<area shape="rect" alt="\Leftarrow" title="\Leftarrow" coords="403,48,427,59" href="javascript:insertText('\\Leftarrow')">
<area shape="rect" alt="\rightarrow" title="\rightarrow" coords="432,48,456,59" href="javascript:insertText('\\rightarrow')">
<area shape="rect" alt="\Rightarrow" title="\Rightarrow" coords="461,48,485,59" href="javascript:insertText('\\Rightarrow')">
<area shape="rect" alt="\leftrightarrow" title="\leftrightarrow" coords="490,48,514,59" href="javascript:insertText('\\leftrightarrow')">
<area shape="rect" alt="\Leftrightarrow" title="\Leftrightarrow" coords="519,48,543,59" href="javascript:insertText('\\Leftrightarrow')">
<area shape="rect" alt="\Gamma" title="\Gamma" coords="6,62,17,73" href="javascript:insertText('\\Gamma')">
<area shape="rect" alt="\Delta" title="\Delta" coords="22,62,33,73" href="javascript:insertText('\\Delta')">
<area shape="rect" alt="\Theta" title="\Theta" coords="38,62,49,73" href="javascript:insertText('\\Theta')">
<area shape="rect" alt="\Lambda" title="\Lambda" coords="54,62,65,73" href="javascript:insertText('\\Lambda')">
<area shape="rect" alt="\Xi" title="\Xi" coords="70,62,81,73" href="javascript:insertText('\\Xi')">
<area shape="rect" alt="\Pi" title="\Pi" coords="86,62,97,73" href="javascript:insertText('\\Pi')">
<area shape="rect" alt="\Sigma" title="\Sigma" coords="102,62,113,73" href="javascript:insertText('\\Sigma')">
<area shape="rect" alt="\Upsilon" title="\Upsilon" coords="118,62,129,73" href="javascript:insertText('\\Upsilon')">
<area shape="rect" alt="\Phi" title="\Phi" coords="134,62,145,73" href="javascript:insertText('\\Phi')">
<area shape="rect" alt="\Psi" title="\Psi" coords="150,62,161,73" href="javascript:insertText('\\Psi')">
<area shape="rect" alt="\Omega" title="\Omega" coords="166,62,177,73" href="javascript:insertText('\\Omega')">
<area shape="rect" alt="\in" title="\in" coords="252,62,263,73" href="javascript:insertText('\\in')">
<area shape="rect" alt="\ni" title="\ni" coords="268,62,279,73" href="javascript:insertText('\\ni')">
<area shape="rect" alt="\nabla" title="\nabla" coords="284,62,295,73" href="javascript:insertText('\\nabla')">
<area shape="rect" alt="\forall" title="\forall" coords="300,62,311,73" href="javascript:insertText('\\forall')">
<area shape="rect" alt="\exists" title="\exists" coords="316,62,327,73" href="javascript:insertText('\\exists')">
<area shape="rect" alt="\partial" title="\partial" coords="332,62,343,73" href="javascript:insertText('\\partial')">
<area shape="rect" alt="\infty" title="\infty" coords="348,62,363,73" href="javascript:insertText('\\infty')">
<area shape="rect" alt="\aleph" title="\aleph" coords="404,62,415,73" href="javascript:insertText('\\aleph')">
<area shape="rect" alt="\hbar" title="\hbar" coords="420,62,431,73" href="javascript:insertText('\\hbar')">
<area shape="rect" alt="\imath" title="\imath" coords="436,62,447,73" href="javascript:insertText('\\imath')">
<area shape="rect" alt="\jmath" title="\jmath" coords="452,62,463,73" href="javascript:insertText('\\jmath')">
<area shape="rect" alt="\ell" title="\ell" coords="468,62,479,73" href="javascript:insertText('\\ell')">
<area shape="rect" alt="\wp" title="\wp" coords="484,62,495,73" href="javascript:insertText('\\wp')">
<area shape="rect" alt="\Re" title="\Re" coords="500,62,511,73" href="javascript:insertText('\\Re')">
<area shape="rect" alt="\Im" title="\Im" coords="516,62,527,73" href="javascript:insertText('\\Im')">
<area shape="rect" alt="\prime" title="\prime" coords="532,62,543,73" href="javascript:insertText('\\prime')">
</map>

