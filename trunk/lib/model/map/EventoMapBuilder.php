<?php



class EventoMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.EventoMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('evento');
		$tMap->setPhpName('Evento');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::BIGINT, true, 10);

		$tMap->addForeignKey('ID_CURSO', 'IdCurso', 'string', CreoleTypes::BIGINT, 'curso', 'ID', false, 10);

		$tMap->addColumn('PRIVADO', 'Privado', 'int', CreoleTypes::TINYINT, false, 2);

		$tMap->addColumn('FECHA_INICIO', 'FechaInicio', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('FECHA_FIN', 'FechaFin', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addForeignKey('ID_TIPO_EVENTO', 'IdTipoEvento', 'string', CreoleTypes::BIGINT, 'tipo_evento', 'ID', false, 10);

		$tMap->addForeignKey('ID_TIPO_CITA', 'IdTipoCita', 'string', CreoleTypes::BIGINT, 'tipo_cita', 'ID', false, 10);

		$tMap->addColumn('RECURRENTE', 'Recurrente', 'string', CreoleTypes::BIGINT, false, 7);

		$tMap->addColumn('TITULO', 'Titulo', 'string', CreoleTypes::VARCHAR, false, 150);

		$tMap->addColumn('DESCRIPCION', 'Descripcion', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 