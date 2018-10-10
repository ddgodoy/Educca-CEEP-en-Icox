/*@cc_on @*/
function switchEmbeds(oEl,sState,bKill){var aEmbeds=oEl.tagName=="EMBED"?[oEl]:oEl.getElementsByTagName("embed"),aStates={on:["Play","PlayMovie"],off:["Stop","StopMovie","StopPlay","Rewind"]}[sState]
;/*@if(!@_jscript)@*/ //Avoid calling Rewind when forcing kill(emulation only)
if(bKill&&sState=="off")aStates.length--
;/*@end @*/
for(var iEmbed=0;iEmbed<aEmbeds.length;iEmbed++){var oEmbed=aEmbeds[iEmbed],bSuccess=false
if(sState=="off"||oEmbed.parentNode.currentStyle.display!="none"){for(var iCall=0;iCall<aStates.length;iCall++){try{oEmbed[aStates[iCall]]()
bSuccess=true}catch(e){}}}
;/*@if(!@_jscript)@*/ //(emulation only)
if(bKill){oEmbed.style.display="none"
oEmbed.offsetWidth}
else if(!bSuccess&&oEmbed.comptype=="media"){oEmbed.autoStart=sState=="on"?"1":"0"
setTimeout(function(){oEmbed.style.display="none"
oEmbed.offsetWidth
oEmbed.style.display=""},0)}
;/*@end @*/}}