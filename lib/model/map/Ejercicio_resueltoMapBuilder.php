<?php



class Ejercicio_resueltoMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Ejercicio_resueltoMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('ejercicio_resuelto');
		$tMap->setPhpName('Ejercicio_resuelto');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::BIGINT, true, 10);

		$tMap->addForeignKey('ID_AUTOR', 'IdAutor', 'string', CreoleTypes::BIGINT, 'usuario', 'ID', true, 10);

		$tMap->addForeignKey('ID_EJERCICIO', 'IdEjercicio', 'string', CreoleTypes::BIGINT, 'ejercicio', 'ID', true, 10);

		$tMap->addForeignKey('ID_CORRECTOR', 'IdCorrector', 'string', CreoleTypes::BIGINT, 'usuario', 'ID', false, 10);

		$tMap->addColumn('FECHA_CORRECCION', 'FechaCorreccion', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('SCORE', 'Score', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('ACIERTOS', 'Aciertos', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('FALLOS', 'Fallos', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('BLANCOS', 'Blancos', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TIEMPO', 'Tiempo', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('REPOSITORIO', 'Repositorio', 'int', CreoleTypes::TINYINT, false, 1);

		$tMap->addColumn('ID_CURSO', 'IdCurso', 'string', CreoleTypes::BIGINT, false, 10);

	} 
} 