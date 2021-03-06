<?php use_helper('I18N', 'sfSimpleForum'); ?>

<?php slot('forum_navigation') ?>
  <?php echo forum_breadcrumb($sf_data->getRaw('breadcrumb')) ?>
<?php echo end_slot(); ?>

<?php if(sfConfig::get('app_sfSimpleForumPlugin_use_feeds', true)): ?>
<?php slot('auto_discovery_link_tag') ?>
  <?php echo auto_discovery_link_tag('rss', 'sfSimpleForum/LatestPostsFeed', array('title' => $feed_title)) ?>
<?php end_slot() ?>
<?php endif; ?>

<div class="sfSimpleForum">

  <h1><?php echo __(sfConfig::get('app_sfSimpleForumPlugin_forum_name', 'Forums')) ?></h1>

  <div class="forum_figures">
    <?php echo format_number_choice('[0]No topic yet|[1]One topic|(1,+Inf]%threads% topics', array('%threads%' => $threads), $threads) ?>,
    <?php echo link_to(
      format_number_choice('[0]Sin mensajes|[1]Un mensaje|(1,+Inf]%posts% mensajes', array('%posts%' => $posts), $posts),
      'sfSimpleForum/latestPosts'
      ) ?>
    <?php if(sfConfig::get('app_sfSimpleForumPlugin_use_feeds', true)): ?>
      <?php echo link_to(image_tag('/sfSimpleForumPlugin/images/feed-icon.png', 'align=top'), 'sfSimpleForum/latestPostsFeed', 'title='.$feed_title) ?>
    <?php endif; ?>
  </div>

  <?php $category = '' ?>
  <table id="fora">
    <tr>
      <th class="forum_name"><?php echo __('Forum') ?></td>
      <th class="forum_threads"><?php echo __('Topics') ?></td>
      <th class="forum_posts"><?php echo __('Messages') ?></td>
      <th class="forum_recent"><?php echo __('Last Message') ?></td>
    </tr>
    <?php foreach ($forums as $forum): ?>
      <?php $new_category = $forum->getsfSimpleForumCategory()->getName() ?>
      <?php if ($new_category != $category && sfConfig::get('app_sfSimpleForumPlugin_display_categories', true)): $category = $new_category ?>
        <tr class="category">
          <td class="category_header" colspan="4"><?php echo $category ?></td>
        </tr>
      <?php endif; ?>
      <?php echo include_partial('sfSimpleForum/forum', array('forum' => $forum)) ?>
    <?php endforeach; ?>
  </table>
</div>