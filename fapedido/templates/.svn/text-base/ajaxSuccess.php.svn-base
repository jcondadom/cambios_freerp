<?php

?>

<?php use_helper('Object', 'Validation', 'ObjectAdmin', 'I18N', 'Date', 'Grid', 'Javascript') ?>
<?php if($ajaxs=='5') { if(count($precios)!=0) {
  echo options_for_select($precios,'','include_custom=Seleccione...');
} else{
echo options_for_select($precios,'');
}?>
<?php } else if($ajaxs=='8') {?>
<?php echo select_tag('fapedido[codciu]', options_for_select(OcciudadPeer::ObtenerCiudades($fapedido->getCodedo(),$fapedido->getCodpai()),$fapedido->getCodciu(),'include_custom=Seleccione'),array(
	'onChange'=> remote_function(array(
		'update'   => 'divMunicipio',
		'url'      => 'fapedido/ajax?ajax=9',
		'complete' => 'AjaxJSON(request, json)',
        'condition' => "$('fapedido_codciu').value != '' && $('id').value == ''",
		'with' => "'estado='+$('fapedido_codedo').value+'&pais='+$('fapedido_codpai').value+'&codigo='+this.value"
  ))));?>
<?php } else if($ajaxs=='9') {?>
<?php echo select_tag('fapedido[codmun]', options_for_select(OcmuniciPeer::ObtenerMunicipios($fapedido->getCodciu(),$fapedido->getCodedo(),$fapedido->getCodpai()),$fapedido->getCodmun(),'include_custom=Seleccione'),array(
	'onChange'=> remote_function(array(
		'update'   => 'divParroquia',
		'url'      => 'fapedido/ajax?ajax=10',
		'complete' => 'AjaxJSON(request, json)',
        'condition' => "$('fapedido_codmun').value != '' && $('id').value == ''",
		'with' => "'ciudad='+$('fapedido_codciu').value+'&estado='+$('fapedido_codedo').value+'&pais='+$('fapedido_codpai').value+'&codigo='+this.value"
  ))));?>
<?php } else if($ajaxs=='10') {?>
<?php echo select_tag('fapedido[codpar]', options_for_select(OcparroqPeer::ObtenerParroquias($fapedido->getCodmun(),$fapedido->getCodedo(),$fapedido->getCodpai()),$fapedido->getCodpar(),'include_custom=Seleccione'),array(
	));?>
<?php } else if($ajaxs=='12') {?>	
<?php $value = get_partial('grid_fargoped', array('fapedido' => $fapedido)); echo $value ? $value : '&nbsp;'; ?>
<?php }else{ ?>
<?php $value = get_partial('grid', array('fapedido' => $fapedido)); echo $value ? $value : '&nbsp;'; ?>
<?php }?>