<?php



class OrganizationResearcherKeywordMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.OrganizationResearcherKeywordMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('isern_organization_researcher_keywords');
		$tMap->setPhpName('OrganizationResearcherKeyword');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('ORGANIZATION_ID', 'OrganizationId', 'int', CreoleTypes::INTEGER, 'isern_organizations', 'ID', false, null);

		$tMap->addColumn('KEYWORD', 'Keyword', 'string', CreoleTypes::VARCHAR, false, 50);

	} 
} 