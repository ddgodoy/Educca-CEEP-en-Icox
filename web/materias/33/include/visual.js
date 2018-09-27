function hidediv(divelement)
{
   if (document.getElementById) { // DOM3 = IE5, NS6 
      document.getElementById(divelement).style.visibility = 'hidden'; 
   } 
   else { 
      if (document.layers) { // Netscape 4 
         document.progressbar.visibility = 'hidden'; 
      } 
      else { // IE 4 
         document.all.progressbar.style.visibility = 'hidden'; 
      } 
   }  
}

function showdiv(divelement)
{
   if (document.getElementById) { // DOM3 = IE5, NS6 
     document.getElementById(divelement).style.visibility = 'visible'; 
   } 
   else { 
     if (document.layers) { // Netscape 4 
       document.progressbar.visibility = 'visible'; 
     } 
     else { // IE 4 
       document.all.progressbar.style.visibility = 'visible'; 
     } 
   }  
}

// JavaScript Document
function hidedivprogress() 
{ 
   hidediv('progressbar');
} 

function showdivprogress() 
{
   showdiv('progressbar'); 
} 

var progressEnd = 9;		// set to number of progress <span>'s.
var progressColor = 'blue';	// set to progress bar color
var progressInterval = 500;	// set to time between updates (milli-seconds)

var progressAt = progressEnd;
var progressTimer;
function progress_clear() {
	for (var i = 1; i <= progressEnd; i++) document.getElementById('progress'+i).style.backgroundColor = 'transparent';
	progressAt = 0;
}
function progress_update() {
	progressAt++;
	if (progressAt > progressEnd) progress_clear();
	else document.getElementById('progress'+progressAt).style.backgroundColor = progressColor;
	progressTimer = setTimeout('progress_update()',progressInterval);
}
function progress_stop() {
	clearTimeout(progressTimer);
	progress_clear();
}


