<?php use_helper('Url', 'Javascript');
/*
 * This file is part of the symfony package.
 * (c) 2007 Serg Kalachev <serg@kalachev.ru>
 *
 * Based on original idea by Alex Griffioen
 * http://www.oscaralexander.com/tutorials/how-to-make-sexy-buttons-with-css.html
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * SexyButtonHelper. Version 1.0.3
 *
 * @package    symfony
 * @subpackage helper
 * @author     Serg Kalachev <serg@kalachev.ru>
 */

/**
 * Creates an sexy button of the given name pointing to a routed URL
 * based on the module/action passed as argument and the routing configuration.
 * The syntax is similar to the one of link_to.
 *
 * <b>Options:</b>
 * - 'absolute' - if set to true, the helper outputs an absolute URL
 * - 'query_string' - to append a query string (starting by ?) to the routed url
 * - 'confirm' - displays a javascript confirmation alert when the link is clicked
 * - 'popup' - if set to true, the link opens a new browser window
 * - 'post' - if set to true, the link submits a POST request instead of GET (caution: do not use inside a form)
 *
 * - 'div_class' - set non-default CSS class name for div element
 * - 'button_class' - set non-default CSS class name for anchor element
 * - 'nodiv' - if set to true, do not generate outter div (i.e. several sexy buttons)
 *
 * <b>Examples:</b>
 * <code>
 *  echo sexy_button_to('Delete this page', 'my_module/my_action');
 *    => <div class="sexy-button-clear">
 *         <a class="sexy-button" href="/path/to/my/action" onclick="this.blur(); ">
 *           <span>Delete this page</span>
 *         </a>
 *       </div>
 *
 *  echo '<div class="sexy-button-clear">';
 *  echo sexy_button_to('Action1', 'my_module/my_action1', 'nodiv=true');
 *  echo sexy_button_to('Action2', 'my_module/my_action2', 'nodiv=true' );
 *  echo '</div>';
 *    => <div class="sexy-button-clear">
 *         <a class="sexy-button" href="/path/to/my/action1" onclick="this.blur(); ">
 *           <span>Action1</span>
 *         </a>
 *         <a class="sexy-button" href="/path/to/my/action2" onclick="this.blur(); ">
 *           <span>Action2</span>
 *         </a>
 *       </div>
 * </code>
 *
 * You can customize sexy buttons stylesheet per applicaction basis
 * Add the following lines to your app.yml and modify them according to your own css:
 *
 *   sfSexyButtonPlugin:
 *     stylesheet:   /sfSexyButtonPlugin/css/sexy_button
 *     div_class:    sexy-button-clear
 *     button_class: sexy_button
 *
 * @param  string name of the button
 * @param  string 'module/action' or '@rule' of the action
 * @param  array additional HTML compliant tag parameters
 * @return string XHTML compliant tags
 * @see    url_for, link_to, button_to
 */

function sexy_button_to( $name, $internal_uri, $options = array())
{
  $css_to_include   = sfConfig::get( 'app_sfSexyButtonPlugin_stylesheet', '/sfSexyButtonPlugin/css/sexy_button' );
  $def_div_class    = sfConfig::get( 'app_sfSexyButtonPlugin_div_class', 'sexy-button-clear' );
  $def_button_class = sfConfig::get( 'app_sfSexyButtonPlugin_button_class', 'sexy-button');
  sfContext::getInstance()->getResponse()->addStylesheet( $css_to_include );
  $html_options = _convert_options($options);
  // div class
  $div_class = _get_option($html_options, 'div_class', $def_div_class);
  // button class
  $button_class = _get_option($html_options, 'button_class', $def_button_class );
  $html_options['class'] = $button_class;
  // output div ?
  $nodiv = _get_option($html_options, 'nodiv', false);
  
  // One extra measure for IE
  $html_options['onclick'] = 'this.blur(); ponerLoading(this); '.
    ((isset($html_options['onclick']) ) ?
      $html_options['onclick'] : '');
  $html_options['id'] = "sexyid";
  // generate html
  $html = link_to( content_tag( 'span', $name), $internal_uri, $html_options );
  return ($nodiv) ? $html : content_tag( 'div', $html, "class=$div_class" );
}

/**
 * Returns a sexy button that'll trigger a javascript function using the
 * onclick handler and return false after the fact.
 *
 * The syntax is similar to the one of sexy_button_to.
 */

function sexy_button_to_function($name, $function, $options = array())
{
  $html_options = _convert_options($options);
  $html_options['href'] = isset($html_options['href']) ? $html_options['href'] : '#';
  $html_options['onclick'] = "$function; return false;";
  return sexy_button_to( $name, null, $html_options);
}

/**
 * Returns a sexy button to a remote action defined by 'url' (using the
 * 'url_for()' format) that's called in the background using XMLHttpRequest.
 *
 * See link_to_remote() for details.
 *
 */
function sexy_button_to_remote($name, $options = array(), $html_options = array())
{
  return sexy_button_to_function($name, remote_function($options), $html_options);
}


/**
 * Returns a sexy submit form button.
 */
function sexy_submit_tag($value = 'Save changes', $options = array())
{
  return sexy_button_to_function( $value, "var form = this; ".
    "while(null != (form = form.parentNode)) if( form.nodeName == 'FORM') ".
      "if( (form.onsubmit && form.onsubmit()) || (!(form.onsubmit)) ) form.submit();",
        $options );
}

/**
 * Returns a sexy reset form button.
 */
function sexy_reset_tag($value = 'Reset', $options = array())
{
  return sexy_button_to_function( $value, "var form = this; ".
    "while(null != (form = form.parentNode)) if( form.nodeName == 'FORM') ".
      "if( (form.onreset && form.onreset()) || (!(form.onreset)) ) form.reset();",
         $options );
}
