<?php use_helper('Javascript') ?>
<?php use_helper('informacion') ?>
<?php use_helper('SexyButton') ?>

<div class="capa_principal" id="ejercicios">
  <div class="titulo_principal"><h2 class="titbox">Auditoría a usuario "Supervisor SRE"</h2></div>
  <div class="contenido_principal">
    <div class="herramientas_general">
      <br>
        <div>
            <table style="text-align: left;">
                  <tr>
                    <td><strong>Nombre del alumno: &nbsp;&nbsp;&nbsp;</strong></td>
                    <td><strong><?php echo $usuario->getNombre().', '.$usuario->getApellidos() ?></strong></td>
                  </tr>
                  <tr>
                    <td style="height: 10px;  "></td>
                  </tr>
                  <tr>
                    <td>DNI:</td>
                    <td>&nbsp;<?php echo $usuario->getDni() ?></td>
                  </tr>
                  <tr>
                    <td style="height: 10px;  "></td>
                  </tr>
                  <tr>
                    <td>Email:</td>
                    <td>&nbsp;<?php echo $usuario->getEmail() ?></td>
                  </tr>
                  <tr>
                    <td style="height: 10px;  "></td>
                  </tr>
                  <tr>
                    <td>Ultimo acceso:</td>
                    <td>&nbsp;<?php echo $usuario->getUltimoacceso() ?></td>
                  </tr>
                  <tr>
                    <td style="height: 10px;  "></td>
                  </tr>
                  <tr>
                    <td>Ultima IP:</td>
                    <td>&nbsp;<?php echo $usuario->getUltimaip() ?></td>
                  </tr>
                  <tr>
                    <td style="height: 10px;  "></td>
                  </tr>
                  <tr>
                    <td>Cantidad de conexiones: </td>
                    <td>&nbsp;<?php echo $usuario->getNumconexion() ?></td>
                  </tr>
            </table>
            <br/>
            <div class="titulos_tabla_general" style=" width: 720px;">
              <table  border='0'  width="100%">
                <tr>
                  <th style="text-align:left; width: 480px; padding-left:3px;">Eventos</th>
                </tr>
              </table>
            </div>
            <table class="tablaseg">
                <tr>
                    <th style="width: 25%">Fecha Inicio</th>
                    <th style="width: 25%">Fecha Fin</th>
                    <th style="width: 45%">Titulo</th>
                    <th style="width: 15%">Tipo</th>
                </tr>
                <?php $col = 0 ?>
                <?php foreach($array_evento as $v): ?>
                <?php $fondo1 = (($col % 2 == 0))? "id=\"filarayada\"" : ""; ?>
                <tr <?=$fondo1?> style="height: 25px">
                    <td><?php echo $v['fecha_inicio'] ?></td>
                    <td><?php echo $v['fecha_fin'] ?></td>
                    <td><?php echo $v['titulo'] ?></td>
                    <td><?php echo $v['tipo'] ?></td>
                </tr>
                <?php endforeach ?>
            </table>
        <br clear="all"/>
        </div>
    </div>
  </div>
  <div class="cierre_principal"></div>
</div>