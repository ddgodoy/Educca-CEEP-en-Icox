
/***********************************************
* Sliding Menu Bar Script- © Dynamic Drive (www.dynamicdrive.com)
* Visit http://www.dynamicdrive.com/ for full source code
* This notice must stay intact for use
***********************************************/

var slidemenu_width='222px' //specify width of menu (in pixels)
var slidemenu_reveal='20px' //specify amount that menu should protrude initially
var slidemenu_top='54px'   //specify vertical offset of menu on page

var ns4=document.layers?1:0
var ie4=document.all
var ns6=document.getElementById&&!document.all?1:0

if (ie4||ns6)
document.write('<div id="menu2" style="left:'+((parseInt(slidemenu_width)-parseInt(slidemenu_reveal))*-1)+'px; top:'+slidemenu_top+'; width:'+slidemenu_width+'" onMouseover="pull()" onMouseout="draw()"><img src="../shared/imagenes/topindice.gif" alt="Indice" width="222" height="28" /><BR><br>')
else if (ns4){
document.write('<style>\n#menu{\nwidth:'+slidemenu_width+';}\n<\/style>\n')
document.write('<layer id="menu" left=0 top='+slidemenu_top+' width='+slidemenu_width+' onMouseover="pull()" onMouseout="draw()" visibility=hide><img src="../shared/imagenes/topindice.gif" alt="Indice" width="222" height="28" /><BR><br>')
}

var sitems=new Array()

///////////Edit below/////////////////////////////////

//siteitems[x]=["Item Text", "Optional URL associated with text"]

sitems[0]=["1. Introducción", "http://www.dynamicdrive.com/dynamicindex1/"]
sitems[1]=["2. Concepto de RSC", "http://www.dynamicdrive.com/dynamicindex3/"]
sitems[2]=["3. Antecendes historicos", "http://www.dynamicdrive.com/dynamicindex2/"]
sitems[3]=["4. Los stakeholders", "http://www.dynamicdrive.com/dynamicindex4/"]
sitems[4]=["5. Gestión Estrategica", "http://www.dynamicdrive.com/dynamicindex5/"]
sitems[5]=["6. La RSC en España", "http://www.dynamicdrive.com/dynamicindex6/"]
sitems[6]=["7. Alcance en las Org. Internacionales", "http://www.dynamicdrive.com/dynamicindex10/"]
sitems[7]=["8. Evolucion en la sociedad", "http://www.dynamicdrive.com/dynamicindex8/"]
sitems[8]=["9. Situación de la RSC en los Paises", "http://www.dynamicdrive.com/dynamicindex9/"]
sitems[9]=["10. Normas", "http://www.dynamicdrive.com/dynamicindex11/"]
sitems[10]=["11. Tipos de responsabilidades sociales", "http://www.dynamicdrive.com/dynamicindex8/"]
sitems[11]=["12. La gestión ambiental y RSC", "http://www.dynamicdrive.com/dynamicindex9/"]
sitems[12]=["13. Implementación en la empresa", "http://www.dynamicdrive.com/dynamicindex11/"]

//If you want the links to load in another frame/window, specify name of target (ie: target="_new")
var target=""

/////////////////////////////////////////////////////////

if (ie4||ns4||ns6){
	for (i=0;i<sitems.length;i++){
		if (sitems[i][1])
			document.write('<a href="'+sitems[i][1]+'" target="'+target+'" class="txtmenu">')
		document.write("&nbsp;&nbsp;"+sitems[i][0])
		if (sitems[i][1])
			document.write('</a>')
		document.write('<br><br>\n')
	}
}

function regenerate(){
	window.location.reload()
}
function regenerate2(){
	if (ns4){
		document.menu.left=((parseInt(slidemenu_width)-parseInt(slidemenu_reveal))*-1)
		document.menu.visibility="show"
		setTimeout("window.onresize=regenerate",400)
	}
}
window.onload=regenerate2

rightboundary=0
leftboundary=(parseInt(slidemenu_width)-parseInt(slidemenu_reveal))*-1

if (ie4||ns6){
	document.write('</div>')
	themenu=(ns6)? document.getElementById("menu2").style : document.all.menu2.style
}
else if (ns4){
	document.write('</layer>')
	themenu=document.layers.menu
}

function pull(){
	if (window.drawit)
		clearInterval(drawit)
	pullit=setInterval("pullengine()",10)
}
function draw(){
	clearInterval(pullit)
	drawit=setInterval("drawengine()",10)
}
function pullengine(){
	if ((ie4||ns6)&&parseInt(themenu.left)<rightboundary)
		themenu.left=parseInt(themenu.left)+10+"px"
	else if(ns4&&themenu.left<rightboundary)
		themenu.left+=10
	else if (window.pullit){
		themenu.left=0
	clearInterval(pullit)
}
}

function drawengine(){
	if ((ie4||ns6)&&parseInt(themenu.left)>leftboundary)
		themenu.left=parseInt(themenu.left)-10+"px"
	else if(ns4&&themenu.left>leftboundary)
		themenu.left-=10
	else if (window.drawit){
		themenu.left=leftboundary
	clearInterval(drawit)
}
}