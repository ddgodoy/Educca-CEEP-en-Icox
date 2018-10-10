<?php



class Historico_cursos_usuarios_activosMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Historico_cursos_usuarios_activosMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('historico_cursos_usuarios_activos');
		$tMap->setPhpName('Historico_cursos_usuarios_activos');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::BIGINT, true, 10);

		$tMap->addForeignKey('ID_HISTORICO_USUARIOS_ACTIVOS', 'IdHistoricoUsuariosActivos', 'string', CreoleTypes::BIGINT, 'historico_usuarios_activos', 'ID', false, 10);

		$tMap->addColumn('ID_CURSO', 'IdCurso', 'string', CreoleTypes::BIGINT, false, 10);

		$tMap->addColumn('NOMBRE', 'Nombre', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('FECHA_INICIO', 'FechaInicio', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('FECHA_FIN', 'FechaFin', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('DURACION', 'Duracion', 'string', CreoleTypes::BIGINT, false, 10);

		$tMap->addColumn('PRECIO', 'Precio', 'double', CreoleTypes::FLOAT, false, 7);

	} 
} 