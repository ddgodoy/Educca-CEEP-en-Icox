<?php



class NotificacionMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.NotificacionMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('notificacion');
		$tMap->setPhpName('Notificacion');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::BIGINT, true, 10);

		$tMap->addForeignKey('ID_USUARIO', 'IdUsuario', 'string', CreoleTypes::BIGINT, 'usuario', 'ID', true, 10);

		$tMap->addForeignKey('ID_CURSO', 'IdCurso', 'string', CreoleTypes::BIGINT, 'curso', 'ID', false, 10);

		$tMap->addForeignKey('ID_TEMA', 'IdTema', 'string', CreoleTypes::BIGINT, 'tema', 'ID', false, 10);

		$tMap->addColumn('TIPO', 'Tipo', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('TITULO', 'Titulo', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('CONTENIDO', 'Contenido', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('FECHA', 'Fecha', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 