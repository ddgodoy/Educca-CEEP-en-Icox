<?php



class sfSimpleForumPostMapBuilder {

	
	const CLASS_NAME = 'plugins.sfSimpleForumPlugin.lib.model.map.sfSimpleForumPostMapBuilder';

	
	private $dbMap;

	
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('sf_simple_forum_post');
		$tMap->setPhpName('sfSimpleForumPost');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('TITLE', 'Title', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('CONTENT', 'Content', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('IS_STICKED', 'IsSticked', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addForeignKey('USER_ID', 'UserId', 'string', CreoleTypes::BIGINT, 'usuario', 'ID', false, null);

		$tMap->addForeignKey('FORUM_ID', 'ForumId', 'int', CreoleTypes::INTEGER, 'sf_simple_forum_forum', 'ID', false, null);

		$tMap->addForeignKey('PARENT_ID', 'ParentId', 'int', CreoleTypes::INTEGER, 'sf_simple_forum_post', 'ID', false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('STRIPPED_TITLE', 'StrippedTitle', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('AUTHOR_NAME', 'AuthorName', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('NB_REPLIES', 'NbReplies', 'string', CreoleTypes::BIGINT, false, null);

		$tMap->addColumn('NB_VIEWS', 'NbViews', 'string', CreoleTypes::BIGINT, false, null);

		$tMap->addColumn('LATEST_REPLY_AUTHOR_NAME', 'LatestReplyAuthorName', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('LATEST_REPLIED_AT', 'LatestRepliedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 