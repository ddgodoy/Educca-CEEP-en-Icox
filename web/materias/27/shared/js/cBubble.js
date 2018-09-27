//\/////
//\  coolTip Bubble Plugin
//\  This file requires coolTip 1.40 or later.
//\  Modified August 21, 2006
//\
//\  You may not remove or change this notice.
//\  Copyright Robert E Boughner 2005. All rights reserved.
//\  
//\  This plugin is governed by the same restrictions set forth
//\  in the prologue to cCore.js.
//\/////
//\  THIS IS A VERY MODIFIED VERSION. DO NOT EDIT OR PUBLISH. GET THE ORIGINAL!

if(typeof cInfo==cUdf||!cInfo.meets(1.00))alert('coolTip 1.40 or later is required for the Speech Bubble Plugin.');else{registerCommands('bubble,bubbletype,adjbubble');var XBUBBLE=2;var imgWidth=[250,330,144,202];var imgHeight=[150,160,190,221];var contentWidth=[200,250,130,184];var contentHeight=[80,85,150,176];var padLeft=[30,40,7,9];var padTop=[25,48,10,34];var arwTipX=[180,50,51,9];var arwTipY=[148,5,180,221];
setDefaultVariables('bubble|0|bubbletype||adjbubble|0');var cBTypes='flower,oval,square,pushpin,quotation,roundcorners'.split(','),cBubbleImg,cBId,cBContentWd=contentWidth;var bubbleImgPath='';
function setBubbleVariables(obj){obj.bubble=cd_bubble;obj.bubbletype=cd_bubbletype;obj.adjbubble=cd_adjbubble;}
function parseBubbleExtras(pf,i,ar){var k=i;if(k<ar.length){if(ar[k]==BUBBLE){eval(pf+'bubble=('+pf+'bubble==0)?1:0');setBubbleImgPath((typeof ar[k+1]=='string')?ar[++k]:'');return k;}
if(ar[k]==BUBBLETYPE){eval(pf+'bubbletype="'+ar[++k]+'"');return k;}
if(ar[k]==ADJBUBBLE){eval(pf+'adjbubble=('+pf+'adjbubble==0)?1:0');return k;}}
return-1;}
function chkForBubbleEffect(pf,args){with(po){if(bubble){bubbletype=(bubbletype)?bubbletype:'flower';for(var i=0;i<cBTypes.length;i++){if(cBTypes[i]==bubbletype){cBId=i;break;}}
bgcolor=fgcolor='';border=0;if(fgbackground||bgbackground)fgbackground=bgbackground='';if(cap)cap='';if(sticky)opt_NOCLOSE();if(fullhtml)fullhtml=0;if(fixx>0||fixy>0)fixx=fixy=-1;if(relx||rely)relx=rely=null;if(typeof shadow!=cUdf&&shadow)shadow=0;if(bubbletype!='roundcorners'){if(hpos==CENTER||hpos==LEFT)hpos=RIGHT;if(hauto)hauto=0;if(vauto)vauto=0;if(bubbletype!='quotation'){width=cBContentWd[cBId];if(vpos==ABOVE)vpos=BELOW;if(wrap)wrap=0;}else if(vpos==BELOW)vpos=ABOVE;}}}
return true;}
function setBubbleImgPath(path){path=(path||(bubbleImgPath||'images/'));if(/\/$/.test(path))path=path.replace(/\/$/,'');if(!bubbleImgPath||path!=bubbleImgPath){bubbleImgPath=path;registerImages(path);}}
function registerImages(path){if(typeof cBubbleImg==cUdf)cBubbleImg=new Array();for(var i=0;i<cBTypes.length;i++){if(cBTypes[i]=='quotation'||cBTypes[i]=='roundcorners'){if(typeof cBubbleImg[i]==cUdf)cBubbleImg[i]=new Array();var o=cBubbleImg[i];var type=(cBTypes[i]=='quotation')?0:1;o[0]=new Image();o[0].src=path+'/cornerTL.gif';o[1]=new Image();o[1].src=path+'/edgeT.gif';o[2]=new Image();o[2].src=path+'/cornerTR.gif';o[3]=new Image();o[3].src=path+'/edgeL.gif';o[4]=new Image();o[4].src=path+'/edgeR.gif';for(var j=5;j<9;j++)o[j]=new Image();if(type){o[5].src=path+'/cornerBLRnd.gif';o[6].src=path+'/edgeBRnd.gif';o[7].src=path+'/cornerBRRnd.gif';}else{o[5].src=path+'/cornerBL.gif';o[6].src=path+'/edgeB.gif';o[7].src=path+'/cornerBR.gif';o[8].src=path+'/tail.gif';}
}else{cBubbleImg[i]=new Image();cBubbleImg[i].src=path+'/'+cBTypes[i]+'.gif';}}}
function generateBubble(content){if(typeof cTip.pop.bubble!=cUdf&&typeof cBubbleImg!=cUdf&&cTip.pop.bubble){var po=cTip.pop,ar,X,Y,fc=1.0,txt,sY,bHtDiff,bPadDiff=0,zIdx=0;var bTopPad=padTop,bLeftPad=padLeft;var bContentHt=contentHeight,bHt=imgHeight;var bWd=imgWidth,bArwTipX=arwTipX,bArwTipY=arwTipY;
if(po.bubbletype=='quotation'||po.bubbletype=='roundcorners')return doSpecialBubble(content);
bHtDiff=fc*bContentHt[cBId]-(cNs4?cTip.clip.height:cTip.offsetHeight);if(po.adjbubble){fc=resizeBubble(bHtDiff,0.5,fc);ar=getHeightDiff(fc);bHtDiff=ar[0];content=ar[1];}
if(bHtDiff>0)bPadDiff=parseInt(0.5*bHtDiff);Y=(bHtDiff<0)?fc*bTopPad[cBId]:fc*bTopPad[cBId]+bPadDiff;X=fc*bLeftPad[cBId];Y=Math.round(Y);X=Math.round(X);
txt=(cNs4)?'<div id="bLayer">':((cIe55&&po.HideForm)?backDropSource(Math.round(fc*bWd[cBId]),Math.round((bHtDiff<0?fc*bHt[cBId]-bHtDiff:fc*bHt[cBId])),zIdx++):'')+'<div id="bLayer" style="position: absolute;top:0;left:0;width: '+Math.round(fc*bWd[cBId])+'px;z-index: '+(zIdx++)+';">';txt+='<img src="'+cBubbleImg[cBId].src+'" width="'+Math.round(fc*bWd[cBId])+'" height="'+Math.round((bHtDiff<0?fc*bHt[cBId]-bHtDiff:fc*bHt[cBId]))+'" /></div>';txt+=((cNs4)?'<div id="bContent">':'<div id="bContent" style="position: absolute;top:'+Y+'px;left:'+X+'px;width: '+Math.round(fc*cBContentWd[cBId])+'px;z-index: '+(zIdx++)+';">'+(po.doXml&XBUBBLE?'':content)+'</div>');
(po.doXml&XBUBBLE)?setPluginXmlCode(txt,null,1):layerWrite(txt);if(cNs4){var imgLyr=cTip.document.layers['bLayer'];var cLyr=cTip.document.layers['bContent'];imgLyr.zIndex=0;cLyr.zIndex=1;cLyr.top=Y;cLyr.left=X;}
po.width=Math.round(fc*bWd[cBId]);po.aboveheight=Math.round(fc*bHt[cBId]);if(fc*bArwTipY[cBId]<0.5*fc*bHt[cBId])
sY=fc*bArwTipY[cBId];else
sY=-(fc*bHt[cBId]+20)
po.offsetx-=Math.round(fc*bArwTipX[cBId]);po.offsety+=Math.round(sY);}}
function doSpecialBubble(content){var txt='',wd,ht,zIdx=0,o=cBubbleImg[cBId];var type=(cBTypes[cBId]=='quotation')?0:1;wd=(cNs4)?cTip.clip.width:cTip.offsetWidth;ht=(cNs4)?cTip.clip.height:cTip.offsetHeight;txt=(cIe55&&po.HideForm)?(type?backDropSource(wd+22,ht+23,zIdx++):backDropSource(wd+22,ht+34,zIdx++))+'<div style="position:absolute;top: 0;left: 0;z-index: '+(zIdx++)+';">':'';txt+='<table cellpadding="0" cellspacing="0" border="0">'+
'<tr><td align="right" valign="bottom"><img src="'+o[0].src+'" width="11" height="12"'+(cNs6?' style="display: block;"':'')+' /></td><td valign="bottom"><img src="'+o[1].src+'" height="12" width="'+wd+'"'+(cNs6?' style="display: block;"':'')+' /></td><td align="left" valign="bottom"><img src="'+o[2].src+'" width="11" height="12"'+(cNs6?' style="display: block;"':'')+' /></td></tr>'+
'<tr><td align="right"><img src="'+o[3].src+'" width="11" height="'+ht+'"'+(cNs6?' style="display: block;"':'')+' /></td><td bgcolor="#ffffff">'+(po.doXml&XBUBBLE?'':content)+'</td><td align="left"><img src="'+o[4].src+'" width="11" height="'+ht+'"'+(cNs6?' style="display: block;"':'')+' /></td></tr>'+
(type?('<tr><td align="right" valign="top"><img src="'+o[5].src+'" width="11" height="11" /></td><td valign="top"><img src="'+o[6].src+'" height="11" width="'+wd+'" /></td><td align="left" valign="top"><img src="'+o[7].src+'" width="11" height="11" /></td></tr></table>'):('<tr><td align="right" valign="top"><img src="'+o[5].src+'" width="11" height="22" /></td><td valign="top"><img src="'+o[8].src+'" height="22" width="66" /><img src="'+o[6].src+'" height="22" width="'+(wd-66)+'" /></td><td align="left" valign="top"><img src="'+o[7].src+'" width="11" height="22" /></td></tr></table>'))
txt+=(cIe55&&po.HideForm)?'</div>':'';(po.doXml&XBUBBLE)?setPluginXmlCode(txt,null,1):layerWrite(txt);with(po){if(type){width=wd+22;aboveheight=ht+23;}else{width=wd+22;aboveheight=ht+34;
offsetx-=11;}}}
function resizeBubble(h1,dF,fold){var df,h2,fnew,alpha,cnt=0;while(cnt<2){df=-signOf(h1)*dF;fnew=fold+df;h2=getHeightDiff(fnew)[0];if(Math.abs(h2)<po.textsize)break;if(signOf(h1)!=signOf(h2)){alpha=Math.abs(h1)/(Math.abs(h1)+Math.abs(h2));if(h1<0)fnew=alpha*fnew+(1.0-alpha)*fold;else fnew=(1.0-alpha)*fnew+alpha*fold;}else{alpha=Math.abs(h1)/(Math.abs(h2)-Math.abs(h1));if(h1<0)fnew=(1.0+alpha)*fold-alpha*fnew;else fnew=(1.0+alpha)*fnew-alpha*fold;}
fold=fnew;h1=h2;dF*=0.5;cnt++;}
return fnew;}
function getHeightDiff(f){var lyrhtml;with(po){width=f*contentWidth[cBId];lyrhtml=runHook('ctContentSimple',FALTERNATE,css,text);}
layerWrite(lyrhtml)
return [Math.round(f*contentHeight[cBId])-((cNs4)?cTip.clip.height:cTip.offsetHeight),lyrhtml];}
function signOf(x){return(x<0)?-1:1;}
function setDoXml_bble(){with(cTip.pop){if(xml){doXml|=XBUBBLE;}}
return void(0);}
function cleanUpXml_bble(obj){with(obj.pop){if(doXml&&!(cNs4||cIe4)){if(doXml&XBUBBLE)doXml^=XBUBBLE;}}
return void(0);}
registerRunTimeFunction(setBubbleVariables);registerCmdLineFunction(parseBubbleExtras);registerPostParseFunction(chkForBubbleEffect);registerHook("ctCreatePopup",generateBubble,FAFTER);registerHook("cleanUpXml",cleanUpXml_bble,FCHAIN);registerHook("setDoXml",setDoXml_bble,FCHAIN);if(cInfo.meets(1.40))registerNoParameterCommands('bubble,adjbubble');
if(cNs4)document.write('<style type="text/css">\n<!--\n#bLayer,#bContent {position: absolute;}\n-->\n<'+'\/style>');}
