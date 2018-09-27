<?php use_helper('I18N', 'Pagination', 'sfSimpleForum') ?>

<?php slot('forum_navigation') ?>
  <?php echo forum_breadcrumb($sf_data->getRaw('breadcrumb')) ?>
<?php echo end_slot() ?>

<?php if(sfConfig::get('app_sfSimpleForumPlugin_use_feeds', true)): ?>
<?php slot('auto_discovery_link_tag') ?>
  <?php /*echo auto_discovery_link_tag('rss', 'sfSimpleForum/latestForumPostsFeed?forum_name='.$forum->getStrippedName(), array('title' => $feed_title)) */?>
<?php end_slot() ?>
<?php endif; ?>
<div id="divforo">
  <div class="tit_box_mensajes"><h2 class="titbox">
    <div class='foro_nombre'>
  <?php if ($sf_user->getCursoMenu()) :?>
    <?php echo "Foro - ".CursoPeer::retrieveByPk($sf_user->getCursoMenu())->getNombre() ?>
  <?php else : ?>
      <?php echo "Foro - General" ?>
  <?php endif; ?>
     </div>
  </h2></div>
  <div class="cont_box_correo">
    <div class="sfSimpleForum">
      <ul class="forum_actions">
        <?php  if ( ($sf_user->esAlumnoCurso($forum->getStrippedName()))
    		         || ($sf_user->esProfesorCurso($forum->getStrippedName()))
    		         || ( sfSimpleForumForumPeer::retrieveByStrippedName($forum->getStrippedName())->getCursoId()==NULL) //foro general
    				 ||($sf_user->hasCredential('supervisor'))) : ?>
        <li><?php echo link_to(__('Nuevo Tema'), 'sfSimpleForum/createTopic?forum_name='.$forum->getStrippedName(),array('id'=>'ln_foro_nuevo_tema')) ?></li>
        <?php endif; ?>
      </ul>

      <div class="forum_figures">
        <?php echo format_number_choice('[0]No hay temas a&uacute;n|[1]Un tema|(1,+Inf]%threads% temas', array('%threads%' => $forum->getNbThreads()), $forum->getNbThreads()) ?>,
        <?php echo format_number_choice('[0]Sin mensaje|[1]Un mensaje|(1,+Inf]%posts% mensajes', array('%posts%' => $forum->getNbPosts()), $forum->getNbPosts())?>        <?php if(sfConfig::get('app_sfSimpleForumPlugin_use_feeds', true)): ?>
          <?php /*echo link_to(image_tag('/sfSimpleForumPlugin/images/feed-icon.png', 'align=top'), 'sfSimpleForum/latestForumPostsFeed?forum_name='.$forum->getStrippedName(), 'title='.$feed_title) */?>
        <?php endif; ?>
      </div>
      <table id="threads">
        <tr>
          <th class="thread_name"><?php echo __('Tema') ?></th>
          <th class="thread_author"><?php  echo __('Autor') ?></th>
          <th class="thread_replies"><?php echo __('Contestaciones') ?></th>
          <?php if (sfConfig::get('app_sfSimpleForumPlugin_count_views', true)): ?>
          <th class="thread_replies"><?php echo __('Lecturas') ?></th>
          <?php endif; ?>
          <th class="thread_recent"><?php echo __('Ultimo mensaje') ?></th>
        </tr>
        <?php $i = 0;?>
        <?php foreach ($topics->getResults() as $topic): ?>
          <?php include_partial('sfSimpleForum/topic', array('topic' => $topic));
                $i++; ?>
        <?php endforeach; ?>
      </table>

      <?php echo pager_navigation($topics, 'sfSimpleForum/forum?forum_name='.$forum->getStrippedName()) ?>

    </div>
  <?php use_helper('volver');         echo volver();     ?>
</div>
  <div class="cierre_box_correo"></div>
</div>