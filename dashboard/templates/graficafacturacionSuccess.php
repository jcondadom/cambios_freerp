
	<script type="text/javascript" language="javascript" class="init">
	$(document).ready(function() {
		$('table.display').DataTable({
		    "bPaginate": true,
		    "bFilter": true,
		    "pageLength": 10,
		    "lengthChange": true,
			language: {
				url: '../../js/vendedores/data_table/es.json'
			    }
		});
		$("#buscar").click(function(){
		    var anio = $("#anio").val();
		    var mes = $("#mes").val();
		    url = "graficafacturacion?anio="+anio+"&mes="+mes;
      		   $(location).attr("href", url);
		});
	} );
	</script>     
	<?php 
	if (isset($_GET['anio']))
	{
		$anio=$_GET['anio'];
	}
	else
	{
		$anio=date("Y");
	}
 	if (isset($_GET['mes']))
	{
		$mes=$_GET['mes'];
	}
	else
	{
		$mes=date("m");
	} ?>  
	<div id="titulo_grafico">ESTADISTICA DE FACTURACIÓN HASTA EL MES DE <?php echo strtoupper(sfGraphics::NombreMes($mes))?></div>
	<div id="tabla_detalle">
	<table class="dataTable" style="width: 100%">
		<thead>
		    <tr>
			<th>Mes</th>
			<th>Monto Total Bs.</th>
			<th>Cantidad</th>
			<th>% de Variación</th>					
		     </tr>
		<thead>
		<tbody>
			<?php
			foreach ($arreglo_tab as $lista)
			{
			?>
			<tr>
			    <td style="text-align: center"><?php echo sfGraphics::NombreMes($lista['0'])?></td>
			    <td style="text-align: center"><?php echo number_format($lista['1'],2,",",".")?></td>
			    <td style="text-align: center"><?php echo $lista['2']?></td>
			    <td style="text-align: center"><?php // echo $valuet[3]?></td>
			</tr>
			<?php
			}
			?>				
		</tbody>
	</table> 
	</div>
	<div style="margin: 0 0 0 250px;">
	<table>
	    <tr>
		<td>

	    	</td>
	    </tr>
            <tr>                
                <td>
                    <?php
                    if (isset ($grafica))
                    {
                        echo sfGraphics::unhtmlentities($grafica);                                                
                    }
                    ?>                    
                 </td>		 
            </tr>
	    <?php if (count($arr)>0){?>
	    <tr><td id="titulo_tb">LISTADO DE FACTURAS REGISTRADAS DURANTE EL EJERCICIO FISCAL</td></tr>
	    <tr><td>
		<div id="incluir_filtro" style="margin: 0 0 0 450px;">	
			<?php include_partial('dashboard/filtro', array('anio' => $anio, 'mes' => $mes)) ?>
		</div>
	    </td></tr>
	    <tr>
		<td style="margin: 0 0 0 100px;">	
                       <table id="" class="display" cellspacing="0" width="100%">
				<thead>
				    <tr>
					<th>Fecha de la Factura</th>
					<th>Número</th>
					<th>R.I.F</th>
					<th>Nombre</th>					
					<th>Monto</th>
				     </tr>
				</thead>				
				<tbody>
					<?php
					foreach ($arr as $value)
					{
					?>
					<tr>
					    <td style="text-align: center"><?php echo sfGraphics::CamFormFech($value[0])?></td>
					    <td><?php echo $value[1]?></td>
					    <td><?php echo $value[2]?></td>
					    <td><?php echo $value[3]?></td>
					    <td><?php echo number_format($value[4],2,",",".")?></td>
					</tr>
					<?php
					}
					?>					
				</tbody>
			</table>              
                 </td>
	      </tr>
       	      <?php }?>
        </table>
	</div>
