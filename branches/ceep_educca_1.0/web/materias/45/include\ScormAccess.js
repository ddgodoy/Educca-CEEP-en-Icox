var win = null;
var ticket = null;
var lesson = null;

// function inserting the Flash component
function insertFlash()
{
    document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="40" height="40" id="LMSComponentSCORM" align="middle" >');
    document.write('<param name="allowScriptAccess" value="always" />');
    document.write('<param name="allowFullScreen" value="false" />');
    document.write('<param name="movie" value="../../LMSComponentSCORM.swf" />');
    document.write('<param name="quality" value="high" />');
    document.write('<param name="bgcolor" value="#ffffff" />');
    document.write('<param name="loop" value="false" />');
    document.write('<embed src="../../LMSComponentSCORM.swf" loop="false" quality="high" bgcolor="#ffffff" width="40" height="40" name="LMSComponentSCORM" align="middle" allowScriptAccess="always" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />');
    document.write('</object>');
    window.LMSComponentSCORM = document.getElementById('LMSComponentSCORM');
}

// function initializing the LMS
function connect()
{
    // initialize SCORM
    SCORM_Initialize();

    // read lesson values from XML file
    readLessonData();

    // get variables
    var tmm_url = lesson.getAttribute("href");
    var queryString = "ptf_package=" + lesson.getAttribute("package");
    queryString += "&ptf_interface=" + lesson.getAttribute("interface");
    queryString += "&ptf_discipline=" + lesson.getAttribute("discipline");
    queryString += "&ptf_lesson=" + lesson.getAttribute("lesson");
    queryString += "&ptf_login=" + SCORM_GetValue(sSCORMStudentId);
    queryString += "&ptf_name=" + SCORM_GetValue(sSCORMStudentName);
    queryString += "&ptf_masteryscore=" + SCORM_GetMasteryScore();
    queryString += "&ptf_time=" + SCORM_GetValue(sSCORMTotalTime);
    var extra = SCORM_GetValue(sSCORMExtraParameters);
    if (extra != "")
        queryString += "&" + extra;

    // for SABA, set the status to its initial value
    var initialStatus = SCORM_GetValue(sSCORMLessonStatus);
    SCORM_SetValue(sSCORMLessonStatus, initialStatus);

    // give variables to flash
    window.document.LMSComponentSCORM.connect(tmm_url, queryString);
}

// function closing the ticket using Flash
function exit()
{
    window.document.getElementById('DoNotCloseLabelZone').style.display = "none";
    window.document.getElementById('WaitLabelZone').style.display = "";
    window.document.LMSComponentSCORM.exit(ticket);
}

// function called when Flash finished creating ticket
function end_connect(ticketParam)
{
    // parse ticket
    var ticketParts = ticketParam.split("&");
    if (ticketParts.length > 0)
    {
        ticket = ticketParts[0].split("=")[1];
    }

    if (ticket != null) {
        // add url parameters to the portal link
        var tmm_url = lesson.getAttribute("href");
        window.document.getElementById('TmmOpenLink').href = tmm_url + "LMS/LmsAccess.aspx?ticket=" + ticket;
        window.document.getElementById('InitLabelZone').style.display = "none";
        window.document.getElementById('LinkZone').style.display = "";
    }
    else
    {
        error('14');
    }
}

// function called when Flash finished closing ticket
function end_exit(score, time, status, useFrame)
{
    SCORM_SetScore(score);
    SCORM_SetElapsedTime(time);
    SCORM_Terminate(status);

    window.onbeforeunload = null;
    window.document.getElementById('WaitLabelZone').style.display = "none";
    if (useFrame == "1")
        window.document.getElementById('LeaveLabelZone').style.display = "";
    else
        window.document.getElementById('CloseWindowLabelZone').style.display = "";
}

// read data in lesson.xml
function readLessonData()
{
    var xmlDoc;

    if (document.implementation && document.implementation.createDocument)
    {
        xmlDoc = document.implementation.createDocument("", "", null);
    }
    else if (window.ActiveXObject)
    {
        xmlDoc = new ActiveXObject("Microsoft.XMLDOM");
    }
    xmlDoc.async = false;
    try
    {
        xmlDoc.load("lesson.xml");
    }
    catch (e)
    {
        // Chrome workaround
        var xmlhttp = new window.XMLHttpRequest();
        xmlhttp.open("GET", "lesson.xml", false);
        xmlhttp.send(null);
        xmlDoc = xmlhttp.responseXML;
    }
    lesson = xmlDoc.getElementsByTagName('lesson')[0];
}

// function called when an error happened
function error(errorCode)
{
    // print output
    window.document.getElementById('TmmErrorLabelZone').innerHTML = window.document.getElementById('TmmErrorLabelZone').innerHTML.replace('{0}', errorCode);
    window.document.getElementById('TmmErrorLabelZone').style.display = 'block';
    window.onbeforeunload = null;
}

// get a handle on the window previously opened
function getHandle()
{
    window.document.getElementById('LinkZone').style.display = "none";
    window.document.getElementById('DoNotCloseLabelZone').style.display = "";
    
    win = window.open("", "_tmm_new_window_lms");
    setTimeout("CheckChildWindow()", 1000);
    window.onbeforeunload = function()
    {
        return window.document.getElementById('UnBeforeUnloadText').value;
    }
    window.onfocus = function()
    {

        if (!win.closed)
        {
            try
            {
                window.blur();
                win.focus();
            }
            catch (e)
            {
                // window already closed
                window.onfocus = null;
            }
        }
        else
        {
            // window already closed
            window.onfocus = null;
        }
    }
}

// detect when the child window is closed
function CheckChildWindow()
{
    if (win.closed)
    {
        window.onfocus = null;
        window.focus();
        exit();
    }
    else
    {
        setTimeout("CheckChildWindow()", 1000);
    }
}