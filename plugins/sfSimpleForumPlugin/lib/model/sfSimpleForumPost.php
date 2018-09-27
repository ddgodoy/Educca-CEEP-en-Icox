<?php

/**
 * Subclass for representing a row from the 'sf_simple_forum_post' table.
 *
 *
 *
 * @package plugins.sfSimpleForumPlugin.lib.model
 */
class sfSimpleForumPost extends BasesfSimpleForumPost
{
  protected
    /**
     * The post's creator.
     *
     * @var Usuario
     * @access private
     */
    $user = null,
    $updating = false;

  public function setTitle($title)
  {
    parent::setTitle($title);
    $this->setStrippedTitle(sfSimpleForumTools::stripText($title));
  }

  public function getLatestReply()
  {
    if(!$this->getNbReplies())
    {
      return $this;
    }
    $c = new Criteria();
    $c->add(sfSimpleForumPostPeer::PARENT_ID, $this->getId());
    $c->addDescendingOrderByColumn(sfSimpleForumPostPeer::CREATED_AT);
    return sfSimpleForumPostPeer::doSelectOne($c);
  }

  public function getReplies($max)
  {
    $c = sfSimpleForumPostPeer::getRepliesCriteria($this->getId());
    $c->setLimit($max);
    $replies = sfSimpleForumPostPeer::doSelect($c);

    return $replies;
  }

  public function getRepliesPager($page = 1, $max_per_page = 10)
  {
    $c = sfSimpleForumPostPeer::getRepliesCriteria($this->getId());
    $pager = new sfPropelPager('sfSimpleForumPost', $max_per_page);
    $pager->setPage($page);
    $pager->setCriteria($c);
    $pager->init();

    return $pager;
  }

  public function setUpdating($status)
  {
    $this->updating = $status;
  }

  /**
   * Shortcut method to retrieve post's creator.
   *
   * @return Usuario The post's creator.
   */
  public function getUser()
  {
    if (!$this->user)
    {
      $c = new Criteria();
      $c->add(UsuarioPeer::ID, $this->getUserId());
      $this->user = UsuarioPeer::doSelectOne($c);
    }

    return $this->user;
  }

  public function setUser($user)
  {
    parent::setUser($user);
    $this->user = $user;
  }

  public function setCreatedAt($v)
  {
    parent::setCreatedAt($v);
    if(!$this->getParentId())
    {
       $this->setLatestRepliedAt($this->getCreatedAt(null));
    }
  }

  public function setUserId($id)
  {
    parent::setUserId($id);
    $this->setAuthorName($this->getUser()->__toString());
    if(!$this->getParentId())
    {
       $this->setLatestReplyAuthorName($this->getUser()->__toString());
    }
  }

  public function getParent()
  {
    if($this->getParentId())
    {
      return $this->getsfSimpleForumPostRelatedByParentId();
    }
    else
    {
    return $this;
    }
  }

  public function isTopic()
  {
    return $this->getParentId() ? false : true;
  }

  public function incrementViews()
  {
    if(!$this->isTopic())
    {
      throw new sfException('Views can only be counted on topics. You are trying to access the number of views of a regular post');
    }

    $this->setnbViews($this->getNbViews() + 1);
    parent::save();
  }

  public function updateParentNbReplies($con = null)
  {
    if($this->getParentId())
    {
      $parent = $this->getsfSimpleForumPostRelatedByParentId();
      if(!$parent->isDeleted())
      {
        $parent->setNbReplies($parent->countsfSimpleForumPostsRelatedByParentId());
        $parent->setLatestReplyAuthorName($this->getUser()->__toString());
        $parent->setLatestRepliedAt($this->getCreatedAt(null));
        $parent->setUpdating(true);
        $parent->save($con);
      }
    }
  }

  public function updateForumCounts($con = null)
  {
    $forum = $this->getsfSimpleForumForum();
    $forum->setNbPosts($forum->countsfSimpleForumPosts());
    $c = new Criteria();
    $c->add(sfSimpleForumPostPeer::FORUM_ID, $forum->getId());
    $c->add(sfSimpleForumPostPeer::PARENT_ID, NULL);
    $forum->setNbThreads(sfSimpleForumPostPeer::doCount($c));
	$forum->setLatestReplyAuthorName($this->getUser()->__toString());
    $forum->setLatestRepliedAt($this->getCreatedAt(null));
    $forum->save($con);
  }

  public function save($con = null)
  {
    if($this->updating)
    {
      return parent::save($con);
    }
    if(!$con)
    {
      $con = Propel::getConnection();
    }

    try
    {
      $con->begin();

      parent::save($con);
      $this->updateParentNbReplies($con);
      $this->updateForumCounts($con);

      $con->commit();
    }
    catch (Exception $e)
    {
      $con->rollback();
      throw $e;
    }
  }

