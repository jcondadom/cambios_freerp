<?php



class FapedidoMapBuilder {

	
	const CLASS_NAME = 'lib.model.facturacion.map.FapedidoMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('fapedido');
		$tMap->setPhpName('Fapedido');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('fapedido_SEQ');

		$tMap->addColumn('NROPED', 'Nroped', 'string', CreoleTypes::VARCHAR, true, 8);

		$tMap->addColumn('FECPED', 'Fecped', 'int', CreoleTypes::DATE, true, null);

		$tMap->addColumn('REFPED', 'Refped', 'string', CreoleTypes::VARCHAR, false, 8);

		$tMap->addColumn('TIPREF', 'Tipref', 'string', CreoleTypes::VARCHAR, true, 2);

		$tMap->addForeignKey('CODCLI', 'Codcli', 'string', CreoleTypes::VARCHAR, 'facliente', 'CODPRO', true, 15);

		$tMap->addColumn('DESPED', 'Desped', 'string', CreoleTypes::VARCHAR, false, 250);

		$tMap->addColumn('MONPED', 'Monped', 'double', CreoleTypes::NUMERIC, false, 14);

		$tMap->addColumn('OBSPED', 'Obsped', 'string', CreoleTypes::VARCHAR, false, 250);

		$tMap->addColumn('REAPOR', 'Reapor', 'string', CreoleTypes::VARCHAR, true, 50);

		$tMap->addColumn('STATUS', 'Status', 'string', CreoleTypes::VARCHAR, false, 1);

		$tMap->addColumn('FECANU', 'Fecanu', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('FECICON', 'Fecicon', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('FECFCON', 'Fecfcon', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CODPRG', 'Codprg', 'string', CreoleTypes::VARCHAR, false, 6);

		$tMap->addColumn('CONPAG_ID', 'ConpagId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('NUMCAR', 'Numcar', 'string', CreoleTypes::VARCHAR, false, 10);

		$tMap->addColumn('NRODON', 'Nrodon', 'string', CreoleTypes::VARCHAR, false, 8);

		$tMap->addForeignKey('CODALMUSU', 'Codalmusu', 'string', CreoleTypes::VARCHAR, 'cadefalm', 'CODALM', false, 6);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CREATED_BY_USER', 'CreatedByUser', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('UPDATED_BY_USER', 'UpdatedByUser', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('FECDES', 'Fecdes', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('FECHAS', 'Fechas', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CODEDO', 'Codedo', 'string', CreoleTypes::VARCHAR, false, 4);

		$tMap->addColumn('CODCIU', 'Codciu', 'string', CreoleTypes::VARCHAR, false, 4);

		$tMap->addColumn('CODMUN', 'Codmun', 'string', CreoleTypes::VARCHAR, false, 4);

		$tMap->addColumn('CODPAR', 'Codpar', 'string', CreoleTypes::VARCHAR, false, 4);

		$tMap->addColumn('CODDIREC', 'Coddirec', 'string', CreoleTypes::VARCHAR, false, 32);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);
		$tMap->addColumn('VENDEDORES_ID', 'VendedoresId', 'int', CreoleTypes::INTEGER, true, null);

	} 
} 
