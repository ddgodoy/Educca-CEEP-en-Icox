<?php



class Usuarios_onlineMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Usuarios_onlineMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('usuarios_online');
		$tMap->setPhpName('Usuarios_online');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID_USUARIO', 'IdUsuario', 'string' , CreoleTypes::BIGINT, 'usuario', 'ID', true, 10);

		$tMap->addForeignPrimaryKey('ID_CURSO', 'IdCurso', 'string' , CreoleTypes::BIGINT, 'curso', 'ID', true, 10);

		$tMap->addForeignKey('ID_ROL', 'IdRol', 'string', CreoleTypes::BIGINT, 'rol', 'ID', true, 10);

		$tMap->addColumn('TIEMPO', 'Tiempo', 'string', CreoleTypes::BIGINT, false, 20);

	} 
} 