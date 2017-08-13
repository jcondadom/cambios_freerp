<?php

/**
 * fapedido actions.
 *
 * @package    Roraima
 * @subpackage fapedido
 * @author     $Author: dmartinez $ <desarrollo@cidesa.com.ve>
 * @version SVN: $Id: actions.class.php 45339 2011-07-28 16:09:50Z dmartinez $
 * 
 * @copyright  Copyright 2007, Cide S.A.
 * @license    http://opensource.org/licenses/gpl-2.0.php GPLv2
 */
class fapedidoActions extends autofapedidoActions
{
  private $coderror=-1;
  private $coderror1=-1;
  private $coderror2=-1;
  private $coderror3=-1;
  private $coderror4=-1;
  private $coderror5=-1;
  private $coderror6=-1;
  private $coderror7=-1;
  private $coderror8=-1;

  /**
   * Función para colocar el codigo necesario en  
   * el proceso de edición.
   * Aquí se pueden buscar datos adicionales que necesite la vista
   * Esta función es parte de la acción executeEdit, que maneja tanto
   * el create como el edit del formulario.
   * Generalmente aqui se debe y puede colocar los llamados a los configGrid
   * Para generar la información de configuración de los grids.
   *
   */
  public function editing()
  {
  	/*if ($this->fapedido->getId()=="")
  	{$c= new Criteria();
  	$reg=FacorrelatPeer::doSelectOne($c);
  	if ($reg)
  	{
  		$numero=str_pad($reg->getCorped(), 8, '0', STR_PAD_LEFT);
  	}else { $numero="";}

  	$this->fapedido->setNroped($numero);
  	}*/
  	$entrega=Facturacion::entregas($this->fapedido->getNroped());
  	$this->fapedido->setEntrega($entrega);
  	if ($this->fapedido->getId()!="")
  	{
  	  if ($this->fapedido->getStatus()=='N')
  	  {
  	  	$fecha=date('d/m/Y',strtotime($this->fapedido->getFecanu()));
  	  	$this->fapedido->setEstatus('Anulado el'.$fecha);
  	  }	else $this->fapedido->setEstatus('');
  	}else {
       $this->fapedido->setEstatus('');
       $filsoldir=H::getConfApp2('filsoldir', 'compras', 'almsolegr');
       if ($filsoldir=='S'){
         $loguse= sfContext::getInstance()->getUser()->getAttribute('loguse');
         $t= new Criteria();
         $t->add(SegdirusuPeer::LOGUSE,$loguse);
         $t->setLimit(1);
         $t->addAscendingOrderByColumn(SegdirusuPeer::CODDIREC);
         $regt= SegdirusuPeer::doSelectOne($t); 
         if ($regt){
          if ($this->fapedido->getCoddirec()=='')
            $this->fapedido->setCoddirec($regt->getCoddirec());
         }          
       }
    }
  	$this->fapedido->setReapor($this->getUser()->getAttribute('loguse'));
  	$this->setVars();
	$this->configGrid();
  }

  /**
   * Esta función permite definir la configuración del grid de datos
   * que contiene el formulario. Esta función debe ser llamada
   * en las acciones, create, edit y handleError para recargar en todo momento
   * los datos del grid.
   *
   */
  public function configGrid()
  {
    $this->configGridArtPed($this->fapedido->getNroped(),$this->getRequestParameter('fapedido[refped]'),$this->getRequestParameter('fapedido[combo]'));
    $this->configGridFecPed($this->fapedido->getNroped());
     $this->configGridRgoArt($this->fapedido->getNroped());
  }

