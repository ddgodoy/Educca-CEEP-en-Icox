<?php use_helper('I18N', 'Validation', 'sfSimpleForum') ?>

<?php slot('forum_navigation') ?>
<?php if (!$topic_id): ?>
<?php echo forum_breadcrumb(array(
  array(__(sfConfig::get('app_sfSimpleForumPlugin_forum_name', 'Forums')), 'sfSimpleForum/forumList'),
  array($forum->getName(), 'sfSimpleForum/forum?forum_name='.$forum->getStrippedName()),
  __('New topic')
)) ?>
<?php else: ?>
<?php echo forum_breadcrumb(array(
  array(__(sfConfig::get('app_sfSimpleForumPlugin_forum_name', 'Forums')), 'sfSimpleForum/forumList'),
  array($forum->getName(), 'sfSimpleForum/forum?forum_name='.$forum->getStrippedName()),
  array($topic_name, 'sfSimpleForum/topic?id='.$topic_id.'&stripped_title='.$topic_stripped_title),
  __('New reply')
)) ?>
<?php endif; ?>
<?php echo end_slot(); ?>


  <h1>
  <div id="redactar_mensaje">
    <div class="tit_box_mensajes">
        <h2 class="titbox">
            <?php if(!$topic_id): ?>
            <?php echo __('Crear nuevo tema') ?>
            <?php else: ?>
            <?php echo __('Responder a "%title%"', array('%title%' => $topic_name)) ?>
            <?php endif; ?>
        </h2>
    </div>

  <div class="cont_box_correo">
      <?php echo form_tag('sfSimpleForum/addPost', '') ?>
            <?php echo input_hidden_tag('forum_name', $forum->getStrippedName()) ?>
            <?php echo input_hidden_tag('topic_id', $topic_id) ?>
       <table class="tablaredactar">
         <tr>
          <td class="param">Titulo:</td>
          <td>
            <?php echo form_error('title') ?>
            <?php //echo label_for('title', __('Titulo')) ?>
            <?php echo input_tag('title', $topic_id ? __('Re: ') . $topic_name : '', 'class=input') ?>
          </td>
         </tr>

         <tr>
          <td class="param">Mensaje:</td>
          <td>
            <?php echo form_error('body') ?>
            <?php //echo label_for('body', __('Mensaje')) ?>
            <?php echo textarea_tag('body', '', 'rich=true size=85x20 tinymce_options=language:"es", height:"435px", width:"550px", theme:"simple"') ?></td>
            <?php //echo textarea_tag('body', '', 'id=topic_body') ?>
            <?php if ($sf_user->hasCredential('moderator') &&  (!$topic_id)): ?>
                <div class="option">
                    <h5><?php echo checkbox_tag('is_sticked', '1')?> Tema importante</h5>
                    <?php /*echo label_for('is_sticked', __('Sticked topic')) */?>
                </div>
            <?php endif; ?>
            </td>
         </tr>

    </table>
    <?php echo submit_tag(__('Guardar'), 'id=topic_submit') ?>

    </form>
    <? use_helper('volver');         echo volver();     ?>
  </div>

  <div class="cierre_box_correo"></div>
  </div>