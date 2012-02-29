<?php



class Rel_usuario_rolMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Rel_usuario_rolMapBuilder';

	
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
		$tMap->setPhpName('Rel_usuario_rol');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID_USUARIO', 'IdUsuario', 'string' , CreoleTypes::BIGINT, 'usuario', 'ID', true, 10);

		$tMap->addForeignPrimaryKey('ID_ROL', 'IdRol', 'string' , CreoleTypes::BIGINT, 'rol', 'ID', true, 10);

		$tMap->addForeignKey('ID_CURSO', 'IdCurso', 'string', CreoleTypes::BIGINT, 'curso', 'ID', false, 10);

	} 
} 