<?php use_helper('Validation') ?>
<div class="logintop_perfil"></div>
<div id="content">
<div class="loginbox clearfix twocolumns">
  <div class="loginpanel">
    <h2>Selecci&oacute;n de Perfil</h2>
      <div class="subcontent loginsub">
        <div class="desc">
    	  <strong><?php echo $nombre ?></strong>, selecciona el perfil con el que deseas entrar
    	  </div>
      	  <?php echo form_tag('login/seleccionOk') ?>
      	  <select name="rol" id="rol">
      	  <?php foreach ($roles as $rol):?>
      	   <option value="<?php echo $rol ?>"> <?php echo $rol ?></option>
      	  <?php endforeach;?>
      	  </select>

          <span class="form-submit"><?php echo submit_tag('Ok') ?></span>
          </form>
        </form>
      </div>
</div>
</div> <!-- end div content -->
<div class="logincierre_perfil"></div>
