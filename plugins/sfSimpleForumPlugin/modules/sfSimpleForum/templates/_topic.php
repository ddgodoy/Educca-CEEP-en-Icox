<?php /*use_helper('miDate')*/ ?>
<tr>

  <td class="thread_name">
    <?php if ($topic->getIsSticked()): ?>
      <?php echo image_tag('/sfSimpleForumPlugin/images/sticky.gif', array(
        'align' => 'absbottom',
        'alt'   => __('Sticked topic'),
        'title' => __('Sticked topic')
      )) ?>
    <?php endif; ?>
    <?php echo link_to($topic->getTitle(), 'sfSimpleForum/topic?id='.$topic->getId().'&stripped_title='.$topic->getStrippedTitle(),array('id'=>'ln_foro_topic'.$topic->getId())) ?>
    <?php if ($sf_user->hasCredential('moderator')): ?>
    <ul class="post_actions">
      <li><?php echo link_to(__('Delete'), 'sfSimpleForum/deletePost?id='.$topic->getId()) ?></li>
    </ul>
    <?php endif; ?>
  </td>

  <td class="thread_author"><?php   echo $topic->getAuthorName()/*link_to($topic->getAuthorName(), 'sfSimpleForum/latestUserPosts?username='.$topic->getAuthorName())*/ ?></td>

  <td class="thread_replies"><?php echo $topic->getNbReplies() ?></td>

  <?php if (sfConfig::get('app_sfSimpleForumPlugin_count_views', true)): ?>
  <td class="thread_views"><?php echo $topic->getNbViews() ?></td>
  <?php endif; ?>

  <td class="thread_recent">
    <?php echo __('hace %date% por %author%', array(
      //'%date%'   => distance_of_time_in_words($topic->getLatestRepliedAt('U')),
      '%date%'   => $topic->distance_of_time_in_words(),
      '%author%' => $topic->getLatestReplyAuthorName()/*link_to($topic->getLatestReplyAuthorName(), 'sfSimpleForum/latestUserPosts?username='.$topic->getLatestReplyAuthorName())*/
      )) ?>
  </td>

</tr>