<?php



class Respuesta_cuestion_practicaMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Respuesta_cuestion_practicaMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('respuesta_cuestion_practica');
		$tMap->setPhpName('Respuesta_cuestion_practica');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::BIGINT, true, 10);

		$tMap->addForeignKey('ID_EJERCICIO_RESUELTO', 'IdEjercicioResuelto', 'string', CreoleTypes::BIGINT, 'ejercicio_resuelto', 'ID', true, 10);

		$tMap->addForeignKey('ID_CUESTION_PRACTICA', 'IdCuestionPractica', 'string', CreoleTypes::BIGINT, 'cuestion_practica', 'ID', true, 10);

		$tMap->addColumn('PUNTUACION', 'Puntuacion', 'double', CreoleTypes::FLOAT, false, null);

	} 
} 