<?php



class Sco12MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Sco12MapBuilder';

	
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

		$tMap = $this->dbMap->addTable('sco12');
		$tMap->setPhpName('Sco12');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::BIGINT, true, 10);

		$tMap->addColumn('REF_SCO12', 'RefSco12', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addForeignKey('ID_MATERIA', 'IdMateria', 'string', CreoleTypes::BIGINT, 'materia', 'ID', false, 10);

		$tMap->addColumn('TITLE', 'Title', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('FILE', 'File', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('CREDIT', 'Credit', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('LAUNCH_DATA', 'LaunchData', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('MASTERY_SCORE', 'MasteryScore', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('MAX_TIME_ALLOWED', 'MaxTimeAllowed', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('TIME_LIMIT_ACTION', 'TimeLimitAction', 'string', CreoleTypes::LONGVARCHAR, false, null);

	} 
} 