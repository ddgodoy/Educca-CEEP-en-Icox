var oConfig=document.createElement("xml")
onload=function(){if(location.href.indexOf("http")==0||navigator.platform.substr(0,3)!="Win"){httpLoader("GET",cacheURL("Content/"+GET_PROJECT_STATE+"?readonly=1&project="+encodeURIComponent(document.ProjectId)),projectLoaded)}else{document.getElementById("loginHolder").innerHTML="<p>Por favor utilice <em>run.hta</em> para comenzar este curso desde el sistema de ficheros.</p><p><em>run.html</em> debe utilizarse sólo con un servidor web; o en una plataforma no Windows.</p>"}}
function projectLoaded(oXH){oConfig.loadXML(oXH.responseText)
var oXML=oConfig
if(oXML.firstChild){oXML=oXML.firstChild
try{top.document.title+=" - "+oXML.getAttribute("title");}catch(oErr){}
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
if(oXML.getAttribute("tracking")=="true"){oTrack.style.display="block"
oTrack.onclick=tracking
if(oXML.getAttribute("courseMode")=="web"){oTrackForm.action="../Track/report.asp?p="+encodeURIComponent(oXML.getAttribute("publicId"))}
if(/[?&]track($|&)/i.test(location.search)){tracking()}else{if(bAutoOpen)openProject()}}else{if(bAutoOpen)openProject()}}else{alert("Proyecto no encontrado.")}
oXML=null}
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