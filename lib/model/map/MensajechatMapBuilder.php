<?php



class MensajechatMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.MensajechatMapBuilder';

	
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
		$tMap->setPhpName('Mensajechat');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::BIGINT, true, 10);

		$tMap->addForeignKey('USER', 'User', 'string', CreoleTypes::VARCHAR, 'usuario', 'NOMBREUSUARIO', true, 100);

		$tMap->addColumn('MSG', 'Msg', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('TIME', 'Time', 'int', CreoleTypes::INTEGER, false, null);

	} 
} 