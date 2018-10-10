<?php



class Rel_usuario_sco2004MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Rel_usuario_sco2004MapBuilder';

	
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

		$tMap = $this->dbMap->addTable('rel_usuario_sco2004');
		$tMap->setPhpName('Rel_usuario_sco2004');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::BIGINT, true, 10);

		$tMap->addForeignKey('ID_SCO2004', 'IdSco2004', 'string', CreoleTypes::BIGINT, 'sco2004', 'ID', false, 10);

		$tMap->addForeignKey('ID_USUARIO', 'IdUsuario', 'string', CreoleTypes::BIGINT, 'usuario', 'ID', false, 10);

		$tMap->addColumn('COMPLETION_STATUS', 'CompletionStatus', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('ENTRY', 'Entry', 'string', CreoleTypes::VARCHAR, false, 10);

		$tMap->addColumn('EXIT', 'Exit', 'string', CreoleTypes::VARCHAR, false, 10);

		$tMap->addColumn('AUDIO_LEVEL', 'AudioLevel', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('LANGUAGE', 'Language', 'string', CreoleTypes::VARCHAR, false, 250);

		$tMap->addColumn('DELIVERY_SPEED', 'DeliverySpeed', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('AUDIO_CAPTIONING', 'AudioCaptioning', 'string', CreoleTypes::VARCHAR, false, 10);

		$tMap->addColumn('LOCATION', 'Location', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('MODE', 'Mode', 'string', CreoleTypes::VARCHAR, false, 10);

		$tMap->addColumn('PROGRESS_MEASURE', 'ProgressMeasure', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('SCORE_SCALED', 'ScoreScaled', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('SCORE_RAW', 'ScoreRaw', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('SCORE_MIN', 'ScoreMin', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('SCORE_MAX', 'ScoreMax', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('SESSION_TIME', 'SessionTime', 'string', CreoleTypes::BIGINT, false, null);

		$tMap->addColumn('SUCCESS_STATUS', 'SuccessStatus', 'string', CreoleTypes::VARCHAR, false, 10);

		$tMap->addColumn('SUSPEND_DATA', 'SuspendData', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('TOTAL_TIME', 'TotalTime', 'string', CreoleTypes::BIGINT, false, null);

	} 
} 