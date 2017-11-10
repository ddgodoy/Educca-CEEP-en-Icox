<?php echo use_helper('Javascript') ?>
<!--<script>
    function changeStatus(){
        alert('hola');
    }
</script>-->
<iframe id="frame_scorm" src="<?php echo $ruta ?>" width="<?php echo $width ?>" height="<?php echo $height ?>" border="0">

</iframe>
<!--<div>
    <button onclick="changeStatus()">Finalizar</button>
</div>-->
<?php echo javascript_tag("function LMSFinish(){".
                            remote_function(array(
			    	'update'  => 'notificacion',
    				'url'     => 'contenidosTema/finishScorm?idcurso='.$curso_id.'&idscorm='.$sco
                                )
                            )."window.close();}");
?>

