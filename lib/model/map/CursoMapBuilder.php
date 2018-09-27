<?php



class CursoMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.CursoMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('curso');
		$tMap->setPhpName('Curso');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::BIGINT, true, 10);

		$tMap->addColumn('NOMBRE', 'Nombre', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('INFORMACION_EXTENDIDA', 'InformacionExtendida', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('FECHA_INICIO', 'FechaInicio', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('FECHA_FIN', 'FechaFin', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('SCAN', 'Scan', 'boolean', CreoleTypes::BOOLEAN, false, 1);

		$tMap->addColumn('DURACION', 'Duracion', 'string', CreoleTypes::BIGINT, false, 10);

		$tMap->addColumn('PRECIO', 'Precio', 'double', CreoleTypes::FLOAT, false, 7);

		$tMap->addColumn('MENSUAL', 'Mensual', 'boolean', CreoleTypes::BOOLEAN, false, 1);

		$tMap->addForeignKey('MATERIA_ID', 'MateriaId', 'string', CreoleTypes::BIGINT, 'materia', 'ID', false, 10);

		$tMap->addColumn('MENU_INFO', 'MenuInfo', 'boolean', CreoleTypes::BOOLEAN, false, 1);

		$tMap->addColumn('MENU_BIBLIO', 'MenuBiblio', 'boolean', CreoleTypes::BOOLEAN, false, 1);

		$tMap->addColumn('MENU_TEMARIO', 'MenuTemario', 'boolean', CreoleTypes::BOOLEAN, false, 1);

		$tMap->addColumn('MENU_SEGUIMIENTO', 'MenuSeguimiento', 'boolean', CreoleTypes::BOOLEAN, false, 1);

		$tMap->addColumn('MENU_EVENTOS', 'MenuEventos', 'boolean', CreoleTypes::BOOLEAN, false, 1);

		$tMap->addColumn('MENU_CHAT', 'MenuChat', 'boolean', CreoleTypes::BOOLEAN, false, 1);

		$tMap->addColumn('MENU_FORO', 'MenuForo', 'boolean', CreoleTypes::BOOLEAN, false, 1);

		$tMap->addColumn('MENU_EJERCICIOS', 'MenuEjercicios', 'boolean', CreoleTypes::BOOLEAN, false, 1);

		$tMap->addColumn('MENU_PLANIFICACION_ALUMNOS', 'MenuPlanificacionAlumnos', 'boolean', CreoleTypes::BOOLEAN, false, 1);

		$tMap->addColumn('MENU_BIBLIOTECA_ARCHIVOS', 'MenuBibliotecaArchivos', 'boolean', CreoleTypes::BOOLEAN, false, 1);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 