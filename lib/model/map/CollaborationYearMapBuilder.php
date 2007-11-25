<?php



class CollaborationYearMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.CollaborationYearMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('isern_collaboration_years');
		$tMap->setPhpName('CollaborationYear');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('COLLABORATION_ID', 'CollaborationId', 'int', CreoleTypes::INTEGER, 'isern_collaborations', 'ID', false, null);

		$tMap->addColumn('YEAR', 'Year', 'int', CreoleTypes::INTEGER, false, null);

	} 
} 