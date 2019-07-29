<?php



class Licencia_sintesisMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Licencia_sintesisMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('licencia_sintesis');
		$tMap->setPhpName('Licencia_sintesis');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::BIGINT, true, 10);		
		
		$tMap->addForeignPrimaryKey('ID_CURSO', 'IdCurso', 'string' , CreoleTypes::BIGINT, 'curso', 'ID', true, 10);

		$tMap->addForeignPrimaryKey('NUM', 'Num', 'string' , CreoleTypes::BIGINT, 'num', 'NUM', true, 10);	

		$tMap->addColumn('TITLE', 'Title', 'string', CreoleTypes::VARCHAR, false, 100);		

		$tMap->addColumn('CAPITULO', 'Capitulo', 'string', CreoleTypes::VARCHAR, false, 250);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 

