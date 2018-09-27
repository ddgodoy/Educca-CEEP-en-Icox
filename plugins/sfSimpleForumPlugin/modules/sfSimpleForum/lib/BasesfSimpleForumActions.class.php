<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2007 Fabien Potencier <fabien.potencier@symfony-project.com>
 * (c) 2007 Nick Winfield <enquiries@superhaggis.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Nick Winfield <enquiries@superhaggis.com>
 * @version    SVN: $Id$
 */

class BasesfSimpleForumActions extends sfActions
{
  public function executeIndex()
  {
    $this->forward('sfSimpleForum', 'forumList');
  }

  public function executeForumList()
  {
    if (!$this->getUser()->hasCredential('supervisor')) {
           $this->getContext()->getController()->forward('login','logout');
        }

    $this->setForumListVars();

    $this->forums = sfSimpleForumForumPeer::getAllOrderedByCategory();
    $threads = 0;
    $posts = 0;
    foreach($this->forums as $forum)
    {
      $threads += $forum->getNbThreads();
      $posts += $forum->getNbPosts();
    }
    $this->threads = $threads;
    $this->posts = $posts;

    $this->breadcrumb = array(
      sfConfig::get('app_sfSimpleForumPlugin_forum_name', 'Forums')
    );
  }

  public function executeLatestPosts()
  {
    $this->setForumListVars();

    $this->post_pager = sfSimpleForumPostPeer::getLatestPager(
      $this->getRequestParameter('page', 1),
      sfConfig::get('app_sfSimpleForumPlugin_max_per_page', 10)
    );

    sfLoader::loadHelpers('I18N');
    $this->title = __('Latest messages');
    $this->breadcrumb = array(
      array(sfConfig::get('app_sfSimpleForumPlugin_forum_name', 'Forums'), 'sfSimpleForum/forumList'),
      $this->title
    );
    $this->rule = 'sfSimpleForum/latestPosts';
    $this->feed_rule = 'sfSimpleForum/latestPostsFeed';

    $this->setTemplate('postList');
  }

  public function executeLatestPostsFeed()
  {
    $this->setForumListVars();

    $this->checkFeedPlugin();

    $this->posts = sfSimpleForumPostPeer::getLatest(
      sfConfig::get('app_sfSimpleForumPlugin_feed_max', 10)
    );

    $this->setForumListVars();
    $this->rule = 'sfSimpleForum/latestPosts';

    return $this->renderText($this->postFeed());
  }

  private function setForumListVars()
  {
    sfLoader::loadHelpers('I18N');
    $this->feed_title =  __('Latest messages from %forums%', array(
      '%forums%'  => sfConfig::get('app_sfSimpleForumPlugin_forum_name', 'Forums'),
    ));
  }

  // One forum

  public function executeForum()
  {

    if ($this->getRequestParameter('submenu')) { // foro general quito el menu extendido
        $this->getUser()->setCursoMenu(null);
      	$this->getUser()->deleteCursoMenu();
      }

    $this->setForumVars();

    $this->topics = $this->forum->getThreadsPager(
      $this->getRequestParameter('page', 1),
      sfConfig::get('app_sfSimpleForumPlugin_max_per_page', 10)
    );

    $this->breadcrumb = array(
      array(sfConfig::get('app_sfSimpleForumPlugin_forum_name', 'Forums'), 'sfSimpleForum/forumList'),
      $this->forum->getName()
    );
  }

  public function executeLatestForumPosts()
  {
    $this->setForumVars();

    $this->post_pager = sfSimpleForumPostPeer::getForumLatestPager(
      $this->name,
      $this->getRequestParameter('page', 1),
      sfConfig::get('app_sfSimpleForumPlugin_max_per_page', 10)
    );

    sfLoader::loadHelpers('I18N');
    $this->title = __('Latest messages');
    $this->rule = 'sfSimpleForum/latestForumPosts?forum_name='.$this->name;
    $this->feed_rule = 'sfSimpleForum/latestForumPostsFeed?forum_name='.$this->name;
    $this->breadcrumb = array(
      array(sfConfig::get('app_sfSimpleForumPlugin_forum_name', 'Forums'), 'sfSimpleForum/forumList'),
      array($this->forum->getName(), 'sfSimpleForum/forum?forum_name='.$this->name),
      $this->title
    );

    $this->setTemplate('postList');
  }

