function Question (qname,
type,
qstring,
response,
comment,
corrects,
explan,
score,
ifcorrect,ifwrong,ifnull,
img)
{this.qname=qname;
this.type=type;
this.qstring=qstring;
this.response=response;
this.comment=comment;
this.corrects=corrects;
this.explan=explan;
this.score=score;
this.ifcorrect=ifcorrect;
this.ifwrong=ifwrong;
this.ifnull=ifnull;
this.img=img;
}
var total=0, mm_punt;
var zin=1,top=0, mycount=0, waitTime=0, qright=0, mycomment;
var global=new Array(5);
var recent, recent2, recdone=false, opera7, opera=CheckOpera56();
function cachewrite(s,idx){global[idx]+=s;}
function CheckOpera56()
{
var version;
if (navigator.userAgent.toLowerCase().indexOf('opera') == -1) return false;
version=parseInt(navigator.appVersion.toLowerCase());
if (version>6) {opera7=true; return false;}
if (version<5) return false;
return true;
}
resp=new Array("Si, en algunas circunstancias ese es el �nico par�metro del �xito organizativo de una empresa.","No solo la parte financiera, se espera de las compa��as que tengan un buen desempe�o en �mbitos tales como los derechos humanos, pol�ticas ambientales, desarrollo de la comunidad, gobierno corporativo o pr�cticas laborales.","Depende del sector empresarial, en las empresas del primer sector la parte financiera es lo m�s importante en su responsabilidad.","La garant�a de �xito estriba en las nuevas tecnol�gicas.","El �xito se mide por el respeto a las minor�as y su no discriminaci�n.")
corr=new Array("0","1","0","0","0")
comm=""
valu=""
quest001 = new Question(
"Question 1",
0,
"�Es el �xito financiero la �nica forma de emitir un juicio de valor sobre las empresas?:",
resp,
comm,
corr,
"",
valu,
1,
0,
0,
"");

resp=new Array("A tener en cuenta la por igual a las partes: econ�mica, social y ambiental, atendiendo a las demandas y expectativas de las partes interesadas.","Tener en cuenta las tres partes de la nueva econom�a global.","Intensificar la parte social, mediomabiental y de las nuevas tecnolog�as.","Aumentar la producci�n, el dominio de la energ�a y la evoluci�n cultural de la comunidad donde se inscribe la empresa para as� poder ser m�s competitivos.","Fundamentar un cambio de valores en la calidad, el medioambiente y los recursos humanos disponiendo de datos actualizados y revisados peri�dicamente en estas cuestiones.")
corr=new Array("1","0","0","0","0")
comm=""
valu=""
quest002 = new Question(
"Question 2",
0,
"�Qu� significa el concepto de triple cuenta de resultados?:",
resp,
comm,
corr,
"",
valu,
1,
0,
0,
"");

resp=new Array("En el plano de observar el desarrollo de los costes con la inversi�n responsable en filantrop�a social.","Mediante la inversi�n en causas justas y estableciendo un fin que justifique la RSC.","Estableciendo pr�cticas leales con la comunidad, transparentes en el manejo de sus finanzas y de inversiones socialmente responsables.","En la reducci�n de los costes laborales y su repercusi�n en derivar los excedentes a los fondos de las ONGs.","Estando supeditados al �contrato de cuentas en participaci�n� , articulo 239 y 240 de C.c.")
corr=new Array("0","0","1","0","0")
comm=""
valu=""
quest003 = new Question(
"Question 3",
0,
"�C�mo influye la RSC en la concienciaci�n econ�mica de la responsabilidad de las empresas?:",
resp,
comm,
corr,
"",
valu,
1,
0,
0,
"");

resp=new Array("RSE.","RS.","RSC.","SRC.","Ninguna es correcta.")
corr=new Array("0","1","0","0","0")
comm=""
valu=""
quest004 = new Question(
"Question 4",
0,
"�Con qu� siglas define la ISO a la responsabilidad social corporativa?:",
resp,
comm,
corr,
"",
valu,
1,
0,
0,
"");


