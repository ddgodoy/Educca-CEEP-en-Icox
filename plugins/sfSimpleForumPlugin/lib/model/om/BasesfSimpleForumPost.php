<?php


abstract class BasesfSimpleForumPost extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $title;


	
	protected $content;


	
	protected $is_sticked = false;


	
	protected $user_id;


	
	protected $forum_id;


	
	protected $parent_id;


	
	protected $created_at;


	
	protected $stripped_title;


	
	protected $author_name;


	
	protected $nb_replies;


	
	protected $nb_views;


	
	protected $latest_reply_author_name;


	
	protected $latest_replied_at;

	
	protected $aUsuario;

	
	protected $asfSimpleForumForum;

	
	protected $asfSimpleForumPostRelatedByParentId;

	
	protected $collsfSimpleForumPostsRelatedByParentId;

	
	protected $lastsfSimpleForumPostRelatedByParentIdCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getTitle()
	{

		return $this->title;
	}

	
	public function getContent()
	{

		return $this->content;
	}

	
	public function getIsSticked()
	{

		return $this->is_sticked;
	}

	
	public function getUserId()
	{

		return $this->user_id;
	}

	
	public function getForumId()
	{

		return $this->forum_id;
	}

	
	public function getParentId()
	{

		return $this->parent_id;
	}

	
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
						$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
			}
		} else {
			$ts = $this->created_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getStrippedTitle()
	{

		return $this->stripped_title;
	}

	
	public function getAuthorName()
	{

		return $this->author_name;
	}

	
	public function getNbReplies()
	{

		return $this->nb_replies;
	}

	
	public function getNbViews()
	{

		return $this->nb_views;
	}

	
	public function getLatestReplyAuthorName()
	{

		return $this->latest_reply_author_name;
	}

	
	public function getLatestRepliedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->latest_replied_at === null || $this->latest_replied_at === '') {
			return null;
		} elseif (!is_int($this->latest_replied_at)) {
						$ts = strtotime($this->latest_replied_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [latest_replied_at] as date/time value: " . var_export($this->latest_replied_at, true));
			}
		} else {
			$ts = $this->latest_replied_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = sfSimpleForumPostPeer::ID;
		}

	} 
	
	public function setTitle($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = sfSimpleForumPostPeer::TITLE;
		}

	} 
	
	public function setContent($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->content !== $v) {
			$this->content = $v;
			$this->modifiedColumns[] = sfSimpleForumPostPeer::CONTENT;
		}

	} 
	
	public function setIsSticked($v)
	{

		if ($this->is_sticked !== $v || $v === false) {
			$this->is_sticked = $v;
			$this->modifiedColumns[] = sfSimpleForumPostPeer::IS_STICKED;
		}

	} 
	
	public function setUserId($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = sfSimpleForumPostPeer::USER_ID;
		}

		if ($this->aUsuario !== null && $this->aUsuario->getId() !== $v) {
			$this->aUsuario = null;
		}

	} 
	
	public function setForumId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->forum_id !== $v) {
			$this->forum_id = $v;
			$this->modifiedColumns[] = sfSimpleForumPostPeer::FORUM_ID;
		}

		if ($this->asfSimpleForumForum !== null && $this->asfSimpleForumForum->getId() !== $v) {
			$this->asfSimpleForumForum = null;
		}

	} 
	
	public function setParentId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->parent_id !== $v) {
			$this->parent_id = $v;
			$this->modifiedColumns[] = sfSimpleForumPostPeer::PARENT_ID;
		}

		if ($this->asfSimpleForumPostRelatedByParentId !== null && $this->asfSimpleForumPostRelatedByParentId->getId() !== $v) {
			$this->asfSimpleForumPostRelatedByParentId = null;
		}

	} 
	
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = sfSimpleForumPostPeer::CREATED_AT;
		}

	} 
	
	public function setStrippedTitle($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->stripped_title !== $v) {
			$this->stripped_title = $v;
			$this->modifiedColumns[] = sfSimpleForumPostPeer::STRIPPED_TITLE;
		}

	} 
	
	public function setAuthorName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->author_name !== $v) {
			$this->author_name = $v;
			$this->modifiedColumns[] = sfSimpleForumPostPeer::AUTHOR_NAME;
		}

	} 
	
	public function setNbReplies($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nb_replies !== $v) {
			$this->nb_replies = $v;
			$this->modifiedColumns[] = sfSimpleForumPostPeer::NB_REPLIES;
		}

	} 
	
	public function setNbViews($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nb_views !== $v) {
			$this->nb_views = $v;
			$this->modifiedColumns[] = sfSimpleForumPostPeer::NB_VIEWS;
		}

	} 
	
	public function setLatestReplyAuthorName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->latest_reply_author_name !== $v) {
			$this->latest_reply_author_name = $v;
			$this->modifiedColumns[] = sfSimpleForumPostPeer::LATEST_REPLY_AUTHOR_NAME;
		}

	} 
	
	public function setLatestRepliedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [latest_replied_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->latest_replied_at !== $ts) {
			$this->latest_replied_at = $ts;
			$this->modifiedColumns[] = sfSimpleForumPostPeer::LATEST_REPLIED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->title = $rs->getString($startcol + 1);

			$this->content = $rs->getString($startcol + 2);

			$this->is_sticked = $rs->getBoolean($startcol + 3);

			$this->user_id = $rs->getString($startcol + 4);

			$this->forum_id = $rs->getInt($startcol + 5);

			$this->parent_id = $rs->getInt($startcol + 6);

			$this->created_at = $rs->getTimestamp($startcol + 7, null);

			$this->stripped_title = $rs->getString($startcol + 8);

			$this->author_name = $rs->getString($startcol + 9);

			$this->nb_replies = $rs->getString($startcol + 10);

			$this->nb_views = $rs->getString($startcol + 11);

			$this->latest_reply_author_name = $rs->getString($startcol + 12);

			$this->latest_replied_at = $rs->getTimestamp($startcol + 13, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 14; 
		} catch (Exception $e) {
			throw new PropelException("Error populating sfSimpleForumPost object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(sfSimpleForumPostPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			sfSimpleForumPostPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(sfSimpleForumPostPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(sfSimpleForumPostPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


												
			if ($this->aUsuario !== null) {
				if ($this->aUsuario->isModified()) {
					$affectedRows += $this->aUsuario->save($con);
				}
				$this->setUsuario($this->aUsuario);
			}

			if ($this->asfSimpleForumForum !== null) {
				if ($this->asfSimpleForumForum->isModified()) {
					$affectedRows += $this->asfSimpleForumForum->save($con);
				}
				$this->setsfSimpleForumForum($this->asfSimpleForumForum);
			}

			if ($this->asfSimpleForumPostRelatedByParentId !== null) {
				if ($this->asfSimpleForumPostRelatedByParentId->isModified()) {
					$affectedRows += $this->asfSimpleForumPostRelatedByParentId->save($con);
				}
				$this->setsfSimpleForumPostRelatedByParentId($this->asfSimpleForumPostRelatedByParentId);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = sfSimpleForumPostPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += sfSimpleForumPostPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collsfSimpleForumPostsRelatedByParentId !== null) {
				foreach($this->collsfSimpleForumPostsRelatedByParentId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


												
			if ($this->aUsuario !== null) {
				if (!$this->aUsuario->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsuario->getValidationFailures());
				}
			}

			if ($this->asfSimpleForumForum !== null) {
				if (!$this->asfSimpleForumForum->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfSimpleForumForum->getValidationFailures());
				}
			}

			if ($this->asfSimpleForumPostRelatedByParentId !== null) {
				if (!$this->asfSimpleForumPostRelatedByParentId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfSimpleForumPostRelatedByParentId->getValidationFailures());
				}
			}


			if (($retval = sfSimpleForumPostPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = sfSimpleForumPostPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getTitle();
				break;
			case 2:
				return $this->getContent();
				break;
			case 3:
				return $this->getIsSticked();
				break;
			case 4:
				return $this->getUserId();
				break;
			case 5:
				return $this->getForumId();
				break;
			case 6:
				return $this->getParentId();
				break;
			case 7:
				return $this->getCreatedAt();
				break;
			case 8:
				return $this->getStrippedTitle();
				break;
			case 9:
				return $this->getAuthorName();
				break;
			case 10:
				return $this->getNbReplies();
				break;
			case 11:
				return $this->getNbViews();
				break;
			case 12:
				return $this->getLatestReplyAuthorName();
				break;
			case 13:
				return $this->getLatestRepliedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = sfSimpleForumPostPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getTitle(),
			$keys[2] => $this->getContent(),
			$keys[3] => $this->getIsSticked(),
			$keys[4] => $this->getUserId(),
			$keys[5] => $this->getForumId(),
			$keys[6] => $this->getParentId(),
			$keys[7] => $this->getCreatedAt(),
			$keys[8] => $this->getStrippedTitle(),
			$keys[9] => $this->getAuthorName(),
			$keys[10] => $this->getNbReplies(),
			$keys[11] => $this->getNbViews(),
			$keys[12] => $this->getLatestReplyAuthorName(),
			$keys[13] => $this->getLatestRepliedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = sfSimpleForumPostPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setTitle($value);
				break;
			case 2:
				$this->setContent($value);
				break;
			case 3:
				$this->setIsSticked($value);
				break;
			case 4:
				$this->setUserId($value);
				break;
			case 5:
				$this->setForumId($value);
				break;
			case 6:
				$this->setParentId($value);
				break;
			case 7:
				$this->setCreatedAt($value);
				break;
			case 8:
				$this->setStrippedTitle($value);
				break;
			case 9:
				$this->setAuthorName($value);
				break;
			case 10:
				$this->setNbReplies($value);
				break;
			case 11:
				$this->setNbViews($value);
				break;
			case 12:
				$this->setLatestReplyAuthorName($value);
				break;
			case 13:
				$this->setLatestRepliedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = sfSimpleForumPostPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTitle($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setContent($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setIsSticked($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setUserId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setForumId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setParentId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCreatedAt($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setStrippedTitle($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setAuthorName($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setNbReplies($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setNbViews($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setLatestReplyAuthorName($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setLatestRepliedAt($arr[$keys[13]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(sfSimpleForumPostPeer::DATABASE_NAME);

		if ($this->isColumnModified(sfSimpleForumPostPeer::ID)) $criteria->add(sfSimpleForumPostPeer::ID, $this->id);
		if ($this->isColumnModified(sfSimpleForumPostPeer::TITLE)) $criteria->add(sfSimpleForumPostPeer::TITLE, $this->title);
		if ($this->isColumnModified(sfSimpleForumPostPeer::CONTENT)) $criteria->add(sfSimpleForumPostPeer::CONTENT, $this->content);
		if ($this->isColumnModified(sfSimpleForumPostPeer::IS_STICKED)) $criteria->add(sfSimpleForumPostPeer::IS_STICKED, $this->is_sticked);
		if ($this->isColumnModified(sfSimpleForumPostPeer::USER_ID)) $criteria->add(sfSimpleForumPostPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(sfSimpleForumPostPeer::FORUM_ID)) $criteria->add(sfSimpleForumPostPeer::FORUM_ID, $this->forum_id);
		if ($this->isColumnModified(sfSimpleForumPostPeer::PARENT_ID)) $criteria->add(sfSimpleForumPostPeer::PARENT_ID, $this->parent_id);
		if ($this->isColumnModified(sfSimpleForumPostPeer::CREATED_AT)) $criteria->add(sfSimpleForumPostPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(sfSimpleForumPostPeer::STRIPPED_TITLE)) $criteria->add(sfSimpleForumPostPeer::STRIPPED_TITLE, $this->stripped_title);
		if ($this->isColumnModified(sfSimpleForumPostPeer::AUTHOR_NAME)) $criteria->add(sfSimpleForumPostPeer::AUTHOR_NAME, $this->author_name);
		if ($this->isColumnModified(sfSimpleForumPostPeer::NB_REPLIES)) $criteria->add(sfSimpleForumPostPeer::NB_REPLIES, $this->nb_replies);
		if ($this->isColumnModified(sfSimpleForumPostPeer::NB_VIEWS)) $criteria->add(sfSimpleForumPostPeer::NB_VIEWS, $this->nb_views);
		if ($this->isColumnModified(sfSimpleForumPostPeer::LATEST_REPLY_AUTHOR_NAME)) $criteria->add(sfSimpleForumPostPeer::LATEST_REPLY_AUTHOR_NAME, $this->latest_reply_author_name);
		if ($this->isColumnModified(sfSimpleForumPostPeer::LATEST_REPLIED_AT)) $criteria->add(sfSimpleForumPostPeer::LATEST_REPLIED_AT, $this->latest_replied_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(sfSimpleForumPostPeer::DATABASE_NAME);

		$criteria->add(sfSimpleForumPostPeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setTitle($this->title);

		$copyObj->setContent($this->content);

		$copyObj->setIsSticked($this->is_sticked);

		$copyObj->setUserId($this->user_id);

		$copyObj->setForumId($this->forum_id);

		$copyObj->setParentId($this->parent_id);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setStrippedTitle($this->stripped_title);

		$copyObj->setAuthorName($this->author_name);

		$copyObj->setNbReplies($this->nb_replies);

		$copyObj->setNbViews($this->nb_views);

		$copyObj->setLatestReplyAuthorName($this->latest_reply_author_name);

		$copyObj->setLatestRepliedAt($this->latest_replied_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getsfSimpleForumPostsRelatedByParentId() as $relObj) {
				if($this->getPrimaryKey() === $relObj->getPrimaryKey()) {
						continue;
				}

				$copyObj->addsfSimpleForumPostRelatedByParentId($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new sfSimpleForumPostPeer();
		}
		return self::$peer;
	}

	
	public function setUsuario($v)
	{


		if ($v === null) {
			$this->setUserId(NULL);
		} else {
			$this->setUserId($v->getId());
		}


		$this->aUsuario = $v;
	}


	
	public function getUsuario($con = null)
	{
		if ($this->aUsuario === null && (($this->user_id !== "" && $this->user_id !== null))) {
						include_once 'lib/model/om/BaseUsuarioPeer.php';

			$this->aUsuario = UsuarioPeer::retrieveByPK($this->user_id, $con);

			
		}
		return $this->aUsuario;
	}

	
	public function setsfSimpleForumForum($v)
	{


		if ($v === null) {
			$this->setForumId(NULL);
		} else {
			$this->setForumId($v->getId());
		}


		$this->asfSimpleForumForum = $v;
	}


	
	public function getsfSimpleForumForum($con = null)
	{
		if ($this->asfSimpleForumForum === null && ($this->forum_id !== null)) {
						include_once 'plugins/sfSimpleForumPlugin/lib/model/om/BasesfSimpleForumForumPeer.php';

			$this->asfSimpleForumForum = sfSimpleForumForumPeer::retrieveByPK($this->forum_id, $con);

			
		}
		return $this->asfSimpleForumForum;
	}

	
	public function setsfSimpleForumPostRelatedByParentId($v)
	{


		if ($v === null) {
			$this->setParentId(NULL);
		} else {
			$this->setParentId($v->getId());
		}


		$this->asfSimpleForumPostRelatedByParentId = $v;
	}


	
	public function getsfSimpleForumPostRelatedByParentId($con = null)
	{
		if ($this->asfSimpleForumPostRelatedByParentId === null && ($this->parent_id !== null)) {
						include_once 'plugins/sfSimpleForumPlugin/lib/model/om/BasesfSimpleForumPostPeer.php';

			$this->asfSimpleForumPostRelatedByParentId = sfSimpleForumPostPeer::retrieveByPK($this->parent_id, $con);

			
		}
		return $this->asfSimpleForumPostRelatedByParentId;
	}

	
	public function initsfSimpleForumPostsRelatedByParentId()
	{
		if ($this->collsfSimpleForumPostsRelatedByParentId === null) {
			$this->collsfSimpleForumPostsRelatedByParentId = array();
		}
	}

	
	public function getsfSimpleForumPostsRelatedByParentId($criteria = null, $con = null)
	{
				include_once 'plugins/sfSimpleForumPlugin/lib/model/om/BasesfSimpleForumPostPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfSimpleForumPostsRelatedByParentId === null) {
			if ($this->isNew()) {
			   $this->collsfSimpleForumPostsRelatedByParentId = array();
			} else {

				$criteria->add(sfSimpleForumPostPeer::PARENT_ID, $this->getId());

				sfSimpleForumPostPeer::addSelectColumns($criteria);
				$this->collsfSimpleForumPostsRelatedByParentId = sfSimpleForumPostPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(sfSimpleForumPostPeer::PARENT_ID, $this->getId());

				sfSimpleForumPostPeer::addSelectColumns($criteria);
				if (!isset($this->lastsfSimpleForumPostRelatedByParentIdCriteria) || !$this->lastsfSimpleForumPostRelatedByParentIdCriteria->equals($criteria)) {
					$this->collsfSimpleForumPostsRelatedByParentId = sfSimpleForumPostPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastsfSimpleForumPostRelatedByParentIdCriteria = $criteria;
		return $this->collsfSimpleForumPostsRelatedByParentId;
	}

	
	public function countsfSimpleForumPostsRelatedByParentId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/sfSimpleForumPlugin/lib/model/om/BasesfSimpleForumPostPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(sfSimpleForumPostPeer::PARENT_ID, $this->getId());

		return sfSimpleForumPostPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addsfSimpleForumPostRelatedByParentId(sfSimpleForumPost $l)
	{
		$this->collsfSimpleForumPostsRelatedByParentId[] = $l;
		$l->setsfSimpleForumPostRelatedByParentId($this);
	}


	
	public function getsfSimpleForumPostsRelatedByParentIdJoinUsuario($criteria = null, $con = null)
	{
				include_once 'plugins/sfSimpleForumPlugin/lib/model/om/BasesfSimpleForumPostPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfSimpleForumPostsRelatedByParentId === null) {
			if ($this->isNew()) {
				$this->collsfSimpleForumPostsRelatedByParentId = array();
			} else {

				$criteria->add(sfSimpleForumPostPeer::PARENT_ID, $this->getId());

				$this->collsfSimpleForumPostsRelatedByParentId = sfSimpleForumPostPeer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(sfSimpleForumPostPeer::PARENT_ID, $this->getId());

			if (!isset($this->lastsfSimpleForumPostRelatedByParentIdCriteria) || !$this->lastsfSimpleForumPostRelatedByParentIdCriteria->equals($criteria)) {
				$this->collsfSimpleForumPostsRelatedByParentId = sfSimpleForumPostPeer::doSelectJoinUsuario($criteria, $con);
			}
		}
		$this->lastsfSimpleForumPostRelatedByParentIdCriteria = $criteria;

		return $this->collsfSimpleForumPostsRelatedByParentId;
	}


	
	public function getsfSimpleForumPostsRelatedByParentIdJoinsfSimpleForumForum($criteria = null, $con = null)
	{
				include_once 'plugins/sfSimpleForumPlugin/lib/model/om/BasesfSimpleForumPostPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfSimpleForumPostsRelatedByParentId === null) {
			if ($this->isNew()) {
				$this->collsfSimpleForumPostsRelatedByParentId = array();
			} else {

				$criteria->add(sfSimpleForumPostPeer::PARENT_ID, $this->getId());

				$this->collsfSimpleForumPostsRelatedByParentId = sfSimpleForumPostPeer::doSelectJoinsfSimpleForumForum($criteria, $con);
			}
		} else {
									
			$criteria->add(sfSimpleForumPostPeer::PARENT_ID, $this->getId());

			if (!isset($this->lastsfSimpleForumPostRelatedByParentIdCriteria) || !$this->lastsfSimpleForumPostRelatedByParentIdCriteria->equals($criteria)) {
				$this->collsfSimpleForumPostsRelatedByParentId = sfSimpleForumPostPeer::doSelectJoinsfSimpleForumForum($criteria, $con);
			}
		}
		$this->lastsfSimpleForumPostRelatedByParentIdCriteria = $criteria;

		return $this->collsfSimpleForumPostsRelatedByParentId;
	}

} 