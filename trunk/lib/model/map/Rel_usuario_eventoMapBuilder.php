<?php



class Rel_usuario_eventoMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Rel_usuario_eventoMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('rel_usuario_evento');
		$tMap->setPhpName('Rel_usuario_evento');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID_USUARIO', 'IdUsuario', 'string' , CreoleTypes::BIGINT, 'usuario', 'ID', true, 10);

		$tMap->addForeignPrimaryKey('ID_EVENTO', 'IdEvento', 'string' , CreoleTypes::BIGINT, 'evento', 'ID', true, 10);

	} 
} 