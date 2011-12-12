<?php



class Respuesta_cuestion_cortaMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Respuesta_cuestion_cortaMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('respuesta_cuestion_corta');
		$tMap->setPhpName('Respuesta_cuestion_corta');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::BIGINT, true, 10);

		$tMap->addForeignKey('ID_EJERCICIO_RESUELTO', 'IdEjercicioResuelto', 'string', CreoleTypes::BIGINT, 'ejercicio_resuelto', 'ID', true, 10);

		$tMap->addForeignKey('ID_CUESTION_CORTA', 'IdCuestionCorta', 'string', CreoleTypes::BIGINT, 'cuestion_corta', 'ID', true, 10);

		$tMap->addColumn('RESPUESTA', 'Respuesta', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('COMENTARIO', 'Comentario', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('PUNTUACION', 'Puntuacion', 'double', CreoleTypes::FLOAT, false, null);

	} 
} 