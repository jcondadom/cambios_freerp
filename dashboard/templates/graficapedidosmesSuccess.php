
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
		    url = "graficapedidosmes?anio="+anio+"&mes="+mes;
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
	<div id="titulo_grafico">ESTADÍSTICA DE PEDIDOS PENDIENTES DEL MES <?php echo strtoupper(sfGraphics::NombreMes($mes))?></div>
	<div id="incluir_filtro" style="margin: 0 0 0 450px;">	
		<?php include_partial('dashboard/filtro', array('anio' => $anio, 'mes' => $mes)) ?>
	</div>
	<div style="margin: 0 0 0 200px;">	
	<table>
            <tr>                
                <td>
                    <?php
                    if (isset ($grafica_clientes_registrados))
                    {
                        echo sfGraphics::unhtmlentities($grafica_clientes_registrados);                                                
                    }
                    ?>                    
                 </td>		 
            </tr>
	    <?php if (count($arr)>0){?>
	    <tr><td id="titulo_tb">LISTADO DE PEDIDOS DURANTE EL EJERCICIO FISCAL</td></tr>
	    <tr>
		<td style="margin: 0 0 0 100px;">	
                       <table id="" class="display" cellspacing="0" width="100%">
				<thead>
				    <tr>
					<th>Fecha de Registro</th>
					<th>R.I.F</th>
					<th>Nombre</th>
					<th>Teléfono</th>
					<th>Persona de Contacto</th>
				     </tr>
				</thead>				
				<tbody>
					<?php
					foreach ($arr as $value)
					{
					?>
					<tr>
					    <td><?php echo sfGraphics::CamFormFech($value[0])?></td>
					    <td><?php echo $value[1]?></td>
					    <td><?php echo $value[2]?></td>
					    <td><?php echo $value[3]?></td>
					    <td><?php echo $value[4]?></td>
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
