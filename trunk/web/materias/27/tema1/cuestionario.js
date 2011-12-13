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
resp=new Array("A la excelencia empresarial.","Al retro de definir el aprendizaje.","La comprensión de los temas teóricos y prácticos de la asignatura.","Al choque emocional de asumir un trabajo.","A las demandas de los grupos de interés en las actividades empresariales.")
corr=new Array("0","0","0","0","1")
comm=""
valu=""
quest001 = new Question(
"Question 1",
0,
"¿Qué entiende usted por el conflicto social moderno?:",
resp,
comm,
corr,
"",
valu,
1,
0,
0,
"");

resp=new Array("A la integración de los alumnos en la Sociedad Global.","A la enseñanza reglada.","A la enseñanza complementaria.","A los objetivos de formación.","El esfuerzo colectivo de sostenibilidad y búsqueda de la cohesión social.")
corr=new Array("0","0","0","0","1")
comm=""
valu=""
quest002 = new Question(
"Question 2",
0,
"¿Qué es la Identidad Corporativa y con que se relaciona?:",
resp,
comm,
corr,
"",
valu,
1,
0,
0,
"");

resp=new Array("El principio de la eficacia y de la eficiencia, y el de la unidad de objetivos.","El principio de la autoridad y el de la unidad de criterios.","El principio del poder de la empresa y de los jefes.","El principio de la jerarquía y de la autoridad de la dirección.","Ninguna es correcta.")
corr=new Array("0","0","0","0","1")
comm=""
valu=""
quest003 = new Question(
"Question 3",
0,
"¿Sobre qué dos principios se sustenta la Cultura Corporativa?:",
resp,
comm,
corr,
"",
valu,
1,
0,
0,
"");

resp=new Array("Principio de heteronomía empresarial  y de valores del Contrato.","Principio de interinidad o autonomía y de especialización empresarial.","Principio eventual por necesidades de producción y autonomía de los individuos.","La capacidad de resolver injusticias.","Un marco integrador de sus políticas y actuaciones con los clientes, accionistas, empleados y todos los grupos de interés con los que se relaciona.")
corr=new Array("0","0","0","0","1")
comm=""
valu=""
quest004 = new Question(
"Question 4",
0,
"Desarrolle qué es la ética empresarial en el contexto de las nuevas organizaciones.",
resp,
comm,
corr,
"",
valu,
1,
0,
0,
"");


resp=new Array("Intentar poner remedio a la crisis laboral y productiva.","Modificar la gestión de las remuneraciones.","Hacer más activos financieros.","Modificar el trabajo.","Actuar con trasparencia y  participación de los grupos de interés.")
corr=new Array("0","0","0","0","1")
comm=""
valu=""
quest005 = new Question(
"Question 5",
0,
"Dentro del campo teórico la Teoría del Stakeholder, ¿qué supone la ética empresarial?:",
resp,
comm,
corr,
"",
valu,
1,
0,
0,
"");


resp=new Array("Sanciones punitivas por su incumplimiento.","Medidas de control.","Comunicación constante y sin intermediarios de las empresas con  los proveedores.","Identificación, evaluación y reducción de los efectos negativos para la salud y la integridad física de las personas, favoreciendo medidas correctoras de efecto positivo.","Demandar y exigir a las empresas un compromiso con la sociedad y el medio ambiente y unas prácticas coherentes con ese compromiso.")
corr=new Array("0","0","0","0","1")
comm=""
valu=""
quest006 = new Question(
"Question 6",
0,
"Qué significa la presión de los grupos de interés:",
resp,
comm,
corr,
"",
valu,
1,
0,
0,
"");


resp=new Array("Es una herramienta que intenta integrar ciertos valores en la gestión empresarial ordinarias sobretodo de sus interlocutores o grupos de interés.","La capacidad de mantener relaciones sociales.","La capacidad de resolver injusticias.","Medir las potencialidades de que dispone la empresa.","Resolver problemas de difícil solución en un tiempo record.")
corr=new Array("1","0","0","0","0")
comm=""
valu=""
quest007 = new Question(
"Question 7",
0,
"¿Cuál es el comportamiento de la RSC en las empresas?:",
resp,
comm,
corr,
"",
valu,
1,
0,
0,
"");


