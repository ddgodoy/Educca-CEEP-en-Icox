<?php



class MateriaMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.MateriaMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('materia');
		$tMap->setPhpName('Materia');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::BIGINT, true, 10);

		$tMap->addColumn('NOMBRE', 'Nombre', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('INFORMACION', 'Informacion', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('NORMATIVA', 'Normativa', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('TEMAS_TOTALES', 'TemasTotales', 'string', CreoleTypes::BIGINT, false, 5);

		$tMap->addColumn('HEIGHT', 'Height', 'string', CreoleTypes::BIGINT, false, 5);

		$tMap->addColumn('WIDTH', 'Width', 'string', CreoleTypes::BIGINT, false, 5);

		$tMap->addColumn('TIPO', 'Tipo', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 