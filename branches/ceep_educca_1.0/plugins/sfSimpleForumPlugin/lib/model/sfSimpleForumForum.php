<?php

/**
 * Subclass for representing a row from the 'sf_simple_forum_subforum' table.
 *
 * 
 *
 * @package plugins.sfSimpleForumPlugin.lib.model
 */ 
class sfSimpleForumForum extends BasesfSimpleForumForum
{
  public function setName($name)
  {
    parent::setName($name);
    $this->setStrippedName(sfSimpleForumTools::stripText($name));
  }

  public function getThreads($max = 10)
  {
    $c = $this->getThreadsCriteria();
    $c->setLimit($max);
    
    return sfSimpleForumPostPeer::doSelect($c);
  }

  public function getThreadsPager($page = 1, $max_per_page = 10)
  {
    $c = $this->getThreadsCriteria();
    $pager = new sfPropelPager('sfSimpleForumPost', $max_per_page);
    $pager->setPage($page);
    $pager->setCriteria($c);
    $pager->init();

    return $pager;
  }
  
  public function getThreadsCriteria()
  {
    $c = new Criteria();
    $c->add(sfSimpleForumPostPeer::FORUM_ID, $this->getId());
    $c->add(sfSimpleForumPostPeer::PARENT_ID, null);
    $c->addDescendingOrderByColumn(sfSimpleForumPostPeer::IS_STICKED);
    $c->addDescendingOrderByColumn(sfSimpleForumPostPeer::LATEST_REPLIED_AT);
    
    return $c;
  }

  public function getNewestPost()
  {
    $c = new Criteria();
    $c->addJoin(sfSimpleForumPostPeer::USER_ID, sfGuardUserPeer::ID, Criteria::LEFT_JOIN);
    $c->addDescendingOrderByColumn(sfSimpleForumPostPeer::CREATED_AT);
    $c->setLimit(1);
    $posts = sfSimpleForumPostPeer::doSelectJoinsfGuardUser($c);
    return $posts ? $posts[0] : null;
  }
}
