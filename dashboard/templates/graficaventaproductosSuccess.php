
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
		    url = "graficaventaproductos?anio="+anio+"&mes="+mes;
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
	<div id="titulo_grafico">ESTADÍSTICA DE VENTAS POR PRODUCTOS</div>
	<div id="incluir_filtro" style="margin: 0 0 0 450px;">	
		<?php include_partial('dashboard/filtro', array('anio' => $anio, 'mes' => $mes)) ?>
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
	    <tr><td id="titulo_tb">LISTADO PRODUCTOS MÁS Y MENOS VENDIDOS EN EL EJERCICIO FISCAL</td></tr>
	    <tr>
		<td style="margin: 0 0 0 100px;">	
                       <table id="" class="display" cellspacing="0" width="100%">
				<thead>
				    <tr>
					<th>Número</th>			
					<th>Código</th>
					<th>Descripción</th>					
					<th>Cantidad Facturada</th>
					<th>Monto Total</th>
				     </tr>
				</thead>				
				<tbody>
					<?php $tot_reg = 1;
					foreach ($arr as $value)
					{
					?>
					<tr>
					    <td><?php echo $tot_reg?></td>
					    <td><?php echo $value[0]?></td>
					    <td><?php echo $value[1]?></td>
					    <td style="text-align: center"><?php echo $value[2]?></td>
					    <td style="text-align: center"><?php echo number_format($value[3],2,",",".")?></td>
					</tr>
					<?php $tot_reg++;
					}
					?>					
				</tbody>
			</table>              
                 </td>
	      </tr>
       	      <?php }?>
        </table>
	</div>
