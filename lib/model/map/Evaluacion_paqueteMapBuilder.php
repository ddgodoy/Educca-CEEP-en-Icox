<?php



class Evaluacion_paqueteMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Evaluacion_paqueteMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('evaluacion_paquete');
		$tMap->setPhpName('Evaluacion_paquete');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID_PAQUETE', 'IdPaquete', 'string' , CreoleTypes::BIGINT, 'paquete', 'ID', true, 10);

		$tMap->addForeignPrimaryKey('ID_TAREA', 'IdTarea', 'string' , CreoleTypes::BIGINT, 'tarea', 'ID', true, 10);

		$tMap->addColumn('PESO', 'Peso', 'double', CreoleTypes::FLOAT, false, null);

	} 
} 