  public function executeLatestForumPostsFeed()
  {
    $this->setForumVars();

    $this->checkFeedPlugin();

    $this->posts = sfSimpleForumPostPeer::getForumLatest(
      $this->name,
      sfConfig::get('app_sfSimpleForumPlugin_feed_max', 10)
    );

    $this->rule = 'sfSimpleForum/latestForumPosts?forum_name='.$this->name;

    return $this->renderText($this->postFeed());
  }

  private function setForumVars()
  {
    $this->name = $this->getRequestParameter('forum_name');

    $forum = sfSimpleForumForumPeer::retrieveByStrippedName($this->name);
    $this->forward404Unless($forum);
    $this->forum = $forum;

    sfLoader::loadHelpers('I18N');
    $this->feed_title =  __('Latest messages from %forums% » %forum%', array(
      '%forums%'  => sfConfig::get('app_sfSimpleForumPlugin_forum_name', 'Forums'),
      '%forum%'   => $this->forum->getName()
    ));
  }

  // One topic

  public function executeTopic()
  {
    $this->post_pager = sfSimpleForumPostPeer::getRepliesPager(
      $this->getRequestParameter('id'),
      $this->getRequestParameter('page', 1),
      sfConfig::get('app_sfSimpleForumPlugin_max_per_page', 10)
    );
    $this->forward404Unless($this->post_pager);

    $this->posts = $this->post_pager->getResults();
    $this->topic = $this->posts[0]->getParent();

    if (sfConfig::get('app_sfSimpleForumPlugin_count_views', true))
    {
      // lame protection against simple page refreshing
      if($this->getUser()->getAttribute('sf_simple_forum_latest_viewed_topic') != $this->topic->getId())
      {
        $this->topic->incrementViews();
        $this->getUser()->setAttribute('sf_simple_forum_latest_viewed_topic', $this->topic->getId());
      }
    }

    $this->setTopicVars();
  }

  public function executeTopicFeed()
  {
    $this->checkFeedPlugin();

    $this->rule = 'sfSimpleForum/topic?id='.$this->getRequestParameter('id').'&stripped_title='.$this->getRequestParameter('forum_name');

    $this->posts = sfSimpleForumPostPeer::getReplies(
      $this->getRequestParameter('id'),
      sfConfig::get('app_sfSimpleForumPlugin_feed_max', 10)
    );
    $this->forward404Unless($this->posts);

    $this->topic = $this->posts[0]->getParent();
    $this->setTopicVars();

    return $this->renderText($this->postFeed());
  }

  private function setTopicVars()
  {
    sfLoader::loadHelpers('I18N');
    $forum_name = sfConfig::get('app_sfSimpleForumPlugin_forum_name', 'Forums');

    $this->breadcrumb = array(
      array($forum_name, 'sfSimpleForum/forumList'),
      array($this->topic->getsfSimpleForumForum()->getName(), 'sfSimpleForum/forum?forum_name='.$this->topic->getsfSimpleForumForum()->getStrippedName()),
      $this->topic->getTitle()
    );

    $this->feed_title = __('Latest messages from %forums% » %forum% » %topic%', array(
      '%forums%'  => $forum_name,
      '%forum%'   => $this->topic->getsfSimpleForumForum()->getName(),
      '%topic%'   => $this->topic->getTitle()
    ));
  }

  // One user