  /**
   * Esta función permite definir la configuración del grid de datos
   * que contiene el formulario. Esta función debe ser llamada
   * en las acciones, create, edit y handleError para recargar en todo momento
   * los datos del grid.
   *
   */
  public function configGridArtPed($nroped='', $refpre='', $combo='')
  {
  	if ($refpre!='')
  	{
  	  $c = new Criteria();
  	  $c->add(FadetprePeer::REFPRE,$refpre);
  	  $artped = FadetprePeer::doSelect($c);
  	}else if ($combo!="")
  	{
      $c = new Criteria();
  	  $c->add(FaartcomPeer::CODCOM,$combo);
  	  $artped = FaartcomPeer::doSelect($c);
  	}
  	else
  	{
  	  $c = new Criteria();
  	  $c->add(FaartpedPeer::NROPED,$nroped);
  	  $artped = FaartpedPeer::doSelect($c);
  	}
  	$this->fil1=count($artped);

  	$mascara=$this->mascaraarticulo;
  	$lonarti=$this->lonart;

    $this->columnas = Herramientas::getConfigGrid(sfConfig::get('sf_app_module_dir').'/fapedido/'.sfConfig::get('sf_app_module_config_dir_name').'/grid_faartped');
    if ($refpre!='')
    {
    $this->columnas[0]->setTabla('Fadetpre');
    $this->columnas[1][10]->setNombrecampo('totart2');
    }
    else if ($combo!='')
    $this->columnas[0]->setTabla('Faartcom');
    else $this->columnas[0]->setTabla('Faartped');

    $this->columnas[0]->setEliminar(true,'eliminarfechas(this.id)');

    $obj= array('codart' => 1, 'desart' => 2);
    $params= array('param1' => $lonarti, 'val2');
    //$this->columnas[0]->setFilas($this->fapedido->getNumfilas());
    $this->columnas[1][0]->setHTML('type="text" size="17" maxlength="'.chr(39).$lonarti.chr(39).'" onKeyDown="javascript:return dFilter (event.keyCode, this,'.chr(39).$mascara.chr(39).')" onKeyPress="javascript:cadena=rayaenter(event,this.value);if (event.keyCode==13 || event.keyCode==9){document.getElementById(this.id).value=cadena;} perderfocus(event,this.id,8);" onBlur="javascript:event.keyCode=13; ajaxarticulos(event,this.id);"');
    $this->columnas[1][0]->setCatalogo('caregart','sf_admin_edit_form',$obj,'Caregart_Fapedido',$params);
    $this->columnas[1][2]->setHTML(' size="10" onBlur="ValidarMontoGridv2(this); Cantidad(this.id);"');
    $this->columnas[1][6]->setCombo(FaartpvpPeer::getPrecios());
    $this->columnas[1][6]->setHTML('onChange=Precio(this.id);');
    $this->columnas[1][7]->setHTML('size="10" readonly=true onBlur="ValidarMontoGridv2(this); Preciocaja(this.id);"');
    //$this->columnas[1][10]->setEsTotal(true,'fapedido_monped');
    
    $oculfildet=H::getConfApp2('oculfildet', 'facturacion', 'fapedido');
    if ($oculfildet=='S')
    {
        $this->columnas[1][6]->setOculta(true);
        $this->columnas[1][7]->setHTML('size="10" onBlur="ValidarMontoGridv2(this); Preciocaja(this.id);"');
        $this->columnas[1][8]->setOculta(true);
        $this->columnas[1][9]->setOculta(true);
        $this->columnas[1][12]->setOculta(false);
    }

    $this->columnas[1][11]->setHTML('onClick="marcarrecarg(this.id)"');
    $this->columnas[1][12]->setHTML('type="text" size="1" style="border:none" class="imagenalmacen" onClick=mostrargridrecargosPed(this.id);'); //Aplicarecargos

    $this->obj =$this->columnas[0]->getConfig($artped);

    $this->fapedido->setObj($this->obj);
  }

  /**
   * Esta función permite definir la configuración del grid de datos
   * que contiene el formulario. Esta función debe ser llamada
   * en las acciones, create, edit y handleError para recargar en todo momento
   * los datos del grid.
   *
   */
  public function configGridFecPed($nroped='')
  {
  	$c = new Criteria();
  	$c->add(FafecpedPeer::NROPED,$nroped);
  	$fecped = FafecpedPeer::doSelect($c);

    $this->columnas=Herramientas::getConfigGrid(sfConfig::get('sf_app_module_dir').'/fapedido/'.sfConfig::get('sf_app_module_config_dir_name').'/grid_fafecped');
    $this->objfecped = $this->columnas[0]->getConfig($fecped);

    $this->fapedido->setObjfecped($this->objfecped);
  }

  /**
   * Esta función permite definir la configuración del grid de datos
   * que contiene el formulario. Esta función debe ser llamada
   * en las acciones, create, edit y handleError para recargar en todo momento
   * los datos del grid.
   *
   */
  public function configGridRgoArt($nroped = '', $codart='') {
    $c = new Criteria();   
    $c->add(FargopedPeer :: REFDOC, $nroped);
    $c->add(FargopedPeer :: CODART, $codart);            
    $rgoart = FargopedPeer :: doSelect($c);                   

    $this->columnas = Herramientas :: getConfigGrid(sfConfig :: get('sf_app_module_dir') . '/fapedido/' . sfConfig :: get('sf_app_module_config_dir_name') . '/grid_fargoped');

    $this->columnas[1][0]->setHTML('onBlur="javascript:event.keyCode=13; ajaxrecargosPed(event,this.id);"');
    $this->columnas[1][3]->setHTML('onKeyPress=CalculoMontoRgoPed(event,this.id);');
    $this->obj2 = $this->columnas[0]->getConfig($rgoart);

    $this->fapedido->setObj2($this->obj2);
  }  


