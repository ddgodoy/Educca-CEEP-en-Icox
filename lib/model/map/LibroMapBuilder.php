<?php



class LibroMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.LibroMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('libro');
		$tMap->setPhpName('Libro');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::BIGINT, true, 10);

		$tMap->addColumn('NOMBRE', 'Nombre', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('AUTOR', 'Autor', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('EDITORIAL', 'Editorial', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('ANIO_PUBLICACION', 'AnioPublicacion', 'string', CreoleTypes::VARCHAR, false, 4);

		$tMap->addColumn('ISBN', 'Isbn', 'string', CreoleTypes::VARCHAR, false, 17);

		$tMap->addForeignKey('ID_MATERIA', 'IdMateria', 'string', CreoleTypes::BIGINT, 'materia', 'ID', false, 10);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 