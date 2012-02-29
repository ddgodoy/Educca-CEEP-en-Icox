
GENERIC_REDIRECTOR="{#url#}"
GET_CUSTOM_STYLESHEET="custom.css"
GET_PROJECT_STATE="Projects/{#project#}/project.xml"
GET_PROJECT_RESOURCE="Projects/{#project#}/{#resource#}"
function cacheURL(sURL){return sURL.replace(/\{#(.+?)#\}/g,function(sFullMatch,sName){var sValue=new RegExp("[\\?\\&]"+sName+"=([^\\&]+)").test(sURL)
return decodeURIComponent(RegExp.$1)}).replace(/\?.+$/,"")}
document.ProjectId="Res";