// Windows Utilities
// 
//

//NOTE: requires browsers.js

var winhndl=null, winx=null, winy=null;
var balert = false;
var objWindowControl = null;

function OpenPopupWindow(strURL,
			strWindowName, 
			bFullScreen,
			nWidth,
			nHeight,
			bCentered,
			nOffsetX,
			nOffsetY,
			bShowScrollbar,
			bDontLostFocus,
			strCallOnChildClose)
{   
    var features, strBrowser, nBrMajVer, nBrVer,winhndl;
    winhndl = null;
    strBrowser = browser_type();
    nBrMajVer = browser_version( false );
	 nBrVer = browser_version( true );
    if(!bFullScreen)
    {
      if(nWidth<=0)
		   nWidth = screen.availWidth-10;
      if(nHeight<=0)
		   nHeight = screen.availHeight-20;

		if(nOffsetX<=0)
      {
			if(bCentered)
				nOffsetX =  (screen.availWidth - nWidth)/2;
			else
				nOffsetX = 0
		}

		if(nOffsetX<0) nOffsetX = 0;

		if(nOffsetY<=0)
      {
			if(bCentered)
		    	nOffsetY =  (screen.availHeight - nHeight)/2;
      	else
				nOffsetY =  0;
		}
		if(nOffsetY<0) nOffsetY = 0;

		features = 'width='+nWidth+',height='+nHeight;
		features += ',left='+nOffsetX+',top='+nOffsetY + ',resizable=yes';

	}else
	{
      if( strBrowser == "ns" )
	   {
		if(nBrVer<5)
			features = "type=fullWindow";
		else
			features ='fullscreen=yes';

      }else
	   {
         features = 'fullscreen=yes';
      }
	}
   
   // toolbar=yes,location=yes,directories=yes,status=yes,menubar=yes,copyhistory=yes 
   if(bShowScrollbar) features +=",scrollbars=yes";
	else 	features +=",scrollbars=no";

   winhndl = window.open(strURL, strWindowName, features);
   
	objWindowControl = new Object;
	objWindowControl.hwnd = winhndl;
	objTemp = objWindowControl;
   objTemp.strCallOnChildClose = strCallOnChildClose;

	if( strBrowser == "ie" && br_isonmac() )
	{
		//tracking doesn't work on ie for mac
			bDontLostFocus = false;
			strCallOnChildClose = null;
	}
	
	if( bDontLostFocus && nBrMajVer >= 4 )
	{
	   
		if( strBrowser == "ie" )
		{
			
			if( nBrMajVer < 5 )
			{	
				//ie4 version
				this.onfocus = iecheckchildfocus;
				this.setTimeout("iecheckchildclose()",1000);
			}
			else if( nBrVer < 5.5 )
			{
				//ie5.0 version
				this.attachEvent( "onfocus", iecheckchildfocus );
				this.setTimeout("iecheckchildclose()",1000);
			}
			else
			{
				//ie5.5+ version
				
				this.attachEvent( "onfocus", iecheckchildfocus );
				try{
					if( this.parent != null )
						parent.attachEvent( "onfocus", iecheckchildfocus );
				}catch(e)
				{
				}
				this.setTimeout("iecheckchildclose()",1000);
			}

		}
		else //netscape, use event traps to control focus, polling to detect close
		{

			if( nBrMajVer < 6 )
			{
				//if current window is not a frame then
				//tie the focus event to the top window.
				if( top.name != "root" )
				{
					top.captureEvents( Event.FOCUS );
					top.onFocus = nscheckchildfocus;
				}
				else
				{
					this.captureEvents( Event.FOCUS );
					this.onFocus = nscheckchildfocus;
				}
			}
			else
			{
				//ns 6 uses w3c DOM event model
				this.addEventListener("focus", ns6checkchildfocus, true);
			}

			this.setTimeout("nscheckchildclose()",1000);
		}
		
	}
	return winhndl;
}


//*******************
// give focus back to child window if not closed
//*******************
function nscheckchildfocus()
{
	//keep self in background.
	try{

		if( !objWindowControl.hwnd.closed )
		{
			this.blur();
			if(objWindowControl.hwnd)
			objWindowControl.hwnd.focus();
		}
	}catch(e)
	{
	}
	
};

function ns6checkchildfocus()
{
	//keep self in background.
	if( !objWindowControl.hwnd.closed )
	{
		objWindowControl.hwnd.focus();
	}
};

function iecheckchildfocus()
{
	//use vbscript version to avoid errors in ie
	nscheckchildfocus();
};

function iecheckchildclose()
{
	//check and execute the specified function when closed
   nscheckchildclose();
};

function execute_on_end()
{
    //if refresh flag is not set and a "call on close" function is specified then call it.
    if( objWindowControl.strCallOnChildClose != null )
	eval( "this."+objWindowControl.strCallOnChildClose );
    this.focus();
}

//*******************
//restore and refresh the parent window when the child closes
//*******************
function nscheckchildclose()
{
	//keep self in background,refresh when child closed.
	try
	{
		if(objWindowControl)
		{
			if(objWindowControl.hwnd)
			{
				if( objWindowControl.hwnd.closed )
				{
					// give some time to the performant ie
					//this.setTimeout("execute_on_end()",1500);		
					execute_on_end();
				}
				else
				{
					this.setTimeout("nscheckchildclose()",1000); //check again in a second
				}
			}
		}
	}catch(e)
	{
	}

};


function OpenFullScreenWindow(  strURL, 
				strWindowName, 
				bShowScrollbar, 
				strBrowser, 
				strBrMajorVer )
{

	var op = "";

	if( bShowScrollbar ) op += "scrollbars=no,";

	if( strBrowser == "ns" )
	{
	   op +="type=fullWindow";
      return this.open( strURL, strWindowName, op );
	}
	else
	{
		op += "fullscreen";
		return this.open( strURL, strWindowName, op );
	}

};
	
