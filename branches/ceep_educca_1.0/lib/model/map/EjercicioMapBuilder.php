<?php



class EjercicioMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.EjercicioMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('ejercicio');
		$tMap->setPhpName('Ejercicio');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::BIGINT, true, 10);

		$tMap->addForeignKey('ID_AUTOR', 'IdAutor', 'string', CreoleTypes::BIGINT, 'usuario', 'ID', false, 10);

		$tMap->addForeignKey('ID_MATERIA', 'IdMateria', 'string', CreoleTypes::BIGINT, 'materia', 'ID', false, 10);

		$tMap->addColumn('NOMBRE_AUTOR', 'NombreAutor', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('TIPO', 'Tipo', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('TITULO', 'Titulo', 'string', CreoleTypes::VARCHAR, false, 40);

		$tMap->addColumn('TEST_MULTIPLE', 'TestMultiple', 'int', CreoleTypes::TINYINT, false, 1);

		$tMap->addColumn('TEST_RESTA', 'TestResta', 'int', CreoleTypes::TINYINT, false, 1);

		$tMap->addColumn('NUMERO_RESPUESTAS', 'NumeroRespuestas', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PUBLICADO', 'Publicado', 'int', CreoleTypes::TINYINT, false, 1);

		$tMap->addColumn('SOLUCION', 'Solucion', 'int', CreoleTypes::TINYINT, false, 1);

		$tMap->addColumn('EXPRESIONES_MATEMATICAS', 'ExpresionesMatematicas', 'int', CreoleTypes::TINYINT, false, 1);

		$tMap->addColumn('NUMERO_HOJAS', 'NumeroHojas', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addForeignKey('ID_SOLUCION', 'IdSolucion', 'string', CreoleTypes::BIGINT, 'ejercicio_resuelto', 'ID', false, 10);

	} 
} 