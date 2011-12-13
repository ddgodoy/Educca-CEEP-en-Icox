
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

function refrescaSelect(num) {
	document.getElementById('selnum').selectedIndex=num-1;
}

if (ie4||ns6)
document.write('<div id="menu2" style="left:'+((parseInt(slidemenu_width)-parseInt(slidemenu_reveal))*-1)+'px; top:'+slidemenu_top+'; width:'+slidemenu_width+'" onMouseover="pull()" onMouseout="draw()"><img src="../shared/imagenes/topindice.gif" alt="Indice" width="222" height="28" /><BR><br>')
else if (ns4){
document.write('<style>\n#menu{\nwidth:'+slidemenu_width+';}\n<\/style>\n')
document.write('<layer id="menu" left=0 top='+slidemenu_top+' width='+slidemenu_width+' onMouseover="pull()" onMouseout="draw()" visibility=hide><img src="../shared/imagenes/topindice.gif" alt="Indice" width="222" height="28" /><BR><br>')
}

var sitems=new Array()

///////////Edit below/////////////////////////////////

//siteitems[x]=["Item Text", "Optional URL associated with text"]

sitems[0]=["1. La RSC en España", "javascript: pagecontent.showpage(0); refrescaSelect(1);"]
sitems[1]=["2. La evolución española en la RSC", "javascript: pagecontent.showpage(3); refrescaSelect(4);"]
sitems[2]=["3. Situación de la RSC en los países", "javascript: pagecontent.showpage(6); refrescaSelect(7);"]
sitems[3]=["4. Normas básicas de la RSC", "javascript: pagecontent.showpage(9); refrescaSelect(10);"]

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