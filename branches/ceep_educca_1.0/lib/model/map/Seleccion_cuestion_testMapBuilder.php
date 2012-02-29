<?php



class Seleccion_cuestion_testMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Seleccion_cuestion_testMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('seleccion_cuestion_test');
		$tMap->setPhpName('Seleccion_cuestion_test');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::BIGINT, true, 10);

		$tMap->addForeignKey('ID_RESPUESTA_CUESTION_TEST', 'IdRespuestaCuestionTest', 'string', CreoleTypes::BIGINT, 'respuesta_cuestion_test', 'ID', true, 10);

		$tMap->addForeignKey('ID_EJERCICIO_RESUELTO', 'IdEjercicioResuelto', 'string', CreoleTypes::BIGINT, 'ejercicio_resuelto', 'ID', true, 10);

	} 
} 