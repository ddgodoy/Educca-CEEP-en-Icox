/*@cc_on @*/
var Providers
Providers={set:function(providerName,oEl){this.current=this[providerName]
oEl.innerHTML=this.current.create()
this.current.engine=oEl.firstChild
return this.current},get:function(){return this.current},detect:function(fileName,oEl){if(!fileName)return
var sExt=fileName.replace(/\?.*/,"").replace(/.+\.([^\.]+)$/,"$1").toLowerCase(),provider="WMP"
switch(sExt){case"flv":provider="SWF"
break
case"mov":case"qt":provider="MOV"
break
case"ra":case"rm":case"ram":provider="REAL"
break
case"mp3":if(this.SWF.installed()){provider="SWF"
break}
default:if(this.WMP.installed())provider="WMP"
else if(this.WMP6.installed())provider="WMP6"
else if(this.REAL.installed())provider="REAL"}
if(oEl)provider=this.set(provider,oEl)
return provider},WMP:{name:"WMP",installed:function(){;/*@if(@_jscript)
try{new ActiveXObject("WMPlayer.OCX");return true;}catch(e){return false;}
;/*@else @*/
return!!navigator.mimeTypes["application/x-ms-wmp"]
;/*@end @*/},create:function(){;/*@if(@_jscript)
return'<object classid="clsid:6BF52A52-394A-11D3-B153-00C04F79FAA6"><param name="stretchToFit" value="true"><param name="uiMode" value="none"></object>'
;/*@else @*/
return'<embed type="application/x-ms-wmp" stretchToFit="true" uiMode="none">'
;/*@end @*/},play:function(){this.engine.controls.play();this.playPressed=true;},pause:function(){this.engine.controls.pause();},stop:function(){this.engine.controls.stop();},close:function(){this.playPressed=false
this._ignorePlayState=null
this._loaded=false
this._lastBuff=null
this.listenPlayState(null)
this.stop()
this.setFile("")},isInteractive:function(){return typeof(this.engine.playState)=="number"},isLoaded:function(){if(this.getFile()&&this._loaded&&this.engine.openState==13){if(!this.getAutoStart()&&this.getTime()<=0)this.setTime(0)
return true}
return false},_stateMap:{1:"stop",2:"pause",3:"play"},getState:function(){return((this.getAutoStart()||this._loaded)&&this._stateMap[this.engine.playState])||"unknown";},getTime:function(){return this.engine.controls.currentPosition;},setTime:function(time){this.engine.controls.currentPosition=time;},getBufferedTime:function(){if(this.getState()!="unknown"){var iBuff=Math.max(-1,this.getDuration()*this.engine.network.downloadProgress/100)
if(iBuff!=0)this._lastBuff=iBuff}
return this._lastBuff||-1},isSeekable:function(){return this.getDuration()>-1;},getFile:function(){return this.engine.URL;},setFile:function(fileName){this._loaded=true
this.engine.URL=fileName
if(fileName){this._loaded=false
this.removeListener("OpenStateChange")
var oProv=this
this.addListener("OpenStateChange",function(){if(this.error.errorCount>0){var sNewFile=decodeURIComponent(fileName)
if(sNewFile!=fileName){this.error.clearErrorQueue()
setTimeout(function(){oProv.setFile(sNewFile);},100)
return oProv.removeListener("OpenStateChange")}else{return oProv.removeListener("OpenStateChange");}}
if(this.openState==13){var fHnd=arguments.callee
if(oProv.getTime()>0){if(!oProv.playPressed&&!oProv.getAutoStart()){oProv.pause()
oProv.setTime(0)}
oProv.setVolume(iVol)
oProv._loaded=true
clearInterval(fHnd._loadWaiter)
fHnd._loadWaiter=null
this.style.visibility=""
if(this.playStateHandler)this.playStateHandler("",oProv.getState())}else if(!arguments.callee._loadWaiter){var oEng=this
fHnd._loadWaiter=setInterval(function(){fHnd.call(oEng);},1)}
oProv.removeListener("OpenStateChange")}})
var iVol=this.getVolume()
this.setVolume(0)
this._ignorePlayState=true;
this.engine.style.visibility="hidden"
this.engine.controls.play()}},getVolume:function(){return this.engine.settings.volume;},setVolume:function(pct){this.engine.settings.volume=pct;},getWidth:function(){return this.engine.currentMedia.imageSourceWidth;},getHeight:function(){return this.engine.currentMedia.imageSourceHeight;},getDuration:function(){return this.getFile()&&this.engine.currentMedia.duration?this.engine.currentMedia.duration:-1;},getAutoStart:function(){return this.engine.settings.autoStart;},setAutoStart:function(autoStart){this.engine.settings.autoStart=autoStart;},getContextMenu:function(){return this.engine.enableContextMenu;},setContextMenu:function(ctxMenu){this.engine.enableContextMenu=ctxMenu;},needsVideoDelay:function(){return/*@!@_jscript&&@*/ true; },  //Firefox needs a second to catch its breath
addListener:function(name,handler){if(!("handle"+name in this.engine)){;/*@if(@_jscript)
var id=this.engine.uniqueID,oScr=oDoc.createElement('<script id="listener'+id+'" defer for="'+id+'" event="'+name+'">')
oScr.text="try { "+id+"['handle"+name+"'](); } catch (e) {}"
element.appendChild(oScr)
;/*@else @*/
var oPrv=this,oEng=this.engine,sEvent="OnDS"+name+"Evt",fPrevHandler=window[sEvent]
window[sEvent]=function(){if(oEng["handle"+name])oEng["handle"+name]()
if(fPrevHandler)fPrevHandler()}
;/*@end @*/}
this.engine["handle"+name]=handler},removeListener:function(name){if(this.engine["handle"+name]){this.engine["handle"+name]=null
;/*@if(@_jscript)
var id="listener"+this.engine.uniqueID
if(window[id])window[id].outerHTML=""
try{delete this.engine["handle"+name];}catch(e){}
;/*@end @*/}},listenPlayState:function(handler){if(!("playStateHandler"in this.engine)){var oPrv=this
this.addListener("PlayStateChange",function(){if(this.playStateHandler&&!oPrv._ignorePlayState)this.playStateHandler("",oPrv.getState())
else oPrv._ignorePlayState=null})}
this.engine.playStateHandler=handler}},WMP6:{name:"WMP6",installed:function(){;/*@if(@_jscript)
try{new ActiveXObject("MediaPlayer.MediaPlayer");return true;}catch(e){return false;}
;/*@else @*/
return false
;/*@end @*/},create:function(){return'<embed showcontrols="false" comptype="media" type="application/x-mplayer2" pluginspage="http://microsoft.com/windows/mediaplayer/en/download/">'},play:function(){this.engine.Play();},pause:function(){this.engine.Pause();},stop:function(){this.engine.Stop();},close:function(){this.listenPlayState(null)
this.stop()
this.setFile("")
this.engine.Cancel()
this.engine.FileName=""},isInteractive:function(){return typeof(this.engine.ReadyState)=="number";},isLoaded:function(){if(this.getFile()&&(!this.engine.HasError||this.handledError)&&this.engine.openState==6){if(!this.getAutoStart()&&this.getTime()<=0)this.setTime(0)
return true}else if(this.engine.HasError&&!this.handledError){this.handledError=true
this.setFile(decodeURIComponent(this.getFile()))}
return false},_stateMap:["stop","pause","play","pause"],getState:function(){return this._stateMap[this.engine.PlayState]||"pause";},getTime:function(){return this.engine.CurrentPosition;},setTime:function(time){this.engine.CurrentPosition=time;},isSeekable:function(){return this.engine.CanSeek;},getFile:function(){return this._fileName;},setFile:function(fileName){this._fileName=fileName;this.engine.Open(fileName);},getVolume:function(){return this._volume==undefined?75:this._volume;},setVolume:function(pct){this._volume=pct
this.engine.Volume=Math.log(pct*1000+1)*868.588209364143-10000},getWidth:function(){return this.engine.ImageSourceWidth;},getHeight:function(){return this.engine.ImageSourceHeight;},getDuration:function(){return this.getFile()&&this.engine.IsDurationValid&&this.engine.Duration?this.engine.Duration:-1;},getAutoStart:function(){return this.engine.AutoStart;},setAutoStart:function(autoStart){this.engine.AutoStart=autoStart;},getContextMenu:function(){return this.engine.EnableContextMenu;},setContextMenu:function(ctxMenu){this.engine.EnableContextMenu=ctxMenu;},listenPlayState:function(handler){if(!("playStateHandler"in this.engine)){var id=this.engine.uniqueID,oScr=oDoc.createElement('<script defer for="'+id+'" event="PlayStateChange(oldState,newState)">')
if(!window.WMP6States)window.WMP6States=this._stateMap
oScr.text="try { "+id+".playStateHandler(WMP6States[oldState],WMP6States[newState]); } catch (e) {}"
element.appendChild(oScr)}
this.engine.playStateHandler=handler}},SWF:{name:"SWF",installed:function(){;/*@if(@_jscript)
try{new ActiveXObject("ShockwaveFlash.ShockwaveFlash");return true;}catch(e){return false;}
;/*@else @*/
return!!navigator.plugins["Shockwave Flash"]
;/*@end @*/},create:function(){var sId="SWFMPlayer"+new Date().getTime()+Math.round(Math.random()*Math.pow(10,10))
return'<embed comptype="flash" id="'+sId+'" src="Runtime/mplayer.swf" quality="best" type="application/x-shockwave-flash" allowFullScreen="true" pluginspage="http://www.macromedia.com/go/getflashplayer">'},play:function(){this._cmd("play")
this._fireState("play")},pause:function(){this._cmd("pause")
this._fireState("pause")},stop:function(){this._cmd("stop")
this._fireState("stop")
this._state="init"},close:function(){this.inited=false
this.isSeeking=false
this.pause()
this.listenPlayState(null)
this.setFile("")
this._state="init"},isInteractive:function(){try{return this.engine.GetVariable("duration")!=undefined;}catch(e){return false;}},isLoaded:function(){var sFile=this.getFile(),bMP3=/\.mp3$/i.test(sFile)
if(bMP3)try{return this.getFile()&&this.engine.GetVariable("progress")>0;}catch(e){return false;}
else try{return this.getFile()&&this.getWidth()>0;}catch(e){return false;}},_state:"init",getState:function(){return this._state;},_fireState:function(state){var oldState=this._state
this._state=state
if(this.engine.playStateHandler)this.engine.playStateHandler(oldState,state)},getTime:function(){return+this.engine.GetVariable("time");},setTime:function(time){this.isSeeking=true
this._cmd("seek","time",time)},getBufferedTime:function(){return Math.max(-1,this.getDuration()*this.engine.GetVariable("progress"));},isSeekable:function(){return this.getDuration()>-1;},getFile:function(){return this._fileName||"";},setFile:function(fileName){if(fileName.indexOf(":/")==-1&&fileName.charAt(0)!="/")fileName=location.href.replace(/[^\/\\]*$/,fileName);
this._cmd("updateProp","url",fileName)
this._fileName=fileName},getVolume:function(){return this._volume||75;},setVolume:function(pct){this._cmd("updateProp","volume",pct)
this._volume=pct},getWidth:function(){return+this.engine.GetVariable("flvWidth");},getHeight:function(){return+this.engine.GetVariable("flvHeight");},getDuration:function(){return+this.engine.GetVariable("duration");},getAutoStart:function(){return this._autoStart||false;},setAutoStart:function(autoStart){this._cmd("updateProp","autoPlay",autoStart)
this._autoStart=autoStart
if(this._autoStart)this._fireState("play")},getContextMenu:function(){return this.engine.Menu;},setContextMenu:function(ctxMenu){this.engine.Menu=ctxMenu;},listenPlayState:function(handler){this.engine.playStateHandler=handler},init:function(){var provider=this,oXML=oDoc.createElement("xml")
this.engine.processCommand=function(sXML){oXML.loadXML(sXML)
if(oXML.firstChild){var sCommand=oXML.firstChild.getAttribute("name").replace(/^[a-z]/,function(match){return match.toUpperCase();})
if(provider["_fire"+sCommand])provider["_fire"+sCommand](oXML)}}
var sId=this.engine.id
;/*@if(@_jscript)
var oScr=oDoc.createElement('<script defer for="'+sId+'" event="FSCommand(sCommand,sArg)">')
oScr.text=sId+".processCommand(sCommand,sArg);"
element.appendChild(oScr)
;/*@else @*/
window[sId+"_DoFSCommand"]=function(sCommand,sArg){provider.engine.processCommand(sCommand,sArg)}
;/*@end @*/
this.inited=true},_cmd:function(command,arg,argValue){var sArg=""
if(arg){if(argValue==null)argValue=""
sArg='<'+arg+'>'+argValue+'</'+arg+'>'}
this.engine.SetVariable("gm.In.call",'<command name="'+command+'">'+sArg+'</command>')},_firePause:function(){this.stop()},_fireSeek:function(oXML){this.isSeeking=false
this._fireState("play")}},MOV:{name:"MOV",create:function(){return'<embed controller="false" showlogo="false" enablejavascript="true" scale="tofit" comptype="quicktime" type="video/quicktime" pluginspage="http://www.apple.com/quicktime/download/">'},play:function(){this.engine.Play()
this._fireState("play")},pause:function(){this.engine.Stop()
this._fireState("pause")},stop:function(){this.engine.Stop()
this.engine.Rewind()
this._fireState("stop")},close:function(){this.inited=false
this.listenPlayState(null)
this.stop()
this.setFile("")
this._state="init"},isInteractive:function(){try{this.engine.GetQuickTimeVersion();return true;}catch(e){return false;}},isLoaded:function(){var state=this.engine.GetPluginStatus()
return this.getFile()&&(state=="Playable"||state=="Complete")},_state:"init",getState:function(){return this._state;},_fireState:function(state){var oldState=this._state
this._state=state
if(this.engine.playStateHandler)this.engine.playStateHandler(oldState,state)},getTime:function(){if(this.engine.GetTime()>=this.engine.GetDuration())this.stop()
return this.engine.GetTime()/this.engine.GetTimeScale()},setTime:function(time){this.engine.SetTime(time*this.engine.GetTimeScale())
this.play()},getBufferedTime:function(){return Math.max(-1,this.engine.GetMaxTimeLoaded()/this.engine.GetTimeScale());},isSeekable:function(){return this.getDuration()>-1;},getFile:function(){return this._fileName;},setFile:function(fileName){this._fileName=fileName
this.engine.SetURL(fileName)},getVolume:function(){return this._volume==undefined?75:this._volume;},setVolume:function(pct){this._volume=pct
this.engine.SetVolume(pct*255/100)},getWidth:function(){return 320;},getHeight:function(){return 240;},getDuration:function(){return this.getFile()&&this.engine.GetDuration()?this.engine.GetDuration()/this.engine.GetTimeScale():-1;},getAutoStart:function(){return this.engine.GetAutoPlay();},setAutoStart:function(autoStart){this.engine.SetAutoPlay(autoStart)
if(autoStart)this._fireState("play")},getContextMenu:function(){},setContextMenu:function(ctxMenu){},listenPlayState:function(handler){this.engine.playStateHandler=handler},init:function(){this.engine.SetResetPropertiesOnReload(false)
this.inited=true}},REAL:{name:"REAL",installed:function(){;/*@if(@_jscript)
try{new ActiveXObject("rmocx.RealPlayer G2 Control");return true;}catch(e){return false;}
;/*@else @*/
return!!navigator.plugins["RealPlayer Version Plugin"]
;/*@end @*/},create:function(){return'<embed pluginspage="http://www.real.com/freeplayer/?rppr=rnwk" type="audio/x-pn-realaudio-plugin" controls="ImageWindow" scriptcallbacks="All">'},play:function(){this.engine.DoPlay();this._fireState("play");},pause:function(){this.engine.DoPause();this._fireState("pause");},stop:function(){this.engine.DoStop();this._fireState("stop");},close:function(){this.listenPlayState(null)
this.stop()
this.setFile("")
this._state="init"},isInteractive:function(){try{this.engine.GetVersionInfo();return true;}catch(e){return false;}},isLoaded:function(){return this.getFile()&&(this.engine.CanPlay()||this.engine.GetPlayState()==3);},_state:"init",getState:function(){return this._state;},_fireState:function(state){var oldState=this._state
this._state=state
if(this.engine.playStateHandler)this.engine.playStateHandler(oldState,state)},getTime:function(){if(this.engine.GetPosition()>=this.engine.GetLength())this._fireState("stop");return this.engine.GetPosition()/1000;},setTime:function(time){this.engine.SetPosition(time*1000);},isSeekable:function(){return this.engine.GetCanSeek();},getFile:function(){return this._fileName;},setFile:function(fileName){this._fileName=fileName;if(fileName)this.engine.SetSource(fileName);},getVolume:function(){return this.engine.GetVolume();},setVolume:function(pct){this.engine.SetVolume(pct);},getWidth:function(){return 320;},getHeight:function(){return 240;},getDuration:function(){return this.engine.GetLength()/1000||-1;},getAutoStart:function(){return this.engine.GetAutoStart();},setAutoStart:function(autoStart){this.engine.SetAutoStart(autoStart);if(autoStart)this._fireState("play");},getContextMenu:function(){return this.engine.GetEnableContextMenu();},setContextMenu:function(ctxMenu){this.engine.SetEnableContextMenu(ctxMenu);},listenPlayState:function(handler){this.engine.playStateHandler=handler}}}