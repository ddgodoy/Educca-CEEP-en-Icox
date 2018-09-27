<?php



class UsuarioMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.UsuarioMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('usuario');
		$tMap->setPhpName('Usuario');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::BIGINT, true, 10);

		$tMap->addColumn('CONFIRMADO', 'Confirmado', 'int', CreoleTypes::TINYINT, false, 1);

		$tMap->addColumn('BORRADO', 'Borrado', 'int', CreoleTypes::TINYINT, false, 1);

		$tMap->addColumn('NOMBREUSUARIO', 'Nombreusuario', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('SHA1_PASSWORD', 'Sha1Password', 'string', CreoleTypes::VARCHAR, false, 40);

		$tMap->addColumn('SALT', 'Salt', 'string', CreoleTypes::VARCHAR, false, 32);

		$tMap->addColumn('DNI', 'Dni', 'string', CreoleTypes::VARCHAR, false, 10);

		$tMap->addColumn('NOMBRE', 'Nombre', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('APELLIDOS', 'Apellidos', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('EMAIL', 'Email', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('EMAILSTOP', 'Emailstop', 'int', CreoleTypes::TINYINT, false, 1);

		$tMap->addColumn('TELEFONO1', 'Telefono1', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('TELEFONO2', 'Telefono2', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('INSTITUCION', 'Institucion', 'string', CreoleTypes::VARCHAR, false, 40);

		$tMap->addColumn('DEPARTAMENTO', 'Departamento', 'string', CreoleTypes::VARCHAR, false, 30);

		$tMap->addColumn('DIRECCION', 'Direccion', 'string', CreoleTypes::VARCHAR, false, 70);

		$tMap->addColumn('CP', 'Cp', 'string', CreoleTypes::VARCHAR, false, 5);

		$tMap->addColumn('CIUDAD', 'Ciudad', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addForeignKey('PAIS_ID', 'PaisId', 'string', CreoleTypes::BIGINT, 'pais', 'ID', false, 10);

		$tMap->addColumn('ULTIMOACCESO', 'Ultimoacceso', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('ULTIMAIP', 'Ultimaip', 'string', CreoleTypes::VARCHAR, false, 15);

		$tMap->addColumn('SECRETO', 'Secreto', 'string', CreoleTypes::VARCHAR, false, 15);

		$tMap->addColumn('CONECTADO', 'Conectado', 'boolean', CreoleTypes::BOOLEAN, false, 1);

		$tMap->addColumn('FOTO', 'Foto', 'int', CreoleTypes::TINYINT, false, 1);

		$tMap->addColumn('MOROSO', 'Moroso', 'int', CreoleTypes::TINYINT, false, 1);

		$tMap->addColumn('NUMCONEXION', 'Numconexion', 'string', CreoleTypes::BIGINT, false, 10);

		$tMap->addColumn('MAT_ONLINE', 'MatOnline', 'int', CreoleTypes::TINYINT, false, 1);

		$tMap->addColumn('MAT_IP', 'MatIp', 'string', CreoleTypes::VARCHAR, false, 15);

		$tMap->addColumn('PRESENCIAL', 'Presencial', 'int', CreoleTypes::TINYINT, false, 1);
                
                $tMap->addColumn('INSPECTOR', 'Inspector', 'int', CreoleTypes::TINYINT, false, 1);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 