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
resp=new Array("Por pura filantropía.","Por un desafío no conformista de algunos empresarios y de otros como forma de obtener el reconocimiento y legitimación a su ascenso social.","Para la búsqueda la rentabilidad en las obras sociales y generadoras de nuevas inversiones productivas que desactivaran al Estado Liberal.","Por la necesidad de invertir en otros mercados meta.","Para obtener beneficios de las causas de la marginalidad y la discriminación social en demérito de las organizaciones de ayuda y salvación que entonces existían.")
corr=new Array("0","1","0","0","0")
comm=""
valu=""
quest001 = new Question(
"Question 1",
0,
"¿De que forma surgen los antecedes de la RSC?:",
resp,
comm,
corr,
"",
valu,
1,
0,
0,
"");

resp=new Array("En la década de los cincuenta en Estados Unidos.","En la década de los noventa en Estados Unidos.","En la década de los ochenta en Estados Unidos.","En la década de los setenta en Europa.","En la década de los cincuenta en Europa.")
corr=new Array("1","0","0","0","0")
comm=""
valu=""
quest002 = new Question(
"Question 2",
0,
"¿En que década surge la Responsabilidad Social Corporativa?:",
resp,
comm,
corr,
"",
valu,
1,
0,
0,
"");

resp=new Array("Romano Prodi.","Jaques Delors.","Jacques Santer.","José Manuel Durao Barroso.","Gaton Thorn.")
corr=new Array("0","1","0","0","0")
comm=""
valu=""
quest003 = new Question(
"Question 3",
0,
"¿Quién es el presidente de la Comisión Europea que impulsa la RSC?:",
resp,
comm,
corr,
"",
valu,
1,
0,
0,
"");

resp=new Array("En 1999 en la Cumbre de Davos.","En enero de 2002.","En la ONU en enero de 2004.","En Dayton en febrero de 2000.","En la Cumbre de Rio de Janeiro de 1992.")
corr=new Array("1","0","0","0","0")
comm=""
valu=""
quest004 = new Question(
"Question 4",
0,
"¿Cuándo se crea el Global Complact o Pacto Mundial?:",
resp,
comm,
corr,
"",
valu,
1,
0,
0,
"");


resp=new Array("La crisis del Estado del Bienestar.","Los escándalos financieros de los países desarrollados.","La falta de recursos par la integración de minorías étnicas.","La crisis circular empresarial delos años ochenta.","La falta de criterios fiscales de deducciones y subvenciones empresariales.")
corr=new Array("0","1","0","0","0")
comm=""
valu=""
quest005 = new Question(
"Question 5",
0,
"¿Cuál fue principal revulsivo para implantar la RSC en los países occidentales?:",
resp,
comm,
corr,
"",
valu,
1,
0,
0,
"");


resp=new Array("Si, por la importancia de la formación y la educación en la ciudadanía.","Ha servido para reforzar los vínculos de solidaridad y desarrollar la RSC política.","No han intervenido gran cosa en este suceso.","Si, por cuanto resultan ser vehículos de conocimiento de las singladuras de actuación de las empresas en los amplios márgenes de la sociedad global.","No, por cuanto no han desarrollado su presencia en los medios de comunicación social y de masas como la televisión.")
corr=new Array("1","0","0","0","0")
comm=""
valu=""
quest006 = new Question(
"Question 6",
0,
"¿Los procesos de información han supuesto un hito en el establecimiento de la RSC por parte de las autoridades políticas?:",
resp,
comm,
corr,
"",
valu,
1,
0,
0,
"");


resp=new Array("Es una magnifica manera de diferenciarse en un mercado competitivo complejo donde hay que focalizar la visión de la empresas con sus objetivos y búsqueda de resultados.","Es una manera de implicarse fiscalmente con los Estados.","No diferencia, pero tampoco perjudica los costes de oportunidad de negocio.","Sirve fundamentalmente para la publicidad empresarial.","Depende del sector empresarias que se encuentre la empresa y de su modelo de organización socio técnica u orgánica de gestión.")
corr=new Array("1","0","0","0","0")
comm=""
valu=""
quest007 = new Question(
"Question 7",
0,
"La RSC puede suponer una fuente de diferenciación importante para las empresas o por el contrario ¿es solamente una fuente de costes importes y sin utilidad?:",
resp,
comm,
corr,
"",
valu,
1,
0,
0,
"");


resp=new Array("En España si es obligatoria.","En España no es obligatoria, pero se precisa de certificación de renuncia a instituirla por los altos costes económicos que representa para las PYMES.","En Europa es obligatoria y las empresas se deben certificar con las normas internacionales de ISO u otras similares como la SA 8000.","En Europa no es obligatoria, pero se exige que las empresas que trabajan para la Administración Pública dele Estado tengan certificaciones.","En el mundo no es obligatoria, pero es recomendable certificarse con las normas de RSC.")
corr=new Array("0","0","0","0","1")
comm=""
valu=""
quest008 = new Question(
"Question 8",
0,
"¿La RSC es de obligado cumplimiento?:",
resp,
comm,
corr,
"",
valu,
1,
0,
0,
"");


resp=new Array("En la década de los noventa.","En la década de los ochenta.","En la primera del dos mil.","En la década de los setenta.","En los últimos dos años.")
corr=new Array("1","0","0","0","0")
comm=""
valu=""
quest009 = new Question(
"Question 9",
0,
"¿En que década se orientan definitivamente a las empresas hacia la responsabilidad social corporativa?:",
resp,
comm,
corr,
"",
valu,
1,
0,
0,
"");


resp=new Array("Los fondos de inversión en causas justas.","Las fundaciones, donde las empresas aportaban los fondos pero se desentendían de evaluar la gestión interna de la misma.","Las donaciones a las ONGs mediante la cesión de espacios para actividades y participación en campañas de concienciación.","La participación con entidades religiosas en proyectos humanos en el tercer mundo.","La necesidad de agrupar las inversiones en el inmovilizado inmaterial.")
corr=new Array("0","1","0","0","0")
comm=""
valu=""
quest010 = new Question(
"Question 10",
0,
"¿Qué antecedente da paso a la RSC por las empresas con criterios financieros?:",
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
cachewrite("<h3><b>Resultados del Cuestionario Tema 3: los antecedentes históricos de la RSC.</b></h3><br><br>\n",0);
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
if (errori) cachewrite("<br><b>Has cometido "+errori+" "+(errori==1?"errores":"errores")+".</b>",10);
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
