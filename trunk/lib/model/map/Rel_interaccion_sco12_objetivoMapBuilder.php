<?php



class Rel_interaccion_sco12_objetivoMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Rel_interaccion_sco12_objetivoMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('rel_interaccion_sco12_objetivo');
		$tMap->setPhpName('Rel_interaccion_sco12_objetivo');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::BIGINT, true, 10);

		$tMap->addColumn('INDEX_OBJETIVO', 'IndexObjetivo', 'string', CreoleTypes::BIGINT, false, 10);

		$tMap->addColumn('INDEX_INTERACCION', 'IndexInteraccion', 'string', CreoleTypes::BIGINT, false, 10);

		$tMap->addForeignKey('ID_SCO12', 'IdSco12', 'string', CreoleTypes::BIGINT, 'sco12', 'ID', false, 10);

		$tMap->addForeignKey('ID_USUARIO', 'IdUsuario', 'string', CreoleTypes::BIGINT, 'usuario', 'ID', false, 10);

		$tMap->addColumn('REF_OBJETIVO', 'RefObjetivo', 'string', CreoleTypes::VARCHAR, false, 255);

	} 
} 