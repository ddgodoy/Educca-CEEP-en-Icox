<?php



class Rel_paquete_cursoMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Rel_paquete_cursoMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('rel_paquete_curso');
		$tMap->setPhpName('Rel_paquete_curso');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID_PAQUETE', 'IdPaquete', 'string' , CreoleTypes::BIGINT, 'paquete', 'ID', true, 10);

		$tMap->addForeignPrimaryKey('ID_CURSO', 'IdCurso', 'string' , CreoleTypes::BIGINT, 'curso', 'ID', true, 10);

	} 
} 