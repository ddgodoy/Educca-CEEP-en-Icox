<?php

/**
 * Looks for Javascript files based on current action/module and adds them to
 * the current response object.
 *
 * Add this filter to the end of your filter chain in filters.yml, after the
 * execution filter:
 *
 * <code>
 *     rendering: ~
 *     web_debug: ~
 *     security:  ~
 *
 *     # generally, you will want to insert your own filters here
 *
 *     cache:     ~
 *     common:    ~
 *     flash:     ~
 *     execution: ~
 *
 *     auto_javascript_include:
 *       class: myAutoJavascriptIncludeFilter
 * </code>
 *
 * @package     Automatic Javascript Include (AJI)
 * @subpackage  filter
 * @author      Kris Wallsmith <kris [dot] wallsmith [at] gmail [dot] com>
 * @version     SVN: $Id$
 * @copyright   Have at it ...
 */
class myAutoJavascriptIncludeFilter extends sfFilter
{
    /**
     * Include external Javascript files based on last action called.
     *
     * This kicks in on the way back down the filter chain, so we're sure to
     * catch the last action. Looks through the web/js folder for files that
     * match the naming syntax and adds them to the response.
     *
     * You can specify a subfolder of the web/js folder for the filter to
     * search in app.yml.
     *
     * @author  Kris Wallsmith <kris [dot] wallsmith [at] gmail [dot] com>
     * @see     sfConfig::get('app_aji_subfolder')
     * @param   sfFilterChain $filterChain
     */
    public function execute($filterChain)
    {
        $filterChain->execute();

        $sf_context  = sfContext::getInstance();
        $sf_response = $sf_context->getResponse();
        $sf_web_dir  = sfConfig::get('sf_web_dir');

        $module = $sf_context->getModuleName();
        $action = $sf_context->getActionName();

        $sub_folder = sfConfig::get('app_aji_subfolder');
        if($sub_folder && $sub_folder{0} != '/') $sub_folder = '/' . $sub_folder;

        $fmt = '/js%s/%s/%s.js';

        $mod_mod_js = sprintf($fmt, $sub_folder, $module, $module);
        $mod_act_js = sprintf($fmt, $sub_folder, $module, $action);

        if(file_exists($sf_web_dir . $mod_mod_js)) $sf_response->addJavascript($mod_mod_js);
        if(file_exists($sf_web_dir . $mod_act_js)) $sf_response->addJavascript($mod_act_js);
    }
}

?>