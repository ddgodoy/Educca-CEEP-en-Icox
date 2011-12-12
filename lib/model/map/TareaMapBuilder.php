<?php



class TareaMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.TareaMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('tarea');
		$tMap->setPhpName('Tarea');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::BIGINT, true, 10);

		$tMap->addForeignKey('ID_CURSO', 'IdCurso', 'string', CreoleTypes::BIGINT, 'curso', 'ID', true, 10);

		$tMap->addForeignKey('ID_EJERCICIO', 'IdEjercicio', 'string', CreoleTypes::BIGINT, 'ejercicio', 'ID', true, 10);

		$tMap->addForeignKey('ID_AUTOR', 'IdAutor', 'string', CreoleTypes::BIGINT, 'usuario', 'ID', true, 10);

		$tMap->addForeignKey('ID_EVENTO', 'IdEvento', 'string', CreoleTypes::BIGINT, 'evento', 'ID', true, 10);

		$tMap->addColumn('TIEMPO_DISPONIBLE', 'TiempoDisponible', 'int', CreoleTypes::INTEGER, false, null);

	} 
} 