  public function delete($con = null)
  {
    if(!$con)
    {
      $con = Propel::getConnection();
    }

    try
    {
      $con->begin();

      if($this->isTopic())
      {
        // delete children as cascading deletion doesn't work on self-refenrenced objects in Propel
        $c = new Criteria();
        $c->add(sfSimpleForumPostPeer::PARENT_ID, $this->getId());
        sfSimpleForumPostPeer::doDelete($c, $con);
        parent::delete($con);
      }
      else
      {
        parent::delete($con);
        $this->updateParentNbReplies($con);
      }
      $this->updateForumCounts($con);

      $con->commit();
    }
    catch (Exception $e)
    {
      $con->rollback();
      throw $e;
    }
  }

  public function getFeedLink()
  {
    //return 'sfSimpleForum/topic?id='.$this->getParent()->getId().'&stripped_title='.$this->getStrippedTitle();
  }

  public function distance_of_time_in_words($to_time = null, $include_seconds = false)
  {
     /*sfLoader::loadHelpers('miDate');
     return distance_of_time_in_words($this->getLatestRepliedAt('U'));*/
  $from_time = $this->getLatestRepliedAt('U');
  $to_time = $to_time? $to_time: time();

  $distance_in_minutes = floor(abs($to_time - $from_time) / 60);
  $distance_in_seconds = floor(abs($to_time - $from_time));

  $string = '';
  $parameters = array();

  if ($distance_in_minutes <= 1)
  {
    if (!$include_seconds)
    {
      //$string = $distance_in_minutes == 0 ? 'less than a minute' : '1 minute';
      $string = $distance_in_minutes == 0 ? 'menos de un minuto' : '1 minuto';
    }
    else
    {
      if ($distance_in_seconds <= 5)
      {
        //$string = 'less than 5 seconds';
        $string = 'menos de 5 segundos';
      }
      else if ($distance_in_seconds >= 6 && $distance_in_seconds <= 10)
      {
        //$string = 'less than 10 seconds';
        $string = 'menos de 10 segundos';
      }
      else if ($distance_in_seconds >= 11 && $distance_in_seconds <= 20)
      {
        //$string = 'less than 20 seconds';
        $string = 'menos de 20 segundos';
      }
      else if ($distance_in_seconds >= 21 && $distance_in_seconds <= 40)
      {
        //$string = 'half a minute';
        $string = 'medio minuto';
      }
      else if ($distance_in_seconds >= 41 && $distance_in_seconds <= 59)
      {
        //$string = 'less than a minute';
        $string = 'menos de un minuto';
      }
      else
      {
        //$string = '1 minute';
        $string = '1 minuto';
      }
    }
  }
  else if ($distance_in_minutes >= 2 && $distance_in_minutes <= 44)
  {
    //$string = '%minutes% minutes';
    //$parameters['%minutes%'] = $distance_in_minutes;
    $string = '%minutes% minutos';
    $parameters['%minutes%'] = $distance_in_minutes;
  }
  else if ($distance_in_minutes >= 45 && $distance_in_minutes <= 89)
  {
    //$string = 'about 1 hour';
    $string = ' 1 hora';
  }
  else if ($distance_in_minutes >= 90 && $distance_in_minutes <= 1439)
  {
    //$string = 'about %hours% hours';
    //$parameters['%hours%'] = round($distance_in_minutes / 60);
    $string = '  %hours% horas';
    $parameters['%hours%'] = round($distance_in_minutes / 60);
  }
  else if ($distance_in_minutes >= 1440 && $distance_in_minutes <= 2879)
  {
    //$string = '1 day';
    $string = '1 dia';
  }
  else if ($distance_in_minutes >= 2880 && $distance_in_minutes <= 43199)
  {
    //$string = '%days% days';
    //$parameters['%days%'] = round($distance_in_minutes / 1440);
    $string = '%days% dias';
    $parameters['%days%'] = round($distance_in_minutes / 1440);
  }
  else if ($distance_in_minutes >= 43200 && $distance_in_minutes <= 86399)
  {
    //$string = 'about 1 month';
    $string = ' 1 mes';
  }
  else if ($distance_in_minutes >= 86400 && $distance_in_minutes <= 525959)
  {
    //$string = '%months% months';
    //$parameters['%months%'] = round($distance_in_minutes / 43200);
    $string = '%months% meses';
    $parameters['%months%'] = round($distance_in_minutes / 43200);
  }
  else if ($distance_in_minutes >= 525960 && $distance_in_minutes <= 1051919)
  {
    //$string = 'about 1 year';
    $string = ' 1 año';
  }
  else
  {
    //$string = 'over %years% years';
    //$parameters['%years%'] = round($distance_in_minutes / 525960);
    $string = ' %years% años';
    $parameters['%years%'] = round($distance_in_minutes / 525960);
  }

  if (sfConfig::get('sf_i18n'))
  {
    use_helper('I18N');

    return __($string, $parameters);
  }
  else
  {
    return strtr($string, $parameters);
  }
  }
}
