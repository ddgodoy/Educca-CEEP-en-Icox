<?php



class Correccion_cuestion_practicaMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Correccion_cuestion_practicaMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('correccion_cuestion_practica');
		$tMap->setPhpName('Correccion_cuestion_practica');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::BIGINT, true, 10);

		$tMap->addForeignKey('ID_EJERCICIO_CORREGIDO', 'IdEjercicioCorregido', 'string', CreoleTypes::BIGINT, 'ejercicio_corregido', 'ID', true, 10);

		$tMap->addForeignKey('ID_RESPUESTA_CUESTION_PRACTICA', 'IdRespuestaCuestionPractica', 'string', CreoleTypes::BIGINT, 'respuesta_cuestion_practica', 'ID', false, 10);

		$tMap->addColumn('COMENTARIO', 'Comentario', 'string', CreoleTypes::LONGVARCHAR, false, null);

	} 
} 