<?php

/**
 * online actions.
 *
 * @package    edoceo
 * @subpackage online
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class onlineActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $this->forward('default', 'module');
  }

  public function executeActualizaTiempo()
  { //return;echo "1<br>";
    $id_usuario = $this->getUser()->getAnyId();
    $usuario = UsuarioPeer::retrieveByPk($id_usuario);
    //$this->forward404Unless($usuario);
    //echo "1<br>";
    if ($usuario)
    {
       if ( !(  $this->getUser()->hasCredential('alumno') || $this->getUser()->hasCredential('profesor')  ) )
       {
          return sfView::NONE;
       }
       //echo "3<br>";
       $id_curso = $this->getUser()->getCursoMenu();
       if ($id_curso)
       { $curso = CursoPeer::retrieveByPk($id_curso);
         $modulos = $curso->getModulo($id_usuario);
         if ($modulos)
         { foreach ($modulos as $modulo)
           {
             $cursos = $modulo->getPaquete()->getCursos();
             foreach ($cursos as $curso)
             {
               $usuario->actualizaOnline($curso->getCurso()->getId());
             }
           }
         } else { $usuario->actualizaOnline($curso->getId());
                }
       }
    }

   //return sfView::NONE;
  }

  public function executeConectados()
  {
    $this->setLayout('eventoPopUp');  // este layout se utiliza en mas popout cuidado al modificar estilo¡¡¡

    $id_usuario = $this->getUser()->getAnyId();
    $usuario = UsuarioPeer::retrieveByPk($id_usuario);
    $this->forward404Unless($usuario);

    $this->onlines = array();
    if ($usuario)
    {  $id_curso = $this->getUser()->getCursoMenu();
       if ($id_curso)
       { $curso = CursoPeer::retrieveByPk($id_curso);
         $modulos = $curso->getModulo($id_usuario);


         if ($modulos)
         { $ids= array();
           foreach ($modulos as $modulo)
           { $cursos = $modulo->getPaquete()->getCursos();
             $this->onlines[]=$modulo->getPaquete()->getUsuarioOnline($id_usuario);
             $this->nombre = $modulo->getPaquete()->getNombre();
           }
         } else {
                  $this->onlines[]=$curso->getUsuarioOnline($id_usuario);
                  $this->nombre = $curso->getNombre();
                }
       }
    }
  }
}
