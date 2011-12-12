<?php

/**
 * Subclass for performing query and update operations on the 'sf_simple_forum_post' table.
 *
 * 
 *
 * @package plugins.sfSimpleForumPlugin.lib.model
 */ 
class sfSimpleForumPostPeer extends BasesfSimpleForumPostPeer
{
  public static function getRepliesCriteria($post_id)
  {
    $c = new Criteria();
    $criterion = $c->getNewCriterion(self::PARENT_ID, $post_id);
    $criterion->addOr($c->getNewCriterion(self::ID, $post_id));
    $c->add($criterion);
    $c->addAscendingOrderByColumn(self::ID);

    return $c;
  }
  
  public static function getReplies($post_id, $max = 10)
  {
    $c = self::getRepliesCriteria($post_id);
    $c->setLimit($max);
    
    return self::doSelect($c);
  }
  
  public static function getRepliesPager($post_id, $page = 1, $max_per_page = 10)
  {
    $c = self::getRepliesCriteria($post_id);
    $pager = new sfPropelPager('sfSimpleForumPost', $max_per_page);
    $pager->setPage($page);
    $pager->setCriteria($c);
    $pager->init();

    return $pager;
  }
  
  public static function getLatestCriteria()
  {
    $c = new Criteria();
    $c->addDescendingOrderByColumn(self::ID);

    return $c;
  }  
  
  public static function getLatest($max = 10)
  {
    $c = self::getLatestCriteria();
    $c->setLimit($max);
    
    return self::doSelect($c);
  }
  
  public static function getLatestPager($page = 1, $max_per_page = 10)
  {
    $c = self::getLatestCriteria();
    $pager = new sfPropelPager('sfSimpleForumPost', $max_per_page);
    $pager->setPage($page);
    $pager->setCriteria($c);
    $pager->setPeerMethod('doSelectJoinsfSimpleForumForum');
    $pager->init();

    return $pager;
  }

  public static function getForumLatestCriteria($forum_name)
  {
    $c = new Criteria();
    $c->addJoin(self::FORUM_ID, sfSimpleForumForumPeer::ID);
    $c->add(sfSimpleForumForumPeer::STRIPPED_NAME, $forum_name);
    $c->addDescendingOrderByColumn(self::ID);

    return $c;
  }  
  
  public static function getForumLatest($forum_name, $max = 10)
  {
    $c = self::getForumLatestCriteria($forum_name);
    $c->setLimit($max);
    
    return self::doSelect($c);
  }
  
  public static function getForumLatestPager($forum_name = '', $page = 1, $max_per_page = 10)
  {
    $c = self::getForumLatestCriteria($forum_name);
    $pager = new sfPropelPager('sfSimpleForumPost', $max_per_page);
    $pager->setPage($page);
    $pager->setCriteria($c);
    $pager->setPeerMethod('doSelectJoinsfSimpleForumForum');
    $pager->init();

    return $pager;
  }
    
  public static function getForUserCriteria($user_id)
  {
    $c = new Criteria();
    $c->add(self::USER_ID, $user_id);
    $c->addDescendingOrderByColumn(self::ID);

    return $c;
  }  

  public static function getForUser($user_id, $max = 10)
  {
    $c = self::getForUserCriteria($user_id);
    $c->setLimit($max);
    
    return self::doSelect($c);
  }

  public static function getForUserPager($user_id, $page = 1, $max_per_page = 10)
  {
    $c = self::getForUserCriteria($user_id);
    $pager = new sfPropelPager('sfSimpleForumPost', $max_per_page);
    $pager->setPage($page);
    $pager->setCriteria($c);
    $pager->setPeerMethod('doSelectJoinsfSimpleForumForum');
    $pager->init();

    return $pager;
  }
  
}
