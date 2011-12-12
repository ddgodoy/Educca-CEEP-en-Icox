<?php



class Seguimiento_mensajeMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Seguimiento_mensajeMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('seguimiento_mensaje');
		$tMap->setPhpName('Seguimiento_mensaje');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignKey('ID_PROFESOR', 'IdProfesor', 'string', CreoleTypes::BIGINT, 'usuario', 'ID', true, 10);

		$tMap->addPrimaryKey('ID_PREGUNTA', 'IdPregunta', 'string', CreoleTypes::BIGINT, true, 10);

		$tMap->addColumn('FECHA_RESPUESTA', 'FechaRespuesta', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 