	<script type="text/javascript" language="javascript" class="init">
	$(document).ready(function() {
		$('table.display').DataTable({
		    "bPaginate": true,
		    "bFilter": false,
		    "pageLength": 5,
		    "lengthChange": false,
			language: {
				url: '../../js/vendedores/data_table/es.json'
			    }
		});
	} );
	</script>
	<div id="titulo">Estadística del mes de: <?php echo sfGraphics::NombreMes(date("m"))?> / Samoa <?php echo date("Y")?></div>
	<table border="0" cellspacing="0" cellpadding="0">
            <tr>                
                <td>
                   <table border="0" cellspacing="0" cellpadding="0">
			<tr>
			   <td colspan="2" id="titulo_tabla">Clientes</td>
			</tr>
			<tr>
			   <td  id="detalle_img" rowspan="2"><img src="../../images/dashboard/cliente1.png"></td>
			   <td id="detalle_tex">Nuevos Clientes: <?php echo $nuevos_clientes?></td>
			</tr>			
			<tr>
			   <td id="detalle_tex">Total Clientes: <?php echo $total_clientes?></td>
			</tr>
			<tr>
			   <td colspan="2" id="pie_tabla"><a href="graficacliente?anio=<?php echo date("Y")?>&mes=<?php echo date("m")?>">Ver más...</a></td>
			</tr>
		   </table>                    
                 </td>
		 <td id="espacio"></td>
		 <td>
                     <table border="0" cellspacing="0" cellpadding="0">
			<tr>
			   <td colspan="2" id="titulo_tabla">Pedidos</td>
			</tr>
			<tr>
			   <td  id="detalle_img" rowspan="2"><img src="../../images/dashboard/pedidos1.png"></td>
			   <td id="detalle_tex">Pedidos Pendientes: <?php echo $pedidos_pendientes?></td>
			</tr>			
			<tr>
			   <td id="detalle_tex">Total Pedidos: <?php echo $total_pedidos?></td>
			</tr>
			<tr>
			   <td colspan="2" id="pie_tabla"><a href="graficapedidosmes?anio=<?php echo date("Y")?>&mes=<?php echo date("m")?>">Ver más...</a></td>
			</tr>
		   </table>                  
                 </td>
		 <td id="espacio"></td>
		 <td>
                     <table border="0" cellspacing="0" cellpadding="0">
			<tr>
			   <td colspan="2" id="titulo_tabla">Facturación</td>
			</tr>
			<tr>
			   <td  id="detalle_img" rowspan="2"><img src="../../images/dashboard/facturacion.png"></td>
			   <td id="detalle_tex">Total Facturas: <?php echo $total_facturas?></td>
			</tr>			
			<tr>
			   <td id="detalle_tex">Monto Total Bs.: <?php echo number_format($monto_facturas,2,",",".")?></td>
			</tr>
			<tr>
			   <td colspan="2" id="pie_tabla"><a href="graficafacturacion?anio=<?php echo date("Y")?>&mes=<?php echo date("m")?>">Ver más...</a></td>
			</tr>
		   </table>                  
                 </td>
		 <td id="espacio"></td>
		 <td>
                     <table border="0" cellspacing="0" cellpadding="0">
			<tr>
			   <td colspan="2" id="titulo_tabla">Cuentas por Cobrar</td>
			</tr>
			<tr>
			   <td  id="detalle_img" rowspan="2"><img src="../../images/dashboard/facturacion1.png"></td>
			   <td id="detalle_tex">Facturas Pendientes: <?php echo $total_facturas_cuentaxcobrar?></td>
			</tr>			
			<tr>
			   <td id="detalle_tex">Monto Total Bs.: <?php echo number_format($monto_cuentaxcobrar,2,",",".")?></td>
			</tr>
			<tr>
			   <td colspan="2" id="pie_tabla"><a href="graficacuentaxcobrar?anio=<?php echo date("Y")?>&mes=<?php echo date("m")?>">Ver más...</a></td>
			</tr>
		   </table>                  
                 </td>
            </tr> 

	    <tr>
		<td colspan="4" id="titulo_reporte">Clientes con Mayor y Menor Facturación</td>
		<td colspan="3" id="titulo_reporte">Últimos Pedidos Facturados</td>
	    </tr>

	    <tr>                
                <td colspan="3">
                       <table id="" class="display" cellspacing="0" width="100%">
				<thead>
				    <tr>
					<th>C.I/R.I.F Cliente</th>
					<th>Nombre</th>
					<th>Total Facturas</th>
					<th>Monto</th>
				     </tr>
				</thead>				
				<tbody>
					<?php
					foreach ($arr_cmmf as $value_cmmf)
					{
					?>
					<tr>
					    <td><?php echo $value_cmmf[0]?></td>
					    <td><?php echo $value_cmmf[1]?></td>
					    <td style="text-align: center;"><?php echo $value_cmmf[2]?></td>
					    <td><?php echo number_format($value_cmmf[3],2,",",".")?></td>						
					</tr>
					<?php
					}
					?>					
				</tbody>
				<tr><td clospan="4"><a href="graficaclientesmayormenosfac?anio=<?php echo date("Y")?>&mes=<?php echo date("m")?>">Ver más...</a></td></tr>
			</table>              
                 </td>
		 <td id="espacio"></td>
		 <td colspan="3">
                         <table id="" class="display" cellspacing="0" width="100%">
				<thead>
				    <tr>
					<th>Número</th>
					<th>Fecha de Emisión</th>
					<th>C.I/R.I.F Cliente</th>
					<th>Nombre</th>
					<th>Monto</th>
				     </tr>
				</thead>				
				<tbody>
					<?php
					foreach ($arr_upf as $value_upf)
					{
					?>
					<tr style="text-align: center;">
					    <td><?php echo $value_upf[0]?></td>
					    <td><?php echo $value_upf[1]?></td>
					    <td><?php echo $value_upf[2]?></td> 
					    <td><?php echo $value_upf[3]?></td>
					    <td><?php echo number_format($value_upf[4],2,",",".")?>
					    </td>						
					</tr>
					<?php
					}
					?>					
				</tbody>
				<tr><td clospan="5"></td></tr>
			</table>         
                 </td>		 
            </tr>     

	    <tr>
		<td colspan="4" id="titulo_reporte">Productos más Vendidos</td>
		<td colspan="3" id="titulo_reporte">Vendedores con más Ventas</td>
	    </tr>

	    <tr>                
                <td colspan="3">
                       <table id="" class="display" cellspacing="0" width="100%">
				<thead>
				    <tr>
					<th>Código</th>
					<th>Descripción</th>
					<th>Cantidad Vendida</th>
				     </tr>
				</thead>				
				<tbody>
					<?php
					foreach ($arr_pmv as $value_pmv)
					{
					?>
					<tr>
					    <td><?php echo $value_pmv[0]?></td>
					    <td><?php echo $value_pmv[1]?></td>
					    <td style="text-align: center;"><?php echo $value_pmv[2]?></td>
					</tr>
					<?php
					}
					?>					
				</tbody>
				<tr><td clospan="5"><a href="graficaventaproductos?anio=<?php echo date("Y")?>&mes=<?php echo date("m")?>">Ver más...</a></td></tr>
			</table>              
                 </td>
		 <td id="espacio"></td>
		 <td colspan="3">
                         <table id="" class="display" cellspacing="0" width="100%">
				<thead>
				    <tr>
					<th>Vendedor</th>
					<th>Cantidad Facturada</th>					
					<th>Monto Total</th>
				     </tr>
				</thead>				
				<tbody>
					<?php
					foreach ($arr_vmf as $value_vmf)
					{
					?>
					<tr style="text-align: center;">
					    <td><?php echo $value_vmf[0]?></td>
					    <td><?php echo $value_vmf[1]?></td>
					    <td><?php echo number_format($value_vmf[2],2,",",".")?>
					    </td>						
					</tr>
					<?php
					}
					?>					
				</tbody>
				<tr><td clospan="5"><a href="graficavendedoresmes?anio=<?php echo date("Y")?>&mes=<?php echo date("m")?>">Ver más...</a></td></tr>
			</table>         
                 </td>		 
            </tr>      
        </table>		
