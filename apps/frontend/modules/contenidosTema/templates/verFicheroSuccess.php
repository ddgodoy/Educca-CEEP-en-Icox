<?php echo use_helper('Javascript') ?>
<div id="notificacion" style="display:none;"></div>
<?php echo periodically_call_remote(array(
    'frequency' => 30,
    'update'    => 'notificacion',
    'url'       => 'contenidosTema/controlTiempo?idtema='.$tema->getId()
)) ?>

<iframe id="iframe" src='/materias/<?echo $materia->getId() ?>/<?echo $tema->getFichero()?>?sid=<?=session_id();?>'  width="100%" height="<?echo $materia->getHeight()?>px"></iframe>

<?php echo javascript_tag("

   function LMSInitialize()
 {".remote_function(array(
			    		'update'  => 'notificacion',
    					'url'     => 'contenidosTema/initialize?idtema='.$tema->getId()
  						))
."
	}


   function LMSFinish()
  { ".remote_function(array(
			    		'update'  => 'notificacion',
    					'url'     => 'contenidosTema/finish?idtema='.$tema->getId()
  						))
."
    //window.close();
	}

")
?>
