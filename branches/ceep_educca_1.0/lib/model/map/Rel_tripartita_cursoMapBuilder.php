<?php



class Rel_tripartita_cursoMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Rel_tripartita_cursoMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('rel_tripartita_curso');
		$tMap->setPhpName('Rel_tripartita_curso');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID_USUARIO', 'IdUsuario', 'string' , CreoleTypes::BIGINT, 'usuario', 'ID', true, 10);

		$tMap->addForeignPrimaryKey('ID_CURSO', 'IdCurso', 'string' , CreoleTypes::BIGINT, 'curso', 'ID', true, 10);

	} 
} 