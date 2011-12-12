<?php



class Rel_usuario_sco2004_learnercMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Rel_usuario_sco2004_learnercMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('rel_usuario_sco2004_learnerc');
		$tMap->setPhpName('Rel_usuario_sco2004_learnerc');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::BIGINT, true, 10);

		$tMap->addForeignKey('ID_SCO2004', 'IdSco2004', 'string', CreoleTypes::BIGINT, 'sco2004', 'ID', false, 10);

		$tMap->addForeignKey('ID_USUARIO', 'IdUsuario', 'string', CreoleTypes::BIGINT, 'usuario', 'ID', false, 10);

		$tMap->addColumn('COMMENT_INDEX', 'CommentIndex', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('COMMENT', 'Comment', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('LOCATION', 'Location', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('TSTAMP', 'Tstamp', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 