<?php use_helper('Date', 'Text', 'I18N') ?>
<tr>
  <td class="forum_name">
    <?php echo link_to($forum->getName(), 'sfSimpleForum/forum?forum_name='.$forum->getStrippedName()) ?><br />
    <span class="forum_description"><?php echo simple_format_text($forum->getDescription()) ?></span>
  </td>
  <td class="forum_threads"><?php echo $forum->getNbThreads() ?></td>
  <td class="forum_posts"><?php echo $forum->getNbPosts() ?></td>
  <td class="forum_recent">
    <?php echo __('hace %date% por %author%', array(
      '%date%'   => distance_of_time_in_words($forum->getLatestRepliedAt('U')),
      '%author%' => link_to($forum->getLatestReplyAuthorName(), 'sfSimpleForum/latestUserPosts?username='.$forum->getLatestReplyAuthorName())
      )) ?>
  </td>
</tr>