<?php

class TicketMapBuilder
{
	const CLASS_NAME = 'lib.model.map.TicketMapBuilder';

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

		$tMap = $this->dbMap->addTable('ticket');
		$tMap->setPhpName('Ticket');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::BIGINT, true, 10);

		$tMap->addForeignKey('ID_ALUMNO', 'IdAlumno', 'string', CreoleTypes::BIGINT, 'usuario', 'ID', true, 10);
		
		$tMap->addColumn('CODIGO', 'Codigo', 'string', CreoleTypes::VARCHAR, false, 100);
		
		$tMap->addColumn('ASUNTO', 'Asunto', 'string', CreoleTypes::VARCHAR, false, 200);

		$tMap->addColumn('MENSAJE', 'Mensaje', 'string', CreoleTypes::LONGVARCHAR, false, null);
		
		$tMap->addColumn('ESTADO', 'Estado', 'string', CreoleTypes::VARCHAR, false, 50); // NO REVISADO | REVISADO | EN PROCESO | CERRADO
		
		$tMap->addColumn('AUTOR', 'Autor', 'string', CreoleTypes::VARCHAR, false, 50); // alumno | admin
		
		$tMap->addColumn('ORIGEN', 'Origen', 'string', CreoleTypes::VARCHAR, false, 10); // SI | NO

		$tMap->addColumn('ABIERTO', 'Abierto', 'int', CreoleTypes::TIMESTAMP, false, null);
		
		$tMap->addColumn('ACTUALIZADO', 'Actualizado', 'int', CreoleTypes::TIMESTAMP, false, null);
		
		$tMap->addColumn('CERRADO', 'Cerrado', 'int', CreoleTypes::TIMESTAMP, false, null);

	}

} // end classs