<?php use_helper('Validation') ?>
<?php use_helper('SexyButton') ?>
<div class="tit_box_menu"><h2 class="titbox">Alumnos inscritos</h2></div>
        <div class="loginsubcomp">
           <?php echo form_tag('login/login',array('name' => 'f_entrada')) ?>
           <div class="loginformcomp">
                <div class="form-labelcomp"><label for="nombreusuario">Nombre de usuario:</label></div>
                <div class="form-inputcomp"><?php echo form_error('nombreusuario') ?><?php echo input_tag('nombreusuario', $sf_params->get('nombreusuario'),array('onkeypress'=>'siguiente_campo(event, this.form.password)')) ?></div>
                <div class="form-labelcomp"><label for="password">Contrase&ntilde;a:</label></div>
                <div class="form-inputcomp"><?php echo form_error('password') ?><?php echo input_password_tag('password','',array('onkeypress'=>'iSubmitEnter(event, document.f_entrada,1)')) ?></div>
                <div class="submitcomp" ><?php echo sexy_submit_tag('Entrar') ?><input type="hidden" name="testcookies" value="1" /></div>
                <br><br>
                <center><a href="/login/claveolvidada" class="claveolvidada">&iquest;Olvid&oacute; su contrase&ntilde;a?</a></center>

	         </div>
          </form>
        </div><!-- loginsub -->
<div class="cierre_menu"></div>

<?php use_helper('submitEnter') ?>
<? echo  echoSubmitEnter()?>