resp=new Array("De forma utilitarista.","Las empresas cumplen con las exigencias normativas y voluntariamente invierten en capital humano, entorno y en las relaciones con los interlocutores o stakeholders.","Buscando las necesidades de las empresas.","Haciendo marketing con causa.","Estableciendo paradigmas de gestión de personal y clientes.")
corr=new Array("0","1","0","0","0")
comm=""
valu=""
quest008 = new Question(
"Question 8",
0,
"¿Cómo se desarrolla la RSC?:",
resp,
comm,
corr,
"",
valu,
1,
0,
0,
"");


resp=new Array("Responsabilizándose de los criterios de fabricante y reciclando los productos cuando acaba su vida útil.","Exigir a las autoridades políticas la aplicación a las empresas del cumplimiento de las normas internacionales.","Pedir sellos de calidad a las empresas.","No consumir productos de los países emergentes por la falta de garantías en el desempeño del producto.","Con la exigencia de que los productos o servicios sean funcionales y se atengan a las normas es suficiente.")
corr=new Array("1","0","0","0","0")
comm=""
valu=""
quest009 = new Question(
"Question 9",
0,
"¿Cómo cree que es la responsabilidad ética desde el punto de vista de los consumidores?:",
resp,
comm,
corr,
"",
valu,
1,
0,
0,
"");


resp=new Array("Mediante la utilización de la empresas, con aportaciones de trabajadores voluntarios.","Mediante un sello social que declarara como se compromete esa empresa en la comunidad.","Aportando bienes dinerarios al municipio.","Haciendo filantropía con los más necesitados.","Implicando a la empresa en el desarrollo de la localización mediante acciones de desarrollo sostenible.")
corr=new Array("0","0","0","0","1")
comm=""
valu=""
quest010 = new Question(
"Question 10",
0,
"Si tiene usted que preparar un Plan de RSC para un Municipio ¿cómo enfocarías el papel económico de las empresas de esa localización?:",
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
cachewrite("<html><head><title>Resultados</title><BASE target='_blank'><style type='text/css'><!--.interior { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }--></style></head><body bgcolor='#FFFFFF' leftmargin='0' topmargin='0' marginwidth='0' marginheight='0' onunload='javascript:window.opener.location.reload()'><table border=0 cellpadding=0 cellspacing=0 width='100%' background='../shared/imagenes/tope1.gif'><tr><td width='100%'><img src='../shared/imagenes/titulo_cuest.gif' width='142' height='33' alt='Cuestionario RSC'></td></tr></table><table width='100%' class='interior'><tr><td>",0)
now= new Date()
cachewrite("<small><p><img src='../shared/imagenes/clock.gif' width='10' height='10' hspace='5'>"+fill((now.getMonth()+1),2)+"/"+fill(now.getDate(),2)+"/"+now.getYear()+"&nbsp;&nbsp;"+fill(now.getHours(),2)+":"+fill(now.getMinutes(),2)+"</p>",0)
cachewrite("<h3><b>Resultados del Cuestionario Tema 1 RSC</b></h3><br><br>\n",0);
cachewrite("<b>Nombre: </b>\n"+opener.mm_apellido+", "+opener.mm_nombre,0);
if (udat.length>0) {
cachewrite("<b>Informacion</b><br>\n",0);
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
if (multi && questions[i].corrects!='') errore(questions[i].qname,"La opción  <i>"+questions[i].response[selection]+"</i>  no debería haberse seleccionado.",questions[i].explan)
}
if (questions[i].comment!="" && questions[i].comment[selection]!="")
mycomment+=((iscorrect || questions[i].corrects=='')?"<b>"+questions[i].qname+"</b><br>":"")+"<small>"+questions[i].comment[selection]+"</small><br>";
} else {
if (questions[i].corrects[selection]=="1") {
iswrong=true;
if (multi && questions[i].corrects!='') errore(questions[i].qname,"La opción  <i>"+questions[i].response[selection]+"</i>  debería haberse seleccionado.",questions[i].explan);
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
if (errori) cachewrite("</p><br><b>Has cometido "+errori+" "+(errori==1?"errores":"errores")+".</b>",10);
cachewrite("<br><b>Puntuación total: "+total+".</b><br>",10);

cachewrite("</small><hr noshade><center></tr></td></table><form>",10)
printest=(((navigator.appName=="Netscape") && (navigator.appVersion.charAt(0)>="4")) || (testIE5plus() == true))? "print()": "alert('This button can be used with Netscape Navigator 4 or Microsoft Internet Explorer 5 only. If you want to print with other browsers, please select the Print command in the File menu.')"
cachewrite("<a href='javascript:void(0)'><img src='../shared/imagenes/imprimir.gif' alt='Imprimir' width='89' height='27' border='0' onClick='"+printest+"'></a>",10)
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
