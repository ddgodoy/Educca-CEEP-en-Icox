<?php

/**
 * check_yaml batch script
 *
 * Load a YAML file and spit it back out again
 * If its got an error it should be easy to see where!
 * 
 * To install:
 * 1 Place in the myapp/batch directory
 * 2 Configure the SF_APP and SF_ENVIRONMENT variables
 * 
 * To execute:
 * Run from the batch directory, so change directory to there first
 * cd myapp/batch
 * Run from the command line, specify the full path name to the YAML file to be tested
 * Example: php check_yaml.php C:\workspace\myapp\config\schema.yml
 * 
 * @package    mypackage
 * @subpackage batch
 * @version    $Id$
 */

define('SF_ROOT_DIR',    realpath(dirname(__file__).'/..'));
define('SF_APP',         'frontend');
define('SF_ENVIRONMENT', 'dev');
define('SF_DEBUG',       1);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

if ( ($argc <> 2) or ($argv[1]=='\h') or ($argv[1]=='--help') or ($argv[1]=='-h'))
{
    printf("Usage: php check_yaml.php filename\n");
    printf("Read and print out a YAML file using the symfony library.\n");
    printf("Example: php check_yaml.php C:\workspace\myapp\config\schema.yml\n\n");
    printf("--------------------------------\n");
    printf("-- Detecting typical problems --\n");
    printf("--------------------------------\n");
    printf("Carefully examine the output this script creates.  Each parent and attribute should be on their own line,\n");
    printf("using the syntax: \n\n");
    printf("attribute: value \n\n");
    printf("If *any* deviation from this syntax is visible, then the YAML may be in error.  Examples of typical problems include:\n");
    printf("1. If a dash appears where a label was expected, then the YAML is missing a colon ':' for that label.\n");
    printf("   This shows up for higher-level labels.\n");
    printf("2. If the output shows more than one label on a line, or labels appear to run together, then the source YAML\n");
    printf("   could be missing a bracket or a colon, or both.  This shows up for lower-level labels.\n");  
    printf("3. If the script gives an error message from the Spyc.class.php file then the YAML is definitely in error.\n");
    printf("4. If the script gives an 'Undefined' message then the YAML is also definitely in error.\n");
    printf("   Check the YAML indentation, colons on labels, and bracketing.\n");    
}
else
{
    if (!file_exists($argv[1]))
    {
        printf("File \"$argv[1]\" does not exist!  Please use fully qualified pathnames.");
    }
    else
    {
        printf("** -- check_yaml Reading and printing $argv[1] -- **\n");
        $myreadyaml = sfYaml::load($argv[1]);
        $myyaml = sfYaml::dump($myreadyaml);
        echo $myyaml;
        printf("** -- check_yaml Done -- **");
    }
}

?>