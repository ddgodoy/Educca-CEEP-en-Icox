<?php



class Publicado_ejercicio_cursoMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Publicado_ejercicio_cursoMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('publicado_ejercicio_curso');
		$tMap->setPhpName('Publicado_ejercicio_curso');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::BIGINT, true, 10);

		$tMap->addForeignKey('ID_EJERCICIO', 'IdEjercicio', 'string', CreoleTypes::BIGINT, 'ejercicio', 'ID', false, 10);

		$tMap->addForeignKey('ID_CURSO', 'IdCurso', 'string', CreoleTypes::BIGINT, 'curso', 'ID', false, 10);

		$tMap->addColumn('SOLUCION', 'Solucion', 'int', CreoleTypes::TINYINT, false, 1);

	} 
} 