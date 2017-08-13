<?php

/**
 * dashboard actions.
 *
 * @package    siga
 * @subpackage dashboard
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class dashboardActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
	$connection1 = Propel::getConnection();
	$query1 = "  SELECT COUNT(p.fecped) as total,extract(MONTH FROM p.fecped) as mes
	FROM fapedido p
	WHERE p.nroped not in (select reqart FROM cadphart) and extract(YEAR FROM p.fecped)=".date('Y')."
	group by extract(MONTH FROM p.fecped)
	";
	$statement1 = $connection1->prepareStatement($query1);
	$resultset1 = $statement1->executeQuery();
        $total=0;
	$i=0;        
	foreach($resultset1 as $value1):            
            $arr_temp1[$i] = array(sfGraphics::NombreMes($value1['mes']),$value1['total']);
	    $total= $total + $value1['total'];   
	$i++;     
        endforeach;        
        //return $arr_temp;
       $tot=$total;
       $data=$arr_temp1;      
       $subtitulo='';
       $this->grafica_pedidos_pendientes = sfGraphics::pieChart('Total Pedidos Pendientes por Mes',$subtitulo, $data, 'div1',$tot,'width: 600px; height: 300px;');

	$connection = Propel::getConnection();
	$query = "
	select count(f.codcon) as cantidad,v.percon as vendedor
	from fafactur f
	inner join vendedores v on v.codcon=f.codcon
	 group by v.percon order by cantidad asc limit 10
	";
	$statement = $connection->prepareStatement($query);
	$resultset = $statement->executeQuery();
        $i=0;        
        foreach($resultset as $value):     
	    $vendedor = explode(',',$value['vendedor']);       
            $arr_temp[$i] = array($vendedor['0'],$value['cantidad']);
        $i++;
        endforeach;        
        //return $arr_temp;
       $this->datos=$arr_temp;
       $categorias[0]="Vendedores";
       $subtitulo="Listado de vendedores con facturación";       
       $this->grafica_vendedores_facturacion = sfGraphics::basicColumns('VENDEDORES CON FACTURACIÓN',$categorias,@$this->datos,'Totales','div2',$subtitulo,'width: 500px; height: 300px;');


	$connection2 = Propel::getConnection();
//los ultimos diez por fecha de factura desc
	$query2 = "
	select cliente,cuentaxcobrar from cuentaxcobrar_clientes where cuentaxcobrar>0
	";
	$statement2 = $connection2->prepareStatement($query2);
	$resultset2 = $statement2->executeQuery();
        $i=0;        
        foreach($resultset2 as $value2):     	          
            $arr_temp2[$i] = array($value2['cliente'],$value2['cuentaxcobrar']);
        $i++;
        endforeach;        
        //return $arr_temp;
       $this->datos=$arr_temp2;
       $categorias2[0]="Clientes";
       $subtitulo2="";       
       $this->grafica_clientes_cuentasxcobrar = sfGraphics::basicColumns('CLIENTES CON CUENTAS POR COBRAR',$categorias2,@$this->datos,'Totales','div3',$subtitulo2,'width: 500px; height: 300px;');


	$connection3 = Propel::getConnection();
	$query3 = "
	select sum(cantidad) as cantidad,cp.desart from radarventas rv
	inner join catproductos cp on cp.id=rv.catproductos_id
	group by cp.desart
	";
	$statement3 = $connection3->prepareStatement($query3);
	$resultset3 = $statement3->executeQuery();
        $i=0;        
        foreach($resultset3 as $value3):     	          
            $arr_temp3[$i] = array($value3['desart'],$value3['cantidad']);
        $i++;
        endforeach;        
        //return $arr_temp;
       $this->datos=$arr_temp3;
       $categorias3[0]="Productos";
       $subtitulo3="";       
       $this->grafica_radar_ventas_producto = sfGraphics::basicColumns('TOTAL DEL RADAR DE VENTAS POR PRODUCTOS',$categorias3,@$this->datos,'Totales','div4',$subtitulo3,'width: 500px; height: 300px;');

  } 
  public function executeDashboard()
  {

	//nuevos clientes
	$this->nuevos_clientes = 0;
	$connection1 = Propel::getConnection();
	$query1 = "SELECT count(id) as cantidad
	FROM facliente c WHERE EXTRACT(year FROM c.fecreg)='".date("Y")."' and EXTRACT(month FROM c.fecreg)='".date("m")."'";
	$statement1 = $connection1->prepareStatement($query1);
	$resultset1 = $statement1->executeQuery();       
        foreach($resultset1 as $value1):    	    
		$this->nuevos_clientes = $this->nuevos_clientes + $value1['cantidad'];	   
        endforeach; 	
	//total clientes
	$this->total_clientes = 0;
	$connection_tc = Propel::getConnection();
	$query_tc = "
	SELECT count(id) as cantidad, EXTRACT(year FROM c.fecreg) as anio, EXTRACT(MONTH FROM c.fecreg) as mes
	FROM facliente c
	group by EXTRACT(year FROM c.fecreg), EXTRACT(MONTH FROM c.fecreg)";
	$statement_tc = $connection_tc->prepareStatement($query_tc);
	$resultset_tc = $statement_tc->executeQuery();
	foreach($resultset_tc as $value_tc): 
            $this->total_clientes = $this->total_clientes + $value_tc['cantidad']; 	          
        endforeach; 
	//pedidos pendientes 
	$connection_pp = Propel::getConnection();
	$query_pp = "
	SELECT count(*) as total
	FROM fapedido p
	WHERE p.nroped not in (select reqart FROM cadphart)";
	$statement_pp = $connection_pp->prepareStatement($query_pp);
	$resultset_pp = $statement_pp->executeQuery();
	foreach($resultset_pp as $value_pp): 
	    $this->pedidos_pendientes = $this->pedidos_pendientes + $value_pp['total'];	        	          
        endforeach; 
	//total pedidos 
	$connection_tp = Propel::getConnection();
	$query_tp = "
	SELECT count(*) as total
	FROM fapedido p";
	$statement_tp = $connection_tp->prepareStatement($query_tp);
	$resultset_tp = $statement_tp->executeQuery();
	foreach($resultset_tp as $value_tp): 
	    $this->total_pedidos = $this->total_pedidos + $value_tp['total'];	        	          
        endforeach;
	//facturación
	$connection_f = Propel::getConnection();
	$query_f = "
	select sum(monfac) as monto,count(*) as total from fafactur";
 	$statement_f = $connection_f->prepareStatement($query_f);
	$resultset_f = $statement_f->executeQuery();
	foreach($resultset_f as $value_f): 
	    $this->total_facturas = $value_f['total'];	 
	    $this->monto_facturas = $value_f['monto'];	        	          
        endforeach;
	//cuentas por cobrar
	$connection_cc = Propel::getConnection();
	$query_cc = "
	SELECT sum(saldoc) as monto,count(*) as total
	FROM cobdocume c
	LEFT JOIN facliente f ON f.codpro = c.codcli
	WHERE c.saldoc > 0";
 	$statement_cc = $connection_cc->prepareStatement($query_cc);
	$resultset_cc = $statement_cc->executeQuery();
	foreach($resultset_cc as $value_cc): 
	    $this->total_facturas_cuentaxcobrar = $value_cc['total'];	 
	    $this->monto_cuentaxcobrar = $value_cc['monto'];	        	          
        endforeach;
	//tabla cliente con mayor y menor facturacion
	$connection_cmmf = Propel::getConnection();
	$query_cmmf = "
	SELECT count(c.codcli) as total,c.codcli, f.nompro as nomcli, sum(c.saldoc) as monto
	FROM cobdocume c
	LEFT JOIN facliente f ON f.codpro = c.codcli 
	LEFT JOIN fafactur ff ON c.refdoc  =  lpad(ff.reffac,10,'0') AND ff.status = 'A'
	LEFT JOIN faconsignatario fc ON fc.codcon = ff.codcon	
	group by c.codcli, f.nompro";
	$statement_cmmf = $connection_cmmf->prepareStatement($query_cmmf);
	$resultset_cmmf = $statement_cmmf->executeQuery();
	$icmmf = 0;
	foreach($resultset_cmmf as $value_cmmf): 
	    $arr_cmmf[$icmmf] = array($value_cmmf['codcli'],$value_cmmf['nomcli'],$value_cmmf['total'],$value_cmmf['monto']);
	    $icmmf++;	        	          
        endforeach;	
	$this->arr_cmmf = $arr_cmmf;
	//tabla últimos pedidos facturados
	$connection_upf = Propel::getConnection();
	$query_upf = "
	SELECT f.reffac,c.codpro,c.nompro,f.fecfac,f.monfac 
	FROM fapedido p
	INNER JOIN facliente c on c.codpro=p.codcli
	INNER JOIN fafactur f on f.codcli=p.codcli LIMIT 20";
	$statement_upf = $connection_upf->prepareStatement($query_upf);
	$resultset_upf = $statement_upf->executeQuery();
	$iupf = 0;
	foreach($resultset_upf as $value_upf): 
	    $arr_upf[$iupf] = array($value_upf['reffac'],$value_upf['fecfac'],$value_upf['codpro'],$value_upf['nompro'],$value_upf['monfac']);
	    $iupf++;	        	          
        endforeach;	
	$this->arr_upf = $arr_upf;
	//productos más vendidos
	$connection_pmv = Propel::getConnection();
	$query_pmv = "
	SELECT codart, desart, unimed, SUM(CANTOT) AS cantidad
	FROM ventas_art
	GROUP BY CODART, DESART, UNIMED
	ORDER BY CANTIDAD DESC LIMIT 10";
	$statement_pmv = $connection_pmv->prepareStatement($query_pmv);
	$resultset_pmv = $statement_pmv->executeQuery();
	$ipmv = 0;
	foreach($resultset_pmv as $value_pmv): 
	    $arr_pmv[$ipmv] = array($value_pmv['codart'],$value_pmv['desart'],$value_pmv['cantidad']);
	    $ipmv++;	        	          
        endforeach;	
	$this->arr_pmv = $arr_pmv;
	//vendedores con mayor facturación
	$connection_vmf = Propel::getConnection();
	$query_vmf = "
	SELECT fc.nomcon AS vendedor, count (f.*) AS cantidad, sum(f.monfac) as monto
	FROM fafactur f
	LEFT JOIN faconsignatario fc ON fc.codcon = f.codcon
	WHERE  f.status = 'A'
	GROUP BY fc.nomcon ORDER BY cantidad ASC LIMIT 10";
	$statement_vmf = $connection_vmf->prepareStatement($query_vmf);
	$resultset_vmf = $statement_vmf->executeQuery();
	$ivmf = 0;
	foreach($resultset_vmf as $value_vmf): 
	    $arr_vmf[$ivmf] = array($value_vmf['vendedor'],$value_vmf['cantidad'],$value_vmf['monto']);
	    $ivmf++;	        	          
        endforeach;	
	$this->arr_vmf = $arr_vmf;
  }
  public function executeGraficacliente()
  {
	$anio =  $this->getRequestParameter('anio');
	$mes =  $this->getRequestParameter('mes');
	if ($anio=="")
	{
		$anio = date("Y");
	}
	if ($mes=="")
	{		
		$mes = date("m");
	}
	//nuevos clientes
	$connection1 = Propel::getConnection();
	$query1 = "SELECT count(id) as cantidad
	FROM facliente c WHERE EXTRACT(year FROM c.fecreg)='".$anio."' and EXTRACT(month FROM c.fecreg)='".$mes."'";
	$statement1 = $connection1->prepareStatement($query1);
	$resultset1 = $statement1->executeQuery();       
        foreach($resultset1 as $value1):    	    
		$this->nuevos_clientes = $this->nuevos_clientes + $value1['cantidad'];	   
        endforeach; 
	//total clientes	
	$connectiont = Propel::getConnection();
	$queryt = "SELECT count(id) as cantidad	FROM facliente";
	$statementt = $connectiont->prepareStatement($queryt);
	$resultsett = $statementt->executeQuery();
        foreach($resultsett as $valuet):      	       
            $this->total_clientes = $this->total_clientes + $valuet['cantidad'];   
        endforeach; 
        $arr_temp1[0] = array("Clientes Nuevo",$this->nuevos_clientes);  
        $arr_temp1[1] = array("Total Clientes",$this->total_clientes);    
        $tot=$this->nuevos_clientes+$this->total_clientes;
        $data=$arr_temp1;      
        $subtitulo='';
	$porcentaje_crecimiento = ($this->nuevos_clientes * 100) / $this->total_clientes;
	if ($this->getRequestParameter('anio')!="" && $this->getRequestParameter('mes')!="")
	{
        $this->grafica = sfGraphics::pie3D('Porcentaje de crecimiento de '.number_format($porcentaje_crecimiento,2,",",".").' en la cartera de clientes para la fecha indicada',$subtitulo, $data, 'div1',$tot,'width: 850px; height: 450px;',"Porcentaje");
	}
	else
	{
        $this->grafica = sfGraphics::pie3D('Porcentaje de crecimiento de '.number_format($porcentaje_crecimiento,2,",",".").' en la cartera de clientes en los últimos 2 meses',$subtitulo, $data, 'div1',$tot,'width: 850px; height: 450px;',"Porcentaje");
	}
	//Lista clientes
	$connection = Propel::getConnection();
	$query = "
	SELECT fecreg,rifpro,nompro,telpro,nompercon FROM facliente
	ORDER BY fecreg desc";
	$statement = $connection->prepareStatement($query);
	$resultset = $statement->executeQuery();
	$i = 0;
	foreach($resultset as $value): 
	    $arr[$i] = array($value['fecreg'],$value['rifpro'],$value['nompro'],$value['telpro'],$value['nompercon']);
	    $i++;	        	          
        endforeach;	
	$this->arr = $arr;
  }
  public function executeGraficapedidosmes()
  {
	$anio =  $this->getRequestParameter('anio');
	$mes =  $this->getRequestParameter('mes');
	if ($anio=="")
	{
		$anio = date("Y");
	}
	if ($mes=="")
	{		
		$mes = date("m");
	}
	//pedidos pendientes 
	$connection_pp = Propel::getConnection();
	$query_pp = "
	SELECT count(*) as total
	FROM fapedido p
	WHERE p.nroped not in (select reqart FROM cadphart) and 
	EXTRACT(month FROM p.fecped)='".$mes."' and EXTRACT(year FROM p.fecped)='".$anio."'";
	$statement_pp = $connection_pp->prepareStatement($query_pp);
	$resultset_pp = $statement_pp->executeQuery();
	$total = 0;
	foreach($resultset_pp as $value_pp): 
	    $this->pedidos_pendientes = $this->pedidos_pendientes + $value_pp['total'];	  
	    $total = $total + $value_pp['total'];      	          
        endforeach; 
	//total pedidos 
	$connection_tp = Propel::getConnection();
	$query_tp = "
	SELECT count(*) as total
	FROM fapedido p
	WHERE EXTRACT(month FROM p.fecped)='".$mes."' and EXTRACT(year FROM p.fecped)='".$anio."'";
	$statement_tp = $connection_tp->prepareStatement($query_tp);
	$resultset_tp = $statement_tp->executeQuery();
	foreach($resultset_tp as $value_tp): 
	    $this->total_pedidos = $this->total_pedidos + $value_tp['total'];
	    $total = $total + $value_tp['total'];	        	          
        endforeach;
       $arr_temp1[0] = array("Pedidos Pendientes",$this->pedidos_pendientes);  
       $arr_temp1[1] = array("Total Pedidos del Mes",$this->total_pedidos);     
       $porcentaje_ped_pen = ($this->pedidos_pendientes * 100)/($this->total_pedidos+$this->pedidos_pendientes);
       $tot=$total;
       $data=$arr_temp1;      
       $subtitulo='';	
       if ($tot==0)
       {
		$this->grafica_clientes_registrados = "<div id='sin_resultado'>No hay registros con los criterios seleccionados</div>";
       }
       else
       {
       		$this->grafica_clientes_registrados = sfGraphics::pie3D('Porcentaje de Pedidos Pendientes: '.$porcentaje_ped_pen."%",$subtitulo, $data, 'div1',$tot,'width: 850px; height: 450px;','Porcentaje');
 	}
	//Lista pedidos
	$connection = Propel::getConnection();
	$query = "
	SELECT p.fecped,p.nroped,c.rifpro,c.nompro,c.telpro,p.monped,p.status FROM fapedido p
	JOIN facliente c on c.codpro=p.codcli 
	WHERE EXTRACT(month FROM p.fecped)='".$mes."' and EXTRACT(year FROM p.fecped)='".$anio."'";
	$statement = $connection->prepareStatement($query);
	$resultset = $statement->executeQuery();
	$i = 0;
	foreach($resultset as $value): 
	    $arr[$i] = array($value['fecped'],$value['nroped'],$value['rifpro'],$value['nompro'],$value['telpro'],$value['monped'],$value['status']);
	    $i++;	        	          
        endforeach;	
	$this->arr = $arr;
  }
  public function executeGraficafacturacion()
  {
	$anio =  $this->getRequestParameter('anio');
	$mes =  $this->getRequestParameter('mes');
	if ($anio=="")
	{
		$anio = date("Y");
	}
	if ($mes=="")
	{		
		$mes = date("m");
	}
	//facturación
	$datos_mes = "";
	$connection = Propel::getConnection();
	$query = "
	select sum(monfac) as monto,count(*) as total,EXTRACT(month FROM fecfac) as mes
	from fafactur where EXTRACT(year FROM fecfac) = '".$anio."'";
	if ($mes!=date("m"))
	{
		$query.=" and EXTRACT(month FROM fecfac) = '".$mes."'";
	}
	$query.=" group by EXTRACT(month FROM fecfac)";
 	$statement = $connection->prepareStatement($query);
	$resultset = $statement->executeQuery();
        $x=0;        
        foreach($resultset as $value): 
		
	        
		for ($i=1;$i<=12;$i++)
		{
			
			if ($i==$value['mes'])
			{
				$arreglo_tab[$i] = array($value['mes'], $value['monto'],$value['total']); 
				if ($i==12)
				{
            				$datos_mes.= $value['monto'];
				}
				else
				{
				  	$datos_mes.= $value['monto'].",";
				}
			}
			else
			{
				$arreglo_tab[$i] = array($i,0,0); 
				if ($i==12)
				{
					$datos_mes.= "0";
				}
				else
				{
				  	$datos_mes.= "0,";
				}
			}
			$x++;
			
		}   
        endforeach;   
       $this->arreglo_tab = $arreglo_tab;
       $datos=$datos_mes;
       $serie = "Meses";
       $categorias = "";
       $subtitulo="";
       if ($i==0)
       {
		$this->grafica = "<div id='sin_resultado'>No hay registros con los criterios seleccionados</div>";
       }
       else
       {
       		$this->grafica = sfGraphics::columns3DMeses('Monto en Bs. en facturación por Mes',$serie,$categorias,$datos,'Totales','div4',$subtitulo,'width: 700px; height: 500px;',"Monto"); 
 	}
	//Lista pedidos
	$connection = Propel::getConnection();
	$query = "	
	SELECT f.fecfac,f.reffac,c.rifpro,c.nompro,f.monfac FROM fafactur f
	JOIN facliente c on c.codpro=f.codcli 
	WHERE EXTRACT(month FROM f.fecfac)='".$mes."' and EXTRACT(year FROM f.fecfac)='".$anio."'";
	$statement = $connection->prepareStatement($query);
	$resultset = $statement->executeQuery();
	$i = 0;
	foreach($resultset as $value): 
	    $arr[$i] = array($value['fecfac'],$value['reffac'],$value['rifpro'],$value['nompro'],$value['monfac']);
	    $i++;	        	          
        endforeach;	
	$this->arr = $arr;
  }
  public function executeGraficacuentaxcobrar()
  {
	$anio =  $this->getRequestParameter('anio');
	$mes =  $this->getRequestParameter('mes');
	if ($anio=="")
	{
		$anio = date("Y");
	}
	if ($mes=="")
	{		
		$mes = date("m");
	}	
	//facturación
	$datos_mes = "";
	$connection = Propel::getConnection();
	$query = "
	SELECT sum(saldoc) as monto,count(*) as total,EXTRACT(YEAR FROM c.fecemi) as anio,EXTRACT(MONTH FROM c.fecemi) as mes
	FROM cobdocume c
	LEFT JOIN facliente f ON f.codpro = c.codcli
	WHERE c.saldoc > 0";	
	if ($mes!="" && $anio!="")
	{
		$query.=" and EXTRACT(year FROM c.fecemi) = '".$anio."' and EXTRACT(month FROM c.fecemi) = '".$mes."'";
	}
	$query.=" group by EXTRACT(YEAR FROM c.fecemi),EXTRACT(MONTH FROM c.fecemi) ";
 	$statement = $connection->prepareStatement($query);
	$resultset = $statement->executeQuery(); 
	$this->cantidad_facturas = 0;
        $this->monto_facturas = 0;
        foreach($resultset as $value): 
		for ($i=1;$i<=12;$i++)
		{
			if ($i==$value['mes'])
			{
				$arreglo_tab[$i] = array($value['mes'], $value['monto'],$value['total']); 
				if ($i==12)
				{
            				$datos_mes.= $value['monto'];
				}
				else
				{
				  	$datos_mes.= $value['monto'].",";
				}
			}
			else
			{
				$arreglo_tab[$i] = array($i,0,0); 
				if ($i==12)
				{
					$datos_mes.= "0";
				}
				else
				{
				  	$datos_mes.= "0,";
				}
			}		
		}   
	$this->cantidad_facturas = $this->cantidad_facturas + $value['total'];
        $this->monto_facturas = $this->monto_facturas + $value['monto'];
        endforeach;   
       $this->arreglo_tab = $arreglo_tab;
       $datos=$datos_mes;
       $serie = "Meses";
       $categorias = "";
       $subtitulo="";
       if ($i==0)
       {
		$this->grafica = "<div id='sin_resultado'>No hay registros con los criterios seleccionados</div>";
       }
       else
       {
       		$this->grafica = sfGraphics::columns3DMeses('',$serie,$categorias,$datos,'Totales','div4',$subtitulo,'width: 700px; height: 500px;',"Monto"); 
 	}
	//Lista
	$connection = Propel::getConnection();
	$query = "	
	SELECT c.fecemi,c.fecven,c.refdoc,f.rifpro,f.nompro,c.mondoc
	FROM cobdocume c
	LEFT JOIN facliente f ON f.codpro = c.codcli
	WHERE c.saldoc > 0";
	if ($mes!="" && $anio!="")
	{
		$query.=" and EXTRACT(year FROM c.fecemi) = '".$anio."' and EXTRACT(month FROM c.fecemi) = '".$mes."'";
	}
	$statement = $connection->prepareStatement($query);
	$resultset = $statement->executeQuery();
	$i = 0;
	foreach($resultset as $value): 
	    $arr[$i] = array($value['fecemi'],$value['fecven'],$value['refdoc'],$value['rifpro'],$value['nompro'],$value['mondoc']);
	    $i++;	        	          
        endforeach;	
	$this->arr = $arr;
  }

  public function executeGraficaclientesmayormenosfac()
  {
	$anio =  $this->getRequestParameter('anio');
	$mes =  $this->getRequestParameter('mes');
	if ($anio=="")
	{
		$anio = date("Y");
	}
	if ($mes=="")
	{		
		$mes = date("m");
	}	
	//clientes mayor y menor facturación
	$datos_mes = "";
	$connection = Propel::getConnection();
	$query = "
	SELECT sum(c.saldoc) as monto, f.nompro as nomcli
	FROM cobdocume c
	LEFT JOIN facliente f ON f.codpro = c.codcli 
	LEFT JOIN fafactur ff ON c.refdoc  =  lpad(ff.reffac,10,'0') AND ff.status = 'A'
	LEFT JOIN faconsignatario fc ON fc.codcon = ff.codcon";	
	if ($mes!="" && $anio!="")
	{
		$query.=" WHERE EXTRACT(year FROM c.fecemi) = '".$anio."' and EXTRACT(month FROM c.fecemi) = '".$mes."'";
	}
	$query.=" group by c.codcli, f.nompro order by monto desc LIMIT 10 ";
 	$statement = $connection->prepareStatement($query);
	$resultset = $statement->executeQuery();
	$datos = "";
	$categorias = "";
	$i=0;
        foreach($resultset as $value): 
            $datos.= $value['monto'].",";	
	    $categorias.= "'".$value['nomcli']."',";	
	    $i++;
       endforeach;   
       $serie = "Clientes";
       $subtitulo = "";
       if ($i==0)
       {
		$this->grafica = "<div id='sin_resultado'>No hay registros con los criterios seleccionados</div>";
       }
       else
       {
       		$this->grafica = sfGraphics::columns3D('',$serie,$categorias,$datos,'Totales','div4',$subtitulo,'width: 700px; height: 500px;','Monto'); 
 	}
	//Lista
	$connection = Propel::getConnection();
	$query = "	
	SELECT count(c.codcli) as total,c.codcli, f.nompro as nomcli, sum(c.saldoc) as monto
	FROM cobdocume c
	LEFT JOIN facliente f ON f.codpro = c.codcli 
	LEFT JOIN fafactur ff ON c.refdoc  =  lpad(ff.reffac,10,'0') AND ff.status = 'A'
	LEFT JOIN faconsignatario fc ON fc.codcon = ff.codcon";
	if ($mes!="" && $anio!="")
	{
		$query.=" WHERE EXTRACT(year FROM c.fecemi) = '".$anio."' and EXTRACT(month FROM c.fecemi) = '".$mes."'";
	}
	$query.=" group by c.codcli, f.nompro order by total desc";
	$statement = $connection->prepareStatement($query);
	$resultset = $statement->executeQuery();
	$i = 0;
	foreach($resultset as $value): 
	    $arr[$i] = array($value['codcli'],$value['nomcli'],$value['total'],$value['monto']);
	    $i++;	        	          
        endforeach;	
	$this->arr = $arr;
  }
  public function executeGraficaventaproductos()
  {
	$anio =  $this->getRequestParameter('anio');
	$mes =  $this->getRequestParameter('mes');
	if ($anio=="")
	{
		$anio = date("Y");
	}
	if ($mes=="")
	{		
		$mes = date("m");
	}	
	//clientes mayor y menor facturación
	$datos_mes = "";
	$connection = Propel::getConnection();
	$query = "SELECT codart, desart, unimed, SUM(CANTOT) AS cantidad
	FROM ventas_art	";	
	if ($mes!="" && $anio!="")
	{
		$query.=" WHERE EXTRACT(year FROM fecfac) = '".$anio."' and EXTRACT(month FROM fecfac) = '".$mes."'";
	}
	$query.=" GROUP BY CODART, DESART, UNIMED ORDER BY CANTIDAD DESC LIMIT 10 ";
 	$statement = $connection->prepareStatement($query);
	$resultset = $statement->executeQuery();
	$datos = "";
	$categorias = "";
	$i=0;
        foreach($resultset as $value): 
            $datos.= $value['cantidad'].",";	
	    $categorias.= "'".$value['desart']."',";	
	    $i++;
       endforeach;   
       $serie = "Productos";
       $subtitulo = "";
       if ($i==0)
       {
		$this->grafica = "<div id='sin_resultado'>No hay registros con los criterios seleccionados</div>";
       }
       else
       {
       		$this->grafica = sfGraphics::columns3D('',$serie,$categorias,$datos,'Totales','div4',$subtitulo,'width: 700px; height: 500px;',"Cantidad de Facturas"); 
 	}
	//Lista
	$connection = Propel::getConnection();
	$query = "SELECT codart, desart, SUM(CANTOT) AS cantidad, sum(monfac) AS monto
	FROM ventas_art	";
	if ($mes!="" && $anio!="")
	{
		$query.=" WHERE EXTRACT(year FROM fecfac) = '".$anio."' and EXTRACT(month FROM fecfac) = '".$mes."'";
	}
	$query.=" group by codart, desart order by cantidad desc";
	$statement = $connection->prepareStatement($query);
	$resultset = $statement->executeQuery();
	$i = 0;
	foreach($resultset as $value): 
	    $arr[$i] = array($value['codart'],$value['desart'],$value['cantidad'],$value['monto']);
	    $i++;	        	          
        endforeach;	
	$this->arr = $arr;
  }

  public function executeGraficavendedoresmes()
  {
	$anio =  $this->getRequestParameter('anio');
	$mes =  $this->getRequestParameter('mes');
	if ($anio=="")
	{
		$anio = date("Y");
	}
	if ($mes=="")
	{		
		$mes = date("m");
	}
	//clientes mayor y menor facturación
	$datos_mes = "";
	$connection = Propel::getConnection();
	$query = "
	SELECT fc.nomcon AS vendedor, count (f.*) AS cantidad, sum(f.monfac) as monto
	FROM fafactur f
	LEFT JOIN faconsignatario fc ON fc.codcon = f.codcon
	WHERE  f.status = 'A'	";	
	if ($mes!="" && $anio!="")
	{
		$query.=" and EXTRACT(year FROM fecfac) = '".$anio."' and EXTRACT(month FROM fecfac) = '".$mes."'";
	}
	$query.=" GROUP BY fc.nomcon ORDER BY cantidad desc LIMIT 10 ";
 	$statement = $connection->prepareStatement($query);
	$resultset = $statement->executeQuery();
	$datos = "";
	$categorias = "";
	$i=0;
        foreach($resultset as $value): 
            $datos.= $value['monto'].",";	
	    $categorias.= "'".$value['vendedor']."',";	
	    $i++;
       endforeach;   
       $serie = "Vendedores";
       $subtitulo = "";
       if ($i==0)
       {
		$this->grafica = "<div id='sin_resultado'>No hay registros con los criterios seleccionados</div>";
       }
       else
       {
       		$this->grafica = sfGraphics::columns3D('',$serie,$categorias,$datos,'Totales','div4',$subtitulo,'width: 700px; height: 500px;',"Monto"); 
 	}
	//Lista
	$connection = Propel::getConnection();
	$query = "SELECT fc.nomcon AS vendedor, count (f.*) AS cantidad, sum(f.monfac) as monto
	FROM fafactur f
	LEFT JOIN faconsignatario fc ON fc.codcon = f.codcon
	WHERE  f.status = 'A'	";
	if ($mes!="" && $anio!="")
	{
		$query.=" and EXTRACT(year FROM fecfac) = '".$anio."' and EXTRACT(month FROM fecfac) = '".$mes."'";
	}
	$query.=" GROUP BY fc.nomcon ORDER BY cantidad desc";
	$statement = $connection->prepareStatement($query);
	$resultset = $statement->executeQuery();
	$i = 0;
	foreach($resultset as $value): 
	    $arr[$i] = array($value['vendedor'],$value['cantidad'],$value['monto']);
	    $i++;	        	          
        endforeach;	
	$this->arr = $arr;
  }
  public function executeGraficarutasmes()
  {
	$anio =  $this->getRequestParameter('anio');
	$mes =  $this->getRequestParameter('mes');
	if ($anio=="")
	{
		$anio = date("Y");
	}
	if ($mes=="")
	{		
		$mes = date("m");
	}
	//clientes mayor y menor facturación
	$datos_mes = "";
	$connection = Propel::getConnection();
	$query = "
	select ruta.descripcion as ruta,count(f.id) as cantidad,sum(f.monfac) as monto
	from radarventas r 
	inner join fafactur f on f.id=r.fafactur_id	
	inner join ruta ruta on ruta.id=r.ruta_id
	";	
	if ($mes!="" && $anio!="")
	{
		$query.=" and EXTRACT(year FROM r.fecha) = '".$anio."' and EXTRACT(month FROM r.fecha) = '".$mes."'";
	}
	$query.=" group by ruta.descripcion ORDER BY cantidad desc ";
 	$statement = $connection->prepareStatement($query);
	$resultset = $statement->executeQuery();
	$datos = "";
	$categorias = "";
	$i=0;
        foreach($resultset as $value): 
            $datos.= $value['monto'].",";	
	    $categorias.= "'".$value['ruta']."',";	
	    $arr[$i] = array($value['ruta'],$value['cantidad'],$value['monto']);
	    $i++;
       endforeach;   
       $serie = "Rutas";
       $subtitulo = "";
       if ($i==0)
       {
		$this->grafica = "<div id='sin_resultado'>No hay registros con los criterios seleccionados</div>";
       }
       else
       {
       		$this->grafica = sfGraphics::columns3D('',$serie,$categorias,$datos,'Totales','div4',$subtitulo,'width: 700px; height: 500px;',"Monto"); 
 	}

	$this->arr = $arr;
  }
  public function executeGraficacoberturaestimada()
  {
	$anio =  $this->getRequestParameter('anio');
	$mes =  $this->getRequestParameter('mes');
	if ($anio=="")
	{
		$anio = date("Y");
	}
	if ($mes=="")
	{		
		$mes = date("m");
	}
	//clientes mayor y menor facturación
	$datos_mes = "";
	$connection = Propel::getConnection();
	$query = "select categoria, sum(total) as total, litro, codcon, nomcon from (
	select substring(codart,1,9) as categoria, codart, sum(cantot) as total, litro,va.codcon,v.nomcon from ventas_art va
	inner join vendedores v on v.codcon=va.codcon";	
	if ($mes!="" && $anio!="")
	{
		$query.=" where EXTRACT(year FROM fecfac) = '".$anio."' and EXTRACT(month FROM fecfac) = '".$mes."'";
	}
	$query.=" group by categoria,codart, litro,va.codcon,v.nomcon order by categoria) as a
	group by categoria, litro,codcon,nomcon order by categoria ";
 	$statement = $connection->prepareStatement($query);
	$resultset = $statement->executeQuery();
	$datos = "";
	$categorias = "";
	$i=0;
        foreach($resultset as $value): 
            $datos.= $value['total'].",";	
	    $categorias.= "'".$value['nomcon']."',";	
            $arr[$i] = array($value['nomcon'],$value['litro'],$value['total']);
	    $i++;
       endforeach;   
       $serie = "Vendedores";
       $subtitulo = "";
       if ($i==0)
       {
		$this->grafica = "<div id='sin_resultado'>No hay registros con los criterios seleccionados</div>";
       }
       else
       {
       		$this->grafica = sfGraphics::basicColumns3D('',$serie,$categorias,$datos,'Totales','div4',$subtitulo,'width: 700px; height: 500px;',"Monto","Proyectado","Ejecutado",$datos,$datos); 
 	}
	//Lista

	$this->arr = $arr;
  }
}
