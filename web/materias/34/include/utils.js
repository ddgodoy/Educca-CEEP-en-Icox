// parser functions


function GetServer(str)
{
	var pos = str.indexOf("/");
	pos = str.indexOf("/",pos+2);  // start position virtual directory
	if(pos>=0)
	{
		return str.substring(0,pos);
	}else // server done
	{
		return str;
	}
}

function GetRoot(str)
{
   try{

    	var posAux;
	var pos;

	pos = str.indexOf("\?");
	if(pos>=0)
	   str = str.substring(0,pos); 	
	
	pos = str.lastIndexOf("/");
	if(pos>=0)
	{
		str = str.substring(0,pos); 
		//get the command
		posAux = str.lastIndexOf("/cmd");
		if(posAux>=0)
		{
			str = str.substring(0,posAux);
		}
		posAux = str.lastIndexOf("/ses");
		if(posAux>=0)
		{
			str = str.substring(0,posAux);
		}
		return str;
	}else
	{
		return "";
	}
   }catch(e)
   {
	return "";
   }
}

function parseQueryString (str) { 
var query = str.charAt(0) == '?' ? str.substring(1) : str; 
var args = new Object(); 

if (query) { 
	var fields = query.split('&'); 

	for (var f = 0; f < fields.length; f++) { 
		try{
		var field = fields[f].split('='); 
		args[unescape(field[0].replace(/\+/g, ' '))] = unescape(field[1].replace(/\+/g, ' ')); 
		}catch(e)
		{
		}
	}

} 
return args; 
}

function getQueryString(sString,sVariable)
{
var Qstr = parseQueryString(sString); 
for (var arg in Qstr)
{
   if(arg==sVariable)
	return Qstr[arg];
}
return "";

}

function QueryString(sVariable) { 
var Qstr = parseQueryString(this.location.search); 
for (var arg in Qstr)
{
   if(arg==sVariable)
	return Qstr[arg];
}
return "";
}


function getText(xmlNode, sElementName, sKeywordName, sKeyword)
{  
	var n = 0;
	var vTemp = xmlNode.getElementsByTagName(sElementName);
   
	while(n < vTemp.length)
   {  
    	if (vTemp[n].getAttribute(sKeywordName)==sKeyword)
        		return String(vTemp[n].firstChild.nodeValue);		
		n++;
	}
   return String("#NOTEXT#");
}


function getDirCourse(sURL,nLevel){
var pos;
var n;
var sTemp;
n=0;
sTemp = String(sURL);
// level in reverse find
if (nLevel == null) nLevel = 2;
// reverse find  xxx/dfddl/rts
while (n<=nLevel)
{
	n++;
	pos = sTemp.lastIndexOf("/");
	if (pos>0)
	{
		sTemp = sTemp.substring(0,pos)		
	}	
}
return sTemp + "/";
}

var hexchars = "0123456789ABCDEF";
var okURIchars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789_-";

function utf8(wide) {
  var c, s;
  var enc = "";
  var i = 0;
  while(i<wide.length) {
    c= wide.charCodeAt(i++);
    // handle UTF-16 surrogates
    if (c>=0xDC00 && c<0xE000) continue;
    if (c>=0xD800 && c<0xDC00) {
      if (i>=wide.length) continue;
      s= wide.charCodeAt(i++);
      if (s<0xDC00 || c>=0xDE00) continue;
      c= ((c-0xD800)<<10)+(s-0xDC00)+0x10000;
    }
    // output value
    if (c<0x80) enc += String.fromCharCode(c);
    else if (c<0x800) enc += String.fromCharCode(0xC0+(c>>6),0x80+(c&0x3F));
    else if (c<0x10000) enc += String.fromCharCode(0xE0+(c>>12),0x80+(c>>6&0x3F),0x80+(c&0x3F));
    else enc += String.fromCharCode(0xF0+(c>>18),0x80+(c>>12&0x3F),0x80+(c>>6&0x3F),0x80+(c&0x3F));
  }
  return enc;
}


function toHex(n) {
  return hexchars.charAt(n>>4)+hexchars.charAt(n & 0xF);
}


function encodeURIComponentNew(s) {
  var s = utf8(s);
  var c;
  var enc = "";
  for (var i= 0; i<s.length; i++) {
    if (okURIchars.indexOf(s.charAt(i))==-1)
      enc += "%"+toHex(s.charCodeAt(i));
    else
      enc += s.charAt(i);
  }
  return enc;
}

function str2bin(str)
{
  var bin = Array();
  for(var i = 0; i < str.length; i++)
    bin[i] = str.charCodeAt(i);
  return bin;
}
function utf8escape(fld)
{
	if (fld == "") return "";
	var encodedField = "";
	var s = fld;
	if (typeof encodeURIComponent == "function")
	{
		// Use JavaScript built-in function
		// IE 5.5+ and Netscape 6+ and Mozilla
		encodedField = encodeURIComponent(s);
	}
	else 
	{
		// Need to mimic the JavaScript version
		// Netscape 4 and IE 4 and IE 5.0
		encodedField = encodeURIComponentNew(s);
	}

	return encodedField;
}

function is_numeric(num)
{
	var exp = new RegExp("^[0-9-.]*$","g");
	return exp.test(num);
}