resp=new Array("De 20 de mayo de 2000 -Definici�n y �mbito de la RSE-.","De 5 de noviembre de 2003 -Definici�n y �mbito de la RSE-.","De 20 de julio de 2005 -Definici�n y �mbito de la RSE-.","De 7 de octubre de 2001 -Definici�n y �mbito de la RSE-.","De 6 de diciembre de 1998 -Definici�n y �mbito de la RSE-.")
corr=new Array("0","0","1","0","0")
comm=""
valu=""
quest005 = new Question(
"Question 5",
0,
"�De cuando data el primer documento de RSE en Espa�a?:",
resp,
comm,
corr,
"",
valu,
1,
0,
0,
"");


resp=new Array("El gobierno espa�ol de Rodr�guez Zapatero.","Los gobiernos de la d�cada de los ochenta en que se produce la crisis circular empresarial.","Las organizaciones no gubernamentales y los sindicatos de trabajadores.","Las empresas multinacionales junto con los gobiernos europeos de forma individualizada.","La Comisi�n de las Comunidades Europeas que desarrolla el papel de promotor de la reflexi�n.")
corr=new Array("0","0","0","0","1")
comm=""
valu=""
quest006 = new Question(
"Question 6",
0,
"�Qui�n es el principal promotor de la RSC en Europa?:",
resp,
comm,
corr,
"",
valu,
1,
0,
0,
"");


resp=new Array("La RSC es el conjunto de pr�cticas empresariales abiertas y transparentes basadas en valores �ticos y en el respeto hacia los empleados, las comunidades y el ambiente.","La RSC se define como la administraci�n de un negocio de forma que cumpla o sobrepase las expectativas �ticas, legales, comerciales y p�blicas que tiene la sociedad frente a una empresa.","La RSC se refiere a una visi�n de los negocios que incorpora el respeto por los valores �ticos, las personas, las comunidades y el medio ambiente. La RSC es un amplio conjunto de pol�ticas, pr�cticas y programas integrados en la operaci�n empresarial que soportan el proceso de toma de decisiones y son premiados por la Administraci�n.","La RSC hace referencia a la manera en que la empresa integra valores sociales b�sicos con sus pr�cticas comerciales, operaciones y pol�ticas cotidianas.","La RSC es el compromiso que asume una empresa para contribuir al desarrollo econ�mico sostenible por medio de colaboraci�n con sus empleados, sus familias, la comunidad local y la sociedad, con el objeto de mejorar la calidad de vida.")
corr=new Array("0","0","0","0","1")
comm=""
valu=""
quest007 = new Question(
"Question 7",
0,
"�Cuales la definici�n que ofrece El Consejo Mundial para el Desarrollo Sostenible?:",
resp,
comm,
corr,
"",
valu,
1,
0,
0,
"");


resp=new Array("Este Foro esta compuesto por 30 expertos del Estado.","No existe en Espa�a dicho Foro de Expertos.","Este Foro de Expertos no existe en Espa�a aunque si existe el Foro de Expertos de la Asociaci�n Espa�ola de Direcci�n de Empresas FEADE.","Este Foro de Expertos elegido por las ONGs y las Asociaciones Empresariales esta compuesto por 34 expertos en la materia.","Este Foro esta compuesto por 34 expertos en la materia, junto a 11 representantes del Estado.")
corr=new Array("0","0","0","0","1")
comm=""
valu=""
quest008 = new Question(
"Question 8",
0,
"�Qui�nes forman el Foro de Expertos en Espa�a de RSC?:",
resp,
comm,
corr,
"",
valu,
1,
0,
0,
"");


