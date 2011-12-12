<?php use_helper('I18N', 'Pagination', 'sfSimpleForum') ?>

<?php slot('forum_navigation') ?>
  <?php echo forum_breadcrumb($sf_data->getRaw('breadcrumb')) ?>
<?php echo end_slot() ?>

<?php if(sfConfig::get('app_sfSimpleForumPlugin_use_feeds', true)): ?>
<?php slot('auto_discovery_link_tag') ?>
  <?php echo auto_discovery_link_tag('rss', 'sfSimpleForum/topicFeed?id='.$topic->getId().'&stripped_title='.$topic->getStrippedTitle(), array('title' => $feed_title)) ?>
<?php end_slot() ?>
<?php endif; ?>
<div id="divforo">
  <div class="tit_box_mensajes"><h2 class="titbox">
        <?php if ($sf_user->getCursoMenu()) : ?>
               <?echo "Foro - ".CursoPeer::retrieveByPk($sf_user->getCursoMenu())->getNombre()." - ".$topic->getTitle() ?>
         <? else : ?>
              Comunidad
         <? endif; ?>
  </h2></div>
  <div class="cont_box_correo">
    <div class="sfSimpleForum">
      <ul class="forum_actions">
      	    <?php  if ( ($sf_user->esAlumnoCurso($topic->getsfSimpleForumForum()->getStrippedName()))
    		         || ($sf_user->esProfesorCurso($topic->getsfSimpleForumForum()->getStrippedName()))
    		         || ( sfSimpleForumForumPeer::retrieveByStrippedName($topic->getsfSimpleForumForum()->getStrippedName())->getCursoId()==NULL) //foro general
    				 ||($sf_user->hasCredential('supervisor'))) : ?>
         		<li><?php echo link_to(__('Nuevo tema'), 'sfSimpleForum/createTopic?forum_name='.$topic->getsfSimpleForumForum()->getStrippedName()) ?></li>
         <?php endif; ?>
        <?php if ($sf_user->hasCredential('moderator')): ?>
          <li><?php echo link_to(
            $topic->getIsSticked() ? __('Unstick') : __('Stick'),
            'sfSimpleForum/toggleStick?id='.$topic->getId()
          ) ?></li>
        <?php endif; ?>
      </ul>

      <div class="forum_figures">
        <?php echo format_number_choice('[1]1 mensaje, sin respuesta|(1,+Inf]%posts% mensajes', array('%posts%' => $post_pager->getNbResults()), $post_pager->getNbResults()) ?>
        <?php if (sfConfig::get('app_sfSimpleForumPlugin_count_views', true)): ?>
        - <?php echo format_number_choice('[1]1 lectura|(1,+Inf]%views% lecturas', array('%views%' => $topic->getNbViews()), $topic->getNbViews()) ?>
        <?php endif; ?>
        <?php if(sfConfig::get('app_sfSimpleForumPlugin_use_feeds', true)): ?>
          <?php /*echo link_to(image_tag('/sfSimpleForumPlugin/images/feed-icon.png', 'align=top'), 'sfSimpleForum/topicFeed?id='.$topic->getId().'&stripped_title='.$topic->getStrippedTitle(), 'title='.$feed_title) */?>
        <?php endif; ?>
      </div>

      <table id="messages">
        <?php foreach ($posts as $post): ?>
          <?php  include_partial('sfSimpleForum/post', array('post' => $post, 'include_thread' => false )) ?>
        <?php endforeach; ?>
      </table>

      <?php echo pager_navigation($post_pager, 'sfSimpleForum/topic?id='.$topic->getId().'&stripped_title='.$topic->getStrippedTitle()) ?>

    </div>
    <? use_helper('volver');         echo volver();     ?>
  </div>
  <div class="cierre_box_correo"></div>
</div>