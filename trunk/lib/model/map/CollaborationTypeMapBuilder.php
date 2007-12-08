<?php



class CollaborationTypeMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.CollaborationTypeMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('isern_collaboration_types');
		$tMap->setPhpName('CollaborationType');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('COLLABORATION_ID', 'CollaborationId', 'int', CreoleTypes::INTEGER, 'isern_collaborations', 'ID', false, null);

		$tMap->addColumn('COLLABORATION_TYPE', 'CollaborationType', 'string', CreoleTypes::VARCHAR, false, 50);

	} 
} 