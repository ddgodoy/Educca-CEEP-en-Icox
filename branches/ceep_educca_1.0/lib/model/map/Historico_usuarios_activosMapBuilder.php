<?php



class Historico_usuarios_activosMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Historico_usuarios_activosMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('historico_usuarios_activos');
		$tMap->setPhpName('Historico_usuarios_activos');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::BIGINT, true, 10);

		$tMap->addColumn('FECHA', 'Fecha', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('ID_USUARIO', 'IdUsuario', 'string', CreoleTypes::BIGINT, false, 10);

		$tMap->addColumn('NOMBREUSUARIO', 'Nombreusuario', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('DNI', 'Dni', 'string', CreoleTypes::VARCHAR, false, 10);

		$tMap->addColumn('NOMBRE', 'Nombre', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('APELLIDOS', 'Apellidos', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('EMAIL', 'Email', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('TELEFONO1', 'Telefono1', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('TELEFONO2', 'Telefono2', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('DIAS_MATRICULADO', 'DiasMatriculado', 'string', CreoleTypes::BIGINT, false, 20);

	} 
} 