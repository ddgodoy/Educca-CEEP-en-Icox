

function findVARIABLE(win)
{ 
   
   var thisVARIABLE = win.s_Justin_ScoreOfPlacementTest;
   
   var findVARIABLETries = 0;
  
   while ((thisVARIABLE==null)||(thisVARIABLE==undefined))
   {
      findVARIABLETries++;
      // Note: 7 is an arbitrary number, but should be more than sufficient
      if (findVARIABLETries > 7) 
      {
         return null;
      }
      
      // first look in frames, frames for non standart SCORM platforms
      if((thisVARIABLE==null)||(thisVARIABLE==undefined)) 
      {
        
		if(win.document.frames)
		{
			
			var l;
			l = win.document.frames.length - 1;
			for(;l>=0 ;l--)
			{	
				
				thisFrame = win.document.frames[l];
				if(thisFrame.document)
					thisVARIABLE = thisFrame.document.s_Justin_ScoreOfPlacementTest;
				
				if(thisFrame.s_Justin_ScoreOfPlacementTest&&(thisVARIABLE==null))
				{
					
					thisVARIABLE = thisFrame.s_Justin_ScoreOfPlacementTest;
				}
				
				if(thisVARIABLE!=null&&thisVARIABLE!=undefined)
				{
					
					return thisVARIABLE;
				}
			}
		}
      }
      if((win.parent == null) || (win.parent == win))
      {
		 return null;
      }else
      {
         win = win.parent;
		 thisVARIABLE = win.VARIABLE;
	  }
   }
   return thisVARIABLE;
}


function getVARIABLE()
{
   var winActual = window;
   
   try
   {
       var theVARIABLE = findVARIABLE(top);
	   var openerCounter = 0;
	   
	   while((theVARIABLE == null)&&(winActual.opener != null) && (typeof(winActual.opener) != "undefined"))
	   { 
	      openerCounter++;
	      
	      if(openerCounter>4)
	      {
	 	     return null;
	      }else
	      {
			 theVARIABLE = findVARIABLE(winActual.opener);
	      }
	      winActual = winActual.opener;
	   }
   }
   catch(e)
   {
      return null;
   }
   return theVARIABLE;
}



function FindCustomVariable()
{
	return getVARIABLE();
}


function TranslateVariableToScale(value)
{
	
	Result = null;
	if(value!=null)
	{
		if(is_numeric(value))
		{
		    
			// we doit in this way to add some flexibilities to future scales or changes on rules
			var scale = [[0,10],[11,20],[21,30],[31,40],[41,50],[51,60],[61,70],[71,80],[81,90],[91,100]];
			
			for (var i = 0; i < scale.length; i++)
			{
				
				if((value>=scale[i][0])&&(value<=scale[i][1]))
				{
					return i+1;
				}
			}
			
		}
	}
	
	return Result;
}


function  AddCustomVariableToExtraParameters(lmsExtraParameters)
{
	var Result = lmsExtraParameters;
	var scaledValue = TranslateVariableToScale(getVARIABLE());
	
	if(scaledValue!=null)
	{
		Result = Result + "&external_level_note=" + scaledValue;
	}
	
	return Result;
	
}