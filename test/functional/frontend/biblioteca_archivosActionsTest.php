<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

// create a new test browser
$browser = new sfTestBrowser();
$browser->initialize();

//$browser->
//  get('/biblioteca_archivos/index')->
//  isStatusCode(200);
//  ->isRequestParameter('module', 'biblioteca_archivos')->
//  isRequestParameter('action', 'index')->
//  checkResponseElement('body', '!/This is a temporary page/')
