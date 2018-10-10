<?php

 class biblioteca_archivosComponents extends sfComponents
  {

  // Nombre del metodo: executeListaCursosAlumno
  // A�adida por: Jacobo Chaquet
  /* Descripcion: muestra la bibliotecas de archivos del curso 
  */
  public function executeListarBiblioteca()
  {
       $this->user = $this->getUser();
       
       $curso = CursoPeer::retrieveByPk($this->id_curso);
       $this->archivos = $curso->getBiblioteca_archivoss();
       return;
     }

}
