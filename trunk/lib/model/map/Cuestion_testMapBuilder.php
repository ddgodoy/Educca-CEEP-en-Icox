<?php



class Cuestion_testMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Cuestion_testMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('cuestion_test');
		$tMap->setPhpName('Cuestion_test');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::BIGINT, true, 10);

		$tMap->addForeignKey('ID_EJERCICIO', 'IdEjercicio', 'string', CreoleTypes::BIGINT, 'ejercicio', 'ID', true, 10);

		$tMap->addColumn('PREGUNTA', 'Pregunta', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('NUMERO_RESPUESTAS_CORRECTAS', 'NumeroRespuestasCorrectas', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('NUMERO_RESPUESTAS_INCORRECTAS', 'NumeroRespuestasIncorrectas', 'int', CreoleTypes::INTEGER, false, null);

	} 
} 