  public function executeLatestUserPosts()
  {
    $this->setUserVars();

    $this->post_pager = sfSimpleForumPostPeer::getForUserPager(
      $this->user->getId(),
      $this->getRequestParameter('page', 1),
      sfConfig::get('app_sfSimpleForumPlugin_max_per_page', 10)
    );

    sfLoader::loadHelpers('I18N');
    $this->title = __('Messages by %user%', array('%user%' => $this->username));
    $this->breadcrumb = array(
      array(sfConfig::get('app_sfSimpleForumPlugin_forum_name', 'Forums'), 'sfSimpleForum/forumList'),
      $this->title
    );
    $this->rule = 'sfSimpleForum/latestUserPosts?username='.$this->username;
    $this->feed_rule = 'sfSimpleForum/latestUserPostsFeed?username='.$this->username;

    $this->setTemplate('postList');
  }

  public function executeLatestUserPostsFeed()
  {
    $this->setUserVars();

    $this->posts = sfSimpleForumPostPeer::getForUser(
      $this->user->getId(),
      sfConfig::get('app_sfSimpleForumPlugin_feed_max', 10)
    );

    $this->rule = 'sfSimpleForum/latestUserPosts?username='.$this->username;

    return $this->renderText($this->postFeed());
  }

  private function setUserVars()
  {
    $this->username = $this->getRequestParameter('username');

    //$this->user = sfGuardUserPeer::retrieveByUsername($this->username);
    $crit = new Criteria();
    $crit->add(UsuarioPeer::NOMBREUSUARIO,$this->username );
    $usuario = UsuarioPeer::doSelectOne($crit);
    $idUsuario = $usuario->getId();

    $this->user = UsuarioPeer::retrieveByPK($idUsuario);
    $this->forward404Unless($this->user);

    sfLoader::loadHelpers('I18N');
    $this->feed_title = __('Latest messages from %forums% by %username%', array(
      '%forums%'   => sfConfig::get('app_sfSimpleForumPlugin_forum_name', 'Forums'),
      '%username%' => $this->user->getNombreusuario(),
    ));
  }

  // Feed related private methods

  private function checkFeedPlugin()
  {
    if(!class_exists('sfFeedPeer'))
    {
      throw new sfException('You must install sfFeed2Plugin to use the feed actions');
    }
  }

  private function postFeed()
  {
    $feed = sfFeedPeer::createFromObjects(
      $this->posts,
      array(
        'format'      => 'atom1',
        'title'       => $this->feed_title,
        'link'        => $this->rule,
        'methods'     => array('authorEmail' => '')
      )
    );
    $this->setTemplate('postFeed');
    $this->setLayout(false);
    return $feed->asXml();
  }

  // Adding a post

  public function executeCreateTopic()
  {
    if($topic = $this->getRequest()->getAttribute('topic'))
    { $this->forum = $topic->getsfSimpleForumForum();
      $this->topic_name = $topic->getTitle();
      $this->topic_stripped_title = $topic->getStrippedTitle();
      $this->topic_id = $topic->getId();
    }
    else
    {
      $this->forum = sfSimpleForumForumPeer::retrieveByStrippedName($this->getRequestParameter('forum_name'));
      $this->forward404Unless($this->forum);

      /****jacobo******************/
       if ($this->forum->getCursoId()) { //el foro pertenece a un curso
     	$cursoId = $this->forum->getCursoId();
     	if (!$this->getUser()->estaEnCurso($cursoId) ) {
     		 $this->redirect('sfSimpleForum/noEnCurso?forum_name='.$this->getRequestParameter('forum_name'));
     		  return;
         	  }
	   }
      /******************************/

      $this->topic_name = '';
      $this->topic_id = null;
    }
  }

  public function executePostReply()
  {
    $post = sfSimpleForumPostPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($post);

    /****jacobo******************/
    if ($post->getForumId()) {
    $foro = sfSimpleForumForumPeer::retrieveByPk($post->getForumId());
    $this->forward404Unless($foro);

    if ($foro->getCursoId()) { //el foro pertenece a un curso
     	if (!$this->getUser()->estaEnCurso($foro->getCursoId()) ) {
     	    $this->redirect('sfSimpleForum/noEnCurso?forum_name='.$foro->getName());
     		return;
     	  }
     }
    }
	/**********************/

    $this->getRequest()->setAttribute('topic', $post->getParent());

    $this->forward('sfSimpleForum', 'createTopic');
  }

