<?php


abstract class BasesfSimpleForumForum extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $name;


	
	protected $stripped_name;


	
	protected $description;


	
	protected $rank;


	
	protected $category_id;


	
	protected $curso_id;


	
	protected $created_at;


	
	protected $nb_posts;


	
	protected $nb_threads;


	
	protected $latest_reply_author_name;


	
	protected $latest_replied_at;

	
	protected $asfSimpleForumCategory;

	
	protected $aCurso;

	
	protected $collsfSimpleForumPosts;

	
	protected $lastsfSimpleForumPostCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getStrippedName()
	{

		return $this->stripped_name;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getRank()
	{

		return $this->rank;
	}

	
	public function getCategoryId()
	{

		return $this->category_id;
	}

	
	public function getCursoId()
	{

		return $this->curso_id;
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

	
	public function getNbPosts()
	{

		return $this->nb_posts;
	}

	
	public function getNbThreads()
	{

		return $this->nb_threads;
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
			$this->modifiedColumns[] = sfSimpleForumForumPeer::ID;
		}

	} 
	
	public function setName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = sfSimpleForumForumPeer::NAME;
		}

	} 
	
	public function setStrippedName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->stripped_name !== $v) {
			$this->stripped_name = $v;
			$this->modifiedColumns[] = sfSimpleForumForumPeer::STRIPPED_NAME;
		}

	} 
	
	public function setDescription($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = sfSimpleForumForumPeer::DESCRIPTION;
		}

	} 
	
	public function setRank($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->rank !== $v) {
			$this->rank = $v;
			$this->modifiedColumns[] = sfSimpleForumForumPeer::RANK;
		}

	} 
	
	public function setCategoryId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->category_id !== $v) {
			$this->category_id = $v;
			$this->modifiedColumns[] = sfSimpleForumForumPeer::CATEGORY_ID;
		}

		if ($this->asfSimpleForumCategory !== null && $this->asfSimpleForumCategory->getId() !== $v) {
			$this->asfSimpleForumCategory = null;
		}

	} 
	
	public function setCursoId($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->curso_id !== $v) {
			$this->curso_id = $v;
			$this->modifiedColumns[] = sfSimpleForumForumPeer::CURSO_ID;
		}

		if ($this->aCurso !== null && $this->aCurso->getId() !== $v) {
			$this->aCurso = null;
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
			$this->modifiedColumns[] = sfSimpleForumForumPeer::CREATED_AT;
		}

	} 
	
	public function setNbPosts($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nb_posts !== $v) {
			$this->nb_posts = $v;
			$this->modifiedColumns[] = sfSimpleForumForumPeer::NB_POSTS;
		}

	} 
	
	public function setNbThreads($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nb_threads !== $v) {
			$this->nb_threads = $v;
			$this->modifiedColumns[] = sfSimpleForumForumPeer::NB_THREADS;
		}

	} 
	
	public function setLatestReplyAuthorName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->latest_reply_author_name !== $v) {
			$this->latest_reply_author_name = $v;
			$this->modifiedColumns[] = sfSimpleForumForumPeer::LATEST_REPLY_AUTHOR_NAME;
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
			$this->modifiedColumns[] = sfSimpleForumForumPeer::LATEST_REPLIED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->name = $rs->getString($startcol + 1);

			$this->stripped_name = $rs->getString($startcol + 2);

			$this->description = $rs->getString($startcol + 3);

			$this->rank = $rs->getInt($startcol + 4);

			$this->category_id = $rs->getInt($startcol + 5);

			$this->curso_id = $rs->getString($startcol + 6);

			$this->created_at = $rs->getTimestamp($startcol + 7, null);

			$this->nb_posts = $rs->getString($startcol + 8);

			$this->nb_threads = $rs->getString($startcol + 9);

			$this->latest_reply_author_name = $rs->getString($startcol + 10);

			$this->latest_replied_at = $rs->getTimestamp($startcol + 11, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 12; 
		} catch (Exception $e) {
			throw new PropelException("Error populating sfSimpleForumForum object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(sfSimpleForumForumPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			sfSimpleForumForumPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(sfSimpleForumForumPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(sfSimpleForumForumPeer::DATABASE_NAME);
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


												
			if ($this->asfSimpleForumCategory !== null) {
				if ($this->asfSimpleForumCategory->isModified()) {
					$affectedRows += $this->asfSimpleForumCategory->save($con);
				}
				$this->setsfSimpleForumCategory($this->asfSimpleForumCategory);
			}

			if ($this->aCurso !== null) {
				if ($this->aCurso->isModified()) {
					$affectedRows += $this->aCurso->save($con);
				}
				$this->setCurso($this->aCurso);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = sfSimpleForumForumPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += sfSimpleForumForumPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collsfSimpleForumPosts !== null) {
				foreach($this->collsfSimpleForumPosts as $referrerFK) {
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


												
			if ($this->asfSimpleForumCategory !== null) {
				if (!$this->asfSimpleForumCategory->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfSimpleForumCategory->getValidationFailures());
				}
			}

			if ($this->aCurso !== null) {
				if (!$this->aCurso->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCurso->getValidationFailures());
				}
			}


			if (($retval = sfSimpleForumForumPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collsfSimpleForumPosts !== null) {
					foreach($this->collsfSimpleForumPosts as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = sfSimpleForumForumPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getName();
				break;
			case 2:
				return $this->getStrippedName();
				break;
			case 3:
				return $this->getDescription();
				break;
			case 4:
				return $this->getRank();
				break;
			case 5:
				return $this->getCategoryId();
				break;
			case 6:
				return $this->getCursoId();
				break;
			case 7:
				return $this->getCreatedAt();
				break;
			case 8:
				return $this->getNbPosts();
				break;
			case 9:
				return $this->getNbThreads();
				break;
			case 10:
				return $this->getLatestReplyAuthorName();
				break;
			case 11:
				return $this->getLatestRepliedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = sfSimpleForumForumPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getStrippedName(),
			$keys[3] => $this->getDescription(),
			$keys[4] => $this->getRank(),
			$keys[5] => $this->getCategoryId(),
			$keys[6] => $this->getCursoId(),
			$keys[7] => $this->getCreatedAt(),
			$keys[8] => $this->getNbPosts(),
			$keys[9] => $this->getNbThreads(),
			$keys[10] => $this->getLatestReplyAuthorName(),
			$keys[11] => $this->getLatestRepliedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = sfSimpleForumForumPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setName($value);
				break;
			case 2:
				$this->setStrippedName($value);
				break;
			case 3:
				$this->setDescription($value);
				break;
			case 4:
				$this->setRank($value);
				break;
			case 5:
				$this->setCategoryId($value);
				break;
			case 6:
				$this->setCursoId($value);
				break;
			case 7:
				$this->setCreatedAt($value);
				break;
			case 8:
				$this->setNbPosts($value);
				break;
			case 9:
				$this->setNbThreads($value);
				break;
			case 10:
				$this->setLatestReplyAuthorName($value);
				break;
			case 11:
				$this->setLatestRepliedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = sfSimpleForumForumPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setStrippedName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDescription($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setRank($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCategoryId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCursoId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCreatedAt($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setNbPosts($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setNbThreads($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setLatestReplyAuthorName($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setLatestRepliedAt($arr[$keys[11]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(sfSimpleForumForumPeer::DATABASE_NAME);

		if ($this->isColumnModified(sfSimpleForumForumPeer::ID)) $criteria->add(sfSimpleForumForumPeer::ID, $this->id);
		if ($this->isColumnModified(sfSimpleForumForumPeer::NAME)) $criteria->add(sfSimpleForumForumPeer::NAME, $this->name);
		if ($this->isColumnModified(sfSimpleForumForumPeer::STRIPPED_NAME)) $criteria->add(sfSimpleForumForumPeer::STRIPPED_NAME, $this->stripped_name);
		if ($this->isColumnModified(sfSimpleForumForumPeer::DESCRIPTION)) $criteria->add(sfSimpleForumForumPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(sfSimpleForumForumPeer::RANK)) $criteria->add(sfSimpleForumForumPeer::RANK, $this->rank);
		if ($this->isColumnModified(sfSimpleForumForumPeer::CATEGORY_ID)) $criteria->add(sfSimpleForumForumPeer::CATEGORY_ID, $this->category_id);
		if ($this->isColumnModified(sfSimpleForumForumPeer::CURSO_ID)) $criteria->add(sfSimpleForumForumPeer::CURSO_ID, $this->curso_id);
		if ($this->isColumnModified(sfSimpleForumForumPeer::CREATED_AT)) $criteria->add(sfSimpleForumForumPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(sfSimpleForumForumPeer::NB_POSTS)) $criteria->add(sfSimpleForumForumPeer::NB_POSTS, $this->nb_posts);
		if ($this->isColumnModified(sfSimpleForumForumPeer::NB_THREADS)) $criteria->add(sfSimpleForumForumPeer::NB_THREADS, $this->nb_threads);
		if ($this->isColumnModified(sfSimpleForumForumPeer::LATEST_REPLY_AUTHOR_NAME)) $criteria->add(sfSimpleForumForumPeer::LATEST_REPLY_AUTHOR_NAME, $this->latest_reply_author_name);
		if ($this->isColumnModified(sfSimpleForumForumPeer::LATEST_REPLIED_AT)) $criteria->add(sfSimpleForumForumPeer::LATEST_REPLIED_AT, $this->latest_replied_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(sfSimpleForumForumPeer::DATABASE_NAME);

		$criteria->add(sfSimpleForumForumPeer::ID, $this->id);

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

		$copyObj->setName($this->name);

		$copyObj->setStrippedName($this->stripped_name);

		$copyObj->setDescription($this->description);

		$copyObj->setRank($this->rank);

		$copyObj->setCategoryId($this->category_id);

		$copyObj->setCursoId($this->curso_id);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setNbPosts($this->nb_posts);

		$copyObj->setNbThreads($this->nb_threads);

		$copyObj->setLatestReplyAuthorName($this->latest_reply_author_name);

		$copyObj->setLatestRepliedAt($this->latest_replied_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getsfSimpleForumPosts() as $relObj) {
				$copyObj->addsfSimpleForumPost($relObj->copy($deepCopy));
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
			self::$peer = new sfSimpleForumForumPeer();
		}
		return self::$peer;
	}

	
	public function setsfSimpleForumCategory($v)
	{


		if ($v === null) {
			$this->setCategoryId(NULL);
		} else {
			$this->setCategoryId($v->getId());
		}


		$this->asfSimpleForumCategory = $v;
	}


	
	public function getsfSimpleForumCategory($con = null)
	{
		if ($this->asfSimpleForumCategory === null && ($this->category_id !== null)) {
						include_once 'plugins/sfSimpleForumPlugin/lib/model/om/BasesfSimpleForumCategoryPeer.php';

			$this->asfSimpleForumCategory = sfSimpleForumCategoryPeer::retrieveByPK($this->category_id, $con);

			
		}
		return $this->asfSimpleForumCategory;
	}

	
	public function setCurso($v)
	{


		if ($v === null) {
			$this->setCursoId(NULL);
		} else {
			$this->setCursoId($v->getId());
		}


		$this->aCurso = $v;
	}


	
	public function getCurso($con = null)
	{
		if ($this->aCurso === null && (($this->curso_id !== "" && $this->curso_id !== null))) {
						include_once 'lib/model/om/BaseCursoPeer.php';

			$this->aCurso = CursoPeer::retrieveByPK($this->curso_id, $con);

			
		}
		return $this->aCurso;
	}

	
	public function initsfSimpleForumPosts()
	{
		if ($this->collsfSimpleForumPosts === null) {
			$this->collsfSimpleForumPosts = array();
		}
	}

	
	public function getsfSimpleForumPosts($criteria = null, $con = null)
	{
				include_once 'plugins/sfSimpleForumPlugin/lib/model/om/BasesfSimpleForumPostPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfSimpleForumPosts === null) {
			if ($this->isNew()) {
			   $this->collsfSimpleForumPosts = array();
			} else {

				$criteria->add(sfSimpleForumPostPeer::FORUM_ID, $this->getId());

				sfSimpleForumPostPeer::addSelectColumns($criteria);
				$this->collsfSimpleForumPosts = sfSimpleForumPostPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(sfSimpleForumPostPeer::FORUM_ID, $this->getId());

				sfSimpleForumPostPeer::addSelectColumns($criteria);
				if (!isset($this->lastsfSimpleForumPostCriteria) || !$this->lastsfSimpleForumPostCriteria->equals($criteria)) {
					$this->collsfSimpleForumPosts = sfSimpleForumPostPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastsfSimpleForumPostCriteria = $criteria;
		return $this->collsfSimpleForumPosts;
	}

	
	public function countsfSimpleForumPosts($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/sfSimpleForumPlugin/lib/model/om/BasesfSimpleForumPostPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(sfSimpleForumPostPeer::FORUM_ID, $this->getId());

		return sfSimpleForumPostPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addsfSimpleForumPost(sfSimpleForumPost $l)
	{
		$this->collsfSimpleForumPosts[] = $l;
		$l->setsfSimpleForumForum($this);
	}


	
	public function getsfSimpleForumPostsJoinUsuario($criteria = null, $con = null)
	{
				include_once 'plugins/sfSimpleForumPlugin/lib/model/om/BasesfSimpleForumPostPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfSimpleForumPosts === null) {
			if ($this->isNew()) {
				$this->collsfSimpleForumPosts = array();
			} else {

				$criteria->add(sfSimpleForumPostPeer::FORUM_ID, $this->getId());

				$this->collsfSimpleForumPosts = sfSimpleForumPostPeer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(sfSimpleForumPostPeer::FORUM_ID, $this->getId());

			if (!isset($this->lastsfSimpleForumPostCriteria) || !$this->lastsfSimpleForumPostCriteria->equals($criteria)) {
				$this->collsfSimpleForumPosts = sfSimpleForumPostPeer::doSelectJoinUsuario($criteria, $con);
			}
		}
		$this->lastsfSimpleForumPostCriteria = $criteria;

		return $this->collsfSimpleForumPosts;
	}


	
	public function getsfSimpleForumPostsJoinsfSimpleForumPostRelatedByParentId($criteria = null, $con = null)
	{
				include_once 'plugins/sfSimpleForumPlugin/lib/model/om/BasesfSimpleForumPostPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfSimpleForumPosts === null) {
			if ($this->isNew()) {
				$this->collsfSimpleForumPosts = array();
			} else {

				$criteria->add(sfSimpleForumPostPeer::FORUM_ID, $this->getId());

				$this->collsfSimpleForumPosts = sfSimpleForumPostPeer::doSelectJoinsfSimpleForumPostRelatedByParentId($criteria, $con);
			}
		} else {
									
			$criteria->add(sfSimpleForumPostPeer::FORUM_ID, $this->getId());

			if (!isset($this->lastsfSimpleForumPostCriteria) || !$this->lastsfSimpleForumPostCriteria->equals($criteria)) {
				$this->collsfSimpleForumPosts = sfSimpleForumPostPeer::doSelectJoinsfSimpleForumPostRelatedByParentId($criteria, $con);
			}
		}
		$this->lastsfSimpleForumPostCriteria = $criteria;

		return $this->collsfSimpleForumPosts;
	}

} 