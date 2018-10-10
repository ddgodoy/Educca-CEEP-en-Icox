<?php



class Rel_usuario_tareaMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Rel_usuario_tareaMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('rel_usuario_tarea');
		$tMap->setPhpName('Rel_usuario_tarea');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID_USUARIO', 'IdUsuario', 'string' , CreoleTypes::BIGINT, 'usuario', 'ID', true, 10);

		$tMap->addForeignPrimaryKey('ID_TAREA', 'IdTarea', 'string' , CreoleTypes::BIGINT, 'tarea', 'ID', true, 10);

		$tMap->addForeignKey('ID_EJERCICIO_RESUELTO', 'IdEjercicioResuelto', 'string', CreoleTypes::BIGINT, 'ejercicio_resuelto', 'ID', false, 10);

		$tMap->addColumn('ENTREGADA', 'Entregada', 'int', CreoleTypes::TINYINT, false, 1);

		$tMap->addColumn('CORREGIDA', 'Corregida', 'int', CreoleTypes::TINYINT, false, 1);

		$tMap->addColumn('FECHA_ENTREGA', 'FechaEntrega', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('TIEMPO_RESTANTE', 'TiempoRestante', 'int', CreoleTypes::INTEGER, false, null);

	} 
} 