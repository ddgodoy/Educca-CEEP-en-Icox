<?php



class Rel_usuario_sco2004_objectiveMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Rel_usuario_sco2004_objectiveMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('rel_usuario_sco2004_objective');
		$tMap->setPhpName('Rel_usuario_sco2004_objective');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::BIGINT, true, 10);

		$tMap->addForeignKey('ID_SCO2004', 'IdSco2004', 'string', CreoleTypes::BIGINT, 'sco2004', 'ID', false, 10);

		$tMap->addForeignKey('ID_USUARIO', 'IdUsuario', 'string', CreoleTypes::BIGINT, 'usuario', 'ID', false, 10);

		$tMap->addColumn('OBJECTIVE_INDEX', 'ObjectiveIndex', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('OBJECTIVE_ID', 'ObjectiveId', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('SCORE_SCALED', 'ScoreScaled', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('SCORE_RAW', 'ScoreRaw', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('SCORE_MIN', 'ScoreMin', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('SCORE_MAX', 'ScoreMax', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('SUCCESS_STATUS', 'SuccessStatus', 'string', CreoleTypes::VARCHAR, false, 10);

		$tMap->addColumn('COMPLETION_STATUS', 'CompletionStatus', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('PROGRESS_MEASURE', 'ProgressMeasure', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::LONGVARCHAR, false, null);

	} 
} 