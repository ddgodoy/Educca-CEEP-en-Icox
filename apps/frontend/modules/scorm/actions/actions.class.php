<?php

/**
 * scorm actions.
 *
 * @package    edoceo
 * @subpackage scorm
 * @author     ÁNGEL MARTÍN LATASA
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class scormActions extends sfActions
{
  
  public function executeCmiQuery()
  {
    $this->setLayout(false);
    $query = $this->getRequestParameter('query');
    $param = $this->getRequestParameter('param');
    $cmi = $this->getUser()->getAttribute('objeto_cmi');
    $this->result = $cmi->performQuery($query, $param);
  }
  
  public function executeTestScorm()
  {
    $cmi = new CMI();
    $user = $this->getUser();
    $user->setAttribute('objeto_cmi', $cmi);
    $this->setLayout('scormBrowser');
    
  }
  
  public function executeTestcmi()
  {
    $c = new Criteria();
    $rel = Rel_usuario_sco12Peer::DoSelectOne($c);
    
    $userid = $rel->getIdUsuario();
    $idsco = $rel->getIdSco12();
    $this->userid = $userid;
    $this->idsco = $idsco;
    
    $cmi = new CMI($userid, $idsco);
    $this->cmi = $cmi;
    $this->mensaje = "Usuario / Id_SCO: $userid $idsco <br>"; 

    
    
  }
  
}
