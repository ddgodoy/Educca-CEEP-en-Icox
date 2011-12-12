<?php



class Rel_usuario_sco2004_interactionMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Rel_usuario_sco2004_interactionMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('rel_usuario_sco2004_interaction');
		$tMap->setPhpName('Rel_usuario_sco2004_interaction');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::BIGINT, true, 10);

		$tMap->addForeignKey('ID_SCO2004', 'IdSco2004', 'string', CreoleTypes::BIGINT, 'sco2004', 'ID', false, 10);

		$tMap->addForeignKey('ID_USUARIO', 'IdUsuario', 'string', CreoleTypes::BIGINT, 'usuario', 'ID', false, 10);

		$tMap->addColumn('INTERACTION_INDEX', 'InteractionIndex', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('INTERACTION_ID', 'InteractionId', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('TYPE', 'Type', 'string', CreoleTypes::VARCHAR, false, 18);

		$tMap->addColumn('TSTAMP', 'Tstamp', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('WEIGHTING', 'Weighting', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('LEARNER_RESPONSE', 'LearnerResponse', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('RESULT', 'Result', 'string', CreoleTypes::VARCHAR, false, 18);

		$tMap->addColumn('LATENCY', 'Latency', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::LONGVARCHAR, false, null);

	} 
} 