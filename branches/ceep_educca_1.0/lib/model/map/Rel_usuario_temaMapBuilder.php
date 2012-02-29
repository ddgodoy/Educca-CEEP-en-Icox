<?php



class Rel_usuario_temaMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Rel_usuario_temaMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('rel_usuario_tema');
		$tMap->setPhpName('Rel_usuario_tema');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID_USUARIO', 'IdUsuario', 'string' , CreoleTypes::BIGINT, 'usuario', 'ID', true, 10);

		$tMap->addForeignPrimaryKey('ID_TEMA', 'IdTema', 'string' , CreoleTypes::BIGINT, 'tema', 'ID', true, 10);

		$tMap->addColumn('TIEMPO', 'Tiempo', 'string', CreoleTypes::BIGINT, false, 10);

		$tMap->addColumn('ESTADO', 'Estado', 'int', CreoleTypes::TINYINT, false, 3);

		$tMap->addColumn('FECHA_INICIO', 'FechaInicio', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('FECHA_COMPLETADO', 'FechaCompletado', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 