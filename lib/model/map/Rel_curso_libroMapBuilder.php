<?php



class Rel_curso_libroMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Rel_curso_libroMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('rel_curso_libro');
		$tMap->setPhpName('Rel_curso_libro');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID_CURSO', 'IdCurso', 'string' , CreoleTypes::BIGINT, 'curso', 'ID', true, 10);

		$tMap->addForeignPrimaryKey('ID_LIBRO', 'IdLibro', 'string' , CreoleTypes::BIGINT, 'libro', 'ID', true, 10);

	} 
} 