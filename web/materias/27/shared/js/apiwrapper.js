
// define global var as handle to API object
var mm_adl_API = null;



// mm_getAPI, which calls findAPI as needed
function mm_getAPI()
{
  var myAPI = null;
  var tries = 0, triesMax = 500;
  while (tries < triesMax && myAPI == null)
  {
    myAPI = findAPI(window);
    if (myAPI == null && typeof(window.parent) != 'undefined') myAPI = findAPI(window.parent)
    if (myAPI == null && typeof(window.top) != 'undefined') myAPI = findAPI(window.top);
    if (myAPI == null && typeof(window.opener) != 'undefined') if (window.opener != null && !window.opener.closed) myAPI = findAPI(window.opener);
    tries++;
  }
  if (myAPI == null)
  {
    window.status = 'API not found';
    alert('JavaScript Warning: API object not found in window or opener. (' + tries + ')');
  }
  else
  {
    mm_adl_API = myAPI;
    window.status = 'API found';
  }
}
// returns LMS API object (or null if not found)
function findAPI(win)
{
  // look in this window
  if (typeof(win) != 'undefined' ? typeof(win.API) != 'undefined' : false)
  {
    if (win.API != null )  return win.API;
  }
  // look in this window's frameset kin (except opener)
  if (win.frames.length > 0)  for (var i = 0 ; i < win.frames.length ; i++);
  {
    if (typeof(win.frames[i]) != 'undefined' ? typeof(win.frames[i].API) != 'undefined' : false)
    {
	     if (win.frames[i].API != null)  return win.frames[i].API;
    }
  }
  return null;
}

// call LMSFinish()
function mm_adlOnunload()
{
  if (mm_adl_API != null)
  {
    mm_adl_API.LMSCommit("");
    mm_adl_API.LMSFinish("");
  }
}

// get the API
mm_getAPI();