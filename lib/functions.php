<?php

    // FUNCION AUXILIAR NECESARIA
    function traducir_de_fecha_scorm12 ($string, $tipo=null)
    {
      if ((!$string) && ($tipo != 1)) {return 0;}
      $parametros = explode(':', $string);

      $horas = (int) $parametros[0];
      $minutos = (int) $parametros[1];
      $segundos = floor((int) $parametros[2]);

      $total = ($horas * 3600) + ($minutos * 60) + $segundos;

      if ($tipo!=1)
      {
         return $total;
      }else{
             $horas = floor($ttotal / 3600);
             $minutos = (floor($ttotal / 60) % 60);
             return "$horas horas, $minutos minutos y $segundos segundos";
           }
    }

    function traducir_scorm12_a_fecha($segundos)
    {
        $minutos=$segundos/60;
        $horas=floor($minutos/60);
        $minutos2=$minutos%60;
        $segundos_2=$segundos%60%60%60;

        if($minutos2<10)$minutos2='0'.$minutos2;
        if($segundos_2<10)$segundos_2='0'.$segundos_2;

        if($segundos<60)
        { /* segundos */
        $resultado= '0000:00:'.round($segundos);
        }
        elseif($segundos>60 && $segundos<3600)
        {/* minutos */
        $resultado= '0000:'.$minutos2.':'.$segundos_2;
        }
        else
        {/* horas */
        $resultado= $horas.':'.$minutos2.':'.$segundos_2;
        }
        return $resultado;
    }

  /**
   *
   * @param int $id_materia
   * @param int $id_curso
   * @return true / false
   */
  function isEditableTime($id_user, $id_curso)
  {
    $return = false;

    $curso = CursoPeer::retrieveByPk($id_curso);

    $c = new Criteria();
    $c->add(Sco12Peer::ID_MATERIA, $curso->getMateriaId());
    $c->add(Rel_usuario_sco12Peer::ID_USUARIO, $id_user);
    $c->addJoin(Sco12Peer::ID, Rel_usuario_sco12Peer::ID_SCO12);
    $rel = Rel_usuario_sco12Peer::DoSelectOne($c);


    $tareas = $curso->getTareas();

     $tiempo=0;
     foreach($tareas as $tarea)
     {
       $c = new Criteria();
       $c->add(Rel_usuario_tareaPeer::ID_USUARIO, $id_user);
       $c->add(Rel_usuario_tareaPeer::ID_TAREA, $tarea->getId());
       $tareas_usuarios = Rel_usuario_tareaPeer::doSelect($c);

       foreach($tareas_usuarios as $tarea_usuario )
       {
         $c1 = new Criteria();
         $c1->add(Ejercicio_resueltoPeer::ID_AUTOR, $id_user);
         $c1->add(Ejercicio_resueltoPeer::ID, $tarea_usuario->getIdEjercicioResuelto());
         $tareas_resueltas = Ejercicio_resueltoPeer::doSelect($c1);
       }
     }

     if(!empty($rel) || !empty($tareas_resueltas))
     {
         $return = true;
     }

     return $return;
  }
?>