resp=new Array("Al documento del �Definici�n y �mbito de la RSE� del Ministerio de Trabajo y Asuntos Sociales en el primer documento de 20 de julio de 2005.","A la �Comunicaci�n de la Comisi�n relativa a la responsabilidad social de las empresas: una contribuci�n empresarial al desarrollo sostenible�, de julio de 2002.","Al Informe de Progreso de la Organizaci�n Internacional de Estandarizaci�n �Working Report on Social Responsability� de 30 de abril de 2004.","Al informe �La responsabilidad social de las empresas y las normas internacionales del trabajo� de la OIT.","Al temario presentado de RSC por el Club de la Excelencia en Sostenibilidad para su aplicaci�n en empresas espa�olas.")
corr=new Array("0","0","0","1","0")
comm=""
valu=""
quest009 = new Question(
"Question 9",
0,
"�A que responde la nota informativa de noviembre de 2003 GB288/WP/SGD/3?:",
resp,
comm,
corr,
"",
valu,
1,
0,
0,
"");


resp=new Array("La RSC constituye un remedio a la posible y certidumbre eliminaci�n en Europa del Estado del Bienestar.","Supone una trasformaci�n del Estado del Bienestar por el Estado de las Empresas.","La RSC es una forma de establecer puentes entre las racionalizaciones econ�micas y sociales, desde la supervisi�n de una fuerte y estructurada Sociedad Civil.","Tiene relaci�n en base a los criterios de Calidad Total que demandan los Estados modernos.","Responde a un nuevo patr�n de ocio y trabajo de las econom�as occidentales.")
corr=new Array("0","0","1","0","0")
comm=""
valu=""
quest010 = new Question(
"Question 10",
0,
"Hasta que punto la RSC es producto del Estado del Bienestar:",
resp,
comm,
corr,
"",
valu,
1,
0,
0,
"");

questions = new Array (
quest001,quest002,quest003,quest004,quest005,quest006,quest007,quest008,quest009,quest010)

ventana = opener;

