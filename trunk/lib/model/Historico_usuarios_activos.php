<?php

/**
 * Subclass for representing a row from the 'historico_usuarios_activos' table.
 *
 *
 *
 * @package lib.model
 */
class Historico_usuarios_activos extends BaseHistorico_usuarios_activos
{
  public function guardar()
  {
    $date =  date('Y-m').'-01';
    $usuario = new Usuario();
    $alumnos = $usuario->getAlumnosActivos();

    foreach($alumnos as $alumno)
    {   $alumno = $alumno->getUsuario();
        if ($historico=$this->existe($alumno,$date))
        {
            $historico->actualiza();
        }
        else{
               $this->guardarAlumno($alumno,$date);
            }
    }
  }

  public function guardarAlumno($alumno,$date)
  {
    $nuevo = new Historico_usuarios_activos();
    $nuevo->setFecha($date);
    $nuevo->setNombreusuario($alumno->getNombreusuario());
    $nuevo->setIdUsuario($alumno->getId());
    $nuevo->setNombre($alumno->getNombre());
    $nuevo->setApellidos($alumno->getApellidos());
    $nuevo->setDni($alumno->getDni());
    $nuevo->setEmail($alumno->getEmail());
    $nuevo->setTelefono1($alumno->getTelefono1());
    $nuevo->setTelefono2($alumno->getTelefono2());
    $nuevo->setDiasMatriculado(1);

    $nuevo->save();

    $cursosActivos = $alumno->getCursosActivos();
    foreach ($cursosActivos as $curso)
    {
       $curso = $curso->getCurso();
       $nuevo_curso = new Historico_cursos_usuarios_activos();
       $nuevo_curso->setIdHistoricoUsuariosActivos($nuevo->getId());
       $nuevo_curso->updateCurso($curso);
       $nuevo_curso->save();
    }
  }

  public function existe($alumno,$date)
  {
    $c = new Criteria();
    $c->add(Historico_usuarios_activosPeer::ID_USUARIO,$alumno->getId());
    $c->add(Historico_usuarios_activosPeer::FECHA,$date);

    if ($historico=Historico_usuarios_activosPeer::doSelectOne($c))
    {return $historico;}

    return false;
  }

  public function existeCurso($curso)
  {
    $c = new Criteria();
    $c->add(Historico_cursos_usuarios_activosPeer::ID_HISTORICO_USUARIOS_ACTIVOS,$this->getId());
    $c->add(Historico_cursos_usuarios_activosPeer::ID_CURSO,$curso->getId());

    if ($historico=Historico_cursos_usuarios_activosPeer::doSelectOne($c))
    {return $historico;}

    return false;
  }

  public function actualiza()
  {
     $this->setDiasMatriculado($this->getDiasMatriculado()+1);
     $this->updateAlumno();
     $this->updateCursos();
     $this->save();
  }

  public function updateAlumno()
  {
    $alumno = UsuarioPeer::retrieveByPk($this->getIdUsuario());
    if ($alumno)
    {
      $this->setNombreusuario($alumno->getNombreusuario());
      $this->setIdUsuario($alumno->getId());
      $this->setNombre($alumno->getNombre());
      $this->setApellidos($alumno->getApellidos());
      $this->setDni($alumno->getDni());
      $this->setEmail($alumno->getEmail());
      $this->setTelefono1($alumno->getTelefono1());
      $this->setTelefono2($alumno->getTelefono2());
      $this->save();
    }
  }

  public function updateCursos()
  {
    $alumno = UsuarioPeer::retrieveByPk($this->getIdUsuario());
    if ($alumno)
    {
      $cursosActivos = $alumno->getCursosActivos();
      foreach ($cursosActivos as $curso)
      {
         $curso = $curso->getCurso();
         if ($historico_curso=$this->existeCurso($curso))
         {
            $historico_curso->updateCurso($curso);
         }
         else{
               $nuevo_curso = new Historico_cursos_usuarios_activos();
               $nuevo_curso->setIdHistoricoUsuariosActivos($this->getId());
               $nuevo_curso->updateCurso($curso);
               $nuevo_curso->save();
             }
      }
    }
  }
}
