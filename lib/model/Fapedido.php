<?php

/**
 * Subclass for representing a row from the 'fapedido'.
 *
 *
 *
 * @package    Roraima
 * @subpackage lib.model
 * @author     $Author: dmartinez $ <desarrollo@cidesa.com.ve>
 * @version SVN: $Id: Fapedido.php 57537 2014-06-30 18:25:02Z dmartinez $
 * 
 * @copyright  Copyright 2007, Cide S.A.
 * @license    http://opensource.org/licenses/gpl-2.0.php GPLv2
 */
class Fapedido extends BaseFapedido
{
  protected $obj=array();
  protected $objfecped=array();
  protected $entrega="";
  protected $estatus="";
  protected $combo="";
  protected $com="";
  protected $fil="";
  protected $rifpro="";
  protected $nompro="";
  protected $nitcli="";
  protected $telcli="";
  protected $dircli="";
  protected $check="";
  protected $numfilas=1;  
  protected $exeiva=0;
  protected $concre = "";
  protected $incluircliente="N";
  protected $codpai="";
  protected $obj2=array();
  protected $filactrec="";
  protected $totrec="0,00";
  protected $trajo = "";

  public function getEstatus()
  {
    if($this->status=='A') return 'Pedido Activo';
    if($this->status=='N') return 'Pedido Anulado';
  }

  public function getRifpro()
  {
   return Herramientas::getX('CODPRO','Facliente','Rifpro',self::getCodcli());
  }

  public function getNompro()
  {
   return Herramientas::getX('CODPRO','Facliente','Nompro',self::getCodcli());
  }

  public function getNitcli()
  {
   return Herramientas::getX('CODPRO','Facliente','Nitpro',self::getCodcli());
  }

  public function getTelcli()
  {
   return Herramientas::getX('CODPRO','Facliente','Telpro',self::getCodcli());
  }

  public function getDircli()
  {
   return Herramientas::getX('CODPRO','Facliente','Dirpro',self::getCodcli());
  }

public function getNumfilas()
  {

    $dato=1;
    $varemp = sfContext::getInstance()->getUser()->getAttribute('configemp');
    if ($varemp)
	if(array_key_exists('aplicacion',$varemp))
	 if(array_key_exists('facturacion',$varemp['aplicacion']))
	   if(array_key_exists('modulos',$varemp['aplicacion']['facturacion']))
	     if(array_key_exists('fafactur',$varemp['aplicacion']['facturacion']['modulos'])){
	       if(array_key_exists('numfilas',$varemp['aplicacion']['facturacion']['modulos']['fafactur']))
	       {
	       	$dato=$varemp['aplicacion']['facturacion']['modulos']['fafactur']['numfilas'];
}
         }
     return $dato;
  }

  public function setNumfilas()
  {
  	return $this->numfilas;
  }

  public function getCodtipcte(){
    return H::getX('CODPRO', 'Facliente', 'Fatipcte_id', self::getCodcli());
    
  }

  public function getTamañoGrid(){
      return ;
  }

  public function getNomtipcte(){    
    $faclient = $this->getFacliente();
    if($faclient) return $faclient->getFatipcte()->getNomtipcte();
    else return '';
  }

  public function Facturado()
  {
    $c = new Criteria();
    $c->add(FafacturPeer::TIPREF,'P');
    $c->add(FaartfacPeer::CODREF,$this->nroped);
    $c->addJoin(FaartfacPeer::REFFAC,FafacturPeer::REFFAC);
    $count = FaartfacPeer::doSelectOne($c);
    if($count) return true;
    else return false;
  }

  public function FacturadoCon()
  {
    $sql = "select distinct a.reffac, to_char(b.fecfac,'dd/mm/YY') as fecfac from faartfac a inner join fafactur b on a.reffac=b.reffac where codref='".$this->nroped."'";
    if(H::BuscarDatos($sql, $result)){
      $arr = array();
      foreach($result as $facs){
        $arr[] = $facs['reffac'].' el '.$facs['fecfac'];
      }
      $msj = "Pedido facturado con la(s) factura(s) ".implode(", ", $arr);
      return $msj;
    }else return 'Sin Factura Asociada';
  }

  public function getCodpai()
  {
   return OcpaisPeer::doSelectOne(new Criteria());
  }

  public function Despachado()
  {
    $c = new Criteria();
    $c->add(CadphartPeer::REQART,$this->nroped);
    $c->add(CadphartPeer::TIPREF,'P');
    $count = CadphartPeer::doSelectOne($c);
    if($count) return true;
    else return false;
  }  

  public function getDesdirec()
  {
      return H::getX('CODDIREC','cadefdirec','Desdirec',self::getCoddirec());
  }
}
