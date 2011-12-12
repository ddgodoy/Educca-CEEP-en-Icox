<?php



class Preferencia_usuarioMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Preferencia_usuarioMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('preferencia_usuario');
		$tMap->setPhpName('Preferencia_usuario');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('USUARIO_ID', 'UsuarioId', 'string' , CreoleTypes::BIGINT, 'usuario', 'ID', true, 10);

		$tMap->addColumn('CAL_DIAS_ANTES', 'CalDiasAntes', 'string', CreoleTypes::BIGINT, false, 10);

		$tMap->addColumn('CAL_DIAS_DESPUES', 'CalDiasDespues', 'string', CreoleTypes::BIGINT, false, 10);

	} 
} 