  /**
   * Función para procesar _todas_ las funciones Ajax del formulario
   * Cada función esta identificada con el valor de la vista "ajax"
   * el cual traerá el indice de lo que se quiere procesar.
   *
   */
  public function executeAjax()
  {

    $codigo = $this->getRequestParameter('codigo','');
    $ajax = $this->getRequestParameter('ajax','');
    $cajtexmos = $this->getRequestParameter('cajtexmos','');
    $cajtexcom = $this->getRequestParameter('cajtexcom','');
    $javascript="";

    switch ($ajax){
      case '2':
       $codcli=""; $rifcli= ""; $nomcli= ""; $nitcli= ""; $dircli= ""; $telcli= ""; $javascript="";
       if ($codigo!="")
       {
         $c= new Criteria();
         $c->add(FaclientePeer::RIFPRO,$codigo);
         $reg= FaclientePeer::doSelectOne($c);
         if ($reg)
         {
           $this->sql="CODREC NOT IN (SELECT CODREC FROM FARECPRO WHERE CODPRO='".$reg->getCodpro()."')";
           $a= new Criteria();
           $a->add(CarecaudPeer::LIMREC,'S');
           $a->add(CarecaudPeer::CODTIPREC,$reg->getCodtiprec());
           $a->add(CarecaudPeer::CODREC,$this->sql,Criteria::CUSTOM);
           $regi= CarecaudPeer::doSelectOne($a);
           if (!$regi)
           {
             $codcli=$reg->getCodpro();
             $rifcli=$reg->getRifpro();
             $nomcli=$reg->getNompro();
             $nitcli=$reg->getNitpro();
             $dircli=$reg->getDirpro();
             $telcli=$reg->getTelpro();
             if ($reg->getCodcta()=="")
             {
             	$javascript="alert('El Cliente no posee Cuenta Contable asociada');";
             }
           }
           else
           {
           	$javascript="alert('El Cliente no ha consignado todos los recaudos limitantes');$('fapedido_rifpro').value='';";
           }
         }
         else
         {
         	$javascript="alert('El Cliente no existe'); $('fapedido_rifpro').value='';";
         }
       }
        $output = '[["fapedido_codcli","'.$codcli.'",""],["fapedido_rifpro","'.$rifcli.'",""],["fapedido_nompro","'.$nomcli.'",""],["fapedido_nitcli","'.$nitcli.'",""],["fapedido_dircli","'.$dircli.'",""],["fapedido_telcli","'.$telcli.'",""],["javascript","'.$javascript.'",""]]';
        $this->getResponse()->setHttpHeader("X-JSON", '('.$output.')');
        return sfView::HEADER_ONLY;
       break;
      case '3':
        $c= new Criteria();
		    $c->add(CaregartPeer::CODART,$this->getRequestParameter('codigo'));
      	$reg=CaregartPeer::doSelectOne($c);
    		if ($reg)
    		{
	        $dato=$reg->getDesart();
	        $porcrgo=0;
          $cad="";
          $com="";
  		    $c= new Criteria();
  		    $c->add(FarecargPeer::TIPRGO,'P');
  		    $this->sql = "codrgo in (select codrgo from farecart where codart = '".$reg->getCodart()."')";
  			  $c->add(FarecargPeer::CODRGO,$this->sql,Criteria :: CUSTOM);
  		    $reg=FarecargPeer::doSelect($c);
  			  if ($reg){
  			   foreach ($reg as $sum)
  			   {
  			     $porcrgo += $sum->getMonrgo();
             $monrgoq=H::FormatoMonto($porcrgo);
             $monrgow=H::FormatoMonto($sum->getMonrgo());
             if ($sum->getCalcul()=='S') $recfij="Si"; else $recfij="No";
             $cad=$sum->getCodrgo().'_'.$sum->getNomrgo().'_'.$recfij.'_' .$monrgoq.'_'.$sum->getCodcta().'_'.$sum->getTiprgo().'_'.$monrgow.'!';
  			   }
  			  }
  		    $porrgo=number_format($porcrgo,2,',','.');
          if ($this->getRequestParameter('datrec')=="") {
            $com=',["'.$this->getRequestParameter('datrec2').'","'.$cad.'",""]';
          }

          $javascript.="llenargridfechas('$cajtexmos');";

  	        $output = '[["'.$cajtexmos.'","'.$dato.'",""],["'.$this->getRequestParameter('porrgo').'","'.$porrgo.'",""],["javascript","'.$javascript.'",""]'.$com.']';
    		}
    		else
    		{
    			 $javascript="alert('Articulo no existe');$('". $cajtexmos ."').value='';$('". $cajtexcom ."').value='';";
          	 $output = '[["javascript","'.$javascript.'",""]]';
    		}
        $this->getResponse()->setHttpHeader("X-JSON", '('.$output.')');
        return sfView::HEADER_ONLY;
       break;
      case '4':
         $this->ajaxs='';
         $this->combo='';
         $this->fapedido = $this->getFapedidoOrCreate();
         $c= new Criteria();
         $c->add(FapedidoPeer::REFPED,$this->getRequestParameter('codigo'));
         $data= FapedidoPeer::doSelectOne($c);
         if (!$data)
         {
           if ($this->getRequestParameter('docref')=='PR')
           {
             $a= new Criteria();
             $a->add(FapresupPeer::REFPRE,$this->getRequestParameter('codigo'));
             $reg= FapresupPeer::doSelectOne($a);
             if ($reg)
             {
               $codcli=$reg->getCodcli();
               $desped=$reg->getDespre();
               $d= new Criteria();
               $d->add(FaclientePeer::CODPRO,$codcli);
               $regi= FaclientePeer::doSelectOne($d);
               if ($regi)
               {
                 $rifcli= $regi->getRifpro();
                 $nomcli= $regi->getNompro();
                 $nitcli= $regi->getNitpro();
                 $dircli= $regi->getDirpro();
                 $telcli= $regi->getTelpro();
                 $cuenta_contable= $regi->getCodcta();
                 $javascript="$('fapedido_rifpro').readonly=true; $$('.botoncat')[1].disabled=true;";
                 if ($cuenta_contable=="")
                 {
                 	$javascript= $javascript."alert('El Cliente no posee Cuenta Contable asociada');";
                 }
                 $this->configGridArtPed('',$reg->getRefpre(),'');
               }
               else
               {
               	 $rifcli= "";
                 $nomcli= "";
                 $nitcli= "";
                 $dircli= "";
                 $telcli= "";
                 $cuenta_contable="";
                 $javascript="";
               }
             }
             else
             {
               $codcli=""; $desped=""; $rifcli= ""; $nomcli= ""; $nitcli= ""; $dircli= ""; $telcli= "";
               $cuenta_contable="";
               $this->configGridArtPed();
               $javascript="alert('El Presupuesto no se encuentra Registrado'); $('fapedido_refped').value=''";
             }
           }
         }
         else
         {
         	$codcli=""; $desped=""; $rifcli= ""; $nomcli= ""; $nitcli= ""; $dircli= ""; $telcli= "";
            $cuenta_contable="";
            $this->configGridArtPed();
         	$javascript="alert('El Presupuesto ya posee un Pedido'); $('fapedido_refped').value=''";
         }

        $output = '[["fapedido_codcli","'.$codcli.'",""],["fapedido_rifpro","'.$rifcli.'",""],["fapedido_nompro","'.$nomcli.'",""],["fapedido_nitcli","'.$nitcli.'",""],["fapedido_dircli","'.$dircli.'",""],["fapedido_telcli","'.$telcli.'",""],["fapedido_desped","'.$desped.'",""],["fapedido_com","'.$this->combo.'",""],["fapedido_fil","'.$this->fil1.'",""],["javascript","'.$javascript.'",""]]';
        $this->getResponse()->setHttpHeader("X-JSON", '('.$output.')');
        break;
      case '5':
        $this->ajaxs='5';
        $this->precios=array();
        $javascript = "";
        $precioe=$this->getRequestParameter('precioe');
        $fecemi=$this->getRequestParameter('fecemi');
        $dateFormat = new sfDateFormat('es_VE');
        $fec = $dateFormat->format($fecemi, 'i', $dateFormat->getInputPattern('d'));
        $this->precios=FaartpvpPeer::getPrecios($codigo,$fec);
        if (count($this->precios)==0)
		{
		  $javascript=$javascript."$('$precioe').readOnly=false;";
		}
		$output = '[["javascript","' . $javascript . '",""]]';
		$this->getResponse()->setHttpHeader("X-JSON", '(' . $output . ')');
       break;
      case '6':
        $dateFormat = new sfDateFormat('es_VE');
	    $fecha = $dateFormat->format($this->getRequestParameter('codigo'), 'i', $dateFormat->getInputPattern('d'));

	    $c= new Criteria();
	    $c->add(FapedidoPeer::NROPED,$this->getRequestParameter('nroped'));
	    $data=FapedidoPeer::doSelectOne($c);
	    if ($data)
	    {
	      if ($fecha<$data->getFecped())
	      {
	      	$msj="alert_('La Fecha de Anulaci&oacute;n no puede ser menor a la fecha del Pedido'); $('fapedido_fecanu').value=''";
	      }
	      else { $msj=""; }	    }
	    else  { $msj=""; }
	    $output = '[["javascript","'.$msj.'",""]]';
	    $this->getResponse()->setHttpHeader("X-JSON", '('.$output.')');
	    return sfView::HEADER_ONLY;
       break;
      case '7':
        $this->ajaxs='';
        $this->combo='1';
        $msj="";
        $this->fapedido = $this->getFapedidoOrCreate();
        $this->configGridArtPed('','',$this->getRequestParameter('codcom'));
        $output = '[["fapedido_com","'.$this->combo.'",""],["fapedido_fil","'.$this->fil1.'",""],["javascript","'.$msj.'",""]]';
	    $this->getResponse()->setHttpHeader("X-JSON", '('.$output.')');
       break;
      case '8':
       $this->fapedido = $this->getFapedidoOrCreate();
       $this->ajaxs='8';
       $this->fapedido->setCodpai($this->getRequestParameter('pais'));
       $this->fapedido->setCodedo($codigo);
       break;
      case '9':
       $this->fapedido = $this->getFapedidoOrCreate();
       $this->ajaxs='9';
       $this->fapedido->setCodpai($this->getRequestParameter('pais'));
       $this->fapedido->setCodedo($this->getRequestParameter('estado'));
       $this->fapedido->setCodciu($codigo);
       break;
      case '10':
       $this->fapedido = $this->getFapedidoOrCreate();
       $this->ajaxs='10';
       $this->fapedido->setCodpai($this->getRequestParameter('pais'));
       $this->fapedido->setCodedo($this->getRequestParameter('estado'));
       $this->fapedido->setCodmun($codigo);
       break;
      case '11':
      $js="";
        $r=new Criteria();
        $r->add(FadefprgPeer::CODPRG,$codigo);
        $reg= FadefprgPeer::doSelectOne($r);
        if ($reg)
        {
          if ($reg->getEspae()=='S')
            $js="$('datospae').show()";
          else
            $js="$('datospae').hide()";
        }
        $output = '[["javascript","'.$js.'",""]]';
        $this->getResponse()->setHttpHeader("X-JSON", '('.$output.')');
        return sfView::HEADER_ONLY;
       break;
       case '12' :
        $this->ajaxs = '12';
        $this->fapedido = $this->getFapedidoOrCreate();
        $nroped=$this->getRequestParameter('nroped');
        $codart=$this->getRequestParameter('codart');
        $this->configGridRgoArt($nroped, $codart);
        $output = '[["","",""],["","",""],["","",""]]';
        $this->getResponse()->setHttpHeader("X-JSON", '(' . $output . ')');
        break;             
      case '13' :
        $cajtexmos = $this->getRequestParameter('cajtexmos');
        $recfij = $this->getRequestParameter('recfij');
        $monto = $this->getRequestParameter('monto');
        $cta = $this->getRequestParameter('cta');
        $tipo = $this->getRequestParameter('tipo');
        $monto2 = $this->getRequestParameter('monto2');
        $montota = $this->getRequestParameter('montot');
        $montot1 = $this->getRequestParameter('montot1');
        $valmonto = $this->getRequestParameter('valmonto');

        $c = new Criteria();
        $c->add(FarecargPeer :: CODRGO, $codigo);
        $resul = FarecargPeer :: doSelectOne($c);
        if ($resul) {
          $dato = $resul->getNomrgo();
          $dato1 = $resul->getCodcta();
          if ($resul->getCalcul() == 'S') {
            $dato2 = "Si";
            $montot = $montota;
          } else {
            $dato2 = "No";
            $montot = $montot1;
          }

          if ($resul->getTiprgo() == 'M') {
            if ($valmonto != "") {
              $dato3 = $valmonto;
            } else {
              $dato3 = number_format($resul->getMonrgo(), 2, ',', '.');
            }
          } else {
            if ($resul->getTiprgo() == 'P') {
              $cuenta = (($montot * $resul->getMonrgo()) / 100);
              $dato3 = number_format($cuenta, 2, ',', '.');
            } else {
              $dato3 = "0,00";
            }
          }
          $dato4 = $resul->getTiprgo();
          $dato5 = $resul->getMonrgo();
          $javascript = "calcularTotalRecargosPed();";
        } else {
          $dato = "";
          $dato1 = "";
          $dato2 = "";
          $dato3 = "";
          $dato4 = "";
          $dato5 = "";
          $javascript = "alert('El Recargo no existe'); $('$codigo').value=''; calcularTotalRecargosPed();";
        }
        $output = '[["' . $cajtexmos . '","' . $dato . '",""],["' . $recfij . '","' . $dato2 . '",""],["' . $monto . '","' . $dato3 . '",""],["' . $cta . '","' . $dato1 . '",""],["' . $tipo . '","' . $dato4 . '",""],["' . $monto2 . '","' . $dato5 . '",""],["javascript","' . $javascript . '",""]]';
        $this->getResponse()->setHttpHeader("X-JSON", '(' . $output . ')');
        return sfView :: HEADER_ONLY;
        break;             
      case '14' :
        $c = new Criteria();
        $c->add(FasinrgoPeer :: CODART, $this->getRequestParameter('articulo'));
        $c->add(FasinrgoPeer :: CODRGO, $this->getRequestParameter('recargo'));
        $resul = FasinrgoPeer :: doSelectOne($c);
        if ($resul) {
          $javascript = "$('fapedido_trajo').value='S'";
        } else
          $javascript = "$('fapedido_trajo').value='N'";

        $output = '[["javascript","' . $javascript . '",""]]';
        $this->getResponse()->setHttpHeader("X-JSON", '(' . $output . ')');
        return sfView :: HEADER_ONLY;
        break;
      case '15':
        $dato="";
        $loguse= sfContext::getInstance()->getUser()->getAttribute('loguse');
        $filsoldir=H::getConfApp2('filsoldir', 'compras', 'almsolegr');
        $q= new Criteria();
        if ($filsoldir=='S'){
          $sql='cadefdirec.coddirec=\''.$codigo.'\' and cadefdirec.coddirec in (select coddirec from "SIMA_USER".segdirusu where loguse=\''.$loguse.'\')';
          $q->add(CadefdirecPeer::CODDIREC,$sql,Criteria::CUSTOM); 
        }else $q->add(CadefdirecPeer::CODDIREC,$codigo);
        $reg= CadefdirecPeer::doSelectOne($q);
        if ($reg)
        {
           $dato=$reg->getDesdirec();                    
        }else {
           $javascript="alert_('La Direcci&oacute;n no existe'); $('fapedido_coddirec').value=''; $('fapedido_desdirec').value=''; $('fapedido_coddirec').focus();";
        }
        $output = '[["'.$cajtexmos.'","'.$dato.'",""],["javascript","'.$javascript.'",""]]';
        $this->getResponse()->setHttpHeader("X-JSON", '(' . $output . ')');
        break;  
    }


  }

