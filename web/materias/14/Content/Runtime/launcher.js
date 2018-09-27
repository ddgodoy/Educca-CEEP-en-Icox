var oConfig=getXMLDocument()
if(location.href.indexOf("http")==0||navigator.platform.substr(0,3)!="Win"||isTestSuite()){httpLoader("GET",cacheURL("Content/"+GET_PROJECT_STATE+"?readonly=1&project="+encodeURIComponent(document.ProjectId)),projectLoaded)}else{document.body.className="loaded"
document.getElementById("loginHolder").innerHTML="<p>Por favor utilice <em>run.hta</em> para comenzar este curso desde el sistema de ficheros.</p><p><em>run.html</em> debe utilizarse sólo con un servidor web, o en una plataforma no Windows.</p>"}
function isTestSuite(){try{if(top.opener&&top.opener.location.pathname.toLowerCase().indexOf("/testsuite/")>-1)return true}catch(e){return false;}}
function projectLoaded(oXH){oConfig.loadXML(oXH.responseText)
var oXML=oConfig
if(oXML.firstChild){oXML=oXML.firstChild
try{top.document.title=oXML.getAttribute("title");}catch(oErr){}
var bAutoOpen=oXML.getAttribute("manualStart")!="true",winType=oXML.getAttribute("windowType")||""
courseTitle.innerText=oXML.getAttribute("title")
if(oXML.getAttribute("description")){courseDesc.style.display="block"
courseDesc.innerText=oXML.getAttribute("description")}
loginSubmit.winHeight=oXML.getAttribute("windowHeight")||600
loginSubmit.winWidth=oXML.getAttribute("windowWidth")||800
loginSubmit.winResizable=oXML.getAttribute("windowResizable")=="true"?"1":"0"
loginSubmit.winMax=winType=="max"
loginSubmit.noWin=winType.indexOf("current")>-1
loginSubmit.onclick=openProject
var sBackend=oXML.getAttribute("runtimeBackend")
if(sBackend&&oXML.getAttribute("blogIndex")){var oScript=document.createElement("script")
oScript.setAttribute("type","text/javascript")
oScript.setAttribute("src",sBackend+"launch.js")
document.body.appendChild(oScript)
backendFound.xml=oXML}
if(oXML.getAttribute("tracking")=="true"){oTrack.style.display="block"
oTrack.onclick=tracking
if(oXML.getAttribute("courseMode")=="web"){oTrackForm.action="../Track/report.asp?p="+encodeURIComponent(oXML.getAttribute("publicId"))}
if(/[?&]track($|&)/i.test(location.search)){tracking()}else{if(bAutoOpen)openProject()}}else{if(bAutoOpen)openProject()}
if(!loginSubmit.noWin||!bAutoOpen)document.body.className="loaded"}else{alert("Proyecto no encontrado.")}
oXML=null}
function backendFound(){var oXML=backendFound.xml
oBlogsIndexHolder.style.display="block"
if(oModerate&&oXML.getAttribute("hasModeration")=="true"){var sBackend=oXML.getAttribute("runtimeBackend")
sURL=sBackend+"mod.asp?i="+encodeURIComponent(oXML.getAttribute("publicId"))
if(/[?&]moderate($|&)/i.test(location.search)){location.href=sURL
return}else oModerate.innerHTML='<a href="'+sURL.replace(/\"/g,"")+'" target="_blank">Índice de Moderación</a>'
oModerate.style.display="block"}
backendFound.xml=null}
function tracking(){oMain.style.display="none"
oTrackForm.style.display="block"
oTrack.style.display="none"}
function validate(form){if(!form.password.value){alert("¡Se requiere contraseña!")
return false}
return true}
function openProject(){if(loginSubmit.noWin){location.replace("Content/scaler.html")}else{var iWidth=loginSubmit.winWidth*1,iHeight=loginSubmit.winHeight*1
if(!openProject.win||openProject.win.closed){var iDefaultCaption=25
if(/Windows NT (\d+(\.\d+)?)/.test(navigator.userAgent)&&+RegExp.$1>=5.1)iDefaultCaption=30
var sAdd=""
if(loginSubmit.winMax)sAdd="fullscreen=1,"
openProject.win=window.open("Content/scaler.html","courseWin",sAdd+"top="+Math.round((screen.availHeight-iHeight)/2-iDefaultCaption)+",left="+Math.round((screen.availWidth-iWidth)/2-6)+",location=0,resizable="+loginSubmit.winResizable+",status=0,width="+iWidth+",scrollbars=1,height="+iHeight)}else{openProject.win.focus()}}}