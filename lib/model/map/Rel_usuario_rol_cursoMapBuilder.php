<?php



class Rel_usuario_rol_cursoMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Rel_usuario_rol_cursoMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('rel_usuario_rol_curso');
		$tMap->setPhpName('Rel_usuario_rol_curso');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID_USUARIO', 'IdUsuario', 'string' , CreoleTypes::BIGINT, 'usuario', 'ID', true, 10);

		$tMap->addForeignKey('ID_ROL', 'IdRol', 'string', CreoleTypes::BIGINT, 'rol', 'ID', false, 10);

		$tMap->addForeignPrimaryKey('ID_CURSO', 'IdCurso', 'string' , CreoleTypes::BIGINT, 'curso', 'ID', true, 10);

		$tMap->addColumn('CAL_DIAS_ANTES', 'CalDiasAntes', 'string', CreoleTypes::BIGINT, false, 10);

		$tMap->addColumn('CAL_DIAS_DESPUES', 'CalDiasDespues', 'string', CreoleTypes::BIGINT, false, 10);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('PRESENCIAL', 'Presencial', 'int', CreoleTypes::TINYINT, false, 1);

		$tMap->addColumn('TRIPARTITA', 'Tripartita', 'int', CreoleTypes::TINYINT, false, 1);

		$tMap->addColumn('FECHA_PRIMER_CONEX', 'FechaPrimerConex', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('FECHA_ULTIMA_CONEX', 'FechaUltimaConex', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 