  public function executeAutocomplete()
  {
    if ($this->getRequestParameter('ajax')=='1')
    {
      $this->tags=Herramientas::autocompleteAjax('CODCOM','Fadefcom','codcom',$this->getRequestParameter('fapedido[combo]'));
    }
  }


  
  
  
  /**
   *
   * Función que se ejecuta luego los validadores del negocio (validators)
   * Para realizar validaciones específicas del negocio del formulario
   * Para mayor información vease http://www.symfony-project.org/book/1_0/06-Inside-the-Controller-Layer#chapter_06_validation_and_error_handling_methods
   *
   */
  public function validateEdit()
  {
    if($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $this->fapedido = $this->getFapedidoOrCreate();
      try{ $this->updateFapedidoFromRequest();}
      catch (Exception $ex){}
      $this->configGrid();
      if ($this->getRequestParameter('fapedido[tipref]')=='PR')
      {
        if ($this->getRequestParameter('fapedido[refped]')=='')
        {
         $this->coderror=1104;
         return false;
        }
      }
      
      if (Tesoreria::validarFechaPerContable($this->getRequestParameter('fapedido[fecped]')))
      {
        $this->coderror6=521;
        return false;
      }

      if ($this->getRequestParameter('fapedido[codcli]')=='')
      {
      	$this->coderror7=1111;
         return false;
      }

      if (H::toFloat($this->getRequestParameter('fapedido[monped]'))==0)
      {
      	$this->coderror8=1155;
         return false;
      }

      $grid=Herramientas::CargarDatosGridv2($this,$this->obj);
      $x=$grid[0];
      $i=0;
      if (count($x)>0)
      {
         /*$valnumfil=H::getConfApp2('valnumfil', 'facturacion', 'fafactur');
         $numfil=$this->fapedido->getNumfilas();
         if ($valnumfil=='S')
         {
            if (count($x)>$numfil)  
            {
                $this->coderror1=1165;
	       	return false;
            }
         }*/
	      while ($i<count($x))
	      {
	       if ($x[$i]->getCodart()=="")
	       {
	       	$this->coderror1=1105;
	       	return false;
	       }
	       if ($x[$i]->getCanord()==0)
	       {
	       	$this->coderror2=1106;
	       	return false;
	       }
	       if ($x[$i]->getPreart()==0)
	       {
                       if ($x[$i]->getPrecioe()==0)
		       {
		       	$this->coderror3=1107;
		       	return false;
		       }		       
	       }
               
               if ($x[$i]->getTotart()==0)
	       {
	       	$this->coderror2=1106;
	       	return false;
	       }
	       $i++;
	      }
      }
      else
      {
        $this->coderror4=1108;
        return false;
      }

      $grid2=Herramientas::CargarDatosGridv2($this,$this->objfecped);
      $y=$grid2[0];
      $l=0;
      if (count($y)>0)
      {
        while($l<count($y))
        {
           if ($y[$l]->getFecent()=="")
	       {
	       	$this->coderror6=1110;
	       	return false;
	       }
          $l++;
        }
      }
      else
      {
      	$this->coderror5=1109;
      	return false;
      }
      return true;
    }else return true;
  }

