// Browser recognize functions
// 
function browser_type()
{
	var sAgent = navigator.userAgent.toLowerCase();	
	var nTmp = sAgent.indexOf( "msie");
	if( nTmp >= 0 )
		return( "ie" );
	else
		return( "ns" ); //if not ie, treat browser as NS.
}

function br_isonmac()
{
	var sAgent = navigator.userAgent.toLowerCase();	
	var nTmp = sAgent.indexOf( "mac");
	if( nTmp >= 0 )
		return( true );
	else
		return( false );
}

function browser_version( bFullVersion )
{
	var sAgent = navigator.userAgent.toLowerCase();
	var sVer = navigator.appVersion;
	var nTmp;

	nTmp = sAgent.indexOf( "msie");
	if( nTmp >= 0 ) //ie
	{
		//some versions report the wrong number in appVersion
		//get the correct version from the user agent string
		sVer = sAgent.substring( nTmp+4, sAgent.length );
	}
	else //default to ns
	{
		//ns 6 gives the wrong version #. Get the correct one
		nTmp = sAgent.indexOf( "netscape6" );
		if( nTmp >= 0 )
		{
			sVer  = sAgent.substring( nTmp+10, sAgent.length );
		}
	}

	if( bFullVersion )
		return( parseFloat( sVer )  );
	else
		return( parseInt( sVer ) );
}
