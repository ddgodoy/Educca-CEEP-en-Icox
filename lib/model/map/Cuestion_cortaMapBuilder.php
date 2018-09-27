<?php



class Cuestion_cortaMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Cuestion_cortaMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('cuestion_corta');
		$tMap->setPhpName('Cuestion_corta');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::BIGINT, true, 10);

		$tMap->addForeignKey('ID_EJERCICIO', 'IdEjercicio', 'string', CreoleTypes::BIGINT, 'ejercicio', 'ID', true, 10);

		$tMap->addColumn('PREGUNTA', 'Pregunta', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('PUNTUACION', 'Puntuacion', 'double', CreoleTypes::FLOAT, false, null);

	} 
} 