  public function handleErrorAddPost()
  {
    $this->getRequest()->setAttribute('topic', sfSimpleForumPostPeer::retrieveByPk($this->getRequestParameter('topic_id')));
    $this->forward('sfSimpleForum', 'createTopic');
  }

  public function executeAddPost()
  {
    $this->forum = sfSimpleForumForumPeer::retrieveByStrippedName($this->getRequestParameter('forum_name'));
    $this->forward404Unless($this->forum);

    /****jacobo******************/
    if ($this->forum->getCursoId()) { //el foro pertenece a un curso
     	$cursoId = $this->forum->getCursoId();
     	if (!$this->getUser()->estaEnCurso($cursoId) ) {
     	    $this->redirect('sfSimpleForum/noEnCurso?forum_name='.$this->getRequestParameter('forum_name'));
     		return;
     	  }

	}
	/***************************/

    $post = new sfSimpleForumPost();
    $post->setsfSimpleForumForum($this->forum);
    $post->setTitle($this->getRequestParameter('title'));
    $post->setContent($this->getRequestParameter('body'));
    //$post->setUserId($this->getUser()->getGuardUser()->getId());
    $post->setUserId($this->getUser()->getAnyId());
    if($topic_id = $this->getRequestParameter('topic_id'))
    {
      // New message in a topic
      $post->setParentId($topic_id);
    }
    else
    {
      // New topic
      $post->setNbReplies(0);
      $latestReplyAuthorName = UsuarioPeer::retrieveByPK($this->getUser()->getAnyId())->getNombreusuario();
      //$post->setLatestReplyAuthorName($this->getUser()->__toString());
      $post->setLatestReplyAuthorName($latestReplyAuthorName);
      $post->setLatestRepliedAt(time());
      if ($this->getUser()->hasCredential('moderador'))
      {
        $post->setIsSticked($this->getRequestParameter('is_sticked', 0));
      }
    }
    $post->save();
    $this->post = $post;

    $this->redirect('sfSimpleForum/topic?id='.$post->getParent()->getId().'&stripped_title='.$post->getParent()->getStrippedTitle());
  }

  public function executeDeletePost()
  {
    $post = sfSimpleForumPostPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($post);

    if ($post->isTopic())
    {
      // delete all posts of the topic and redirect to the topic forum
    	/****jacobo******************/
    	if ($post->getForumId()) {
    	$foro = sfSimpleForumForumPeer::retrieveByPk($post->getForumId());
    	$this->forward404Unless($foro);

        if ($this->getUser()->esProfesorCurso($foro->getStrippedName())
             || $this->getUser()->hasCredential('supervisor') )
        {
              // si es profesor del curso puede borrar el post
              $forum = $post->getsfSimpleForumForum();
              $post->delete(); // should delete all children posts through cascade
              $this->redirect('sfSimpleForum/forum?forum_name='.$forum->getStrippedName());
        }

        }
		/**********************/
      $this->redirect('sfSimpleForum/index');

    }
    else
    {
      // delete only one message and redirect to the topic
      $parent = $post->getParent();
      $post->delete();
      $this->redirect('sfSimpleForum/topic?id='.$parent->getId().'&stripped_title='.$post->getStrippedTitle());
    }
  }

  public function executeToggleStick()
  {
    $post = sfSimpleForumPostPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($post);

    if ($post->isTopic())
    {
      // stick/unstick a topic
      $post->setIsSticked(!$post->getIsSticked());
      $post->save();

      $this->redirect('sfSimpleForum/topic?id='.$post->getId());
    }
    else
    {
      // action called on a simple message, not a topic
      // how did you get there in the first place? You're probably a hacker
      $this->forward404();
    }
  }



}