  protected function saving($fapedido)
  {
  	/*if ($fapedido->getId())
  	{
  	  $fapedido->save();
  	}
  	else
  	{*/
     $grid=Herramientas::CargarDatosGridv2($this,$this->obj);
     $grid2=Herramientas::CargarDatosGridv2($this,$this->objfecped);
     Facturacion::salvarPedidos($fapedido,$grid,$grid2);
  	//}
  	return -1;
  }

  protected function deleting($fapedido)
  {
    if ($fapedido->getStatus()!='N')
    {
      $tiedes=H::getX_vacio('REQART','Cadphart','Reqart',$fapedido->getRefped());
      if ($tiedes=='') {
         $c= new Criteria();
         $c->add(FaartpedPeer::NROPED,$fapedido->getNroped());
         FaartpedPeer::doDelete($c);

         $c= new Criteria();
         $c->add(FafecpedPeer::NROPED,$fapedido->getNroped());
         FafecpedPeer::doDelete($c);

         $c= new Criteria();
         $c->add(FargopedPeer::REFDOC,$fapedido->getNroped());
         FargopedPeer::doDelete($c);

         $fapedido->delete();
     return -1;
   }else return 1185;
    }else return 1112;
  }

   public function setVars()
  {
    $this->mascaraarticulo = Herramientas::getMascaraArticulo();
    $this->lonart=strlen($this->mascaraarticulo);
  }

