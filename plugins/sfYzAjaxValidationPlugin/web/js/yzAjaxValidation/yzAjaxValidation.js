/*
 * This function is called after the completion of the ajax validation request. 
 * It looks through the JSON data. And displays the errors if it needs or if there
 * are no errors, it evaluates the code in yzValidator_eval_onsuccess hidden tag.
 */
function yzAV_JSONUpdater(request, json, hidden_id)
{
  
  var numElementsInResponse = json.length;
  var elementId;
  var elementText;
  //Looks for the form error <div> by its class name
  var formErrorDivs = $$('.form_error');
  var numFormErrorDivs = formErrorDivs.length;
  //Loops through all of the form error div's to 
  //delete any error messages from previous errors
  for(var i = 0; i < numFormErrorDivs; i++)
  {
	Element.update(formErrorDivs[i].id, "");
  }
  //Evaluate the code in yzValidator_eval_onsuccess tag if there are no errors 
  if(numElementsInResponse == 0)    
  {
	eval($(hidden_id).value);
  } else
  {
    //If there are errors, loop through the JSON data and
	//update each form_error div with its corresponding message
	for (var i = 0; i < numElementsInResponse; i++)
    {
	 elementId=json[i][0];
  	 elementText=json[i][1];
	 Element.update(elementId, elementText);
	 new Effect.BlindDown(elementId, {duration:0.5});
	} 
  }
}