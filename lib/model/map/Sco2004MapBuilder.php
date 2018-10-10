<?php



class Sco2004MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Sco2004MapBuilder';

	
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

		$tMap = $this->dbMap->addTable('sco2004');
		$tMap->setPhpName('Sco2004');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::BIGINT, true, 10);

		$tMap->addColumn('REF_SCO2004', 'RefSco2004', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addForeignKey('ID_MATERIA', 'IdMateria', 'string', CreoleTypes::BIGINT, 'materia', 'ID', false, 10);

		$tMap->addColumn('TITLE', 'Title', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('FILE', 'File', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('COMPLETION_TRESHOLD', 'CompletionTreshold', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('CREDIT', 'Credit', 'string', CreoleTypes::VARCHAR, false, 10);

		$tMap->addColumn('LAUNCH_DATA', 'LaunchData', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('MAX_TIME_ALLOWED', 'MaxTimeAllowed', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('MODE', 'Mode', 'string', CreoleTypes::VARCHAR, false, 10);

		$tMap->addColumn('TIME_LIMIT_ACTION', 'TimeLimitAction', 'string', CreoleTypes::VARCHAR, false, 10);

		$tMap->addColumn('SCALED_PASSING_SCORE', 'ScaledPassingScore', 'double', CreoleTypes::FLOAT, false, null);

	} 
} 