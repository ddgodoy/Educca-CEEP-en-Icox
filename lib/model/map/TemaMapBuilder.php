<?php



class TemaMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.TemaMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('tema');
		$tMap->setPhpName('Tema');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::BIGINT, true, 10);

		$tMap->addColumn('NOMBRE', 'Nombre', 'string', CreoleTypes::VARCHAR, false, 90);

		$tMap->addColumn('FICHERO', 'Fichero', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('NUMERO_TEMA', 'NumeroTema', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addForeignKey('ID_MATERIA', 'IdMateria', 'string', CreoleTypes::BIGINT, 'materia', 'ID', false, 10);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 