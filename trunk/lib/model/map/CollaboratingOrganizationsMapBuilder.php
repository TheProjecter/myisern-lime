<?php



class CollaboratingOrganizationsMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.CollaboratingOrganizationsMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('isern_collaborating_organizations');
		$tMap->setPhpName('CollaboratingOrganizations');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('COLLABORATION_ID', 'CollaborationId', 'int', CreoleTypes::INTEGER, 'isern_collaborations', 'ID', false, null);

		$tMap->addForeignKey('ORGANIZATION_ID', 'OrganizationId', 'int', CreoleTypes::INTEGER, 'isern_organizations', 'ID', false, null);

	} 
} 