    public function executeAnular()
  {
   $this->referencia=$this->getRequestParameter('referencia');
   $nroped=$this->getRequestParameter('nroped');
   $fecped=$this->getRequestParameter('fecped');

   $dateFormat = new sfDateFormat('es_VE');
   $fec = $dateFormat->format($fecped, 'i', $dateFormat->getInputPattern('d'));

   $c = new Criteria();
   $c->add(FapedidoPeer::NROPED,$nroped);
   $c->add(FapedidoPeer::FECPED,$fec);
   $this->fapedido = FapedidoPeer::doSelectOne($c);
   sfView::SUCCESS;
   }

  public function executeSalvaranu()
  {
    $nroped=$this->getRequestParameter('nroped');
    $fecanu=$this->getRequestParameter('fecanu');
    $fecha_aux=split("/",$fecanu);
    $dateFormat = new sfDateFormat('es_VE');
    $fec = $dateFormat->format($fecanu, 'i', $dateFormat->getInputPattern('d'));
    $this->msg="";
    $c= new Criteria();
    $c->add(FapedidoPeer::NROPED,$nroped);
    $resul= FapedidoPeer::doSelectOne($c);
    if ($resul)
    {
      $resul->setFecanu($fec);
      $resul->setStatus('N');
      $resul->save();
    }
    return sfView::SUCCESS;
  }

