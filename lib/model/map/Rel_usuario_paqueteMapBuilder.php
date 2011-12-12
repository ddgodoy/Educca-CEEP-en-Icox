<?php



class Rel_usuario_paqueteMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Rel_usuario_paqueteMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('rel_usuario_paquete');
		$tMap->setPhpName('Rel_usuario_paquete');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID_USUARIO', 'IdUsuario', 'string' , CreoleTypes::BIGINT, 'usuario', 'ID', true, 10);

		$tMap->addForeignPrimaryKey('ID_PAQUETE', 'IdPaquete', 'string' , CreoleTypes::BIGINT, 'paquete', 'ID', true, 10);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('SCORE', 'Score', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('PRESENCIAL', 'Presencial', 'int', CreoleTypes::TINYINT, false, 1);

	} 
} 