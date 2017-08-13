<?php
$cc = new Criteria();
$cc->add(VendedoresPeer::ID,$fapedido->getVendedoresId());
$resultadoc = VendedoresPeer::doSelect($cc);
echo $resultadoc['0'];
?>
