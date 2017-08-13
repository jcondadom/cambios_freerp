<?php


abstract class BaseFapedido extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $nroped;


	
	protected $fecped;


	
	protected $refped;


	
	protected $tipref;


	
	protected $codcli;


	
	protected $desped;


	
	protected $monped;


	
	protected $obsped;


	
	protected $reapor;


	
	protected $status;


	
	protected $fecanu;


	
	protected $fecicon;


	
	protected $fecfcon;


	
	protected $codprg;


	
	protected $conpag_id;


	
	protected $numcar;


	
	protected $nrodon;


	
	protected $codalmusu;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $created_by_user;


	
	protected $updated_by_user;


	
	protected $fecdes;


	
	protected $fechas;


	
	protected $codedo;


	
	protected $codciu;


	
	protected $codmun;


	
	protected $codpar;


	
	protected $coddirec;

	
	protected $id;


        protected $vendedores_id;

	
	protected $aFacliente;

	
	protected $collFadetants;

	
	protected $lastFadetantCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

  
  public function getNroped()
  {

    return trim($this->nroped);

  }
  
  public function getFecped($format = 'Y-m-d')
  {

    if ($this->fecped === null || $this->fecped === '') {
      return null;
    } elseif (!is_int($this->fecped)) {
            $ts = adodb_strtotime($this->fecped);
      if ($ts === -1 || $ts === false) {         throw new PropelException("Unable to parse value of [fecped] as date/time value: " . var_export($this->fecped, true));
      }
    } else {
      $ts = $this->fecped;
    }
    if ($format === null) {
      return $ts;
    } elseif (strpos($format, '%') !== false) {
      return adodb_strftime($format, $ts);
    } else {
      return @adodb_date($format, $ts);
    }
  }

  
  public function getRefped()
  {

    return trim($this->refped);

  }
  
  public function getTipref()
  {

    return trim($this->tipref);

  }
  
  public function getCodcli()
  {

    return trim($this->codcli);

  }
  
  public function getDesped()
  {

    return trim($this->desped);

  }
  
  public function getMonped($val=false)
  {

    if($val) return number_format($this->monped,2,',','.');
    else return $this->monped;

  }
  
  public function getObsped()
  {

    return trim($this->obsped);

  }
  
  public function getReapor()
  {

    return trim($this->reapor);

  }
  
  public function getStatus()
  {

    return trim($this->status);

  }
  
  public function getFecanu($format = 'Y-m-d')
  {

    if ($this->fecanu === null || $this->fecanu === '') {
      return null;
    } elseif (!is_int($this->fecanu)) {
            $ts = adodb_strtotime($this->fecanu);
      if ($ts === -1 || $ts === false) {         throw new PropelException("Unable to parse value of [fecanu] as date/time value: " . var_export($this->fecanu, true));
      }
    } else {
      $ts = $this->fecanu;
    }
    if ($format === null) {
      return $ts;
    } elseif (strpos($format, '%') !== false) {
      return adodb_strftime($format, $ts);
    } else {
      return @adodb_date($format, $ts);
    }
  }

  
  public function getFecicon($format = 'Y-m-d')
  {

    if ($this->fecicon === null || $this->fecicon === '') {
      return null;
    } elseif (!is_int($this->fecicon)) {
            $ts = adodb_strtotime($this->fecicon);
      if ($ts === -1 || $ts === false) {         throw new PropelException("Unable to parse value of [fecicon] as date/time value: " . var_export($this->fecicon, true));
      }
    } else {
      $ts = $this->fecicon;
    }
    if ($format === null) {
      return $ts;
    } elseif (strpos($format, '%') !== false) {
      return adodb_strftime($format, $ts);
    } else {
      return @adodb_date($format, $ts);
    }
  }

  
  public function getFecfcon($format = 'Y-m-d')
  {

    if ($this->fecfcon === null || $this->fecfcon === '') {
      return null;
    } elseif (!is_int($this->fecfcon)) {
            $ts = adodb_strtotime($this->fecfcon);
      if ($ts === -1 || $ts === false) {         throw new PropelException("Unable to parse value of [fecfcon] as date/time value: " . var_export($this->fecfcon, true));
      }
    } else {
      $ts = $this->fecfcon;
    }
    if ($format === null) {
      return $ts;
    } elseif (strpos($format, '%') !== false) {
      return adodb_strftime($format, $ts);
    } else {
      return @adodb_date($format, $ts);
    }
  }

  
  public function getCodprg()
  {

    return trim($this->codprg);

  }
  
  public function getConpagId()
  {

    return $this->conpag_id;

  }
  
  public function getNumcar()
  {

    return trim($this->numcar);

  }
  
  public function getNrodon()
  {

    return trim($this->nrodon);

  }
  
  public function getCodalmusu()
  {

    return trim($this->codalmusu);

  }
  
  public function getCreatedAt($format = 'Y-m-d H:i:s')
  {

    if ($this->created_at === null || $this->created_at === '') {
      return null;
    } elseif (!is_int($this->created_at)) {
            $ts = adodb_strtotime($this->created_at);
      if ($ts === -1 || $ts === false) {         throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
      }
    } else {
      $ts = $this->created_at;
    }
    if ($format === null) {
      return $ts;
    } elseif (strpos($format, '%') !== false) {
      return adodb_strftime($format, $ts);
    } else {
      return @adodb_date($format, $ts);
    }
  }

  
  public function getUpdatedAt($format = 'Y-m-d H:i:s')
  {

    if ($this->updated_at === null || $this->updated_at === '') {
      return null;
    } elseif (!is_int($this->updated_at)) {
            $ts = adodb_strtotime($this->updated_at);
      if ($ts === -1 || $ts === false) {         throw new PropelException("Unable to parse value of [updated_at] as date/time value: " . var_export($this->updated_at, true));
      }
    } else {
      $ts = $this->updated_at;
    }
    if ($format === null) {
      return $ts;
    } elseif (strpos($format, '%') !== false) {
      return adodb_strftime($format, $ts);
    } else {
      return @adodb_date($format, $ts);
    }
  }

  
  public function getCreatedByUser()
  {

    if($this->created_by_user=='') $this->setCreatedByUser(sfContext::getInstance()->getUser()->getAttribute('loguse'));
    return $this->created_by_user;

  }
  
  public function getUpdatedByUser()
  {

    $this->setUpdatedByUser(sfContext::getInstance()->getUser()->getAttribute('loguse'));
    return $this->updated_by_user;

  }
  
  public function getFecdes($format = 'Y-m-d')
  {

    if ($this->fecdes === null || $this->fecdes === '') {
      return null;
    } elseif (!is_int($this->fecdes)) {
            $ts = adodb_strtotime($this->fecdes);
      if ($ts === -1 || $ts === false) {         throw new PropelException("Unable to parse value of [fecdes] as date/time value: " . var_export($this->fecdes, true));
      }
    } else {
      $ts = $this->fecdes;
    }
    if ($format === null) {
      return $ts;
    } elseif (strpos($format, '%') !== false) {
      return adodb_strftime($format, $ts);
    } else {
      return @adodb_date($format, $ts);
    }
  }

  
  public function getFechas($format = 'Y-m-d')
  {

    if ($this->fechas === null || $this->fechas === '') {
      return null;
    } elseif (!is_int($this->fechas)) {
            $ts = adodb_strtotime($this->fechas);
      if ($ts === -1 || $ts === false) {         throw new PropelException("Unable to parse value of [fechas] as date/time value: " . var_export($this->fechas, true));
      }
    } else {
      $ts = $this->fechas;
    }
    if ($format === null) {
      return $ts;
    } elseif (strpos($format, '%') !== false) {
      return adodb_strftime($format, $ts);
    } else {
      return @adodb_date($format, $ts);
    }
  }

  
  public function getCodedo()
  {

    return trim($this->codedo);

  }
  
  public function getCodciu()
  {

    return trim($this->codciu);

  }
  
  public function getCodmun()
  {

    return trim($this->codmun);

  }
  
  public function getCodpar()
  {

    return trim($this->codpar);

  }
  
  public function getCoddirec()
  {

    return trim($this->coddirec);

  }
 
  public function getId()
  {

    return $this->id;

  }
	
  public function getVendedoresId()
  {

    return $this->vendedores_id;

  } 
	public function setNroped($v)
	{

    if ($this->nroped !== $v) {
        $this->nroped = $v;
        $this->modifiedColumns[] = FapedidoPeer::NROPED;
      }
  
	} 
	
	public function setFecped($v)
	{

    if ($v !== null && !is_int($v)) {
      $ts = adodb_strtotime($v);
      if ($ts === -1 || $ts === false) {         throw new PropelException("Unable to parse date/time value for [fecped] from input: " . var_export($v, true));
      }
    } else {
      $ts = $v;
    }
    if ($this->fecped !== $ts) {
      $this->fecped = $ts;
      $this->modifiedColumns[] = FapedidoPeer::FECPED;
    }

	} 
	
	public function setRefped($v)
	{

    if ($this->refped !== $v) {
        $this->refped = $v;
        $this->modifiedColumns[] = FapedidoPeer::REFPED;
      }
  
	} 
	
	public function setTipref($v)
	{

    if ($this->tipref !== $v) {
        $this->tipref = $v;
        $this->modifiedColumns[] = FapedidoPeer::TIPREF;
      }
  
	} 
	
	public function setCodcli($v)
	{

    if ($this->codcli !== $v) {
        $this->codcli = $v;
        $this->modifiedColumns[] = FapedidoPeer::CODCLI;
      }
  
		if ($this->aFacliente !== null && $this->aFacliente->getCodpro() !== $v) {
			$this->aFacliente = null;
		}

	} 
	
	public function setDesped($v)
	{

    if ($this->desped !== $v) {
        $this->desped = $v;
        $this->modifiedColumns[] = FapedidoPeer::DESPED;
      }
  
	} 
	
	public function setMonped($v)
	{

    if ($this->monped !== $v) {
        $this->monped = Herramientas::toFloat($v);
        $this->modifiedColumns[] = FapedidoPeer::MONPED;
      }
  
	} 
	
	public function setObsped($v)
	{

    if ($this->obsped !== $v) {
        $this->obsped = $v;
        $this->modifiedColumns[] = FapedidoPeer::OBSPED;
      }
  
	} 
	
	public function setReapor($v)
	{

    if ($this->reapor !== $v) {
        $this->reapor = $v;
        $this->modifiedColumns[] = FapedidoPeer::REAPOR;
      }
  
	} 
	
	public function setStatus($v)
	{

    if ($this->status !== $v) {
        $this->status = $v;
        $this->modifiedColumns[] = FapedidoPeer::STATUS;
      }
  
	} 
	
	public function setFecanu($v)
	{

    if ($v !== null && !is_int($v)) {
      $ts = adodb_strtotime($v);
      if ($ts === -1 || $ts === false) {         throw new PropelException("Unable to parse date/time value for [fecanu] from input: " . var_export($v, true));
      }
    } else {
      $ts = $v;
    }
    if ($this->fecanu !== $ts) {
      $this->fecanu = $ts;
      $this->modifiedColumns[] = FapedidoPeer::FECANU;
    }

	} 
	
	public function setFecicon($v)
	{

    if ($v !== null && !is_int($v)) {
      $ts = adodb_strtotime($v);
      if ($ts === -1 || $ts === false) {         throw new PropelException("Unable to parse date/time value for [fecicon] from input: " . var_export($v, true));
      }
    } else {
      $ts = $v;
    }
    if ($this->fecicon !== $ts) {
      $this->fecicon = $ts;
      $this->modifiedColumns[] = FapedidoPeer::FECICON;
    }

	} 
	
	public function setFecfcon($v)
	{

    if ($v !== null && !is_int($v)) {
      $ts = adodb_strtotime($v);
      if ($ts === -1 || $ts === false) {         throw new PropelException("Unable to parse date/time value for [fecfcon] from input: " . var_export($v, true));
      }
    } else {
      $ts = $v;
    }
    if ($this->fecfcon !== $ts) {
      $this->fecfcon = $ts;
      $this->modifiedColumns[] = FapedidoPeer::FECFCON;
    }

	} 
	
	public function setCodprg($v)
	{

    if ($this->codprg !== $v) {
        $this->codprg = $v;
        $this->modifiedColumns[] = FapedidoPeer::CODPRG;
      }
  
	} 
	
	public function setConpagId($v)
	{

    if ($this->conpag_id !== $v) {
        $this->conpag_id = $v;
        $this->modifiedColumns[] = FapedidoPeer::CONPAG_ID;
      }
  
	} 
	
	public function setNumcar($v)
	{

    if ($this->numcar !== $v) {
        $this->numcar = $v;
        $this->modifiedColumns[] = FapedidoPeer::NUMCAR;
      }
  
	} 
	
	public function setNrodon($v)
	{

    if ($this->nrodon !== $v) {
        $this->nrodon = $v;
        $this->modifiedColumns[] = FapedidoPeer::NRODON;
      }
  
	} 
	
	public function setCodalmusu($v)
	{

    if ($this->codalmusu !== $v) {
        $this->codalmusu = $v;
        $this->modifiedColumns[] = FapedidoPeer::CODALMUSU;
      }
  
	} 
	
	public function setCreatedAt($v)
	{

    if ($v !== null && !is_int($v)) {
      $ts = adodb_strtotime($v);
      if ($ts === -1 || $ts === false) {         throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
      }
    } else {
      $ts = $v;
    }
    if ($this->created_at !== $ts) {
      $this->created_at = $ts;
      $this->modifiedColumns[] = FapedidoPeer::CREATED_AT;
    }

	} 
	
	public function setUpdatedAt($v)
	{

    if ($v !== null && !is_int($v)) {
      $ts = adodb_strtotime($v);
      if ($ts === -1 || $ts === false) {         throw new PropelException("Unable to parse date/time value for [updated_at] from input: " . var_export($v, true));
      }
    } else {
      $ts = $v;
    }
    if ($this->updated_at !== $ts) {
      $this->updated_at = $ts;
      $this->modifiedColumns[] = FapedidoPeer::UPDATED_AT;
    }

	} 
	
	public function setCreatedByUser($v)
	{

    if ($this->created_by_user !== $v) {
        $this->created_by_user = $v;
        $this->modifiedColumns[] = FapedidoPeer::CREATED_BY_USER;
      }
  
	} 
	
	public function setUpdatedByUser($v)
	{

    if ($this->updated_by_user !== $v) {
        $this->updated_by_user = $v;
        $this->modifiedColumns[] = FapedidoPeer::UPDATED_BY_USER;
      }
  
	} 
	
	public function setFecdes($v)
	{

    if ($v !== null && !is_int($v)) {
      $ts = adodb_strtotime($v);
      if ($ts === -1 || $ts === false) {         throw new PropelException("Unable to parse date/time value for [fecdes] from input: " . var_export($v, true));
      }
    } else {
      $ts = $v;
    }
    if ($this->fecdes !== $ts) {
      $this->fecdes = $ts;
      $this->modifiedColumns[] = FapedidoPeer::FECDES;
    }

	} 
	
	public function setFechas($v)
	{

    if ($v !== null && !is_int($v)) {
      $ts = adodb_strtotime($v);
      if ($ts === -1 || $ts === false) {         throw new PropelException("Unable to parse date/time value for [fechas] from input: " . var_export($v, true));
      }
    } else {
      $ts = $v;
    }
    if ($this->fechas !== $ts) {
      $this->fechas = $ts;
      $this->modifiedColumns[] = FapedidoPeer::FECHAS;
    }

	} 
	
	public function setCodedo($v)
	{

    if ($this->codedo !== $v) {
        $this->codedo = $v;
        $this->modifiedColumns[] = FapedidoPeer::CODEDO;
      }
  
	} 
	
	public function setCodciu($v)
	{

    if ($this->codciu !== $v) {
        $this->codciu = $v;
        $this->modifiedColumns[] = FapedidoPeer::CODCIU;
      }
  
	} 
	
	public function setCodmun($v)
	{

    if ($this->codmun !== $v) {
        $this->codmun = $v;
        $this->modifiedColumns[] = FapedidoPeer::CODMUN;
      }
  
	} 
	
	public function setCodpar($v)
	{

    if ($this->codpar !== $v) {
        $this->codpar = $v;
        $this->modifiedColumns[] = FapedidoPeer::CODPAR;
      }
  
	} 
	
	public function setCoddirec($v)
	{

    if ($this->coddirec !== $v) {
        $this->coddirec = $v;
        $this->modifiedColumns[] = FapedidoPeer::CODDIREC;
      }
  
	} 

  
	 	
	public function setId($v)
	{

    if ($this->id !== $v) {
        $this->id = $v;
        $this->modifiedColumns[] = FapedidoPeer::ID;
      }
  
	} 
	public function setVendedoresId($v)
	{

    if ($this->vendedores_id !== $v) {
        $this->vendedores_id = $v;
        $this->modifiedColumns[] = FapedidoPeer::VENDEDORES_ID;
      }
	}
  
  public function hydrate(ResultSet $rs, $startcol = 1)
  {
    try {

      $this->nroped = $rs->getString($startcol + 0);

      $this->fecped = $rs->getDate($startcol + 1, null);

      $this->refped = $rs->getString($startcol + 2);

      $this->tipref = $rs->getString($startcol + 3);

      $this->codcli = $rs->getString($startcol + 4);

      $this->desped = $rs->getString($startcol + 5);

      $this->monped = $rs->getFloat($startcol + 6);

      $this->obsped = $rs->getString($startcol + 7);

      $this->reapor = $rs->getString($startcol + 8);

      $this->status = $rs->getString($startcol + 9);

      $this->fecanu = $rs->getDate($startcol + 10, null);

      $this->fecicon = $rs->getDate($startcol + 11, null);

      $this->fecfcon = $rs->getDate($startcol + 12, null);

      $this->codprg = $rs->getString($startcol + 13);

      $this->conpag_id = $rs->getInt($startcol + 14);

      $this->numcar = $rs->getString($startcol + 15);

      $this->nrodon = $rs->getString($startcol + 16);

      $this->codalmusu = $rs->getString($startcol + 17);

      $this->created_at = $rs->getTimestamp($startcol + 18, null);

      $this->updated_at = $rs->getTimestamp($startcol + 19, null);

      $this->created_by_user = $rs->getString($startcol + 20);

      $this->updated_by_user = $rs->getString($startcol + 21);

      $this->fecdes = $rs->getDate($startcol + 22, null);

      $this->fechas = $rs->getDate($startcol + 23, null);

      $this->codedo = $rs->getString($startcol + 24);

      $this->codciu = $rs->getString($startcol + 25);

      $this->codmun = $rs->getString($startcol + 26);

      $this->codpar = $rs->getString($startcol + 27);

      $this->coddirec = $rs->getString($startcol + 28);

      $this->id = $rs->getInt($startcol + 29);

      $this->vendedores_id = $rs->getInt($startcol + 30);

      $this->resetModified();

      $this->setNew(false);

      $this->afterHydrate();

            return $startcol + 31; 
    } catch (Exception $e) {
      throw new PropelException("Error populating Fapedido object", $e);
    }
  }


  protected function afterHydrate()
  {

  }
    
  
  public function __call($m, $a)
    {
      $prefijo = substr($m,0,3);
    $metodo = strtolower(substr($m,3));
        if($prefijo=='get'){
      if(isset($this->$metodo)) return $this->$metodo;
      else return '';
    }elseif($prefijo=='set'){
      if(isset($this->$metodo)) $this->$metodo = $a[0];
    }else call_user_func_array($m, $a);

    }

  
  public function get($m, $a)
    {

      if(method_exists($this,$m)){
        $obj_fk = $this->$m();
        if($obj_fk) return $obj_fk->$a();
      } return '';
    }

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(FapedidoPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			FapedidoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(FapedidoPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(FapedidoPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

    if ($this->isNew() && !$this->isColumnModified(FapedidoPeer::CREATED_BY_USER))
    {
      $this->setCreatedByUser(sfContext::getInstance()->getUser()->getAttribute('loguse','Sin Usuario'));
    }

    if ($this->isModified() && !$this->isColumnModified(FapedidoPeer::UPDATED_BY_USER))
    {
      $this->setUpdatedByUser(sfContext::getInstance()->getUser()->getAttribute('loguse','Sin Usuario'));
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(FapedidoPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


												
			if ($this->aFacliente !== null) {
				if ($this->aFacliente->isModified()) {
					$affectedRows += $this->aFacliente->save($con);
				}
				$this->setFacliente($this->aFacliente);
			}

			if ($this->aTableError !== null) {
				if ($this->aTableError->isModified()) {
					$affectedRows += $this->aTableError->save($con);
				}
				$this->setTableError($this->aTableError);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = FapedidoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += FapedidoPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collFadetants !== null) {
				foreach($this->collFadetants as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


												
			if ($this->aFacliente !== null) {
				if (!$this->aFacliente->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aFacliente->getValidationFailures());
				}
			}

			if ($this->aTableError !== null) {
				if (!$this->aTableError->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTableError->getValidationFailures());
				}
			}


			if (($retval = FapedidoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collFadetants !== null) {
					foreach($this->collFadetants as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FapedidoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getNroped();
				break;
			case 1:
				return $this->getFecped();
				break;
			case 2:
				return $this->getRefped();
				break;
			case 3:
				return $this->getTipref();
				break;
			case 4:
				return $this->getCodcli();
				break;
			case 5:
				return $this->getDesped();
				break;
			case 6:
				return $this->getMonped();
				break;
			case 7:
				return $this->getObsped();
				break;
			case 8:
				return $this->getReapor();
				break;
			case 9:
				return $this->getStatus();
				break;
			case 10:
				return $this->getFecanu();
				break;
			case 11:
				return $this->getFecicon();
				break;
			case 12:
				return $this->getFecfcon();
				break;
			case 13:
				return $this->getCodprg();
				break;
			case 14:
				return $this->getConpagId();
				break;
			case 15:
				return $this->getNumcar();
				break;
			case 16:
				return $this->getNrodon();
				break;
			case 17:
				return $this->getCodalmusu();
				break;
			case 18:
				return $this->getCreatedAt();
				break;
			case 19:
				return $this->getUpdatedAt();
				break;
			case 20:
				return $this->getCreatedByUser();
				break;
			case 21:
				return $this->getUpdatedByUser();
				break;
			case 22:
				return $this->getFecdes();
				break;
			case 23:
				return $this->getFechas();
				break;
			case 24:
				return $this->getCodedo();
				break;
			case 25:
				return $this->getCodciu();
				break;
			case 26:
				return $this->getCodmun();
				break;
			case 27:
				return $this->getCodpar();
				break;
			case 28:
				return $this->getCoddirec();
				break;
			case 29:
				return $this->getId();
				break;
			case 30:
				return $this->getVendedoresId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = FapedidoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getNroped(),
			$keys[1] => $this->getFecped(),
			$keys[2] => $this->getRefped(),
			$keys[3] => $this->getTipref(),
			$keys[4] => $this->getCodcli(),
			$keys[5] => $this->getDesped(),
			$keys[6] => $this->getMonped(),
			$keys[7] => $this->getObsped(),
			$keys[8] => $this->getReapor(),
			$keys[9] => $this->getStatus(),
			$keys[10] => $this->getFecanu(),
			$keys[11] => $this->getFecicon(),
			$keys[12] => $this->getFecfcon(),
			$keys[13] => $this->getCodprg(),
			$keys[14] => $this->getConpagId(),
			$keys[15] => $this->getNumcar(),
			$keys[16] => $this->getNrodon(),
			$keys[17] => $this->getCodalmusu(),
			$keys[18] => $this->getCreatedAt(),
			$keys[19] => $this->getUpdatedAt(),
			$keys[20] => $this->getCreatedByUser(),
			$keys[21] => $this->getUpdatedByUser(),
			$keys[22] => $this->getFecdes(),
			$keys[23] => $this->getFechas(),
			$keys[24] => $this->getCodedo(),
			$keys[25] => $this->getCodciu(),
			$keys[26] => $this->getCodmun(),
			$keys[27] => $this->getCodpar(),
			$keys[28] => $this->getCoddirec(),
			$keys[29] => $this->getId(),
			$keys[30] => $this->getVendedoresId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FapedidoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setNroped($value);
				break;
			case 1:
				$this->setFecped($value);
				break;
			case 2:
				$this->setRefped($value);
				break;
			case 3:
				$this->setTipref($value);
				break;
			case 4:
				$this->setCodcli($value);
				break;
			case 5:
				$this->setDesped($value);
				break;
			case 6:
				$this->setMonped($value);
				break;
			case 7:
				$this->setObsped($value);
				break;
			case 8:
				$this->setReapor($value);
				break;
			case 9:
				$this->setStatus($value);
				break;
			case 10:
				$this->setFecanu($value);
				break;
			case 11:
				$this->setFecicon($value);
				break;
			case 12:
				$this->setFecfcon($value);
				break;
			case 13:
				$this->setCodprg($value);
				break;
			case 14:
				$this->setConpagId($value);
				break;
			case 15:
				$this->setNumcar($value);
				break;
			case 16:
				$this->setNrodon($value);
				break;
			case 17:
				$this->setCodalmusu($value);
				break;
			case 18:
				$this->setCreatedAt($value);
				break;
			case 19:
				$this->setUpdatedAt($value);
				break;
			case 20:
				$this->setCreatedByUser($value);
				break;
			case 21:
				$this->setUpdatedByUser($value);
				break;
			case 22:
				$this->setFecdes($value);
				break;
			case 23:
				$this->setFechas($value);
				break;
			case 24:
				$this->setCodedo($value);
				break;
			case 25:
				$this->setCodciu($value);
				break;
			case 26:
				$this->setCodmun($value);
				break;
			case 27:
				$this->setCodpar($value);
				break;
			case 28:
				$this->setCoddirec($value);
				break;
			case 29:
				$this->setId($value);
				break;
			case 30:
				$this->setVendedoresId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = FapedidoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setNroped($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setFecped($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setRefped($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setTipref($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCodcli($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setDesped($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setMonped($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setObsped($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setReapor($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setStatus($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setFecanu($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setFecicon($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setFecfcon($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCodprg($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setConpagId($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setNumcar($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setNrodon($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCodalmusu($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setCreatedAt($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setUpdatedAt($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setCreatedByUser($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setUpdatedByUser($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setFecdes($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setFechas($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setCodedo($arr[$keys[24]]);
		if (array_key_exists($keys[25], $arr)) $this->setCodciu($arr[$keys[25]]);
		if (array_key_exists($keys[26], $arr)) $this->setCodmun($arr[$keys[26]]);
		if (array_key_exists($keys[27], $arr)) $this->setCodpar($arr[$keys[27]]);
		if (array_key_exists($keys[28], $arr)) $this->setCoddirec($arr[$keys[28]]);
		if (array_key_exists($keys[29], $arr)) $this->setId($arr[$keys[29]]);
		if (array_key_exists($keys[30], $arr)) $this->setVendedoresId($arr[$keys[30]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(FapedidoPeer::DATABASE_NAME);

		if ($this->isColumnModified(FapedidoPeer::NROPED)) $criteria->add(FapedidoPeer::NROPED, $this->nroped);
		if ($this->isColumnModified(FapedidoPeer::FECPED)) $criteria->add(FapedidoPeer::FECPED, $this->fecped);
		if ($this->isColumnModified(FapedidoPeer::REFPED)) $criteria->add(FapedidoPeer::REFPED, $this->refped);
		if ($this->isColumnModified(FapedidoPeer::TIPREF)) $criteria->add(FapedidoPeer::TIPREF, $this->tipref);
		if ($this->isColumnModified(FapedidoPeer::CODCLI)) $criteria->add(FapedidoPeer::CODCLI, $this->codcli);
		if ($this->isColumnModified(FapedidoPeer::DESPED)) $criteria->add(FapedidoPeer::DESPED, $this->desped);
		if ($this->isColumnModified(FapedidoPeer::MONPED)) $criteria->add(FapedidoPeer::MONPED, $this->monped);
		if ($this->isColumnModified(FapedidoPeer::OBSPED)) $criteria->add(FapedidoPeer::OBSPED, $this->obsped);
		if ($this->isColumnModified(FapedidoPeer::REAPOR)) $criteria->add(FapedidoPeer::REAPOR, $this->reapor);
		if ($this->isColumnModified(FapedidoPeer::STATUS)) $criteria->add(FapedidoPeer::STATUS, $this->status);
		if ($this->isColumnModified(FapedidoPeer::FECANU)) $criteria->add(FapedidoPeer::FECANU, $this->fecanu);
		if ($this->isColumnModified(FapedidoPeer::FECICON)) $criteria->add(FapedidoPeer::FECICON, $this->fecicon);
		if ($this->isColumnModified(FapedidoPeer::FECFCON)) $criteria->add(FapedidoPeer::FECFCON, $this->fecfcon);
		if ($this->isColumnModified(FapedidoPeer::CODPRG)) $criteria->add(FapedidoPeer::CODPRG, $this->codprg);
		if ($this->isColumnModified(FapedidoPeer::CONPAG_ID)) $criteria->add(FapedidoPeer::CONPAG_ID, $this->conpag_id);
		if ($this->isColumnModified(FapedidoPeer::NUMCAR)) $criteria->add(FapedidoPeer::NUMCAR, $this->numcar);
		if ($this->isColumnModified(FapedidoPeer::NRODON)) $criteria->add(FapedidoPeer::NRODON, $this->nrodon);
		if ($this->isColumnModified(FapedidoPeer::CODALMUSU)) $criteria->add(FapedidoPeer::CODALMUSU, $this->codalmusu);
		if ($this->isColumnModified(FapedidoPeer::CREATED_AT)) $criteria->add(FapedidoPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(FapedidoPeer::UPDATED_AT)) $criteria->add(FapedidoPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(FapedidoPeer::CREATED_BY_USER)) $criteria->add(FapedidoPeer::CREATED_BY_USER, $this->created_by_user);
		if ($this->isColumnModified(FapedidoPeer::UPDATED_BY_USER)) $criteria->add(FapedidoPeer::UPDATED_BY_USER, $this->updated_by_user);
		if ($this->isColumnModified(FapedidoPeer::FECDES)) $criteria->add(FapedidoPeer::FECDES, $this->fecdes);
		if ($this->isColumnModified(FapedidoPeer::FECHAS)) $criteria->add(FapedidoPeer::FECHAS, $this->fechas);
		if ($this->isColumnModified(FapedidoPeer::CODEDO)) $criteria->add(FapedidoPeer::CODEDO, $this->codedo);
		if ($this->isColumnModified(FapedidoPeer::CODCIU)) $criteria->add(FapedidoPeer::CODCIU, $this->codciu);
		if ($this->isColumnModified(FapedidoPeer::CODMUN)) $criteria->add(FapedidoPeer::CODMUN, $this->codmun);
		if ($this->isColumnModified(FapedidoPeer::CODPAR)) $criteria->add(FapedidoPeer::CODPAR, $this->codpar);
		if ($this->isColumnModified(FapedidoPeer::CODDIREC)) $criteria->add(FapedidoPeer::CODDIREC, $this->coddirec);
		if ($this->isColumnModified(FapedidoPeer::ID)) $criteria->add(FapedidoPeer::ID, $this->id);
		if ($this->isColumnModified(FapedidoPeer::VENDEDORES_ID)) $criteria->add(FapedidoPeer::VENDEDORES_ID, $this->vendedores_id);
		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(FapedidoPeer::DATABASE_NAME);

		$criteria->add(FapedidoPeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setNroped($this->nroped);

		$copyObj->setFecped($this->fecped);

		$copyObj->setRefped($this->refped);

		$copyObj->setTipref($this->tipref);

		$copyObj->setCodcli($this->codcli);

		$copyObj->setDesped($this->desped);

		$copyObj->setMonped($this->monped);

		$copyObj->setObsped($this->obsped);

		$copyObj->setReapor($this->reapor);

		$copyObj->setStatus($this->status);

		$copyObj->setFecanu($this->fecanu);

		$copyObj->setFecicon($this->fecicon);

		$copyObj->setFecfcon($this->fecfcon);

		$copyObj->setCodprg($this->codprg);

		$copyObj->setConpagId($this->conpag_id);

		$copyObj->setNumcar($this->numcar);

		$copyObj->setNrodon($this->nrodon);

		$copyObj->setCodalmusu($this->codalmusu);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setCreatedByUser($this->created_by_user);

		$copyObj->setUpdatedByUser($this->updated_by_user);

		$copyObj->setFecdes($this->fecdes);

		$copyObj->setFechas($this->fechas);

		$copyObj->setCodedo($this->codedo);

		$copyObj->setCodciu($this->codciu);

		$copyObj->setCodmun($this->codmun);

		$copyObj->setCodpar($this->codpar);

		$copyObj->setCoddirec($this->coddirec);

		$copyObj->setVendedoresId($this->vendedores_id);
		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getFadetants() as $relObj) {
				$copyObj->addFadetant($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new FapedidoPeer();
		}
		return self::$peer;
	}

	
	public function setFacliente($v)
	{


		if ($v === null) {
			$this->setCodcli(NULL);
		} else {
			$this->setCodcli($v->getCodpro());
		}


		$this->aFacliente = $v;
	}


	
	public function getFacliente($con = null)
	{
		if ($this->aFacliente === null && (($this->codcli !== "" && $this->codcli !== null))) {
						include_once 'lib/model/facturacion/om/BaseFaclientePeer.php';

      $c = new Criteria();
      $c->add(FaclientePeer::CODPRO,$this->codcli);
      
			$this->aFacliente = FaclientePeer::doSelectOne($c, $con);

			
		}
		return $this->aFacliente;
	}

	
	public function initFadetants()
	{
		if ($this->collFadetants === null) {
			$this->collFadetants = array();
		}
	}

	
	public function getFadetants($criteria = null, $con = null)
	{
				include_once 'lib/model/facturacion/om/BaseFadetantPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFadetants === null) {
			if ($this->isNew()) {
			   $this->collFadetants = array();
			} else {

				$criteria->add(FadetantPeer::NROPED, $this->getNroped());

				FadetantPeer::addSelectColumns($criteria);
				$this->collFadetants = FadetantPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(FadetantPeer::NROPED, $this->getNroped());

				FadetantPeer::addSelectColumns($criteria);
				if (!isset($this->lastFadetantCriteria) || !$this->lastFadetantCriteria->equals($criteria)) {
					$this->collFadetants = FadetantPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFadetantCriteria = $criteria;
		return $this->collFadetants;
	}

	
	public function countFadetants($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/facturacion/om/BaseFadetantPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(FadetantPeer::NROPED, $this->getNroped());

		return FadetantPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addFadetant(Fadetant $l)
	{
		$this->collFadetants[] = $l;
		$l->setFapedido($this);
	}


	
	public function getFadetantsJoinFaantcli($criteria = null, $con = null)
	{
				include_once 'lib/model/facturacion/om/BaseFadetantPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFadetants === null) {
			if ($this->isNew()) {
				$this->collFadetants = array();
			} else {

				$criteria->add(FadetantPeer::NROPED, $this->getNroped());

				$this->collFadetants = FadetantPeer::doSelectJoinFaantcli($criteria, $con);
			}
		} else {
									
			$criteria->add(FadetantPeer::NROPED, $this->getNroped());

			if (!isset($this->lastFadetantCriteria) || !$this->lastFadetantCriteria->equals($criteria)) {
				$this->collFadetants = FadetantPeer::doSelectJoinFaantcli($criteria, $con);
			}
		}
		$this->lastFadetantCriteria = $criteria;

		return $this->collFadetants;
	}

} 
