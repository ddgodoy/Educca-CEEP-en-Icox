<?php



class Respuesta_cuestion_testMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Respuesta_cuestion_testMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('respuesta_cuestion_test');
		$tMap->setPhpName('Respuesta_cuestion_test');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::BIGINT, true, 10);

		$tMap->addForeignKey('ID_CUESTION_TEST', 'IdCuestionTest', 'string', CreoleTypes::BIGINT, 'cuestion_test', 'ID', true, 10);

		$tMap->addColumn('RESPUESTA', 'Respuesta', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('CORRECTA', 'Correcta', 'int', CreoleTypes::TINYINT, false, 1);

	} 
} 