<?php



class ResearcherMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ResearcherMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('isern_researchers');
		$tMap->setPhpName('Researcher');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('ORGANIZATION_ID', 'OrganizationId', 'int', CreoleTypes::INTEGER, 'isern_organizations', 'ID', false, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('EMAIL', 'Email', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('PICTURE_LINK', 'PictureLink', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('BIO_STATEMENT', 'BioStatement', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 