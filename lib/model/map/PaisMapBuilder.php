<?php



class PaisMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PaisMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('pais');
		$tMap->setPhpName('Pais');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::BIGINT, true, 10);

		$tMap->addColumn('ISONUM', 'Isonum', 'int', CreoleTypes::SMALLINT, false, 6);

		$tMap->addColumn('ISO2', 'Iso2', 'string', CreoleTypes::VARCHAR, false, 2);

		$tMap->addColumn('ISO3', 'Iso3', 'string', CreoleTypes::VARCHAR, false, 3);

		$tMap->addColumn('NOMBRE', 'Nombre', 'string', CreoleTypes::VARCHAR, false, 80);

	} 
} 