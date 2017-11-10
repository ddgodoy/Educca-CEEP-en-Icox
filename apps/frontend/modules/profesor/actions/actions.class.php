<?php

/**
 * profesor actions.
 *
 * @package    edoceo
 * @subpackage profesor
 * @author     �ngel Mart�n Latasa y Santiago Mart�nez de la Riva
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class profesorActions extends sfActions
{

  // Action #1
  public function executeIndex()
  {
        $this->getUser()->getAttributeHolder()->remove('idcurso','profesor');
        $this->user = $this->getUser();
        return ;
  }

  // Action #2
  public function executeListaCursos()
  {
    $this->cursos = $this->getUser()->getCursosProfesor();
  }

   public function executeMisCursos()  /* desde su template se redirige al componente de cursos */
  {
    $this->getUser()->getAttributeHolder()->remove('idcurso');
    return ;
  }

  // Action #3
  public function executeListaAlumnos()
  {
    $this->cursos = $this->getUser()->getAlumnosProfesor();
  }

  // Action #4
  public function executeMostrarCurso()
  {
    $id = $this->getRequestParameter('id');
    $this->curso = CursoPeer::retrieveByPk($id);
  }

/* conflicto 27-11-2007
  public function executeGuardarLibro()
  {

   $this->idcurso = $this->getRequestParameter('idcurso');
   $c = new Criteria();
   $c->add(CursoPeer::ID, $this->idcurso);
   $this->curso = CursoPeer::doSelectOne($c);
   $this->forward404Unless($this->curso);

   //Se inserta el nuevo libro con los atributos correspondientes
   $libro = new Libro();
   $libro->setNombre($this->getRequestParameter('nombre'));
   $libro->setAutor($this->getRequestParameter('autor'));
   $libro->setEditorial($this->getRequestParameter('editorial'));
   $libro->setAnioPublicacion($this->getRequestParameter('publicacion'));
   $libro->setIsbn($this->getRequestParameter('isbn'));
   $libro->setIdMateria($this->curso->getMateriaId());
   $libro->save();
   return $this->redirect('curso/mostrarBibliografia?idcurso='.$this->idcurso);

  }

  public function executeNuevoLibro()
  {
      if (!$this->getUser()->hasCredential('profesor') ) {
          	return $this->redirect('login/logout');
      }
      $this->idcurso = $this->getRequestParameter('idcurso');
      $this->getUser()->setCursoMenu($this->idcurso);
  	  $c = new Criteria();
  	  $c->add(CursoPeer::ID, $this->idcurso);
  	  $this->curso = CursoPeer::doSelectOne($c);
  	  $this->forward404Unless($this->curso);
      //

  }*/

}

