<?php



class MensajeMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.MensajeMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('mensaje');
		$tMap->setPhpName('Mensaje');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::BIGINT, true, 10);

		$tMap->addForeignKey('ID_PROPIETARIO', 'IdPropietario', 'string', CreoleTypes::BIGINT, 'usuario', 'ID', true, 10);

		$tMap->addForeignKey('ID_EMISOR', 'IdEmisor', 'string', CreoleTypes::BIGINT, 'usuario', 'ID', true, 10);

		$tMap->addForeignKey('ID_DESTINATARIO', 'IdDestinatario', 'string', CreoleTypes::BIGINT, 'usuario', 'ID', false, 10);

		$tMap->addForeignKey('ID_CURSO', 'IdCurso', 'string', CreoleTypes::BIGINT, 'curso', 'ID', true, 10);

		$tMap->addColumn('LISTA_DESTINATARIOS', 'ListaDestinatarios', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addForeignKey('ID_ASUNTO', 'IdAsunto', 'string', CreoleTypes::BIGINT, 'asunto_mensaje', 'ID', true, 10);

		$tMap->addColumn('CONTENIDO', 'Contenido', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('LEIDO', 'Leido', 'int', CreoleTypes::TINYINT, false, 1);

		$tMap->addColumn('BORRADO', 'Borrado', 'int', CreoleTypes::TINYINT, false, 1);

		$tMap->addColumn('SUPERVISOR', 'Supervisor', 'int', CreoleTypes::TINYINT, false, 1);

		$tMap->addColumn('ADJUNTOS', 'Adjuntos', 'int', CreoleTypes::BIGINT, false, 10);

	} 
} 