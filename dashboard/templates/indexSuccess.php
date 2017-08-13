	<table>
            <tr>                
                <td>
                    <?php
                    if (isset ($grafica_pedidos_pendientes))
                    {
                        echo sfGraphics::unhtmlentities($grafica_pedidos_pendientes);                                                
                    }
                    ?>                    
                 </td>
		 <td>
                    <?php
                    if (isset ($grafica_vendedores_facturacion))
                    {
                        echo sfGraphics::unhtmlentities($grafica_vendedores_facturacion);                                                
                    }
                    ?>                    
                 </td>
            </tr>
            <tr>                
                <td>
                    <?php
                    if (isset ($grafica_clientes_cuentasxcobrar))
                    {
                        echo sfGraphics::unhtmlentities($grafica_clientes_cuentasxcobrar);                                                
                    }
                    ?>                    
                 </td>
		 <td>
                    <?php
                    if (isset ($grafica_radar_ventas_producto))
                    {
                        echo sfGraphics::unhtmlentities($grafica_radar_ventas_producto);                                                
                    }
                    ?>                       
                 </td>
            </tr>
        </table>
