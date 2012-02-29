<?php use_helper('I18N', 'Pagination', 'sfSimpleForum') ?>

<?php slot('forum_navigation') ?>
  <?php echo forum_breadcrumb($sf_data->getRaw('breadcrumb')) ?>
<?php end_slot() ?>

<?php if(sfConfig::get('app_sfSimpleForumPlugin_use_feeds', true)): ?>
<?php slot('auto_discovery_link_tag') ?>
  <?php echo auto_discovery_link_tag('rss', $feed_rule, array('title' => $feed_title)) ?>
<?php end_slot() ?>
<?php endif; ?>

<div class="sfSimpleForum">

  <h1><?php echo $title ?></h1>

  <div class="forum_figures">
    <?php echo format_number_choice('[0]Sin mensaje|[1]Un mensaje|(1,+Inf]%posts% mensajes', array('%posts%' => $post_pager->getNbResults()), $post_pager->getNbResults()) ?>
    <?php if(sfConfig::get('app_sfSimpleForumPlugin_use_feeds', true)): ?>
      <?php echo link_to(image_tag('/sfSimpleForumPlugin/images/feed-icon.png', 'align=top'), $feed_rule, 'title='.$feed_title) ?>
    <?php endif; ?>
  </div>

  <table id="messages">
    <?php foreach ($post_pager->getResults() as $post): ?>
      <?php include_partial('sfSimpleForum/post', array('post' => $post, 'include_thread' => true)) ?>
    <?php endforeach; ?>
  </table>

  <?php echo pager_navigation($post_pager, $rule) ?>

</div>