<?php use_helper('Validation') ?>
  <div class="logintop"></div>
    <div class="loginbox">
            <h2>Alumnos inscritos</h2>
              <div class="loginsub">
                <div class="desc">Entre aqu&iacute; usando su nombre y contrase&ntilde;a<br/>(Las Cookies deben estar habilitadas en su navegador)</div>
                 <?php echo form_tag('login/login',array('name' => 'f_entrada')) ?>
                 <div class="loginform">
				 	<center>
                    <div class="form-label"><label for="nombreusuario">Nombre de usuario:</label></div>
                    <div class="form-input"><?php echo form_error('nombreusuario') ?><?php echo input_tag('nombreusuario', $sf_params->get('nombreusuario')) ?></div>
                    <div class="form-label"><label for="password">Contrase&ntilde;a:</label></div>
                    <div class="form-input"><?php echo form_error('password') ?><?php echo input_password_tag('password','') ?></div>
                    <div class="form-submit"><?php echo submit_tag('Entrar') ?><input type="hidden" name="testcookies" value="1" /></div>
                 	</center>
				 </div>
                </form>
              </div><!-- loginsub -->
              <div class="forgotsub">
                <div class="desc">&iquest;Olvid&oacute; su nombre de usuario o contrase&ntilde;a?</div>
                    <!--form action="login/claveolvidada" method="post" id="changepassword">
                      <div class="form-submit"><?php echo submit_tag('S&iacute;, ay&uacute;deme a entrar') ?></div>
                    </form-->
                    <div class="form-submit"><? echo link_to('S&iacute;, ay&uacute;deme a entrar', 'login/claveolvidada') ?></div>
              </div><!-- forgotsub -->
     		  <div class="signuppanel">
                 <h2>Registrarse como alumno</h2>
                 <div class="subcontent">Para tener acceso completo a los cursos necesita crear una cuenta en este sitio web. Estos son los pasos a seguir:
                   <ol>
                   <li><?php echo link_to('Cat&aacute;logo de cursos', 'comercial/index') ?></li>
                   <li>Seleccione el curso que le interesa y pulse sobre el bot&oacute;n "Matr&iacute;cula online"</li>
                   <li>Confirme su alta.</li>
                   <li>Para entrar en los cursos se le pedir&aacute; una "clave de acceso", que se le enviar&aacute; cuando se matricule en los mismos.</li>

                   <li>A partir de ese momento no necesitar&aacute; utilizar m&aacute;s que su nombre y contrase&ntilde;a.</li>
                   </ol>
                   <div class="signupform">
                      <div class="form-submit"><?php echo link_to('Cat&aacute;logo de cursos', 'comercial/index') ?></div><br/>
                   </div>
         		 </div> <!-- subcontent -->
     		   </div> <!-- signuppanel -->
      </div>
    <div class="logincierre"></div>

