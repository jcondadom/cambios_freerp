<?php


abstract class BaseFapedidoPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'fapedido';

	
	const CLASS_DEFAULT = 'lib.model.facturacion.Fapedido';

	
	const NUM_COLUMNS = 30;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const NROPED = 'fapedido.NROPED';

	
	const FECPED = 'fapedido.FECPED';

	
	const REFPED = 'fapedido.REFPED';

	
	const TIPREF = 'fapedido.TIPREF';

	
	const CODCLI = 'fapedido.CODCLI';

	
	const DESPED = 'fapedido.DESPED';

	
	const MONPED = 'fapedido.MONPED';

	
	const OBSPED = 'fapedido.OBSPED';

	
	const REAPOR = 'fapedido.REAPOR';

	
	const STATUS = 'fapedido.STATUS';

	
	const FECANU = 'fapedido.FECANU';

	
	const FECICON = 'fapedido.FECICON';

	
	const FECFCON = 'fapedido.FECFCON';

	
	const CODPRG = 'fapedido.CODPRG';

	
	const CONPAG_ID = 'fapedido.CONPAG_ID';

	
	const NUMCAR = 'fapedido.NUMCAR';

	
	const NRODON = 'fapedido.NRODON';

	
	const CODALMUSU = 'fapedido.CODALMUSU';

	
	const CREATED_AT = 'fapedido.CREATED_AT';

	
	const UPDATED_AT = 'fapedido.UPDATED_AT';

	
	const CREATED_BY_USER = 'fapedido.CREATED_BY_USER';

	
	const UPDATED_BY_USER = 'fapedido.UPDATED_BY_USER';

	
	const FECDES = 'fapedido.FECDES';

	
	const FECHAS = 'fapedido.FECHAS';

	
	const CODEDO = 'fapedido.CODEDO';

	
	const CODCIU = 'fapedido.CODCIU';

	
	const CODMUN = 'fapedido.CODMUN';

	
	const CODPAR = 'fapedido.CODPAR';

	
	const CODDIREC = 'fapedido.CODDIREC';

	const VENDEDORES_ID = 'fapedido.VENDEDORES_ID';	
	const ID = 'fapedido.ID';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Nroped', 'Fecped', 'Refped', 'Tipref', 'Codcli', 'Desped', 'Monped', 'Obsped', 'Reapor', 'Status', 'Fecanu', 'Fecicon', 'Fecfcon', 'Codprg', 'ConpagId', 'Numcar', 'Nrodon', 'Codalmusu', 'CreatedAt', 'UpdatedAt', 'CreatedByUser', 'UpdatedByUser', 'Fecdes', 'Fechas', 'Codedo', 'Codciu', 'Codmun', 'Codpar', 'Coddirec', 'Id','VendedoresId', ),
		BasePeer::TYPE_COLNAME => array (FapedidoPeer::NROPED, FapedidoPeer::FECPED, FapedidoPeer::REFPED, FapedidoPeer::TIPREF, FapedidoPeer::CODCLI, FapedidoPeer::DESPED, FapedidoPeer::MONPED, FapedidoPeer::OBSPED, FapedidoPeer::REAPOR, FapedidoPeer::STATUS, FapedidoPeer::FECANU, FapedidoPeer::FECICON, FapedidoPeer::FECFCON, FapedidoPeer::CODPRG, FapedidoPeer::CONPAG_ID, FapedidoPeer::NUMCAR, FapedidoPeer::NRODON, FapedidoPeer::CODALMUSU, FapedidoPeer::CREATED_AT, FapedidoPeer::UPDATED_AT, FapedidoPeer::CREATED_BY_USER, FapedidoPeer::UPDATED_BY_USER, FapedidoPeer::FECDES, FapedidoPeer::FECHAS, FapedidoPeer::CODEDO, FapedidoPeer::CODCIU, FapedidoPeer::CODMUN, FapedidoPeer::CODPAR, FapedidoPeer::CODDIREC, FapedidoPeer::ID,FapedidoPeer::VENDEDORES_ID, ),
		BasePeer::TYPE_FIELDNAME => array ('nroped', 'fecped', 'refped', 'tipref', 'codcli', 'desped', 'monped', 'obsped', 'reapor', 'status', 'fecanu', 'fecicon', 'fecfcon', 'codprg', 'conpag_id', 'numcar', 'nrodon', 'codalmusu', 'created_at', 'updated_at', 'created_by_user', 'updated_by_user', 'fecdes', 'fechas', 'codedo', 'codciu', 'codmun', 'codpar', 'coddirec', 'id','vendedores_id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29,30, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Nroped' => 0, 'Fecped' => 1, 'Refped' => 2, 'Tipref' => 3, 'Codcli' => 4, 'Desped' => 5, 'Monped' => 6, 'Obsped' => 7, 'Reapor' => 8, 'Status' => 9, 'Fecanu' => 10, 'Fecicon' => 11, 'Fecfcon' => 12, 'Codprg' => 13, 'ConpagId' => 14, 'Numcar' => 15, 'Nrodon' => 16, 'Codalmusu' => 17, 'CreatedAt' => 18, 'UpdatedAt' => 19, 'CreatedByUser' => 20, 'UpdatedByUser' => 21, 'Fecdes' => 22, 'Fechas' => 23, 'Codedo' => 24, 'Codciu' => 25, 'Codmun' => 26, 'Codpar' => 27, 'Coddirec' => 28, 'Id' => 29,'VendedoresId'=>30 ),
		BasePeer::TYPE_COLNAME => array (FapedidoPeer::NROPED => 0, FapedidoPeer::FECPED => 1, FapedidoPeer::REFPED => 2, FapedidoPeer::TIPREF => 3, FapedidoPeer::CODCLI => 4, FapedidoPeer::DESPED => 5, FapedidoPeer::MONPED => 6, FapedidoPeer::OBSPED => 7, FapedidoPeer::REAPOR => 8, FapedidoPeer::STATUS => 9, FapedidoPeer::FECANU => 10, FapedidoPeer::FECICON => 11, FapedidoPeer::FECFCON => 12, FapedidoPeer::CODPRG => 13, FapedidoPeer::CONPAG_ID => 14, FapedidoPeer::NUMCAR => 15, FapedidoPeer::NRODON => 16, FapedidoPeer::CODALMUSU => 17, FapedidoPeer::CREATED_AT => 18, FapedidoPeer::UPDATED_AT => 19, FapedidoPeer::CREATED_BY_USER => 20, FapedidoPeer::UPDATED_BY_USER => 21, FapedidoPeer::FECDES => 22, FapedidoPeer::FECHAS => 23, FapedidoPeer::CODEDO => 24, FapedidoPeer::CODCIU => 25, FapedidoPeer::CODMUN => 26, FapedidoPeer::CODPAR => 27, FapedidoPeer::CODDIREC => 28, FapedidoPeer::ID => 29,FapedidoPeer::VENDEDORES_ID => 30, ),
		BasePeer::TYPE_FIELDNAME => array ('nroped' => 0, 'fecped' => 1, 'refped' => 2, 'tipref' => 3, 'codcli' => 4, 'desped' => 5, 'monped' => 6, 'obsped' => 7, 'reapor' => 8, 'status' => 9, 'fecanu' => 10, 'fecicon' => 11, 'fecfcon' => 12, 'codprg' => 13, 'conpag_id' => 14, 'numcar' => 15, 'nrodon' => 16, 'codalmusu' => 17, 'created_at' => 18, 'updated_at' => 19, 'created_by_user' => 20, 'updated_by_user' => 21, 'fecdes' => 22, 'fechas' => 23, 'codedo' => 24, 'codciu' => 25, 'codmun' => 26, 'codpar' => 27, 'coddirec' => 28, 'id' => 29,'vendedores_id'=>30, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29,30, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/facturacion/map/FapedidoMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.facturacion.map.FapedidoMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = FapedidoPeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
	}
	
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	
	public static function alias($alias, $column)
	{
		return str_replace(FapedidoPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(FapedidoPeer::NROPED);

		$criteria->addSelectColumn(FapedidoPeer::FECPED);

		$criteria->addSelectColumn(FapedidoPeer::REFPED);

		$criteria->addSelectColumn(FapedidoPeer::TIPREF);

		$criteria->addSelectColumn(FapedidoPeer::CODCLI);

		$criteria->addSelectColumn(FapedidoPeer::DESPED);

		$criteria->addSelectColumn(FapedidoPeer::MONPED);

		$criteria->addSelectColumn(FapedidoPeer::OBSPED);

		$criteria->addSelectColumn(FapedidoPeer::REAPOR);

		$criteria->addSelectColumn(FapedidoPeer::STATUS);

		$criteria->addSelectColumn(FapedidoPeer::FECANU);

		$criteria->addSelectColumn(FapedidoPeer::FECICON);

		$criteria->addSelectColumn(FapedidoPeer::FECFCON);

		$criteria->addSelectColumn(FapedidoPeer::CODPRG);

		$criteria->addSelectColumn(FapedidoPeer::CONPAG_ID);

		$criteria->addSelectColumn(FapedidoPeer::NUMCAR);

		$criteria->addSelectColumn(FapedidoPeer::NRODON);

		$criteria->addSelectColumn(FapedidoPeer::CODALMUSU);

		$criteria->addSelectColumn(FapedidoPeer::CREATED_AT);

		$criteria->addSelectColumn(FapedidoPeer::UPDATED_AT);

		$criteria->addSelectColumn(FapedidoPeer::CREATED_BY_USER);

		$criteria->addSelectColumn(FapedidoPeer::UPDATED_BY_USER);

		$criteria->addSelectColumn(FapedidoPeer::FECDES);

		$criteria->addSelectColumn(FapedidoPeer::FECHAS);

		$criteria->addSelectColumn(FapedidoPeer::CODEDO);

		$criteria->addSelectColumn(FapedidoPeer::CODCIU);

		$criteria->addSelectColumn(FapedidoPeer::CODMUN);

		$criteria->addSelectColumn(FapedidoPeer::CODPAR);

		$criteria->addSelectColumn(FapedidoPeer::CODDIREC);

		$criteria->addSelectColumn(FapedidoPeer::ID);
		$criteria->addSelectColumn(FapedidoPeer::VENDEDORES_ID);

	}

	const COUNT = 'COUNT(fapedido.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT fapedido.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FapedidoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FapedidoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = FapedidoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}
	
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = FapedidoPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return FapedidoPeer::populateObjects(FapedidoPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			FapedidoPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = FapedidoPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinFacliente(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FapedidoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FapedidoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FapedidoPeer::CODCLI, FaclientePeer::CODPRO);

		$rs = FapedidoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinFacliente(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FapedidoPeer::addSelectColumns($c);
		$startcol = (FapedidoPeer::NUM_COLUMNS - FapedidoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		FaclientePeer::addSelectColumns($c);

		$c->addJoin(FapedidoPeer::CODCLI, FaclientePeer::CODPRO);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FapedidoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = FaclientePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getFacliente(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addFapedido($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initFapedidos();
				$obj2->addFapedido($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FapedidoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FapedidoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

			$criteria->addJoin(FapedidoPeer::CODCLI, FaclientePeer::CODPRO);
	
		$rs = FapedidoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FapedidoPeer::addSelectColumns($c);
		$startcol2 = (FapedidoPeer::NUM_COLUMNS - FapedidoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

			FaclientePeer::addSelectColumns($c);
			$startcol3 = $startcol2 + FaclientePeer::NUM_COLUMNS;
	
			$c->addJoin(FapedidoPeer::CODCLI, FaclientePeer::CODPRO);
	
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FapedidoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


							
				$omClass = FaclientePeer::getOMClass();
	

				$cls = Propel::import($omClass);
				$obj2 = new $cls();
				$obj2->hydrate($rs, $startcol2);

				$newObject = true;
				for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
					$temp_obj1 = $results[$j];
					$temp_obj2 = $temp_obj1->getFacliente(); 					if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
						$newObject = false;
						$temp_obj2->addFapedido($obj1); 						break;
					}
				}

				if ($newObject) {
					$obj2->initFapedidos();
					$obj2->addFapedido($obj1);
				}
	
			$results[] = $obj1;
		}
		return $results;
	}


		
		public static function doCountJoinAllExceptFacliente(Criteria $criteria, $distinct = false, $con = null)
		{
						$criteria = clone $criteria;

						$criteria->clearSelectColumns()->clearOrderByColumns();
			if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
				$criteria->addSelectColumn(FapedidoPeer::COUNT_DISTINCT);
			} else {
				$criteria->addSelectColumn(FapedidoPeer::COUNT);
			}

						foreach($criteria->getGroupByColumns() as $column)
			{
				$criteria->addSelectColumn($column);
			}
	
			$rs = FapedidoPeer::doSelectRS($criteria, $con);
			if ($rs->next()) {
				return $rs->getInt(1);
			} else {
								return 0;
			}
		}
	

	
	public static function doSelectJoinAllExceptFacliente(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FapedidoPeer::addSelectColumns($c);
		$startcol2 = (FapedidoPeer::NUM_COLUMNS - FapedidoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FapedidoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$results[] = $obj1;
		}
		return $results;
	}

	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return FapedidoPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(FapedidoPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(FapedidoPeer::ID);
			$selectCriteria->add(FapedidoPeer::ID, $criteria->remove(FapedidoPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; 		try {
									$con->begin();
			$affectedRows += BasePeer::doDeleteAll(FapedidoPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(FapedidoPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Fapedido) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(FapedidoPeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public static function doValidate(Fapedido $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(FapedidoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(FapedidoPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(FapedidoPeer::DATABASE_NAME, FapedidoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = FapedidoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(FapedidoPeer::DATABASE_NAME);

		$criteria->add(FapedidoPeer::ID, $pk);


		$v = FapedidoPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(FapedidoPeer::ID, $pks, Criteria::IN);
			$objs = FapedidoPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseFapedidoPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/facturacion/map/FapedidoMapBuilder.php';
	Propel::registerMapBuilder('lib.model.facturacion.map.FapedidoMapBuilder');
}
