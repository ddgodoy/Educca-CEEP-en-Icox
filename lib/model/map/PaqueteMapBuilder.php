<?php



class PaqueteMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PaqueteMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('paquete');
		$tMap->setPhpName('Paquete');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::BIGINT, true, 10);

		$tMap->addColumn('NOMBRE', 'Nombre', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('FECHA_INICIO', 'FechaInicio', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('FECHA_FIN', 'FechaFin', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('WEBCAM', 'Webcam', 'boolean', CreoleTypes::BOOLEAN, false, 1);

		$tMap->addColumn('SCAN', 'Scan', 'boolean', CreoleTypes::BOOLEAN, false, 1);

		$tMap->addColumn('DURACION', 'Duracion', 'string', CreoleTypes::BIGINT, false, 10);

		$tMap->addColumn('PRECIO', 'Precio', 'double', CreoleTypes::FLOAT, false, 7);

		$tMap->addColumn('MENSUAL', 'Mensual', 'boolean', CreoleTypes::BOOLEAN, false, 1);

		$tMap->addColumn('DESCRIPCION', 'Descripcion', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 