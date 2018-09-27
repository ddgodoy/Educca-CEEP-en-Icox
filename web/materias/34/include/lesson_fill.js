var sXMLLessonFile = "lesson.xml";
var sXMLStringsFile = "";
var sNavType; // type of navegator
sNavType = browser_type(); // browser detection
var xmlDoc;
var xmlDocLesson;
var xmlDocStrings;

if(sNavType=="ns")
{
  xmlDocLesson = document.implementation.createDocument("", "test", null);
  xmlDocStrings = document.implementation.createDocument("", "", null);
}else
{
  xmlDocLesson = new ActiveXObject("Microsoft.XMLDOM");
  xmlDocStrings =  new ActiveXObject("Microsoft.XMLDOM");
}

function fillLesson(lesson)
{
   var language = QueryString('il');
   if (language == "") language=lesson.getAttribute("nilang_default");
   // we get the text in the respective interface language
   
   sLessonType = lesson.getAttribute("type");
   sLaunchType = lesson.getAttribute("launch_type");
   sNewWindow = lesson.getAttribute("new_window");
   sCloseLauncher = lesson.getAttribute("close_launcher");
   sNoOcx = lesson.getAttribute("no_ocx");
   sExtraParameters = lesson.getAttribute("extra_parameters");
   sILanguage = lesson.getAttribute("nilang_default");
   sILanguageCreation = lesson.getAttribute("nilang_creation");
   sXMLStringsFile = "../../lan/" + sILanguage + "/strings.xml";
   var sFullScreen = lesson.getAttribute("fullscreen");	
   if(sFullScreen=="1")
	bFullScreen = true;
}

/*function fillDataLesson() {
   lesson = xmlDocLesson.getElementsByTagName('lesson')[0];
   fillLesson(lesson); 	
}*/

/*function fillDataIE(){
   lesson = document.getElementById("lesson").XMLDocument.getElementsByTagName("lesson")[0];
   fillLesson(lesson);
}*/
/*function fillDataIE(){
   lesson = xmlDocLesson.getElementsByTagName('lesson')[0];
   fillLesson(lesson);
}*/


function getChildNodeById(xmlElement,sId)
{
   var bFound;
   bFound = false;
	if(xmlElement)
	{
      var childs; 
      childs = xmlElement.getElementsByTagName("string");
		for (j=0;j<childs.length;j++)
		{
         
			if(childs[j].getAttribute("id").toLowerCase()==sId.toLowerCase())
			{
				return childs[j].firstChild;
			}
		}
	}
	return null;
}

function getString(sName,sDefault)
{
	var xmlNode;

   xmlNode = getChildNodeById(langtrings,sName);
   
	if(xmlNode)
	{
		return xmlNode.nodeValue;
	}else
	{
      if(sDefault == null)
			return "";
		else
			return sDefault;
	}
}

function filldata() {
 
 xmlDocLesson.async = false;
 xmlDocLesson.load(sXMLLessonFile); // load is synchronous
 lesson = xmlDocLesson.getElementsByTagName('lesson')[0];
 
 fillLesson(lesson); 	
 
 xmlDocStrings.async = false;
 xmlDocStrings.load(sXMLStringsFile);
 langtrings = xmlDocStrings.getElementsByTagName('langstrings')[0];

}

