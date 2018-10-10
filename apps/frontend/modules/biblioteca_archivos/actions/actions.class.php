<?php

/**
 * biblioteca_archivos actions.
 *
 * @package    ceep
 * @subpackage biblioteca_archivos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class biblioteca_archivosActions extends sfActions
{

  public function executeDefault()
  {
    $this->redirect('login/redireccionar');
  }  

/**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $this->curso = CursoPeer::RetrieveByPk($this->getRequestParameter('idcurso'));
    
    $usuario = UsuarioPeer::retrieveByPk($this->getUser()->getAnyId());
    
    if (!$usuario)
    { $this->redirect('login/redireccionar');}
    
    if (!$usuario->permisoBibliotecaArchivos($this->curso->getId()))
    { $this->redirect('login/redireccionar');}
    
    $this->usuario = $usuario;
    
  }
  
  public function executeNuevo()
  {
    $this->curso = CursoPeer::RetrieveByPk($this->getRequestParameter('idcurso'));
    
    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
        // la asignacion a $this->ba es necesario para los test
        $this->ba=Biblioteca_archivos::saveForm($this->getRequest()->getParameterHolder(),$this->getRequest()->getFileName('fichero'));
        $this->redirect('biblioteca_archivos/index?idcurso='.$this->getRequestParameter('idcurso'));
    }
  }

  public function  executeEliminar()
  {
     $this->archivo = Biblioteca_archivosPeer::RetrieveByPk($this->getRequestParameter('id'));
     
     if ($this->archivo)
     { 
        if ($this->archivo->permiso('eliminar',UsuarioPeer::retrieveByPk($this->getUser()->getAnyId())))
        {   $this->archivo->customDelete();
            $this->redirect('biblioteca_archivos/index?idcurso='.$this->archivo->getIdCurso());
        }
     }
     $this->redirect('login/redireccionar');
  }

  public function executeModificar()
  {
    $this->archivo = Biblioteca_archivosPeer::RetrieveByPk($this->getRequestParameter('id'));

     if ($this->archivo)
     {  if ($this->archivo->permiso('modificar',UsuarioPeer::retrieveByPk($this->getUser()->getAnyId())))
        {   
           if ($this->getRequest()->getMethod() == sfRequest::POST)
            {
                // la asignacion a $this->ba es necesario para los test
                $this->ba=Biblioteca_archivos::saveForm($this->getRequest()->getParameterHolder(),$this->getRequest()->getFileName('fichero'),$this->archivo->getId());
                $this->redirect('biblioteca_archivos/index?idcurso='.$this->archivo->getIdCurso());
            }
        }
        else {  $this->redirect('biblioteca_archivos/index?idcurso='.$this->archivo->getIdCurso());}; 
     }
  } 
  
  public function handleErrorNuevo()
  {
    $this->curso = CursoPeer::RetrieveByPk($this->getRequestParameter('idcurso'));
    return sfView::SUCCESS;
  }

  public function handleErrorModificar()
  {
    $this->archivo = Biblioteca_archivosPeer::RetrieveByPk($this->getRequestParameter('id'));
    return sfView::SUCCESS;
  }

  public function executeDownload()
  {
    $this->archivo = Biblioteca_archivosPeer::RetrieveByPk($this->getRequestParameter('id'));
    
    if ($this->archivo)
     {  if ($this->archivo->permiso('download',UsuarioPeer::retrieveByPk($this->getUser()->getAnyId())))
        {
            $this->setLayout(false);
            $response = $this->getResponse();
            $response->clearHttpHeaders();
            $response->setHttpheader('Pragma: public', true); 
            $response->addCacheControlHttpHeader('Cache-Control', 'must-revalidate', true);
            $response->setContentType('application/octet-stream', true);                
            $response->setHttpHeader('Content-Description', 'File Transfer', true );
            $response->setHttpHeader('Content-Transfer-Encoding', 'binary', true);    
            $response->setHttpHeader('Content-Disposition', 'attachment; filename=' .$this->archivo->getNombre(), true);
            $response->sendHttpHeaders();
            $response->setContent(implode('',file($this->archivo->pathFile())));
            $response->sendContent();
            return sfView::NONE;
        }
     }
     $this->redirect('login/redireccionar');
  } 
  
  

}
