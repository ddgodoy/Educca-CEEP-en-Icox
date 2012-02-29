<?php

/**
 * gestion actions.
 *
 * @package    educcaceep
 * @subpackage gestion
 * @authors    pinika
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class gestionActions extends sfActions
{
	public function executeTest()
	{
		/**/
	}

/**
 * Access to phpmyadmin
 *
 */
  public function executePhpmyadmin()
  {
  	header('location: /dbTempAccess/index.php'); exit();
  }
  
} // end class