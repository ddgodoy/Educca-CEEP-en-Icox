<?php



class Ejercicio_corregidoMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Ejercicio_corregidoMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('ejercicio_corregido');
		$tMap->setPhpName('Ejercicio_corregido');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::BIGINT, true, 10);

		$tMap->addForeignKey('ID_CORRECTOR', 'IdCorrector', 'string', CreoleTypes::BIGINT, 'usuario', 'ID', false, 10);

		$tMap->addForeignKey('ID_EJERCICIO_RESUELTO', 'IdEjercicioResuelto', 'string', CreoleTypes::BIGINT, 'ejercicio_resuelto', 'ID', false, 10);

	} 
} 