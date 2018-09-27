<?php



class Comentario_cuestionMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Comentario_cuestionMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('comentario_cuestion');
		$tMap->setPhpName('Comentario_cuestion');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::BIGINT, true, 10);

		$tMap->addForeignKey('ID_EJERCICIO_CORREGIDO', 'IdEjercicioCorregido', 'string', CreoleTypes::BIGINT, 'ejercicio_corregido', 'ID', true, 10);

		$tMap->addForeignKey('ID_RESPUESTA_CUESTION_CORTA', 'IdRespuestaCuestionCorta', 'string', CreoleTypes::BIGINT, 'respuesta_cuestion_corta', 'ID', false, 10);

		$tMap->addColumn('COMENTARIO', 'Comentario', 'string', CreoleTypes::LONGVARCHAR, false, null);

	} 
} 