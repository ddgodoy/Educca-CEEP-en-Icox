<?php



class Criterio_evaluacionMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Criterio_evaluacionMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('criterio_evaluacion');
		$tMap->setPhpName('Criterio_evaluacion');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::BIGINT, true, 10);

		$tMap->addForeignKey('ID_CURSO', 'IdCurso', 'string', CreoleTypes::BIGINT, 'usuario', 'ID', true, 10);

		$tMap->addColumn('OBLIGATORIO', 'Obligatorio', 'int', CreoleTypes::TINYINT, false, 1);

		$tMap->addColumn('PESO', 'Peso', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('DESCRIPCION', 'Descripcion', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addForeignKey('ID_TAREA', 'IdTarea', 'string', CreoleTypes::BIGINT, 'tarea', 'ID', false, 10);

	} 
} 