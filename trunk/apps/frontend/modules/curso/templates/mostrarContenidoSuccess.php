<?php echo use_helper('Javascript') ?>
<script type="text/javascript" src="/js/chat/jquery-3.1.1.min.js"></script>
<script type="text/javascript">
    function TemaFinish(){
        $.post( "/contenidosTema/finishScorm?type=1&idcurso=<?php echo $curso_id ?>&idscorm=<?php echo $sco ?>", function( data ) {
            window.opener.location.reload();
            window.close();  
        });
    }
</script>   
<?php echo $ruta; exit(); ?>
<iframe id="frame_scorm" src="<?php echo $ruta ?>" width="<?php echo $width ?>" height="<?php echo $height ?>" border="0">
</iframe>
<div style="position: fixed; margin: 0px auto; width: 100%; background-color: blue; bottom: 0px; height: 10%;">
    <button onclick="TemaFinish()" style="cursor: pointer; padding: 5px; margin-top: 15px;">Finalizar Tema</button>
</div>