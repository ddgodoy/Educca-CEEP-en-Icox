<?php



class Rel_usuario_sco12MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Rel_usuario_sco12MapBuilder';

	
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

		$tMap = $this->dbMap->addTable('rel_usuario_sco12');
		$tMap->setPhpName('Rel_usuario_sco12');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::BIGINT, true, 10);

		$tMap->addForeignKey('ID_SCO12', 'IdSco12', 'string', CreoleTypes::BIGINT, 'sco12', 'ID', false, 10);

		$tMap->addForeignKey('ID_USUARIO', 'IdUsuario', 'string', CreoleTypes::BIGINT, 'usuario', 'ID', false, 10);

		$tMap->addColumn('LESSON_LOCATION', 'LessonLocation', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('CREDIT', 'Credit', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('LESSON_STATUS', 'LessonStatus', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('ENTRY', 'Entry', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('SCORE_RAW', 'ScoreRaw', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('SCORE_MAX', 'ScoreMax', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('SCORE_MIN', 'ScoreMin', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('TOTAL_TIME', 'TotalTime', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('LESSON_MODE', 'LessonMode', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('EXITVALUE', 'Exitvalue', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('SESSION_TIME', 'SessionTime', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('SUSPEND_DATA', 'SuspendData', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('COMMENTS', 'Comments', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('COMMENTS_FROM_LMS', 'CommentsFromLms', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('PREFERENCE_AUDIO', 'PreferenceAudio', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PREFERENCE_LANGUAGE', 'PreferenceLanguage', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('PREFERENCE_SPEED', 'PreferenceSpeed', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PREFERENCE_TEXT', 'PreferenceText', 'int', CreoleTypes::INTEGER, false, null);

	} 
} 