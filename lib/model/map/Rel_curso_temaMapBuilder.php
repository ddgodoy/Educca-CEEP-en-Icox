<?php



class Rel_curso_temaMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Rel_curso_temaMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('rel_curso_tema');
		$tMap->setPhpName('Rel_curso_tema');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID_CURSO', 'IdCurso', 'string' , CreoleTypes::BIGINT, 'curso', 'ID', true, 10);

		$tMap->addForeignPrimaryKey('ID_TEMA', 'IdTema', 'string' , CreoleTypes::BIGINT, 'tema', 'ID', true, 10);

		$tMap->addColumn('FECHA_COMPLETADO', 'FechaCompletado', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 