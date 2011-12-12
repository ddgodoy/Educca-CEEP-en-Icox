<?
require_once(dirname(__FILE__).'/../../bootstrap/functional.php');
require_once(dirname(__FILE__).'/../../lib/sfMyTestBrowser.class.php');

require_once(dirname(__FILE__).'/../../lib/adminTest.class.php');
require_once(dirname(__FILE__).'/../../lib/profesorTest.class.php');
require_once(dirname(__FILE__).'/../../lib/alumnoTest.class.php');

// create a new test browser
$browser = new sfMyTestBrowser();

$admin_nombreusuario = "admin";
$admin_password = "4dm1n";

$t = new lime_test();
$browser->initialize();

$adminTest = new adminTest($browser, $t, $admin_nombreusuario, $admin_password);

//login
$t->diag('*********************************************************************');
$t->diag('                         ADMINISTRACION TEST                         ');
$t->diag('*********************************************************************');

$adminTest->loggin();

$t->diag('');
$t->diag('-------------------------------------------------------------------');
$t->diag('                           Test de menu');
$t->diag('-------------------------------------------------------------------');

$adminTest->checkMenu();

$t->diag('');
$t->diag('-------------------------------------------------------------------');
$t->diag('                           Test de siteMap');
$t->diag('-------------------------------------------------------------------');

$adminTest->checkSiteMap();


$adminTest->logout();
?>