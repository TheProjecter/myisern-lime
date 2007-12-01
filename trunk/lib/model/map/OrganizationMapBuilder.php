<?php



class OrganizationMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.OrganizationMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('isern_organizations');
		$tMap->setPhpName('Organization');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('ORGANIZATION_TYPE_ID', 'OrganizationTypeId', 'int', CreoleTypes::INTEGER, 'isern_organization_types', 'ID', false, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('COUNTRY', 'Country', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('HOME_PAGE', 'HomePage', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('RESEARCH_KEYWORDS', 'ResearchKeywords', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('RESEARCH_DESCRIPTION', 'ResearchDescription', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 