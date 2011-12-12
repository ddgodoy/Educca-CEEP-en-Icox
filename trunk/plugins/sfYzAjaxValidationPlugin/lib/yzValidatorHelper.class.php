<?php
/*
 * yzValidator class contains helpers to enable client side validation
 * 
 * This class offers static functions that are named after the Form and
 * Javascript helpers they replace. 
 * 
 * How this class works: Each of the form and javascript helpers are rewritten
 * so they first create an instance of the yzValidator class. That class takes
 * the  ajax option ($options) and html options ($html_options) and changes them
 * so that on submit, the form first sends an ajax request to the yzValidator::
 * VALIDATOR_MODULE module. That module calls the default symfony validation
 * functions and produces the error messages. The error message are then sent
 * back in JSON format and contain the div id of the form_error section and its
 * corresponding error message. The JSON is then processed by the javascript
 * function yzAV_JSONUpdater(). yzAV_JSONUpdater() looks through the JSON
 * request and updates all form_error div with its corresponding error message.
 * If no errors are present, the eval_on_success hidden field is evaluated. That
 * field contains the original submit action for the form. The form_tag degrades
 * smoothly. In the absence of JS, it just submits to the original action.
 * 
 * The syntax of the helpers are the same as the syntax of the symfony helpers
 * of the same name. Since the validation is done via an AJAX request, users can
 * set the optoins of validation request just like they would set the options
 * in the ajax helper tags. To differentiate the ajax options for the origial
 * form and the ajax option of the validation, the Validation options are
 * prefixed with 'yzValidation_'. For example, a yzValidatorHelper::
 * form_remote_tag that shows an indicator while waiting for validation to
 * complete and while submiting the form for real would be written as so:
 * 
 *  <?php 
 * echo  yzValidator form_remote_tag ('Delete this post', 
 * array( 'update'=>'feedback', 'url'=> 'post/delete?id='.$post->getId(), 
 * 'yzValidation_loading'=> "Element.show('indicator_while_validating')", 
 * 'yzValidation_complete'=>"Element.hide ('indicator_while_validating')",
 * 'loading' => "Element.show('indicator')", 
 * 'complete'=> "Element.hide('indicator')", )) ? >
 * 
 * @author Yining Zhao
 * @package sfYzAjaxValidationPlugin
 */
class yzValidatorHelper 
{

  /*
   * form_remote_tag() uses the same syntax as the symfony helper of the same
   * name. Most of the work is done by yzValidator::yzSetupValidation.
   * @see yzValidator::yzSetupValidation
   * @static
   * @return string returns the html tags that will setup the validation
   */
  public static function form_remote_tag($options = array(), $options_html = array())
  {
    $yzValidator = new yzValidator($options, $options_html,'ajax_remote_function');
    
    $form_tag = form_remote_tag($yzValidator->getValidationOptions(), $yzValidator->getOptionsHtml());
    
    return $form_tag.' '.$yzValidator->getHiddenValidationInfoFields();     
  }
  /*
   * submit_to_remote() uses the same syntax as its corresponding symfony
   * helper. 
   * @see yzValidator::yzSetupValidation
   * @static
   * @return string returns the html tags that will setup the validation
   */
  public static function submit_to_remote($name, $value, $options = array(), $options_html = array())
  {
    $yzValidator = new yzValidator($options, $options_html,'ajax_remote_function');
    $submit_tag = submit_to_remote($name, $value, 
      $yzValidator->getValidationOptions(), $yzValidator->getOptionsHtml());
         
    return $submit_tag.' '.$yzValidator->getHiddenValidationInfoFields(); 
  }
  /*
   * Creates a form tag that does client side validation when submited
   * @static
   * @return string returns the html tags that will setup the validation
   */
  public static function form_tag($url_for_options = '', $options_html = array())
  {
    /*
     * The url is needed in options so we will know the destination module and
     * action and its corresponding validation yml file
     */
    $options['url'] = $url_for_options;
    $yzValidator = new yzValidator($options, $options_html,'normal_submit');
    $options_html = $yzValidator->getOptionsHtml();
    $options_html['onsubmit'] = remote_function($yzValidator->getValidationOptions()).'; return false;';
    $form_tag = form_tag($url_for_options, $options_html);

    return $form_tag.' '.$yzValidator->getHiddenValidationInfoFields();
  }

}
?>