<?php



class Rel_usuario_objetivo_sco12MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Rel_usuario_objetivo_sco12MapBuilder';

	
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

		$tMap = $this->dbMap->addTable('rel_usuario_objetivo_sco12');
		$tMap->setPhpName('Rel_usuario_objetivo_sco12');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::BIGINT, true, 10);

		$tMap->addColumn('REF_OBJETIVO', 'RefObjetivo', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('INDEX_OBJETIVO', 'IndexObjetivo', 'string', CreoleTypes::BIGINT, false, 10);

		$tMap->addForeignKey('ID_SCO12', 'IdSco12', 'string', CreoleTypes::BIGINT, 'sco12', 'ID', false, 10);

		$tMap->addForeignKey('ID_USUARIO', 'IdUsuario', 'string', CreoleTypes::BIGINT, 'usuario', 'ID', false, 10);

		$tMap->addColumn('SCORE_RAW', 'ScoreRaw', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('SCORE_MAX', 'ScoreMax', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('SCORE_MIN', 'ScoreMin', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('STATUS', 'Status', 'string', CreoleTypes::VARCHAR, false, 20);

	} 
} 