  /**
   * Función para manejar la captura de errores del negocio, tanto que se
   * produzcan por algún validator y por un valor false retornado por el validateEdit
   * Para mayor información vease http://www.symfony-project.org/book/1_0/06-Inside-the-Controller-Layer#chapter_06_validation_and_error_handling_methods
   *
   */
  public function handleErrorEdit()
  {
    $this->preExecute();
    $this->params=array();
    $this->fapedido = $this->getFapedidoOrCreate();
    try{ $this->updateFapedidoFromRequest();}
    catch (Exception $ex){}
     $this->configGrid();
     $grid=Herramientas::CargarDatosGridv2($this,$this->obj);
     $grid2=Herramientas::CargarDatosGridv2($this,$this->objfecped);

    $this->labels = $this->getLabels();

    if($this->getRequest()->getMethod() == sfRequest::POST)
    {
        if($this->coderror!=-1)
        {
         $err1 = Herramientas::obtenerMensajeError($this->coderror);
         $this->getRequest()->setError('fapedido{refped}',$err1);
        }
        if($this->coderror1!=-1)
        {
         $err = Herramientas::obtenerMensajeError($this->coderror1);
         $this->getRequest()->setError('',$err);
        }
        if($this->coderror2!=-1)
        {
         $err1 = Herramientas::obtenerMensajeError($this->coderror2);
         $this->getRequest()->setError('',$err1);
        }
        if($this->coderror3!=-1)
        {
         $err1 = Herramientas::obtenerMensajeError($this->coderror3);
         $this->getRequest()->setError('',$err1);
        }
        if($this->coderror4!=-1)
        {
         $err1 = Herramientas::obtenerMensajeError($this->coderror4);
         $this->getRequest()->setError('',$err1);
        }
        if($this->coderror5!=-1)
        {
         $err1 = Herramientas::obtenerMensajeError($this->coderror5);
         $this->getRequest()->setError('',$err1);
        }
        if($this->coderror6!=-1)
        {
         $err1 = Herramientas::obtenerMensajeError($this->coderror6);
         $this->getRequest()->setError('',$err1);
        }
        if($this->coderror7!=-1)
        {
         $err1 = Herramientas::obtenerMensajeError($this->coderror7);
         $this->getRequest()->setError('fapedido{rifpro}',$err1);
        }
        if($this->coderror8!=-1)
        {
         $err1 = Herramientas::obtenerMensajeError($this->coderror8);
         $this->getRequest()->setError('fapedido{monped}',$err1);
        }
      }
    return sfView::SUCCESS;
  }
  
