<?php



class Mensaje_chatMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Mensaje_chatMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('mensaje_chat');
		$tMap->setPhpName('Mensaje_chat');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::BIGINT, true, 10);

		$tMap->addForeignPrimaryKey('ID_USUARIO', 'IdUsuario', 'string' , CreoleTypes::BIGINT, 'usuario', 'ID', true, 10);

		$tMap->addForeignPrimaryKey('ID_CURSO', 'IdCurso', 'string' , CreoleTypes::BIGINT, 'curso', 'ID', true, 10);

		$tMap->addColumn('MSG', 'Msg', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('TIME', 'Time', 'int', CreoleTypes::INTEGER, false, null);

	} 
} 