function doQuestion(quest)
{
var numdo;
var numord=eval(quest+1);
var i=-1, ii, type, myname, gadget;
type=questions[quest].type;
numdo=type>=11?1:questions[quest].response.length;
if (type<11) {
respcopy=new Array(numdo);corrcopy=new Array(numdo);
for (i=0; i<numdo; i++) respcopy[i]=questions[quest].response[i];
respcopy.sort(myrandom);
for (i=0; i<numdo; i++) {
for (ii=0; ii<numdo; ii++) {
if (respcopy[i]==questions[quest].response[ii]) {
corrcopy[i]=questions[quest].corrects[ii];break;}}}
questions[quest].response=respcopy;
questions[quest].corrects=corrcopy;}

document.writeln ("<a name=\""+questions[quest].qname+"\"></a>")
document.write("\n")
document.write("      <table width=\"470\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\n")
document.write("        <tr> \n")
document.write("          <td align=\"left\" valign=\"bottom\"> \n")
document.write("            <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n")
document.write("              <tr> \n")
document.write("                <td><img src=\"../shared/imagenes/cuestionario/s_table_up_sx.gif\" width=\"60\" height=\"22\"></td>\n")
document.write("                <td background=\"../shared/imagenes/cuestionario/s_table_up_bord.gif\" width=\"100%\"><img src=\"../shared/imagenes/cuestionario/s_table_up_bord.gif\" width=\"1\" height=\"22\"></td>\n")
document.write("                <td><img src=\"../shared/imagenes/cuestionario/s_table_up_dx.gif\" width=\"26\" height=\"22\"></td>\n")
document.write("              </tr>\n")
document.write("            </table>\n")
document.write("          </td>\n")
document.write("        </tr>\n")
document.write("        <tr> \n")
document.write("          <td> \n")
document.write("            <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" height=\"100%\">\n")
document.write("              <tr> \n")
document.write("                <td background=\"../shared/imagenes/cuestionario/s_table_sx_bord.gif\" align=\"right\" valign=\"top\"> \n")
document.write("                  <table width=\"42\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" height=\"37\" background=\"../shared/imagenes/cuestionario/s_table_num.gif\">\n")
document.write("                    <tr> \n")
document.write("                      <td height=\"37\" width=\"32\"> \n")
document.write("                        <div align=\"center\"><font face=\"Arial, Helvetica, sans-serif\"><b><font size=\"5\" color=\"#FFFFFF\">")
document.write(numord)
document.write(" \n")
document.write("                          </font></b></font></div>\n")
document.write("                      </td>\n")
document.write("                    </tr>\n")
document.write("                  </table>\n")
document.write("                </td>\n")
document.write("                <td width=\"100%\" bgcolor=\"F0F9FD\" align=\"left\" valign=\"top\">\n")
document.write("                  <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n")
document.write("                    <tr>\n")
document.write("                      <td colspan=\"2\">\n")
document.write("                        <table >\n")
document.write("                          ")
if (questions[quest].img!="") {
document.write("\n")
document.write("                          <td width=1>\n")
document.write("                            <img border=\"0\" src=\"")
document.write(questions[quest].img)
document.write("\">\n")
document.write("                          </td>\n")
document.write("                          ")
}
document.write("\n")
document.write("                          <td class=question valign=\"top\">\n")
document.write("                            ")
document.writeln(questions[quest].qstring)
document.write("\n")
document.write("                          </td>\n")
document.write("                        </table>\n")
document.write("                      </td>\n")
document.write("                    </tr>\n")
document.write("                    <tr height=10></tr>\n")
document.write("                    ")
for (i=0; i<numdo; i++) {
myname=questions[quest].qname;
gadget="radio";
if (type>=11) gadget="text";
else if (type==1) {
myname+="_"+(i<9?"0":"")+(i+1);
gadget="checkbox";}
document.write("\n")
document.write("                    <tr>\n")
document.write("                      <td width=\"1%\" valign=\"top\">")
document.write(type==7?"<textarea name=\""+myname+"\" rows=5 cols=30 class=\"input\">":" <input type="+gadget+" name=\""+myname);
if (type<11) document.write("\" value=\""+i+"\">\n")
else document.write(type==7?"</textarea>":"\" class=\"input\" value=\"\">\n")
document.write("</td>\n")
document.write("                      <td width=\"99%\" class=answer align=\"left\">")
if (type<11) document.write(questions[quest].response[i]);
document.write("</td>\n")
document.write("                    </tr>\n")
document.write("                    ")
}
document.write("\n")
document.write("                  </table>\n")
document.write("                 </td>\n")
document.write("                <td background=\"../shared/imagenes/cuestionario/s_table_dx_bord.gif\"><img src=\"../shared/imagenes/cuestionario/s_table_dx_bord.gif\" width=\"26\" height=\"1\"></td>\n")
document.write("              </tr>\n")
document.write("            </table>\n")
document.write("          </td>\n")
document.write("        </tr>\n")
document.write("        <tr> \n")
document.write("          <td> \n")
document.write("            <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n")
document.write("              <tr> \n")
document.write("                <td><img src=\"../shared/imagenes/cuestionario/s_table_dn_sx.gif\" width=\"42\" height=\"23\"></td>\n")
document.write("                <td background=\"../shared/imagenes/cuestionario/s_table_dn_bord.gif\" width=\"100%\"><img src=\"../shared/imagenes/cuestionario/s_table_dn_bord.gif\" width=\"1\" height=\"23\"></td>\n")
document.write("                <td><img src=\"../shared/imagenes/cuestionario/s_table_dn_dx.gif\" width=\"26\" height=\"23\"></td>\n")
document.write("              </tr>\n")
document.write("            </table>\n")
document.write("          </td>\n")
document.write("        </tr>\n")
document.write("      </table>\n")
document.write("	  <br>\n")
document.write("      ")
}
function doTest() {
var count, i;
questions.sort(myrandom);
for (i=0; i<questions.length; i++) {
questions[i].qname="Pregunta "+(i+1);}
count=questions.length;
for (i=0; i<count; i++) doQuestion(i);
}
function fill(s,l){
s=s+""
for (y=1;y<=l;y++)
if (s.length>=l) break; else s="0"+s;
return s
}
function CheckQName(wapf,ii,i,multi,selection){
var len;
if (!multi) return(wapf.elements[ii].name==questions[i].qname);
len=questions[i].qname.length;
if (wapf.elements[ii].name.substring(0,len)!=questions[i].qname) return false;
if (wapf.elements[ii].name.substring(len,len+1)!="_") return false;
if (eval(wapf.elements[ii].name.substring(len+1,len+3))==(selection+1)) return true;
return false;
}
function errore(uno,due,tre)
{
if (!errori) global[1]="<H3>Has cometido los siguientes errores:</H3>";
++errori;
cachewrite("<p><b><img src='../shared/imagenes/pregunta.gif' width='15' height='11'>"+uno+"</b><br>"+due+"<br>"+mycomment+tre+"</p><p class='txtblanco'",2);
mycomment="";
}
function testIE5plus(){
var pos=navigator.appVersion.lastIndexOf('MSIE ');
if (pos != -1) {
pos+=5;
if (eval(navigator.appVersion.charAt(pos))>4)
return true;}
return false;}
function correct(wapf)
{
var i, ii, t, re, tmp, selection, multi, multipage=0, type, isnull, iswrong, iscorrect, evaluation=0, udat;
errori=waitTime=0;
udat=new Array();
for (i=0, ii=0; i<wapf.elements.length; i++)
{tmp=wapf.elements[i];
if (tmp.name.substring(0,13)=="Quiz.UserData"){
t=tmp.name.substring(14,tmp.name.length);
re=new RegExp("_", "g");
t=t.replace(re," ");
udat[ii++]=t+": <i>"+tmp.value+"</i><br>";
if (opera) tmp.value="";}}
global[0]=global[2]="";
global[1]="<h3>Felicidades, has completado el cuestionario sin errores.</h3>";
cachewrite("<html><head><title>Resultados</title><BASE target='_blank'><style type='text/css'><!--.interior { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }--></style></head><body bgcolor='#FFFFFF' leftmargin='0' topmargin='0' marginwidth='0' marginheight='0' onunload='javascript:window.opener.location.reload();window.opener.setElapsedTime();'><table border=0 cellpadding=0 cellspacing=0 width='100%' background='../shared/imagenes/tope1.gif'><tr><td width='100%'><img src='../shared/imagenes/titulo_cuest.gif' width='142' height='33' alt='Cuestionario RSC'></td></tr></table><table width='100%' class='interior'><tr><td>",0)
now= new Date()
cachewrite("<small><p><img src='../shared/imagenes/clock.gif' width='10' height='10' hspace='5'>"+fill((now.getMonth()+1),2)+"/"+fill(now.getDate(),2)+"/"+now.getYear()+"&nbsp;&nbsp;"+fill(now.getHours(),2)+":"+fill(now.getMinutes(),2)+"</p>",0)
cachewrite("<h3><b>Resultados del Cuestionario Tema 2: Concepto de RSC.</b></h3><br><br>\n",0);
cachewrite("<b>Nombre: </b>\n"+opener.mm_apellido+", "+opener.mm_nombre,0);
if (udat.length>0) {
cachewrite("<b>Information</b><br>\n",0);
for (i=0; i<udat.length; i++) cachewrite(udat[i],0);}
if (opera7 && multipage) {
for (i=0; i<questions.length; i++) {
id=document.getElementById("q"+(i+1));
id2=document.getElementById("q"+(i+1)+"a");
id.style.display=id2.style.display="block";}}

for (i=0; i<questions.length; i++) {
if (opera && multipage) {
id=document.getElementById("q"+(i+1));
id2=document.getElementById("q"+(i+1)+"a");
id.style.visibility=id2.style.visibility="visible";}
type=questions[i].type;
if (type==1) multi=1;
else multi=0;
isnull=true;
iscorrect=false;iswrong=false;
selection=0;
evaluation=0;
mycomment="";
for (ii=0; ii<wapf.elements.length; ii++) {
if (CheckQName(wapf,ii,i,multi,selection)) {
if (type>=11 && wapf.elements[ii].value!="") {
isnull=false;
if (wapf.elements[ii].value.toLowerCase()==questions[i].corrects.toLowerCase()) iscorrect=true;
else iswrong=true;
++selection;}
else if (wapf.elements[ii].checked) {
if (questions[i].score!="") evaluation+=questions[i].score[selection];
if (isnull) isnull=false;
if (questions[i].corrects[selection]=="1") iscorrect=(iswrong==false)?true:false;
else {
iswrong=true;
if (multi && questions[i].corrects!='') errore(questions[i].qname,"La opci�n  <i>"+questions[i].response[selection]+"</i>  no deber�a haberse seleccionado.",questions[i].explan)
}
if (questions[i].comment!="" && questions[i].comment[selection]!="")
mycomment+=((iscorrect || questions[i].corrects=='')?"<b>"+questions[i].qname+"</b><br>":"")+"<small>"+questions[i].comment[selection]+"</small><br>";
} else {
if (questions[i].corrects[selection]=="1") {
iswrong=true;
if (multi && questions[i].corrects!='') errore(questions[i].qname,"La opci�n  <i>"+questions[i].response[selection]+"</i>  deber�a haberse seleccionado.",questions[i].explan);
}}
++selection;
}}
if (multi==false && (isnull || iswrong)) {
var okresp="", z;
if (type>=3) okresp=questions[i].corrects;
else {
for (z=0; z<questions[i].corrects.length; z++) {
if (questions[i].corrects[z]==1) {
okresp=questions[i].response[z];
break;
}}}
if (okresp!="") errore(questions[i].qname,"La respuesta correcta era <i>"+okresp+".</i>",questions[i].explan);
}
if (mycomment!="") cachewrite(mycomment,2);
if (questions[i].corrects!="") ++qright;
if (isnull) evaluation+=questions[i].ifnull;
else if (iswrong) evaluation+=questions[i].ifwrong;
else if (iscorrect) evaluation+=questions[i].ifcorrect;
total+=evaluation;}
if (qright==0) global[1]="<br>";
if (errori) cachewrite("<br><b>Has cometido "+errori+" "+(errori==1?"errores":"errores")+".</b>",10);
cachewrite("<br><b>Puntuaci�n total: "+total+".</b><br>",10);

cachewrite("</small><hr noshade><center></tr></td></table><form>",10)
printest=(((navigator.appName=="Netscape") && (navigator.appVersion.charAt(0)>="4")) || (testIE5plus() == true))? "print()": "alert('This button can be used with Netscape Navigator 4 or Microsoft Internet Explorer 5 only. If you want to print with other browsers, please select the Print command in the File menu.')"
cachewrite("<a href='javascript:void(window."+printest+")'><img src='../shared/imagenes/imprimir.gif' alt='Imprimir' width='89' height='27' border='0'></a>",10)
cachewrite("</form></center>",10)
cachewrite(aknw,10)
winr=window
for (i=0; i<11; i++) winr.document.write(global[i]);winr.document.close()
if ((opera || opera7) && multipage) {
document.forms[0].elements[0].value='Print...';
//document.forms[0].elements[1].value='Back';
for (i=0; i<questions.length-1; i++) {
id=document.getElementById("q"+(i+1));
id2=document.getElementById("q"+(i+1)+"a");
opera?id.style.visibility=id2.style.visibility="hidden":id.style.display=id2.style.display="none";}}

mm_punt = total;
opener.start_interacting(mm_punt);

}
aknw=""

function myrandom(a,b)
{
var rc;
do {rc=Math.floor(Math.random()*11)-1;} while (rc==10);
return(rc);
}