  /**
   * Función para manejar los filtros de búsqueda
   * de la lista
   *
   */
  protected function addFiltersCriteria($c)
  {
    if (isset($this->filters['nroped_is_empty']))
    {
      $criterion = $c->getNewCriterion(FapedidoPeer::NROPED, '');
      $criterion->addOr($c->getNewCriterion(FapedidoPeer::NROPED, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['nroped']) && $this->filters['nroped'] !== '')
    {
      $c->add(FapedidoPeer::NROPED, strtr("%".$this->filters['nroped']."%", '*', '%'), Criteria::LIKE);
    $c->setIgnoreCase(true);
    }
    if (isset($this->filters['fecped_is_empty']))
    {
      $criterion = $c->getNewCriterion(FapedidoPeer::FECPED, '');
      $criterion->addOr($c->getNewCriterion(FapedidoPeer::FECPED, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['fecped']))
    {
      if (isset($this->filters['fecped']['from']) && $this->filters['fecped']['from'] !== '')
      {
        $criterion = $c->getNewCriterion(FapedidoPeer::FECPED, date('Y-m-d', $this->filters['fecped']['from']), Criteria::GREATER_EQUAL);
      }
      if (isset($this->filters['fecped']['to']) && $this->filters['fecped']['to'] !== '')
      {
        if (isset($criterion))
        {
          $criterion->addAnd($c->getNewCriterion(FapedidoPeer::FECPED, date('Y-m-d', $this->filters['fecped']['to']), Criteria::LESS_EQUAL));
        }
        else
        {
          $criterion = $c->getNewCriterion(FapedidoPeer::FECPED, date('Y-m-d', $this->filters['fecped']['to']), Criteria::LESS_EQUAL);
        }
      }

      if (isset($criterion))
      {
        $c->add($criterion);
      }
    }
    if (isset($this->filters['codcli_is_empty']))
    {
      $criterion = $c->getNewCriterion(FapedidoPeer::CODCLI, '');
      $criterion->addOr($c->getNewCriterion(FapedidoPeer::CODCLI, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['codcli']) && $this->filters['codcli'] !== '')
    {
      $c->add(FapedidoPeer::CODCLI, strtr("%".$this->filters['codcli']."%", '*', '%'), Criteria::LIKE);
      $c->setIgnoreCase(true);
    }
    if (isset($this->filters['nompro_is_empty']))
    {
      $criterion = $c->getNewCriterion(FapedidoPeer::NOMPRO, '');
      $criterion->addOr($c->getNewCriterion(FapedidoPeer::NOMPRO, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['nompro']) && $this->filters['nompro'] !== '')
    {
      $c->add(FaclientePeer::NOMPRO, strtr("%".$this->filters['nompro']."%", '*', '%'), Criteria::LIKE);
      $c->addJoin(FapedidoPeer::CODCLI, FaclientePeer::CODPRO);
      $c->setIgnoreCase(true);
    }
    if (isset($this->filters['refped_is_empty']))
    {
      $criterion = $c->getNewCriterion(FapedidoPeer::REFPED, '');
      $criterion->addOr($c->getNewCriterion(FapedidoPeer::REFPED, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['refped']) && $this->filters['refped'] !== '')
    {
      $c->add(FapedidoPeer::REFPED, strtr("%".$this->filters['refped']."%", '*', '%'), Criteria::LIKE);
    $c->setIgnoreCase(true);
    }
    if (isset($this->filters['desped_is_empty']))
    {
      $criterion = $c->getNewCriterion(FapedidoPeer::DESPED, '');
      $criterion->addOr($c->getNewCriterion(FapedidoPeer::DESPED, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['desped']) && $this->filters['desped'] !== '')
    {
      $c->add(FapedidoPeer::DESPED, strtr("%".$this->filters['desped']."%", '*', '%'), Criteria::LIKE);
    $c->setIgnoreCase(true);
    }
     if (isset($this->filters['codedo_is_empty']))
    {
      $criterion = $c->getNewCriterion(FapedidoPeer::CODEDO, '');
      $criterion->addOr($c->getNewCriterion(FapedidoPeer::CODEDO, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['codedo']) && $this->filters['codedo'] !== '')
    {   
          $c->add(FaclientePeer::CODEDO, strtr("%".$this->filters['codedo']."%", '*', '%'), Criteria::LIKE);
          $c->addJoin(FapedidoPeer::CODCLI,  FaclientePeer::CODPRO); 
      
    }
    if (isset($this->filters['nomedo_is_empty']))
    {
      $criterion = $c->getNewCriterion(FapedidoPeer::NOMEDO, '');
      $criterion->addOr($c->getNewCriterion(FapedidoPeer::NOMEDO, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['nomedo']) && $this->filters['nomedo'] !== '')
    {   
          $c->add(OcestadoPeer::NOMEDO, strtr("%".$this->filters['nomedo']."%", '*', '%'), Criteria::LIKE);
          $c->addJoin(FapedidoPeer::CODCLI,  FaclientePeer::CODPRO); 
          $c->addJoin(FaclientePeer::CODEDO,  OcestadoPeer::CODEDO); 
    }
  } 

  public function getLabels()
  {
    $labels = parent::getLabels();
 
    $cambiareti=H::getConfApp2('cameti', 'compras', 'almdefdirec');
    if ($cambiareti=='S')
      $labels['fapedido{coddirec}'] = 'Estado';
    return $labels;
  } 

    /**
   * Función principal para el manejo de la accion list
   * del formulario.
   *
   */
  public function executeList()
  {
    $this->processSort();

    $this->processFilters();

    $this->listing();

    $this->filters = $this->getUser()->getAttributeHolder()->getAll('sf_admin/fapedido/filters');

    $loguse= $this->getUser()->getAttribute('loguse');
    $filsoldir=H::getConfApp2('filsoldir', 'compras', 'almsolegr');

     // 15    // pager
    $this->pager = new sfPropelPager('Fapedido', 15);
    $c = new Criteria();
    if ($filsoldir=='S'){
      $this->sql='fapedido.coddirec in (select coddirec from "SIMA_USER".segdirusu where loguse=\''.$loguse.'\')';
      $c->add(FapedidoPeer::CODDIREC,$this->sql,Criteria::CUSTOM); 
    }
    $this->addSortCriteria($c);
    $this->addFiltersCriteria($c);
    $this->pager->setCriteria($c);
    $this->pager->setPage($this->getRequestParameter('page', 1));
    $this->pager->init();
  }

}
