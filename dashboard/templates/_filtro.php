<table>
   <tr>
	<td>AÑO: </td>
	<td>
	   <select id="anio" name="anio">
		<?php
		for ($i=date("Y");$i>2009;$i--)
		{
			if ($anio==$i)
			{
			?>
	   			<option value="<?php echo $i?>" selected><?php echo $i?></option>	   	
		<?php   }else{
		?>
	   		        <option value="<?php echo $i?>"><?php echo $i?></option>
		<?php
			}
		}
		?>
	   </select>
	</td>
	<td>MES: </td>
	<td>
	   <select id="mes" name="mes">
		<?php
		for ($i=1;$i<=12;$i++)
		{
			if ($mes==$i)
			{
			?>
	   			<option value="<?php echo $i?>" selected><?php echo sfGraphics::NombreMes($i)?></option>	   	
		<?php   }else{
		?>
	   		        <option value="<?php echo $i?>"><?php echo sfGraphics::NombreMes($i)?></option>
		<?php
			}
		}
		?>
	   </select>
	</td>
	<td id="espacio"></td>
	<td><input type="button" value="Buscar" id="buscar" /> </td>
   </tr>
</table>
