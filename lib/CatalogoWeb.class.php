<?php

/**
 * CatalogoWeb: Clase que para el manejo de los catálogos
 *
 * @package    Roraima
 * @subpackage lib
 * @author     $Author$ <desarrollo@cidesa.com.ve>
 * @version SVN: $Id$
 *
 * @copyright  Copyright 2007, Cide S.A.
 * @license    http://opensource.org/licenses/gpl-2.0.php GPLv2
 */
class CatalogoWeb extends BaseCatalogoWeb {

    public function Caordcom_Almajuoc($params = array()) {

        $this->c = new Criteria();
        $this->c->add(CaordcomPeer :: STAORD, 'N', Criteria::NOT_EQUAL);
        if (count($params) > 0)
            $this->c->add(CaordcomPeer :: ORDCOM, $params[0]);
        $this->c->addJoin(CaordcomPeer :: ORDCOM, CaartordPeer :: ORDCOM);
        $this->sql = "Caartord.canord - Caartord.canaju <> Caartord.canrec ";
        $this->c->add(CaartordPeer :: CANORD, $this->sql, Criteria :: CUSTOM);
        $this->c->setDistinct();

        $this->columnas = array(
            CaordcomPeer :: ORDCOM => 'Código',
            CaordcomPeer :: FECORD => 'Fecha',
            CaordcomPeer :: DESORD => 'Descripción'
        );
    }

    /*     * ******************************Registro Articulos*********************************************** */

    public function Caramart_Almregart() {
        $this->c = new Criteria();
        // $this->c->addAscendingOrderByColumn(CaramartPeer::RAMART);

        $this->columnas = array(
            CaramartPeer :: RAMART => 'Código',
            CaramartPeer :: NOMRAM => 'Ramo',
        );
    }

    public function Nppartidas_Almregart() {
        $this->c = new Criteria();
        $this->c->clearSelectColumns();
        $this->c->addSelectColumn(NppartidasPeer::CODPAR);
        $this->c->addSelectColumn(NppartidasPeer::NOMPAR);
        $this->c->addSelectColumn("'' as ID");
        $this->c->addGroupByColumn(NppartidasPeer::CODPAR);
        $this->c->addGroupByColumn(NppartidasPeer::NOMPAR);

        $this->columnas = array(
            NppartidasPeer::CODPAR => 'Codigo',
            NppartidasPeer::NOMPAR => 'Descripcion');
    }

    /*     * ********************************************************************************************** */

    public function NconceptosCat_Asignar() {
        $this->c = new Criteria();
        $mascara = Herramientas::getObtener_FormatoCategoria();
        $mask = strlen($mascara);
        $this->c = new Criteria();
        $this->sql = "length(npcatpre.CodCat) = '" . $mask . "'";
        $categoriasusu = sfContext::getInstance()->getUser()->getAttribute('categoriasusu');
        if ($categoriasusu != '') {
            $aux = explode('*', $categoriasusu);
            for ($a = 0; $a < count($aux); $a++) {
                if ($a == 0)
                    $this->sql = $this->sql . " and (" . NpcatprePeer::CODCAT . " like '" . $aux[$a] . "%' ";
                else if ($a == (count($aux) - 1))
                    $this->sql = $this->sql . " or " . NpcatprePeer::CODCAT . " like '" . $aux[$a] . "%' ";
                else
                    $this->sql = $this->sql . " or " . NpcatprePeer::CODCAT . " like '" . $aux[$a] . "%'";
            }
            $this->sql = $this->sql . ")";
        }
        $this->c->add(NpcatprePeer :: CODCAT, $this->sql, Criteria :: CUSTOM);

        $this->columnas = array(
            NpcatprePeer :: CODCAT => 'Código',
            NpcatprePeer :: NOMCAT => 'Descripción',
        );
    }

    /*     * ******************************Definicion de Recaudos*********************************************** */

    public function Catiprec_Almregrec() {
        $this->c = new Criteria();
        //  $this->c->addAscendingOrderByColumn(CatiprecPeer::CODTIPREC);

        $this->columnas = array(
            CatiprecPeer :: CODTIPREC => 'Código',
            CatiprecPeer :: DESTIPREC => 'Descripción',
        );
    }

    /*     * ********************************************************************************************** */

    /*     * ******************************Edicion de Servicios*********************************************** */
    /*     * *****                             Catalogo del Grid                                       ******* */

    public function Caretser_Almretser() {
        $this->c = new Criteria();
        /* $this->c->add(OptipretPeer::DESTIP);
          $this->c->add(OptipretPeer::CODTIP); */
        //   $this->c->addAscendingOrderByColumn(OptipretPeer::CODTIP);
        $this->maxlist = 10;

        $this->columnas = array(
            OptipretPeer :: CODTIP => 'Código',
            OptipretPeer :: DESTIP => 'Descripción',
        );
    }

    public function Caregart_Almretser($params = array()) {
        $longitud = $params[0];
        $this->c = new Criteria();
        $this->c->add(CaregartPeer :: TIPO, 'S');
        $this->sql = "length(Codart) = '" . $longitud . "'";
        $this->c->add(CaregartPeer :: CODART, $this->sql, Criteria :: CUSTOM);

        $this->columnas = array(
            CaregartPeer :: CODART => 'Código',
            CaregartPeer :: DESART => 'Descripción',
            CaregartPeer :: CODBAR => 'Código Barra'
        );
    }

    /*     * ********************************************************************************************** */

    /*     * *******************   Definición del IVA para Agentes de Retención ******************** */

    public function Optipret_Pagretiva() {
        $this->c = new Criteria();
        //    $this->c->addAscendingOrderByColumn(OptipretPeer::CODTIP);
        $this->maxlist = 10;

        $this->columnas = array(
            OptipretPeer :: CODTIP => 'Código',
            OptipretPeer :: DESTIP => 'Descripción',
        );
    }

    public function Optipret_Carecarg() {
        $this->c = new Criteria();
        //    $this->c->addAscendingOrderByColumn(CarecargPeer::CODRGO);
        $this->maxlist = 10;

        //$this->columnas = array (CARecargPeer::CODRGO => 'Código', CARecargPeer::NOMRGO => 'Descripción',);
        $this->columnas = array(
            CarecargPeer :: CODRGO => 'Código',
            CarecargPeer :: NOMRGO => 'Descripción',
            CarecargPeer :: MONRGO => 'Monto Recargo',
            CarecargPeer :: TIPRGO => 'Tipo Recargo',
            CarecargPeer :: CODPRE => 'Cod. Presupuestario',
        );
    }

    /*     * *************************************************************************************** */

    /*     * ***************************Tipo de Retenciones********************************** */

    public function Contabb_Pagtipret() {
        $a = new Criteria();
        $reg = ContabaPeer :: doSelectOne($a);
        if ($reg) {
            $cuentaretencion = $reg->getCodctaret();
            $cuentaretencionhasta = $reg->getCodctarethas();
        } else {
            $cuentaretencion = "";
            $cuentaretencionhasta = "";
        }

        if ($cuentaretencion != "" && $cuentaretencionhasta != "") {
            $this->c = new Criteria();
            $this->c->add(ContabbPeer :: CARGAB, 'C');
            $this->c->add(ContabbPeer :: CODCTA, $cuentaretencion, Criteria :: GREATER_EQUAL);
            $this->c->add(ContabbPeer :: CODCTA, $cuentaretencionhasta, Criteria :: LESS_EQUAL);
            //    $this->c->addAscendingOrderByColumn(ContabbPeer::CODCTA);
        } else {
            $this->c = new Criteria();
            $this->c->add(ContabbPeer :: CARGAB, 'C');
            $this->c->add(ContabbPeer :: CODCTA, $cuentaretencion . '%', Criteria :: LIKE);
            //  $this->c->addAscendingOrderByColumn(ContabbPeer::CODCTA);
        }

        $this->columnas = array(
            ContabbPeer :: DESCTA => 'Descripción',
            ContabbPeer :: CODCTA => 'Código',
            ContabbPeer :: CARGAB => 'Cargable',
        );
    }

    /*     * ******************************************************************************** */

    /*     * *******************   Definición del IVA para Agentes de Retención ******************** */

    public function Fordefgen_Nppartidas() {
        $this->c = new Criteria();
        $this->maxlist = 10;

        $this->columnas = array(
            NppartidasPeer :: CODPAR => 'Código',
            NppartidasPeer :: NOMPAR => 'Descripción',
        );
    }

    /*     * *************************************************************************************** */

    /*     * ***********************Ordenes de Pago*********************************************** */

    public function Contabb_Pagemiord($params = array()) {

        $benvarcta = H::getConfApp2('benvarcta', 'tesoreria', 'pagbenfic');
        $this->c = new Criteria();

        $this->c->add(ContabbPeer :: CARGAB, 'C');
        if (count($params) > 0 && $benvarcta == 'S') {
            if ($params[0] != "") {
                $this->c->add(OpctabenPeer :: CEDRIF, $params[0]);
                $this->c->addJoin(ContabbPeer :: CODCTA, OpctabenPeer::CODCTA);
            }
        }



        //   $this->c->addAscendingOrderByColumn(ContabbPeer::CODCTA);

        $this->columnas = array(
            ContabbPeer :: CODCTA => 'Código',
            ContabbPeer :: DESCTA => 'Descripción',
        );
    }

    public function Opbenefi_Pagemiord() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(OpbenefiPeer::CEDRIF);

        $this->columnas = array(
            OpbenefiPeer :: CEDRIF => 'Cédula o RIF',
            OpbenefiPeer :: NOMBEN => 'Nombre',
            OpbenefiPeer :: CODCTA => 'Cuenta',
        );
    }

    public function Cpdoccau_Pagemiord() {
        $this->c = new Criteria();
        //  $this->c->addAscendingOrderByColumn(CpdoccauPeer::TIPCAU);

        $this->columnas = array(
            CpdoccauPeer :: TIPCAU => 'Código',
            CpdoccauPeer :: NOMEXT => 'Descripción',
        );
    }

    public function Fortipfin_Pagemiord() {
        $this->c = new Criteria();
        //   $this->c->addAscendingOrderByColumn(FortipfinPeer::CODFIN);

        $this->columnas = array(
            FortipfinPeer :: CODFIN => 'Código',
            FortipfinPeer :: NOMEXT => 'Descripción',
        );
    }

    public function Bnubica_Pagemiord($mascara = array()) {

        $this->c = new Criteria();
        if (count($mascara) > 0) {
            $mask = $mascara[0];
            $this->sql = "length(Codubi) = '" . $mask . "'";
            $this->c->add(BnubicaPeer :: CODUBI, $this->sql, Criteria :: CUSTOM);
        }

        $this->columnas = array(
            BnubicaPeer :: CODUBI => 'Código',
            BnubicaPeer :: DESUBI => 'Descripción',
            BnubicaPeer :: STACOD => 'Estatus',
        );
    }

    public function Optipret_Pagemiret($proveedor = array()) {
        $filretpro = "";
        $varemp = sfContext::getInstance()->getUser()->getAttribute('configemp');
        if ($varemp)
            $filretpro = H::getConfApp('filretpro', 'tesoreria', 'pagemiord');

        $this->c = new Criteria();
        if ($filretpro == 'S' && count($proveedor) > 0) {
            $provee = $proveedor[0];
            $codpro = H::getX_vacio('RIFPRO', 'Caprovee', 'CODPRO', $provee);
            if ($codpro != "") {
                $this->sql = "optipret.codtip in (select codret from caproret where codpro='" . $codpro . "')";
                $this->c->add(OptipretPeer :: CODTIP, $this->sql, Criteria :: CUSTOM);
            }
        }

        $this->c->addAscendingOrderByColumn(OptipretPeer::CODTIP);

        $this->columnas = array(
            OptipretPeer :: CODTIP => 'Código',
            OptipretPeer :: DESTIP => 'Descripción',
            OptipretPeer :: CODCON => 'Cta. Contable',
            OptipretPeer :: BASIMP => 'Base Imponible',
            OptipretPeer :: PORRET => '% Retencion',
            OptipretPeer :: FACTOR => 'Factor',
            OptipretPeer :: PORSUS => '% Sustraendo',
            OptipretPeer :: UNITRI => 'Unidad'
        );
    }

    public function Cpprecom_Pagemiord() {
        $this->c = new Criteria();
        $this->sql = "cpprecom.staprc <>'N'  and (Select Sum(monimp-monaju) as monprc from cpimpprc where refprc=cpprecom.refprc) > (Select Sum(moncau) as moncau from cpimpprc where refprc=cpprecom.refprc)";

        $this->c->add(CpprecomPeer :: STAPRC, $this->sql, Criteria :: CUSTOM);

        $this->columnas = array(
            CpprecomPeer :: TIPPRC => 'Tipo',
            CpprecomPeer :: REFPRC => 'Referencia',
            CpprecomPeer :: FECPRC => 'Fecha',
            CpprecomPeer :: DESPRC => 'Descripción'
        );
    }

    public function Cpcompro_Pagemiord() {
        $loguse= sfContext::getInstance()->getUser()->getAttribute('loguse');
        $filsoldir3=H::getConfApp2('filsoldir', 'presupuesto', 'preprecom');

        $this->sql = "cpcompro.stacom <>'N'  and (Select Sum(monimp-monaju) as moncom from cpimpcom where refcom=cpcompro.refcom) > (Select Sum(moncau) as moncau from cpimpcom where refcom=cpcompro.refcom) and ((cpdoccom.reqaut = 'S' and cpcompro.aprcom = 'S') or (cpdoccom.reqaut = 'N' and cpcompro.aprcom = 'S') or (('S' in (select comreqapr from cadefart)) and cpcompro.aprcom = 'S'))";
         if ($filsoldir3=='S')
            $this->sql.=' and cpcompro.coddirec in (select coddirec from "SIMA_USER".segdirusu where loguse=\''.$loguse.'\')';

        $this->c = new Criteria();
        $this->c->addJoin(CpcomproPeer :: TIPCOM, CpdoccomPeer :: TIPCOM);
        /* $a = new Criteria();
          $dato = CadefartPeer :: doSelectOne($a);
          if ($dato) {
          if ($dato->getComreqapr() == 'S') {
          $this->c->add(CpcomproPeer :: APRCOM, 'S');
          }
          } */
        $this->c->add(CpcomproPeer :: STACOM, $this->sql, Criteria :: CUSTOM);


        $this->columnas = array(
            CpcomproPeer :: TIPCOM => 'Tipo',
            CpcomproPeer :: REFCOM => 'Referencia',
            CpcomproPeer :: FECCOM => 'Fecha',
            CpcomproPeer :: DESCOM => 'Descripción',
            CpcomproPeer :: CEDRIF => 'Ced/Rif Beneficiario',
        );
    }

    /*     * ************************************************************************************* */

    /*     * ********************************Solicitud de Egresos********************************* */

    public function Npcatpre_Almsolegr($mascara=array()) {
        //Cambios Solicitado por Monagas
        $fornumuni = "";
        $varemp = sfContext::getInstance()->getUser()->getAttribute('configemp');
        if ($varemp)
            if (array_key_exists('aplicacion', $varemp))
                if (array_key_exists('compras', $varemp['aplicacion']))
                    if (array_key_exists('modulos', $varemp['aplicacion']['compras']))
                        if (array_key_exists('almsolegr', $varemp['aplicacion']['compras']['modulos'])) {
                            if (array_key_exists('fornumuni', $varemp['aplicacion']['compras']['modulos']['almsolegr'])) {
                                $fornumuni = $varemp['aplicacion']['compras']['modulos']['almsolegr']['fornumuni'];
                            }
                        }
        $loguse = sfContext::getInstance()->getUser()->getAttribute('loguse');

        if (array_key_exists('1', $mascara))
            $mask2 = $mascara[1];
        else
            $mask2 = "";


        $mask = $mascara[0];
        $this->c = new Criteria();
        if ($fornumuni == 'S' && $mask2 == 'almsolegr') {
            $this->sql = "length(npcatpre.codcat) = '" . $mask . "' and npcatpre.codcat in (select codcat from causuuni where loguse='" . $loguse . "')";
        } else {
            $this->sql = "length(CodCat) = '" . $mask . "'";
        }

        $categoriasusu = sfContext::getInstance()->getUser()->getAttribute('categoriasusu');
        if ($categoriasusu != '') {
            $aux = explode('*', $categoriasusu);
            for ($a = 0; $a < count($aux); $a++) {
                if ($a == 0)
                    $this->sql = $this->sql . " and (" . NpcatprePeer::CODCAT . " like '" . $aux[$a] . "%' ";
                else if ($a == (count($aux) - 1))
                    $this->sql = $this->sql . " or " . NpcatprePeer::CODCAT . " like '" . $aux[$a] . "%' ";
                else
                    $this->sql = $this->sql . " or " . NpcatprePeer::CODCAT . " like '" . $aux[$a] . "%'";
            }
            $this->sql = $this->sql . ")";
        }
        $this->c->add(NpcatprePeer :: CODCAT, $this->sql, Criteria :: CUSTOM);
        //   $this->c->addAscendingOrderByColumn(NpcatprePeer::CODCAT);

        $this->columnas = array(
            NpcatprePeer :: CODCAT => 'Código',
            NpcatprePeer :: NOMCAT => 'Descripción'
        );
    }

    public function Npcatpre_Categoriaxemp() {

        $this->c = new Criteria();
        $this->columnas = array(
            NpcatprePeer :: CODCAT => 'Código',
            NpcatprePeer :: NOMCAT => 'Descripción'
        );
    }

    public function Fortipfin_Almsolegr($params=array()) {
        $this->c = new Criteria();
        $finpre=H::getConfApp2('finpre', 'compras', 'almsolegr');
        if ($finpre=='S'){
            if (count($params) > 0) {
                if ($params[0] != "") {
                    $this->c->add(CpdisfuefinPeer::CODPRE, $params[0]);
                    $this->c->add(CpdisfuefinPeer::ORIGEN,'INICIAL');
                    $this->c->addJoin(FortipfinPeer::CODFIN, CpdisfuefinPeer::FUEFIN);
                }
            }
        }
        //   $this->c->addAscendingOrderByColumn(FortipfinPeer::CODFIN);

        $this->columnas = array(
            FortipfinPeer :: CODFIN => 'Código',
            FortipfinPeer :: NOMEXT => 'Descripción',
        );
    }

    /*     * ************************************************************************************* */

    public function Cotizaciones($params = array()) {
        $filprosol = H::getConfApp2('filprosol', 'compras', 'almcotiza');
        $this->c = new Criteria();
        if ($filprosol == 'S') {
            $reqart = $params[0];
            $sql = "caprovee.estpro='A' and caprovee.codpro in (select a.codpro from cadetsolcot a, casolcot b where a.numsolcot=b.numsolcot and b.reqart='" . $reqart . "')";
            $this->c->add(CaproveePeer::ESTPRO, $sql, Criteria::CUSTOM);
        }
        else
            $this->c->add(CaproveePeer::ESTPRO, 'A');


        $this->columnas = array(
            CaproveePeer :: RIFPRO => 'Código',
            CaproveePeer :: NOMPRO => 'Descripción',
            CaproveePeer :: CODPRO => 'Codigo'
        );
    }

    /*     * ******************************** Registro de Proveedores ******************************** */

    public function Caramart_Almregpro() {
        $this->c = new Criteria();
        //   $this->c->addAscendingOrderByColumn(CaramartPeer::RAMART);

        $this->columnas = array(
            CaramartPeer :: NOMRAM => 'Descripción',
            CaramartPeer :: RAMART => 'Código',
        );
    }

    public function Contabb_Almregpro() {

        $sql = "Select codctaben,codctabenhas from Contaba";
        $result = array();

        if (Herramientas :: BuscarDatos($sql, $result)) {
            $CuentaProvee = $result[0]['codctaben'];
            $CuentaProveeHASTA = $result[0]['codctabenhas'];
        } else {
            $CuentaProvee = "";
            $CuentaProveeHASTA = "";
        }

        if (trim($CuentaProvee) != "" and trim($CuentaProveeHASTA) != "") {
            $this->c = new Criteria();
            $this->c->add(ContabbPeer :: CARGAB, 'C');
            $this->c->add(ContabbPeer :: CODCTA, ContabbPeer :: CODCTA . " between '{$CuentaProvee}' AND '{$CuentaProveeHASTA}'", Criteria :: CUSTOM);
            //     $this->c->addAscendingOrderByColumn(ContabbPeer :: DESCTA);
        } else {
            $this->c = new Criteria();
            $this->c->add(ContabbPeer :: CARGAB, 'C');
            $this->c->add(ContabbPeer :: CODCTA, $CuentaProvee . '%', Criteria :: LIKE);
            //      $this->c->addAscendingOrderByColumn(ContabbPeer :: DESCTA);
        }

        $this->columnas = array(
            ContabbPeer :: DESCTA => 'Descripción',
            ContabbPeer :: CODCTA => 'Código',
        );
    }

    public function Catiprec_Almregpro() {
        $this->c = new Criteria();
        //    $this->c->addAscendingOrderByColumn(CatiprecPeer::CODTIPREC);

        $this->columnas = array(
            CatiprecPeer :: DESTIPREC => 'Descripción',
            CatiprecPeer :: CODTIPREC => 'Código',
        );
    }

    /*     * *******************************Edicion de Recargos********************************* */

    public function Cpdeftit_Almregrgo($mascara) {

        $mask = $mascara[0];
        $this->c = new Criteria();
        $this->sql = "length(Codpre) = '" . $mask . "'";
        $this->c->add(CpdeftitPeer :: CODPRE, $this->sql, Criteria :: CUSTOM);
        //      $this->c->addAscendingOrderByColumn(CpdeftitPeer::CODPRE);

        $this->columnas = array(
            CpdeftitPeer :: CODPRE => 'Código',
            CpdeftitPeer :: NOMPRE => 'Nombre'
        );
    }

    public function Nppartidas_Almregrgo() {
        $this->c = new Criteria;
        //     $this->c->addAscendingOrderByColumn(NppartidasPeer::CODPAR);
        $this->columnas = array(
            NppartidasPeer :: CODPAR => 'Código',
            NppartidasPeer :: NOMPAR => 'Nombre'
        );
    }

    public function Contabb_Almregrgo() {

        $this->c = new Criteria;
        //      $this->c->addAscendingOrderByColumn(ContabbPeer::CODCTA);
        $this->c->add(ContabbPeer :: CARGAB, 'C');
        $this->columnas = array(
            ContabbPeer :: DESCTA => 'Nombre',
            ContabbPeer :: CODCTA => 'Código'
        );
    }

    /*     * ************************************************************************************* */

    /*     * ******************************Emisión de Cheques*********************************************** */

    public function Cpdocpag_Tesmovemiche() {
        $this->c = new Criteria();
        //$this->c->addAscendingOrderByColumn(CpdocpagPeer::TIPPAG);

        $this->columnas = array(
            CpdocpagPeer :: TIPPAG => 'Tipo',
            CpdocpagPeer :: NOMEXT => 'Descripción',
            CpdocpagPeer :: REFIER => 'Refiere',
            CpdocpagPeer :: AFEPRC => 'Afe. Precom.',
            CpdocpagPeer :: AFECOM => 'Afe. Comp',
            CpdocpagPeer :: AFECAU => 'Afe. Cau.',
            CpdocpagPeer :: AFEPAG => 'Afe. Pag.',
            CpdocpagPeer :: AFEDIS => 'Afe. Dis.'
        );
    }

    public function Tsdefban_Tesmovemiche() {

        $filbandir = H::getConfApp2('filbandir', 'tesoreria', 'tesdefcueban');
        $loguse= sfContext::getInstance()->getUser()->getAttribute('loguse');
        $bus="";
        $this->c = new Criteria();


        $q = new Criteria();
        $result = OpdefempPeer::doSelectOne($q);
        if ($result) {
            if ($result->getManbloqban() == 'S') {
                if ($filbandir=='S')
                  $bus='tsdefban.coddirec in (select coddirec from "SIMA_USER".segdirusu where loguse=\''.$loguse.'\')';
                if ($bus!='')
                  $bus .= 'and tsdefban.numcue not in (select numcue from tsbloqban)';
                else
                  $bus= 'tsdefban.numcue not in (select numcue from tsbloqban)';
                $this->c->add(TsdefbanPeer::NUMCUE, $bus, Criteria::CUSTOM);
            }else {
                 if ($filbandir=='S') {
                  $bus='tsdefban.coddirec in (select coddirec from "SIMA_USER".segdirusu where loguse=\''.$loguse.'\')';
                  $this->c->add(TsdefbanPeer::NUMCUE, $bus, Criteria::CUSTOM);
                 }
            }
        }

        $this->columnas = array(
            TsdefbanPeer :: NUMCUE => 'Número de Cuenta',
            TsdefbanPeer :: NOMCUE => 'Nombre de la Cuenta',
            TsdefbanPeer :: CODCTA => 'Código de la Cuenta',
            TsdefbanPeer :: CODADI => 'Código Adicional'
        );
    }

    public function Opbenefi_Tesmovemiche() {
        $this->c = new Criteria();
        //  $this->c->addAscendingOrderByColumn(OpbenefiPeer::CEDRIF);

        $this->columnas = array(
            OpbenefiPeer :: CEDRIF => 'C.I/RIF',
            OpbenefiPeer :: NOMBEN => 'Beneficiario'
        );
    }

    /*   public function Cpdeftit_Tesmovemiche($mascara)
      {
      $this->c= new Criteria();
      //Select a.NomPre Descripcion, a.CodPre Codigo_Presupuestario,CodCta Cuenta_Contable from CPDEFTIT a,CPDEFNIV b Where Length(RTRIM(CodPre)) = Length(RTRIM(b.ForPre))  order by codpre
      // $this->sql = "length(Codpre) = '".$mask."'";
      $this->c->add(CpdeftitPeer::CODPRE, $this->sql, Criteria::CUSTOM);
      $this->c->addAscendingOrderByColumn(CpdeftitPeer::CODPRE);

      $this->columnas = array (CpdeftitPeer::NOMPRE => 'Nombre', CpdeftitPeer::CODPRE => 'Código');
      } */

    /*     * ***************************Registro  de  Beneficiarios******************************* */

    public function Opbenefi_pagbenfic($params) {
        $c = new Criteria();
        $contaba = ContabaPeer :: doSelectOne($c);
        if ($contaba) {
            if ($params[0] == '1' || $params[0] == '6' || $params[0] == '7') {
                $codctaben = $contaba->getCodctaben();
                $codctabenhas = $contaba->getCodctabenhas();
            } else {
                $codctaben = $contaba->getCodord();
                $codctabenhas = "";
            }
        } else {
            $codctaben = "";
            $codctabenhas = "";
        }

        $this->c = new Criteria();
        $this->c->add(ContabbPeer :: CARGAB, 'C');

        //La variable params es para delimitar el tipo de codicion que lleva el SQL del catalogo
        //TIPO1
        if ($params[0] == '1') {
            if (($codctaben != "") && ($codctabenhas != "")) {

                $this->c->add(ContabbPeer :: CODCTA, $codctaben . '%', Criteria :: GREATER_THAN);
                $this->c->add(ContabbPeer :: CODCTA, $codctabenhas . '%', Criteria :: LESS_THAN);
            } else {

                $this->c->add(ContabbPeer :: CODCTA, $codctaben . '%', Criteria :: LIKE);
                $this->c->add(ContabbPeer :: CODCTA, $codctabenhas . '%', Criteria :: LIKE);
            }
        } //TIPO2
        else {

            $this->c->add(ContabbPeer :: CODCTA, $codctaben . '%', Criteria :: LIKE);
        }

        $this->c->addAscendingOrderByColumn(ContabbPeer :: DESCTA);

        $this->columnas = array(
            ContabbPeer :: DESCTA => 'Descripcion',
            ContabbPeer :: CODCTA => 'Codigo'
        );
    }

    /*     * ***********************************   Cotizaciones  ***************** */

    public function Caregart_Almcotiza($params = array()) {
        $manconstruc=H::getConfApp2('manconstruc', 'compras', 'almregart');
        $mask = str_replace('@', '#', $params[0]);
        $longmask = 0;
        while (Herramientas :: instr($mask, '-', $longmask, 1) != 0) {
            $longmask = Herramientas :: instr($mask, '-', $longmask, 1) + $longmask;
        }

        $this->c = new Criteria();
        $this->sql = "length(Codart) > '" . $longmask . "'";
        if ($manconstruc=='S'){
            $opc1 = $this->c->getNewCriterion(CaregartPeer::CONSBUE, null);
            $opc2 = $this->c->getNewCriterion(CaregartPeer::CONSBUE, false);
            $opc1->addOr($opc2);
            $this->c->add($opc1);
        }

        $this->c->add(CaregartPeer :: CODART, $this->sql, Criteria :: CUSTOM);
        //  $this->c->addAscendingOrderByColumn(CaregartPeer::DESART);

        $this->columnas = array(
            CaregartPeer :: CODART => 'Código',
            CaregartPeer :: DESART => 'Descripción',
            CaregartPeer :: CODBAR => 'Código Barra'
        );
    }

    /*     * ***************************DEFINICION DE  EMPRESAS*********************************** */

    public function Opdefemp_pagdefemp($params = array()) {
        //$longitud = $params[0];
        $this->c = new Criteria();
        //$this->sql = "length(Codcta) = '" . $longitud . "'";
        //$this->c->add(ContabbPeer :: CODCTA, $this->sql, Criteria :: CUSTOM);
        $this->c->add(ContabbPeer :: CARGAB, 'C');

        $this->columnas = array(
            ContabbPeer :: DESCTA => 'Descripcion',
            ContabbPeer :: CODCTA => 'Codigo'
        );
    }

    public function Opdefemp_pagdefemp2() {
        $this->c = new Criteria();

        $this->columnas = array(
            CpdoccauPeer :: NOMEXT => 'Nombre',
            CpdoccauPeer :: TIPCAU => 'TIPO',
            CpdoccauPeer :: NOMABR => 'Nombre Abreviado'
        );
    }

    public function Opdefemp_pagdefemp3() {
        $this->c = new Criteria();
        //  $this->c->addAscendingOrderByColumn(TstipmovPeer::DESTIP);

        $this->columnas = array(
            TstipmovPeer :: DESTIP => 'Descripcion',
            TstipmovPeer :: CODTIP => 'Codigo',
            TstipmovPeer :: DEBCRE => 'Débito o Crédito'
        );
    }

    /*     * ************************************************************************************* */
    /*     * ****************************requisiciones*************************************** */

    /*public function Caregart_Almreq($params = array()) {
        $longitud = $params[0];
        $this->c = new Criteria();
        $this->c->add(CaregartPeer :: TIPO, 'A');
        $this->sql = "length(Codart) = '" . $longitud . "'";
        $this->c->add(CaregartPeer :: CODART, $this->sql, Criteria :: CUSTOM);

        $this->columnas = array(
            CaregartPeer :: CODART => 'Código',
            CaregartPeer :: DESART => 'Descripción',
            CaregartPeer :: COSULT => 'Costo',
            CaregartPeer :: CODBAR => 'Código Barra'
        );
    }*/

    public function Npcatpre_Almreq() {
        $mascara = Herramientas::getObtener_FormatoCategoria();
        $mask = strlen($mascara);
        $this->c = new Criteria();
        $this->sql = "length(CodCat) = '" . $mask . "'";
        $categoriasusu = sfContext::getInstance()->getUser()->getAttribute('categoriasusu');
        if ($categoriasusu != '') {
            $aux = explode('*', $categoriasusu);
            for ($a = 0; $a < count($aux); $a++) {
                if ($a == 0)
                    $this->sql = $this->sql . " and (" . NpcatprePeer::CODCAT . " like '" . $aux[$a] . "%' ";
                else if ($a == (count($aux) - 1))
                    $this->sql = $this->sql . " or " . NpcatprePeer::CODCAT . " like '" . $aux[$a] . "%' ";
                else
                    $this->sql = $this->sql . " or " . NpcatprePeer::CODCAT . " like '" . $aux[$a] . "%'";
            }
            $this->sql = $this->sql . ")";
        }

        $this->c->add(NpcatprePeer :: CODCAT, $this->sql, Criteria :: CUSTOM);
        $this->columnas = array(
            NpcatprePeer :: CODCAT => 'Codigo',
            NpcatprePeer :: NOMCAT => 'Descripcion'
        );
    }

    public function Bnubibie_Almreq() {
        $longitudUbic = Herramientas :: getX_vacio('codins', 'bndefins', 'lonubi', '001');
        if ($longitudUbic == '')
            $longitudUbic = 0;
        $this->c = new Criteria();
        $this->sql = "length(Codubi) = '" . $longitudUbic . "'";
        $this->c->add(BnubibiePeer :: CODUBI, $this->sql, Criteria :: CUSTOM);
        $this->columnas = array(
            BnubibiePeer :: CODUBI => 'Código',
            BnubibiePeer :: DESUBI => 'Descripción',
        );
    }

    /*     * ***************************requisiciones de servicio********************************** */

    public function caregart_almreqser($params = array()) {
        $longitud = $params[0];
        $this->c = new Criteria();
        $this->c->add(CaregartPeer :: TIPO, 'S');
        $this->sql = "length(Codart) = '" . $longitud . "'";
        $this->c->add(CaregartPeer :: CODART, $this->sql, Criteria :: CUSTOM);
        $this->columnas = array(
            CaregartPeer :: CODART => 'Codigo',
            CaregartPeer :: DESART => 'Descripcion',
            CaregartPeer :: CODBAR => 'Código Barra'
        );
    }

    public function npcatpre_almreqser() {
        $mascara = Herramientas::getObtener_FormatoCategoria();
        $mask = strlen($mascara);
        $this->c = new Criteria();
        $this->sql = "length(CodCat) = '" . $mask . "'";
        $this->c->add(NpcatprePeer :: CODCAT, $this->sql, Criteria :: CUSTOM);
        $this->columnas = array(
            NpcatprePeer :: CODCAT => 'Codigo',
            NpcatprePeer :: NOMCAT => 'Descripcion'
        );
    }

    /*     * ****************inventario fisico******************************** */

    public function Caregart_Alminvfis($params = array()) {
        $this->c = new Criteria();
        $longitud = $params[0];
        $this->c = new Criteria();
        $this->sql = "length(Codart) = '" . $longitud . "'";
        $this->c->add(CaregartPeer :: CODART, $this->sql, Criteria :: CUSTOM);

        $this->columnas = array(
            CaregartPeer :: CODART => 'Codigo',
            CaregartPeer :: DESART => 'Descripcion',
            CaregartPeer :: UNIMED => 'Unidad',
            CaregartPeer :: EXITOT => 'Existencia',
            CaregartPeer :: CODBAR => 'Código Barra'
        );
    }

  public function Caregart_Almreq($params = array ()) {
    $valexiart=H::getConfApp2('valexiart', 'compras', 'almreq');
    if ($valexiart=='S')
      $cad="and (select coalesce(sum(caartalmubi.exiact),0) as existencia from caartalmubi where caartalmubi.codart=caregart.codart) >0";
    else $cad="";
    $longitud = $params[0];
    $this->c = new Criteria();
    $this->c->add(CaregartPeer :: TIPO, 'A');
    $this->sql = "length(caregart.codart) = '" . $longitud . "' $cad";
    $this->c->add(CaregartPeer :: CODART, $this->sql, Criteria :: CUSTOM);

    $this->columnas = array (
      CaregartPeer :: CODART => 'Código',
      CaregartPeer :: DESART => 'Descripción',
      CaregartPeer :: COSULT => 'Costo',
      CaregartPeer :: CODBAR => 'Código Barra'
    );
  }

    public function Npdefcpt_nomdefespcon() {
        $this->c = new Criteria();

        //   $this->c->addAscendingOrderByColumn(NppartidasPeer::NOMPAR);

        $this->columnas = array(
            NppartidasPeer :: NOMPAR => 'Descripcion',
            NppartidasPeer :: CODPAR => 'Codigo'
        );
    }

    public function Npcargos_nomdefespcar($params) {

        if ($params[0] == 'Y') {
            $this->c = new Criteria();
            //    $this->c->addAscendingOrderByColumn(NptipcarPeer::DESTIPCAR);

            $this->columnas = array(
                NptipcarPeer :: DESTIPCAR => 'Descripcion',
                NptipcarPeer :: CODTIPCAR => 'Codigo'
            );
        } else {
            $this->c = new Criteria();
            $this->c->add(NpcomocpPeer :: PASCAR, '001');
            $this->c->add(NpcomocpPeer :: CODTIPCAR, $params[0]);
            //     $this->c->addAscendingOrderByColumn(NpcomocpPeer::GRACAR);

            $this->columnas = array(
                NpcomocpPeer :: GRACAR => 'Grado',
                NpcomocpPeer :: SUECAR => 'Sueldo'
            );
        }
    }

    public function Npdefcpt_nomdefespcon2() {
        $this->c = new Criteria();
        $this->c->clearSelectColumns();
        $this->c->addSelectColumn(NppartidasPeer::CODPAR);
        $this->c->addSelectColumn(NppartidasPeer::NOMPAR);
        $this->c->addSelectColumn("'' as ID");
        $this->c->addGroupByColumn(NppartidasPeer::CODPAR);
        $this->c->addGroupByColumn(NppartidasPeer::NOMPAR);

        $this->columnas = array(
            NppartidasPeer::CODPAR => 'Codigo',
            NppartidasPeer::NOMPAR => 'Descripcion');
    }

    public function Npdefcpt_nomconceptossalariointegral_concepto($params) {

        $this->c = new Criteria();
        $this->c->addJoin(NpdefcptPeer :: CODCON, NpasiconnomPeer :: CODCON);
        $this->c->add(NpasiconnomPeer :: CODNOM, $params[0]);
        //   $this->c->addAscendingOrderByColumn(NpdefcptPeer::CODCON);

        $this->columnas = array(
            NpdefcptPeer :: CODCON => 'Codigo',
            NpdefcptPeer :: NOMCON => 'Descripcion'
        );
    }

    public function Npprofesion_nonhojint() {
        $this->c = new Criteria();
        $this->columnas = array(NpprofesionPeer::CODPROFES => 'CÃ³digo', NpprofesionPeer::DESPROFES => 'DescripciÃ³n');
    }

    /////////////////////////////////TESORERIA///////////////////////////////////////////
    /*     * *********************************Enterar Retensiones******************************* */
    public function Tsentislr_tesretislr() {
        $this->c = new Criteria();
        //   $this->c->addAscendingOrderByColumn(TsmovlibPeer::REFLIB);
        $this->columnas = array(
            TsmovlibPeer :: REFLIB => 'Referencia',
            TsmovlibPeer :: FECLIB => 'Fecha'
        );
    }

    /*     * *********************************Cuentas contables para rendencion de gastos******************************* */

    public function Tsdefrengas_tesdefrengas($params) {
        if ($params[0] == '1') {
            $this->c = new Criteria();
            $this->c->add(CpdoccauPeer :: REFIER, 'N');
            $this->c->add(CpdoccauPeer :: AFEPRC, 'N');
            $this->c->add(CpdoccauPeer :: AFECOM, 'N');
            $this->c->add(CpdoccauPeer :: AFEDIS, 'N');
            $this->columnas = array(
                CpdoccauPeer :: TIPCAU => 'Tipo',
                CpdoccauPeer :: NOMEXT => 'Nombre'
            );
        }
        if ($params[0] == '2') {
            $this->c = new Criteria();
            $this->c->add(ContabbPeer :: CARGAB, 'N', Criteria :: NOT_EQUAL);
            $this->columnas = array(
                ContabbPeer :: DESCTA => 'Descripcion',
                ContabbPeer :: CODCTA => 'Codigo',
                ContabbPeer :: CARGAB => 'Cargable'
            );
        }
        if ($params[0] == '3') {
            $this->c = new Criteria();
            $this->c->add(TstipmovPeer :: DEBCRE, 'D');
            $this->columnas = array(
                TstipmovPeer :: DESTIP => 'Descripcion',
                TstipmovPeer :: CODTIP => 'Codigo'
            );
        }
    }

    /*     * *********************************Transferencias bancarias******************************* */

    public function Tsmovtra_tesmovtraban($params) {
        if ($params[0] == '1') {
            $this->c = new Criteria();
            //     $this->c->addAscendingOrderByColumn(TsdefbanPeer::NOMCUE);
            $this->columnas = array(
                TsdefbanPeer :: NOMCUE => 'Nombre Cuenta',
                TsdefbanPeer :: NUMCUE => 'Nro. Cuenta',
                TsdefbanPeer::CODCTA => 'Cuenta Contable'
            );
        }
        if ($params[0] == '2') {
            $this->c = new Criteria();
            //    $this->c->addAscendingOrderByColumn(TstipmovPeer::DESTIP);
            $this->columnas = array(
                TstipmovPeer :: DESTIP => 'Nombre Cuenta',
                TstipmovPeer :: CODTIP => 'Nro. Cuenta'
            );
        }
    }

    /*     * *********************************Movimiento Segun Libro******************************* */

    public function Tsmovlib_tesmovdeglib($params) {
        if ($params[0] == '1') {
            $filbandir = H::getConfApp2('filbandir', 'tesoreria', 'tesdefcueban');
            $loguse= sfContext::getInstance()->getUser()->getAttribute('loguse');

            $this->c = new Criteria();
            if ($filbandir=='S'){
                $this->sql='tsdefban.coddirec in (select coddirec from "SIMA_USER".segdirusu where loguse=\''.$loguse.'\')';
                $this->c->add(TsdefbanPeer::CODDIREC, $this->sql, Criteria :: CUSTOM);
            }

            $this->columnas = array(
                TsdefbanPeer :: NOMCUE => 'Nombre Cuenta',
                TsdefbanPeer :: NUMCUE => 'Nro. Cuenta',
                TsdefbanPeer :: CODCTA => 'Cuenta Contable',
                TsdefbanPeer :: USOCUE => 'Uso de la Cuenta'
            );
        }
        if ($params[0] == '2') {
            $this->c = new Criteria();
            //    $this->c->addAscendingOrderByColumn(TstipmovPeer::CODTIP);
            $this->columnas = array(
                TstipmovPeer :: CODTIP => 'Codigo',
                TstipmovPeer :: DESTIP => 'Descripcion'
            );
        }
    }

    /*     * *********************************Conciliacion Bancaria******************************* */

    public function Tsconcil_tesmovconban($params) {
        if ($params[0] == '1') {
            $this->c = new Criteria();
            //   $this->c->addAscendingOrderByColumn(TsdefbanPeer::NOMCUE);
            $this->columnas = array(
                TsdefbanPeer :: NOMCUE => 'Nombre Cuenta',
                TsdefbanPeer :: NUMCUE => 'Nro. Cuenta'
            );
        }
    }

    /*     * *********************************Comprobante Contable******************************* */

    public function Confincomgen_Contabb($params = '') {
        $this->c = new Criteria();
        $this->c->add(ContabbPeer::CARGAB, 'C');
        $this->c->addAscendingOrderByColumn(ContabbPeer::CODCTA);
        $this->columnas = array(ContabbPeer::CODCTA => 'Cuenta', ContabbPeer::DESCTA => 'Descripcion');
    }

    ////////////////////////////////////////////////////////////////////////////////////////////

    /*     * ****************** Formulacion : Forpoa : Proyecto o Acción Centralizada **************** */
    public function Fordefpry_Forpoa() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(FordefpryPeer::CODPRO);
        $this->columnas = array(
            FordefpryPeer :: CODPRO => 'Codigo del Proyecto',
            FordefpryPeer :: NOMPRO => 'Nombre del Proyecto'
        );
    }

    /*     * ************************************************************************************** */

    /*     * ************************* Formulacion : Forpoa : Acción Especificas ****************** */

    public function Fordefaccesp_Forpoa($params) {
        $this->c = new Criteria();
        $this->c->add(FordefaccespPeer :: CODPRO, $params[0]);
        $this->c->addAscendingOrderByColumn(FordefaccespPeer::CODACCESP);
        $this->columnas = array(
            FordefaccespPeer :: CODACCESP => 'Codigo',
            FordefaccespPeer :: DESACCESP => 'Accion Especifica'
        );
    }

    /*     * ************************************************************************************* */

    /*     * ************************* Formulacion : Forpoa : Acción Especificas ****************** */

    public function Fordefpryaccmet_Forpoa($params = array()) {
        $this->c = new Criteria();
        $this->c->add(FordefpryaccmetPeer :: CODPRO, $params[0]);
        //$this->c->add(FordefpryaccmetPeer :: CODPRO, $params[0]);
        $this->c->add(FordefpryaccmetPeer :: CODACCESP, $params[1]);
        //   $this->c->addAscendingOrderByColumn(FordefpryaccmetPeer::CODACCESP);
        $this->columnas = array(
            FordefpryaccmetPeer :: CODMET => 'Codigo',
            FordefpryaccmetPeer :: DESMET => 'Meta'
        );
    }

    /*     * ************************************************************************************* */

    /*     * ************************* Formulacion : Forpoa : Unidad Ejecutora ****************** */

    public function Fordefcatpre_Forpoa($param) {
        $mask = strlen(str_replace('@', '#', $param[0]));
        $this->c = new Criteria();
        //$this->sql = "length(Codcat) = '" . $mask . "' and codcat like '" . $param[1] . "%'";
        $this->sql = "length(Codcat) = '" . $mask . "'";
        $this->c->add(FordefcatprePeer :: CODCAT, $this->sql, Criteria :: CUSTOM);
        $this->c->addAscendingOrderByColumn(FordefcatprePeer::CODCAT);

        $this->columnas = array(
            FordefcatprePeer :: CODCAT => 'Codigo',
            FordefcatprePeer :: NOMCAT => 'Categoria'
        );
    }

    /*     * ************************* Formulacion : Forpoa : Partida ****************** */

    public function Fordefparegr_Forpoa($param) {
        /*   sql = "Select NomParEgr Partida, CodParEgr From " .
          "ForDefParEgr " .
          "where to_char(length(rtrim(CodParEgr))) =  '" + CStr(LongitudPartida) + "' " .
          Order By CodParEgr"
         */

        //$LongitudPartida = strlen(str_replace('@','#',$param[0]));
        $LongitudPartida = $param[0];
        $this->c = new Criteria();
        $this->sql = "length(codparegr) = '" . $LongitudPartida . "'";
        $this->c->add(FordefparegrPeer :: CODPAREGR, $this->sql, Criteria :: CUSTOM);
        $this->c->addAscendingOrderByColumn(FordefparegrPeer::CODPAREGR);

        $this->columnas = array(
            FordefparegrPeer :: CODPAREGR => 'Partida',
            FordefparegrPeer :: NOMPAREGR => 'Nombre de la Partida'
        );
    }

    /*     * ************************* Formulacion : Forpoa : Tipo de Gasto ****************** */

    public function Fortiptit_Forpoa() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(FortiptitPeer::CODTIP);

        $this->columnas = array(
            FortiptitPeer :: CODTIP => 'Codigo',
            FortiptitPeer :: DESTIP => 'Nombre Extendido'
        );
    }

    /*     * ************************* Formulacion : Forpoa_uae : Codigo categoria ****************** */

    public function Fordefcatpre_Forpoa_uae($params) {
        if ($params[0] != '') {
            //$Longitud = $params[0];
            $formatouae = strlen(Herramientas :: ObtenerFormato('Fordefegrgen', 'Foruae'));
            $this->c = new Criteria();
            $this->sql = "length(Codcat) = '" . $formatouae . "'";
            $this->c->add(FordefcatprePeer :: CODCAT, $this->sql, Criteria :: CUSTOM);
            $this->c->addAscendingOrderByColumn(FordefcatprePeer::CODCAT);
        } else {
            $this->c = new Criteria();
        }
        $this->columnas = array(
            FordefcatprePeer :: CODCAT => 'Codigo',
            FordefcatprePeer :: NOMCAT => 'Nombre Categoria'
        );
    }

    /*     * ************************************************************************************* */

    /*     * ************************************************************************************* */

    /*     * ****************************** Bienes: biedefpar: Partidas  ******************************* */

    public function Nppartidas_Biedefpar() {
        $this->c = new Criteria();
        //    $this->c->addAjoin(NppartidasPeer::CODPAR);
        $this->columnas = array(
            NppartidasPeer :: CODPAR => 'Código',
            NppartidasPeer :: NOMPAR => 'Descripción'
        );
    }

    ////////////////////////////////////////////////////////////////////////////////////////////
    public function Nppartidas_Prenondespre() {
        $this->c = new Criteria();
        //    $this->c->addAjoin(NppartidasPeer::CODPAR);
        $this->columnas = array(
            NppartidasPeer :: CODPAR => 'Código',
            NppartidasPeer :: NOMPAR => 'Descripción'
        );
    }

    ////////////////////////////////////////////////////////////////////////////////////////////
    public function Presnomasitrabcont_Npasiempcont($param) {

        $this->c = new Criteria();
        $this->c->add(NpasicarempPeer :: CODNOM, $param[0]);
        $this->c->add(NpasicarempPeer :: STATUS, 'V');
        $this->c->addJoin(NphojintPeer :: CODEMP, NpasicarempPeer :: CODEMP);
        //$this->c->addAjoin(NphojintPeer::CODEMP,Npasicaremp::CODEMP);
        //$this->c->addJoin(NpasicarempPeer::CODNOM,NpasinomcontPeer::CODNOM);
        $this->columnas = array(
            NphojintPeer :: CODEMP => 'Codigo',
            NphojintPeer :: NOMEMP => 'Nombre',
            NphojintPeer :: FECING => 'Fecha Ingreso',
            NphojintPeer :: STAEMP => 'Estatus'
        );
    }

    ////////////////////////////////////////////////////////////////////////////////////////////
    public function Presnomasitrabcont_Npnomina($params) {
        $this->c = new Criteria();
        $this->c->add(NpasinomcontPeer :: CODTIPCON, $params[0]);
        $this->c->addJoin(NpnominaPeer :: CODNOM, NpasinomcontPeer :: CODNOM);
        //$this->c->addAjoin(NphojintPeer::CODEMP,Npasicaremp::CODEMP);

        $this->columnas = array(
            NpnominaPeer :: CODNOM => 'Codigo',
            NpnominaPeer :: NOMNOM => 'Descipción'
        );
    }

    ////////////////////////////////////////////////////////////////////////////////////////////
    public function Npintfecref_Presnomintfecref() {
        $this->c = new Criteria();
        //    $this->c->addAjoin(NppartidasPeer::CODPAR);
        $this->columnas = array(
            NpintfecrefPeer :: FECINIREF => 'Desde',
            NpintfecrefPeer :: FECFINREF => 'Hasta',
            NpintfecrefPeer :: TASINTPRO => 'Tasa Promedio',
            NpintfecrefPeer :: TASINTACT => 'Tasa Activa',
            NpintfecrefPeer :: TASINTPAS => 'Tasa Pasiva'
        );
    }

    ////////////////////////////////////////////////////////////////////////////////////////////
    public function Npestorg_Nomhojint($mascara) {
        $connivel = H::getConfApp2('connivel', 'nomina', 'nomhojint');
        $mandepsta=H::getConfApp2('mandepsta', 'nomina', 'nomdefespnivorg');
        $c = new Criteria;
        $mask = $mascara[0];
        $this->c = new Criteria();
        if ($connivel!='S') {
            $this->sql = "length(Codniv) = '" . $mask . "'";
            if ($mandepsta=='S')
                $this->sql.="and staact='S'";
            $this->c->add(NpestorgPeer :: CODNIV, $this->sql, Criteria :: CUSTOM);
        }else {
          if ($mandepsta=='S') {
            $this->sql.="staact='S'";
            $this->c->add(NpestorgPeer :: STAACT, $this->sql, Criteria :: CUSTOM);
          }
        }
        //   $this->c->addAscendingOrderByColumn(NpestorgPeer::CODNIV);

        $this->columnas = array(
            NpestorgPeer :: CODNIV => 'Código',
            NpestorgPeer :: DESNIV => 'Descripción',
        );
    }

    /*     * ************************************************************************************* */

    public function Nptipcon_Presnomasitrabcont() {

        $this->c = new Criteria();
        //    $this->c->addAjoin(NppartidasPeer::CODPAR);
        $this->columnas = array(
            NptipconPeer :: CODTIPCON => 'Código',
            NptipconPeer :: DESTIPCON => 'Descripción'
        );
    }

    /*     * ****************************** Bienes: bieregactmued: Registro de Activos Muebles  ******************************* */

    public function Caordcom_Bieregactmued() {
        $this->c = new Criteria;
        $filpar404 = H::getConfApp2('filpar404', 'bienes', 'bieregactmued');
        if ($filpar404=='S'){
            $this->c->add(CaartordPeer::CODPAR, '404%', Criteria :: LIKE);
            $this->c->addJoin(CaordcomPeer::ORDCOM, CaartordPeer::ORDCOM);
        }
        $this->c->addJoin(CaordcomPeer :: CODPRO, CaproveePeer :: CODPRO);
        $this->c->add(CaproveePeer::ESTPRO, 'A');
        //  $this->c->addAscendingOrderByColumn(CaordcomPeer::ORDCOM);
        $this->columnas = array(
            CaordcomPeer :: ORDCOM => 'Codigo',
            CaordcomPeer :: CODPRO => 'Código Proveedor',
            CaordcomPeer :: FECORD => 'Fecha',
            CaproveePeer :: NOMPRO => 'Nombre Proveedor'
        );
    }

    public function Bnubibie_Bieregactmued($params = array()) {
        $longitudUbic = Herramientas :: getX_vacio('codins', 'bndefins', 'lonubi', '001');
        if ($longitudUbic == '')
            $longitudUbic = 0;
        $this->c = new Criteria();
        $this->sql = "length(Codubi) = '" . $longitudUbic . "'";
        $this->c->add(BnubibiePeer :: CODUBI, $this->sql, Criteria :: CUSTOM);
        //   $this->c->addAscendingOrderByColumn(BnubibiePeer::CODUBI);
        $this->columnas = array(
            BnubibiePeer :: CODUBI => 'Código',
            BnubibiePeer :: DESUBI => 'Descripción',
        );
    }

    public function Bndisbie_Bieregactmued() {
        $this->c = new Criteria();
        //   $this->c->addAscendingOrderByColumn(BndisbiePeer::CODDIS);
        $this->columnas = array(
            BndisbiePeer :: CODDIS => 'Código',
            BndisbiePeer :: DESDIS => 'Descripción',
        );
    }

    public function Caprovee_Bieregactmued() {
        $this->c = new Criteria();
        $this->c->add(CaproveePeer::ESTPRO, 'A');
        //   $this->c->addAscendingOrderByColumn(CaproveePeer::CODPRO);
        $this->columnas = array(
            CaproveePeer :: CODPRO => 'Código',
            CaproveePeer :: NOMPRO => 'Descripción',
        );
    }

    /*     * ****************************** Bienes: biedefpar: Partidas  ******************************* */

    public function Bnregmue_Bieregsegmue() {
        $this->c = new Criteria();
        $this->c->add(BnregmuePeer::STAMUE, 'A');
        //   $this->c->addAscendingOrderByColumn(BnregmuePeer::CODACT);
        $this->columnas = array(
            BnregmuePeer :: CODMUE => 'Código Activo',
            BnregmuePeer :: CODACT => 'Código Nivel',
            BnregmuePeer :: DESMUE => 'Descripción',
            BnregmuePeer :: CODALT => 'Código Alterno'
        );
    }

    ////////////////////////////////////////////////////////////////////////////////////////////

    /*     * ****************************** Bienes: bieregsegmue: Seguro  ******************************* */
    public function Bncobseg_Bieregsegmue() {
        $this->c = new Criteria();
        //   $this->c->addAscendingOrderByColumn(BncobsegPeer::CODCOB);
        $this->columnas = array(
            BncobsegPeer :: CODCOB => 'Código',
            BncobsegPeer :: DESCOB => 'Descripción'
        );
    }

    ////////////////////////////////////////////////////////////////////////////////////////////

    public function Npnomina_nomdefespvar() {
        $this->c = new Criteria();
        $this->columnas = array(
            NpnominaPeer :: CODNOM => 'Código',
            NpnominaPeer :: NOMNOM => 'Descripción',
            NpnominaPeer :: FRECAL => 'Frecuencia'
        );
    }

    public function Npnomina_Vacdefgen() {
        $this->c = new Criteria();
        $this->columnas = array(
            NpnominaPeer :: CODNOM => 'Código',
            NpnominaPeer :: NOMNOM => 'Descripción'
        );
    }

    public function Bndefact_Biedefconlotm() {
        $longitudact = Herramientas :: getX_vacio('codins', 'bndefins', 'lonact', '001');
        if ($longitudact == '')
            $longitudact = 0;
        $this->c = new Criteria();
        $this->sql = "length(Codact) = '" . $longitudact . "'";
        $this->c->add(BndefactPeer :: CODACT, $this->sql, Criteria :: CUSTOM);

        $this->c->addAscendingOrderByColumn(BndefactPeer :: CODACT);
        $this->columnas = array(
            BndefactPeer :: CODACT => 'Código Nivel',
            BndefactPeer :: DESACT => 'Descripción'
        );
    }

    public function Bndefact_Biedefconlotm1() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(BndefactPeer :: CODACT);
        $this->columnas = array(
            BndefactPeer :: CODACT => 'Código Nivel',
            BndefactPeer :: DESACT => 'Descripción'
        );
    }

    public function Contabb_Biedefconlotm() {
        $this->c = new Criteria();
        $this->c->add(ContabbPeer :: CARGAB, 'C');
        $this->columnas = array(
            ContabbPeer :: CODCTA => 'Código Cuenta',
            ContabbPeer :: DESCTA => 'Descripción'
        );
    }

    ////////////////////////////////////////////////////////////////////////////////////////////

    public function Npdefcpt_Vacdefgen($params) {

        $this->c = new Criteria();
        $this->c->addJoin(NpdefcptPeer :: CODCON, NpasiconnomPeer :: CODCON);
        $this->c->add(NpasiconnomPeer :: CODNOM, $params[0]);
        $this->columnas = array(
            NpdefcptPeer :: CODCON => 'Código',
            NpdefcptPeer :: NOMCON => 'Descripción'
        );
    }

    public function Npdefcpt_nomdefespguarde() {
        $this->c = new Criteria();
        //   $this->c->addAscendingOrderByColumn(NpdefcptPeer::CODCON);
        $this->columnas = array(
            NpdefcptPeer :: CODCON => 'Código',
            NpdefcptPeer :: NOMCON => 'Descripción',
            NpdefcptPeer :: OPECON => 'Tipo'
        );
    }

    public function Npdefcpt_asignarcategoriaxemp() {
        $this->c = new Criteria();
        //   $this->c->addAscendingOrderByColumn(NpdefcptPeer::CODCON);
        $this->columnas = array(
            NpdefcptPeer :: CODCON => 'Código',
            NpdefcptPeer :: NOMCON => 'Descripción'
        );
    }

    /*     * ****************************** Bienes: bieregseginm : Inmuebles  ******************************* */

    public function Bnreginm_Bieregseginm() {
        $this->c = new Criteria();
        //   $this->c->addAscendingOrderByColumn(BnreginmPeer::CODACT);
        //   $this->c->addAscendingOrderByColumn(BnreginmPeer::CODINM);
        $this->columnas = array(
            BnreginmPeer :: CODACT => 'Código Nivel',
            BnreginmPeer :: CODINM => 'Código Activo',
            BnreginmPeer :: DESINM => 'Descripción'
        );
    }

    ////////////////////////////////////////////////////////////////////////////////////////////

    /*     * ****************************** Bienes: bieregseginm: Seguro  ******************************* */
    public function Bncobseg_Bieregseginm() {
        $this->c = new Criteria();
        //   $this->c->addAscendingOrderByColumn(BncobsegPeer::CODCOB);
        $this->columnas = array(
            BncobsegPeer :: CODCOB => 'Código',
            BncobsegPeer :: DESCOB => 'Descripción'
        );
    }

    ////////////////////////////////////////////////////////////////////////////////////////////

    /*     * ****************************** Bienes: bieregseginm: Seguro  ******************************* */
    public function Bnregsem_Bieregseginm() {
        $this->c = new Criteria();
        //   $this->c->addAscendingOrderByColumn(BnregsemPeer::CODACT);
        $this->columnas = array(
            BnregsemPeer :: CODACT => 'Código',
            BnregsemPeer :: CODSEM => 'Mueble',
            BnregsemPeer :: DESSEM => 'Descripción'
        );
    }

    ////////////////////////////////////////////////////////////////////////////////////////////

    public function Npdefcpt_nomconceptossalariointegral($params) {

        $this->c = new Criteria();
        //    $this->c->addAscendingOrderByColumn(NpnominaPeer::CODNOM);

        $this->columnas = array(
            NpnominaPeer :: CODNOM => 'Codigo',
            NpnominaPeer :: NOMNOM => 'Descripcion'
        );
    }

    public function Npdefcpt_nomconceptossalariointegral2($params) {

        $this->c = new Criteria();
        $this->c->addJoin(NpdefcptPeer :: CODCON, NpasiconnomPeer :: CODCON);
        $this->c->add(NpasiconnomPeer :: CODNOM, $params[0]);
        //   $this->c->addAscendingOrderByColumn(NpdefcptPeer::CODCON);

        $this->columnas = array(
            NpdefcptPeer :: CODCON => 'Codigo',
            NpdefcptPeer :: NOMCON => 'Descripcion'
        );
    }

    /*     * ****************************** Bienes: Biedefconm: Contable de Muebles  ******************************* */

    public function Npdefcpt_nomdefconaho($params) {
        if ($params[0] == '1') {
            $this->c = new Criteria();
            //    $this->c->addAscendingOrderByColumn(NpnominaPeer::CODNOM);

            $this->columnas = array(
                NpnominaPeer :: CODNOM => 'Codigo',
                NpnominaPeer :: NOMNOM => 'Descripcion'
            );
        }

        if ($params[1] == '2') {
            $this->c = new Criteria();
            $this->c->addJoin(NpdefcptPeer :: CODCON, NpasiconnomPeer :: CODCON);
            $this->c->add(NpdefcptPeer :: OPECON, 'D');
            $this->c->add(NpasiconnomPeer :: CODNOM, $params[0]);
            //     $this->c->addAscendingOrderByColumn(NpdefcptPeer::CODCON);

            $this->columnas = array(
                NpdefcptPeer :: CODCON => 'Codigo',
                NpdefcptPeer :: NOMCON => 'Descripcion'
            );
        } else
        if ($params[1] == '3' || $params[1] == '5') {
            $this->c = new Criteria();
            $this->c->addJoin(NpdefcptPeer :: CODCON, NpasiconnomPeer :: CODCON);
            $this->c->add(NpdefcptPeer :: OPECON, 'P');
            $this->c->add(NpasiconnomPeer :: CODNOM, $params[0]);
            //    $this->c->addAscendingOrderByColumn(NpdefcptPeer::CODCON);

            $this->columnas = array(
                NpdefcptPeer :: CODCON => 'Codigo',
                NpdefcptPeer :: NOMCON => 'Descripcion'
            );
        } else
        if ($params[1] == '4') {
            $this->c = new Criteria();
            $this->c->addJoin(NpdefcptPeer :: CODCON, NpasiconnomPeer :: CODCON);
            $this->c->add(NpdefcptPeer :: OPECON, 'P', Criteria :: NOT_EQUAL);
            $this->c->add(NpasiconnomPeer :: CODNOM, $params[0]);
            //    $this->c->addAscendingOrderByColumn(NpdefcptPeer::CODCON);

            $this->columnas = array(
                NpdefcptPeer :: CODCON => 'Codigo',
                NpdefcptPeer :: NOMCON => 'Descripcion'
            );
        }
    }

    /*     * ****************************** Bienes: biedefpar: Partidas  ******************************* */

    public function Bnregmue_Biedefconm() {
        $this->c = new Criteria();
        $this->c->add(BnregmuePeer :: STAMUE, 'A');
        //    $this->c->addAscendingOrderByColumn(BnregmuePeer::CODACT);
        $this->columnas = array(
            BnregmuePeer :: CODACT => 'Código',
            BnregmuePeer :: CODMUE => 'Mueble',
            BnregmuePeer :: DESMUE => 'Descripción'
        );
    }

    ////////////////////////////////////////////////////////////////////////////////////////////

    /*     * ****************************** Bienes: Biedefconm: Contable de Muebles  ******************************* */
    public function Contabb_Biedefconm() {
        $this->c = new Criteria();
        $this->c->add(ContabbPeer :: CARGAB, 'C');
        //    $this->c->addAscendingOrderByColumn(ContabbPeer::CODCTA);
        $this->columnas = array(
            ContabbPeer :: CODCTA => 'Código',
            ContabbPeer :: DESCTA => 'Descripción'
        );
    }

    ////////////////////////////////////////////////////////////////////////////////////////////

    /*     * ****************************** Bienes: biedefconlotm: Contable de Muebles por Lotes  ******************************* */
    public function Bndefcon_Biedefconlotm($param) {
        $this->c = new Criteria();

        /* SQL = "select a.DesAct Activo, a.CodAct Codigo_Nivel From " _
          + "BNDEFACT a, BNDEFINS b where length(RTrim(a.CodAct))=b.LonAct " _
          + " Order By CodAct" */

        $longitudUbic = Herramientas :: getX_vacio('codins', 'bndefins', 'lonubi', '001');
        $this->c->addJoin(BndefactPeer :: CODCON, NpasiconnomPeer :: CODCON);
        $this->sql = "length(CodAct) = '" . $longitudUbic . "'";
        $this->c->add(BndefinsPeer :: LONACT, $this->sql, Criteria :: CUSTOM);

        //   $this->c->addAscendingOrderByColumn(BndefactPeer::CODACT);
        $this->columnas = array(
            BnregmuePeer :: CODACT => 'Activo',
            BnregmuePeer :: CODMUE => 'Codigo Nivel'
        );
    }

    ////////////////////////////////////////////////////////////////////////////////////////////

    /*     * ****************************** Bienes: Biedefconm: Contable de Muebles  ******************************* */
    public function Bndefconi_Biedefconi($param) {
        if ($param[0] == '1') {
            $this->c = new Criteria();
            $this->c->add(BnreginmPeer :: STAINM, 'A');
            //      $this->c->addAscendingOrderByColumn(BnreginmPeer::CODACT);
            //      $this->c->addAscendingOrderByColumn(BnreginmPeer::CODINM);
            $this->columnas = array(
                BnreginmPeer :: CODACT => 'Código',
                BnreginmPeer :: CODINM => 'Inmueble',
                BnreginmPeer :: DESINM => 'Descripción'
            );
        } else
        if ($param[0] == '2') {
            $this->c = new Criteria();
            $this->c->add(ContabbPeer :: CARGAB, 'C');
            //     $this->c->addAscendingOrderByColumn(ContabbPeer::CODCTA);
            $this->columnas = array(
                ContabbPeer :: CODCTA => 'Código',
                ContabbPeer :: DESCTA => 'Descripción'
            );
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////////

    /*     * ****************************** Bienes: Biedefcons: Contable de Muebles  ******************************* */
    public function bndefcons_Biedefcons($param) {
        if ($param[0] == '1') {
            $this->c = new Criteria();
            //    $this->c->addAscendingOrderByColumn(BnregsemPeer::CODACT);
            //    $this->c->addAscendingOrderByColumn(BnregsemPeer::CODSEM);
            $this->columnas = array(
                BnregsemPeer :: CODACT => 'Código',
                BnregsemPeer :: CODSEM => 'Semovientes',
                BnregsemPeer :: DESSEM => 'Descripción'
            );
        } else
        if ($param[0] == '2') {
            $this->c = new Criteria();
            $this->c->add(ContabbPeer :: CARGAB, 'C');
            //      $this->c->addAscendingOrderByColumn(ContabbPeer::CODCTA);
            $this->columnas = array(
                ContabbPeer :: CODCTA => 'Código',
                ContabbPeer :: DESCTA => 'Descripción'
            );
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////Registro de Articulos////////////////////////////////////////

    public function Contabb_Almregart() {
        $a = new Criteria();
        $reg = ContabaPeer :: doSelectOne($a);
        if ($reg) {
            $cuentaarticulodesde = $reg->getCodctaart();
            $cuentaarticulohasta = $reg->getCodctaarthas();
        } else {
            $cuentaarticulodesde = "";
            $cuentaarticulohasta = "";
        }

        if ($cuentaarticulodesde != "" && $cuentaarticulohasta != "") {
            $this->c = new Criteria();
            $this->c->add(ContabbPeer :: CARGAB, 'C');
            $this->c->add(ContabbPeer :: CODCTA, $cuentaarticulodesde, Criteria :: GREATER_EQUAL);
            $this->c->add(ContabbPeer :: CODCTA, $cuentaarticulohasta, Criteria :: LESS_EQUAL);
            //    $this->c->addAscendingOrderByColumn(ContabbPeer::CODCTA);
        } else {
            $this->c = new Criteria();
            $this->c->add(ContabbPeer :: CARGAB, 'C');
            $this->c->add(ContabbPeer :: CODCTA, $cuentaarticulodesde . '%', Criteria :: LIKE);
            //    $this->c->addAscendingOrderByColumn(ContabbPeer::CODCTA);
        }

        $this->columnas = array(
            ContabbPeer :: CODCTA => 'Código',
            ContabbPeer :: DESCTA => 'Descripción'
        );
    }

    //////////////////////////////////////////////////////////////////////////////////////////////
    /*     * ****************************** Bienes: bieregactinmd: Registro de Activos Inmuebles  ******************************* */

    public function Bnubibie_Bieregactinmd() {
        $longitudUbic = Herramientas :: getX_vacio('codins', 'bndefins', 'lonubi', '001');
        if ($longitudUbic == '')
            $longitudUbic = 0;
        $this->c = new Criteria();
        $this->sql = "length(Codubi) = '" . $longitudUbic . "'";
        $this->c->add(BnubibiePeer :: CODUBI, $this->sql, Criteria :: CUSTOM);
        //   $this->c->addAscendingOrderByColumn(BnubibiePeer::CODUBI);
        $this->columnas = array(
            BnubibiePeer :: CODUBI => 'Código',
            BnubibiePeer :: DESUBI => 'Descripción',
        );
    }

    public function Bndisbie_Bieregactinmd() {
        $this->c = new Criteria();
        //   $this->c->addAscendingOrderByColumn(BndisbiePeer::CODDIS);
        $this->columnas = array(
            BndisbiePeer :: CODDIS => 'Código',
            BndisbiePeer :: DESDIS => 'Descripción',
        );
    }

    public function Caprovee_Bieregactinmd() {
        $this->c = new Criteria();
        $this->c->add(CaproveePeer::ESTPRO, 'A');
        //  $this->c->addAscendingOrderByColumn(CaproveePeer::CODPRO);
        $this->columnas = array(
            CaproveePeer :: CODPRO => 'Código',
            CaproveePeer :: NOMPRO => 'Descripción',
        );
    }

    /*     * ****************************** Nomina: nomdefespasicartipnomlot: Asignación de Cargos a Nomina  ******************************* */

    public function Npnomina_Nomdefespasicartipnomlot() {
        $this->c = new Criteria();
        //   $this->c->addAscendingOrderByColumn(NpnominaPeer::CODNOM);
        $this->columnas = array(
            NpnominaPeer :: CODNOM => 'Código',
            NpnominaPeer :: NOMNOM => 'Descripción',
        );
    }

    public function Fortipfin_Fortiting() {
        $this->c = new Criteria();
        //   $this->c->addAscendingOrderByColumn(FortipfinPeer::CODFIN);
        $this->columnas = array(
            FortipfinPeer :: CODFIN => 'Código',
            FortipfinPeer :: NOMEXT => 'Nombre',
        );
    }

    /*     * ****************************** Nomina: nomdefespasicartipnomlot: Asignación de Cargos a Nomina  ******************************* */

    public function Nptipcar_Nnpcomocp() {
        $this->c = new Criteria();
        //   $this->c->addAscendingOrderByColumn(NptipcarPeer::CODTIPCAR);
        $this->columnas = array(
            NptipcarPeer :: CODTIPCAR => 'Código',
            NptipcarPeer :: DESTIPCAR => 'Descripción',
        );
    }

    ////////////////////////////////////////////////FORDEFPROYECTO////////////////////////////////////////

    public function Fordefpry_fordefproyecto($params) {

        if ($params[0] == '1') {
            $this->c = new Criteria();
            //      $this->c->addAscendingOrderByColumn(FordefstaPeer::CODSTA);

            $this->columnas = array(
                FordefstaPeer :: DESSTA => 'Descripción',
                FordefstaPeer :: CODSTA => 'Código'
            );
        }
        if ($params[0] == '2') {
            $this->c = new Criteria();
            //    $this->c->addAscendingOrderByColumn(FordefsitprePeer::CODSITPRE);

            $this->columnas = array(
                FordefsitprePeer :: DESSITPRE => 'Descripción',
                FordefsitprePeer :: CODSITPRE => 'Código'
            );
        }
        if ($params[0] == '3') {
            $this->c = new Criteria();
            //     $this->c->addAscendingOrderByColumn(FordefprgPeer::CODPRG);

            $this->columnas = array(
                FordefprgPeer :: DESPRG => 'Descripción',
                FordefprgPeer :: CODPRG => 'Código'
            );
        }
        if ($params[0] == '4') {
            $this->c = new Criteria();

            $this->columnas = array(
                FordefobjestnvaetaPeer :: DESOBJNVAETA => 'Descripción',
                FordefobjestnvaetaPeer :: CODOBJNVAETA => 'Código'
            );
        }
        if ($params[0] == '5') {
            $this->c = new Criteria();

            $this->columnas = array(
                FordefunimedPeer :: DESUNIMED => 'Descripción',
                FordefunimedPeer :: CODUNIMED => 'Código'
            );
        }
        if ($params[0] == '6') {
            $this->c = new Criteria();

            $this->columnas = array(
                NphojintPeer :: CODEMP => 'Código',
                NphojintPeer :: NOMEMP => 'Nombre del Empleado',
                NphojintPeer :: STAEMP => 'Estatus'
            );
        }
    }

    public function Fordefpry_Fordefpryaccmet() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(FordefpryPeer :: CODPRO);
        $this->columnas = array(
            FordefpryPeer :: CODPRO => 'Código',
            FordefpryPeer :: NOMPRO => 'Proyecto'
        );
    }

    public function Fordefaccesp_Fordefpryaccmet($params) {
        $this->c = new Criteria();
        $this->c->add(FordefaccespPeer :: CODPRO, $params[0]);
        $this->c->addAscendingOrderByColumn(FordefaccespPeer :: CODPRO);
        $this->columnas = array(
            FordefaccespPeer :: CODACCESP => 'Código',
            FordefaccespPeer :: DESACCESP => 'Acción Específica'
        );
    }

    public function Nphojint_Nomasicarconnom() {
        $this->c = new Criteria();
        $this->c->add(NphojintPeer::STAEMP, 'R', Criteria::NOT_EQUAL);
        $filtro = "";
        $varemp = sfContext::getInstance()->getUser()->getAttribute('configemp');
        if ($varemp)
            if (array_key_exists('aplicacion', $varemp))
                if (array_key_exists('nomina', $varemp['aplicacion']))
                    if (array_key_exists('modulos', $varemp['aplicacion']['nomina']))
                        if (array_key_exists('nomasicarconnom', $varemp['aplicacion']['nomina']['modulos'])) {
                            if (array_key_exists('filasicar', $varemp['aplicacion']['nomina']['modulos']['nomasicarconnom'])) {
                                $filtro = $varemp['aplicacion']['nomina']['modulos']['nomasicarconnom']['filasicar'];
                            }
                        }
        if ($filtro == 'S') {
            $this->sql = "nphojint.codemp not in (select codemp from npasicaremp)";
            $this->c->add(NphojintPeer::CODEMP, $this->sql, Criteria::CUSTOM);
        }

        $this->columnas = array(
            NphojintPeer :: CODEMP => 'Código',
            NphojintPeer :: NOMEMP => 'Nombre',
            NphojintPeer :: STAEMP => 'Estatus'
        );
    }

    /* <----------------------------------Edición Permisos-----------------------------------------------------> */

    public function Nphojint_Nomfalperper() {
        $this->c = new Criteria();

        $this->columnas = array(
            NphojintPeer :: CODEMP => 'Código',
            NphojintPeer :: NOMEMP => 'Nombre',
            NphojintPeer :: STAEMP => 'Estatus'
        );
    }

    /* <----------------------------------Edición Permisos de Salida-----------------------------------------------------> */

    public function Npfalper_Nomfalpersal() {
        $this->c = new Criteria();

        $this->columnas = array(
            NphojintPeer :: CODEMP => 'Código',
            NphojintPeer :: NOMEMP => 'Nombre',
            NphojintPeer :: STAEMP => 'Estatus'
        );
    }

    public function Npmotfal_Nomfalpersal() {
        $this->c = new Criteria();

        $this->columnas = array(
            NpmotfalPeer :: CODMOTFAL => 'Código',
            NpmotfalPeer :: DESMOTFAL => 'Nombre'
        );
    }

    /* <----------------------------------Edición DIAS eXTRAS-----------------------------------------------------> */

    public function Npnomina_Nomdiaext() {
        $this->c = new Criteria();

        $this->columnas = array(
            NpnominaPeer :: CODNOM => 'Código',
            NpnominaPeer :: NOMNOM => 'Nombre'
        );
    }

    /* <----------------------------------Edición DIAS eXTRAS-----------------------------------------------------> */

    public function Npnomina_cestaticketemp() {
        $this->c = new Criteria();

        $this->columnas = array(
            NpnominaPeer :: CODNOM => 'Código',
            NpnominaPeer :: NOMNOM => 'Nombre'
        );
    }

    public function Nphojint_Fordefaccesp() {
        $this->c = new Criteria();

        $this->columnas = array(
            NphojintPeer :: CODEMP => 'Código',
            NphojintPeer :: NOMEMP => 'Nombre',
            NphojintPeer :: STAEMP => 'Estatus'
        );
    }

    /* <----------------------------------Edición DIAS eXTRAS-----------------------------------------------------> */

    public function Contabb_tesdefcueban() {
        $a = new Criteria();
        $reg = ContabaPeer :: doSelectOne($a);
        if ($reg) {
            $cuentabanco = $reg->getCodctaban();
            $cuentabancohasta = $reg->getCodctabanhas();
        } else {
            $cuentabanco = "";
            $cuentabancohasta = "";
        }

        if ($cuentabanco != "" && $cuentabancohasta != "") {
            $this->c = new Criteria();
            $this->c->add(ContabbPeer :: CARGAB, 'C');
            $this->c->add(ContabbPeer :: CODCTA, $cuentabanco, Criteria :: GREATER_EQUAL);
            $this->c->add(ContabbPeer :: CODCTA, $cuentabancohasta, Criteria :: LESS_EQUAL);
            //    $this->c->addAscendingOrderByColumn(ContabbPeer::CODCTA);
        } else {
            $this->c = new Criteria();
            $this->c->add(ContabbPeer :: CARGAB, 'C');
            $this->c->add(ContabbPeer :: CODCTA, $cuentabancohasta . '%', Criteria :: LIKE);
            //    $this->c->addAscendingOrderByColumn(ContabbPeer::CODCTA);
        }

        $this->columnas = array(
            ContabbPeer :: DESCTA => 'Descripción',
            ContabbPeer :: CODCTA => 'Código',
            ContabbPeer :: CARGAB => 'Cargable'
        );
    }

    public function Tstipcue_tesdefcueban() {
        $this->c = new Criteria();

        $this->columnas = array(
            TstipcuePeer :: CODTIP => 'Código',
            TstipcuePeer :: DESTIP => 'Nombre'
        );
    }

    public function Caregart_Almsolegr($params = array()) {
        $filartreg=H::getConfApp2('filartreg', 'compras', 'almsolegr');
        $manconstruc=H::getConfApp2('manconstruc', 'compras', 'almregart');
        $tipo = "";
        $tipo1 = "";
        $longitud = $params[0];
        if ($params[1] != "")
            $tipo = $params[1];
        if ($tipo == "C")
            $tipo1 = "A";
        else if ($tipo == "T")
            $tipo1 = "S";
        else if ($tipo == "G")
            $tipo1 = "M";
        else if ($tipo == "A")
            $tipo1 = "M";
        else if ($tipo == "S")
            $tipo1 = "S";

        $this->c = new Criteria();
        if ($tipo != "" and $tipo1 != "" and $tipo != 'G')
            $this->c->add(CaregartPeer :: TIPO, $tipo1);

        if ($filartreg=='S'){
            if (array_key_exists(2,$params)){
                $escentral=H::getX_vacio('CODDIREC','Cadefdirec','Escentral',$params[2]);
                if ($escentral)
                  $this->c->add(CaregartPeer::CLAART,'C');
                else
                  $this->c->add(CaregartPeer::CLAART,'R');
            }


        }


        $mostodart = H::getConfAppGen('mostodart');
        if ($mostodart == 'S') {
            $this->sql = "length(Codart) = '" . $longitud . "'";
        } else {
            $this->sql = "length(Codart) = '" . $longitud . "' and (tipreg is null)";
        }
        if ($manconstruc=='S'){
            $opc1 = $this->c->getNewCriterion(CaregartPeer::CONSBUE, null);
            $opc2 = $this->c->getNewCriterion(CaregartPeer::CONSBUE, false);
            $opc1->addOr($opc2);
            $this->c->add($opc1);
        }

        $this->c->add(CaregartPeer :: CODART, $this->sql, Criteria :: CUSTOM);

        $this->columnas = array(
            CaregartPeer :: CODART => 'Código',
            CaregartPeer :: DESART => 'Descripción',
            CaregartPeer :: UNIMED => 'Unidad de Medida',
            CaregartPeer :: COSULT => 'Costo',
            CaregartPeer :: EXITOT => 'Existencia',
            CaregartPeer :: CODPAR => 'Codigo Partida',
            CaregartPeer :: CODBAR => 'Código Barra'
        );

    }

    ////////////////////////////////////////////////NOMCALCON////////////////////////////////////////

    public function Npcalcon_nomcalcon() {
        $filconusu = H::getConfApp2('filconusu', 'nomina', 'npforasiconemp');
        $loguse = sfContext::getInstance()->getUser()->getAttribute('loguse');

        $this->c = new Criteria();
        if ($filconusu == 'S') {
            $this->sql = 'npdefcpt.codcon in (select codcon from "SIMA_USER".segconusu where loguse=\'' . $loguse . '\')';
            $this->c->add(NpdefcptPeer::CODCON, $this->sql, Criteria::CUSTOM);
        }


        $this->columnas = array(
            NpdefcptPeer :: NOMCON => 'Nombre Concepto',
            NpdefcptPeer :: CODCON => 'Código Concepto'
        );
    }

    public function Contabb_Almtippro() {
        $this->c = new Criteria();
        $this->c->add(ContabbPeer :: CARGAB, 'C');

        $this->columnas = array(
            ContabbPeer :: CODCTA => 'Descripción',
            ContabbPeer :: DESCTA => 'Código'
        );
    }

    public function Optipben_Pagbenfi() {
        $this->c = new Criteria();
        $this->columnas = array(
            OptipbenPeer :: CODTIPBEN => 'Código',
            OptipbenPeer :: DESTIPBEN => 'Descripción',
        );
    }

    public function Npdefcpt_Pagretcon($params) {
        $this->c = new Criteria();
        $this->c->addJoin(NpdefcptPeer :: CODCON, NpasiconnomPeer :: CODCON);
        $this->c->add(NpdefcptPeer :: OPECON, 'A', Criteria :: NOT_EQUAL);
        $this->c->add(NpdefcptPeer :: ORDPAG, 'S');
        $this->c->add(NpasiconnomPeer :: CODNOM, $params[0]);

        $this->columnas = array(
            NpdefcptPeer :: CODCON => 'Codigo',
            NpdefcptPeer :: NOMCON => 'Descripcion'
        );
    }

    /*     * *******************   Compras/almdespser  *********************** */

    public function Nphojint_Almdespser() {
        $this->c = new Criteria();
        $this->c->add(NphojintPeer::STAEMP, 'A');

        $this->columnas = array(
            NphojintPeer :: CODEMP => 'Código',
            NphojintPeer :: NOMEMP => 'Nombre',
            NphojintPeer :: STAEMP => 'Estatus'
        );
    }

    /*     * ******************************Orden de Compra*********************************************** */

    public function Caconpag_Almordcom() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(CaconpagPeer :: CODCONPAG);

        $this->columnas = array(
            CaconpagPeer :: CODCONPAG => 'Código',
            CaconpagPeer :: DESCONPAG => 'Descripción',
        );
    }

    public function Catippro_Almordcom() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(CatipproPeer :: CODPRO);

        $this->columnas = array(
            CatipproPeer :: CODPRO => 'Código',
            CatipproPeer :: DESPRO => 'Descripción',
        );
    }

    public function Caforent_Almordcom() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(CaforentPeer :: CODFORENT);

        $this->columnas = array(
            CaforentPeer :: CODFORENT => 'Código',
            CaforentPeer :: DESFORENT => 'Descripción',
        );
    }

    public function Fortipfin_Almordcom($params=array()) {
        $this->c = new Criteria();
        $finpre=H::getConfApp2('finpre', 'compras', 'almsolegr');
        if ($finpre=='S'){
            if (count($params) > 0) {
                if ($params[0] != "") {
                    $this->c->add(CpdisfuefinPeer::CODPRE, $params[0]);
                    $this->c->add(CpdisfuefinPeer::ORIGEN,'INICIAL');
                    $this->c->addJoin(FortipfinPeer::CODFIN, CpdisfuefinPeer::FUEFIN);
                }
            }
        }
        $this->c->addAscendingOrderByColumn(FortipfinPeer :: CODFIN);

        $this->columnas = array(
            FortipfinPeer :: CODFIN => 'Código',
            FortipfinPeer :: NOMEXT => 'Descripción',
        );
    }

    public function Bnubica_Almordcom() {

        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(BnubicaPeer :: CODUBI);

        $this->columnas = array(
            BnubicaPeer :: CODUBI => 'Código',
            BnubicaPeer :: DESUBI => 'Descripción',
        );
    }

    public function Nphojint_Almordcom() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(NphojintPeer :: CODEMP);

        $this->columnas = array(
            NphojintPeer :: CODEMP => 'Código',
            NphojintPeer :: NOMEMP => 'Descripción',
            NphojintPeer :: STAEMP => 'Estatus'
        );
    }

    public function Caregart_Almordcom($params = array()) {
        $longitud = $params[0];
        $this->c = new Criteria();
        $this->sql = "length(Codart) = '" . $longitud . "'";
        $this->c->add(CaregartPeer :: CODART, $this->sql, Criteria :: CUSTOM);

        $this->columnas = array(
            CaregartPeer :: CODART => 'Código',
            CaregartPeer :: DESART => 'Descripción',
            CaregartPeer :: COSPRO => 'Costo',
            CaregartPeer :: UNIMED => 'Unidad',
            CaregartPeer :: CODPAR => 'Partida',
            CaregartPeer :: CODBAR => 'Código Barra'
        );
    }

    public function Npcatpre_Almordcom() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(NpcatprePeer :: CODCAT);

        $this->columnas = array(
            NpcatprePeer :: CODCAT => 'Código',
            NpcatprePeer :: NOMCAT => 'Nombre'
        );
    }

    /*     * ****************************** Despachos  ************************************** */

    public function Cadefalm_Almdes() {
        $this->c = new Criteria();
        //   $this->c->addAscendingOrderByColumn(CadefalmPeer::CODALM);
        $this->columnas = array(
            CadefalmPeer :: CODALM => 'Codigo',
            CadefalmPeer :: NOMALM => 'Descripcion'
        );
    }

    public function Careqart_Almdes() {
        $manreqcie = H::getConfApp2('manreqcie', 'compras', 'almdesp');
        if ($manreqcie == 'S')
            $cadena = " and (Careqart.stadesp<>'C' or Careqart.stadesp is null)";
        else
            $cadena = "";

        $loguse= sfContext::getInstance()->getUser()->getAttribute('loguse');
        $filsoldir=H::getConfApp2('filsoldir', 'compras', 'almsolegr');
        if ($filsoldir=='S')
          $cadena.=' and careqart.coddirec in (select coddirec from "SIMA_USER".segdirusu where loguse=\''.$loguse.'\')';


        $this->c = new Criteria();
        $this->c->addJoin(CareqartPeer :: REQART, CaartreqPeer :: REQART);
        $this->sql = "(Caartreq.canrec < Caartreq.canreq) and careqart.stareq<>'N' and Careqart.aprreq='S' " . $cadena . "";
        $this->c->add(CaartreqPeer :: CANREQ, $this->sql, Criteria :: CUSTOM);
        $this->c->setDistinct();

        $this->columnas = array(
            CareqartPeer :: REQART => 'Codigo',
            CareqartPeer :: DESREQ => 'Descripcion'
        );
    }

    public function Bnubibie_Almdes() {
        $longitudUbic = Herramientas :: getX_vacio('codins', 'bndefins', 'lonubi', '001');
        if ($longitudUbic == '')
            $longitudUbic = 0;
        $this->c = new Criteria();
        $this->sql = "length(Codubi) = '" . $longitudUbic . "'";
        $this->c->add(BnubibiePeer :: CODUBI, $this->sql, Criteria :: CUSTOM);
        $this->columnas = array(
            BnubibiePeer :: CODUBI => 'Código',
            BnubibiePeer :: DESUBI => 'Descripción',
        );
    }

    /*     * ************************* Formulacion : Fordefgen : Definiciones Generales ****************** */

    public function Fordefparegr_Fordefgen($param = array()) {
        /*   sql = "Select NomParEgr Partida, CodParEgr From " .
          "ForDefParEgr " .
          "where to_char(length(rtrim(CodParEgr))) =  '" + CStr(LongitudPartida) + "' " .
          Order By CodParEgr"
         */
        //$LongitudPartida = strlen(str_replace('@','#',$param[0]));

        /*
          if ($param[0]!='No Encontrado'){ $LongitudPartida = strlen($param[0]); }else {$LongitudPartida=0;}
          $this->c= new Criteria();
          $this->sql = "length(codparegr) = '".$LongitudPartida."'";
          echo $param[0];
          $this->c->add(FordefparegrPeer::CODPAREGR, $this->sql, Criteria::CUSTOM);
          //   $this->c->addAscendingOrderByColumn(FordefparegrPeer::CODPAREGR);
         */
        $this->c = new Criteria();
//    $this->c->add(FordefparegrPeer::CODPAREGR, $this->sql, Criteria::CUSTOM);
        $this->c->addAscendingOrderByColumn(FordefparegrPeer::CODPAREGR);


        $this->columnas = array(FordefparegrPeer::CODPAREGR => 'Partida', FordefparegrPeer::NOMPAREGR => 'Nombre de la Partida');
    }

    public function Cpasiini_Pagemiord() {
        $this->c = new Criteria();
        $this->c->add(CpasiiniPeer :: PERPRE, '00');

        $this->columnas = array(
            CpasiiniPeer :: CODPRE => 'Código Presupuestario',
            CpasiiniPeer :: NOMPRE => 'Descripción',
        );
    }

    /*     * ************************* Bienes: Disposición de Muebles ****************** */

    public function Bnmotdis_Biedisactmuenew() {
        $this->c = new Criteria();
        $this->columnas = array(
            BnmotdisPeer :: CODMOT => 'Código',
            BnmotdisPeer :: DESMOT => 'Descripción'
        );
    }

    public function Bnregmue_Biedisactmuenew() {
        $this->c = new Criteria();
        $this->c->add(BnregmuePeer::STAMUE, 'D', Criteria::NOT_EQUAL);

        $this->columnas = array(
            BnregmuePeer :: CODACT => 'Código Catalogo',
            BnregmuePeer :: CODMUE => 'Código Activo',
            BnregmuePeer :: DESMUE => 'Descripción',
            BnregmuePeer :: VALINI => 'Valoración Inicial',
            BnregmuePeer :: CODUBI => 'Código Ubicación',
            BnregmuePeer :: CODALT => 'Código Alterno'
        );
    }

    public function Bnregmue_Biedisactmuenew1() {
        $this->c = new Criteria();
        $this->c->add(BnregmuePeer::STAMUE, 'D', Criteria::NOT_EQUAL);

        $this->columnas = array(
            BnregmuePeer :: CODMUE => 'Código Activo',
            BnregmuePeer :: CODACT => 'Código Catalogo',
            BnregmuePeer :: DESMUE => 'Descripción',
            BnregmuePeer :: VALINI => 'Valoración Inicial',
            BnregmuePeer :: CODUBI => 'Código Ubicación',
            BnregmuePeer :: CODALT => 'Código Alterno'
        );
    }

    public function Bnubibie_Biedisactmuenew() {
        $this->c = new Criteria();
        $this->columnas = array(
            BnubibiePeer :: CODUBI => 'Código',
            BnubibiePeer :: DESUBI => 'Descripción',
            BnubibiePeer :: DIRUBI => 'Dirección'
        );
    }

    public function Bnreginm_Biedisactinm() {
        $this->c = new Criteria();
        $this->c->add(BnreginmPeer::STAINM, 'D', Criteria::NOT_EQUAL);

        $this->columnas = array(
            BnreginmPeer :: CODACT => 'Código Catalogo',
            BnreginmPeer :: CODINM => 'Código Activo',
            BnreginmPeer :: DESINM => 'Descripción',
            BnreginmPeer :: VALINI => 'Valor Inicial',
            BnreginmPeer :: CODUBI => 'Código de Ubicación'
        );
    }

    public function Bnreginm_Biedisactinm1() {
        $this->c = new Criteria();
        $this->c->add(BnreginmPeer::STAINM, 'D', Criteria::NOT_EQUAL);

        $this->columnas = array(
            BnreginmPeer :: CODINM => 'Código Activo',
            BnreginmPeer :: CODACT => 'Código Catalogo',
            BnreginmPeer :: DESINM => 'Descripción',
            BnreginmPeer :: VALINI => 'Valor Inicial',
            BnreginmPeer :: CODUBI => 'Código de Ubicación'
        );
    }

    public function Bnregmue_Bieregsegmue1() {
        $this->c = new Criteria();
        $this->c->add(BnregmuePeer::STAMUE, 'A');

        $this->columnas = array(
            BnregmuePeer :: CODACT => 'Código Nivel',
            BnregmuePeer :: CODMUE => 'Código Activo',
            BnregmuePeer :: DESMUE => 'Descripción',
            BnregmuePeer :: CODALT => 'Cod. Alterno'
        );
    }

    public function Bnreginm_Bieregseginm1() {
        $this->c = new Criteria();
        $this->columnas = array(
            BnreginmPeer :: CODINM => 'Código Activo',
            BnreginmPeer :: CODACT => 'Código Nivel',
            BnreginmPeer :: DESINM => 'Descripción'
        );
    }

    public function Npnomina_Presnomdefpre() {
        $this->c = new Criteria();
        $this->c->addJoin(NpnominaPeer :: CODNOM, NpasiconnomPeer :: CODNOM);
        $this->c->setDistinct();
        $this->columnas = array(
            NpnominaPeer :: CODNOM => 'Código',
            NpnominaPeer :: NOMNOM => 'Descripción',
            NpnominaPeer :: FRECAL => 'Frecuencia'
        );
    }

    public function Npnomina_Nomtipo() {
        $this->c = new Criteria();
        $this->c->addJoin(NpasiconnomPeer :: CODNOM, NpnominaPeer :: CODNOM);
        $this->c->setDistinct();
        $this->columnas = array(
            NpnominaPeer :: CODNOM => 'Código',
            NpnominaPeer :: NOMNOM => 'Descripción',
            NpnominaPeer :: FRECAL => 'Frecuencia'
        );
    }

    public function Empleadobanco_Npnomina() {
        $this->c = new Criteria();
        $this->columnas = array(
            NpnominaPeer :: CODNOM => 'Codigo De La Nomina',
            NpnominaPeer :: NOMNOM => 'Descripción'
        );
    }

    public function Presnomregsalint_Nptipcon() {
        $this->c = new Criteria();
        $this->columnas = array(
            NptipconPeer :: CODTIPCON => 'Codigo',
            NptipconPeer :: DESTIPCON => 'Descripción'
        );
    }

    public function Presnomreghisantpre_Npantpre() {
        $this->c = new Criteria();
        $this->c->add(NphojintPeer :: STAEMP, 'R', Criteria :: NOT_EQUAL);
        $this->c->addJoin(NpasiempcontPeer :: CODEMP, NphojintPeer :: CODEMP);
        $this->c = new Criteria();
        $this->columnas = array(
            NpasiempcontPeer :: CODEMP => 'Codigo',
            NpasiempcontPeer :: NOMEMP => 'Nombre'
        );
    }

    public function Vacdiasbonovac_Npnomina() {
        $this->c = new Criteria();
        $this->columnas = array(
            NpnominaPeer :: CODNOM => 'Codigo De La Nomina',
            NpnominaPeer :: NOMNOM => 'Descripción'
        );
    }

    public function Npasiconemp_Nomtipo($params) {
        $filconusu=H::getConfApp2('filconusu', 'nomina', 'npforasiconemp');
        $loguse=sfContext::getInstance()->getUser()->getAttribute('loguse');

        $this->c = new Criteria();
        $this->c->add(NpasiconnomPeer :: CODNOM, $params[0]);
        if ($filconusu=='S') {
          $sql='npdefcpt.codcon in (select codcon from "SIMA_USER".segconusu where loguse=\''.$loguse.'\')';
          $this->c->add(NpdefcptPeer::CODCON, $sql, Criteria::CUSTOM);
        }
        $this->c->addJoin(NpdefcptPeer :: CODCON, NpasiconnomPeer :: CODCON);

        $this->columnas = array(
            NpdefcptPeer :: NOMCON => 'Nombre del Concepto',
            NpdefcptPeer :: CODCON => 'Código'
        );
    }

    public function Npdefmov_nomnommovnomcon() {
        $filnomusu = H::getConfApp2('filnomusu', 'nomina', 'nomnommovnomemp');
        $loguse = sfContext::getInstance()->getUser()->getAttribute('loguse');
        $this->c = new Criteria();
        if ($filnomusu == 'S') {
            $this->sql = 'npnomina.codnom in (select codnom from "SIMA_USER".segusunom where loguse=\'' . $loguse . '\')';
            $this->c->add(NpnominaPeer::CODNOM, $this->sql, Criteria::CUSTOM);
        }
        $this->c->addJoin(NpdefmovPeer :: CODNOM, NpnominaPeer :: CODNOM);
        $this->c->setDistinct();

        $this->columnas = array(
            NpnominaPeer:: NOMNOM => 'Nombre Nómina',
            NpnominaPeer:: CODNOM => 'Código'
        );
    }

    public function Npdefcpt_nomnommovnomcon($params) {
        $filconusu = H::getConfApp2('filconusu', 'nomina', 'npforasiconemp');
        $loguse = sfContext::getInstance()->getUser()->getAttribute('loguse');

        $this->c = new Criteria();
        $this->c->add(NpdefmovPeer :: CODNOM, $params[0]);
        if ($filconusu == 'S') {
            $this->sql = 'npdefcpt.codcon in (select codcon from "SIMA_USER".segconusu where loguse=\'' . $loguse . '\')';
            $this->c->add(NpdefcptPeer::CODCON, $this->sql, Criteria::CUSTOM);
        }
        $this->c->addJoin(NpdefmovPeer :: CODCON, NpdefcptPeer :: CODCON);
        $this->c->setDistinct();

        $this->columnas = array(
            NpdefcptPeer :: NOMCON => 'Nombre del Concepto',
            NpdefcptPeer :: CODCON => 'Código'
        );
    }

    public function Npasiconemp_nomnommovnomconcar($params) {
        $this->c = new Criteria();
        $this->c->add(NpasiconempPeer :: CODCON, $params[0]);

        $this->c->addSelectColumn("'' as CODEMP");
        $this->c->addSelectColumn("'' as CODCON");
        $this->c->addSelectColumn(NpasiconempPeer :: CODCAR);
        $this->c->addSelectColumn("'' as NOMEMP");
        $this->c->addSelectColumn("'' as NOMCOM");
        $this->c->addSelectColumn(NpasiconempPeer :: NOMCAR);
        $this->c->addSelectColumn("0 as CANTIDAD");
        $this->c->addSelectColumn("0 as MONTO");
        $this->c->addSelectColumn("'1937-01-01' as FECINI");
        $this->c->addSelectColumn("'1937-01-01' as FECEXP");
        $this->c->addSelectColumn("0 as FRECON");
        $this->c->addSelectColumn("'' as ASIDED");
        $this->c->addSelectColumn("'' as ACUCON");
        $this->c->addSelectColumn("'' as CALCON");
        $this->c->addSelectColumn("'' as ACTIVO");
        $this->c->addSelectColumn("'' as ACUMULADO");
        $this->c->addSelectColumn("'' as VARIA");
        $this->c->addSelectColumn("max(ID) as ID");
        $this->c->addGroupByColumn(NpasiconempPeer :: CODCAR);
        $this->c->addGroupByColumn(NpasiconempPeer :: NOMCAR);

        $this->columnas = array(
            NpasiconempPeer :: NOMCAR => 'Nombre del Cargo',
            NpasiconempPeer :: CODCAR => 'Código'
        );
    }

    ///////////////  Formulacion: fortiting
    public function Fordefparing_Fortiting($params = array()) {
        $longitudpartida = $params[0];
        $this->c = new Criteria();
        $this->sql = "length(Codparing) = '" . $longitudpartida . "'";
        $this->c->add(FordefparingPeer :: CODPARING, $this->sql, Criteria :: CUSTOM);

        /* sql = "Select NomParIng Descripcion, CodParIng Codigo From ForDefParIng " .
          "where length(rtrim(CodParIng)) =  " & LongitudPartida & " Order By CodParIng"
         */
        $this->columnas = array(
            FordefparingPeer :: CODPARING => 'Código',
            FordefparingPeer :: NOMPARING => 'Descripción'
        );
    }

    ///////////////
    /*     * ************************* Compras: Recepción de Ordenes de Compra ****************** */
    public function Camotfal_Almordrec() {
        $this->c = new Criteria();

        $this->columnas = array(
            CamotfalPeer :: CODFAL => 'Código',
            CamotfalPeer :: DESFAL => 'Descripción'
        );
    }

    public function Npasicaremp_nomnommovnomemp($params) {

        $this->c = new Criteria();
        $this->c->add(NpasicarnomPeer :: CODNOM, $params[0]);
        $this->c->addJoin(NpasicarempPeer :: CODCAR, NpasicarnomPeer :: CODCAR);
        $this->c->add(NpasicarempPeer :: STATUS, 'V');
        $this->c->setDistinct();

        $this->columnas = array(
            NpasicarempPeer :: NOMEMP => 'Nombre del Empleado',
            NpasicarempPeer :: CODEMP => 'Código'
        );
    }

    public function Npasiconemp_nomnommovnomemp($params) {
        $this->c = new Criteria();
        $this->c->add(NpasiconempPeer :: CODEMP, $params[0]);
        $this->c->addSelectColumn("'' as CODEMP");
        $this->c->addSelectColumn("'' as CODCON");
        $this->c->addSelectColumn(NpasiconempPeer :: CODCAR);
        $this->c->addSelectColumn("'' as NOMEMP");
        $this->c->addSelectColumn("'' as NOMCOM");
        $this->c->addSelectColumn(NpasiconempPeer :: NOMCAR);
        $this->c->addSelectColumn("0 as CANTIDAD");
        $this->c->addSelectColumn("0 as MONTO");
        $this->c->addSelectColumn("'1937-01-01' as FECINI");
        $this->c->addSelectColumn("'1937-01-01' as FECEXP");
        $this->c->addSelectColumn("0 as FRECON");
        $this->c->addSelectColumn("'' as ASIDED");
        $this->c->addSelectColumn("'' as ACUCON");
        $this->c->addSelectColumn("'' as CALCON");
        $this->c->addSelectColumn("'' as ACTIVO");
        $this->c->addSelectColumn("'' as ACUMULADO");
        $this->c->addSelectColumn("'' as VARIA");
        $this->c->addSelectColumn("max(ID) as ID");
        $this->c->addGroupByColumn(NpasiconempPeer :: CODCAR);
        $this->c->addGroupByColumn(NpasiconempPeer :: NOMCAR);

        $this->columnas = array(
            NpasiconempPeer :: NOMCAR => 'Nombre del Cargo',
            NpasiconempPeer :: CODCAR => 'Código'
        );
    }

    public function Npperfil_Nomdefespcar() {
        $this->c = new Criteria();

        $this->columnas = array(
            NpperfilPeer :: CODPERFIL => 'Código',
            NpperfilPeer :: DESPERFIL => 'Descripción'
        );
    }

    /*     * ************************* Obras: Retenciones ****************** */

    public function Contabb_Oycdefret() {
        $this->c = new Criteria();

        $this->columnas = array(
            ContabbPeer :: CODCTA => 'Código',
            ContabbPeer :: DESCTA => 'Descripción'
        );
    }

    public function Npnomesptipos_nomespdefinicion($params=array()) {
        $this->c = new Criteria();
        $this->c->setDistinct();

        $this->columnas = array(
            NpnomesptiposPeer :: DESNOMESP => 'Nombre de la Nomina',
            NpnomesptiposPeer :: CODNOMESP => 'Código'
        );
    }

    /*     * *******************   OBRAS  *********************** */

    public function octipcar_oycdefper() {
        $this->c = new Criteria();
        $this->columnas = array(
            OctipcarPeer :: CODTIPCAR => 'Código',
            OctipcarPeer :: DESTIPCAR => 'Descripción'
        );
    }

    public function octippro_oycdefper() {
        $this->c = new Criteria();
        $this->columnas = array(
            OctipproPeer :: CODTIPPRO => 'Código',
            OctipproPeer :: DESTIPPRO => 'Descripción'
        );
    }

    public function Oycregsol_ocdatste() {
        $this->c = new Criteria();
        $this->columnas = array(
            OcdatstePeer :: CEDSTE => 'Cedula de Identidad',
            OcdatstePeer :: NOMSTE => 'Nombre'
        );
    }

    public function Oycregsol_octipsol() {
        $this->c = new Criteria();
        $this->columnas = array(
            OctipsolPeer :: CODSOL => 'Código',
            OctipsolPeer :: DESSOL => 'Descripción'
        );
    }

    public function Oycregsol_ocdeforg() {
        $this->c = new Criteria();
        $this->columnas = array(
            OcdeforgPeer :: CODORG => 'Código',
            OcdeforgPeer :: DESORG => 'Descripción'
        );
    }

    public function Oycregsol_nphojint() {
        $this->c = new Criteria();
        $this->columnas = array(
            NphojintPeer :: CODEMP => 'Código Empleado',
            NphojintPeer :: NOMEMP => 'Nombre',
            NphojintPeer :: STAEMP => 'Estatus'
        );
    }

    public function oycdatsol_octipste() {
        $this->c = new Criteria();
        $this->columnas = array(
            OctipstePeer :: CODSTE => 'Código',
            OctipstePeer :: DESSTE => 'Descripción'
        );
    }

    public function oyregpro_octipespe() {
        $this->c = new Criteria();
        $this->columnas = array(
            OctipespPeer :: CODTIPESP => 'Código',
            OctipespPeer :: DESTIPESP => 'Descripción'
        );
    }

    public function oycressol_nphojint() {
        $this->c = new Criteria();
        $this->columnas = array(
            NphojintPeer :: CODEMP => 'Código Empleado',
            NphojintPeer :: NOMEMP => 'Nombre',
            NphojintPeer :: STAEMP => 'Estatus'
        );
    }

    public function Octipact_Oycdefemp() {
        $this->c = new Criteria();
        $this->columnas = array(
            OctipactPeer :: CODTIPACT => 'Código',
            OctipactPeer :: DESTIPACT => 'Nombre'
        );
    }

    /*  Nominas especiales - Conceptos       */

    public function Npnomesptipos_nomespconceptos($params) {
        $this->c = new Criteria();
        $this->c->setDistinct();

        $this->columnas = array(
            NpnomesptiposPeer :: DESNOMESP => 'Nombre de la Nomina',
            NpnomesptiposPeer :: CODNOMESP => 'Código'
        );
    }

    public function Npnomespnomtip_nomespconceptos($params) {
        $this->c = new Criteria();
        $this->c->add(NpnomespnomtipPeer :: CODNOMESP, $params[0]);
        $this->c->addJoin(NpnomespnomtipPeer :: CODNOMESP, NpnomesptiposPeer :: CODNOMESP);
        $this->c->addJoin(NpnomespnomtipPeer :: CODNOM, NpnominaPeer :: CODNOM);

        $this->columnas = array(
            NpnominaPeer :: NOMNOM => 'Nombre/Nómina',
            NpnominaPeer :: CODNOM => 'Código'
        );
    }

    public function Nphojint_Nomjorlabind() {
        $this->c = new Criteria();

        $this->columnas = array(
            NphojintPeer :: CEDEMP => 'Cédula',
            NphojintPeer :: NOMEMP => 'Nombre',
            NphojintPeer :: STAEMP => 'Estatus'
        );
    }

    public function Npdefjorlab_Nomjorlabind($params) {
        $this->c = new Criteria();
        $this->c->add(NpdefjorlabPeer :: CODNOM, $params[0]);

        $this->columnas = array(
            NpdefjorlabPeer :: IDEJOR => 'Jornada',
            NpdefjorlabPeer :: CODNOM => 'Nómina'
        );
    }

    public function Nptipaportes_Nomdefconaportes() {
        $this->c = new Criteria();

        $this->columnas = array(
            NptipaportesPeer :: CODTIPAPO => 'Código',
            NptipaportesPeer :: DESTIPAPO => 'Descripción'
        );
    }

    public function Nppais_Nomdefespest() {
        $this->c = new Criteria();

        $this->columnas = array(
            NppaisPeer :: CODPAI => 'Código',
            NppaisPeer :: NOMPAI => 'Nombre'
        );
    }

    public function Npestado_Nomdefespciu($params) {
        $this->c = new Criteria();
        $this->c->add(NpestadoPeer :: CODPAI, $params[0]);

        $this->columnas = array(
            NpestadoPeer :: CODEDO => 'Código',
            NpestadoPeer :: NOMEDO => 'Nombre'
        );
    }

    public function Catiprec_Oycdefrec() {
        $this->c = new Criteria();
        $this->columnas = array(
            CatiprecPeer :: CODTIPREC => 'Codigó',
            CatiprecPeer :: DESTIPREC => 'Descripción'
        );
    }

    public function Npbancos_EmpleadosBanco() {
        $this->c = new Criteria();
        $this->columnas = array(
            NpbancosPeer :: CODBAN => 'Código',
            NpbancosPeer :: NOMBAN => 'Descripción'
        );
    }

    /*     * ************************* Compras: Almdespser ****************** */

    public function Npcatpre_Almdespser() {
        $this->c = new Criteria();

        $this->columnas = array(
            NpcatprePeer :: CODCAT => 'Código',
            NpcatprePeer :: NOMCAT => 'Descripción'
        );
    }

    public function Careqartser_Almdespser() {
        $this->c = new Criteria();

        $this->columnas = array(
            CareqartserPeer :: REQART => 'Código',
            CareqartserPeer :: DESREQ => 'Descripción'
        );
    }

    /*     * ************************* Nomina: Tipos de Contratos Colectivos:presnomtipcon ****************** */

    public function Npnomina_Presnomtipcon() {
        $this->c = new Criteria();
        $this->columnas = array(
            NpnominaPeer :: CODNOM => 'Codigó',
            NpnominaPeer :: NOMNOM => 'Descripción'
        );
    }

    public function Nptipcon_Presnomtipcon() {
        $this->c = new Criteria();
        $this->columnas = array(
            NptipconPeer :: CODTIPCON => 'Codigó',
            NptipconPeer :: DESTIPCON => 'Descripción'
        );
    }

    /*     * ************************* Nomina: Tipos de Contratos Colectivos:presnomtipcon ****************** */

    public function Npdefcpt_Presnomasiconpre($params) {
        $this->c = new Criteria();
        $this->c->addJoin(NpdefcptPeer :: CODCON, NpasiconnomPeer :: CODCON);
        $this->c->addJoin(NpasiconnomPeer :: CODNOM, NpasinomcontPeer :: CODNOM);
        $this->sql = "and Npasinomcont.codtipcon = '" . $params[0] . "' Order By Npdefcpt.codcon";
        $this->c->add(NpdefcptPeer :: CODCON, $this->sql, Criteria :: CUSTOM);

        //"Select Distinct NomCon Descripcion, a.CodCon From NPDefCpt a,NPasiConNom b, NPASINOMCONT c where (a.opecon='A' OR a.opecon='D') and a.codcon=b.codcon and b.codnom = c.codnom and c.codtipcon = '" & DatosIns(CodCon) & "' Order By a.codcon"

        $this->columnas = array(
            NpdefcptPeer :: CODCON => 'Codigó',
            NpdefcptPeer :: NOMCON => 'Descripción'
        );
    }

    public function Npdefcpt_Nomdefconaportes($params) {
        $this->c = new Criteria();
        $this->c->addJoin(NpdefcptPeer :: CODCON, NpasiconnomPeer :: CODCON);
        $this->c->add(NpasiconnomPeer :: CODNOM, $params[0]);

        $this->columnas = array(
            NpdefcptPeer :: CODCON => 'Codigo',
            NpdefcptPeer :: NOMCON => 'Descripcion'
        );
    }

    public function Nptipcon_Presnomasiconpre() {
        $this->c = new Criteria();
        $this->columnas = array(
            NptipconPeer :: CODTIPCON => 'Codigó',
            NptipconPeer :: DESTIPCON => 'Descripción'
        );
    }

    public function Nphojint_Vacsalidas() {
        $this->c = new Criteria();
        $this->columnas = array(
            NphojintPeer :: CODEMP => 'Codigó del Empleado',
            NphojintPeer :: NOMEMP => 'Nombre del empleado',
            NphojintPeer :: FECING => 'Fecha de Ingreso',
            NphojintPeer :: STAEMP => 'Estatus'
        );
    }

    public function Npcargos_Nomhojint($params = array()) {
        $this->c = new Criteria();
        if (count($params) > 0) {
            if ($params[0] != "")
                $this->c->add(NpcargosPeer :: CARVAN, 0, Criteria::GREATER_THAN);
        }
        $this->columnas = array(
            NpcargosPeer :: CODCAR => 'Código',
            NpcargosPeer :: NOMCAR => 'Descripción del Cargo',
            NpcargosPeer :: SUECAR => 'Sueldo',
            NpcargosPeer :: COMCAR => 'Compensación'
        );
    }

    public function Caregart_Almtraalm($params = array()) {
        $longitud = $params[0];
        $this->c = new Criteria();
        $artseparados = H::getConfAppGen('artseparados');
        if ($artseparados == 'S') {
            $modulo = sfContext::getInstance()->getUser()->getAttribute('menu', '', 'autenticacion');
            if ($modulo == 'facturacion')
                $this->sql = "length(Codart) = '" . $longitud . "' and tipo='A' and tipreg='F'";
            else
                $this->sql = "length(Codart) = '" . $longitud . "' and tipo='A' and (tipreg<>'F' or tipreg is null)";
        }
        else
            $this->sql = "length(Codart) = '" . $longitud . "' and tipo='A'";

        $this->c->add(CaregartPeer :: CODART, $this->sql, Criteria :: CUSTOM);

        $this->columnas = array(
            CaregartPeer :: CODART => 'Código',
            CaregartPeer :: DESART => 'Descripción',
            CaregartPeer :: UNIMED => 'Unidad de Medida',
            CaregartPeer :: EXITOT => 'Existencia',
            CaregartPeer :: CODBAR => 'Código Barra'
        );
    }

    public function Cacatsnc_Almregart() {
        $this->c = new Criteria();

        $this->columnas = array(
            CacatsncPeer :: CODSNC => 'Código',
            CacatsncPeer :: DESSNC => 'Descripción'
        );
    }

    public function Catipempsnc_Almregpro() {
        $this->c = new Criteria();

        $this->columnas = array(
            CatipempsncPeer :: CODTIP => 'Código',
            CatipempsncPeer :: DESTIP => 'Descripción',
        );
    }

    ////////////////////////////////////////////////Almprocomart////////////////////////////////////////

    public function Npcatpre_Almprocomart() {
        $this->c = new Criteria();
        $this->columnas = array(
            NpcatprePeer :: CODCAT => 'Código',
            NpcatprePeer :: NOMCAT => 'Descripción'
        );
    }

    public function Caconpag_Almcotiza() {
        $this->c = new Criteria();

        $this->columnas = array(
            CaconpagPeer :: CODCONPAG => 'Código',
            CaconpagPeer :: DESCONPAG => 'Descripción'
        );
    }

    public function Caregart_Almprocomart($params = array()) {
        $longitud = $params[0];
        $this->c = new Criteria();
        $this->sql = "length(Codart) = '" . $longitud . "'";
        $this->c->add(CaregartPeer :: CODART, $this->sql, Criteria :: CUSTOM);

        $this->columnas = array(
            CaregartPeer :: CODART => 'Código',
            CaregartPeer :: DESART => 'Descripción',
            CaregartPeer :: UNIMED => 'Unidad de Medida',
            CaregartPeer :: EXITOT => 'Existencia',
            CaregartPeer :: CODBAR => 'Código Barra'
        );
    }

    public function Cadefubi_Almdes($params = array()) {
        $this->c = new Criteria();
        $this->c->addJoin(CadefubiPeer :: CODUBI, CaalmubiPeer :: CODUBI);
        $this->c->add(CaalmubiPeer :: CODALM, $params[0]);
        $this->c->addAscendingOrderByColumn(CadefubiPeer::CODUBI);

        $this->columnas = array(
            CadefubiPeer :: CODUBI => 'Código Ubicación',
            CadefubiPeer :: NOMUBI => 'Nombre'
        );
    }

    public function Npnomina_Nomnomcienom() {
        $this->c = new Criteria();
        $this->columnas = array(
            NpnominaPeer :: CODNOM => 'Código',
            NpnominaPeer :: NOMNOM => 'Descripción',
            NpnominaPeer :: ULTFEC => 'Ultima Fecha de Procesamiento',
            NpnominaPeer :: FRECAL => 'Frecuencia de Calculo',
            NpnominaPeer :: PROFEC => 'Próxima Fecha de Procesamiento'
        );
    }

    public function Npconceto_Nomdefesptippre() {
        $this->c = new Criteria();
        $this->columnas = array(
            NpdefcptPeer :: CODCON => 'Código',
            NpdefcptPeer :: NOMCON => 'Descripción'
        );
    }

    public function Nphispre_Nomperhispre() {
        $this->c = new Criteria();
        $this->columnas = array(
            NphojintPeer :: CODEMP => 'Código',
            NphojintPeer :: NOMEMP => 'Nombre',
            NphojintPeer :: STAEMP => 'Estatus'
        );
    }

    public function Nptippre_Nomperhispre() {
        $this->c = new Criteria();
        $this->columnas = array(
            NptipprePeer :: CODTIPPRE => 'Código',
            NptipprePeer :: DESTIPPRE => 'Descripción'
        );
    }

    public function Usuarios_Apliuser() {
        $this->c = new Criteria();
        $this->columnas = array(
            UsuariosPeer :: CEDEMP => 'Cédula',
            UsuariosPeer :: NOMUSE => 'Nombre',
            UsuariosPeer :: LOGUSE => 'Usuario'
        );
    }

    public function Casolart_Almcotiza($params = array()) {
        //Este es el SQL Original
        //Select A.DesReq as descripcion,A.ReqArt as codigo,A.FecReq as fecha,A.MonReq as monto from CASolArt A,CAArtSol B
        // Where A.ReqArt=B.ReqArt and A.StaReq=¿A¿ Group By A.DesReq,A.ReqArt,A.FecReq,A.MonReq Having sum(coalesce(CanReq,0))>Sum(coalesce(CanOrd,0)) order by A.ReqArt,A.FecReq";
        $nivapradi=H::getConfApp2('nivapradi', 'compras', 'almsolegr');

        $this->c = new Criteria();
        $this->c->clearSelectColumns();
        $this->c->addSelectColumn(CasolartPeer :: REQART);
        $this->c->addSelectColumn(CasolartPeer :: FECREQ);
        $this->c->addSelectColumn(CasolartPeer :: DESREQ);
        $this->c->addSelectColumn(CasolartPeer :: MONREQ);
        $this->c->addSelectColumn("'' as STAREQ");
        $this->c->addSelectColumn("'' as MOTREQ");
        $this->c->addSelectColumn("'' as BENREQ");
        $this->c->addSelectColumn("'' as MONDES");
        $this->c->addSelectColumn("'' as OBSREQ");
        $this->c->addSelectColumn("'' as UNIRES");
        $this->c->addSelectColumn("'' as TIPMON");
        $this->c->addSelectColumn("'' as VALMON");
        $this->c->addSelectColumn("'1937-01-01' as FECANU");
        $this->c->addSelectColumn("'' as CODPRO");
        $this->c->addSelectColumn("'' as REQCOM");
        $this->c->addSelectColumn("'' as TIPFIN");
        $this->c->addSelectColumn("'' as TIPREQ");
        $this->c->addSelectColumn("'' as APRREQ");
        $this->c->addSelectColumn("'' as USUAPR");
        $this->c->addSelectColumn("'1937-01-01' as FECAPR");
        $this->c->addSelectColumn("'' as CODEMP");
        $this->c->addSelectColumn("'' as CODCEN");
        $this->c->addSelectColumn("'' as CODEVE");
        $this->c->addSelectColumn("'' as CODDIREC");
        $this->c->addSelectColumn("'' as CODDIVI");
        $this->c->addSelectColumn("'' as LOGUSE");
        $this->c->addSelectColumn("'1937-01-01' as FECANA");
        $this->c->addSelectColumn("'' as CODUBI");
        $this->c->addSelectColumn("'' as NOMBEN");
        $this->c->addSelectColumn("'' as CEDRIF");
        $this->c->addSelectColumn("'1937-01-01' as FECSAL");
        $this->c->addSelectColumn("'' as HORSAL");
        $this->c->addSelectColumn("'1937-01-01' as FECREG");
        $this->c->addSelectColumn("'' as HORREG");
        $this->c->addSelectColumn("'' as CODREG");
        $this->c->addSelectColumn("'' as PREBAS");
        $this->c->addSelectColumn("'' as LUGENT");
        $this->c->addSelectColumn("'' as APRGESADM");
        $this->c->addSelectColumn("'' as USUAPRGAD");
        $this->c->addSelectColumn("'1937-01-01' as FECAPRGAD");
        $this->c->addSelectColumn("'' as APRDIRADQ");
        $this->c->addSelectColumn("'' as USUAPRDAD");
        $this->c->addSelectColumn("'1937-01-01' as FECAPRDAD");
        $this->c->addSelectColumn("'' as ID");

        $this->c->addJoin(CasolartPeer :: REQART, CaartsolPeer :: REQART);
        $this->c->add(CasolartPeer :: STAREQ, "A");
        if ($nivapradi=='S')
          $this->c->add(CasolartPeer :: APRDIRADQ, "S");    //Verifica si la solicitud de egreso esta aprobada
        else
          $this->c->add(CasolartPeer :: APRREQ, "S");    //Verifica si la solicitud de egreso esta aprobada


        if (isset($params[0]))
            if ($params[0] != '') {
                $this->sql2 = " casolart.reqart not in (select refprc from cpprecom)";
                $this->sql3 = " casolart.reqart in (select refprc from cpprecom)";
                $loguse= sfContext::getInstance()->getUser()->getAttribute('loguse');
                $filsoldir=H::getConfApp2('filsoldir', 'compras', 'almsolegr');
                if ($filsoldir=='S'){
                  $this->sql2.=' and casolart.coddirec in (select coddirec from "SIMA_USER".segdirusu where loguse=\''.$loguse.'\')';
                  $this->sql3.=' and casolart.coddirec in (select coddirec from "SIMA_USER".segdirusu where loguse=\''.$loguse.'\')';
                }
                if (H::getX_vacio('TipCom', 'CpDocCom', 'RefPrc', str_replace('*', '/', $params[0])) == 'N')
                    $this->c->add(CasolartPeer :: REQART, $this->sql2, Criteria::CUSTOM);
                else
                    $this->c->add(CasolartPeer :: REQART, $this->sql3, Criteria::CUSTOM);
            }


        $sub = $this->c->getNewCriterion(CasolartPeer :: REQART, 'SUM(COALESCE(' . CaartsolPeer :: CANREQ . ',0)) > SUM(COALESCE(' . CaartsolPeer :: CANORD . ',0))', Criteria :: CUSTOM);
        $this->c->addHaving($sub);
        $this->c->addGroupByColumn(CasolartPeer :: REQART);
        $this->c->addGroupByColumn(CasolartPeer :: FECREQ);
        $this->c->addGroupByColumn(CasolartPeer :: DESREQ);
        $this->c->addGroupByColumn(CasolartPeer :: MONREQ);
        $this->c->addAscendingOrderByColumn(CasolartPeer :: REQART);
        $this->c->addAscendingOrderByColumn(CasolartPeer :: FECREQ);

        $this->columnas = array(
            CasolartPeer :: REQART => 'Número',
            CasolartPeer :: DESREQ => 'Descripción',
        );
    }

    public function Casolart_Almcotizacion() {
        //Este es el SQL Original
        //Select A.DesReq as descripcion,A.ReqArt as codigo,A.FecReq as fecha,A.MonReq as monto from CASolArt A,CAArtSol B
        // Where A.ReqArt=B.ReqArt and A.StaReq=¿A¿ Group By A.DesReq,A.ReqArt,A.FecReq,A.MonReq Having sum(coalesce(CanReq,0))>Sum(coalesce(CanOrd,0)) order by A.ReqArt,A.FecReq";

        $this->c = new Criteria();
        $this->c->clearSelectColumns();
        $this->c->addSelectColumn(CasolartPeer :: REQART);
        $this->c->addSelectColumn(CasolartPeer :: FECREQ);
        $this->c->addSelectColumn(CasolartPeer :: DESREQ);
        $this->c->addSelectColumn(CasolartPeer :: MONREQ);
        $this->c->addSelectColumn("'' as STAREQ");
        $this->c->addSelectColumn("'' as MOTREQ");
        $this->c->addSelectColumn("'' as BENREQ");
        $this->c->addSelectColumn("'' as MONDES");
        $this->c->addSelectColumn("'' as OBSREQ");
        $this->c->addSelectColumn("'' as UNIRES");
        $this->c->addSelectColumn("'' as TIPMON");
        $this->c->addSelectColumn("'' as VALMON");
        $this->c->addSelectColumn("'1937-01-01' as FECANU");
        $this->c->addSelectColumn("'' as CODPRO");
        $this->c->addSelectColumn("'' as REQCOM");
        $this->c->addSelectColumn("'' as TIPFIN");
        $this->c->addSelectColumn("'' as TIPREQ");
        $this->c->addSelectColumn("'' as APRREQ");
        $this->c->addSelectColumn("'' as USUAPR");
        $this->c->addSelectColumn("'1937-01-01' as FECAPR");
        $this->c->addSelectColumn("'' as CODEMP");
        $this->c->addSelectColumn("'' as CODCEN");
        $this->c->addSelectColumn("'' as CODEVE");
        $this->c->addSelectColumn("'' as CODDIREC");
        $this->c->addSelectColumn("'' as CODDIVI");
        $this->c->addSelectColumn("'' as LOGUSE");
        $this->c->addSelectColumn("'1937-01-01' as FECANA");
        $this->c->addSelectColumn("'' as CODUBI");
        $this->c->addSelectColumn("'' as NOMBEN");
        $this->c->addSelectColumn("'' as CEDRIF");
        $this->c->addSelectColumn("'1937-01-01' as FECSAL");
        $this->c->addSelectColumn("'' as HORSAL");
        $this->c->addSelectColumn("'1937-01-01' as FECREG");
        $this->c->addSelectColumn("'' as HORREG");
        $this->c->addSelectColumn("'' as CODREG");
        $this->c->addSelectColumn("'' as PREBAS");
        $this->c->addSelectColumn("'' as LUGENT");
        $this->c->addSelectColumn("'' as APRGESADM");
        $this->c->addSelectColumn("'' as USUAPRGAD");
        $this->c->addSelectColumn("'1937-01-01' as FECAPRGAD");
        $this->c->addSelectColumn("'' as APRDIRADQ");
        $this->c->addSelectColumn("'' as USUAPRDAD");
        $this->c->addSelectColumn("'1937-01-01' as FECAPRDAD");
        $this->c->addSelectColumn("'' as ID");

        $loguse= sfContext::getInstance()->getUser()->getAttribute('loguse');
        $filsoldir=H::getConfApp2('filsoldir', 'compras', 'almsolegr');

        $this->c->addJoin(CasolartPeer :: REQART, CaartsolPeer :: REQART);
        $this->c->add(CasolartPeer :: STAREQ, "A");
        if ($filsoldir=='S') {
          $sql = 'casolart.coddirec in (select coddirec from "SIMA_USER".segdirusu where loguse=\''.$loguse.'\')';
          $this->c->add(CasolartPeer :: CODDIREC, $sql, Criteria :: CUSTOM);
        }

        $sub = $this->c->getNewCriterion(CasolartPeer :: REQART, 'SUM(COALESCE(' . CaartsolPeer :: CANREQ . ',0)) > SUM(COALESCE(' . CaartsolPeer :: CANORD . ',0))', Criteria :: CUSTOM);
        $this->c->addHaving($sub);
        $this->c->addGroupByColumn(CasolartPeer :: REQART);
        $this->c->addGroupByColumn(CasolartPeer :: FECREQ);
        $this->c->addGroupByColumn(CasolartPeer :: DESREQ);
        $this->c->addGroupByColumn(CasolartPeer :: MONREQ);
        $this->c->addAscendingOrderByColumn(CasolartPeer :: REQART);
        $this->c->addAscendingOrderByColumn(CasolartPeer :: FECREQ);

        $this->columnas = array(
            CasolartPeer :: REQART => 'Número',
            CasolartPeer :: DESREQ => 'Descripción'
        );
    }

    public function CaOrdCom_Almordrec() {
        //Este es el SQL Original
        // $sql="Select a.OrdCom as Codigo,a.FecOrd as Fecha, a.DesOrd as Descripcion from CaOrdCom a,CPCompro b,CPDocCom c where a.StaOrd<>'N' and a.OrdCom=b.RefCom and b.TipCom=C.TipCom and (c.refprc<>'N' or  c.afeprc<>'N' or c.afecom<>'N' or c.afedis<>'N') order by a.OrdCom";
        $this->c = new Criteria();
        $this->c->addJoin(CaordcomPeer :: ORDCOM, CpcomproPeer :: REFCOM);
        $this->c->addJoin(CpcomproPeer :: TIPCOM, CpdoccomPeer :: TIPCOM);
        $this->c->add(CaordcomPeer :: STAORD, "N", Criteria :: NOT_EQUAL);
        //$sub = $this->c->getNewCriterion(CpdoccomPeer :: REFPRC, "N", Criteria :: NOT_EQUAL);
        //$sub->addOr($this->c->getNewCriterion(CpdoccomPeer :: AFEPRC, "N", Criteria :: NOT_EQUAL));
        //$sub->addOr($this->c->getNewCriterion(CpdoccomPeer :: AFECOM, "N", Criteria :: NOT_EQUAL));
        //$sub->addOr($this->c->getNewCriterion(CpdoccomPeer :: AFEDIS, "N", Criteria :: NOT_EQUAL));
        //$this->c->add($sub);

        $this->c->addJoin(CaordcomPeer :: ORDCOM, CaartordPeer :: ORDCOM);
        $this->c->add(CaartordPeer::CERART, null);
        $this->sql = "Caartord.canord - Caartord.canaju > Caartord.canrec ";
        $this->c->add(CaartordPeer :: CANORD, $this->sql, Criteria :: CUSTOM);
        $this->c->setDistinct();

        $this->c->addAscendingOrderByColumn(CaordcomPeer :: ORDCOM);

        $this->columnas = array(
            CaordcomPeer :: ORDCOM => 'Código',
            CaordcomPeer :: FECORD => 'Fecha',
            CaordcomPeer :: DESORD => 'Descripción'
        );
    }

    public function Bndefact_Bieregactmued() {
        //$sql="select a.CodAct as codigo_nivel,a.DesAct as activo From BNDEFACT a, BNDEFINS b where length(RTrim(a.CodAct))=b.LonAct And codact like '2%%' Order By CodAct";
        $filcat = "";
        $varemp = sfContext::getInstance()->getUser()->getAttribute('configemp');
        if ($varemp)
            if (array_key_exists('aplicacion', $varemp))
                if (array_key_exists('bienes', $varemp['aplicacion']))
                    if (array_key_exists('modulos', $varemp['aplicacion']['bienes']))
                        if (array_key_exists('bieregactmued', $varemp['aplicacion']['bienes']['modulos'])) {
                            if (array_key_exists('filcat', $varemp['aplicacion']['bienes']['modulos']['bieregactmued'])) {
                                $filcat = $varemp['aplicacion']['bienes']['modulos']['bieregactmued']['filcat'];
                            }
                        }
        $this->c = new Criteria();
        $this->sql = "cast (BNDEFINS.LonAct as integer)=length(RTrim(BNDEFACT.CodAct)) and  (codact like '" . $filcat . "%%')";
        $this->c->add(BndefinsPeer :: LONACT, $this->sql, Criteria :: CUSTOM);
        $this->c->addAscendingOrderByColumn(BndefactPeer :: CODACT);

        $this->columnas = array(
            BndefactPeer :: CODACT => 'Código Nivel',
            BndefactPeer :: DESACT => 'Descripción',
            BndefactPeer :: VIDUTI => 'Vida Útil',
        );
    }

    public function Bndefact_Bieregactinm() {
        //$sql="select a.CodAct as codigo_nivel,a.DesAct as activo From BNDEFACT a, BNDEFINS b where length(RTrim(a.CodAct))=b.LonAct And codact like '1%%' Order By CodAct";
        $filcat = "";
        $varemp = sfContext::getInstance()->getUser()->getAttribute('configemp');
        if ($varemp)
            if (array_key_exists('aplicacion', $varemp))
                if (array_key_exists('bienes', $varemp['aplicacion']))
                    if (array_key_exists('modulos', $varemp['aplicacion']['bienes']))
                        if (array_key_exists('bieregactinmd', $varemp['aplicacion']['bienes']['modulos'])) {
                            if (array_key_exists('filcat', $varemp['aplicacion']['bienes']['modulos']['bieregactinmd'])) {
                                $filcat = $varemp['aplicacion']['bienes']['modulos']['bieregactinmd']['filcat'];
                            }
                        }
        $this->c = new Criteria();
        $this->sql = "cast (BNDEFINS.LonAct as integer)=length(RTrim(BNDEFACT.CodAct)) and  (codact like '" . $filcat . "%%')";
        $this->c->add(BndefinsPeer :: LONACT, $this->sql, Criteria :: CUSTOM);
        $this->c->addAscendingOrderByColumn(BndefactPeer :: CODACT);

        $this->columnas = array(
            BndefactPeer :: CODACT => 'Código Nivel',
            BndefactPeer :: DESACT => 'Descripción',
            BndefactPeer :: VIDUTI => 'Vida Útil',
        );
    }

    ////////////////////////////////////////////   PRESUPUESTO   ////////////////////////////////////////

    public function Cpprecom_Preprecom() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(CpprecomPeer :: REFPRC);

        $this->columnas = array(
            CpprecomPeer :: REFPRC => 'Referencia',
            CpprecomPeer :: DESPRC => 'Descripción'
        );
    }

    public function Cpcompro_Precompro() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(CpcomproPeer :: REFCOM);

        $this->columnas = array(
            CpcomproPeer :: REFCOM => 'Referencia',
            CpcomproPeer :: DESCOM => 'Descripción'
        );
    }

    public function Cpcausad_PreCausar() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(CpcausadPeer :: REFCAU);

        $this->columnas = array(
            CpcausadPeer :: REFCAU => 'Referencia',
            CpcausadPeer :: DESCAU => 'Descripción'
        );
    }

    public function Cppagos_PrePagar() {
        $this->c = new Criteria();
        $this->c->addJoin(CppagosPeer :: REFPAG, TsmovlibPeer :: REFPAG, Criteria::LEFT_JOIN);
        $this->c->addAscendingOrderByColumn(CppagosPeer :: REFPAG);
        $this->c->addAscendingOrderByColumn(TsmovlibPeer :: NUMCUE);

        $this->columnas = array(
            CppagosPeer::REFPAG => 'Referencia',
            CppagosPeer::DESPAG => 'Descripción',
            TsmovlibPeer::REFLIB => 'N/Cheque',
            TsmovlibPeer::NUMCUE => 'Nro. Cuenta'
        );
    }

    public function Cpdeftit_Pretitpre() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(CpdeftitPeer :: CODPRE);

        $this->columnas = array(
            CpdeftitPeer :: CODPRE => 'Referencia',
            CpdeftitPeer :: NOMPRE => 'Descripción'
        );
    }

    public function Cpsoltrasla_Presoltrasla() {
         $this->c = new Criteria();
         $loguse= sfContext::getInstance()->getUser()->getAttribute('loguse');
         $filsoldir3=H::getConfApp2('filsoldir', 'presupuesto', 'preprecom');

         if ($filsoldir3=='S'){
          $sql='cpsoltrasla.coddirec in (select coddirec from "SIMA_USER".segdirusu where loguse=\''.$loguse.'\')';
          $this->c->add(CpsoltraslaPeer::CODDIREC,$sql,Criteria::CUSTOM);
        }
        $this->c->addAscendingOrderByColumn(CpsoltraslaPeer :: REFTRA);

        $this->columnas = array(
            CpsoltraslaPeer :: REFTRA => 'Referencia',
            CpsoltraslaPeer :: DESTRA => 'Descripción'
        );
    }

    public function Cpsoltrasla_PreTrasla() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(CpsoltraslaPeer :: REFTRA);

        $this->columnas = array(
            CpsoltraslaPeer :: REFTRA => 'Referencia',
            CpsoltraslaPeer :: DESTRA => 'Descripción'
        );
    }

    public function Cpsoladidis_PreSolAdiDis() {
        $this->c = new Criteria();
        $loguse= sfContext::getInstance()->getUser()->getAttribute('loguse');
         $filsoldir3=H::getConfApp2('filsoldir', 'presupuesto', 'preprecom');

         if ($filsoldir3=='S'){
          $sql='cpsoladidis.coddirec in (select coddirec from "SIMA_USER".segdirusu where loguse=\''.$loguse.'\')';
          $this->c->add(CpsoladidisPeer::CODDIREC,$sql,Criteria::CUSTOM);
        }
        $this->c->addAscendingOrderByColumn(CpsoladidisPeer :: REFADI);

        $this->columnas = array(
            CpsoladidisPeer :: REFADI => 'Referencia',
            CpsoladidisPeer :: DESADI => 'Descripción'
        );
    }

    public function Cpadidis_PreAdiDis() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(CpadidisPeer :: REFADI);

        $this->columnas = array(
            CpadidisPeer :: REFADI => 'Referencia',
            CpadidisPeer :: DESADI => 'Descripción'
        );
    }

    public function Cpajuste_PreAjuste() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(CpajustePeer :: REFAJU);

        $this->columnas = array(
            CpajustePeer :: REFAJU => 'Referencia',
            CpajustePeer :: DESAJU => 'Descripción'
        );
    }

    public function Cpartley_Preartley() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(CpartleyPeer :: CODART);

        $this->columnas = array(
            CpartleyPeer :: CODART => 'Referencia',
            CpartleyPeer :: DESART => 'Descripción'
        );
    }

    public function Cpdocprc_Predocpre() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(CpdocprcPeer :: TIPPRC);

        $this->columnas = array(
            CpdocprcPeer :: TIPPRC => 'Tipo Documento',
            CpdocprcPeer :: NOMEXT => 'Nombre Extendido'
        );
    }

    public function Cpdocpag_Predocpag() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(CpdocpagPeer :: TIPPAG);

        $this->columnas = array(
            CpdocpagPeer :: TIPPAG => 'Tipo Documento',
            CpdocpagPeer :: NOMEXT => 'Nombre Extendido'
        );
    }

    public function Cpdoccom_Predoccom() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(CpdoccomPeer :: TIPCOM);

        $this->columnas = array(
            CpdoccomPeer :: TIPCOM => 'Tipo Documento',
            CpdoccomPeer :: NOMEXT => 'Nombre Extendido'
        );
    }

    public function Cpdoccau_Predoccau() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(CpdoccauPeer :: TIPCAU);

        $this->columnas = array(
            CpdoccauPeer :: TIPCAU => 'Tipo Documento',
            CpdoccauPeer :: NOMEXT => 'Nombre Extendido'
        );
    }

    public function Cpdocaju_Predocaju() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(CpdocajuPeer :: TIPAJU);

        $this->columnas = array(
            CpdocajuPeer :: TIPAJU => 'Tipo Documento',
            CpdocajuPeer :: NOMEXT => 'Nombre Extendido'
        );
    }

    public function Cptrasla_PreTrasla() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(CptraslaPeer::REFTRA);

        $this->columnas = array(CptraslaPeer::REFTRA => 'Referencia', CptraslaPeer::DESTRA => 'Descripción');
    }

    public function Pretitpre_Contabb() {

        //Se busca el codigo de la cta de egreso
        $ctaegreso = '';
        $c = new Criteria();
        //Se quito por orden de Edgar y Vaneesa Escalona
        //$reg = ContabaPeer::doSelectone($c);
        //if ($reg){ $ctaegreso = $reg->getCodegd();
        //}else{ echo "No se ha definido la Cuenta de Egrego";}

        $this->c = new Criteria();
        $this->c->add(ContabbPeer::CARGAB, 'C');
        //$this->c->add(ContabbPeer::CODCTA,$ctaegreso.'%',Criteria::LIKE);
        $this->c->addAscendingOrderByColumn(ContabbPeer::CODCTA);

        $this->columnas = array(ContabbPeer::CODCTA => 'Cuenta', ContabbPeer::DESCTA => 'Descripción');
    }

    public function Preasiini_Cpdeftit() {
        $this->c = new Criteria();
        $this->sql = "length(cpdeftit.codpre) = length(cpdefniv.forpre)";
        $categoriasusu = sfContext::getInstance()->getUser()->getAttribute('categoriasusu');
        if ($categoriasusu != '') {
            $aux = explode('*', $categoriasusu);
            for ($a = 0; $a < count($aux); $a++) {
                if ($a == 0)
                    $this->sql = $this->sql . " and (" . CpdeftitPeer::CODPRE . " like '" . $aux[$a] . "%' ";
                else if ($a == (count($aux) - 1))
                    $this->sql = $this->sql . " or " . CpdeftitPeer::CODPRE . " like '" . $aux[$a] . "%' ";
                else
                    $this->sql = $this->sql . " or " . CpdeftitPeer::CODPRE . " like '" . $aux[$a] . "%'";
            }
            $this->sql = $this->sql . ")";
        }

        $this->c->add(CpdefnivPeer :: FORPRE, $this->sql, Criteria :: CUSTOM);
        $this->c->addAscendingOrderByColumn(CpdeftitPeer::CODPRE);

        $this->columnas = array(
            CpdeftitPeer::CODPRE => 'Código Presupuestario',
            CpdeftitPeer::NOMPRE => 'Descripción'
        );
    }

    public function Preasipar_Cpdeftit($params = array()) {
        //'Select nompre as Descripcion, codpre as Codigo from cpdeftit where length(rtrim(codpre))='+LonCat+' - 1 and upper(nompre)

        $this->c = new Criteria();
        $this->sql = "length(cpdeftit.codpre) = " . ($params[0] - 1);
        $this->c->add(CpdeftitPeer :: CODPRE, $this->sql, Criteria :: CUSTOM);
        $this->c->addAscendingOrderByColumn(CpdeftitPeer::CODPRE);

        $this->columnas = array(
            CpdeftitPeer::CODPRE => 'Código Presupuestario',
            CpdeftitPeer::NOMPRE => 'Descripción'
        );
    }

    public function Preprecom_Cpdocprc($params = array()) {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(CpdocprcPeer::TIPPRC);

        $this->columnas = array(
            CpdocprcPeer::TIPPRC => 'Tipo',
            CpdocprcPeer::NOMEXT => 'Descripción'
        );
    }

    public function Preprecom_Opbenefi($params = array()) {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(OpbenefiPeer::CEDRIF);

        $this->columnas = array(
            OpbenefiPeer::CEDRIF => 'Cédula/Rif',
            OpbenefiPeer::NOMBEN => 'Nombre'
        );
    }

    public function Preprecom_Cpasiini($params = array()) {
        //sql='select a.codpre as codigo, a.nompre as descripcion from cpasiini a, cpdefniv b where length(rtrim(a.codpre))= length(rtrim(b.forpre)) and a.perpre=�00� and a.mondis > 0 and UPPER(a.nompre) like upper(�%�) order by a.codpre';
        //$this->sql="casolart.unires in (select codcat from causuuni where loguse='".$loguse."')";
        //$c->add(CasolartPeer::UNIRES,$this->sql,Criteria::CUSTOM);

        $this->c = new Criteria();
        $this->sql = "length(cpasiini.codpre) = length(cpdefniv.forpre)";
        $this->c->add(CpdefnivPeer :: FORPRE, $this->sql, Criteria :: CUSTOM);
        $this->c->add(CpasiiniPeer :: PERPRE, '00');
        //$this->c->add(CpasiiniPeer :: MONDIS, 0, Criteria::GREATER_THAN);

        $this->c->addAscendingOrderByColumn(CpasiiniPeer::CODPRE);

        $this->columnas = array(
            CpasiiniPeer::CODPRE => 'Código Presupuestario',
            CpasiiniPeer::NOMPRE => 'Descripción'
        );
    }

    public function Precompro_Cpdoccom($params = array()) {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(CpdoccomPeer::TIPCOM);
        $this->c->addAscendingOrderByColumn(CpdoccomPeer::NOMEXT);

        $this->columnas = array(
            CpdoccomPeer::TIPCOM => 'Tipo',
            CpdoccomPeer::NOMEXT => 'Descripción',
            CpdoccomPeer::REFPRC => 'Refiere'
        );
    }

    public function PreCompro_Cpasiini($params = array()) {
        $this->c = new Criteria();
        $this->c->addJoin(CpasiiniPeer :: CODPRE, CpdeftitPeer :: CODPRE);
        $this->c->add(CpasiiniPeer :: PERPRE, '00');
        //$this->c->add(CpasiiniPeer :: MONDIS, 0, Criteria::GREATER_EQUAL);
// $this->c->add(AtayudasPeer::ID,"ID NOT IN (SELECT atayudas_id FROM atestsoceco)",Criteria::CUSTOM);
        $this->c->addAscendingOrderByColumn(CpasiiniPeer::CODPRE);

        $this->columnas = array(
            CpasiiniPeer::CODPRE => 'Código Presupuestario',
            CpasiiniPeer::NOMPRE => 'Descripción'
        );
    }

    public function Precausar_Cpdoccau() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(CpdoccauPeer :: TIPCAU);

        $this->columnas = array(
            CpdoccauPeer :: TIPCAU => 'Tipo Documento',
            CpdoccauPeer :: NOMEXT => 'Nombre Extendido',
            CpdoccauPeer :: REFIER => 'Refiere'
        );
    }

    public function Prepagar_Cpdocpag() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(CpdocpagPeer :: TIPPAG);

        $this->columnas = array(
            CpdocpagPeer :: TIPPAG => 'Tipo Documento',
            CpdocpagPeer :: NOMEXT => 'Nombre Extendido',
            CpdocpagPeer :: REFIER => 'Refiere',
            CpdocpagPeer :: AFEDIS => 'Afecta Disponibilidad'
        );
    }

    public function PrePagar_Cpasiini($params = array()) {
        $this->c = new Criteria();
        $this->sql = "length(cpasiini.codpre) = length(cpdefniv.forpre)";
        $this->c->add(CpdefnivPeer :: FORPRE, $this->sql, Criteria :: CUSTOM);
        $this->c->add(CpasiiniPeer :: PERPRE, '00');
        //$this->c->add(CpasiiniPeer :: MONDIS, 0, Criteria::GREATER_THAN);

        $this->c->addAscendingOrderByColumn(CpasiiniPeer::CODPRE);

        $this->columnas = array(
            CpasiiniPeer::CODPRE => 'Código Presupuestario',
            CpasiiniPeer::NOMPRE => 'Descripción'
        );
    }

    public function Presoltrasla_Cpasiini($params = array()) {
        $this->c = new Criteria();
        $this->c->addJoin(CpasiiniPeer :: CODPRE, CpdeftitPeer :: CODPRE);
        $this->c->add(CpasiiniPeer :: PERPRE, '00');
        //$this->c->add(CpasiiniPeer :: MONDIS, 0, Criteria::GREATER_EQUAL);

        $this->c->addAscendingOrderByColumn(CpasiiniPeer::CODPRE);

        $this->columnas = array(
            CpasiiniPeer::CODPRE => 'Código Presupuestario',
            CpasiiniPeer::NOMPRE => 'Descripción',
            'cpasiini.MONDISOBTEJE' => 'Disponible',
        );
    }

    public function Presoltrasla_Cpasiini2($params = array()) {
        $this->c = new Criteria();
        $this->c->addJoin(CpasiiniPeer :: CODPRE, CpdeftitPeer :: CODPRE);
        $this->c->add(CpasiiniPeer :: PERPRE, '00');

        $this->c->addAscendingOrderByColumn(CpasiiniPeer::CODPRE);

        $this->columnas = array(
            CpasiiniPeer::CODPRE => 'Código Presupuestario',
            CpasiiniPeer::NOMPRE => 'Descripción',
            CpasiiniPeer :: MONDIS => 'Disponible',
        );
    }

    public function Cpasiini_Presoladidis($params = array()) {

        /* 	sql='select a.codpre as codigo, a.nompre as descripcion, mondis as Disponible ' .
          'From ' .
          'cpasiini a, CPDEFTIT b ' .
          'Where ' .
          'upper(a.nompre) like upper(¿%¿) and  ' .
          'a.codpre=b.codpre and ' .
          'a.perpre=¿00¿ and ' .
          'a.monasi>=0  ' .
          'order by ' .
          'a.codpre';
         */
        $this->c = new Criteria();
        $this->c->addJoin(CpasiiniPeer :: CODPRE, CpdeftitPeer :: CODPRE);
        $this->c->add(CpasiiniPeer :: PERPRE, '00');
        $this->c->add(CpasiiniPeer :: MONASI, '0', Criteria::GREATER_EQUAL);

        $this->c->addAscendingOrderByColumn(CpasiiniPeer::CODPRE);

        $this->columnas = array(
            CpasiiniPeer::CODPRE => 'Código Presupuestario',
            CpasiiniPeer::NOMPRE => 'Descripción',
            CpasiiniPeer::MONDIS => 'Disponible',
        );
    }

    //////////////////////////////////////////// ////////////////////////////////////////////
    ////////////////// CONTABILIDAD FINANCIERA ///////////////////

    public function Contabc_ConFinCom() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(ContabcPeer :: NUMCOM);
        $this->c->addAscendingOrderByColumn(ContabcPeer :: FECCOM);
        $this->c->addAscendingOrderByColumn(ContabcPeer :: STACOM);

        $this->columnas = array(
            ContabcPeer :: NUMCOM => 'Numero',
            ContabcPeer :: DESCOM => 'Descripcion',
            ContabcPeer :: FECCOM => 'Fecha',
            ContabcPeer :: STACOM => 'Estatus',
            ContabcPeer :: REFTRA => 'Referencia',
            ContabcPeer :: MONCOM => 'Monto',
        );
    }

    public function Contabcm_ConFinCom() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(ContabcmPeer::NUMCOM);
        $this->c->addAscendingOrderByColumn(ContabcmPeer::FECCOM);
        $this->c->addAscendingOrderByColumn(ContabcmPeer::STACOM);

        $this->columnas = array(
            ContabcmPeer :: NUMCOM => 'Numero',
            ContabcmPeer :: DESCOM => 'Descripcion',
            ContabcmPeer :: FECCOM => 'Fecha',
            ContabcmPeer :: STACOM => 'Estatus',
            ContabcmPeer :: REFTRA => 'Referencia',
        );
    }

    /////////////////////////////////////////////////////////////
    ////////////////// OBRAS Y CONTRATOS ///////////////////
    public function Caprovee_Ocoferpre() {
        $this->c = new Criteria();
        $this->c->addJoin(CaproveePeer :: CODPRO, OcproespPeer :: CODPRO);
        $this->c->addAscendingOrderByColumn(CaproveePeer :: CODPRO);

        $this->columnas = array(
            CaproveePeer :: CODPRO => 'Contratista',
            CaproveePeer :: NOMPRO => 'Nombre'
        );
    }

    public function Obras_Ocoferpre() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(OcregobrPeer :: CODOBR);

        $this->columnas = array(
            OcregobrPeer :: CODOBR => 'Código',
            OcregobrPeer :: DESOBR => 'Descripción',
            OcregobrPeer :: CODPRE => 'Código Presupuestario'
        );
    }

    public function Obras_Ocadjobr() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(OcregobrPeer :: CODOBR);

        $this->columnas = array(
            OcregobrPeer :: CODOBR => 'Código',
            OcregobrPeer :: DESOBR => 'Descripción',
            OcregobrPeer :: CODTIPOBR => 'Tipo',
            OcregobrPeer :: FECINI => 'Fecha Inicio',
            OcregobrPeer :: FECFIN => 'Fecha Fin',
            OcregobrPeer :: MONOBR => 'Monto',
            OcregobrPeer :: CODPRE => 'Código Presupuestario'
        );
    }

    public function Tipofin_Ocreglic() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(FortipfinPeer :: CODFIN);

        $this->columnas = array(
            FortipfinPeer :: CODFIN => 'Fuente de Financiamiento',
            FortipfinPeer :: NOMEXT => 'Nombre'
        );
    }

    public function Clacomp_Ocreglic() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(OcclacompPeer :: CODCLACOMP);

        $this->columnas = array(
            OcclacompPeer :: CODCLACOMP => 'Código Clasif. de Compras',
            OcclacompPeer :: DESCLACOMP => 'Descripción'
        );
    }

    public function Octipcon_Oycdefemp() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(OctipconPeer :: CODTIPCON);

        $this->columnas = array(
            OctipconPeer :: CODTIPCON => 'Código',
            OctipconPeer :: DESTIPCON => 'Descripción'
        );
    }

    public function Octipval_Oycdefemp() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(OctipvalPeer :: CODTIPVAL);

        $this->columnas = array(
            OctipvalPeer :: CODTIPVAL => 'Código',
            OctipvalPeer :: DESTIPVAL => 'Descripción'
        );
    }

    public function Ocdefpar_Oycdefemp() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(OcdefparPeer :: CODPAR);

        $this->columnas = array(
            OcdefparPeer :: CODPAR => 'Código Partida',
            OcdefparPeer :: DESPAR => 'Descripción',
            OcdefparPeer :: CODUNI => 'Unidad',
            OcdefparPeer :: COSUNI => 'Costo'
        );
    }

    public function Unidad_Ocdefpar() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(OcunidadPeer :: CODUNI);

        $this->columnas = array(
            OcunidadPeer :: CODUNI => 'Código Unidad',
            OcunidadPeer :: DESUNI => 'Descripción'
        );
    }

    public function Octipobr_Oycdesobr() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(OctipobrPeer :: CODTIPOBR);

        $this->columnas = array(
            OctipobrPeer :: CODTIPOBR => 'Tipo de Obra',
            OctipobrPeer :: DESTIPOBR => 'Descripción'
        );
    }

    public function Carecaud_Oycregpro($param) {
        $this->c = new Criteria();
        $this->c->add(CarecaudPeer :: CODTIPREC, $param[0]);

        $this->columnas = array(
            CarecaudPeer :: CODREC => 'Codigo',
            CarecaudPeer :: DESREC => 'Descripción'
        );
    }

    public function Ocdefper_Oycregpro() {
        $this->c = new Criteria;
        $this->c->addJoin(OcdefperPeer :: CODTIPPRO, OctipproPeer :: CODTIPPRO);
        $this->c->addJoin(OcdefperPeer :: CODTIPCAR, OctipcarPeer :: CODTIPCAR);

        $this->columnas = array(
            OcdefperPeer :: CEDPER => 'Cédula',
            OcdefperPeer :: NOMPER => 'Nombre',
            OctipproPeer :: DESTIPPRO => 'Profesión',
            OctipcarPeer :: DESTIPCAR => 'Cargo'
        );
    }

    public function Ocdefequ_Oycregpro() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(OcdefequPeer :: CODEQU);

        $this->columnas = array(
            OcdefequPeer :: CODEQU => 'Código',
            OcdefequPeer :: DESEQU => 'Descripción'
        );
    }

    public function Caprovee_Oycregcon() {
        $this->c = new Criteria();
        $this->c->addJoin(CaproveePeer :: CODPRO, OcproespPeer :: CODPRO);
        $this->columnas = array(
            CaproveePeer :: CODPRO => 'Codigo',
            CaproveePeer :: NOMPRO => 'Nombre'
        );
    }

    public function Ocdefper_Oycdescon($param) {
        $c = new Criteria();
        $data = OcdefempPeer :: doSelectOne($c);
        if ($data) {
            if ($param[1] != $data->getCodconins() and $param[1] != $data->getCodconsup() and $param[1] != $data->getCodconpro()) {
                $this->c = new Criteria;
                $this->c->add(OcproperPeer :: CODPRO, $param[0]);
                $this->c->addJoin(OcdefperPeer :: CEDPER, OcproperPeer :: CEDPER);
                $this->c->addJoin(OcdefperPeer :: CODTIPCAR, OcdefempPeer :: CODINGRES);
                $this->c->addJoin(OcdefperPeer :: CODTIPCAR, OctipcarPeer :: CODTIPCAR);
                $this->c->addJoin(OcdefempPeer :: CODINGRES, OctipcarPeer :: CODTIPCAR);
            } else {
                if ($param[1] == $data->getCodconins() or $param[1] == $data->getCodconsup() or $param[1] == $data->getCodconpro()) {
                    $this->c = new Criteria;
                    $this->c->add(OcproperPeer :: CODPRO, $param[0]);
                    $this->c->addJoin(OcdefperPeer :: CEDPER, OcproperPeer :: CEDPER);
                    $this->c->addJoin(OcdefperPeer :: CODTIPCAR, OctipcarPeer :: CODTIPCAR);
                }
            }
        }

        $this->columnas = array(
            OcdefperPeer :: CEDPER => 'Cédula',
            OcdefperPeer :: NOMPER => 'Nombre'
        );
    }

    public function Octipret_Oycdescon() {
        $this->c = new Criteria();

        $this->columnas = array(
            OctipretPeer :: CODTIP => 'Código',
            OctipretPeer :: DESTIP => 'Descripción',
            OctipretPeer :: PORRET => '% Retencion',
            OctipretPeer :: BASIMP => 'Base Imponible',
            OctipretPeer :: UNITRI => 'Unidad',
            OctipretPeer :: FACTOR => 'Factor',
            OctipretPeer :: PORSUS => '% Sustraendo',
            OctipretPeer :: STAMON => 'Estatus'
        );
    }

    public function Octipprl_Oycdescon($param) {
        $this->c = new Criteria();
        $this->c->add(OctartipPeer::CODTIPPRO, $param[0]);

        $this->columnas = array(
            OctartipPeer :: NIVPRO => 'Nivel Profesional',
            OctartipPeer :: EXPPRO => 'Experiencia',
            OctartipPeer :: VALHOR => 'Valor Horas'
        );
    }

    public function Octipper_Oycdefper() {
        $this->c = new Criteria();

        $this->columnas = array(
            OctipperPeer :: CODTIPPER => 'Código',
            OctipperPeer :: DESTIPPER => 'Descripción'
        );
    }

    public function Octipequ_Oycdefequ() {
        $this->c = new Criteria();

        $this->columnas = array(
            OctipequPeer :: CODTIPEQU => 'Código',
            OctipequPeer :: DESTIPEQU => 'Descripción'
        );
    }

    public function Octiporg_Oycdeforg() {
        $this->c = new Criteria();

        $this->columnas = array(
            OctiporgPeer :: CODTIPORG => 'Código',
            OctiporgPeer :: DESTIPORG => 'Descripción'
        );
    }

    public function Ocregsol_Oycressol() {
        $this->c = new Criteria();
        $this->c->addJoin(OcregsolPeer :: CEDSTE, OcdatstePeer :: CEDSTE);
        $this->c->addJoin(OcregsolPeer :: CODEMP, NphojintPeer :: CODEMP);

        $this->columnas = array(
            OcregsolPeer :: NUMSOL => 'Nro. Solicitud',
            OcregsolPeer :: DESSOL => 'Descripción',
            OcregsolPeer :: CEDSTE => 'Cédula',
            OcdatstePeer :: NOMSTE => 'Nombre',
            OcregsolPeer :: FECSOL => 'Fecha Recepción',
            OcregsolPeer :: CODEMP => 'Recibido por',
            NphojintPeer :: NOMEMP => 'Nombre',
        );
    }

    public function oyctartip_octipprl() {
        $this->c = new Criteria();

        $this->columnas = array(
            OctipprlPeer :: CODTIPPRO => 'Tipo Profesional',
            OctipprlPeer :: DESTIPPRO => 'Descripción'
        );
    }

    public function Ocinginsobr_Oycregact($param) {
        $this->c = new Criteria();
        $this->c->add(OcinginsobrPeer :: CODOBR, $param[0]);

        $this->columnas = array(
            OcinginsobrPeer :: CEDINS => 'Cédula',
            OcinginsobrPeer :: NOMINS => 'Descripción',
            OcinginsobrPeer :: NUMCIV => 'Nro. CIV'
        );
    }

    public function Ocregcon_Oycregact() {
        $this->c = new Criteria();
        $this->c->add(OcregconPeer :: STACON, 'N', Criteria :: NOT_EQUAL);

        $this->columnas = array(
            OcregconPeer :: CODCON => 'Código',
            OcregconPeer :: DESCON => 'Descripción'
        );
    }

    public function Ocdefpar_Oycinscon($param) {
        $this->c = new Criteria();
        $this->c->add(OcparconPeer :: CODCON, $param[0]);
        $this->c->addJoin(OcparconPeer :: CODPAR, OcdefparPeer :: CODPAR);
        $this->c->addJoin(OcdefparPeer :: CODUNI, OcunidadPeer :: CODUNI);

        $this->columnas = array(
            OcdefparPeer :: CODPAR => 'Código Partida',
            OcdefparPeer :: DESPAR => 'Descripción',
            OcunidadPeer :: ABRUNI => 'Unidad',
            OcparconPeer :: CANCON => 'Cant. Contrada',
            OcparconPeer :: CODCON => 'N° de Contrato'
        );
    }

    public function Presnomasicompre_nptipcon() {
        $this->c = new Criteria();

        $this->columnas = array(
            NptipconPeer :: CODTIPCON => 'Código Contrato',
            NptipconPeer :: DESTIPCON => 'Descripción'
        );
    }

    public function Presnomasicompre_npasipre($param) {
        $c = new Criteria();
        $c->add(NpasiprePeer :: CODCON, $param[0]);
        $rs = NPasiprePeer :: doSelectone($c);

        $this->c = new Criteria();
        if ($rs)
            $this->c->add(NpasiprePeer :: CODCON, $param[0]);

        $this->c->addSelectColumn("'' AS CODCON");
        $this->c->addSelectColumn(NpasiprePeer :: CODASI);
        $this->c->addSelectColumn(NpasiprePeer :: DESASI);
        $this->c->addSelectColumn(NpasiprePeer :: TIPASI);
        $this->c->addSelectColumn(NpasiprePeer :: AFEALIBV);
        $this->c->addSelectColumn(NpasiprePeer :: AFEALIBF);
        $this->c->addSelectColumn("max(ID) AS ID");

        $this->c->addGroupByColumn(NpasiprePeer :: CODASI);
        $this->c->addGroupByColumn(NpasiprePeer :: DESASI);
        $this->c->addGroupByColumn(NpasiprePeer :: TIPASI);
        $this->c->addGroupByColumn(NpasiprePeer :: AFEALIBV);
        $this->c->addGroupByColumn(NpasiprePeer :: AFEALIBF);

        $this->columnas = array(
            NpasiprePeer :: CODASI => 'Código Grupo',
            NpasiprePeer :: DESASI => 'Descripción'
        );
    }

    public function Npdefcpt_Presnomasiconpre_codnom($params = array()) {

        /*
         *  SQL = "Select Distinct NomCon Descripcion, a.CodCon From NPDefCpt a,NPasiConNom b, NPASINOMCONT c
         * where (a.opecon='A' OR a.opecon='D') and a.codcon=b.codcon and b.codnom = c.codnom and c.codtipcon = '" & DatosIns(CodCon) & "'
         * Order By a.codcon"
         */
        $this->c = new Criteria();
        $this->c->addjoin(NpdefcptPeer::CODCON, NpasiconnomPeer::CODCON);
        $this->c->addjoin(NPasiconnomPeer::CODNOM, NpasinomcontPeer::CODNOM);
        $this->c->add(NpasinomcontPeer::CODTIPCON, $params[0]);
        #$sub = $this->c->getNewCriterion(NpdefcptPeer :: OPECON, "A", Criteria :: EQUAL);
        #$sub->addOr($this->c->getNewCriterion(NpdefcptPeer :: OPECON, "D", Criteria :: EQUAL));
        #$this->c->add($sub);
        $this->c->setDistinct();
        $this->c->addAscendingOrderByColumn(NpdefcptPeer::CODCON);
        $this->columnas = array(
            NpdefcptPeer :: CODCON => 'Código',
            NpdefcptPeer :: NOMCON => 'Descripción'
        );
    }

    public function Nptipcon_Presnomregsalint() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(NptipconPeer::CODTIPCON);
        $this->columnas = array(NptipconPeer::CODTIPCON => 'Código del Contrato', NptipconPeer::DESTIPCON => 'Descripción');
    }

    public function Npnomina_Presnomregsalint($params = array()) {
        $this->c = new Criteria();
        $this->c->add(NpasinomcontPeer::CODTIPCON, $params[0]);
        $this->c->addJoin(NpnominaPeer::CODNOM, NpasinomcontPeer::CODNOM);
        $this->c->addAscendingOrderByColumn(NpnominaPeer::CODNOM);
        $this->columnas = array(NpnominaPeer::CODNOM => 'Código de la Nomina', NpnominaPeer::NOMNOM => 'Descripción');
    }

    public function Npnomina_Presnomregsalintind($params = array()) {
        //print $params[0];
        //print $params[1]; exit;
        $this->c = new Criteria();
        $this->c->add(NpasiempcontPeer::CODNOM, $params[0]);
        $this->c->add(NpasiempcontPeer::CODTIPCON, $params[1]);
        $this->c->addAscendingOrderByColumn(NpasiempcontPeer::CODEMP);
        $this->columnas = array(NpasiempcontPeer::CODEMP => 'Código del Empleado', NpasiempcontPeer::NOMEMP => 'Nombre', NpasiempcontPeer::FECCAL => 'Fecha de Calculo');
    }

    public function Opordpag_Nomina() {
        /* Select distinct((CASE when c.cedemp is null THEN b.nomnom else C.NOMEMP||' ('||B.NOMNOM||')' END)) as nomina,
          A.CODNOM as codigo,A.FECNOM as fecha,a.codtipgas as gasto,A.CODBAN as codban
          FROM NPNOMINA B,NPCIENOM A left outer join NPHOJINT C on A.CODBAN=C.CEDEMP
          WHERE A.CODNOM=B.CODNOM AND A.ASIDED<>'P' order by nomina,fecha; */

        $this->c = new Criteria();
        $this->c->addSelectColumn(' distinct((CASE when' . NphojintPeer::CEDEMP . 'is null THEN' . NpnominaPeer::NOMNOM . 'else' . NphojintPeer::NOMEMP . '||(||' . NpnominaPeer::NOMNOM . 'END)) as NOMNOM');
        $this->c->addSelectColumn(NpcienomPeer::CODNOM);
        //$this->c->addSelectColumn(NpnominaPeer::NOMNOM);
        $this->c->addSelectColumn(NpcienomPeer::CODCON);
        $this->c->addSelectColumn(NpcienomPeer::FECNOM);
        $this->c->addSelectColumn(NpcienomPeer::CODPRE);
        $this->c->addSelectColumn(NpcienomPeer::CODCTA);
        $this->c->addSelectColumn(NpcienomPeer::MONTO);
        $this->c->addSelectColumn(NpcienomPeer::ASIDED);
        $this->c->addSelectColumn(NpcienomPeer::CODTIPGAS);
        $this->c->addSelectColumn(NpcienomPeer::CANTIDAD);
        $this->c->addSelectColumn(NpcienomPeer::CODBAN);
        $this->c->addSelectColumn(NpcienomPeer::ESPECIAL);
        $this->c->addSelectColumn(NpcienomPeer::CODNOMESP);
        $this->c->addSelectColumn(NpcienomPeer::NOMNOMESP);
        $this->c->addSelectColumn(NpcienomPeer::ID);
        $this->c->addJoin(NpcienomPeer::CODBAN, NphojintPeer::CEDEMP, Criteria::LEFT_JOIN);
        $sub = $this->c->getNewCriterion(NpcienomPeer::ASIDED, 'P', Criteria::NOT_EQUAL);
        $sub->addJoin($this->c->getNewCriterion(NpcienomPeer::CODNOM, NpnominaPeer::CODNOM));
        $this->c->add($sub);
        //$this->c->addJoin(NpcienomPeer::ASIDED,'P',Criteria::NOT_EQUAL);
        //$this->c->addJoin(NpcienomPeer::CODNOM,NpnominaPeer::CODNOM);
        //$this->c->addAscendingOrderByColumn(NpnominaPeer::NOMNOM);
        //$this->c->addAscendingOrderByColumn(NpcienomPeer::FECNOM);

        $this->columnas = array(//NpnominaPeer::NOMNOM => 'Descripción',
            NpcienomPeer::CODNOM => 'Código de la Nomina', NpcienomPeer::FECNOM => 'Fecha', NpcienomPeer::CODTIPGAS => 'Gasto', NpcienomPeer::CODBAN => 'Banco');
    }

    public function Tsmovlib_tesmovdeglib2() {
        $this->c = new Criteria();
        //    $this->c->addAscendingOrderByColumn(TstipmovPeer::CODTIP);
        $this->columnas = array(TstipmovPeer::CODTIP => 'Codigo', TstipmovPeer::DESTIP => 'Descripcion');
    }

    public function Nphojint_presnomregsalint($params = array()) {
        $this->c = new Criteria();
        $this->c->add(NpasicarempPeer::CODNOM, $params[0]);
        $this->c->add(NpasicarempPeer :: STATUS, 'V');
        $this->c->addJoin(NphojintPeer :: CODEMP, NpasicarempPeer :: CODEMP);
        //$this->c->addJoin(NpasiempcontPeer :: CODNOM, NpasicarempPeer :: CODNOM);
        $this->columnas = array(NpasicarempPeer::CODEMP => 'Código del empleado', NpasicarempPeer::NOMEMP => 'Nombre', NphojintPeer::FECING => 'Fecha Calculo');
        //, NpasiempcontPeer::FECCAL => 'Fecha Calculo'
    }

    public function Caregart_Almentalm($params = array()) {
        $mascaraarticulo = Herramientas::getMascaraArticulo();
        $longitud = strlen($mascaraarticulo);
        $this->c = new Criteria();
        $this->c->add(CaregartPeer :: TIPO, 'A');
        $artseparados = H::getConfAppGen('artseparados');
        if ($artseparados == 'S') {
            $modulo = sfContext::getInstance()->getUser()->getAttribute('menu', '', 'autenticacion');
            if ($modulo == 'facturacion')
                $this->sql = "length(" . CaregartPeer::CODART . ") = '" . $longitud . "' and tipreg='F'";
            else
                $this->sql = "length(" . CaregartPeer::CODART . ") = '" . $longitud . "' and (tipreg<>'F' or tipreg is null)";
        }
        else
            $this->sql = "length(" . CaregartPeer::CODART . ") = '" . $longitud . "'";
        $this->c->add(CaregartPeer :: CODART, $this->sql, Criteria :: CUSTOM);
        if (count($params) > 0) {
            $this->c->addJoin(CaregartPeer::CODART, CaartalmubiPeer::CODART);
            $this->c->add(CaartalmubiPeer::CODALM, $params[0]);
        }

        $this->columnas = array(
            CaregartPeer :: CODART => 'Código',
            CaregartPeer :: DESART => 'Descripción',
            CaregartPeer :: COSULT => 'Costo',
            CaregartPeer :: CODBAR => 'Código Barra'
        );
    }

/////////////// Atencion al Ciudadano ////////////////////////////////

    public function Atsolici_Aciayudas() {

        $this->c = new Criteria();

        $this->columnas = array(AtciudadanoPeer::CEDCIU => 'Cedula', AtciudadanoPeer::NOMCIU => 'Nombre', AtciudadanoPeer::APECIU => 'Apellido');
    }

    public function Atbenefi_Aciayudas() {

        $this->c = new Criteria();

        $this->columnas = array(AtciudadanoPeer::CEDCIU => 'Cedula', AtciudadanoPeer::NOMCIU => 'Nombre', AtciudadanoPeer::APECIU => 'Apellido');
    }

    public function Caprovee_Aciayudas() {

        $this->c = new Criteria();
        $this->c->add(CaproveePeer::ESTPRO, 'A');
        $this->columnas = array(CaproveePeer::RIFPRO => 'Rif', CaproveePeer::NOMPRO => 'Nombre', CaproveePeer::CODPRO => 'Código');
    }

    public function Atgrudon_Aciayudas() {

        $this->c = new Criteria();

        $this->columnas = array(AtgrudonPeer::DESGRU => 'Grupos');
    }

    public function Atdonaciones_Aciayudas($params = '') {

        $this->c = new Criteria();

        $this->columnas = array(AtdonacionesPeer::CODDON => 'Codigo', AtdonacionesPeer::DESDON => 'Descripcion');
    }

    public function Atayudas_Aciestsoceco() {
        $this->c = new Criteria();
        $this->c->add(AtayudasPeer::ID, "ID NOT IN (SELECT atayudas_id FROM atestsoceco)", Criteria::CUSTOM);

        $this->columnas = array(AtayudasPeer::NROEXP => 'Expediente', 'atayudas.NOMSOL' => 'Solicitante', 'atayudas.NOMBEN' => 'Beneficiario');
    }

    public function Atmedico_Aciayudas() {

        $this->c = new Criteria();

        $this->columnas = array(AtmedicoPeer::CEDRIFMED => 'Cedula', AtmedicoPeer::NOMBREMED => 'Nombre', AtmedicoPeer::APELLIMED => 'Apellido');
    }

    public function Cpdeftit_Acitipayu() {
        $this->c = new Criteria();
        $this->c->add(CpdeftitPeer::CODPRE, "character_length(" . CpdeftitPeer::CODPRE . ")=(select max(character_length(" . CpdeftitPeer::CODPRE . ")) from cpdeftit)", Criteria::CUSTOM);

        $this->columnas = array(CpdeftitPeer::CODPRE => 'Código', CpdeftitPeer::NOMPRE => 'Descripción');
    }

    public function Nphispre_Presnomcalintpre() {
        $this->c = new Criteria();
        $this->columnas = array(
            NphojintPeer :: CODEMP => 'Código',
            NphojintPeer :: NOMEMP => 'Nombre',
            NphojintPeer :: STAEMP => 'Estatus'
        );
    }

    public function Forencpryaccespmet_Forpoa_uae($params = array()) {

        /* Select CodCat Codigo,
          NomCat Categoria
          From
          ForDefCatPre
          Where
          LENGTH(RTRIM(CODCAT))=" + Trim(Str(Len(Trim(FormatoUAE)))) + " And
          CodCat Like '" & CodigoAccEsp.Text & "%'" & "
          order by
          CodCat
         */
        $this->c = new Criteria();
        $this->sql = "length(codcat) = length('" . $params . "')";
        $this->c->add(CpdefnivPeer :: FORPRE, $this->sql, Criteria :: CUSTOM);

        $this->c->addAscendingOrderByColumn(FordefcatprePeer::CODCAT);
        $this->columnas = array(
            FordefcatprePeer :: CODEMP => 'Código',
            FordefcatprePeer :: NOMEMP => 'Nombre'
        );
    }

    public function Ocregcon_Oycval() {
        $this->c = new Criteria();
        $this->c->add(OcregconPeer :: STACON, 'N', Criteria::NOT_EQUAL);

        $this->columnas = array(
            OcregconPeer::CODCON => 'Código',
            OcregconPeer::DESCON => 'Descripción'
        );
    }

    public function Ocregcon_Pagemiord() {
        $this->c = new Criteria();
        $this->c->addJoin(CpcomproPeer::CEDRIF, OpbenefiPeer::CEDRIF);
        $this->c->addJoin(OcregconPeer::REFCOM, CpcomproPeer::REFCOM);
        $this->c->add(OcregconPeer :: STACON, 'A');

        $this->columnas = array(
            CpcomproPeer::REFCOM => 'Referencia',
            CpcomproPeer::DESCOM => 'Descripción',
            CpcomproPeer::FECCOM => 'Fecha',
            CpcomproPeer::CEDRIF => 'Cédula',
            OpbenefiPeer::NOMBEN => 'Nombre',
            CpcomproPeer::MONCOM => 'Monto',
        );
    }

    public function Ocregval_Pagemiord() {
        $this->c = new Criteria();
        $this->c->addJoin(OcregconPeer::CODCON, OcregvalPeer::CODCON);
        $this->c->addJoin(OcregconPeer::REFCOM, CpcomproPeer::REFCOM);
        $this->c->add(OcregconPeer :: STACON, 'A');

        $this->columnas = array(
            OcregconPeer::CODCON => 'N° Contrato',
            OcregvalPeer::CODTIPVAL => 'Tipo Valuación',
            OcregvalPeer::NUMVAL => 'N° Valuación',
            OcregvalPeer::FECREG => 'Fecha',
            OcregvalPeer::MONVAL => 'Monto',
            OcregvalPeer::OBSVAL => 'Observaciones',
        );
    }

    public function Nomasicarconnom_Npasicarnom($params = array()) {
        //$sql="select distinct(b.nomcar), a.codcar, b.suecar, b.graocp from npasicarnom a, npcargos b where
        //a.codcar=b.codcar and a.codnom='';";

        $this->c = new Criteria();

        /* $this->c->addSelectColumn('distinct('.NpasicarnomPeer::CODNOM.')');
          $this->c->addSelectColumn(NpasicarnomPeer::CODCAR);
          $this->c->addSelectColumn("'999' AS ID"); */

        $this->c->addJoin(NpcargosPeer::CODCAR, NpasicarnomPeer :: CODCAR);

        if ($params) {
            if (count($params) > 1) {
                if ($params[1] != "") {
                    //$sql="(npcargos.carvan -(select coalesce(count(codcar),0) as codcar from npasicaremp where codcar=npcargos.codcar group by codcar)) >0";
                    //$this->c->add(NpcargosPeer :: CARVAN, $sql,Criteria::CUSTOM);
                    $this->c->add(NpcargosPeer :: CARVAN, '0', Criteria::NOT_EQUAL);
                }
            }

            $this->c->add(NpasicarnomPeer :: CODNOM, $params[0]);
        }

        $this->columnas = array(
            NpcargosPeer :: CODCAR => 'Código',
            NpcargosPeer :: NOMCAR => 'Cargo',
            NpcargosPeer :: SUECAR => 'Sueldo',
            NpcargosPeer :: GRAOCP => 'Grado',
        );
    }

    public function Bieregactinmd_Bnclafun() {
        $this->c = new Criteria();

        $this->columnas = array(
            BnclafunPeer::CODCLA => 'Código',
            BnclafunPeer::DESCLA => 'Descripción'
        );
    }

    public function Biedisactinmlot_Bnmotdis() {
        $this->c = new Criteria();

        $this->columnas = array(
            BnmotdisPeer::CODMOT => 'Código',
            BnmotdisPeer::DESMOT => 'Descripción'
        );
    }

////////////////// LICITACIONES ///////////////////

    public function Lidatste_licregsol() {
        $this->c = new Criteria();

        $this->columnas = array(
            LidatstePeer::CODUNISTE => 'Código',
            LidatstePeer::DESUNISTE => 'Descripción'
        );
    }

    public function Licomlic_licregsol() {
        $this->c = new Criteria();

        $this->columnas = array(
            LicomlicPeer::CODCOM => 'Código',
            LicomlicPeer::DESCOM => 'Descripción'
        );
    }

    public function Lidetcom_licregsol($params = array()) {
        $this->c = new Criteria();
        $this->c->add(LidetcomPeer::LICOMLIC_ID, $params[0]);
        $this->c->addJoin(LidetcomPeer::CODEMP, NphojintPeer::CODEMP);
        $this->columnas = array(
            NphojintPeer::CODEMP => 'Código',
            NphojintPeer::NOMEMP => 'Nombre y Apellido',
            NphojintPeer :: STAEMP => 'Estatus'
        );
    }

    public function Liregsol_licressol() {
        $this->c = new Criteria();

        $this->columnas = array(
            LiregsolPeer::NUMSOL => 'Número Solicitud',
            LiregsolPeer::DESSOL => 'Descripción'
        );
    }

    public function Liemppar_licreglic() {
        $this->c = new Criteria();

        $this->columnas = array(
            LireglicPeer::CODLIC => 'Código Licitación',
            LireglicPeer::DESLIC => 'Descripción'
        );
    }

    public function Liemppar_caprovee() {
        $this->c = new Criteria();
        $this->c->add(CaproveePeer :: ESTPRO, 'A');
        $this->c->addAscendingOrderByColumn(CaproveePeer :: CODPRO);

        $this->columnas = array(
            CaproveePeer :: CODPRO => 'Cod. Empresa',
            CaproveePeer :: RIFPRO => 'RIF',
            CaproveePeer :: NOMPRO => 'Nombre',
            CaproveePeer :: NOMREPLEG => 'Representante Legal'
        );
    }

    public function Licasplegcriterios_caprovee($param = array()) {
        $this->c = new Criteria();
        $this->c->add(LiempofePeer::CODLIC, $param[0]);
        $this->c->add(CaproveePeer::ESTPRO, 'A');
        $this->c->addJoin(CaproveePeer::CODPRO, LiempofePeer::CODPRO);
        $this->columnas = array(
            CaproveePeer :: CODPRO => 'Cod. Empresa',
            CaproveePeer :: NOMPRO => 'Nombre'
        );
    }

    public function Licomlic_nphojint() {
        $this->c = new Criteria();
        $this->columnas = array(
            NphojintPeer :: CODEMP => 'Código Empleado',
            NphojintPeer :: CEDEMP => 'Cédula',
            NphojintPeer :: NOMEMP => 'Nombre',
            NphojintPeer :: DIRHAB => 'Dirección',
            NphojintPeer :: STAEMP => 'Estatus'
        );
    }

////////////////////////////////////////////////////
    public function Cpdoccom_Almordcom() {
        $this->c = new Criteria();

        $this->columnas = array(
            CpdoccomPeer::TIPCOM => 'Código',
            CpdoccomPeer::NOMEXT => 'Descripción'
        );
    }

////////////////Ingresos Inpsasel/////////////////////////////
    public function Ingdefrec_ingruprec() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(IngruprecPeer::CODGRUP);

        $this->columnas = array(
            IngruprecPeer :: CODGRUP => 'Código',
            IngruprecPeer :: DESGRUP => 'Descripción',
        );
    }

    public function Ingregmul_insancion() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(InsancionPeer::CODSAN);

        $this->columnas = array(
            InsancionPeer :: CODSAN => 'Código',
            InsancionPeer :: DESSAN => 'Descripción',
        );
    }

    public function Ingregprof_inespeci() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(InespeciPeer::CODESPECI);

        $this->columnas = array(
            InespeciPeer :: CODESPECI => 'Código',
            InespeciPeer :: DESESPECI => 'Descripción',
        );
    }

    public function Ingregprof_intipemp() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(IntipempPeer::CODTIPEMP);

        $this->columnas = array(
            IntipempPeer :: CODTIPEMP => 'Código',
            IntipempPeer :: DESTIPEMP => 'Descripción',
        );
    }

    public function Ingemifac_inempresa() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(InempresaPeer::RIFEMP);

        $this->columnas = array(
            InempresaPeer :: RIFEMP => 'R.I.F',
            InempresaPeer :: RAZSOC => 'Razón Social',
        );
    }

    public function Ingemifac_inprofes() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(InprofesPeer::CEDPROF);
        $this->c->addAscendingOrderByColumn(InprofesPeer::NOMPROF);
        $this->c->addAscendingOrderByColumn(InprofesPeer::APEPROF);

        $this->columnas = array(
            InprofesPeer :: CEDPROF => 'Cédula',
            InprofesPeer :: NOMPROF => 'Nombre',
            InprofesPeer :: APEPROF => 'Apellido',
        );
    }

    public function Ingemifac_indefban() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(IndefbanPeer::CODBAN);
        $this->c->addAscendingOrderByColumn(IndefbanPeer::DESBAN);

        $this->columnas = array(
            IndefbanPeer :: CODBAN => 'Código',
            IndefbanPeer :: DESBAN => 'Descripción',
        );
    }

    public function Ingingprof_intipsol() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(IntipsolPeer::CODTIPSOL);
        $this->c->addAscendingOrderByColumn(IntipsolPeer::DESTIPSOL);

        $this->columnas = array(
            IntipsolPeer :: CODTIPSOL => 'Código',
            IntipsolPeer :: DESTIPSOL => 'Descripción',
        );
    }

    public function Ingemifac_inmulta() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(InmultaPeer::CODMUL);
        $this->c->addAscendingOrderByColumn(InmultaPeer::DESMUL);

        $this->columnas = array(
            InmultaPeer :: CODMUL => 'Código',
            InmultaPeer :: DESMUL => 'Descripción',
        );
    }

    public function Ingemifac_iningprof() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(IningprofPeer::CODINGPROF);
        $this->c->addAscendingOrderByColumn(IningprofPeer::DESINGPROF);

        $this->columnas = array(
            IningprofPeer :: CODINGPROF => 'Código',
            IningprofPeer :: DESINGPROF => 'Descripción',
        );
    }

    public function Cideftit_Ingtrasla($mascara) {
        $mask = $mascara[0];
        $this->c = new Criteria();
        $this->sql = "length(Codpre) = '" . $mask . "'";
        $this->c->add(CideftitPeer :: CODPRE, $this->sql, Criteria :: CUSTOM);

        $this->columnas = array(
            CideftitPeer :: CODPRE => 'Código',
            CideftitPeer :: NOMPRE => 'Descripción',
        );
    }

    public function Ingtitpre_contabb() {
        $this->c = new Criteria();
        $this->c->add(ContabbPeer::CARGAB, 'C');
        $this->c->addAscendingOrderByColumn(ContabbPeer::CODCTA);
        $this->c->addAscendingOrderByColumn(ContabbPeer::DESCTA);

        $this->columnas = array(
            ContabbPeer :: CODCTA => 'Código',
            ContabbPeer :: DESCTA => 'Descripción',
        );
    }

    public function Ingadidis_cideftit($mask = array()) {
        $this->c = new Criteria();
        $this->sql = "length(Cideftit.Codpre) = '" . $mask[0] . "'";
        $this->c->add(CideftitPeer :: CODPRE, $this->sql, Criteria :: CUSTOM);
        $this->c->addAscendingOrderByColumn(CideftitPeer::CODPRE);
        $this->c->addAscendingOrderByColumn(CideftitPeer::NOMPRE);

        $this->columnas = array(
            CideftitPeer :: CODPRE => 'Código',
            CideftitPeer :: NOMPRE => 'Nombre',
        );
    }

    public function Ingreging_ciconrep() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(CiconrepPeer::RIFCON);
        $this->c->addAscendingOrderByColumn(CiconrepPeer::NOMCON);

        $this->columnas = array(
            CiconrepPeer :: RIFCON => 'C.I/R.I.F',
            CiconrepPeer :: NOMCON => 'Nombre',
        );
    }

    public function Ingreging_citiping() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(CitipingPeer::CODTIP);
        $this->c->addAscendingOrderByColumn(CitipingPeer::DESTIP);

        $this->columnas = array(
            CitipingPeer :: CODTIP => 'Código',
            CitipingPeer :: DESTIP => 'Descripción',
        );
    }

    public function Ingtrasla_cideftit($mask = array()) {
        $this->c = new Criteria();
        $this->sql = "length(Cideftit.Codpre) = '" . $mask[0] . "'";
        $this->c->add(CideftitPeer :: CODPRE, $this->sql, Criteria :: CUSTOM);
        $this->c->add(CiasiiniPeer::PERPRE, '00');
        $this->c->addJoin(CideftitPeer::CODPRE, CiasiiniPeer::CODPRE);

        $this->columnas = array(
            CideftitPeer :: CODPRE => 'Código',
            CideftitPeer :: NOMPRE => 'Nombre',
        );
    }

    public function Ingreging_cideftit($mask) {
        $this->c = new Criteria();
        $this->sql = "length(Cideftit.Codpre) = '" . $mask[0] . "'";
        $this->c->add(CideftitPeer :: CODPRE, $this->sql, Criteria :: CUSTOM);
        //$this->c->add(CiasiiniPeer::PERPRE,'00');
        //$this->c->addJoin(CideftitPeer::CODPRE,CiasiiniPeer::CODPRE);

        $this->columnas = array(
            CideftitPeer :: CODPRE => 'Código',
            CideftitPeer :: NOMPRE => 'Nombre',
        );
    }

    public function Ingajustenew_cideftit($mask) {


        $this->c = new Criteria();
        $this->sql = "length(Cideftit.Codpre) = '" . $mask[0] . "'";
        $this->c->add(CideftitPeer :: CODPRE, $this->sql, Criteria :: CUSTOM);
        $this->c->add(CiasiiniPeer::PERPRE, '00');
        $this->c->addJoin(CideftitPeer::CODPRE, CiasiiniPeer::CODPRE);

        $this->columnas = array(
            CideftitPeer :: CODPRE => 'Código',
            CideftitPeer :: NOMPRE => 'Nombre',
        );
    }

    public function Ingreging_tsdefban() {
        $filbandir = H::getConfApp2('filbandir', 'tesoreria', 'tesdefcueban');
        $loguse= sfContext::getInstance()->getUser()->getAttribute('loguse');

        $this->c = new Criteria();
        if ($filbandir=='S'){
            $this->sql='tsdefban.coddirec in (select coddirec from "SIMA_USER".segdirusu where loguse=\''.$loguse.'\')';
            $this->c->add(TsdefbanPeer::CODDIREC, $this->sql, Criteria :: CUSTOM);
        }


        $this->c->addAscendingOrderByColumn(TsdefbanPeer::NUMCUE);
        $this->c->addAscendingOrderByColumn(TsdefbanPeer::NOMCUE);

        $this->columnas = array(
            TsdefbanPeer :: NUMCUE => 'Número',
            TsdefbanPeer :: NOMCUE => 'Nombre',
            TsdefbanPeer :: CODDIREC => 'Estado',
            TsdefbanPeer :: USOCUE => 'Uso de la Cuenta'
        );
    }

    public function Ingreging_tstipmov() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(TstipmovPeer::CODTIP);
        $this->c->addAscendingOrderByColumn(TstipmovPeer::DESTIP);
        //$this->c->add(TstipmovPeer::DEBCRE,'D');

        $this->columnas = array(
            TstipmovPeer :: CODTIP => 'Código',
            TstipmovPeer :: DESTIP => 'Descripción',
        );
    }

    public function Ingreging_citiprub() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(CitiprubPeer::CODTIPRUB);

        $this->columnas = array(
            CitiprubPeer :: CODTIPRUB => 'Código',
            CitiprubPeer :: DESTIPRUB => 'Descripción',
        );
    }

    public function Contabb_ConFinCue() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(ContabbPeer::CODCTA);

        $this->columnas = array(
            ContabbPeer :: CODCTA => 'Código',
            ContabbPeer :: DESCTA => 'Descripción',
        );
    }

    public function Npnomesptipos_Nomespcalculo() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(NpnomesptiposPeer::CODNOMESP);

        $this->columnas = array(
            NpnomesptiposPeer :: CODNOMESP => 'Código',
            NpnomesptiposPeer :: DESNOMESP => 'Descripción',
        );
    }

    public function Npnomespnomtip_Nomespcalculo($params) {
        $this->c = new Criteria();
        $this->c->add(NpnomespnomtipPeer :: CODNOMESP, $params[0]);
        $this->c->addJoin(NpnomespnomtipPeer::CODNOMESP, NpnomesptiposPeer :: CODNOMESP);
        $this->c->addJoin(NpnomespnomtipPeer::CODNOM, NpnominaPeer :: CODNOM);
        $this->c->addAscendingOrderByColumn(NpnominaPeer::NOMNOM);

        $this->columnas = array(
            NpnomespnomtipPeer :: CODNOM => 'Cód Nomina',
            NpnominaPeer :: NOMNOM => 'Tipo/Nómina',
        );
    }

    public function Ingajustenew_cireging() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(CiregingPeer::REFING);
        $this->c->addAscendingOrderByColumn(CiregingPeer::DESING);

        $this->columnas = array(
            CiregingPeer :: REFING => 'Referencia',
            CiregingPeer :: DESING => 'Descripción',
        );
    }

    public function Npdefcpt_Nomespconceptos() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(NpdefcptPeer::CODCON);

        $this->columnas = array(
            NpdefcptPeer :: CODCON => 'Cód Concepto',
            NpdefcptPeer :: NOMCON => 'Descripción',
        );
    }

    public function Npnomina_Nomespdefinicion() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(NpnominaPeer::CODNOM);

        $this->columnas = array(
            NpnominaPeer :: CODNOM => 'Cód Nómina',
            NpnominaPeer :: NOMNOM => 'Descripción',
        );
    }

    public function Caregart_Faproalt() {
        $mascaraarticulo = Herramientas::getMascaraArticulo();
        $longitud = strlen($mascaraarticulo);
        $this->c = new Criteria();
        //$this->c->add(CaregartPeer :: TIPO, 'A');
        $this->sql = "length(Codart) = '" . $longitud . "'";
        $this->c->add(CaregartPeer :: CODART, $this->sql, Criteria :: CUSTOM);

        $this->columnas = array(
            CaregartPeer :: CODART => 'Código',
            CaregartPeer :: DESART => 'Descripción',
            CaregartPeer :: UNIMED => 'Unidad de Medida',
        );
    }

    public function Fadescto_Fadtocte() {
        $this->c = new Criteria();

        $this->columnas = array(
            FadesctoPeer::CODDESC => 'Código',
            FadesctoPeer::DESDESC => 'Descripción',
            FadesctoPeer::MONDESC => 'Monto'
        );
    }

    public function Contabb_Fatipmov() {
        $this->c = new Criteria();
        $this->c->add(ContabbPeer::CARGAB, 'C');
        $this->c->addAscendingOrderByColumn(ContabbPeer::CODCTA);

        $this->columnas = array(ContabbPeer::CODCTA => 'Cuenta', ContabbPeer::DESCTA => 'Descripción');
    }

    public function Contabb_Facliente() {
        $this->c = new Criteria();
        $this->c->add(ContabbPeer::CARGAB, 'C');
        $this->c->addAscendingOrderByColumn(ContabbPeer::CODCTA);

        $this->columnas = array(ContabbPeer::CODCTA => 'Cuenta', ContabbPeer::DESCTA => 'Descripción');
    }

    public function Contabb_Farecarg() {
        $this->c = new Criteria();
        $this->c->add(ContabbPeer::CARGAB, 'C');
        $this->c->addAscendingOrderByColumn(ContabbPeer::CODCTA);

        $this->columnas = array(ContabbPeer::CODCTA => 'Cuenta', ContabbPeer::DESCTA => 'Descripción');
    }

    public function Contabb_Fadefart() {
        $this->c = new Criteria();
        $this->c->add(ContabbPeer::CARGAB, 'C');
        $this->c->addAscendingOrderByColumn(ContabbPeer::CODCTA);

        $this->columnas = array(ContabbPeer::CODCTA => 'Cuenta', ContabbPeer::DESCTA => 'Descripción');
    }

    public function Farecarg_Farecart() {
        $this->c = new Criteria();

        $this->columnas = array(
            FarecargPeer::CODRGO => 'Código',
            FarecargPeer::NOMRGO => 'Descripción',
        );
    }

    public function Rifcli_Fapedido() {
        $this->c = new Criteria();

        $this->columnas = array(
            FaclientePeer::RIFPRO => 'CI/RIF',
            FaclientePeer::NOMPRO => 'Descripción',
            FaclientePeer::CODPRO => 'Código',
        );
    }
    public function Rifcli_FapedidoCero() {
        $this->c = new Criteria();
	$this->c->add(CuentaxcobrarClientesPeer::CUENTAXCOBRAR,0);
	$this->c->addJoin(CuentaxcobrarClientesPeer::CODCLIENTE,FaclientePeer::CODPRO);

        $this->columnas = array(
            FaclientePeer::RIFPRO => 'CI/RIF',
            FaclientePeer::NOMPRO => 'Descripción',
            FaclientePeer::CODPRO => 'Código',
        );
    }

    public function Fapresup_Fapedido() {
        $this->c = new Criteria();
        $this->sql = "refpre not in (select refped from fapedido where refped=refpre and tipref='PR')";
        $this->c->add(FapresupPeer::REFPRE, $this->sql, Criteria :: CUSTOM);

        $this->columnas = array(
            FapresupPeer::REFPRE => 'Número',
            FapresupPeer::DESPRE => 'Descripción',
            FapresupPeer::FECPRE => 'Fecha',
        );
    }

    public function Fapedido_Fanotent($params = array()) {
        $this->c = new Criteria();
        //$this->sql = "fapedido.status <> 'N' and fapedido.NROPED not in (select faartfac.codref from faartfac where faartfac.codref = fapedido.nroped and faartfac.reffac in (select fafactur.reffac from fafactur where fafactur.reffac = faartfac.reffac and fafactur.tipref = 'P' and fafactur.status <> 'N'))";
        //$this->c->add(FapedidoPeer::NROPED,$this->sql,Criteria :: CUSTOM);
        //$sql = "(select sum(cantot) from faartped where nroped=Fapedido.nroped)>(select sum(coalesce(candes,0)) from faartped where nroped=Fapedido.nroped) ";
        if (isset($params[0]))
            if ($params[0] != '')
                $this->c->add(FapedidoPeer::CODALMUSU, $params[0]);
        $this->c->addAscendingOrderByColumn(FapedidoPeer::NROPED);

        $this->columnas = array(
            FapedidoPeer::NROPED => 'Número',
            FapedidoPeer::DESPED => 'Descripción',
            FapedidoPeer::FECPED => 'Fecha',
        );
    }

    public function Faajuste_Fanotent() {
        $this->c = new Criteria();
        $this->c->add(FanotentPeer::STATUS, 'N', Criteria :: NOT_EQUAL);

        $this->columnas = array(
            FanotentPeer::NRONOT => 'Número',
            FanotentPeer::DESNOT => 'Descripción',
            FanotentPeer::FECNOT => 'Fecha',
        );
    }

    public function Factura_Fanotent($params = array()) {
        $this->c = new Criteria();
        $this->c->add(FafacturPeer::STATUS, 'N', Criteria::NOT_EQUAL);
        $this->c->add(FafacturPeer::TIPREF, 'D', Criteria::NOT_EQUAL);
        //$sql = "fafactur.reffac not in (select codref from faajuste) and  (select sum(cantot) from faartfac where reffac=Fafactur.reffac)>(select sum(coalesce(candes,0)) from faartfac where reffac=Fafactur.reffac) ";
        //$this->c->add(FafacturPeer :: REFFAC, $sql, Criteria :: CUSTOM);
        if (count($params) > 0)
            $this->c->add(FafacturPeer::CODALMUSU, $params[0]);

        $this->columnas = array(
            FafacturPeer::REFFAC => 'Número',
            FafacturPeer::DESFAC => 'Descripción',
            FafacturPeer::FECFAC => 'Fecha',
        );
    }

    public function Fadevolu_Cadphart() {
        $fildesp = H::getConfApp2('fildes', 'facturacion', 'fadesp');
        $this->c = new Criteria();
        if ($fildesp == 'S')
            $this->c->add(CadphartPeer::STADEV, null);

        $this->columnas = array(
            CadphartPeer::DPHART => 'Número',
            CadphartPeer::DESDPH => 'Descripción',
            CadphartPeer::FECDPH => 'Fecha',
        );
    }

    public function Caregart_Fapedido($params = array()) {
        $longitud = $params[0];
        $this->c = new Criteria();
        $mostodart = H::getConfAppGen('mostodart');
        if ($mostodart == 'S') {
            $this->sql = "length(Codart) = '" . $longitud . "'";
        } else {
            $this->sql = "length(Codart) = '" . $longitud . "' and tipreg='F'";
        }
        $this->c->add(CaregartPeer :: CODART, $this->sql, Criteria :: CUSTOM);

        $this->columnas = array(
            CaregartPeer :: CODART => 'Código',
            CaregartPeer :: DESART => 'Descripción',
        );
    }

    public function Fadefcom_Fapedido() {
        $this->c = new Criteria();

        $this->columnas = array(
            FadefcomPeer::CODCOM => 'Código',
            FadefcomPeer::NOMCOM => 'Nombre',
        );
    }

    public function Faartpvp_Fapresup($params = array()) {
        $this->c = new Criteria();
        $this->c->add(FaartpvpPeer::CODART, $params[0]);
        $this->c->addAscendingOrderByColumn(FaartpvpPeer::DESPVP);
        $this->columnas = array(
            FaartpvpPeer::DESPVP => 'Descripción',
            FaartpvpPeer::PVPART => 'Precio',
        );
    }

    public function Codconpag_Fafactur($params = array()) {
        $this->c = new Criteria();
        if ($params[0] == "nuevo") {
            $this->c->add(FaconpagPeer::TIPCONPAG, 'R', Criteria::NOT_EQUAL);
        }

        $this->columnas = array(
            FaconpagPeer::DESCONPAG => 'Descripción',
        );
    }

    public function Fadefart_Fadefcaj() {
        $this->c = new Criteria();

        $this->columnas = array(
            FadefcajPeer::DESCAJ => 'Descripción',
        );
    }

    public function Nomdefespcestic_Npnomina() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(NpnominaPeer::CODNOM);

        $this->columnas = array(
            NpnominaPeer::CODNOM => 'Código',
            NpnominaPeer::NOMNOM => 'Descripción',
        );
    }

    public function Nomdefespcestic_Npdefcpt($param = '') {
        $this->c = new Criteria();
        $this->c->add(NpasiconnomPeer::CODNOM, $param[0]);
        $this->c->addJoin(NpdefcptPeer::CODCON, NpasiconnomPeer::CODCON);
        $this->c->addAscendingOrderByColumn(NpdefcptPeer::CODCON);

        $this->columnas = array(
            NpdefcptPeer::CODCON => 'Código',
            NpdefcptPeer::NOMCON => 'Descripción',
        );
    }

    public function Caordcom_Aciayudas($params = array()) {

        $this->c = new Criteria();

        $this->columnas = array(
            CaordcomPeer :: ORDCOM => 'Código',
            CaordcomPeer :: FECORD => 'Fecha',
            CaordcomPeer :: DESORD => 'Descripción'
        );
    }

    public function Fatippag_Fafactur() {
        $this->c = new Criteria();

        $this->columnas = array(
            FatippagPeer::DESTIPPAG => 'Nombre',
        );
    }

    public function Fabancos_Fafactur() {
        $this->c = new Criteria();
        $this->c->setDistinct();

        $this->columnas = array(
            FaallbancosPeer::BANCO => 'Banco',
            FaallbancosPeer::CTABAN => 'Cuenta',
        );
    }

    public function Cadescto_Fafactur() {
        $this->c = new Criteria();

        $this->columnas = array(
            FadesctoPeer::CODDESC => 'Código',
            FadesctoPeer::DESDESC => 'Descripción',
            FadesctoPeer::MONDESC => 'Monto',
            FadesctoPeer::TIPDESC => 'Tipo',
            FadesctoPeer::TIPRET => 'Tipo de Retencion'
        );
    }

    public function Farecarg_Fafactur() {
        $this->c = new Criteria();

        $this->columnas = array(
            FarecargPeer::CODRGO => 'Código',
            FarecargPeer::NOMRGO => 'Descripción',
            FarecargPeer::TIPRGO => 'Tipo',
            FarecargPeer::MONRGO => 'Monto'
        );
    }

    public function modalidadcestaticketempleados_Npnomina() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(NpnominaPeer::CODNOM);

        $this->columnas = array(
            NpnominaPeer::CODNOM => 'Código',
            NpnominaPeer::NOMNOM => 'Descripción',
        );
    }

    public function Viaregtiptab_Viaregtiptab() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(ViaregtiptabPeer::DESTIPTAB);

        $this->columnas = array(
            ViaregtiptabPeer::DESTIPTAB => 'Descripción'
        );
    }

    ///////////////////Cuentas por Cobrar/////////////////////////////
    public function Rifcli_Cobdocume() {
        $this->c = new Criteria();

        $this->columnas = array(
            FaclientePeer::CODPRO => 'Código',
            FaclientePeer::NOMPRO => 'Nombre',
            FaclientePeer::RIFPRO => 'CI/RIF',
        );
    }

    public function Ocpais($param = array()) {
        $this->c = new Criteria();

        $this->columnas = array(
            OcpaisPeer::CODPAI => 'Código',
            OcpaisPeer::NOMPAI => 'Descripcion',
        );
    }

    public function Ocestado($param = array()) {
        $this->c = new Criteria();
        $this->c->add(OcestadoPeer::CODPAI, $param[0]);

        $this->columnas = array(
            OcestadoPeer::CODEDO => 'Código',
            OcestadoPeer::NOMEDO => 'Descripcion',
        );
    }

    public function Occiudad($param = array()) {
        $this->c = new Criteria();
        $this->c->add(OcciudadPeer::CODPAI, $param[1]);
        $this->c->add(OcciudadPeer::CODEDO, $param[0]);

        $this->columnas = array(
            OcciudadPeer::CODCIU => 'Código',
            OcciudadPeer::NOMCIU => 'Descripcion',
        );
    }

    public function Ocmunici($param = array()) {
        $this->c = new Criteria();
        $this->c->add(OcmuniciPeer::CODCIU, $param[0]);
        $this->c->add(OcmuniciPeer::CODEDO, $param[1]);
        $this->c->add(OcciudadPeer::CODPAI, $param[2]);

        $this->columnas = array(
            OcmuniciPeer::CODMUN => 'Código',
            OcmuniciPeer::NOMMUN => 'Descripcion',
        );
    }

    public function Ocparroq($param = array()) {
        $this->c = new Criteria();
        $this->c->add(OcparroqPeer::CODEDO, $param[0]);
        $this->c->add(OcparroqPeer::CODMUN, $param[1]);
        $this->c->add(OcparroqPeer::CODPAI, $param[2]);

        $this->columnas = array(
            OcparroqPeer::CODPAR => 'Código',
            OcparroqPeer::NOMPAR => 'Descripcion',
        );
    }

    public function Viaregsolvia_Nphojint($param = array()) {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(NphojintPeer::CODEMP);

        $this->columnas = array(
            NphojintPeer::CODEMP => 'Cedula',
            NphojintPeer::NOMEMP => 'Nombre',
            NphojintPeer :: STAEMP => 'Estatus'
        );
    }

    public function Viaregsolvia_Viaregente($param = array()) {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(ViaregentePeer::CEDRIF);

        $this->columnas = array(
            ViaregentePeer::CEDRIF => 'Cedula/RIF',
            ViaregentePeer::DESENTE => 'Descripcion',
            ViaregentePeer::NACENT => 'Nacionalidad',
        );
    }

    public function Viaregsolvia_Viaregact($param = array()) {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(ViaregactPeer::DESACT);

        $this->columnas = array(
            ViaregactPeer::DESACT => 'Descripcion'
        );
    }

    public function Forcfgrepins_instruc($param = array()) {
        $tipo = $param[0];
        if ($tipo == "cpdeftit") {

            $inicio = strlen(Herramientas::getMascaraCategoria()) + 2;
            $fin = strlen(Herramientas::formatoPresupuesto());
            $this->c = new Criteria();
            $this->c->addSelectColumn(' SUBSTR(' . CpdeftitPeer::CODPRE . ',' . $inicio . ',' . $fin . ') as CODPRE');
            $this->c->addSelectColumn(CpdeftitPeer::NOMPRE);
            $this->c->addSelectColumn(CpdeftitPeer::CODCTA);
            $this->c->addSelectColumn(CpdeftitPeer::STACOD);
            $this->c->addSelectColumn(CpdeftitPeer::CODUNI);
            $this->c->addSelectColumn(CpdeftitPeer::ESTATUS);
            $this->c->addSelectColumn(CpdeftitPeer::CODTIP);
            $this->c->addSelectColumn(CpdeftitPeer::ID);
            $this->sql = "trim(substr(codpre,$inicio,$fin))!=''";
            $this->c->add(CpdeftitPeer::CODPRE, $this->sql, Criteria::CUSTOM);
            $this->c->addAscendingOrderByColumn(CpdeftitPeer::CODPRE);

            $this->columnas = array(
                CpdeftitPeer::CODPRE => 'Codigo Partida',
                CpdeftitPeer::NOMPRE => 'Nombre Partida',
            );
        } elseif ($tipo == "cideftit") {
            $this->c = new Criteria();
            $this->c->addAscendingOrderByColumn(CideftitPeer::CODPRE);

            $this->columnas = array(
                CideftitPeer::CODPRE => 'Codigo Ingreso',
                CideftitPeer::NOMPRE => 'Nombre Ingreso',
            );
        } elseif ($tipo == "contabb") {
            $this->c = new Criteria();
            $this->c->addAscendingOrderByColumn(ContabbPeer::CODCTA);

            $this->columnas = array(
                ContabbPeer::CODCTA => 'Codigo Cuenta',
                ContabbPeer::DESCTA => 'Nombre Cuenta',
            );
        } else {
            $this->columnas = array(
                '' => 'Codigo Cuenta',
                '' => 'Nombre Cuenta',
            );
        }
    }

    public function Fcdefdesc_carecaud() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(CarecaudPeer::CODREC);
        $this->c->addAscendingOrderByColumn(CarecaudPeer::DESREC);

        $this->columnas = array(
            CarecaudPeer :: CODREC => 'Código',
            CarecaudPeer :: DESREC => 'Nombre',
        );
    }

    public function Viaregsolvia_Cpdeftit($params = array()) {
        $this->c = new Criteria();
        $long = strlen($params[0]);
        $this->sql = "length(codpre) = '" . $long . "'";
        $this->c->add(CpdeftitPeer :: CODPRE, $this->sql, Criteria :: CUSTOM);
        $this->c->addAscendingOrderByColumn(CpdeftitPeer::CODPRE);

        $this->columnas = array(
            CpdeftitPeer::CODPRE => 'Código',
            CpdeftitPeer::NOMPRE => 'Descripción',
        );
    }

    public function Viadettabcar_Npcargos() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(NpcargosPeer::CODCAR);

        $this->columnas = array(
            NpcargosPeer::CODCAR => 'Código',
            NpcargosPeer::NOMCAR => 'Descripción',
        );
    }

    public function Viaregsolvia_Cpdoccom() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(CpdoccomPeer::TIPCOM);
        $this->columnas = array(
            CpdoccomPeer :: TIPCOM => 'Código',
            CpdoccomPeer :: NOMEXT => 'Descripción',
        );
    }

    public function Facdefsol_fcfuepre() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(FcfueprePeer::CODFUE);
        $this->c->addAscendingOrderByColumn(FcfueprePeer::NOMFUE);
        $this->columnas = array(
            FcfueprePeer :: CODFUE => 'Código',
            FcfueprePeer :: NOMFUE => 'Descripción',
        );
    }

    public function Caprovee_Almordcom($param = array()) {
        if (count($param) == 0) {
            $this->c = new Criteria();
            $this->c->add(CaproveePeer::ESTPRO, 'A');

            $this->columnas = array(
                CaproveePeer::RIFPRO => 'Rif',
                CaproveePeer::NOMPRO => 'Descripción',
                CaproveePeer::CODPRO => 'Codigo',
            );
        } else {
            $sql = "select a.refsol, a.codpro, b.priori from cacotiza a inner join cadetcot b on a.refcot=b.refcot where b.priori=1 and a.refsol='" . $param[0] . "'
                group by a.refsol, a.codpro, b.priori";
            if (Herramientas::BuscarDatos($sql, $result)) {
                $this->c = new Criteria();
                $this->c->add(CacotizaPeer::REFSOL, $param[0]);
                $this->c->add(CadetcotPeer::PRIORI, 1);
                $this->c->add(CaproveePeer::ESTPRO, 'A');
                $sql1="cacotiza.refsol='".$param[0]."' and cacotiza.refsol not in (select refsol from caordcom where staord!='N' and codpro=cacotiza.codpro)";
                $this->c->add(CacotizaPeer::REFSOL, $sql1,Criteria::CUSTOM);
                $this->c->addJoin(CacotizaPeer::REFCOT, CadetcotPeer::REFCOT);
                $this->c->addJoin(CaproveePeer::CODPRO, CacotizaPeer::CODPRO);
                $this->c->setDistinct();
                $this->columnas = array(
                    CaproveePeer::RIFPRO => 'Rif',
                    CaproveePeer::NOMPRO => 'Descripción',
                    CaproveePeer::CODPRO => 'Codigo',
                );
            } else {
                $this->c = new Criteria();
                $this->c->add(CaproveePeer::ESTPRO, 'A');

                $this->columnas = array(
                    CaproveePeer::RIFPRO => 'Rif',
                    CaproveePeer::NOMPRO => 'Descripción',
                    CaproveePeer::CODPRO => 'Codigo',
                );
            }
        }
    }

    public function Facrecliq_fcfuepre() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(FcfueprePeer::CODFUE);
        $this->c->addAscendingOrderByColumn(FcfueprePeer::NOMFUE);
        $this->columnas = array(
            FcfueprePeer :: CODFUE => 'Código',
            FcfueprePeer :: NOMFUE => 'Descripción',
        );
    }

    public function Facmultas_fcfuepre_fcdefins() {
        /* "Select " .""
          "A.NomFue as Descripcion, " .
          "A.CodFue as Codigo " .
          "From " .
          "FCFuePre A, " .
          "FCDefIns B " .
          "WHERE " .
          "A.CODFUE=B.CODPIC OR " .
          "A.CODFUE=B.CODVEH OR " .
          "A.CODFUE=B.CODINM OR " .
          "A.CODFUE=B.CODPRO OR " .
          "A.CODFUE=B.CODESP OR " .
          "A.CODFUE=B.CODAPU OR " .
          "A.CODFUE=B.CODAJUPIC " .
          "Order By " .
          "A.CodFue" */
        $sql = "Select * from fcdefins";
        if (Herramientas::BuscarDatos($sql, $result)) {
            $this->c = new Criteria();
            $this->sqlnew = "CODFUE='" . $result[0]["codpic"] . "' OR CODFUE='" . $result[0]["codveh"] . "' OR CODFUE='" . $result[0]["codinm"] . "' OR CODFUE='" . $result[0]["codpro"] . "' OR CODFUE='" . $result[0]["codesp"] . "' OR CODFUE='" . $result[0]["codapu"] . "'  OR CODFUE='" . $result[0]["codajupic"] . "'";
            $this->c->add(FcfueprePeer::CODFUE, $this->sqlnew, Criteria :: CUSTOM);
            $this->c->addAscendingOrderByColumn(FcfueprePeer::CODFUE);
            $this->columnas = array(
                FcfueprePeer::CODFUE => 'Código',
                FcfueprePeer::NOMFUE => 'Descripción'
            );
        } else {
            $this->c = new Criteria();
            $this->columnas = array(
                FcfueprePeer::CODFUE => 'Código',
                FcfueprePeer::NOMFUE => 'Descripción'
            );
        }
    }

    public function Facdefespins_fcdefins() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(FcfueprePeer::CODFUE);
        $this->c->addAscendingOrderByColumn(FcfueprePeer::NOMFUE);
        $this->columnas = array(
            FcfueprePeer :: CODFUE => 'Código',
            FcfueprePeer :: NOMFUE => 'Descripción',
        );
    }

    public function Facfueing_Ingrec() {
        $this->c = new Criteria();
        $this->c->add(ContabbPeer::CARGAB, 'C', Criteria::EQUAL);
        $this->c->addAscendingOrderByColumn(ContabbPeer::CODCTA);
        $this->c->addAscendingOrderByColumn(ContabbPeer::DESCTA);
        $this->columnas = array(
            ContabbPeer :: CODCTA => 'Código',
            ContabbPeer :: DESCTA => 'Descripción',
        );
    }

    public function Facfueing_Codprei() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(CideftitPeer :: CODPRE);
        $this->c->addAscendingOrderByColumn(CideftitPeer :: NOMPRE);
        $this->columnas = array(
            CideftitPeer :: CODPRE => 'Código',
            CideftitPeer :: NOMPRE => 'Descripción',
        );
    }

    public function Facfueing_Fueing() {
        /* Select
          DISTINCT(A.desrede) as Descripción,
          A.CODREDE as Código,
          B.dias as Dias,
          B.porcien as Porcentaje
          from
          FCRECDES A,
          FCRECDESG B,
          FCFUEPRE C
          WHERE
          A.CODREDE=B.CODREDE AND
          C.CODFUE=A.CODFUE  AND
          C.CODFUE='01'
          ORDER BY
          A.CODREDE"
         */


        $this->c = new Criteria();
        $this->c->addSelectColumn('distinct(' . FcrecdesPeer::DESREDE . ')');
        $this->c->addJoin(FcrecdesPeer::CODREDE, FcrecdesgPeer::CODREDE);
        $this->c->addJoin(FcrecdesPeer::CODFUE, FcfueprePeer::CODFUE);
        $this->c->addAscendingOrderByColumn(FcrecdesPeer::CODREDE);
        $this->c->addAscendingOrderByColumn(FcrecdesPeer::DESREDE);
        $this->columnas = array(
            FcrecdesPeer :: CODREDE => 'Código',
            FcrecdesPeer :: DESREDE => 'Descripción',
        );
    }

    public function Predisfuefinmov_Cpprecom() {
        $this->c = new Criteria();
        $this->c->add(CpprecomPeer::STAPRC, 'A');
        $this->sql = "cpprecom.refprc not in (select refmov from cpmovfuefin where refmov is not null and tipmov='PRECOMPROMISO' and stamov<>'N')";
        $this->c->add(CpprecomPeer::REFPRC, $this->sql, Criteria::CUSTOM);

        $this->columnas = array(
            CpprecomPeer :: REFPRC => 'Código',
            CpprecomPeer :: DESPRC => 'Descripción',
            CpprecomPeer :: TIPPRC => 'Tipo',
            CpprecomPeer :: FECPRC => 'Fecha'
        );
    }

    public function Predisfuefinmov_Cpcompro() {
        $this->c = new Criteria();
        $this->c->addJoin(CpcomproPeer::TIPCOM, CpdoccomPeer::TIPCOM);
        $this->c->add(CpdoccomPeer::REFPRC, 'N');
        $this->c->add(CpdoccomPeer::AFEDIS, 'N', Criteria::NOT_EQUAL);
        $this->c->add(CpcomproPeer::STACOM, 'A');
        $this->sql = "cpcompro.refcom not in (select refmov from cpmovfuefin where refmov is not null and tipmov='COMPROMISO' and stamov<>'N')";
        $this->c->add(CpcomproPeer::REFCOM, $this->sql, Criteria::CUSTOM);

        $this->columnas = array(
            CpcomproPeer :: REFCOM => 'Código',
            CpcomproPeer :: DESCOM => 'Descripción',
            CpcomproPeer :: TIPCOM => 'Tipo',
            CpcomproPeer :: FECCOM => 'Fecha'
        );
    }

    public function Predisfuefinmov_Cpcausad() {
        $this->c = new Criteria();
        $this->c->addJoin(CpcausadPeer::TIPCAU, CpdoccauPeer::TIPCAU);
        $this->c->add(CpdoccauPeer::REFIER, 'N');
        $this->c->add(CpdoccauPeer::AFEDIS, 'N', Criteria::NOT_EQUAL);
        $this->c->add(CpcausadPeer::STACAU, 'A');
        $this->sql = "cpcausad.refcau not in (select refmov from cpmovfuefin where refmov is not null and tipmov='CAUSADO' and stamov<>'N')";
        $this->c->add(CpcausadPeer::REFCAU, $this->sql, Criteria::CUSTOM);

        $this->columnas = array(
            CpcausadPeer :: REFCAU => 'Código',
            CpcausadPeer :: DESCAU => 'Descripción',
            CpcausadPeer :: TIPCAU => 'Tipo',
            CpcausadPeer :: FECCAU => 'Fecha'
        );
    }

    public function Predisfuefinmov_Cppagos() {
        $this->c = new Criteria();
        $this->c->addJoin(CppagosPeer::TIPPAG, CpdocpagPeer::TIPPAG);
        $this->c->add(CpdocpagPeer::REFIER, 'N');
        $this->c->add(CpdocpagPeer::AFEDIS, 'N', Criteria::NOT_EQUAL);
        $this->c->add(CppagosPeer::STAPAG, 'A');
        $this->sql = "cppagos.refpag not in (select refmov from cpmovfuefin where refmov is not null and tipmov='PAGADO' and stamov<>'N')";
        $this->c->add(CppagosPeer::REFPAG, $this->sql, Criteria::CUSTOM);

        $this->columnas = array(
            CppagosPeer :: REFPAG => 'Código',
            CppagosPeer :: DESPAG => 'Descripción',
            CppagosPeer :: TIPPAG => 'Tipo',
            CppagosPeer :: FECPAG => 'Fecha'
        );
    }

    public function Predisfuefinmov_Cpadidis() {
        $this->c = new Criteria();
        $this->c->add(CpadidisPeer::STAADI, 'A');
        $this->sql = "cpadidis.refadi not in (select refdis from cpdisfuefin where refdis is not null and origen='CREDITO') and cpadidis.refadi not in (select refmov from cpmovfuefin where refmov is not null and tipmov='DEBITO'  )";
        $this->c->add(CpadidisPeer::REFADI, $this->sql, Criteria::CUSTOM);

        $this->columnas = array(
            CpadidisPeer :: REFADI => 'Código',
            CpadidisPeer :: DESADI => 'Descripción',
            CpadidisPeer :: ADIDIS => 'Tipo (A/D)',
            CpadidisPeer :: FECADI => 'Fecha'
        );
    }

    public function Predisfuefinmov_Cpsoltrasla() {
        $this->c = new Criteria();
        $this->c->add(CpsoltraslaPeer::STATRA, 'A');
        $this->sql = "cpsoltrasla.reftra not in (select refdis from cpdisfuefin where refdis is not null and origen='TRASLADO')";
        $this->c->add(CpsoltraslaPeer::REFTRA, $this->sql, Criteria::CUSTOM);

//Muestra el Documento siempre y cuando este aprobado o en proceso = null
        $opc1 = $this->c->getNewCriterion(CpsoltraslaPeer::STACON, null);
        $opc2 = $this->c->getNewCriterion(CpsoltraslaPeer::STACON, 'N', Criteria::NOT_EQUAL);
        $opc1->addOr($opc2);
        $this->c->add($opc1);

        $opc1 = $this->c->getNewCriterion(CpsoltraslaPeer::STAPRE, null);
        $opc2 = $this->c->getNewCriterion(CpsoltraslaPeer::STAPRE, 'N', Criteria::NOT_EQUAL);
        $opc1->addOr($opc2);
        $this->c->add($opc1);

        $opc1 = $this->c->getNewCriterion(CpsoltraslaPeer::STAGOB, null);
        $opc2 = $this->c->getNewCriterion(CpsoltraslaPeer::STAGOB, 'N', Criteria::NOT_EQUAL);
        $opc1->addOr($opc2);
        $this->c->add($opc1);

        $opc4 = $this->c->getNewCriterion(CpsoltraslaPeer::STANIV4, null);
        $opc44 = $this->c->getNewCriterion(CpsoltraslaPeer::STANIV4, 'N', Criteria::NOT_EQUAL);
        $opc4->addOr($opc44);
        $this->c->add($opc4);

        $opc5 = $this->c->getNewCriterion(CpsoltraslaPeer::STANIV5, null);
        $opc55 = $this->c->getNewCriterion(CpsoltraslaPeer::STANIV5, 'N', Criteria::NOT_EQUAL);
        $opc5->addOr($opc55);
        $this->c->add($opc5);

        $opc6 = $this->c->getNewCriterion(CpsoltraslaPeer::STANIV6, null);
        $opc66 = $this->c->getNewCriterion(CpsoltraslaPeer::STANIV6, 'N', Criteria::NOT_EQUAL);
        $opc6->addOr($opc66);
        $this->c->add($opc6);

        $this->columnas = array(
            CpsoltraslaPeer :: REFTRA => 'Código',
            CpsoltraslaPeer :: DESTRA => 'Descripción',
            CpsoltraslaPeer :: FECTRA => 'Fecha'
        );
    }

    public function Opdefemp_tsdefban() {
        $this->c = new Criteria();

        $this->columnas = array(
            TsdefbanPeer :: NUMCUE => 'Número',
            TsdefbanPeer :: NOMCUE => 'Descripción',
            #AGREGADO PARA REUTILIZAR CODIGO,SE USA EN EL FORMULARIO licplieesp
            TsdefbanPeer :: TIPCUE => 'Tipo de Cuenta',
            'tsdefban.destip' => 'Descripción Tipo de Cuenta',
        );
    }

    public function Facpicsollic_FCRegInm() {
        $this->c = new Criteria();
        $this->columnas = array(
            FcreginmPeer :: CODCATINM => 'Código Catastral',
            FcreginmPeer :: NOMCON => 'Descripción',
        );
    }

    public function Facpicsollic_Fcrutas() {
        $this->c = new Criteria();
        $this->columnas = array(
            FcrutasPeer :: CODRUT => 'Código',
            FcrutasPeer :: DESRUT => 'Descripción',
        );
    }

    public function Facpicsollic_Fcactcom() {
        //sql = "Select a.DesAct as Descripcion, a.CodAct as Codigo_Actividad, case2(a.Exoner,'S','SI','NO') as Exonerable from FCACTCOM a,FCDEFINS b Where Length(RTRIM(a.CodAct)) = Length(RTRIM(b.ForAct)) order by a.DesAct"
        $this->c = new Criteria();
        $this->sql = "length(rtrim(fcactcom.codact)) = length(rtrim(fcdefins.foract))";
        $this->c->add(FcdefinsPeer::FORACT, $this->sql, Criteria::CUSTOM);
        $this->columnas = array(
            FcactcomPeer::CODACT => 'Código Actividad',
            FcactcomPeer::DESACT => 'Descripción',
            FcactcomPeer::EXONER => 'Exonerado',
            FcactcomPeer::ANOACT => 'Año',
        );
    }

    public function Tsmotanu_Pagemiord() {
        $this->c = new Criteria();

        $this->columnas = array(
            TsmotanuPeer :: CODMOTANU => 'Codigo',
            TsmotanuPeer :: DESMOTANU => 'Descripcion'
        );
    }

    public function Cpcompro_PreAjuste($params = array()) {
        $this->c = new Criteria();
        $this->c->add(CpcomproPeer :: STACOM, 'A');
        $tipo = str_replace("*", "/", $params[0]);
        if ($params[2] == 'S')
            $this->sql = "cpcompro.feccom <= to_date('" . $tipo . "','dd/mm/yyyy')";
        else
            $this->sql = "cpcompro.feccom <= to_date('" . $tipo . "','dd/mm/yyyy') and (Select Sum(monimp-monaju-moncau) as moncom from cpimpcom where refcom=cpcompro.refcom) > 0";
        //$this->sql = "feccom <= to_date('".$params[0]."','dd/mm/yyyy') and (moncom-salaju-salcau) > 0";
        $this->c->add(CpcomproPeer :: FECCOM, $this->sql, Criteria :: CUSTOM);
        $this->c->addAscendingOrderByColumn(CpcomproPeer :: REFCOM);

        $this->columnas = array(
            CpcomproPeer :: REFCOM => 'Referencia',
            CpcomproPeer :: FECCOM => 'Fecha',
            CpcomproPeer :: DESCOM => 'Descripcion',
            CpcomproPeer :: MONCOM => 'Monto'
        );
    }

    public function Cpcausad_PreAjuste($params = array()) {
        $this->c = new Criteria();
        $this->c->add(CpcausadPeer :: STACAU, 'A');
        $tipo = str_replace("*", "/", $params[0]);
        if ($params[2] == 'S')
            $this->sql = "cpcausad.feccau <= to_date('" . $tipo . "','dd/mm/yyyy') ";
        else
            $this->sql = "cpcausad.feccau <= to_date('" . $tipo . "','dd/mm/yyyy') and (Select Sum(monimp-monaju-monpag) as moncau from cpimpcau where refcau=cpcausad.refcau) > 0";
        //$this->sql = "feccau <= to_date('".$params[0]."','dd/mm/yyyy') and (moncau-salaju-salpag) > 0";
        $this->c->add(CpcausadPeer :: FECCAU, $this->sql, Criteria :: CUSTOM);
        $this->c->addAscendingOrderByColumn(CpcausadPeer :: REFCAU);

        $this->columnas = array(
            CpcausadPeer :: REFCAU => 'Referencia',
            CpcausadPeer :: FECCAU => 'Fecha',
            CpcausadPeer :: DESCAU => 'Descripcion',
            CpcausadPeer :: MONCAU => 'Monto'
        );
    }

    public function Cppagos_PreAjuste($params = array()) {
        $this->c = new Criteria();
        $this->c->add(CppagosPeer :: STAPAG, 'A');
        $tipo = str_replace("*", "/", $params[0]);
        $this->sql = "cppagos.fecpag <= to_date('" . $tipo . "','dd/mm/yyyy') and (Select Sum(monimp-monaju) as monpag from cpimppag where refpag=cppagos.refpag) > 0";
        //$this->sql = "fecpag <= to_date('".$params[0]."','dd/mm/yyyy') and (monpag-salaju) > 0";
        $this->c->add(CppagosPeer :: FECPAG, $this->sql, Criteria :: CUSTOM);
        $this->c->addAscendingOrderByColumn(CppagosPeer :: REFPAG);

        $this->columnas = array(
            CppagosPeer :: REFPAG => 'Referencia',
            CppagosPeer :: FECPAG => 'Fecha',
            CppagosPeer :: DESPAG => 'Descripcion',
            CppagosPeer :: MONPAG => 'Monto'
        );
    }

    public function Cpprecom_PreAjuste($params = array()) {
        $this->c = new Criteria();
        $this->c->add(CpprecomPeer :: STAPRC, 'A');
        $tipo = str_replace("*", "/", $params[0]);
        if (count($params)>0) {
            if ($params[2] == 'S'){
                $this->sql = "cpprecom.fecprc <= to_date('" . $tipo . "','dd/mm/yyyy')";
             $this->c->add(CpprecomPeer :: FECPRC, $this->sql, Criteria :: CUSTOM);
            }
            else {
                if (count($params)==3) {
                    if ($params[2]=='S')
                      $this->sql = "cpprecom.fecprc <= to_date('" . $tipo . "','dd/mm/yyyy') and (Select Sum(monimp-monaju) as monprc from cpimpprc where refprc=cpprecom.refprc) > 0";
                    else
                      $this->sql = "cpprecom.fecprc <= to_date('" . $tipo . "','dd/mm/yyyy') and (Select Sum(monimp-monaju-moncom) as monprc from cpimpprc where refprc=cpprecom.refprc) > 0";
                   $this->c->add(CpprecomPeer :: FECPRC, $this->sql, Criteria :: CUSTOM);
               }
            }
        }
        $this->c->addAscendingOrderByColumn(CpprecomPeer :: REFPRC);

        $this->columnas = array(
            CpprecomPeer :: REFPRC => 'Referencia',
            CpprecomPeer :: FECPRC => 'Fecha',
            CpprecomPeer :: DESPRC => 'Descripcion',
            CpprecomPeer :: MONPRC => 'Monto'
        );
    }

/////CATASTRO ////////


    public function Catreginm_Catregper() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(CatregperPeer::CEDRIF);

        $this->columnas = array(
            CatregperPeer :: CEDRIF => 'C.I.',
            CatregperPeer :: PRINOM => 'Nombre',
            CatregperPeer :: PRIAPE => 'Apellido',
            CatregperPeer :: NOMPER => 'Razon Social',
        );
    }

    public function Catreginm_Catcarcon($params = '') {
        $this->c = new Criteria();
        $this->c->add(CatcarconPeer::TIPO, $params[0]);
        $this->c->addAscendingOrderByColumn(CatcarconPeer::NOMCARCON);

        $this->columnas = array(
            CatcarconPeer :: NOMCARCON => 'Descripción'
        );
    }

    public function Catdefdivbarurb_Catdivgeo($params = '') {
        $this->c = new Criteria();
        //$this->c->add(CatcarconPeer::TIPO,$params[0]);

        if (count($params) > 1) {
            $this->sql = "length(coddivgeo) = '$params[0]'";
            $this->c->add(Catdefdivbarurb_CatdivgeoCatdefdivbarurb_CatdivgeoPeer::CODDIVGEO, $this->sql, Criteria :: CUSTOM);
        }
        $this->c->addAscendingOrderByColumn(CatdivgeoPeer::CODDIVGEO);

        $this->columnas = array(
            CatdivgeoPeer::CODDIVGEO => 'Codigo',
            CatdivgeoPeer::DESDIVGEO => 'Descripcion'
        );
    }

    public function Catdefcatman_Cattramo($params = '') {
        $this->c = new Criteria();
        $this->c->add(CattramoPeer :: CATTIPVIA_ID, $params[0]);
        $this->c->add(CattramoPeer :: CATDIVGEO_ID, $params[1]);
        $this->c->addJoin(CattramoPeer :: CATDIVGEO_ID, CatdivgeoPeer :: ID);
        $this->c->addAscendingOrderByColumn(CattramoPeer :: CATDIVGEO_ID);

        $this->columnas = array(
            CattramoPeer :: NOMTRAMO => 'Descripcion'
        );
    }

    public function Atprovee_Aciprovee($params = '') {
        $this->c = new Criteria();

        $this->columnas = array(
            CaproveePeer::RIFPRO => 'Rif',
            CaproveePeer::NOMPRO => 'Razón Social',
        );
    }

    public function Octipins_Oycdefemp() {
        $this->c = new Criteria();

        $this->columnas = array(
            OctipinsPeer :: CODTIPINS => 'Codigo',
            OctipinsPeer :: DESTIPINS => 'Descripcion'
        );
    }

//////////////////////


    public function Asignarpartidasconceptos_Nppartidas() {

        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(NppartidasPeer :: CODPAR);

        $this->columnas = array(
            NppartidasPeer :: CODPAR => 'Código',
            NppartidasPeer :: NOMPAR => 'Descripción'
        );
    }

    public function Facpicsollic_Rifcon() {
        $this->c = new Criteria();
        $this->c->add(FcconrepPeer :: REPCON, 'C');
        $this->columnas = array(
            FcconrepPeer :: RIFCON => 'Código',
            FcconrepPeer :: NOMCON => 'Descripción',
        );
    }

    public function Facpicsollic_Rifrep() {
        $this->c = new Criteria();
        //$this->c->add(FcconrepPeer :: REPCON, 'R');
        $this->columnas = array(
            FcconrepPeer :: RIFCON => 'Código',
            FcconrepPeer :: NOMCON => 'Descripción',
        );
    }

    public function Npguarde_nphojint() {

        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(NpguardePeer :: CODCON);

        $this->columnas = array(
            NpguardePeer :: CODCON => 'Código',
            NpguardePeer :: NOMGUA => 'Descripción'
        );
    }

    public function Fcreginm_Facpicsollic() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(FcreginmPeer :: CODCATINM);
        $this->columnas = array(
            FcreginmPeer :: CODCATINM => 'Código',
            FcreginmPeer :: NOMCON => 'Descripción'
        );
    }

    public function Fcreginm_Fccatfis() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(FccatfisPeer :: CODCATFIS);
        $this->columnas = array(
            FccatfisPeer :: CODCATFIS => 'Código',
            FccatfisPeer :: NOMCATFIS => 'Descripción'
        );
    }

    public function Fcreginm_Fccarinm() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(FccarinmPeer :: CODCARINM);
        $this->columnas = array(
            FccarinmPeer :: CODCARINM => 'Código',
            FccarinmPeer :: NOMCARINM => 'Descripción'
        );
    }

    public function Fcreginm_Fcestinm() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(FcestinmPeer :: CODESTINM);
        $this->columnas = array(
            FcestinmPeer :: CODESTINM => 'Código',
            FcestinmPeer :: DESESTINM => 'Descripción'
        );
    }

    public function Fcreginm_Fcvalinm() {
        $this->c = new Criteria();
        $this->c->addSelectColumn(FcvalinmPeer :: CODZON);
        $this->c->addSelectColumn(FcvalinmPeer :: DESZON);
        $this->c->addSelectColumn("'' as CODTIP");
        $this->c->addSelectColumn("'' as DESTIP");
        $this->c->addSelectColumn("'' as VALMTR");
        $this->c->addSelectColumn("'' as VALFIS");
        $this->c->addSelectColumn("'' as ALITIP");
        $this->c->addSelectColumn("'' as ANUAL");
        $this->c->addSelectColumn("'' as ALITIPT");
        $this->c->addSelectColumn("'' as ANUALT");
        $this->c->addSelectColumn("'' as ANOVIG");
        $this->c->addSelectColumn("'' as PORVALFIS");
        $this->c->addSelectColumn("'' as ID");
        $this->c->addGroupByColumn(FcvalinmPeer :: DESZON);
        $this->c->addGroupByColumn(FcvalinmPeer :: CODZON);

        $this->columnas = array(
            FcvalinmPeer :: CODZON => 'Código',
            FcvalinmPeer :: DESZON => 'Descripción',
        );
    }

    public function Facinmreg_Fcvalinm($params) {
        $this->c = new Criteria();
        $this->c->clearSelectColumns();

        if (count($params) > 2) {
            $this->sql = "Select A.DesTip,A.CodTip,Anual as Bs_Construccion, valmtr as Bs_Terreno From FCValInm A,
						(Select Max(CodZon) as CodZon, MAX(AnoVig) as AnoVig
							From FCValInm Where CodZon='" . $params[1] . "' and AnoVig<='" . $params[0] . "') B
						Where A.CodZon='" . $params[1] . "' and A.Codzon=B.CodZon And A.AnoVig=B.AnoVig ";

            $this->c->getNewCriterion(FcvalinmPeer :: CODTIP, $this->sql, Criteria :: CUSTOM);
        }
        $this->columnas = array(
            FcvalinmPeer :: CODTIP => 'Número',
            FcvalinmPeer :: DESTIP => 'Descripción',
            FcvalinmPeer :: ANUAL => 'Bs. Construcción',
            FcvalinmPeer :: VALMTR => 'Bs. Terreno'
        );
    }

    public function Fcreginm_Fcusoinm() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(FcusoinmPeer :: CODUSOINM);
        $this->columnas = array(
            FcusoinmPeer :: CODUSOINM => 'Código',
            FcusoinmPeer :: NOMUSOINM => 'Descripción'
        );
    }

    public function Fcreginm_Fcsitjurinm() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(FcsitjurinmPeer :: CODSITINM);
        $this->columnas = array(
            FcsitjurinmPeer :: CODSITINM => 'Código',
            FcsitjurinmPeer :: NOMSITINM => 'Descripción'
        );
    }

    public function Npdefcpt_Nomdefespconsue($params) {
        $this->c = new Criteria();
        $this->c->add(NpasiconnomPeer :: CODNOM, $params[0]);
        $this->c->addJoin(NpdefcptPeer :: CODCON, NpasiconnomPeer :: CODCON);

        $this->columnas = array(
            NpdefcptPeer :: CODCON => 'Código',
            NpdefcptPeer :: NOMCON => 'Descripción'
        );
    }

    public function Optipret_Paggenretord($params) {
        $this->c = new Criteria();
        /* if ($params[0]!="")
          {
          $this->c->add(CaproretPeer::CODPRO, $params[0]);
          $this->c->addJoin(OptipretPeer::CODTIP, CaproretPeer::CODRET);
          } */

        $this->columnas = array(
            OptipretPeer :: CODTIP => 'Código',
            OptipretPeer :: DESTIP => 'Descripción'
        );
    }

    public function Almregpro_Carecaud($params = array()) {
        $this->c = new Criteria();
        $this->c->add(CarecaudPeer :: CODTIPREC, $params[0]);
        $this->c->addAscendingOrderByColumn(CarecaudPeer::CODREC);

        $this->columnas = array(
            CarecaudPeer::CODREC => 'Código',
            CarecaudPeer::DESREC => 'Descripción'
        );
    }

    public function Almregpro_Catiprec($params = array()) { //no borrar
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(CatiprecPeer::CODTIPREC);

        $this->columnas = array(
            CatiprecPeer::CODTIPREC => 'Código',
            CatiprecPeer::DESTIPREC => 'Descripción'
        );
    }

    public function Almregpro_Caramart($params = array()) {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(CaramartPeer::RAMART);

        $this->columnas = array(
            CaramartPeer::RAMART => 'Código',
            CaramartPeer::NOMRAM => 'Descripción'
        );
    }

    public function Almregpro_Optipret($params = array()) {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(OptipretPeer::CODTIP);

        $this->columnas = array(
            OptipretPeer::CODTIP => 'Código',
            OptipretPeer::DESTIP => 'Descripción',
            OptipretPeer::PORRET => 'Porcentaje',
            OptipretPeer::BASIMP => 'Base'
        );
    }

    public function Catreginm_Catcarter($params = '') {
        $this->c = new Criteria();
        $this->c->add(CatcarterPeer::TERTIP, $params[0]);
        $this->c->addAscendingOrderByColumn(CatcarterPeer::DESTER);

        $this->columnas = array(
            CatcarterPeer :: DESTER => 'Descripción'
        );
    }

    public function Presnomreghisadeint_Npadeint($params = array()) {
        $this->c = new Criteria();
        $this->c->add(NpasiempcontPeer :: CODTIPCON, $params[0]);
        $this->c->addAscendingOrderByColumn(NpasiempcontPeer :: CODEMP);
        $this->columnas = array(
            NpasiempcontPeer :: CODEMP => 'Codigo',
            NpasiempcontPeer :: NOMEMP => 'Nombre'
        );
    }

    public function Almregpro_Cabanco() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(CabancoPeer :: CODBAN);
        $this->columnas = array(
            CabancoPeer :: CODBAN => 'Codigo',
            CabancoPeer :: DESBAN => 'Nombre/Banco'
        );
    }

    public function Almregpro_Tstipcue() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(TstipcuePeer :: CODTIP);
        $this->columnas = array(
            TstipcuePeer :: CODTIP => 'Codigo',
            TstipcuePeer :: DESTIP => 'Descripcion'
        );
    }

    public function Opconpag_Pagemiord() {
        $this->c = new Criteria();

        $this->columnas = array(
            OpconpagPeer :: CODCONCEPTO => 'Concepto de Pago',
            OpconpagPeer :: NOMCONCEPTO => 'Descripcion'
        );
    }

    public function Npdefcpt_embargos() {
        $this->c = new Criteria();
        $this->c->add(NpdefcptPeer::OPECON, 'D');
        $this->c->addAscendingOrderByColumn(NpdefcptPeer::CODCON);
        $this->columnas = array(
            NpdefcptPeer :: CODCON => 'Código',
            NpdefcptPeer :: NOMCON => 'Descripción'
        );
    }

    public function Npdefcpt_embargos2() {
        $this->c = new Criteria();
        $this->c->add(NpdefcptPeer::OPECON, 'A');
        $this->c->addAscendingOrderByColumn(NpdefcptPeer::CODCON);
        $this->columnas = array(
            NpdefcptPeer :: CODCON => 'Código',
            NpdefcptPeer :: NOMCON => 'Descripción'
        );
    }

    public function Npbenefiemb_embargos() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(NpbenefiembPeer::CEDRIF);
        $this->columnas = array(
            NpbenefiembPeer :: CEDRIF => 'Cédula',
            NpbenefiembPeer :: NOMBEN => 'Nombre'
        );
    }

    public function Nptipret_codret($param = array()) {
        $this->c = new Criteria();

        $this->columnas = array(
            NptipretPeer :: CODRET => 'Código Retiro',
            NptipretPeer :: DESRET => 'Descripción'
        );
    }

    public function Npcalcon_nomcalcon2($params) {

        $this->c = new Criteria();
        $this->c->addJoin(NpasiconnomPeer :: CODNOM, NpasicarnomPeer :: CODNOM);
        $this->c->addJoin(NpasicarnomPeer :: CODNOM, NpnominaPeer :: CODNOM);
        $this->c->add(NpasiconnomPeer :: CODCON, $params[0]);
        $this->c->setDistinct();

        $this->columnas = array(
            NpnominaPeer :: NOMNOM => 'Nombre Nómina',
            NpnominaPeer :: CODNOM => 'Código'
        );
    }

    public function Catdefaval_Catreginm($params = '') {
        $this->c = new Criteria();

        $this->columnas = array(
            CatreginmPeer :: CODDIVGEO => 'Ubicación Geógrafica',
            CatreginmPeer :: NROCAS => 'N° Catastral',
        );
    }

    public function rhclacur_numcla($param = array()) {
        $this->c = new Criteria();

        if (count($param) > 0) {
            $this->c->add(RhclacurPeer :: CODCUR, $param[0]);
        }
        $this->c->addAscendingOrderByColumn(RhclacurPeer :: NUMCLA);
        $this->columnas = array(
            RhclacurPeer :: NUMCLA => 'Numero clase',
            RhclacurPeer :: FECCLA => 'Fecha'
        );
    }

    public function rhdefvalins_codvalins() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(RhdefvalinsPeer::CODVALINS);
        $this->columnas = array(
            RhdefvalinsPeer :: CODVALINS => 'Código',
            RhdefvalinsPeer :: DESVALINS => 'Descripción'
        );
    }

    public function rhdefniv_codniv() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(RhdefnivPeer::CODNIV);
        $this->columnas = array(
            RhdefnivPeer :: CODNIV => 'Código',
            RhdefnivPeer :: DESNIV => 'Descripción'
        );
    }

    public function Rhevaconcom_codevdo() {
        $this->c = new Criteria();
        $this->c->addJoin(NphojintPeer::CODEMP, RhdatevaPeer::CODEVDO);
        $this->c->addAscendingOrderByColumn(NphojintPeer::CODEMP);
        $this->columnas = array(
            NphojintPeer :: CODEMP => 'Código',
            NphojintPeer :: NOMEMP => 'Nombre',
            NphojintPeer :: STAEMP => 'Estatus'
        );
    }

    public function rhvalniv_codvalins($params = array()) {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(RhvalnivPeer::CODNIV);
        $this->columnas = array(
            RhvalnivPeer :: CODVALINS => 'Código',
            RhvalnivPeer :: DESVALINS => 'Descripción',
            RhvalnivPeer :: PORVALINS => 'Porcentaje'
        );
    }

    public function nphojint_codemp2() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(NphojintPeer::CODEMP);
        $this->columnas = array(
            NphojintPeer :: CODEMP => 'Código',
            NphojintPeer :: NOMEMP => 'Nombre',
            NphojintPeer :: FECING => 'Descripcion',
            NphojintPeer :: STAEMP => 'Estatus'
        );
    }

    public function rhdefind_codind() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(RhdefindPeer::CODIND);
        $this->columnas = array(
            RhdefindPeer :: CODIND => 'Código',
            RhdefindPeer :: DESIND => 'Nombre'
        );
    }

    public function rhdefobj_codobj() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(RhdefobjPeer::CODOBJ);
        $this->columnas = array(
            RhdefobjPeer :: CODOBJ => 'Código',
            RhdefobjPeer :: DESOBJ => 'Nombre'
        );
    }

    public function Npdefubi_Nomhojint() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(NpdefubiPeer::CODUBI);
        $this->columnas = array(
            NpdefubiPeer :: CODUBI => 'Código',
            NpdefubiPeer :: DESUBI => 'Nombre'
        );
    }

    public function Ccsoldescuades_Pagemiord() {

        // XX = ccsoldescuades c inner join ccsoldes e on c.ccsoldes_id=e.id
        // YY = (XX) inner join ccdetcuades d on c.cccuades_id=d.cccuades_id
        // ZZ = (YY) inner join cccredit b on e.cccredit_id=b.id
        // X = (ZZ) inner join cpcompro f on b.cpcompro_id=f.id
        // Y = (X) inner join ccdetcuades d on c.cccuades_id=d.cccuades_id
        // Z = (Y) inner join cccredit b on e.cccredit_id=b.id
        // (Z) inner join cpcompro f on b.cpcompro_id=f.id

        $this->sql = "cpcompro.moncom > ((Select case when Sum(moncau) isnull then 0 else Sum(moncau) end as moncau from cpimpcom where refcom=cpcompro.refcom)+(Select case when Sum(monaju) isnull then 0 else Sum(monaju) end as monaju from cpimpcom where refcom=cpcompro.refcom))";

        $this->c = new Criteria();

        $this->c->addJoin(CcsoldescuadesPeer::CCSOLDES_ID, CcsoldesPeer::ID);
        $this->c->addJoin(CcsoldescuadesPeer::CCCUADES_ID, CcdetcuadesPeer::CCCUADES_ID);
        $this->c->addJoin(CcsoldesPeer::CCCREDIT_ID, CccreditPeer::ID);
        $this->c->addJoin(CcsolliqPeer::CCSOLDES_ID, CcsoldesPeer::ID);
        $this->c->addJoin(CccreditPeer::CPCOMPRO_ID, CpcomproPeer::ID);

        $this->c->add(CpcomproPeer :: MONCOM, $this->sql, Criteria :: CUSTOM); //$this->c->add(CpcomproPeer :: MONCOM, CpcomproPeer :: SALCAU, Criteria :: NOT_EQUAL);

        $a = new Criteria();
        $dato = CadefartPeer :: doSelectOne($a);
        if ($dato) {
            if ($dato->getComreqapr() == 'S') {
                $this->c->add(CpcomproPeer :: APRCOM, 'S');
            }
        }
        $this->c->add(CpcomproPeer :: STACOM, 'N', Criteria :: NOT_EQUAL);
        $this->c->add(CcdetcuadesPeer::CPCAUSAD_ID, null, Criteria :: ISNULL);

        $this->columnas = array(
            'ccdetcuades.CODIGO' => 'Cod. Det. Desembolso',
            CcdetcuadesPeer :: MONTO => 'Monto',
            'ccdetcuades.FECHA' => 'Fecha',
            'ccdetcuades.RIFTER' => 'Cod. Beneficiario',
            'ccdetcuades.NOMTER' => 'Nombre',
            'ccdetcuades.REFCOM' => 'Compromiso',
            'ccdetcuades.DESCOM' => 'Descripcion',
        );
    }

    public function Facotringreg_Rifcon() {
        $this->c = new Criteria();
        $this->c->add(FcconrepPeer :: REPCON, 'C');
        $this->columnas = array(
            FcconrepPeer :: RIFCON => 'Código',
            FcconrepPeer :: NOMCON => 'Descripción',
        );
    }

    public function Facotringreg_Rifrep() {
        $this->c = new Criteria();
        $this->c->add(FcconrepPeer :: REPCON, 'R');
        $this->columnas = array(
            FcconrepPeer :: RIFCON => 'Código',
            FcconrepPeer :: NOMCON => 'Descripción',
        );
    }

    public function Facotringreg_Numref($params = array()) {
        $this->c = new Criteria();
        $this->c->add(FcsollicPeer :: STALIC, 'V');
        $this->c->add(FcsollicPeer::NUMLIC, null, Criteria :: ISNOTNULL);
        $this->c->add(FcsollicPeer :: RIFCON, $params[0]);
        $this->c->addAscendingOrderByColumn(FcsollicPeer::NOMNEG);

        $this->columnas = array(
            FcsollicPeer :: NOMNEG => 'Nombre',
            FcsollicPeer :: NUMLIC => 'Licencia',
            FcsollicPeer :: RIFCON => 'Rif',
            FcsollicPeer :: DIRPRI => 'Direccion'
        );
    }

    public function Fordefcatpre_Codcat($params = array()) {
        $this->c = new Criteria();
        $this->sql = "length(codcat)='" . $params[0] . "'";
        $this->c->add(FordefcatprePeer::CODCAT, $this->sql, Criteria::CUSTOM);

        $this->columnas = array(
            FordefcatprePeer :: CODCAT => 'Código',
            FordefcatprePeer :: NOMCAT => 'Descripción',
        );
    }

    public function Fordefparegr_Codparegr($params = array()) {

        $this->c = new Criteria();
        $this->sql = "length(codparegr)='" . $params[0] . "'";
        $this->c->add(FordefparegrPeer::CODPAREGR, $this->sql, Criteria::CUSTOM);

        $this->columnas = array(
            FordefparegrPeer :: CODPAREGR => 'Código',
            FordefparegrPeer :: NOMPAREGR => 'Descripción',
        );
    }

    public function Usuarios_Compras() {
        $this->c = new Criteria();
        $this->columnas = array(
            UsuariosPeer :: LOGUSE => 'Usuario',
            UsuariosPeer :: NOMUSE => 'Nombre'
        );
    }

    public function Npcatpre2_Almsolegr($mascara) {
        $mask = $mascara[0];
        $this->c = new Criteria();
        $this->sql = "length(CodCat) = '" . $mask . "'";

        $this->c->add(NpcatprePeer :: CODCAT, $this->sql, Criteria :: CUSTOM);
        //   $this->c->addAscendingOrderByColumn(NpcatprePeer::CODCAT);

        $this->columnas = array(
            NpcatprePeer :: CODCAT => 'Código',
            NpcatprePeer :: NOMCAT => 'Descripción'
        );
    }

    public function Opordpag_Bieregactmued() {
        $this->c = new Criteria();
        $this->columnas = array(
            OpordpagPeer :: NUMORD => 'N° de Orden',
            OpordpagPeer :: FECEMI => 'Fecha de Emisión',
            OpordpagPeer :: DESORD => 'Descripción'
        );
    }

    public function Npdocemp_nonhojint() {
        $this->c = new Criteria();
        $this->columnas = array(
            NpdocempPeer :: CODDOC => 'Código',
            NpdocempPeer :: DESDOC => 'Descripción'
        );
    }

    public function Codefcencos_Conasigcencos() {
        $this->c = new Criteria();
        $this->columnas = array(
            CodefcencosPeer :: CODCENCOS => 'Código',
            CodefcencosPeer :: DESCENCOS => 'Descripción'
        );
    }

    public function Contabb_Conasigcencos($param = array()) {
        $this->c = new Criteria();

        $this->c->add(ContabbPeer :: CARGAB, 'C');
        $this->c->add(Contabc1Peer :: NUMCOM, $param[0]);
        $this->c->addJoin(ContabbPeer :: CODCTA, Contabc1Peer :: CODCTA);


        $this->columnas = array(
            ContabbPeer :: CODCTA => 'Código',
            ContabbPeer :: DESCTA => 'Descripción',
        );
    }

    public function Cadefcen_Almsolegr() {
        $filiscen = H::getConfApp2('filiscen', 'compras', 'almreq');
        $filiscendesp = H::getConfApp2('filiscen', 'compras', 'almdesp');
        $loguse = sfContext::getInstance()->getUser()->getAttribute('loguse');

        $this->c = new Criteria();
        if ($filiscen == 'S' || $filiscendesp == 'S') {
            $this->sql = 'cadefcen.codcen in (select codcen from "SIMA_USER".segcenusu where loguse=\'' . $loguse . '\')';
            $this->c->add(CadefcenPeer::CODCEN, $this->sql, Criteria::CUSTOM);
        }

        $this->columnas = array(
            CadefcenPeer :: CODCEN => 'Código',
            CadefcenPeer :: DESCEN => 'Descripción'
        );
    }

    public function Nptippar_Nomdefhcmnom() {
        $this->c = new Criteria();
        $this->columnas = array(
            NptipparPeer::TIPPAR => 'Tipo',
            NptipparPeer::DESPAR => 'Descripción'
        );
    }

    public function Viadeftiptra_codtiptra() {
        $this->c = new Criteria();
        $this->columnas = array(
            ViadeftiptraPeer :: CODTIPTRA => 'Código',
            ViadeftiptraPeer :: DESTIPTRA => 'Descripción',
        );
    }

    public function Viadefnivapr_codnivapr() {
        $this->c = new Criteria();
        $this->columnas = array(
            ViadefnivaprPeer :: CODNIVAPR => 'Código',
            ViadefnivaprPeer :: DESNIVAPR => 'Descripción',
        );
    }

    public function Viadefproced_codproced() {
        $this->c = new Criteria();
        $this->columnas = array(
            ViadefprocedPeer :: CODPROCED => 'Código',
            ViadefprocedPeer :: DESPROCED => 'Descripción',
        );
    }

    public function Viadefniv_codniv() {
        $this->c = new Criteria();
        $this->columnas = array(
            ViadefnivPeer :: CODNIV => 'Código',
            ViadefnivPeer :: DESNIV => 'Descripción',
        );
    }

    public function Viadefrub_codrub() {
        $this->c = new Criteria();
        $this->columnas = array(
            ViadefrubPeer :: CODRUB => 'Código',
            ViadefrubPeer :: DESRUB => 'Descripción',
        );
    }

    public function Viadeffortra_codfortra() {
        $this->c = new Criteria();
        $this->columnas = array(
            ViadeffortraPeer :: CODFORTRA => 'Código',
            ViadeffortraPeer :: DESFORTRA => 'Descripción',
        );
    }

    public function Viasolviatra_numsol() {
        $loguse= sfContext::getInstance()->getUser()->getAttribute('loguse');
        $filsoldir=H::getConfApp2('filsoldir', 'viaticos', 'viasolviatra');

        $manaprdirsup=H::getConfApp2('manaprdirsup', 'viaticos', 'viasolviatra');
        $this->c = new Criteria();
        $this->c->add(ViasolviatraPeer::STATUS, 'A');
        if ($manaprdirsup=='S')
            $this->c->add(ViasolviatraPeer::STATUSDIR, 'A');

        if ($filsoldir=='S'){
          $esgerente=H::getX_vacio('LOGUSE','Usuarios','Esgeren',$loguse);
          if ($esgerente=='N')
            $sql = 'Viasolviatra.numsol not in  (select refsol from viacalviatra where status<>\'N\') and viasolviatra.coddirec in (select coddirec from "SIMA_USER".segdirusu where loguse=\''.$loguse.'\') and viasolviatra.logusu=\''.$loguse.'\'';
          else
            $sql = 'Viasolviatra.numsol not in  (select refsol from viacalviatra where status<>\'N\') and viasolviatra.coddirec in (select coddirec from "SIMA_USER".segdirusu where loguse=\''.$loguse.'\')';
        }
        else
          $sql = "Viasolviatra.numsol not in  (select refsol from viacalviatra where status<>'N') ";
        $this->c->add(ViasolviatraPeer :: NUMSOL, $sql, Criteria :: CUSTOM);

        $this->columnas = array(
            ViasolviatraPeer :: NUMSOL => 'Código',
            ViasolviatraPeer :: FECSOL => 'Fecha',
            ViasolviatraPeer :: DESSOL => 'Descripción',
        );
    }

    public function Viadefproced_codproced_apr() {
        $this->c = new Criteria();
        $this->c->add(ViadefprocedPeer::APROBACION, 'S');
        $this->columnas = array(
            ViadefprocedPeer :: CODPROCED => 'Código',
            ViadefprocedPeer :: DESPROCED => 'Descripción',
        );
    }

    public function Viadefrub_codrub_cal() {
        $this->c = new Criteria();
        $this->c->add(ViadefrubPeer::TIPO, 'C');
        $this->columnas = array(
            ViadefrubPeer :: CODRUB => 'Código',
            ViadefrubPeer :: DESRUB => 'Descripción',
        );
    }

    public function Viacalviatra_numsolvia() {
        $this->c = new Criteria();
        $this->c->addJoin(ViasolviatraPeer::NUMSOL, ViacalviatraPeer::REFSOL);
        $this->c->add(ViacalviatraPeer::STATUS, 'A');
        $this->columnas = array(
            ViasolviatraPeer :: NUMSOL => 'Referencia',
            ViasolviatraPeer :: CODEMP => 'Empleado',
        );
    }

    public function viaestado_codpai() {
        $this->c = new Criteria();
        $this->columnas = array(
            ViapaisPeer :: CODPAI => 'Código',
            ViapaisPeer :: NOMPAI => 'Nombre',
        );
    }

    public function viaestado_codest($params = array()) {
        $this->c = new Criteria();
        if ($params)
            $this->c->add(ViaestadoPeer :: CODPAI, $params[0]);
        $this->columnas = array(
            ViaestadoPeer :: CODEST => 'Código',
            ViaestadoPeer :: NOMEST => 'Nombre',
        );
    }

    public function viaciudad_codciu($params = array()) {
        $this->c = new Criteria();
        if ($params)
            $this->c->add(ViaciudadPeer :: CODEST, $params[0]);
        if (count($params) > 1)
            $this->c->add(ViaciudadPeer :: CODPAI, $params[1]);
        $this->columnas = array(
            ViaciudadPeer :: CODCIU => 'Código',
            ViaciudadPeer :: NOMCIU => 'Nombre',
        );
    }

    public function Segnivapr_Usuarios() {
        $this->c = new Criteria();

        $this->columnas = array(
            SegnivaprPeer :: CODNIV => 'Código',
            SegnivaprPeer :: DESNIV => 'Nombre'
        );
    }

    public function Cpprecom_Precompro($params = array()) {
        $this->c = new Criteria();
        $loguse= sfContext::getInstance()->getUser()->getAttribute('loguse');
        $filsoldir3=H::getConfApp2('filsoldir', 'presupuesto', 'preprecom');

        $this->c->clearSelectColumns();
        $this->c->addSelectColumn(CpprecomPeer :: REFPRC);
        $this->c->addSelectColumn("'' as TIPPRC");
        $this->c->addSelectColumn(CpprecomPeer :: FECPRC);
        $this->c->addSelectColumn("'' as ANOPRC");
        $this->c->addSelectColumn(CpprecomPeer :: DESPRC);
        $this->c->addSelectColumn("'' as DESANU");
        $this->c->addSelectColumn("'' as MONPRC");
        $this->c->addSelectColumn("'' as SALCOM");
        $this->c->addSelectColumn("'' as SALCAU");
        $this->c->addSelectColumn("'' as SALPAG");
        $this->c->addSelectColumn("'' as SALAJU");
        $this->c->addSelectColumn("'' as STAPRC");
        $this->c->addSelectColumn("'1937-01-01' as FECANU");
        $this->c->addSelectColumn(CpprecomPeer :: CEDRIF);
        $this->c->addSelectColumn("'' as REFSOL");
        $this->c->addSelectColumn("'1937-01-01' as FECREG");
        $this->c->addSelectColumn("'' as CODDIREC");
        $this->c->addSelectColumn("'' as ID");

        if ($params[0] != '') {
            $fecprc = explode('*', $params[0]);
            $fecha = $fecprc[2] . '-' . $fecprc[1] . '-' . $fecprc[0];

            $this->c->add(CpprecomPeer :: STAPRC, 'A');
            $this->c->add(CpprecomPeer :: FECPRC, $fecha, Criteria::LESS_EQUAL);
            //$this->c->add(CpprecomPeer :: SALCOM, CpprecomPeer :: SALCOM . "<" . CpprecomPeer :: MONPRC . "-" . CpprecomPeer :: SALAJU, Criteria :: CUSTOM);
        } else {
            $this->c->add(CpprecomPeer :: STAPRC, 'A');
            //$this->c->add(CpprecomPeer :: SALCOM, CpprecomPeer :: SALCOM . "<" . CpprecomPeer :: MONPRC . "-" . CpprecomPeer :: SALAJU, Criteria :: CUSTOM);
        }
        if ($filsoldir3=='S'){
          $sql='cpprecom.coddirec in (select coddirec from "SIMA_USER".segdirusu where loguse=\''.$loguse.'\')';
          $this->c->add(CpprecomPeer::CODDIREC,$sql,Criteria::CUSTOM);
        }
        $this->c->addJoin(CpprecomPeer::REFPRC,CpimpprcPeer::REFPRC);

        $sub = $this->c->getNewCriterion(CpprecomPeer :: REFPRC, 'SUM(COALESCE(' . CpimpprcPeer :: MONIMP . ',0)) > SUM(COALESCE(' . CpimpprcPeer :: MONCOM . ',0))', Criteria :: CUSTOM);
        $this->c->addHaving($sub);

        $this->c->addGroupByColumn(CpprecomPeer :: REFPRC);
        $this->c->addGroupByColumn(CpprecomPeer :: FECPRC);
        $this->c->addGroupByColumn(CpprecomPeer :: CEDRIF);
        $this->c->addGroupByColumn(CpprecomPeer :: DESPRC);
        $this->c->addAscendingOrderByColumn(CpprecomPeer :: REFPRC);

        $this->columnas = array(
            CpprecomPeer :: REFPRC => 'Referencia',
            CpprecomPeer :: DESPRC => 'Descripción',
            CpprecomPeer :: CEDRIF => 'Cedula',
            CpprecomPeer :: FECPRC => 'Fecha'
        );
    }

    public function Contabb_Confintipcuecon() {
        $this->c = new Criteria();
        $this->c->add(ContabbPeer :: CARGAB, 'N', Criteria :: NOT_EQUAL);

        $this->columnas = array(
            ContabbPeer :: CODCTA => 'Codigo',
            ContabbPeer :: DESCTA => 'Descripción',
        );
    }

    public function Contabb_Confincom($param = array()) {
        $this->c = new Criteria();
        $this->c->add(ContabbPeer :: CARGAB, 'C');
        $this->c->addAscendingOrderByColumn(ContabbPeer :: CODCTA);

        $this->columnas = array(
            ContabbPeer :: CODCTA => 'Código',
            ContabbPeer :: DESCTA => 'Descripción',
        );
    }

    public function Npmotegr_Nomhojint() {
        $this->c = new Criteria();
        $this->columnas = array(
            NpmotegrPeer :: CODMOT => 'Código',
            NpmotegrPeer :: DESMOT => 'Descripción',
        );
    }

    public function Npdefcpt_Npasiconemp($params) {
        $this->c = new Criteria();
        $this->c->add(NpasiconnomPeer :: CODNOM, $params[0]);
        $this->c->addJoin(NpdefcptPeer :: CODCON, NpasiconnomPeer :: CODCON);

        $this->columnas = array(
            NpdefcptPeer :: CODCON => 'Código',
            NpdefcptPeer :: NOMCON => 'Nombre'
        );
    }

    public function Fafacturpro_reffac() {
        $this->c = new Criteria();
        $sql = "fafacturpro.reffac in  (select reffac from faartfacpro where estatus='A') ";
        $this->c->add(FafacturproPeer :: REFFAC, $sql, Criteria :: CUSTOM);

        $this->columnas = array(
            FafacturproPeer :: REFFAC => 'Proforma',
            FafacturproPeer :: FECFAC => 'Fecha',
        );
    }

    public function viacalviatra_numcal() {
        $this->c = new Criteria();
        $this->columnas = array(
            ViacalviatraPeer :: NUMCAL => 'Número Viatico',
            ViacalviatraPeer :: FECCAL => 'Fecha',
        );
    }

    public function Opsolpag_Pagemiord() {

        $this->c = new Criteria();

        $this->c->add(OpsolpagPeer::STASOL, 'A');

        $this->columnas = array(
            OpsolpagPeer::REFSOL => 'Nro. Solicitud',
            OpsolpagPeer::MONSOL => 'Monto',
            OpsolpagPeer::CEDRIF => 'Cedula/Rif',
            OpsolpagPeer::NOMBEN => 'Nombre',
            OpsolpagPeer::REFCOM => 'Compromiso',
                //OpsolpagPeer::NUMSOLCRE => 'Nro. Sol. Cred.',
                //OpsolpagPeer::NUMCRE => 'Nro. Credito',
        );
    }

    public function Fordefcatpre_Forotrcrepre($params = array()) {

        $this->c = new Criteria();
        $this->sql = "length(codcat) = '" . $params[0] . "'";
        $this->c->add(FordefcatprePeer :: CODCAT, $this->sql, Criteria :: CUSTOM);

        $this->columnas = array(
            FordefcatprePeer :: CODCAT => 'Código',
            FordefcatprePeer :: NOMCAT => 'Nombre'
        );
    }

    public function Fordeforgpub_Forotrcrepre($params = array()) {

        $this->c = new Criteria();

        $this->columnas = array(
            FordeforgpubPeer :: CODORG => 'Código',
            FordeforgpubPeer :: NOMORG => 'Nombre'
        );
    }

    public function Fordefunieje_Forcatprogra() {

        $this->c = new Criteria();

        $this->columnas = array(
            FordefuniejePeer :: CODUNI => 'Código',
            FordefuniejePeer :: NOMUNI => 'Nombre'
        );
    }

    public function Fordefpro_Fordefmet() {

        $this->c = new Criteria();

        $this->columnas = array(
            FordefproPeer :: CODPRO => 'Código',
            FordefproPeer :: DESPRO => 'Descripción'
        );
    }

    public function Fordefproble_Forasoproobj() {

        $this->c = new Criteria();

        $this->columnas = array(
            FordefproblePeer :: CODPRO => 'Código',
            FordefproblePeer :: NOMPRO => 'Descripción'
        );
    }

    public function Fordefobj_Forasoproobj() {

        $this->c = new Criteria();

        $this->columnas = array(
            FordefobjPeer :: CODOBJ => 'Código',
            FordefobjPeer :: DESOBJ => 'Descripción'
        );
    }

    public function Fordefmet_Forasometobj() {

        $this->c = new Criteria();

        $this->columnas = array(
            FordefmetPeer :: CODMET => 'Código',
            FordefmetPeer :: DESMET => 'Descripción'
        );
    }

    public function Fordefact_Forasoactmet($params = array()) {

        $this->c = new Criteria();
        $this->c->add(ForasoactproPeer::CODMET, $params[0]);
        $this->c->add(ForasoactproPeer::CODPRO, $params[1]);
        $this->c->addJoin(FordefactPeer::CODACT, ForasoactproPeer::CODACT);

        $this->columnas = array(
            FordefactPeer :: CODACT => 'Código',
            FordefactPeer :: DESACT => 'Descripción'
        );
    }

    public function Fordefpro_Forasoactmet($params = array()) {

        $this->c = new Criteria();
        $this->c->add(ForasoprometPeer::CODMET, $params[0]);
        $this->c->addJoin(FordefproPeer::CODPRO, ForasoprometPeer::CODPRO);

        $this->columnas = array(
            FordefproPeer :: CODPRO => 'Código',
            FordefproPeer :: DESPRO => 'Descripción'
        );
    }

    public function Caregart_Forestcos($params = array()) {
        $this->c = new Criteria();
        $longitud = $params[0];
        $this->c = new Criteria();
        $this->sql = "length(Codart) = '" . $longitud . "'";
        $this->c->add(CaregartPeer :: CODART, $this->sql, Criteria :: CUSTOM);

        $this->columnas = array(
            CaregartPeer :: CODART => 'Codigo',
            CaregartPeer :: DESART => 'Descripcion',
            CaregartPeer :: UNIMED => 'Unidad',
            CaregartPeer :: CODPAR => 'Partida',
            CaregartPeer :: COSULT => 'Costo'
        );
    }

    public function Seggrupo_Segasigpergru() {

        $this->c = new Criteria();

        $this->columnas = array(
            SeggrupoPeer :: CODGRU => 'Código',
            SeggrupoPeer :: DESGRU => 'Descripción'
        );
    }

    public function Fordefobr_Forpreobr() {

        $this->c = new Criteria();

        $this->columnas = array(
            FordefobrPeer :: CODOBR => 'Código',
            FordefobrPeer :: NOMOBR => 'Descripción',
            FordefobrPeer :: CODPAREGR => 'Partida'
        );
    }

    public function Fadescripfac_Fafacturpro() {

        $this->c = new Criteria();

        $this->columnas = array(
            FadescripfacPeer :: DESFAC => 'Descripción',
            FadescripfacPeer :: ID => 'ID'
        );
    }

    public function Caprovee_Faregots() {
        $this->c = new Criteria();
        $this->c->add(CaproveePeer :: TIPO, 'P');

        $this->columnas = array(
            CaproveePeer :: RIFPRO => 'Código',
            CaproveePeer :: NOMPRO => 'Descripción',
            CaproveePeer :: CODPRO => 'Codigo'
        );
    }

    public function Faregots_Fafacturpro() {
        $this->c = new Criteria();

        $this->columnas = array(
            FaregotsPeer :: CEDRIF => 'Cédula',
            FaregotsPeer :: NOMOTS => 'Nombre',
            FaregotsPeer :: RIFPRO => 'Cooperativa',
            FaregotsPeer :: PLACA => 'Placa'
        );
    }

    public function Faobservafac_Fafacturpro() {

        $this->c = new Criteria();

        $this->columnas = array(
            FaobservafacPeer :: OBSFAC => 'Observación'
        );
    }

    public function Fadefpro_Fafacturpro() {
        $this->c = new Criteria();

        $this->columnas = array(
            FadefproPeer :: CODPROD => 'Código',
            FadefproPeer :: DESPROD => 'Descripción'
        );
    }

    public function Cadefcenaco_Almsolegr() {
        $this->c = new Criteria();
        $this->columnas = array(
            CadefcenacoPeer :: CODCENACO => 'Código',
            CadefcenacoPeer :: DESCENACO => 'Descripción'
        );
    }

    public function Tsuniadm_Tesdeffonant() {
        $camcatejeadm = H::getConfApp2('camcatejeadm', 'tesoreria', 'tesdeffonant');



        $this->c = new Criteria();

        if ($camcatejeadm == 'S') {
            $this->columnas = array(
                BnubicaPeer :: CODUBI => 'Código',
                BnubicaPeer :: DESUBI => 'Descripción',
            );
        } else {
            $this->columnas = array(
                TsuniadmPeer :: CODUNIADM => 'Código',
                TsuniadmPeer :: DESUNIADM => 'Descripción'
            );
        }
    }

    public function Npcargos_Forasoconcar($params = array()) {
        $longitud = $params[0];
        $this->c = new Criteria();
        $this->sql = "length(Codcar) = '" . $longitud . "'";
        $this->c->add(NpcargosPeer :: CODCAR, $this->sql, Criteria :: CUSTOM);

        $this->columnas = array(
            NpcargosPeer :: CODCAR => 'Código',
            NpcargosPeer :: NOMCAR => 'Nombre'
        );
    }

    public function Catipalm_id() {
        $this->c = new Criteria();
        $this->columnas = array(
            #CatipalmPeer :: ID=> 'Código',
            CatipalmPeer :: NOMTIP => 'Descripción'
        );
    }

    public function Catipalm_codedo() {
        $this->c = new Criteria();
        $this->columnas = array(
            OcestadoPeer :: CODEDO => 'Código',
            OcestadoPeer :: NOMEDO => 'Estado'
        );
    }

    public function Cadefalm_Camigtxt() {
        $this->c = new Criteria();
        $this->c->add(CadefalmPeer::ESPTOVEN, true);

        $this->columnas = array(
            CadefalmPeer :: CODALM => 'Codigo',
            CadefalmPeer :: NOMALM => 'Descripcion'
        );
    }

    public function Bnregsem_Biedisactsem() {
        $this->c = new Criteria();

        $this->columnas = array(
            BnregsemPeer :: CODACT => 'Activo',
            BnregsemPeer :: CODSEM => 'Semoviente',
            BnregsemPeer :: DESSEM => 'Nombre',
            BnregsemPeer :: VALINI => 'Valor',
            BnregsemPeer :: STASEM => 'Estatus',
        );
    }

    public function Cagrucla_almcontrato() {
        $this->c = new Criteria();

        $this->columnas = array(
            CagruclaPeer :: CODGRU => 'Codigo',
            CagruclaPeer :: DESGRU => 'Descripcion'
        );
    }

    public function Cadefcla_almcontrato() {
        $this->c = new Criteria();

        $this->columnas = array(
            CadefclaPeer :: CODCLA => 'Codigo',
            CadefclaPeer :: DESCLA => 'Descripcion'
        );
    }

    public function CaOrdCom_Almordrec2($params = array()) {
        //Este es el SQL Original
        // $sql="Select a.OrdCom as Codigo,a.FecOrd as Fecha, a.DesOrd as Descripcion from CaOrdCom a,CPCompro b,CPDocCom c where a.StaOrd<>'N' and a.OrdCom=b.RefCom and b.TipCom=C.TipCom and (c.refprc<>'N' or  c.afeprc<>'N' or c.afecom<>'N' or c.afedis<>'N') order by a.OrdCom";
        $this->c = new Criteria();

        if (count($params) > 1) {
            $this->c->addJoin(CaordcomPeer :: ORDCOM, CpcomproPeer :: REFCOM);
            $this->c->addJoin(CpcomproPeer :: TIPCOM, CpdoccomPeer :: TIPCOM);
            $this->c->addJoin(CaordcomPeer :: ORDCOM, CaentordPeer ::ORDCOM);
            $this->c->add(CaentordPeer :: CODALM, $params[0]);
        }
        //$sub = $this->c->getNewCriterion(CpdoccomPeer :: REFPRC, "N", Criteria :: NOT_EQUAL);
        //$sub->addOr($this->c->getNewCriterion(CpdoccomPeer :: AFEPRC, "N", Criteria :: NOT_EQUAL));
        //$sub->addOr($this->c->getNewCriterion(CpdoccomPeer :: AFECOM, "N", Criteria :: NOT_EQUAL));
        //$sub->addOr($this->c->getNewCriterion(CpdoccomPeer :: AFEDIS, "N", Criteria :: NOT_EQUAL));
        //$this->c->add($sub);
        $this->c->add(CaordcomPeer :: STAORD, "N", Criteria :: NOT_EQUAL);
        $this->c->addJoin(CaordcomPeer :: ORDCOM, CaartordPeer :: ORDCOM);
        $this->c->add(CaartordPeer :: CERART, null);
        $this->sql = "(Caartord.canord - Caartord.canaju > Caartord.canrec) ";
        $loguse= sfContext::getInstance()->getUser()->getAttribute('loguse');
        $filsoldir=H::getConfApp2('filsoldir', 'compras', 'almsolegr');
        if ($filsoldir=='S')
          $this->sql.=' and caordcom.coddirec in (select coddirec from "SIMA_USER".segdirusu where loguse=\''.$loguse.'\')';

        $this->c->add(CaartordPeer :: CANORD, $this->sql, Criteria :: CUSTOM);
        $this->c->setDistinct();

        $this->c->addAscendingOrderByColumn(CaordcomPeer :: ORDCOM);

        $this->columnas = array(
            CaordcomPeer :: ORDCOM => 'Código',
            CaordcomPeer :: FECORD => 'Fecha',
            CaordcomPeer :: DESORD => 'Descripción'
        );
    }

    public function Nppartidas_Precontra2() {

        $sql2 = "SELECT (SUM(LONNIV)+COUNT(CATPAR)+1) as inipartida FROM CPNIVELES WHERE CATPAR='C'";
        if (Herramientas::BuscarDatos($sql2, $results)) {
            $inicio = $results[0]["inipartida"];
        }

        $consec = H::getX_vacio('CODEMP', 'Cpdefniv', 'Conpar', '001');
        $sql = "SELECT (SUM(LONNIV)+COUNT(CATPAR)-1) as lonpartida FROM CPNIVELES WHERE CATPAR='P' AND CONSEC<=" . $consec . ";";
        if (Herramientas::BuscarDatos($sql, $result)) {
            $fin = $result[0]["lonpartida"];
        }

        $this->c = new Criteria();
        $this->c->addSelectColumn(' SUBSTR(' . CpdeftitPeer :: CODPRE . ',' . $inicio . ',' . $fin . ') as CODPRE');
        $this->c->addSelectColumn(CpdeftitPeer :: NOMPRE);
        $this->c->addSelectColumn(CpdeftitPeer :: CODCTA);
        $this->c->addSelectColumn(CpdeftitPeer :: STACOD);
        $this->c->addSelectColumn(CpdeftitPeer :: CODUNI);
        $this->c->addSelectColumn(CpdeftitPeer :: ESTATUS);
        $this->c->addSelectColumn(CpdeftitPeer :: CODTIP);
        $this->c->addSelectColumn(CpdeftitPeer :: ID);
        $this->sql = "trim(substr(codpre,$inicio,$fin))!=''";
        $this->c->add(CpdeftitPeer :: CODPRE, $this->sql, Criteria :: CUSTOM);
        $this->c->setDistinct();

        $this->columnas = array(
            CpdeftitPeer :: CODPRE => 'Codigo Partida',
            CpdeftitPeer :: NOMPRE => 'Nombre Partida',
        );
    }

    public function Nppartidas_Precontra() {

        $this->c = new Criteria();

        $this->columnas = array(
            PrepartidasPeer :: CODPAR => 'Codigo Partida',
            PrepartidasPeer :: NOMPAR => 'Nombre Partida',
        );
    }

    public function Almentdes_Cadphart() {
        $this->c = new Criteria();


        $this->columnas = array(
            CadphartPeer :: DPHART => 'Número',
            CadphartPeer :: DESDPH => 'Descripción',
            CadphartPeer :: FECDPH => 'Fecha',
        );
    }

    public function Nppartidas_Caregart($params = array()) {
        $this->c = new Criteria();
        $this->c->add(CaartparPeer :: CODART, $params[0]);

        $this->columnas = array(
            CaartparPeer :: CODPAR => 'Partida',
        );
    }

    public function Bnubica_Almordcom2() {

        $camcatejeadm = H::getConfApp2('camcatejeadm', 'tesoreria', 'tesdeffonant');

        $this->c = new Criteria();

        if ($camcatejeadm == 'S') {
            $this->columnas = array(
                CadefcenPeer :: CODCEN => 'Código',
                CadefcenPeer :: DESCEN => 'Descripción'
            );
        } else {
            $this->c->addAscendingOrderByColumn(BnubicaPeer :: CODUBI);

            $this->columnas = array(
                BnubicaPeer :: CODUBI => 'Código',
                BnubicaPeer :: DESUBI => 'Descripción',
            );
        }
    }

    public function Cadefalm_Almtraalm() {

        $c = new Criteria();
        $per = CausualmPeer::doselectOne($c);

        if ($per) {
            $dato = H::GetX('Loguse', 'Usuarios', 'Cedemp', sfContext::getInstance()->getUser()->getAttribute('loguse'));

            $this->c = new Criteria();
            $this->c->add(CausualmPeer::CEDEMP, $dato);
            $this->c->addJoin(CadefalmPeer::CODALM, CausualmPeer::CODALM);
            $this->c->addAscendingOrderByColumn(CadefalmPeer :: CODALM);
            $this->columnas = array(
                CadefalmPeer :: CODALM => 'Código',
                CadefalmPeer :: NOMALM => 'Descripción',
            );
        } else {
            $this->c = new Criteria();
            $almseparados = H::getConfAppGen('almseparados');
            if ($almseparados == 'S') {
                $modulo = sfContext::getInstance()->getUser()->getAttribute('menu', '', 'autenticacion');
                if ($modulo == 'facturacion') {
                    $this->c->add(CadefalmPeer::TIPREG, 'F');
                } else {
                    $this->sql = "tipreg<>'F' or tipreg is null";
                    $this->c->add(CadefalmPeer::TIPREG, $this->sql, Criteria::CUSTOM);
                }
            }

            $this->c->addAscendingOrderByColumn(CadefalmPeer :: CODALM);
            $this->columnas = array(
                CadefalmPeer :: CODALM => 'Código',
                CadefalmPeer :: NOMALM => 'Descripción',
            );
        }
    }

    public function Cadelfalm_Almordrec($params = array()) {

        $c = new Criteria();
        $per = CausualmPeer::doselectOne($c);
        if ($per) {
            $dato = H::GetX('Loguse', 'Usuarios', 'Cedemp', sfContext::getInstance()->getUser()->getAttribute('loguse'));

            $this->c = new Criteria();
            $this->c->add(CausualmPeer::CEDEMP, $dato);
            $this->c->addJoin(CadefalmPeer::CODALM, CausualmPeer::CODALM);
            if (count($params) == 1)
                $this->c->add(CausualmPeer::CODALM, $params[0]);
            $this->c->addAscendingOrderByColumn(CadefalmPeer :: CODALM);
            $this->columnas = array(
                CadefalmPeer :: CODALM => 'Código',
                CadefalmPeer :: NOMALM => 'Descripción',
            );
        }else {
            $this->c = new Criteria();
            $almseparados = H::getConfAppGen('almseparados');
            if ($almseparados == 'S') {
                $modulo = sfContext::getInstance()->getUser()->getAttribute('menu', '', 'autenticacion');
                if ($modulo == 'facturacion') {
                    $this->c->add(CadefalmPeer::TIPREG, 'F');
                } else {
                    $this->sql = "tipreg<>'F' or tipreg is null";
                    $this->c->add(CadefalmPeer::TIPREG, $this->sql, Criteria::CUSTOM);
                }
            }

            if (count($params) == 1)
                $this->c->add(CadefalmPeer::CODALM, $params[0]);
            $this->c->addAscendingOrderByColumn(CadefalmPeer :: CODALM);
            $this->columnas = array(
                CadefalmPeer :: CODALM => 'Código',
                CadefalmPeer :: NOMALM => 'Descripción',
            );
        }
    }

    public function Cadefalm_Almentalm() {

        $c = new Criteria();
        $per = CausualmPeer::doselectOne($c);

        if ($per) {
            $dato = H::GetX('Loguse', 'Usuarios', 'Cedemp', sfContext::getInstance()->getUser()->getAttribute('loguse'));

            $this->c = new Criteria();
            $this->c->add(CausualmPeer::CEDEMP, $dato);
            $this->c->addJoin(CadefalmPeer::CODALM, CausualmPeer::CODALM);
            $this->c->addAscendingOrderByColumn(CadefalmPeer :: CODALM);
            $this->columnas = array(
                CadefalmPeer :: CODALM => 'Código',
                CadefalmPeer :: NOMALM => 'Descripción',
            );
        } else {
            $this->c = new Criteria();
            $this->c->addAscendingOrderByColumn(CadefalmPeer :: CODALM);
            $this->columnas = array(
                CadefalmPeer :: CODALM => 'Código',
                CadefalmPeer :: NOMALM => 'Descripción',
            );
        }
    }

    public function Fortipfin_licprebas() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(FortipfinPeer :: CODFIN);
        $this->columnas = array(
            FortipfinPeer :: CODFIN => 'Código',
            FortipfinPeer :: NOMEXT => 'Descripción',
        );
    }

    public function Cadefcen_licprebas() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(CadefcenPeer :: CODCEN);
        $this->columnas = array(
            CadefcenPeer :: CODCEN => 'Código',
            CadefcenPeer :: DESCEN => 'Descripción',
        );
    }

    public function liprebas_reqart() {
        $this->c = new Criteria();
        $this->c->add(LiprebasPeer::REQART, null);
        $this->c->addAscendingOrderByColumn(LiprebasPeer :: NUMPRE);
        $this->columnas = array(
            LiprebasPeer :: NUMPRE => 'Código',
            LiprebasPeer :: FECREG => 'Fecha',
            LiprebasPeer :: DESPRO => 'Descripción',
            LiprebasPeer :: MONPRE => 'Monto',
        );
    }

    public function Tscheemi_Tesdefcueban($params = array()) {
        $numcue = $params[0];
        $this->c = new Criteria();
        $this->c->add(TscheemiPeer :: NUMCUE, $numcue);

        $this->columnas = array(
            TscheemiPeer :: NUMCHE => 'N° de Cheque',
            TscheemiPeer :: FECEMI => 'Fecha de Emisión',
            TscheemiPeer :: CEDRIF => 'Beneficiario'
        );
    }

    public function Tscheemi_Tsdesmon() {

        $this->c = new Criteria();

        $this->columnas = array(
            TsdesmonPeer :: CODMON => 'Código',
            TsdesmonPeer :: NOMMON => 'Nombre Moneda',
        );
    }

    public function Liuniadm() {

        $this->c = new Criteria();

        $this->columnas = array(
            LiuniadmPeer :: CODUNIADM => 'Código',
            LiuniadmPeer :: DESUNIADM => 'Descripción',
        );
    }

    public function Lipriocon() {

        $this->c = new Criteria();

        $this->columnas = array(
            LiprioconPeer :: CODPRIO => 'Código',
            LiprioconPeer :: DESPRIO => 'Descripción',
        );
    }

    public function Liuniadm_codemp() {

        $this->c = new Criteria();

        $this->columnas = array(
            LiuniadmPeer :: CODEMP => 'Código',
            LiuniadmPeer :: NOMEMP => 'Descripción',
        );
    }

    public function Lidatstedet_codemp() {

        $this->c = new Criteria();
        $this->c->addDescendingOrderByColumn(LidatstedetPeer::CODEMP);
        $this->c->setDistinct();

        $this->columnas = array(
            LidatstedetPeer :: CODEMP => 'Código',
            LidatstedetPeer :: NOMEMP => 'Nombre',
        );
    }

    public function Tscammon_codmon($params = array()) {

        $this->c = new Criteria();

        if (count($params)) {
            $this->c->add(TscammonPeer::CODMON, $params[0]);
        }

        $this->columnas = array(
            TscammonPeer :: VALMON => 'Valor',
            "tscammon.FECCAM" => 'Fecha del Cambio',
        );
    }

    public function Liprebas_numpre($params = array()) {

        $this->c = new Criteria();
        if (!$params)
            $sql = "(Liprebas.tipconpub is null or Liprebas.tipconpub='B')";
        else
            $sql = "(Liprebas.tipconpub='O')";
        $this->c->add(LiprebasPeer::TIPCONPUB, $sql, Criteria::CUSTOM);

        $this->columnas = array(
            LiprebasPeer :: NUMPRE => 'Presupuesto Base',
            LiprebasPeer :: DESPRO => 'Descripción',
        );
    }

    public function Limemoran_numemo($params = Array()) {

        $this->c = new Criteria();
        if (!$params)
            $sql = "(Limemoran.tipconpub is null or Limemoran.tipconpub='B')";
        else
            $sql = "(Limemoran.tipconpub='O')";
        $this->c->add(LimemoranPeer::TIPCONPUB, $sql, Criteria::CUSTOM);

        $this->columnas = array(
            LimemoranPeer :: NUMEMO => 'Memorando',
            LimemoranPeer :: DESPRO => 'Descripción',
        );
    }

    public function Lidatste_coduniste() {
        $this->c = new Criteria();

        $this->columnas = array(
            LidatstePeer :: CODUNISTE => 'Código',
            LidatstePeer :: DESUNISTE => 'Descripción',
            'lidatste.nompai' => 'Pais',
            'lidatste.nomedo' => 'Estado',
            'lidatste.nommun' => 'Municipio',
            'lidatste.nompar' => 'Parroquia',
            'lidatste.nomsec' => 'Sector',
        );
    }

    public function Limeccon_codmec() {

        $this->c = new Criteria();

        $this->columnas = array(
            LimecconPeer :: CODMEC => 'Mecanismo de Consulta',
            LimecconPeer :: DESMEC => 'Descripción',
        );
    }

    public function Liasplegcrieva_codcri() {

        $this->c = new Criteria();

        $this->columnas = array(
            LiasplegcrievaPeer :: CODCRI => 'Codigo',
            LiasplegcrievaPeer :: DESCRI => 'Descripción',
        );
    }

    public function Liaspteccrieva_codcri() {

        $this->c = new Criteria();

        $this->columnas = array(
            LiaspteccrievaPeer :: CODCRI => 'Codigo',
            LiaspteccrievaPeer :: DESCRI => 'Descripción',
        );
    }

    public function Liaspfincrieva_codcri() {

        $this->c = new Criteria();

        $this->columnas = array(
            LiaspfincrievaPeer :: CODCRI => 'Codigo',
            LiaspfincrievaPeer :: DESCRI => 'Descripción',
        );
    }

    public function Liccomres_codcomres() {

        $this->c = new Criteria();

        $this->columnas = array(
            LiccomresPeer :: CODCOMRES => 'Codigo',
            LiccomresPeer :: DESCOMRES => 'Descripción',
            LiccomresPeer :: PORCENTAJE => 'Porcentaje',
        );
    }

    public function Litipemp_codemp() {

        $this->c = new Criteria();

        $this->columnas = array(
            LitipempPeer :: CODEMP => 'Codigo',
            LitipempPeer :: DESEMP => 'Descripción',
        );
    }

    public function Licomint_numconint() {

        $this->c = new Criteria();

        $this->columnas = array(
            LicomintPeer :: NUMCOMINT => 'Codigo',
            LicomintPeer :: CODCLACOMP => 'Solicitud de Contratacion',
            'licomint.desclacomp' => 'Descripcion'
        );
    }

    public function Liplieesp_numexp($params = array()) {

        $this->c = new Criteria();
        if (!$params)
            $sql = "(Liplieesp.tipconpub is null or Liplieesp.tipconpub='B')";
        else
            $sql = "(Liplieesp.tipconpub='O')";
        $this->c->add(LiplieespPeer::TIPCONPUB, $sql, Criteria::CUSTOM);

        $this->columnas = array(
            LiplieespPeer :: NUMEXP => 'Expediente',
            LiplieespPeer :: NUMPLIE => 'Pliego',
            LiplieespPeer :: DESCRIP => 'Descripción',
        );
    }

    public function Liempofe_codpro($params = array()) {
        $this->c = new Criteria();
        if (count($params) > 0) {
            $numero = str_replace("*", "/", $params[0]);
            $this->c->add(LiempparPeer::NUMEXP, $numero);
        }
        $this->c->addAscendingOrderByColumn(LiempparPeer :: CODPRO);

        $this->columnas = array(
            LiempparPeer :: CODPRO => 'Codigo',
            LiempparPeer :: RIFPRO => 'RIF',
            'liemppar.nompro' => 'Nombre',
            LiempparPeer :: NOMREPLEG => 'Representante Legal'
        );
    }

    public function Liregofe_numofe($params = array()) {

        $this->c = new Criteria();

        if (!$params)
            $this->sql = "Liregofe.numofe not in (select numofe from lianaofe where numofe is not null) and (Liregofe.tipconpub is null or Liregofe.tipconpub='B')";
        else
            $this->sql = "Liregofe.numofe not in (select numofe from lianaofe where numofe is not null) and (Liregofe.tipconpub='O')";
        $this->c->add(LiregofePeer :: NUMOFE, $this->sql, Criteria :: CUSTOM);

        $this->columnas = array(
            LiregofePeer :: NUMOFE => 'Número Oferta',
            LiregofePeer :: OFENRO => 'Oferta Contratista',
            LiregofePeer :: FECOFE => 'Fecha Oferta',
        );
    }

    public function Lirecomen_numrecofe($params = array()) {

        $this->c = new Criteria();

        if (!$params)
            $this->sql = "Lirecomen.numrecofe not in (select numrecofe from liptocuecon where numrecofe is not null) and (Lirecomen.tipconpub is null or Lirecomen.tipconpub='B')";
        else
            $this->sql = "Lirecomen.numrecofe not in (select numrecofe from liptocuecon where numrecofe is not null) and (Lirecomen.tipconpub='O')";
        $this->c->add(LirecomenPeer :: NUMRECOFE, $this->sql, Criteria :: CUSTOM);

        $this->columnas = array(
            LirecomenPeer :: NUMRECOFE => 'Número Recomendacion',
            LirecomenPeer :: NUMEXP => 'Expediente',
            LirecomenPeer :: FECREG => 'Fecha Registro',
        );
    }

    public function Liptocuecon_numptocuecon($params = array()) {

        $this->c = new Criteria();

        if (!$params)
            $this->sql = "Liptocuecon.numptocuecon not in (select numptocuecon from linotific where numptocuecon is not null) and (Liptocuecon.tipconpub is null or Liptocuecon.tipconpub='B')";
        else
            $this->sql = "Liptocuecon.numptocuecon not in (select numptocuecon from linotific where numptocuecon is not null) and (Liptocuecon.tipconpub='O')";
        $this->c->add(LiptocueconPeer :: NUMPTOCUECON, $this->sql, Criteria :: CUSTOM);

        $this->columnas = array(
            LiptocueconPeer :: NUMPTOCUECON => 'Número Punto de Cuenta',
            LiptocueconPeer :: NUMEXP => 'Expediente',
            LiptocueconPeer :: FECREG => 'Fecha Registro',
        );
    }

    public function Liptocue_numptocue($params = array()) {

        $this->c = new Criteria();
        if (!$params)
            $this->sql = "Liptocue.numptocue not in (select numptocue from lisolegr  where numptocue is not null) and (Liptocue.tipconpub is null or Liptocue.tipconpub='B')";
        else
            $this->sql = "Liptocue.numptocue not in (select numptocue from lisolegr  where numptocue is not null) and (Liptocue.tipconpub='O')";
        $this->c->add(LiptocuePeer :: NUMPTOCUE, $this->sql, Criteria :: CUSTOM);

        $this->columnas = array(
            LiptocuePeer :: NUMPTOCUE => 'Número Punto de Cuenta',
            LiptocuePeer :: NUMEMO => 'Memorando',
            LiptocuePeer :: FECREG => 'Fecha Registro',
        );
    }

    public function Ocbanpro_Oycdesobr() {

        $this->c = new Criteria();

        $this->columnas = array(
            OcbanproPeer :: CODBANPRO => 'Código',
            OcbanproPeer :: DESBANPRO => 'Descripción',
        );
    }

    public function Liempofe_codpro2($params = array()) {
        $this->c = new Criteria();
        if (count($params) > 0) {
            $numero = str_replace("*", "/", $params[0]);
            $this->c->add(LiempofePeer::NUMEXP, $numero);
        }
        $this->c->addAscendingOrderByColumn(LiempofePeer :: CODPRO);

        $this->columnas = array(
            LiempofePeer :: CODPRO => 'Codigo',
            'liempofe.nompro' => 'RIF',
            'liempofe.nompro' => 'Nombre',
            'liempofe.nompro' => 'Representante Legal'
        );
    }

    public function Liplieesp_numexp2($params = array()) {

        $this->c = new Criteria();
        if (!$params)
            $this->sql = "Liplieesp.numexp not in (select numexp from Lirecomen  where numexp is not null) and (Liplieesp.tipconpub is null or Liplieesp.tipconpub='B')";
        else
            $this->sql = "Liplieesp.numexp not in (select numexp from Lirecomen  where numexp is not null) and (Liplieesp.tipconpub='O')";
        $this->c->add(LiplieespPeer :: NUMEXP, $this->sql, Criteria :: CUSTOM);


        $this->columnas = array(
            LiplieespPeer :: NUMEXP => 'Expediente',
            LiplieespPeer :: NUMPLIE => 'Pliego',
            LiplieespPeer :: DESCRIP => 'Descripción',
        );
    }

    public function Liptocuecon_numptocuecon_contrat($params = array()) {

        $this->c = new Criteria();
        if (!$params)
            $this->sql = "Liptocuecon.numptocuecon not in (select numptocuecon from licontrat where numptocuecon is not null) and (Liptocuecon.tipconpub is null or Liptocuecon.tipconpub='B')";
        else
            $this->sql = "Liptocuecon.numptocuecon not in (select numptocuecon from licontrat where numptocuecon is not null) and (Liptocuecon.tipconpub='O')";
        $this->c->add(LiptocueconPeer :: NUMPTOCUECON, $this->sql, Criteria :: CUSTOM);

        $this->columnas = array(
            LiptocueconPeer :: NUMPTOCUECON => 'Número Punto de Cuenta',
            LiptocueconPeer :: NUMEXP => 'Expediente',
            LiptocueconPeer :: FECREG => 'Fecha Registro',
        );
    }

    public function Liptocuecon_numptocuecon_ordcom() {

        $this->c = new Criteria();

        $this->sql = "Liptocuecon.numptocuecon not in (select numptocuecon from liordcom where numptocuecon is not null) and (Liptocuecon.tipconpub is null or Liptocuecon.tipconpub='B')";
        $this->c->add(LiptocueconPeer :: NUMPTOCUECON, $this->sql, Criteria :: CUSTOM);

        $this->columnas = array(
            LiptocueconPeer :: NUMPTOCUECON => 'Número Punto de Cuenta',
            LiptocueconPeer :: NUMEXP => 'Expediente',
            LiptocueconPeer :: FECREG => 'Fecha Registro',
        );
    }

    public function Camedcom_codmedcom() {

        $this->c = new Criteria();

        $this->columnas = array(
            CamedcomPeer :: CODMEDCOM => 'Código',
            CamedcomPeer :: DESMEDCOM => 'Descripción',
        );
    }

    public function Caprocom_codprocom() {

        $this->c = new Criteria();

        $this->columnas = array(
            CaprocomPeer :: CODPROCOM => 'Código',
            CaprocomPeer :: DESPROCOM => 'Descripción',
        );
    }

    public function Ocdefpar_codpar() {

        $this->c = new Criteria();

        $this->columnas = array(
            OcdefparPeer :: CODPAR => 'Código',
            OcdefparPeer :: DESPAR => 'Descripción',
            'ocdefpar.desuni' => 'Unidad'
        );
    }

    public function Lisolegr_numsol($params = array()) {

        $this->c = new Criteria();
        if (!$params)
            $this->sql = "Lisolegr.numsol not in (select numcomint from liplieesp  where numcomint is not null) and (Lisolegr.tipconpub='B')";
        else
            $this->sql = "Lisolegr.numsol not in (select numcomint from liplieesp  where numcomint is not null) and (Lisolegr.tipconpub='O')";


        $this->columnas = array(
            'lisolegr.numcomint' => 'Número Solicitud',
            LisolegrPeer :: NUMPTOCUE => 'Número Punto de Cuenta',
            LisolegrPeer :: FECREG => 'Fecha Registro',
        );
    }

    public function Liactas_licontrat_numcont($params = array()) {

        $this->c = new Criteria();

        $this->columnas = array(
            LicontratPeer :: NUMCONT => 'Número de Contrato',
            LicontratPeer :: NUMPTOCUECON => 'Número Punto de Cuenta',
            LicontratPeer :: NUMEXP => 'Expediente',
            LicontratPeer :: FECREG => 'Fecha Registro',
        );
    }

    public function Liinspecciones_livaluaciones_numval($params = array()) {

        $this->c = new Criteria();

        $this->columnas = array(
            LivaluacionesPeer :: NUMVAL => 'Número de Valuación',
            LivaluacionesPeer :: NUMCONT => 'Número de Contrato',
            LivaluacionesPeer :: FECDES => 'Fecha Desde',
            LivaluacionesPeer :: FECHAS => 'Fecha Hasta',
        );
    }

    public function Fcpais_Facdefdivest() {


        $this->c = new Criteria();

        $this->columnas = array(
            FcpaisPeer :: CODPAI => 'Código',
            FcpaisPeer :: NOMPAI => 'Descripción',
        );
    }

    public function Fcestado_Facdefdivmun($params = array()) {
        $this->c = new Criteria();
        if (count($params) > 0) {
            $this->c->add(FcestadoPeer::CODPAI, $params[0]);
        }

        $this->columnas = array(
            FcestadoPeer :: CODEDO => 'Codigo',
            FcestadoPeer :: NOMEDO => 'Nombre',
        );
    }

    public function Fcmunici_Facdefdivpar($params = array()) {
        $this->c = new Criteria();
        if (count($params) > 0) {
            $this->c->add(FcmuniciPeer::CODPAI, $params[0]);
            $this->c->add(FcmuniciPeer::CODEDO, $params[1]);
        }

        $this->columnas = array(
            FcmuniciPeer :: CODMUN => 'Codigo',
            FcmuniciPeer :: NOMMUN => 'Nombre',
        );
    }

    public function Liactas_numact($params = array()) {

        $this->c = new Criteria();

        if (count($params) > 0)
            $this->c->add(LiactasPeer::NUMCONT, $params[0]);

        $this->columnas = array(
            LiactasPeer :: NUMACT => 'Número de Acta',
            LiactasPeer :: NUMCONT => 'Número De Contrato',
            'Liactas.NOMTIPACT' => 'Tipo de Acta',
        );
    }

    public function Litipact_codtipact($params = array()) {

        $this->c = new Criteria();

        $this->columnas = array(
            LitipactPeer :: CODTIPACT => 'Tipo Acta',
            LitipactPeer :: NOMTIPACT => 'Descripción',
        );
    }

    public function Lisolpag_livaluaciones_numval($params = array()) {

        $this->c = new Criteria();

        $this->columnas = array(
            LivaluacionesPeer::NUMVAL => 'Valuación',
            LivaluacionesPeer::NUMCONT => 'Contrato',
            LivaluacionesPeer::FECDES => 'Desde',
            LivaluacionesPeer::FECHAS => 'Hasta',
        );
    }

    public function Liplieart_numplie_codart($params = array()) {
        $this->c = new Criteria();

        if (count($params) > 0)
            $this->c->add(LiplieartPeer::NUMEXP, $params[0]);

        $this->columnas = array(
            LiplieartPeer :: CODART => 'Código Partida',
            'Liplieart.DESART' => 'Descripción',
            LiplieartPeer :: CANTID => 'Cantidad Total',
            LiplieartPeer :: NUMEXP => 'Nro. Expediente',
        );
    }

    public function Fcdefpla_Facdeftasas($params = array()) {

        $this->c = new Criteria();

        $this->columnas = array(
            FcdeftasasPeer :: CODTAS => 'Código',
            FcdeftasasPeer :: DESTAS => 'Descripción',
        );
    }

    public function Fcdefpla_Facdefpla($params = array()) {

        $this->c = new Criteria();

        $this->columnas = array(
            FcdefplaPeer :: CODPLA => 'Código',
            FcdefplaPeer :: DESPLA => 'Descripción',
        );
    }

    public function Facvehreg_Fcusoveh($param = array()) {
        $this->c = new Criteria();

        if (count($param) > 0) {
            $this->sql = "length(coduso) = '$param[0]'";
            $this->c->add(FcusovehPeer :: CODUSO, $this->sql, Criteria :: CUSTOM);
        }

        $this->c->addDescendingOrderByColumn(FcusovehPeer :: ANOVIG);
        $this->c->addAscendingOrderByColumn(FcusovehPeer :: CODUSO);

        $this->columnas = array(
            FcusovehPeer :: CODUSO => 'Solicitud',
            FcusovehPeer :: DESUSO => 'Nombre/Negocio',
            FcusovehPeer::ANOVIG => 'Año Vigencia',
        );
    }

    public function Facrecpag_Rifcon($param = array()) {
        $this->c = new Criteria;
        $this->c->addSelectColumn(FcdeclarPeer::NUMDEC);
        $this->c->addSelectColumn("'1937-01-01' AS FECVEN");
        $this->c->addSelectColumn('0 AS FUEING');
        $this->c->addSelectColumn("'1937-01-01' AS FECDEC");
        $this->c->addSelectColumn(FcdeclarPeer:: RIFCON);
        $this->c->addSelectColumn('0 AS TIPO');
        $this->c->addSelectColumn('0 AS NUMREF');
        $this->c->addSelectColumn('0 AS NOMBRE');
        $this->c->addSelectColumn('0 AS MONDEC');
        $this->c->addSelectColumn('0 AS EDODEC');
        $this->c->addSelectColumn('0 AS MORA');
        $this->c->addSelectColumn('0 AS PRONTOPG');
        $this->c->addSelectColumn('0 AS AUTLIQ');
        $this->c->addSelectColumn('0 AS FENDEC');
        $this->c->addSelectColumn('0 AS CODREC');
        $this->c->addSelectColumn('0 AS MODO');
        $this->c->addSelectColumn('0 AS NUMERO');
        $this->c->addSelectColumn('0 AS CONPAG ');
        $this->c->addSelectColumn('0 AS MONABO');
        $this->c->addSelectColumn('0 AS NUMABO');
        $this->c->addSelectColumn(FcdeclarPeer:: NOMCON);
        $this->c->addSelectColumn('0 AS OTRO');
        $this->c->addSelectColumn('0 AS MIGINC');
        $this->c->addSelectColumn('0 AS ANODEC');
        $this->c->addSelectColumn("'1937-01-01' AS FECULTPAG");
        $this->c->addSelectColumn("'1937-01-01' AS FECINI");
        $this->c->addSelectColumn("'1937-01-01' AS FECCIE");
        $this->c->addSelectColumn('0 AS EXIPAGUNI');
        $this->c->addSelectColumn('0 AS ID');

        if (count($param) > 1) {
            if ($param[1] != 'O') {

                $this->c->add(FcdeclarPeer::NUMREF, $param[0]);
            } else {

                $this->c->add(FcdeclarPeer::NUMDEC, $param[0]);
            }
        }
        $this->c->add(FcdeclarPeer::EDODEC, array('X', 'P'), Criteria::NOT_IN);
        $this->c->addGroupByColumn(FcdeclarPeer::RIFCON);
        $this->c->addGroupByColumn(FcdeclarPeer::NOMCON);
        $this->c->addGroupByColumn(FcdeclarPeer::NUMDEC);

        $this->columnas = array(
            FcdeclarPeer::RIFCON => 'C.I. /R.I.F.',
            FcdeclarPeer::NOMCON => 'Nombre',
            FcdeclarPeer::NUMDEC => 'Declaración'
        );
    }

    public function Facprocom_Fctippro($param = array()) {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(FctipproPeer :: TIPPRO);
        $this->c->addAscendingOrderByColumn(FctipproPeer :: ANOVIG);

        $this->columnas = array(
            FctipproPeer :: TIPPRO => 'Tipo',
            FctipproPeer :: ANOVIG => 'Ano',
            FctipproPeer :: DESTIP => 'Descripcion',
        );
    }

    public function Facrecpag_Fcdefdesc($param = array()) {
        $this->c = new Criteria();
        //$this->c->addJoin(FcsollicPeer :: RIFCON, FcdeclarPeer :: RIFCON);
        $this->c->addAscendingOrderByColumn(FcdefdescPeer :: CODDES);
        $this->c->setDistinct();

        $this->columnas = array(
            FcdefdescPeer :: CODDES => 'Codigo',
            FcdefdescPeer :: NOMDES => 'Nombre'
        );
    }

    public function Facprocom_Fctipesp($param = array()) {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(FctipespPeer :: TIPESP);
        $this->c->addAscendingOrderByColumn(FctipespPeer :: ANOVIG);

        $this->columnas = array(
            FctipespPeer :: TIPESP => 'Tipo',
            FctipespPeer :: ANOVIG => 'Ano',
            FctipespPeer :: DESTIP => 'Descripcion',
        );
    }

    public function Facpicliq_Fcsollic($param = array()) {
        $this->c = new Criteria();
        $this->c->add(FcsollicPeer :: STALIC, 'V');
        $this->c->addAscendingOrderByColumn(FcsollicPeer :: NUMSOL);

        $this->columnas = array(
            FcsollicPeer :: NUMLIC => 'N° Licencia',
            FcsollicPeer :: NUMSOL => 'Solicitud',
            FcsollicPeer :: NOMNEG => 'Nombre/Negocio'
        );
    }

    public function Facprodec_numref() {

        $this->c = new Criteria();
        $this->c->addJoin(FcprolicPeer::RIFCON, FcconrepPeer::RIFCON);
        $this->c->addAscendingOrderByColumn(FcprolicPeer::NROCON);
        $this->columnas = array(
            FcprolicPeer :: NOMCON => 'Nombre',
            FcprolicPeer :: NROCON => 'Nro. Propaganda',
            FcprolicPeer :: DESPRO => 'Descripción'
        );
    }

    public function Facespdec_Numref($param = array()) {
        $this->c = new Criteria();
        $this->c->addJoin(FcesplicPeer::RIFCON, FcconrepPeer::RIFCON);
        $this->c->addAscendingOrderByColumn(FcesplicPeer::NROCON);

        $this->columnas = array(
            FcesplicPeer :: NOMCON => 'Nombre',
            FcesplicPeer :: NROCON => 'Nro.Espectáculo',
            FcesplicPeer :: DESESP => 'Descripción'
        );
    }

    public function Npgrupos_Nomasogruemp($params = array()) {

        $this->c = new Criteria();

        $this->columnas = array(
            NpgruposPeer :: CODGRU => 'Código',
            NpgruposPeer :: DESGRU => 'Descripción',
        );
    }

    public function Npturnos_Nomasoturemp($params = array()) {

        $this->c = new Criteria();

        $this->columnas = array(
            NpturnosPeer :: CODTUR => 'Código',
            NpturnosPeer :: DESTUR => 'Descripción',
        );
    }

    public function Facrepfisliq_Numlic($param = array()) {
        $this->c = new Criteria();
        //$this->c->addJoin(FcsollicPeer:: NUMLIC ,FcactpicPeer :: NUMDOC);
        //$this->c->add(FcactpicPeer :: MODO, 'D');
        $this->c->add(FcsollicPeer :: STASOL, 'D', Criteria::NOT_EQUAL);
        $this->c->addDescendingOrderByColumn(FcsollicPeer :: FECSOL);
        $this->c->addAscendingOrderByColumn(FcsollicPeer :: NUMLIC);


        $this->columnas = array(
            FcsollicPeer :: NUMLIC => 'Licencia',
            FcsollicPeer :: NOMNEG => 'Nombre/Empresa',
            FcsollicPeer :: NUMSOL => 'Solicitud',
            FcsollicPeer :: FECSOL => 'Fecha'
        );
    }

    public function Facdecinmlot_zona() {

        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(FcvalinmPeer::CODZON);
        $this->c->setDistinct();
        $this->columnas = array(
            FcvalinmPeer :: CODZON => 'Código',
            FcvalinmPeer :: DESZON => 'Descripción',
            FcvalinmPeer :: ANOVIG => 'Año Vigencia'
        );
    }

    public function Facdecvehlot_uso() {

        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(FcusovehPeer::CODUSO);
        $this->columnas = array(
            FcusovehPeer :: CODUSO => 'Código',
            FcusovehPeer :: DESUSO => 'Descripción',
            FcusovehPeer :: ANOVIG => 'Año Vigencia'
        );
    }

    public function Catdefdivbarurb_Catdivgeobar($params = array()) {
        $this->c = new Criteria();

        if (count($params) > 0) {
            $longitud = (int) $params[0] - 1;
            $this->sql = "length(coddivgeo) = '$longitud'";
            $this->c->add(CatdivgeoPeer :: CODDIVGEO, $this->sql, Criteria :: CUSTOM);
        }

        $this->columnas = array(
            CatdivgeoPeer :: CODDIVGEO => 'Codigo',
            CatdivgeoPeer :: DESDIVGEO => 'Descripcion'
        );
    }

    public function Facpicsollic_Fcactcomplementaria($params) {
        $this->c = new Criteria();
        $this->c->add(FcactcomPeer :: ANOACT, $params[0]);
        $this->c->addDescendingOrderByColumn(FcactcomPeer :: ANOACT);
        $this->c->addAscendingOrderByColumn(FcactcomPeer :: CODACT);

        $this->columnas = array(
            FcactcomPeer :: CODACT => 'Código Actividad',
            FcactcomPeer :: DESACT => 'Descripción',
            FcactcomPeer :: EXONER => 'Exonerado',
            FcactcomPeer :: ANOACT => 'Año',
        );
    }

    public function Facprocom_Fctipapu($param = array()) {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(FctipapuPeer :: TIPAPU);
        $this->c->addAscendingOrderByColumn(FctipapuPeer :: ANOVIG);

        $this->columnas = array(
            FctipapuPeer :: TIPAPU => 'Tipo',
            FctipapuPeer :: ANOVIG => 'Ano',
            FctipapuPeer :: DESTIP => 'Descripcion',
        );
    }

    public function Facapudec_Numref($param = array()) {
        $this->c = new Criteria();
        $this->c->addJoin(FcapulicPeer::RIFCON, FcconrepPeer::RIFCON);
        $this->c->addAscendingOrderByColumn(FcapulicPeer::NROCON);

        $this->columnas = array(
            FcapulicPeer :: NOMCON => 'Nombre',
            FcapulicPeer :: NROCON => 'Nro.Espectáculo',
            FcapulicPeer :: DESAPU => 'Descripción'
        );
    }

    public function Npjortur_Nomasocptjor($params = array()) {

        $this->c = new Criteria();

        $this->columnas = array(
            NpjorturPeer :: CODJOR => 'Código',
            NpjorturPeer :: DESJOR => 'Descripción',
        );
    }

    public function Npturnos_Nomasigrutur($params = array()) {

        $this->c = new Criteria();

        $this->columnas = array(
            NpturnosPeer :: CODTUR => 'Código',
            NpturnosPeer :: DESTUR => 'Descripción',
        );
    }

    public function Cadefalm_Almtraspaso() {
        $this->c = new Criteria();

        $this->columnas = array(
            CadefalmPeer :: CODALM => 'Código',
            CadefalmPeer :: NOMALM => 'Nombre',
        );
    }

    public function Npgrupos_Nomeditcalnomrot($params = array()) {

        $this->c = new Criteria();

        $this->columnas = array(
            NpgruposPeer :: CODGRU => 'Código',
            NpgruposPeer :: DESGRU => 'Descripción',
        );
    }

    public function Faconsignatario_Fafactur($params = array()) {

        $this->c = new Criteria();

        $this->columnas = array(
            FaconsignatarioPeer :: CODCON => 'Código',
            FaconsignatarioPeer :: NOMCON => 'Descripción',
        );
    }

    public function Tscomban_tesdefcueban($params = array()) {
        $this->c = new Criteria();

        $this->columnas = array(
            TscombanPeer :: CODCOM => 'Código',
            TscombanPeer :: DESCOM => 'Descripción',
        );
    }

    public function Buque_Fafactur($params = array()) {
        $this->c = new Criteria();

        $this->columnas = array(
            FatipbuqPeer :: CODBUQ => 'Código',
            FatipbuqPeer :: NOMBUQ => 'Nombre',
        );
    }

    public function Puerto_Fafactur($params = array()) {
        $this->c = new Criteria();

        $this->columnas = array(
            FatippuePeer :: CODPUE => 'Código',
            FatippuePeer :: NOMPUE => 'Nombre',
        );
    }

    public function Facinmdec_Fcreginm($params = array()) {
        $this->c = new Criteria();

        $this->columnas = array(
            FcreginmPeer :: NROINM => 'Nro. Inmueble',
            FcreginmPeer :: RIFCON => 'Contribuyente',
            FcreginmPeer :: NOMCON => 'Nombre'
        );
    }

    public function Cadefalm_Almtraalmdes() {

        $this->c = new Criteria();
        $almseparados = H::getConfAppGen('almseparados');
        if ($almseparados == 'S') {
            $modulo = sfContext::getInstance()->getUser()->getAttribute('menu', '', 'autenticacion');
            if ($modulo == 'facturacion') {
                $this->c->add(CadefalmPeer::TIPREG, 'F');
            } else {
                $this->sql = "tipreg<>'F' or tipreg is null";
                $this->c->add(CadefalmPeer::TIPREG, $this->sql, Criteria::CUSTOM);
            }
        }

        $this->c->addAscendingOrderByColumn(CadefalmPeer :: CODALM);
        $this->columnas = array(
            CadefalmPeer :: CODALM => 'Código',
            CadefalmPeer :: NOMALM => 'Descripción',
        );
    }

    public function Precausar_Cpcausad($params = array()) {
        $loguse= sfContext::getInstance()->getUser()->getAttribute('loguse');
        $filsoldir3=H::getConfApp2('filsoldir', 'presupuesto', 'preprecom');

        if ($params[0] != '') {
            $tipo = str_replace("*", "/", $params[0]);
            $fecpag = explode('*', $params[1]);
            $fecha = $fecpag[2] . '-' . $fecpag[1] . '-' . $fecpag[0];

            $this->c = new Criteria();
            $this->c->add(CpdoccauPeer :: TIPCAU, $tipo);
            $cpdoccau = CpdoccauPeer :: doSelectOne($this->c);

            if ($cpdoccau->getRefier() == 'C') {
                $clase = 'Cpcompro';
            } else
            if ($cpdoccau->getRefier() == 'P') {
                $clase = 'Cpprecom';
            } else
            if ($cpdoccau->getRefier() == 'N') {
                $clase = 'Cpdoccau';
            }
            $this->clase = ucfirst(strtolower($clase));
            $eval = '$clas = new ' . $this->clase . ';';
            eval($eval);
            $this->clasePeer = $clas->getPeer();
            $this->mapa_tabla = $this->clasePeer->getTableMap();

            if ($clase == 'Cpcompro') {
                $this->c = new Criteria();
                $this->c->clearSelectColumns();
                $this->c->addSelectColumn(CpcomproPeer :: REFCOM);
                $this->c->addSelectColumn("'' as TIPCOM");
                $this->c->addSelectColumn(CpcomproPeer :: FECCOM);
                $this->c->addSelectColumn("'' as ANOCOM");
                $this->c->addSelectColumn("'' as REFPRC");
                $this->c->addSelectColumn("'' as TIPPRC");
                $this->c->addSelectColumn(CpcomproPeer :: DESCOM);
                $this->c->addSelectColumn("'' as DESANU");
                $this->c->addSelectColumn("'' as MONCOM");
                $this->c->addSelectColumn("'' as SALCAU");
                $this->c->addSelectColumn("'' as SALPAG");
                $this->c->addSelectColumn("'' as SALAJU");
                $this->c->addSelectColumn("'' as STACOM");
                $this->c->addSelectColumn("'1937-01-01' as FECANU");
                $this->c->addSelectColumn(CpcomproPeer :: CEDRIF);
                $this->c->addSelectColumn("'' as TIPO");
                $this->c->addSelectColumn("'' as APRCOM");
                $this->c->addSelectColumn("'' as CODUBI");
                $this->c->addSelectColumn("'' as MOTREC");
                $this->c->addSelectColumn("'' as LOGUSE");
                $this->c->addSelectColumn("'0' as SERCON");
                $this->c->addSelectColumn("'1937-01-01' as FECSER");
                $this->c->addSelectColumn("'0' as TESORE");
                $this->c->addSelectColumn("'1937-01-01' as FECTES");
                $this->c->addSelectColumn("'0' as ADMINI");
                $this->c->addSelectColumn("'1937-01-01' as FECADM");
                $this->c->addSelectColumn("'1937-01-01' as FECREG");
                $this->c->addSelectColumn("'' as CODDIREC");
                $this->c->addSelectColumn("'' as USUAPR");
                $this->c->addSelectColumn("'1937-01-01' as FECAPR");
                $this->c->addSelectColumn("'' as ID");

                $this->c->add(CpcomproPeer :: STACOM, 'A');
                $this->c->add(CpcomproPeer :: FECCOM, $fecha, Criteria::LESS_EQUAL);
                $this->c->add(CpcomproPeer :: APRCOM, 'N', Criteria::NOT_EQUAL);
                //$this->c->add(CpcomproPeer :: SALCAU, CpcomproPeer :: SALCAU . "<" . CpcomproPeer :: MONCOM . "-" . CpcomproPeer :: SALAJU, Criteria :: CUSTOM);
                if ($filsoldir3=='S'){
                  $sql='cpcompro.coddirec in (select coddirec from "SIMA_USER".segdirusu where loguse=\''.$loguse.'\')';
                  $this->c->add(CpcomproPeer::CODDIREC,$sql,Criteria::CUSTOM);
                }

                $this->c->addJoin(CpcomproPeer :: REFCOM,CpimpcomPeer :: REFCOM);

                $sub = $this->c->getNewCriterion(CpcomproPeer :: REFCOM, 'SUM(COALESCE(' . CpimpcomPeer :: MONIMP . ',0)-COALESCE(' . CpimpcomPeer :: MONAJU . ',0)) > SUM(COALESCE(' . CpimpcomPeer :: MONCAU . ',0))', Criteria :: CUSTOM);
                $this->c->addHaving($sub);
                $this->c->addGroupByColumn(CpcomproPeer :: REFCOM);
                $this->c->addGroupByColumn(CpcomproPeer :: FECCOM);
                $this->c->addGroupByColumn(CpcomproPeer :: CEDRIF);
                $this->c->addGroupByColumn(CpcomproPeer :: DESCOM);
                $this->c->addAscendingOrderByColumn(CpcomproPeer :: REFCOM);

                $this->columnas = array(
                    CpcomproPeer :: DESCOM => 'Descripción',
                    CpcomproPeer :: CEDRIF => 'Cedula',
                    CpcomproPeer :: REFCOM => 'Referencia',
                    CpcomproPeer :: FECCOM => 'Fecha'
                );
            } else
            if ($clase == 'Cpprecom') {
                $this->c = new Criteria();
                $this->c->add(CpprecomPeer :: STAPRC, 'A');
                $this->c->add(CpprecomPeer :: FECPRC, $fecha, Criteria::LESS_EQUAL);
                $this->c->add(CpprecomPeer :: SALCAU, CpprecomPeer :: SALCAU . "<" . CpprecomPeer :: MONPRC . "-" . CpprecomPeer :: SALAJU, Criteria :: CUSTOM);
                $this->c->addAscendingOrderByColumn(CpprecomPeer :: REFPRC);
                $this->columnas = array(
                    CpprecomPeer :: DESPRC => 'Descripción',
                    CpprecomPeer :: CEDRIF => 'Cedula',
                    CpprecomPeer :: REFPRC => 'Referencia',
                    CpprecomPeer :: FECPRC => 'Fecha'
                );
            } else
            if ($clase == 'Cpdoccau') {
                $this->c = new Criteria();
                $this->c->add(CpdoccauPeer :: TIPCAU, 'ARPP');
                $this->c->addAscendingOrderByColumn(CpdoccauPeer :: NOMEXT);
                $this->columnas = array(
                    CpdoccauPeer :: NOMABR => 'Descripción',
                    CpdoccauPeer :: NOMEXT => 'Cedula',
                    CpdoccauPeer :: TIPCAU => 'Referencia',
                );
            }
        } else {
            $this->c = new Criteria();
            $this->c->add(CpdoccauPeer :: TIPCAU, 'ARPP');
            $this->c->addAscendingOrderByColumn(CpdoccauPeer :: NOMEXT);
            $this->columnas = array(
                CpdoccauPeer :: NOMABR => 'Descripción',
                CpdoccauPeer :: NOMEXT => 'Cedula',
                CpdoccauPeer :: TIPCAU => 'Referencia',
            );
        }
    }

    public function Cpcausad_Prepagar($params = array()) {
        $loguse= sfContext::getInstance()->getUser()->getAttribute('loguse');
        $filsoldir3=H::getConfApp2('filsoldir', 'presupuesto', 'preprecom');

        if ($params[0] != '') {
            $tippag = str_replace("*", "/", $params[0]);
            $fecpag = explode('*', $params[1]);
            $fecha = $fecpag[2] . '-' . $fecpag[1] . '-' . $fecpag[0];

            $this->c = new Criteria();
            $this->c->add(CpdocpagPeer :: TIPPAG, $tippag);
            $cpdocpag = CpdocpagPeer :: doSelectOne($this->c);
            if ($cpdocpag->getRefier() == 'A') {
                $clase = 'Cpcausad';
            } else
            if ($cpdocpag->getRefier() == 'C') {
                $clase = 'Cpcompro';
            } else
            if ($cpdocpag->getRefier() == 'P') {
                $clase = 'Cpprecom';
            } else
            if ($cpdocpag->getRefier() == 'N') {
                $clase = 'Contaba';
            }
            $this->clase = ucfirst(strtolower($clase));
            $eval = '$laclase = new ' . $this->clase . ';';
            eval($eval);
            $this->clasePeer = $laclase->getPeer();
            $this->mapa_tabla = $this->clasePeer->getTableMap();

            if ($clase == 'Cpcausad') {
                $this->c = new Criteria();
                $this->c->clearSelectColumns();
                $this->c->addSelectColumn(CpcausadPeer :: REFCAU);
                $this->c->addSelectColumn("'' as TIPCAU");
                $this->c->addSelectColumn(CpcausadPeer :: FECCAU);
                $this->c->addSelectColumn("'' as ANOCAU");
                $this->c->addSelectColumn("'' as REFCOM");
                $this->c->addSelectColumn("'' as TIPCOM");
                $this->c->addSelectColumn(CpcausadPeer :: DESCAU);
                $this->c->addSelectColumn("'' as DESANU");
                $this->c->addSelectColumn("'' as MONCAU");
                $this->c->addSelectColumn("'' as SALPAG");
                $this->c->addSelectColumn("'' as SALAJU");
                $this->c->addSelectColumn("'' as STACAU");
                $this->c->addSelectColumn("'1937-01-01' as FECANU");
                $this->c->addSelectColumn(CpcausadPeer :: CEDRIF);
                $this->c->addSelectColumn("'1937-01-01' as FECREG");
                $this->c->addSelectColumn("'' as NUMCOM");
                $this->c->addSelectColumn("'' as CODDIREC");
                $this->c->addSelectColumn("'' as ID");


                $this->c->add(CpcausadPeer :: STACAU, 'A');
                $this->c->add(CpcausadPeer :: FECCAU, $fecha, Criteria::LESS_EQUAL);
                //$this->c->add(CpcausadPeer :: SALPAG, CpcausadPeer :: SALPAG . "<" . CpcausadPeer :: MONCAU . "-" . CpcausadPeer :: SALAJU, Criteria :: CUSTOM);
                if ($filsoldir3=='S'){
                  $sql='cpcausad.coddirec in (select coddirec from "SIMA_USER".segdirusu where loguse=\''.$loguse.'\')';
                  $this->c->add(CpcausadPeer::CODDIREC,$sql,Criteria::CUSTOM);
                }

                $this->c->addJoin(CpcausadPeer :: REFCAU, CpimpcauPeer :: REFCAU);

                $sub = $this->c->getNewCriterion(CpcausadPeer :: REFCAU, 'SUM(COALESCE(' . CpimpcauPeer :: MONIMP . ',0)-COALESCE(' . CpimpcauPeer :: MONAJU . ',0)) > SUM(COALESCE(' . CpimpcauPeer :: MONPAG . ',0))', Criteria :: CUSTOM);
                $this->c->addHaving($sub);
                $this->c->addGroupByColumn(CpcausadPeer :: REFCAU);
                $this->c->addGroupByColumn(CpcausadPeer :: DESCAU);
                $this->c->addGroupByColumn(CpcausadPeer :: CEDRIF);
                $this->c->addGroupByColumn(CpcausadPeer :: FECCAU);
                $this->c->addAscendingOrderByColumn(CpcausadPeer :: REFCAU);
                $this->c->addAscendingOrderByColumn(CpcausadPeer :: FECCAU);

                $this->columnas = array(
                    CpcausadPeer :: REFCAU => 'Referencia',
                    CpcausadPeer :: DESCAU => 'Descripción',
                    CpcausadPeer :: CEDRIF => 'Cedula',
                    CpcausadPeer :: FECCAU => 'Fecha'
                );
            } else
            if ($clase == 'Cpcompro') {
                $this->c = new Criteria();
                $this->c->add(CpcomproPeer :: STACOM, 'A');
                $this->c->add(CpcomproPeer :: FECCOM, $fecha, Criteria::LESS_EQUAL);
                $this->c->add(CpcomproPeer :: SALPAG, CpcomproPeer :: SALPAG . "<" . CpcomproPeer :: MONCOM . "-" . CpcomproPeer :: SALAJU, Criteria :: CUSTOM);
                $this->c->addAscendingOrderByColumn(CpcomproPeer :: REFCOM);
                $this->columnas = array(
                    CpcomproPeer :: REFCOM => 'Referencia',
                    CpcomproPeer :: DESCOM => 'Descripción',
                    CpcomproPeer :: CEDRIF => 'Cedula',
                    CpcomproPeer :: FECCOM => 'Fecha'
                );
            } else
            if ($clase == 'Cpprecom') {
                $this->c = new Criteria();
                $this->c->add(CpprecomPeer :: STAPRC, 'A');
                $this->c->add(CpprecomPeer :: FECPRC, $fecha, Criteria::LESS_EQUAL);
                $this->c->add(CpprecomPeer :: SALPAG, CpprecomPeer :: SALPAG . "<" . CpprecomPeer :: MONPRC . "-" . CpprecomPeer :: SALAJU, Criteria :: CUSTOM);
                $this->c->addAscendingOrderByColumn(CpprecomPeer :: REFPRC);
                $this->columnas = array(
                    CpprecomPeer :: REFPRC => 'Referencia',
                    CpprecomPeer :: DESPRC => 'Descripción',
                    CpprecomPeer :: CEDRIF => 'Cedula',
                    CpprecomPeer :: FECPRC => 'Fecha'
                );
            } else
            if ($clase == 'Contaba') {
                $this->c = new Criteria();
                $this->c->add(ContabaPeer :: CODEMP, 'XXX');
                $this->columnas = array(
                    ContabaPeer :: CODEMP => 'Código',
                    ContabaPeer :: CODEMP => 'Código'
                );
            }
        } else {
            $this->c = new Criteria();
            $this->c->add(ContabaPeer :: CODEMP, 'XXX');
            $this->columnas = array(
                ContabaPeer :: CODEMP => 'Código',
                ContabaPeer :: CODEMP => 'Código'
            );
        }
    }

    public function Cadefcen_Almsolegr2($params = array()) {
        $filcencos = H::getConfApp2('filcencos', 'compras', 'almsolegr');
        $filiscen = H::getConfApp2('filiscen', 'compras', 'almsolegr');
        $loguse = sfContext::getInstance()->getUser()->getAttribute('loguse');

        $this->c = new Criteria();
        if ($filcencos == 'S') {
            $this->c->add(CaunicenPeer::CODCAT, $params[0]);
            $this->c->addJoin(CadefcenPeer::CODCEN, CaunicenPeer::CODCEN);
        } else if ($filiscen == 'S') {
            $this->sql = 'cadefcen.codcen in (select codcen from "SIMA_USER".segcenusu where loguse=\'' . $loguse . '\')';
            $this->c->add(CadefcenPeer::CODCEN, $this->sql, Criteria::CUSTOM);
        }

        $this->columnas = array(
            CadefcenPeer :: CODCEN => 'Código',
            CadefcenPeer :: DESCEN => 'Descripción'
        );
    }

    public function Facactpla_plaveh($param = array()) {

        $this->c = new Criteria();
        $this->columnas = array(
            FcregvehPeer :: PLAVEH => 'Placa',
            FcregvehPeer :: RIFCON => 'Contribuyente',
            FcregvehPeer :: NOMCON => 'Descripción'
        );
    }

    public function Cadefubi_Almregart($params = array()) {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(CadefubiPeer::CODUBI);

        $this->columnas = array(
            CadefubiPeer :: CODUBI => 'Código Ubicación',
            CadefubiPeer :: NOMUBI => 'Nombre'
        );
    }

    public function Numord_Opordpag($params = array()) {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(OpordpagPeer::NUMORD);

        $this->columnas = array(
            OpordpagPeer :: NUMORD => 'Número de Orden',
            OpordpagPeer :: DESORD => 'Descripción Orden'
        );
    }

    public function Fcdefpla_Facdefpla2($params = array()) {

        $this->c = new Criteria();
        $this->c->add(FcdeftasasPeer::CODFUE, $params[0]);
        $this->c->addJoin(FcplatasPeer::CODTAS, FcdeftasasPeer::CODTAS);
        $this->c->addJoin(FcdefplaPeer::CODPLA, FcplatasPeer::CODPLA);

        $this->columnas = array(
            FcdefplaPeer :: CODPLA => 'Código',
            FcdefplaPeer :: DESPLA => 'Descripción',
        );
    }

    public function Facactlic_Fcsollic($param = array()) {
        $this->c = new Criteria();
        $this->c->add(FcsollicPeer :: STALIC, 'V');
        $this->c->addAscendingOrderByColumn(FcsollicPeer :: NUMSOL);

        $this->columnas = array(
            FcsollicPeer :: NUMLIC => 'Númro de Licencia',
            FcsollicPeer :: RIFCON => 'Contribuyente',
            FcsollicPeer :: NOMCON => 'Nombre'
        );
    }

    public function Contabb_pretitpre() {
        $this->c = new Criteria();
        $this->c->add(ContabbPeer :: CARGAB, 'C');


        $this->columnas = array(
            ContabbPeer :: CODCTA => 'Código',
            ContabbPeer :: DESCTA => 'Descripción',
        );
    }

    public function Bnregmue_Bnestcon() {
        $this->c = new Criteria();

        $this->columnas = array(
            BnestconPeer :: CODEST => 'Código',
            BnestconPeer :: DESEST => 'Descripción',
        );
    }

    public function Bnregmue_Bnmodtra() {
        $this->c = new Criteria();

        $this->columnas = array(
            BnmodtraPeer :: CODMOD => 'Código',
            BnmodtraPeer :: DESMOD => 'Descripción',
        );
    }

    public function Preprecom_Cpevepre() {
        $this->c = new Criteria();

        $this->columnas = array(
            CpeveprePeer :: CODEVE => 'Código',
            CpeveprePeer :: DESEVE => 'Descripción',
        );
    }

    public function ConFinActCom_Cotiptra() {
        $this->c = new Criteria();

        $this->columnas = array(
            CotiptraPeer :: CODTIPTRA => 'Código',
            CotiptraPeer :: DESTIPTRA => 'Descripción',
        );
    }

    public function fadefalm_fadefzon() {
        $this->c = new Criteria();

        $this->columnas = array(
            FadefzonPeer :: CODZON => 'Código',
            FadefzonPeeR :: DESZON => 'Descripción',
        );
    }

    /*     * ************************* Facturación: Definición de Empresas Transportistas ****************** */

    public function Faemptra_codemptra() {
        $this->c = new Criteria();

        $this->columnas = array(
            FaemptraPeer :: CODEMPTRA => 'Código',
            FaemptraPeer :: NOMEMPTRA => 'Nombre',
        );
    }

    public function Fafactur_nompro() {
        $this->c = new Criteria();
        $this->c->addJoin(FafacturPeer :: CODCLI, FaclientePeer :: CODPRO);

        $this->columnas = array(
            FafacturPeer :: REFFAC => 'Código',
            FaclientePeer :: NOMPRO => 'Proveedor',
        );
    }

    public function FaDefZon_Codzon() {
        $this->c = new Criteria();

        $this->columnas = array(
            FaDefZonPeer :: CODZON => 'Código',
            FaDefZonPeer :: DESZON => 'Descripción',
        );
    }

    public function Cadefalm_Fadefzon() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(FadefzonPeer::DESZON);

        $this->columnas = array(
            FadefzonPeer :: CODZON => 'Código',
            FadefzonPeer :: DESZON => 'Zona',
        );
    }

    public function Caprovee_Almentalm() {
        $this->c = new Criteria();
        $this->c->add(CaproveePeer::ESTPRO, 'A');
        //   $this->c->addAscendingOrderByColumn(CaproveePeer::CODPRO);
        $this->columnas = array(
            CaproveePeer :: CODPRO => 'Código',
            CaproveePeer :: RIFPRO => 'Rifpro',
            CaproveePeer :: NOMPRO => 'Descripción',
        );
    }

    public function Cadefunimed_Almregart() {
        $this->c = new Criteria();

        $this->columnas = array(
            CadefunimedPeer :: CODUNIMED => 'Código',
            CadefunimedPeer :: DESUNIMED => 'Descripción',
        );
    }

    public function Caregart_Falisprc() {

        $c = new Criteria();
        $cadefart = CadefartPeer::doSelectOne($c);

        $this->c = new Criteria();
        $this->sql = "array_upper(regexp_split_to_array(" . CaregartPeer::CODART . ",'-'),1)=array_upper(regexp_split_to_array('" . $cadefart->getForart() . "','-'),1)";
        $this->c->add(CaregartPeer :: CODART, $this->sql, Criteria :: CUSTOM);
        $this->columnas = array(
            CaregartPeer :: CODART => 'Código',
            CaregartPeer :: DESART => 'Descripción',
                #CaregartPeer :: COSULT => 'Costo',
                #CaregartPeer :: CODPAR => 'Partida'
        );
    }

    public function Caregart_Facarord($params = array()) {
        $longitud = $params[0];
        $this->c = new Criteria();

        $this->sql = "length(Codart) = '" . $longitud . "'";
        $this->c->add(CaregartPeer::CODCTA, $this->sql, Criteria :: CUSTOM);

        $this->columnas = array(
            CaregartPeer :: CODART => 'Código',
            CaregartPeer :: DESART => 'Descripción',
        );
    }

    public function Falisprc_Fapedido($params = array()) {
        $longitud = $params[0];
        $codprg = $params[1];
        $codtip = $params[2];
        $conpag_id = $params[3];
        $mostodart = H::getConfAppGen('mostodart');
        if ($mostodart == 'S') {
            $this->sql = "length(Codart) = '" . $longitud . "'";
        } else {
            $this->sql = "length(Codart) = '" . $longitud . "' and tipreg='F'";
        }

        $this->custom_sql = "select  '{'||'\"codart\":\"'||a.codart||'\",\"desart\":\"'||b.desart||'\"}' as json from falisprc a inner join caregart b on a.codart=b.codart WHERE codprg='" . $codprg . "' AND codtipcli='" . $codtip . "' AND conpag_id=$conpag_id AND fecvig=(SELECT MAX(fecvig) from falisprc WHERE a.codprg='" . $codprg . "' AND a.codtipcli='" . $codtip . "' AND a.conpag_id=$conpag_id)";

        $this->columnas = array(
            FalisprcPeer :: CODART => 'Código',
            'falisprc.DESART' => 'Descripcion',
        );
    }

    public function Caregart_Facarord2($params = array()) {
        $longitud = $params[0];
        $this->c = new Criteria();

        $this->sql = "length(" . CaregartPeer::CODART . ") = '" . $longitud . "'";
        if (isset($params[1]))
            if ($params[1] != '') {
                $aux = split('_', $params[1]);
                for ($a = 0; $a < count($aux); $a++) {
                    if ($a == 0)
                        $this->sql = $this->sql . " and (" . CaregartPeer::CODART . " like '" . $aux[$a] . "%' ";
                    else if ($a == (count($aux) - 1))
                        $this->sql = $this->sql . " or " . CaregartPeer::CODART . " like '" . $aux[$a] . "%' ";
                    else
                        $this->sql = $this->sql . " or " . CaregartPeer::CODART . " like '" . $aux[$a] . "%'";
                }
                $this->sql = $this->sql . ")";
            }

        $this->c->add(CaregartPeer :: CODART, $this->sql, Criteria :: CUSTOM);
        if (isset($params[2])) {
            $this->c->addJoin(CaregartPeer::CODART, FalisprcPeer::CODART);
            $this->c->add(FalisprcPeer::CODTIPCLI, $params[2]);
            if (isset($params[3]))
                $this->c->add(FalisprcPeer::CODPRG, $params[3]);
            if (isset($params[4]))
                $this->c->add(FalisprcPeer::CONPAG_ID, $params[4]);
        }

        $this->columnas = array(
            CaregartPeer :: CODART => 'Código',
            CaregartPeer :: DESART => 'Descripción',
        );
    }

    public function Faentcre_Facarord() {
        $this->c = new Criteria();

        $this->columnas = array(
            FaentcrePeer :: CODENTCRE => 'Código',
            FaentcrePeer :: NOMENTCRE => 'Nombre',
        );
    }

    public function Rifcli_Fapedidov2() {
        $this->c = new Criteria();

        $this->custom_sql = "Select a.rifpro, a.nompro, a.codpro from Facliente a";

        $this->columnas = array(
            FaclientePeer::RIFPRO => 'CI/RIF',
            FaclientePeer::NOMPRO => 'Descripción',
            FaclientePeer::CODPRO => 'Código',
        );
    }

    public function Caregart_Fapedidov2($params = array()) {
        $longitud = $params[0];
        $this->c = new Criteria();
        $mostodart = H::getConfAppGen('mostodart');
        if ($mostodart == 'S') {
            $this->sql = "length(Codart) = '" . $longitud . "'";
        } else {
            $this->sql = "length(Codart) = '" . $longitud . "' and tipreg='F'";
        }
        $this->c->add(CaregartPeer :: CODART, $this->sql, Criteria :: CUSTOM);

        $this->custom_sql = "Select a.codart, a.desart
from caregart a,cadefart b
where array_upper(regexp_split_to_array(a.codart,'-'),1)=array_upper(regexp_split_to_array(b.forart,'-'),1)
order by codart limit 5000";

        $this->columnas = array(
            CaregartPeer :: CODART => 'Código',
            CaregartPeer :: DESART => 'Descripción',
        );
    }

    public function Falisprc_Fafactur($params = array()) {
        $longitud = $params[0];
        $codprg = isset($params[1]) ? $params[1] : '';
        $codtip = isset($params[2]) ? $params[2] : '';
        $conpag_id = isset($params[3]) ? $params[3] : '';
        $mostodart = H::getConfAppGen('mostodart');
        if ($mostodart == 'S') {
            $this->sql = "length(Codart) = '" . $longitud . "'";
        } else {
            $this->sql = "length(Codart) = '" . $longitud . "' and tipreg='F'";
        }

        if ($codprg != '' && $codtip != '' && $conpag_id != '')
            $this->custom_sql = "select  a.codart, b.desart from falisprc a inner join caregart b on a.codart=b.codart
                                         WHERE a.codprg='" . $codprg . "' AND a.codtipcli='" . $codtip . "' AND a.conpag_id=$conpag_id
                                         AND fecvig=(SELECT MAX(fecvig) from falisprc
                                         WHERE codprg='" . $codprg . "' AND codtipcli='" . $codtip . "' AND conpag_id=$conpag_id)";
        else
            $this->custom_sql = "select b.codart, b.desart from caregart b limit 5";
        //$this->custom_sql = "select a.codart, b.desart from falisprc a inner join caregart b on a.codart=b.codart where fecvig=(SELECT MAX(fecvig) from falisprc)";

        $this->columnas = array(
            FalisprcPeer :: CODART => 'Código',
            'falisprc.DESART' => 'Descripcion',
        );
    }

    public function Falisprc_Fapedidov2($params = array()) {
        $longitud = $params[0];
        $codprg = $params[1];
        $codtip = $params[2];
        $conpag_id = $params[3];
        $mostodart = H::getConfAppGen('mostodart');
        if ($mostodart == 'S') {
            $this->sql = "length(Codart) = '" . $longitud . "'";
        } else {
            $this->sql = "length(Codart) = '" . $longitud . "' and tipreg='F'";
        }

        $this->custom_sql = "select  distinct '{'||'\"codart\":\"'||a.codart||'\",\"desart\":\"'||b.desart||'\"}' as json from falisprc a inner join caregart b on a.codart=b.codart WHERE codprg='" . $codprg . "' AND codtipcli='" . $codtip . "' AND conpag_id=$conpag_id ";

        $this->columnas = array(
            FalisprcPeer :: CODART => 'Código',
            'falisprc.DESART' => 'Descripcion',
        );
    }

    public function Secciones_Inscribir() {
        $this->c = new Criteria();
        $this->columnas = array(
            SeccionesPeer :: CODIGO => 'Código Sección',
            SeccionesPeer :: NOMBRE => 'Nombre',
        );
    }

    public function Alumnos_Inscribir() {
        $this->c = new Criteria();
        $this->columnas = array(
            AlumnosPeer :: CEDULA => 'Cedula Alumno',
            AlumnosPeer :: NOMBRE => 'Nombre',
        );
    }

    public function Npasocatdoc_Npdefcate() {
        $this->c = new Criteria();

        $this->columnas = array(
            NpdefcatePeer :: CODCATE => 'Código',
            NpdefcatePeer :: DESCATE => 'Descripción',
        );
    }

    public function Nomdefespnivorg_Npdefsitent() {
        $this->c = new Criteria();

        $this->columnas = array(
            NpdefsitentPeer :: CODSITENT => 'Código',
            NpdefsitentPeer :: DESSITENT => 'Descripción',
        );
    }

    public function Npforasicaremp_Npdefttrab() {
        $this->c = new Criteria();

        $this->columnas = array(
            NpdefttrabPeer :: CODTTRAB => 'Código',
            NpdefttrabPeer :: DESTTRAB => 'Descripción',
        );
    }

    public function Faordcom_Faordrec($params = array()) {
        $codalm = $params[0];
        $b = new Criteria();
        $b->add(CadefalmPeer :: CODALM, $codalm);
        $r = CadefalmPeer::doSelectOne($b);

        $this->c = new Criteria();
        $this->c->add(FaordcomPeer::CODALMSAP, $r->getCodalmsap());
        $this->c->addJoin(FaordcomPeer::ORDCOM, FaartordPeer::ORDCOM);
        $this->c->setDistinct();
        $this->sql = " Faartord.canord > Faartord.canrec ";
        $this->c->add(FaartordPeer :: CANORD, $this->sql, Criteria :: CUSTOM);
        $this->c->addAscendingOrderByColumn(FaordcomPeer :: ORDCOM);


        $this->columnas = array(
            FaordcomPeer :: ORDCOM => 'Código',
            FaordcomPeer :: FECORD => 'Fecha',
            FaordcomPeer :: DESORD => 'Descripción'
        );
    }

    public function Preprecom_Cpasiini2($params = array()) {

        $this->c = new Criteria();
        $this->sql = "length(cpasiini.codpre) = length(cpdefniv.forpre)";
        if (isset($params[0]))
            if ($params[0] != '') {
                $aux = explode('*', $params[0]);
                for ($a = 0; $a < count($aux); $a++) {
                    if ($a == 0)
                        $this->sql = $this->sql . " and (" . CpasiiniPeer::CODPRE . " like '" . $aux[$a] . "%' ";
                    else if ($a == (count($aux) - 1))
                        $this->sql = $this->sql . " or " . CpasiiniPeer::CODPRE . " like '" . $aux[$a] . "%' ";
                    else
                        $this->sql = $this->sql . " or " . CpasiiniPeer::CODPRE . " like '" . $aux[$a] . "%'";
                }
                $this->sql = $this->sql . ")";
            }

        $this->c->add(CpdefnivPeer :: FORPRE, $this->sql, Criteria :: CUSTOM);
        $this->c->add(CpasiiniPeer :: PERPRE, '00');
        //$this->c->add(CpasiiniPeer :: MONDIS, 0, Criteria::GREATER_THAN);

        $this->c->addAscendingOrderByColumn(CpasiiniPeer::CODPRE);

        $this->columnas = array(
            CpasiiniPeer::CODPRE => 'Código Presupuestario',
            CpasiiniPeer::NOMPRE => 'Descripción'
        );
    }

    public function PrePagar_Cpasiini2($params = array()) {
        $this->c = new Criteria();
        $this->sql = "length(cpasiini.codpre) = length(cpdefniv.forpre)";
        if (isset($params[0]))
            if ($params[0] != '') {
                $aux = explode('*', $params[0]);
                for ($a = 0; $a < count($aux); $a++) {
                    if ($a == 0)
                        $this->sql = $this->sql . " and (" . CpasiiniPeer::CODPRE . " like '" . $aux[$a] . "%' ";
                    else if ($a == (count($aux) - 1))
                        $this->sql = $this->sql . " or " . CpasiiniPeer::CODPRE . " like '" . $aux[$a] . "%' ";
                    else
                        $this->sql = $this->sql . " or " . CpasiiniPeer::CODPRE . " like '" . $aux[$a] . "%'";
                }
                $this->sql = $this->sql . ")";
            }

        $this->c->add(CpdefnivPeer :: FORPRE, $this->sql, Criteria :: CUSTOM);
        $this->c->add(CpasiiniPeer :: PERPRE, '00');
        //$this->c->add(CpasiiniPeer :: MONDIS, 0, Criteria::GREATER_THAN);

        $this->c->addAscendingOrderByColumn(CpasiiniPeer::CODPRE);

        $this->columnas = array(
            CpasiiniPeer::CODPRE => 'Código Presupuestario',
            CpasiiniPeer::NOMPRE => 'Descripción'
        );
    }

    public function PreCompro_Cpasiini2($params = array()) {
        $this->c = new Criteria();
        $this->sql = "";
        if (isset($params[0]))
            if ($params[0] != '') {
                $aux = explode('*', $params[0]);
                for ($a = 0; $a < count($aux); $a++) {
                    if ($a == 0)
                        $this->sql = $this->sql . " (" . CpasiiniPeer::CODPRE . " like '" . $aux[$a] . "%' ";
                    else if ($a == (count($aux) - 1))
                        $this->sql = $this->sql . " or " . CpasiiniPeer::CODPRE . " like '" . $aux[$a] . "%' ";
                    else
                        $this->sql = $this->sql . " or " . CpasiiniPeer::CODPRE . " like '" . $aux[$a] . "%'";
                }
                $this->sql = $this->sql . ")";
            }
        if ($this->sql != "")
            $this->c->add(CpasiiniPeer :: CODPRE, $this->sql, Criteria :: CUSTOM);


        $this->c->addJoin(CpasiiniPeer :: CODPRE, CpdeftitPeer :: CODPRE);
        $this->c->add(CpasiiniPeer :: PERPRE, '00');
        //$this->c->add(CpasiiniPeer :: MONDIS, 0, Criteria::GREATER_EQUAL);
        $this->c->addAscendingOrderByColumn(CpasiiniPeer::CODPRE);

        $this->columnas = array(
            CpasiiniPeer::CODPRE => 'Código Presupuestario',
            CpasiiniPeer::NOMPRE => 'Descripción'
        );
    }

    public function Cppagos_Prerevpag($params = array()) {
        $this->c = new Criteria();
        $this->c->add(CppagosPeer :: STAPAG, 'A');
        $this->c->add(CpimppagPeer :: REFERE, null, Criteria :: ISNOTNULL);
        $this->c->add(CpimppagPeer :: REFERE, 'NULO', Criteria :: NOT_EQUAL);
        $this->c->add(CpimppagPeer :: REFCOM, null, Criteria :: ISNOTNULL);
        $this->c->add(CpimppagPeer :: REFCOM, 'NULO', Criteria :: NOT_EQUAL);
        $this->c->add(CpimppagPeer :: REFPRC, null, Criteria :: ISNOTNULL);
        $this->c->add(CpimppagPeer :: REFPRC, 'NULO', Criteria :: NOT_EQUAL);
        $this->c->addJoin(CppagosPeer :: REFPAG, CpimppagPeer::REFPAG);
        $this->c->addAscendingOrderByColumn(CppagosPeer :: REFPAG);

        $this->columnas = array(
            CppagosPeer :: REFPAG => 'Referencia',
            CppagosPeer :: FECPAG => 'Fecha',
            CppagosPeer :: DESPAG => 'Descripcion',
            CppagosPeer :: MONPAG => 'Monto'
        );
    }

    public function Nphojint_codtit($params = array()) {
        $this->c = new Criteria();
        $this->c->add(NphojintPeer :: STAEMP, 'A');
        $this->c->add(NphojintPeer :: SEGHCM, 'S');

        $this->columnas = array(
            NphojintPeer :: CEDEMP => 'Cedula',
            NphojintPeer :: CODEMP => 'Código',
            NphojintPeer :: NOMEMP => 'Nombre',
            NphojintPeer :: STAEMP => 'Estatus'
        );
    }

    public function Npinffam_codben($params = array()) {
        $titular = $params[0];

        $this->c = new Criteria();
        /* $this->c->add(NpinffamPeer::CODEMP,$titular);
          $this->c->add(NpinffamPeer::STATUS,'I', Criteria::NOT_EQUAL); */
        $sql = "npinffam.codemp='" . $titular . "' and (npinffam.status<>'I' or npinffam.status='' or npinffam.status is null)";
        $this->c->add(NpinffamPeer::STATUS, $sql, Criteria::CUSTOM);

        $this->columnas = array(
            NpinffamPeer :: CEDFAM => 'Cedula',
            NpinffamPeer :: NOMFAM => 'Nombre',
            NpinffamPeer :: PARFAM => 'Parentesco'
        );
    }

    public function Caprovee_rifcli($params = array()) {
        $this->c = new Criteria();

        if (count($params) > 0) {
            if ($params[0] != '')
                $this->c->add(CaproveePeer :: CODRAM, $params[0]);
        }

        $this->columnas = array(
            CaproveePeer :: RIFPRO => 'RIF',
            CaproveePeer :: NOMPRO => 'Nombre'
        );
    }

    public function Hcregmedlab_codmedlab() {
        $this->c = new Criteria();

        $this->columnas = array(
            HcregmedlabPeer :: CODMEDLAB => 'Código',
            HcregmedlabPeer :: NOMMEDLAB => 'Nombre',
            HcregmedlabPeer :: ESPMEDLAB => 'Especialidad',
        );
    }

    public function Npdefcpt_codree() {
        $this->c = new Criteria();

        $this->columnas = array(
            NpdefcptPeer :: CODCON => 'Código',
            NpdefcptPeer :: NOMCON => 'Nombre'
        );
    }

    public function Npdefcpt_nomhojint() {

        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(NpdefcptPeer :: CODCON);

        $this->columnas = array(
            NpdefcptPeer :: CODCON => 'Código',
            NpdefcptPeer :: NOMCON => 'Descripción'
        );
    }

    public function Viasolviatra_empleado($params = array()) {
        $esnoemp = '';
        if (count($params) > 0)
            if ($params[0])
                $esnoemp = $params[0];
        $this->c = new Criteria();
        if ($esnoemp == 'true') {
            $this->columnas = array(
                VianoempPeer :: RIFNEMP => 'Código',
                VianoempPeer :: NOMNEMP => 'Nombre',
            );
        } else {
            $this->c->add(NphojintPeer::STAEMP,'A');
            $this->columnas = array(
                NphojintPeer :: CODEMP => 'Código',
                NphojintPeer :: NOMEMP => 'Nombre',
                NphojintPeer :: STAEMP => 'Estatus'
            );
        }
    }

    public function Fadependencia($param = array()) {
        $this->c = new Criteria();

        $this->columnas = array(
            FadependenciaPeer::CODDEP => 'Código',
            FadependenciaPeer::NOMDEP => 'Descripcion',
        );
    }

    public function FaSubsistema($param = array()) {
        $this->c = new Criteria();

        $this->columnas = array(
            FasubsistemaPeer::CODSUB => 'Código',
            FasubsistemaPeer::NOMSUB => 'Descripcion',
        );
    }

    public function Cpdoccau_Pagemiret() {
        $this->c = new Criteria();
        $this->c->add(OpdefempPeer::CODEMP, '001');
        $this->c->addJoin(CpdoccauPeer::TIPCAU, OpdefempPeer::ORDRET);

        $this->columnas = array(
            CpdoccauPeer :: TIPCAU => 'Código',
            CpdoccauPeer :: NOMEXT => 'Descripción',
        );
    }

    public function Fainstedu_Fadesp($params = array()) {
        $this->c = new Criteria();
        $this->c->add(FainsteduPeer::CODEDO, $params[0]);
        $this->c->add(FainsteduPeer::CODCIU, $params[1]);
        $this->c->add(FainsteduPeer::CODMUN, $params[2]);
        $this->c->add(FainsteduPeer::CODPAR, $params[3]);

        $this->columnas = array(
            FainsteduPeer :: CODINST => 'Código',
            FainsteduPeer :: NOMINST => 'Nombre',
        );
    }

    public function Nomreghorprofnuc_Npdefcpt($params = array()) {
        $this->c = new Criteria();
        $this->c->addJoin(NpcargosPeer::CODCAR, NpasicarempPeer :: CODCAR);
        if ($params) {
            $this->c->add(NpasicarempPeer :: CODEMP, $params[0]);
        }

        $this->columnas = array(
            NpcargosPeer :: CODCAR => 'Código',
            NpcargosPeer :: NOMCAR => 'Cargo',
            NpcargosPeer :: SUECAR => 'Sueldo',
            NpcargosPeer :: GRAOCP => 'Grado',
        );
    }

    public function Presoltrasla_Cpasiini3($params = array()) {
        $this->c = new Criteria();
        $this->sql = "";
        if (isset($params[0]))
            if ($params[0] != '') {
                $aux = explode('*', $params[0]);
                for ($a = 0; $a < count($aux); $a++) {
                    if ($a == 0)
                        $this->sql = $this->sql . " (" . CpasiiniPeer::CODPRE . " like '" . $aux[$a] . "%' ";
                    else if ($a == (count($aux) - 1))
                        $this->sql = $this->sql . " or " . CpasiiniPeer::CODPRE . " like '" . $aux[$a] . "%' ";
                    else
                        $this->sql = $this->sql . " or " . CpasiiniPeer::CODPRE . " like '" . $aux[$a] . "%'";
                }
                $this->sql = $this->sql . ")";
            }
        if ($this->sql != "")
            $this->c->add(CpasiiniPeer :: CODPRE, $this->sql, Criteria :: CUSTOM);


        $this->c->addJoin(CpasiiniPeer :: CODPRE, CpdeftitPeer :: CODPRE);
        $this->c->add(CpasiiniPeer :: PERPRE, '00');
        $this->c->addAscendingOrderByColumn(CpasiiniPeer::CODPRE);

        $this->columnas = array(
            CpasiiniPeer::CODPRE => 'Código Presupuestario',
            CpasiiniPeer::NOMPRE => 'Descripción',
            'cpasiini.MONDISOBTEJE' => 'Disponible',
        );
    }

    public function Cpasiini_Presoladidis2($params = array()) {

        $this->c = new Criteria();
        $this->sql = "";
        if (isset($params[0]))
            if ($params[0] != '') {
                $aux = explode('*', $params[0]);
                for ($a = 0; $a < count($aux); $a++) {
                    if ($a == 0)
                        $this->sql = $this->sql . " (" . CpasiiniPeer::CODPRE . " like '" . $aux[$a] . "%' ";
                    else if ($a == (count($aux) - 1))
                        $this->sql = $this->sql . " or " . CpasiiniPeer::CODPRE . " like '" . $aux[$a] . "%' ";
                    else
                        $this->sql = $this->sql . " or " . CpasiiniPeer::CODPRE . " like '" . $aux[$a] . "%'";
                }
                $this->sql = $this->sql . ")";
            }
        if ($this->sql != "")
            $this->c->add(CpasiiniPeer :: CODPRE, $this->sql, Criteria :: CUSTOM);

        $this->c->addJoin(CpasiiniPeer :: CODPRE, CpdeftitPeer :: CODPRE);
        $this->c->add(CpasiiniPeer :: PERPRE, '00');
        $this->c->add(CpasiiniPeer :: MONASI, '0', Criteria::GREATER_EQUAL);
        $this->c->addAscendingOrderByColumn(CpasiiniPeer::CODPRE);

        $this->columnas = array(
            CpasiiniPeer::CODPRE => 'Código Presupuestario',
            CpasiiniPeer::NOMPRE => 'Descripción',
            CpasiiniPeer::MONDIS => 'Disponible',
        );
    }

    public function Contabc_ConFinComRev() {
        $this->c = new Criteria();
        $this->c->add(ContabcPeer::STACOM, 'N', Criteria::NOT_EQUAL);
        $this->c->addAscendingOrderByColumn(ContabcPeer :: NUMCOM);
        $this->c->addAscendingOrderByColumn(ContabcPeer :: FECCOM);
        $this->c->addAscendingOrderByColumn(ContabcPeer :: STACOM);

        $this->columnas = array(
            ContabcPeer :: NUMCOM => 'Numero',
            ContabcPeer :: DESCOM => 'Descripcion',
            ContabcPeer :: FECCOM => 'Fecha',
            ContabcPeer :: STACOM => 'Estatus',
            ContabcPeer :: REFTRA => 'Referencia',
            ContabcPeer :: MONCOM => 'Monto',
        );
    }

    public function Cadefdirec_Almdefdiv($param = array()) {
        $loguse= sfContext::getInstance()->getUser()->getAttribute('loguse');
        $filsoldir=H::getConfApp2('filsoldir', 'viaticos', 'viasolviatra');
        $filsoldir2=H::getConfApp2('filsoldir', 'compras', 'almsolegr');
        $filsoldir3=H::getConfApp2('filsoldir', 'presupuesto', 'preprecom');

        $this->c = new Criteria();
        if ($filsoldir=='S' || $filsoldir2=='S' || $filsoldir3=='S'){
          $sql='cadefdirec.coddirec in (select coddirec from "SIMA_USER".segdirusu where loguse=\''.$loguse.'\')';
          $this->c->add(CadefdirecPeer::CODDIREC,$sql,Criteria::CUSTOM);
        }

        $this->columnas = array(
            CadefdirecPeer::CODDIREC => 'Código',
            CadefdirecPeer::DESDIREC => 'Descripcion',
        );
    }

    public function Cadefdivi_Almordcom($params = array()) {
        $this->c = new Criteria();
        if ($params) {
            $this->c->add(CadefdiviPeer :: CODDIREC, $params[0]);
        }

        $this->columnas = array(
            CadefdiviPeer :: CODDIVI => 'Código',
            CadefdiviPeer :: DESDIVI => 'Descripción',
        );
    }

    public function Fadefcan_Fafactur($param = array()) {
        $this->c = new Criteria();

        $this->columnas = array(
            FadefcanPeer::CODCAN => 'Código',
            FadefcanPeer::DESCAN => 'Descripcion',
        );
    }

    public function Faproduc_Fafactur($param = array()) {
        $this->c = new Criteria();

        $this->columnas = array(
            FaproducPeer::RIFPROD => 'Rif',
            FaproducPeer::NOMPROD => 'Nombre',
        );
    }

    public function Opordpag_Pagemiord($params = array()) {
        $this->c = new Criteria();
        $ordamo = H::getX_vacio('CODEMP', 'Opdefemp', 'Ordamo', '001');
        $this->c->add(OpordpagPeer::TIPCAU, $ordamo);
        $this->c->add(OpordpagPeer::STATUS, 'I');
        if (isset($params[0]))
            if ($params[0] != '')
                $this->c->add(OpordpagPeer::CEDRIF, $params[0]);

        $this->columnas = array(
            OpordpagPeer::NUMORD => 'Número',
            OpordpagPeer::FECEMI => 'Fecha',
        );
    }

    public function Npcatpre_Cadefdivi($params = array()) {
        $this->c = new Criteria();
        $this->sql = "";
        $categoriasusu = sfContext::getInstance()->getUser()->getAttribute('categoriasusu');
        //print $categoriasusu;EXIT;
        if ($categoriasusu != '') {
            $aux = explode('*', $categoriasusu);
            for ($a = 0; $a < count($aux); $a++) {
                if ($a == 0)
                    $this->sql = $this->sql . " (" . NpcatprePeer::CODCAT . " like '" . $aux[$a] . "%' ";
                else if ($a == (count($aux) - 1))
                    $this->sql = $this->sql . " or " . NpcatprePeer::CODCAT . " like '" . $aux[$a] . "%' ";
                else
                    $this->sql = $this->sql . " or " . NpcatprePeer::CODCAT . " like '" . $aux[$a] . "%'";
            }
            $this->sql = $this->sql . ")";
        }
        else{
            $this->sql = " CODCAT='' " ;
        }



        $this->c->add(NpcatprePeer :: CODCAT, $this->sql, Criteria :: CUSTOM);
        $this->c->addAscendingOrderByColumn(NpcatprePeer::CODCAT);

        $this->columnas = array(
            NpcatprePeer::CODCAT => 'Código Categoria',
            NpcatprePeer::NOMCAT => 'Descripción'
        );
    }

    public function Nomdatrelemp_Nptipded($param = array()) {
        $this->c = new Criteria();

        $this->columnas = array(
            NptipdedPeer::CODTIP => 'Tipo',
            NptipdedPeer::DESTIP => 'Descripción',
        );
    }

    public function Nominctratxt_Nphojint() {

        $this->c = new Criteria();
        $this->c->add(NpasicarempPeer :: STATUS, 'V');
        $this->c->addJoin(NphojintPeer :: CODEMP, NpasicarempPeer :: CODEMP);

        $this->columnas = array(
            NphojintPeer :: CODEMP => 'Codigo',
            NphojintPeer :: NOMEMP => 'Nombre',
            NphojintPeer :: STAEMP => 'Estatus'
        );
    }

    public function Npestorg_Nomreghorprofnuc($params = array()) {

        $this->c = new Criteria();
        if (count($params) > 0) {
            $mask = $params[0];
            $this->sql = "length(npestorg.Codniv) = '" . $mask . "'";
            $this->c->add(NpestorgPeer :: CODNIV, $this->sql, Criteria :: CUSTOM);
            if (count($params) > 1) {
                $this->c->add(NpasonucempPeer :: CODEMP, $params[1]);
                $this->c->addJoin(NpestorgPeer :: CODNIV, NpasonucempPeer :: CODNIV);
            }
        }


        $this->columnas = array(
            NpestorgPeer :: CODNIV => 'Código',
            NpestorgPeer :: DESNIV => 'Descripción',
        );
    }

    public function Viadefrub_Internacional() {
        $this->c = new Criteria();
        $this->c->add(ViadefrubPeer::TIPVIAT, 'I');

        $this->columnas = array(
            ViadefrubPeer :: CODRUB => 'Código',
            ViadefrubPeer :: DESRUB => 'Descripción',
        );
    }

    public function Bnubica_PagemiordNew($mascara = array()) {
        $mask = $mascara[0];
        $filubiadm = H::getConfApp2('filubiadm', 'tesoreria', 'pagemiord');

        $this->c = new Criteria();
        $this->sql = "length(Codubi) = '" . $mask . "'";
        $ubiadmusu = sfContext::getInstance()->getUser()->getAttribute('ubiadmusu');
        if ($filubiadm == 'S') {
            if ($ubiadmusu != '') {
                $aux = explode('*', $ubiadmusu);
                for ($a = 0; $a < count($aux); $a++) {
                    if ($a == 0)
                        $this->sql = $this->sql . " and (" . BnubicaPeer::CODUBI . " like '" . $aux[$a] . "%' ";
                    else if ($a == (count($aux) - 1))
                        $this->sql = $this->sql . " or " . BnubicaPeer::CODUBI . " like '" . $aux[$a] . "%' ";
                    else
                        $this->sql = $this->sql . " or " . BnubicaPeer::CODUBI . " like '" . $aux[$a] . "%'";
                }
                $this->sql = $this->sql . ")";
            }
            else
                $this->sql = "length(Codubi) = 0";
        }
        $this->c->add(BnubicaPeer :: CODUBI, $this->sql, Criteria :: CUSTOM);

        $this->columnas = array(
            BnubicaPeer :: CODUBI => 'Código',
            BnubicaPeer :: DESUBI => 'Descripción',
            BnubicaPeer :: STACOD => 'Estatus',
        );
    }

    public function Cpasiini_PagemiordNew() {
        $filcatpre = H::getConfApp2('filcatpre', 'tesoreria', 'pagemiord');

        $this->c = new Criteria();
        //$this->c->add(CpasiiniPeer :: PERPRE, '00');

        $categoriasusu = sfContext::getInstance()->getUser()->getAttribute('categoriasusu');
        if ($filcatpre == 'S') {
            $this->sql = "cpasiini.perpre ='00'";
            if ($categoriasusu != '') {
                $aux = explode('*', $categoriasusu);
                for ($a = 0; $a < count($aux); $a++) {
                    if ($a == 0)
                        $this->sql = $this->sql . " and (" . CpasiiniPeer::CODPRE . " like '" . $aux[$a] . "%' ";
                    else if ($a == (count($aux) - 1))
                        $this->sql = $this->sql . " or " . CpasiiniPeer::CODPRE . " like '" . $aux[$a] . "%' ";
                    else
                        $this->sql = $this->sql . " or " . CpasiiniPeer::CODPRE . " like '" . $aux[$a] . "%'";
                }
                $this->sql = $this->sql . ")";
            }
            else
                $this->sql = "cpasiini.perpre =''";
            $this->c->add(CpasiiniPeer::CODPRE, $this->sql, Criteria :: CUSTOM);
        }
        else
            $this->c->add(CpasiiniPeer :: PERPRE, '00');


        $this->columnas = array(
            CpasiiniPeer :: CODPRE => 'Código Presupuestario',
            CpasiiniPeer :: NOMPRE => 'Descripción',
        );
    }

    public function Tsdefban_TesmovemicheNew() {
        $filubiadm = H::getConfApp2('filubiadm', 'tesoreria', 'pagemiord');
        $filbandir = H::getConfApp2('filbandir', 'tesoreria', 'tesdefcueban');
        $manbloqban = H::getX_vacio('CODEMP', 'Opdefemp', 'Manbloqban', '001');
        $loguse= sfContext::getInstance()->getUser()->getAttribute('loguse');
        $this->sql = "";
        $this->c = new Criteria();
        if ($manbloqban == 'S')
            $this->sql = "numcue not in (select numcue from tsbloqban)";
        if ($filbandir=='S'){
          if ($this->sql!='')
            $this->sql.=' and tsdefban.coddirec in (select coddirec from "SIMA_USER".segdirusu where loguse=\''.$loguse.'\')';
          else
            $this->sql='tsdefban.coddirec in (select coddirec from "SIMA_USER".segdirusu where loguse=\''.$loguse.'\')';
        }
        $ubiadmusu = sfContext::getInstance()->getUser()->getAttribute('ubiadmusu');
        if ($filubiadm == 'S') {
            if ($ubiadmusu != '') {
                $aux = explode('*', $ubiadmusu);
                for ($a = 0; $a < count($aux); $a++) {
                    if ($a == 0 && $this->sql == "")
                        $this->sql = $this->sql . "(" . TsdefbanPeer::CODUBI . " like '" . $aux[$a] . "%' ";
                    else if ($a == 0 && $this->sql != "")
                        $this->sql = $this->sql . " and (" . TsdefbanPeer::CODUBI . " like '" . $aux[$a] . "%' ";
                    else if ($a == (count($aux) - 1))
                        $this->sql = $this->sql . " or " . TsdefbanPeer::CODUBI . " like '" . $aux[$a] . "%' ";
                    else
                        $this->sql = $this->sql . " or " . TsdefbanPeer::CODUBI . " like '" . $aux[$a] . "%'";
                }
                $this->sql = $this->sql . ")";
            }
            else
                $this->sql = "numcue = ''";
        }
        if ($manbloqban == 'S' || $filubiadm == 'S' || $filbandir=='S')
            $this->c->add(TsdefbanPeer::NUMCUE, $this->sql, Criteria :: CUSTOM);

        $this->columnas = array(
            TsdefbanPeer :: NUMCUE => 'Número de Cuenta',
            TsdefbanPeer :: NOMCUE => 'Nombre de la Cuenta',
            TsdefbanPeer :: CODCTA => 'Código de la Cuenta',
            TsdefbanPeer :: CODADI => 'Código Adicional',
            TsdefbanPeer :: USOCUE => 'Uso de la Cuenta'
        );
    }

    public function Caregart_FapedidoNew($params = array()) {
        $longitud = $params[0];
        $codalm = $params[1];
        $filalmcaj = H::getConfApp2('filalmcaj', 'facturacion', 'fafactur');
        $this->c = new Criteria();
        $mostodart = H::getConfAppGen('mostodart');
        if ($mostodart == 'S') {
            $this->sql = "length(caregart.Codart) = '" . $longitud . "'";
        } else {
            $this->sql = "length(caregart.Codart) = '" . $longitud . "' and caregart.tipreg='F'";
        }
        if ($filalmcaj == 'S') {
            $this->sql = $this->sql . " and caartalm.codalm='" . $codalm . "'";
            $this->c->addJoin(CaregartPeer :: CODART, CaartalmPeer :: CODART);
        }
        $this->c->add(CaregartPeer :: CODART, $this->sql, Criteria :: CUSTOM);

        $this->columnas = array(
            CaregartPeer :: CODART => 'Código',
            CaregartPeer :: DESART => 'Descripción',
        );
    }

    public function Codconpag_Fadefcaj($params = array()) {
        $this->c = new Criteria();
        $this->columnas = array(
            FaconpagPeer::DESCONPAG => 'Descripción',
        );
    }

    public function Factura_FanotentNew($params = array()) {
        $this->c = new Criteria();
        $this->c->add(FafacturPeer::STATUS, 'N', Criteria::NOT_EQUAL);
        //$this->c->add(FafacturPeer::TIPREF, 'D', Criteria::NOT_EQUAL);
        if (count($params) > 0)
            $this->c->add(FafacturPeer::CODALMUSU, $params[0]);
        $filcajusu = H::getConfApp2('filcajusu', 'facturacion', 'fafactur');
        if ($filcajusu == 'S') {
            $loguse = sfContext::getInstance()->getUser()->getAttribute('loguse');
            $this->sql = 'fafactur.codcaj in (select codcaj from "SIMA_USER".segcajusu where loguse=\'' . $loguse . '\')';
            $this->c->add(FafacturPeer::CODCAJ, $this->sql, Criteria::CUSTOM);
        }

        $this->columnas = array(
            FafacturPeer::REFFAC => 'Número',
            FafacturPeer::DESFAC => 'Descripción',
            FafacturPeer::FECFAC => 'Fecha',
        );
    }

    public function Cadelfalm_AlmordrecNew($params = array()) {

        $c = new Criteria();
        $per = CausualmPeer::doselectOne($c);
        if ($per) {
            $dato = H::GetX('Loguse', 'Usuarios', 'Cedemp', sfContext::getInstance()->getUser()->getAttribute('loguse'));

            $this->c = new Criteria();
            $this->c->add(CausualmPeer::CEDEMP, $dato);
            $this->c->addJoin(CadefalmPeer::CODALM, CausualmPeer::CODALM);
            if (count($params) == 1)
                $this->c->add(CausualmPeer::CODALM, $params[0]);
            $this->c->addAscendingOrderByColumn(CadefalmPeer :: CODALM);
            $this->columnas = array(
                CadefalmPeer :: CODALM => 'Código',
                CadefalmPeer :: NOMALM => 'Descripción',
            );
        }else {
            $this->sql = '';
            $this->c = new Criteria();
            if (count($params) == 1)
                $this->c->add(CadefalmPeer::CODALM, $params[0]);
            $almseparados = H::getConfAppGen('almseparados');
            if ($almseparados == 'S') {
                $modulo = sfContext::getInstance()->getUser()->getAttribute('menu', '', 'autenticacion');
                if ($modulo == 'facturacion') {
                    $this->c->add(CadefalmPeer::TIPREG, 'F');
                } else {
                    $this->sql = "(cadefalm.tipreg<>'F' or cadefalm.tipreg is null)";
                }
            }

            $loguse = sfContext::getInstance()->getUser()->getAttribute('loguse');
            $filalment = H::getConfApp2('filalment', 'facturacion', 'almentalm');
            $modulo = sfContext::getInstance()->getUser()->getAttribute('menu', '', 'autenticacion');
            if ($filalment == 'S' && $modulo == 'facturacion') {
                if ($this->sql != '')
                    $this->sql = $this->sql . ' and cadefalm.codalm in (select b.codalm from "SIMA_USER".segcajusu a, fadefcaj b where b.id=a.codcaj and a.loguse=\'' . $loguse . '\')';
                else
                    $this->sql = 'cadefalm.codalm in (select b.codalm from "SIMA_USER".segcajusu a, fadefcaj b where b.id=a.codcaj and a.loguse=\'' . $loguse . '\')';
            }

            if ($this->sql != '')
                $this->c->add(CadefalmPeer::TIPREG, $this->sql, Criteria::CUSTOM);


            $this->c->addAscendingOrderByColumn(CadefalmPeer :: CODALM);
            $this->columnas = array(
                CadefalmPeer :: CODALM => 'Código',
                CadefalmPeer :: NOMALM => 'Descripción',
            );
        }
    }

    public function Contabc_ConFinComRev2() {
        $this->c = new Criteria();
        $this->c->add(ContabcPeer::STACOM, 'N', Criteria::NOT_EQUAL);
        $this->c->add(ContabcPeer::TIPCOM, 'CON');
        $this->c->addAscendingOrderByColumn(ContabcPeer :: NUMCOM);
        $this->c->addAscendingOrderByColumn(ContabcPeer :: FECCOM);
        $this->c->addAscendingOrderByColumn(ContabcPeer :: STACOM);

        $this->columnas = array(
            ContabcPeer :: NUMCOM => 'Numero',
            ContabcPeer :: DESCOM => 'Descripcion',
            ContabcPeer :: FECCOM => 'Fecha',
            ContabcPeer :: STACOM => 'Estatus',
            ContabcPeer :: REFTRA => 'Referencia',
            ContabcPeer :: MONCOM => 'Monto',
        );
    }

    public function Fadefcan_Fadefpreprocan() {
        $this->c = new Criteria();

        $this->columnas = array(
            FadefcanPeer::CODCAN => 'Código',
            FadefcanPeer::DESCAN => 'Descripción'
        );
    }

    public function Faregvend_Facrogravisi() {
        $this->c = new Criteria();

        $this->columnas = array(
            FaregvendPeer::RIFVEN => 'Cédula',
            FaregvendPeer::NOMVEN => 'Nombre'
        );
    }

    public function Opbenefi_Casolart() {
        $this->c = new Criteria();

        $this->columnas = array(
            OpbenefiPeer :: NOMBEN => 'Nombre',
            OpbenefiPeer :: CEDRIF => 'Cédula o RIF',
        );
    }

    public function Bndefpro_Bieregmue() {
        $this->c = new Criteria();

        $this->columnas = array(
            BndefproPeer :: CODPROC => 'Código',
            BndefproPeer :: DESPROC => 'Descripción',
        );
    }

    public function Npprimashijos_Nomdefespprimas($params = array()) {

        $this->c = new Criteria();
        $this->c->addSelectColumn(NpprimashijosPeer :: CODCOF);
        $this->c->addSelectColumn("'' as PARFAM");
        $this->c->addSelectColumn("0 as EDADDES");
        $this->c->addSelectColumn("0 as EDADHAS");
        $this->c->addSelectColumn("0 as MONTO");
        $this->c->addSelectColumn("'' as ESTUDIOS");
        $this->c->addSelectColumn("'' as CONSEST");
        $this->c->addSelectColumn("'' as CODTIP");
        $this->c->addSelectColumn("'' as FILTROCAR");
        $this->c->addSelectColumn("'' as EDOCIV");
        $this->c->addSelectColumn("'' as ID");
        $this->c->addGroupByColumn(NpprimashijosPeer :: CODCOF);

        $this->columnas = array(
            NpprimashijosPeer :: CODCOF => 'Código PH',
        );
    }

    public function Tsmovtra_tesmovtrabanCuentas($params = array()) {
        $filbandir = H::getConfApp2('filbandir', 'tesoreria', 'tesdefcueban');
        $loguse= sfContext::getInstance()->getUser()->getAttribute('loguse');

        $this->c = new Criteria();
        if ($filbandir=='S'){
            $this->sql='tsdefban.coddirec in (select coddirec from "SIMA_USER".segdirusu where loguse=\''.$loguse.'\')';
            $this->c->add(TsdefbanPeer::CODDIREC, $this->sql, Criteria :: CUSTOM);
        }
        $this->columnas = array(
            TsdefbanPeer :: NOMCUE => 'Nombre Cuenta',
            TsdefbanPeer :: NUMCUE => 'Nro. Cuenta',
            TsdefbanPeer::CODCTA => 'Cuenta Contable'
        );
    }

    public function Tsmovtra_tesmovtrabanTipos($params = array()) {

        $this->c = new Criteria();
        $this->c->add(TstipmovPeer::DEBCRE, 'D');

        $this->columnas = array(
            TstipmovPeer :: DESTIP => 'Descripción',
            TstipmovPeer :: CODTIP => 'Nro. Cuenta'
        );
    }

    public function Caprovee_Almsolcot() {
        $this->c = new Criteria();
        $this->c->add(CaproveePeer::ESTPRO, 'A');

        $this->columnas = array(
            CaproveePeer :: CODPRO => 'Código',
            CaproveePeer :: RIFPRO => 'Rif',
            CaproveePeer :: NOMPRO => 'Descripción',
        );
    }

    public function Fapropat_Fafactur() {
        $this->c = new Criteria();

        $this->columnas = array(
            FapropatPeer :: CODPROPAT => 'Código',
            FapropatPeer :: DESPROPAT => 'Descripción',
        );
    }

    public function Faprorad_Fafactur() {
        $this->c = new Criteria();

        $this->columnas = array(
            FaproradPeer :: CODPRORAD => 'Código',
            FaproradPeer :: DESPRORAD => 'Descripción',
        );
    }

    public function Nptipayu_Nomsolayueco() {
        $this->c = new Criteria();

        $this->columnas = array(
            NptipayuPeer :: CODTIPAYU => 'Código',
            NptipayuPeer :: DESTIPAYU => 'Descripción',
            NptipayuPeer :: CODPAR => 'Partida',
        );
    }

    public function Ingtiprub_cideftit($params = array()) {
        $this->c = new Criteria();
        $this->c->add(CiasiiniPeer::PERPRE, '00');
        $this->c->addJoin(CiasiiniPeer::CODPRE, CideftitPeer::CODPRE);

        $this->columnas = array(
            CiasiiniPeer :: CODPRE => 'Código',
            CiasiiniPeer :: NOMPRE => 'Nombre',
        );
    }

    public function Bncatest_Bieregmue() {
        $this->c = new Criteria();

        $this->columnas = array(
            BncatestPeer :: CEDEST => 'Cédula',
            BncatestPeer :: NOMAPEEST => 'Nombre',
            BncatestPeer :: CEDREP => 'Representante',
            BncatestPeer :: NOMAPEREP => 'Nombre',
        );
    }

    public function Bncatcomseg_Bieregmue() {
        $this->c = new Criteria();

        $this->columnas = array(
            BncatcomsegPeer :: CODCOM => 'Código',
            BncatcomsegPeer :: NOMCOM => 'Nombre',
            BncatcomsegPeer :: NOMPRO => 'Promotor',
        );
    }

    public function Bnregmue_Biesolpolcer($params = array()) {
        $this->c = new Criteria();
        if (count($params) > 0)
            $this->c->add(BnregmuePeer::CODUBI, $params[0]);
        $this->c->add(BnregmuePeer::STAMUE, 'A');

        $this->columnas = array(
            BnregmuePeer :: CODACT => 'Código Activo',
            BnregmuePeer :: CODMUE => 'Código Mueble',
            BnregmuePeer :: DESMUE => 'Descripción',
            BnregmuePeer :: MARMUE => 'Marca',
            BnregmuePeer :: MODMUE => 'Modelo',
            BnregmuePeer :: SERMUE => 'Serial',
            BnregmuePeer :: VALINI => 'Valor Inicial',
        );
    }

    public function Nphojint_codtit2($params = array()) {
        $this->c = new Criteria();
        $this->c->add(NphojintPeer :: STAEMP, 'A');
        $this->c->add(NphojintPeer :: TIEFUN, true);

        $this->columnas = array(
            NphojintPeer :: CEDEMP => 'Cedula',
            NphojintPeer :: CODEMP => 'Código',
            NphojintPeer :: NOMEMP => 'Nombre',
            NphojintPeer :: STAEMP => 'Estatus'
        );
    }

    public function Bnsolpolcer_Bieregpolcer($params = array()) {
        $this->c = new Criteria();

        $this->columnas = array(
            BnsolpolcerPeer :: NUMSOL => 'N° de Solicitud',
            BnsolpolcerPeer :: FECSOL => 'Fecha Solicitud',
            BnsolpolcerPeer :: TIPSOL => 'Tipo de Solicitud',
        );
    }

    public function Faantcli_Cobtransa($params = array()) {
        $this->c = new Criteria();
        if (count($params) > 0)
            $this->c->add(FaantcliPeer::CODCLI, $params[0]);
        $this->c->add(FaantcliPeer::RESANT, 0, Criteria::GREATER_THAN);

        $this->columnas = array(
            FaantcliPeer :: NROANT => 'N° de Anticipo',
            FaantcliPeer :: FECANT => 'Fecha',
            FaantcliPeer :: DESANT => 'Descripción',
            FaantcliPeer :: TOTANT => 'Monto',
        );
    }

    public function Casolart_Caregiones() {
        $this->c = new Criteria();

        $this->columnas = array(
            CaregionesPeer :: CODREG => 'Código',
            CaregionesPeer :: NOMREG => 'Nombre',
        );
    }

    public function Fapresup_Fapresup() {
        $this->c = new Criteria();

        $this->columnas = array(
            FapresupPeer::REFPRE => 'Número',
            FapresupPeer::DESPRE => 'Descripción',
            FapresupPeer::FECPRE => 'Fecha',
        );
    }

    public function Npestorg_Vianoemp() {
        $c = new Criteria;
        $mask = strlen(H::ObtenerFormato('Npdefgen', 'Fororg'));
        $this->c = new Criteria();
        $this->sql = "length(Codniv) = '" . $mask . "'";
        $this->c->add(NpestorgPeer :: CODNIV, $this->sql, Criteria :: CUSTOM);

        $this->columnas = array(
            NpestorgPeer :: CODNIV => 'Código',
            NpestorgPeer :: DESNIV => 'Descripción',
        );
    }

    public function Pagemiord_Hcregconhcm($params = array()) {
        $this->c = new Criteria();
        $sql = "caprovee.rifpro in (select rifpro from hcregconhcm where genop=true)";
        $this->c->add(CaproveePeer::RIFPRO, $sql, Criteria::CUSTOM);

        $this->columnas = array(
            CaproveePeer :: RIFPRO => 'Código',
            CaproveePeer :: NOMPRO => 'Nombre',
        );
    }

    public function Bncatcol_Bieregactmued($params = array()) {
        $this->c = new Criteria();

        $this->columnas = array(
            BncatcolPeer::CODCOL => 'Código',
            BncatcolPeer::DESCOL => 'Descripción',
        );
    }

    public function Bnpais_Bieregactmued($params = array()) {
        $this->c = new Criteria();

        $this->columnas = array(
            BnpaisPeer::CODPAI => 'Código',
            BnpaisPeer::NOMPAI => 'Descripción',
        );
    }

    public function Bnestado_Bieregactmued($params = array()) {
        $this->c = new Criteria();

        $this->columnas = array(
            BnestadoPeer::CODEST => 'Código',
            BnestadoPeer::NOMEST => 'Descripción',
        );
    }

    public function Bnmunicip_Bieregactmued($params = array()) {
        $this->c = new Criteria();
        if (count($params) > 0)
            $this->c->add(BnmunicipPeer::BNESTADO_CODEST, $params[0]);

        $this->columnas = array(
            BnmunicipPeer::CODMUN => 'Código',
            BnmunicipPeer::NOMMUN => 'Descripción',
        );
    }

    public function Bnparroq_Bieregactmued($params = array()) {
        $this->c = new Criteria();
        if (count($params) > 0)
            $this->c->add(BnparroqPeer::BNMUNICIP_CODMUN, $params[0]);

        $this->columnas = array(
            BnparroqPeer::CODPAR => 'Código',
            BnparroqPeer::NOMPAR => 'Descripción',
        );
    }

    public function Bnciudad_Bieregactmued($params = array()) {
        $this->c = new Criteria();
        if (count($params) > 0)
            $this->c->add(BnciudadPeer::BNMUNICIP_CODMUN, $params[0]);

        $this->columnas = array(
            BnciudadPeer::CODCIU => 'Código',
            BnciudadPeer::NOMCIU => 'Descripción',
        );
    }

    public function Bnclabie_Bieregactinmd($params = array()) {
        $this->c = new Criteria();

        $this->columnas = array(
            BnclabiePeer::CODCLA => 'Código',
            BnclabiePeer::DESCLA => 'Descripción',
        );
    }

    public function Bndefuso_Bieregactinmd($params = array()) {
        $this->c = new Criteria();

        $this->columnas = array(
            BndefusoPeer::CODUSO => 'Código',
            BndefusoPeer::DESUSO => 'Descripción',
        );
    }

    public function Bntiplug_Bieregactinmd($params = array()) {
        $this->c = new Criteria();

        $this->columnas = array(
            BntiplugPeer::CODTLU => 'Código',
            BntiplugPeer::DESTLU => 'Descripción',
        );
    }

    public function Bntipcob_Biesolsegcer($params = array()) {
        $this->c = new Criteria();

        $this->columnas = array(
            BntipcobPeer::CODCOB => 'Código',
            BntipcobPeer::DESCOB => 'Descripción',
        );
    }

    public function Contatit_Condetfluefe($params = array()) {
        $this->c = new Criteria();

        $this->columnas = array(
            ContatitPeer::CODTIT => 'Código',
            ContatitPeer::DESTIT => 'Descripción',
        );
    }

    public function Contabb_Condetfluefe() {
        $this->c = new Criteria();
        $this->c->add(ContabbPeer :: CARGAB, 'C');

        $this->columnas = array(
            ContabbPeer :: CODCTA => 'Código',
            ContabbPeer :: DESCTA => 'Descripción',
        );
    }

    public function Casolart_Almaprsolart() {
        $this->c = new Criteria();
        $this->c->add(CasolartPeer :: STAREQ, 'A');
        $sql = "(casolart.APRREQ<>'S' or casolart.APRREQ isnull) ";
        $this->c->add(CasolartPeer :: APRREQ, $sql, Criteria::CUSTOM);

        $this->columnas = array(
            CasolartPeer :: REQART => 'Código',
            CasolartPeer :: DESREQ => 'Descripción',
        );
    }

    public function Tsmovtra_tesmovtrabanTipos2($params = array()) {

        $this->c = new Criteria();
        $this->c->add(TstipmovPeer::DEBCRE, 'C');

        $this->columnas = array(
            TstipmovPeer :: DESTIP => 'Descripción',
            TstipmovPeer :: CODTIP => 'Nro. Cuenta'
        );
    }

    public function viamunicip_codmun($params = array()) {
        $this->c = new Criteria();
        if ($params)
            $this->c->add(ViamunicipPeer :: VIAESTADO_CODEST, $params[0]);

        $this->columnas = array(
            ViamunicipPeer :: CODMUN => 'Código',
            ViamunicipPeer :: NOMMUN => 'Nombre',
        );
    }

    public function Contabc_ConFinEliCom() {
        $this->c = new Criteria();
        $this->c->add(ContabcPeer :: STACOM,'N');
        $this->c->addAscendingOrderByColumn(ContabcPeer :: FECCOM);
        $this->c->addAscendingOrderByColumn(ContabcPeer :: NUMCOM);

        $this->columnas = array(
            ContabcPeer :: NUMCOM => 'Numero',
            ContabcPeer :: DESCOM => 'Descripcion',
            ContabcPeer :: FECCOM => 'Fecha',
        );
    }

    public function Precompro_Cpdoccom2($params = array()) {
        $this->c = new Criteria();
        $this->c->add(CpdoccomPeer::REFPRC,'N');
        $this->c->add(CpdoccomPeer::AFEDIS,'R');
        $this->c->addAscendingOrderByColumn(CpdoccomPeer::TIPCOM);
        $this->c->addAscendingOrderByColumn(CpdoccomPeer::NOMEXT);

        $this->columnas = array(
            CpdoccomPeer::TIPCOM => 'Tipo',
            CpdoccomPeer::NOMEXT => 'Descripción',
            CpdoccomPeer::REFPRC => 'Refiere'
        );
    }

    public function Viadefpri_codpri() {
        $this->c = new Criteria();
        $this->columnas = array(
            ViadefpriPeer :: CODPRI => 'Código',
            ViadefpriPeer :: DESPRI => 'Descripción',
        );
    }

    public function Tesdefcueban_coddirec() {
        $this->c = new Criteria();
        $this->columnas = array(
            CadefdirecPeer :: CODDIREC => 'Código',
            CadefdirecPeer :: DESDIREC => 'Descripción',
        );
    }

    public function CaOrdCom_Almaprordcom($params = array()) {
        $this->c = new Criteria();

        $this->c->add(CaordcomPeer::STAORD, 'N', Criteria :: NOT_EQUAL);
        $this->sql = "caordcom. staver='S' and Caordcom.ordcom not in (select refcom from cpcompro) ";
        $this->c->add(CaordcomPeer::ORDCOM, $this->sql, Criteria :: CUSTOM);
        $this->c->addAscendingOrderByColumn(CaordcomPeer::ORDCOM);

        $this->columnas = array(
            CaordcomPeer :: ORDCOM => 'Código',
            CaordcomPeer :: FECORD => 'Fecha',
            CaordcomPeer :: DESORD => 'Descripción'
        );
    }

    public function Preptocta_Cpasiini($params = array()) {
        //sql='select a.codpre as codigo, a.nompre as descripcion from cpasiini a, cpdefniv b where length(rtrim(a.codpre))= length(rtrim(b.forpre)) and a.perpre=�00� and a.mondis > 0 and UPPER(a.nompre) like upper(�%�) order by a.codpre';
        //$this->sql="casolart.unires in (select codcat from causuuni where loguse='".$loguse."')";
        //$c->add(CasolartPeer::UNIRES,$this->sql,Criteria::CUSTOM);

        $this->c = new Criteria();
        $this->sql = "length(cpasiini.codpre) = length(cpdefniv.forpre)";
        $this->c->add(CpdefnivPeer :: FORPRE, $this->sql, Criteria :: CUSTOM);
        $this->c->add(CpasiiniPeer :: PERPRE, '00');
        //$this->c->add(CpasiiniPeer :: MONDIS, 0, Criteria::GREATER_THAN);

        $this->c->addAscendingOrderByColumn(CpasiiniPeer::CODPRE);

        $this->columnas = array(
            CpasiiniPeer::CODPRE => 'Código Presupuestario',
            CpasiiniPeer::NOMPRE => 'Descripción'
        );
    }

    public function Caordcom_Almordcomv2($params=array())   {
        $this->c = new Criteria();
        $this->c->add(CaordcomPeer::STAORD, 'N', Criteria::NOT_EQUAL);

        $this->columnas = array(
            CaordcomPeer :: ORDCOM => 'Código',
            CaordcomPeer :: FECORD => 'Fecha',
            CaordcomPeer :: DESORD => 'Descripción'
        );
    }

    public function Viarensolvia_numsol() {
        $this->c = new Criteria();
        $this->c->add(ViasolviatraPeer::STAREN, 'N');

        $this->columnas = array(
            ViasolviatraPeer :: NUMSOL => 'Código',
            ViasolviatraPeer :: FECSOL => 'Fecha',
            ViasolviatraPeer :: DESSOL => 'Descripción',
        );
    }

    public function Cpcompro_preaprcom() {
        $filnoaprpre=H::getConfApp2('filnoaprpre', 'presupuesto', 'preaprcom');
        if ($filnoaprpre=='S')
           $this->sql = "cpcompro.stacom <>'N' and cpdoccom.reqaut = 'S' and ((cpcompro.APRCOM<>'S' and cpcompro.APRCOM<>'R') or cpcompro.APRCOM isnull)";
        else
          $this->sql = "cpcompro.stacom <>'N' and cpdoccom.reqaut = 'S' and cpcompro.REFCOM not in (select distinct refere from cpimpcau  where refere is not null and staimp!='N')";

        $this->c = new Criteria();
        $this->c->addJoin(CpcomproPeer :: TIPCOM, CpdoccomPeer :: TIPCOM);
        $this->c->add(CpcomproPeer :: STACOM, $this->sql, Criteria :: CUSTOM);


        $this->columnas = array(
            CpcomproPeer :: TIPCOM => 'Tipo',
            CpcomproPeer :: REFCOM => 'Referencia',
            CpcomproPeer :: FECCOM => 'Fecha',
            CpcomproPeer :: DESCOM => 'Descripción',
            CpcomproPeer :: CEDRIF => 'Ced/Rif Beneficiario',
        );
    }

    public function CaOrdCom_Almverordcom($params = array()) {
        $this->c = new Criteria();

        $this->c->add(CaordcomPeer::STAORD, 'N', Criteria :: NOT_EQUAL);
        $this->sql = "(caordcom. staver<>'S' or caordcom. staver is null) and Caordcom.ordcom not in (select refcom from cpcompro) ";
        $this->c->add(CaordcomPeer::ORDCOM, $this->sql, Criteria :: CUSTOM);
        $this->c->addAscendingOrderByColumn(CaordcomPeer::ORDCOM);

        $this->columnas = array(
            CaordcomPeer :: ORDCOM => 'Código',
            CaordcomPeer :: FECORD => 'Fecha',
            CaordcomPeer :: DESORD => 'Descripción'
        );
    }

    public function tsmovban_tesmoslib() {
        $this->c = new Criteria();
        $this->c->addAscendingOrderByColumn(TstipmovPeer::CODTIP);

        $this->columnas = array(
            TstipmovPeer :: CODTIP => 'Codigo',
            TstipmovPeer :: DESTIP => 'Descripcion',
            TstipmovPeer :: DEBCRE => 'Débito o Crédito'
        );
    }

        public function Fabancos_Cobtransa() {
        $this->c = new Criteria();

        $this->columnas = array(
            FabancosPeer::NOMBAN => 'Banco',
            FabancosPeer::ID => 'Id',
        );
    }

    public function rhplacur_nominscur($params=array()) {
        $this->c = new Criteria();
        $this->c->add(RhplacurPeer::CODCUR,$params[0]);

        $this->columnas = array(
            RhplacurPeer::CODPLACUR => 'Código',
            RhplacurPeer::DESPLACUR => 'Descripción',
        );
    }


    public function Cidefpar_Ingreging() {
        $this->c = new Criteria();

        $this->columnas = array(
            CidefparPeer::CODPAR => 'Código',
            CidefparPeer::DESPAR => 'Descripción',
        );
    }


        public function Tsdefcajchi_Tesmovsalcaj() {
        $this->c = new Criteria();

        $this->columnas = array(
            TsdefcajchiPeer::CODCAJ => 'Código',
            TsdefcajchiPeer::DESCAJ => 'Descripción',
        );
    }

        public function Cadefgar_Almordcom() {
        $this->c = new Criteria();

        $this->columnas = array(
            CadefgarPeer::CODGAR => 'Código',
            CadefgarPeer::DESGAR => 'Descripción',
        );
    }

    public function Npforasicaremp_Nptipemp() {
        $this->c = new Criteria();

        $this->columnas = array(
            NptipempPeer :: CODTIPEMP => 'Código',
            NptipempPeer :: DESTIPEMP => 'Descripción',
        );
    }

    public function Npbecnivins_Nomdefespprimas($params = array()) {

        $this->c = new Criteria();
        $this->c->addSelectColumn(NpbecnivinsPeer::CODBEC);
        $this->c->addSelectColumn("0 as CANUNITRI");
        $this->c->addSelectColumn("'' as CODNIV");
        $this->c->addSelectColumn("'' as ID");
        $this->c->addGroupByColumn(NpbecnivinsPeer::CODBEC);

        $this->columnas = array(
            NpbecnivinsPeer::CODBEC => 'Código BNI',
        );
    }

    public function Bnusobie_Bieregactmued() {
        $this->c = new Criteria();

        $this->columnas = array(
            BnusobiePeer :: CODUSOBIE => 'Código',
            BnusobiePeer :: DESUSOBIE => 'Descripción',
        );
    }

    public function Numche_Tscheemi($params = array()) {
        $this->c = new Criteria();
        $this->c->add(TscheemiPeer::STATUS,'F');
        $this->c->addAscendingOrderByColumn(TscheemiPeer::NUMCHE);

        $this->columnas = array(
            TscheemiPeer :: NUMCHE => 'Número de  Cheque',
            TscheemiPeer :: FECEMI => 'Fecha',
            TscheemiPeer :: CEDRIF => 'Beneficiario',
            TscheemiPeer :: MONCHE => 'Monto del Cheque'
        );
    }

    public function Opbenefi_Tscheemi() {
        $this->c = new Criteria();
        $this->c->add(TscheemiPeer::STATUS,'F');
        $this->c->addJoin(TscheemiPeer::CEDRIF,OpbenefiPeer::CEDRIF);
        $this->c->addAscendingOrderByColumn(OpbenefiPeer::CEDRIF);


        $this->columnas = array(
            OpbenefiPeer :: CEDRIF => 'C.I/RIF',
            OpbenefiPeer :: NOMBEN => 'Beneficiario'
        );
    }

    public function Nphojint_Npptocta($params = array()) {
        $this->c = new Criteria();
        $this->c->add(NphojintPeer :: STAEMP, 'E');

        $this->columnas = array(
            NphojintPeer :: CEDEMP => 'Cedula',
            NphojintPeer :: CODEMP => 'Código',
            NphojintPeer :: NOMEMP => 'Nombre',
            NphojintPeer :: STAEMP => 'Estatus'
        );
    }

    public function Npptocta_Npasicaremp($params = array()) {
        $this->c = new Criteria();
        $this->c->add(NpptoctaPeer :: APRPTO, 'A');
        $this->c->add(NpptoctaPeer :: PTOUSA, 'S',Criteria::NOT_EQUAL);

        $this->columnas = array(
            NpptoctaPeer :: NUMPTA => 'N° Punto de Cuenta',
            NpptoctaPeer :: FECPTA => 'Fecha',
            NpptoctaPeer :: CODEMP => 'Empleado',
        );
    }

    public function Bncatsudebip_Bieregmue($params = array()) {
        $this->c = new Criteria();

        $this->columnas = array(
            BncatsudebipPeer :: SUDEBIP => 'Cód. SUDEBIP',
            BncatsudebipPeer :: DESUDEBIP => 'Descripción',
        );
    }

    public function Faembarca_Fapresup($params = array()) {
        $this->c = new Criteria();

        $this->columnas = array(
            FaembarcaPeer :: CODEMB => 'Código',
            FaembarcaPeer :: NOMEMB => 'Nombre',
        );
    }

    public function Rhmotini_nomasicur($params = array()){
        $this->c = new Criteria();

        $this->columnas = array(
            RhmotiniPeer :: CODMOT => 'Código',
            RhmotiniPeer :: DESMOT => 'Nombre',
        );
    }

   public function Nomdefespnivorg_Npdefdep($params = array()){
        $this->c = new Criteria();
        $this->c->add(NpdefdepPeer::STADEP,'S');

        $this->columnas = array(
            NpdefdepPeer :: CODDEP => 'Código',
            NpdefdepPeer :: DESDEP => 'Nombre',
        );
    }

        public function Nomhojint_Npdefofi($params = array()){
        $this->c = new Criteria();

        $this->columnas = array(
            NpdefofiPeer :: CODOFI => 'Código',
            NpdefofiPeer :: DESOFI => 'Nombre',
        );
    }

    public function Facturacion_Fadefcla($params = array()){
        $this->c = new Criteria();

        $this->columnas = array(
            FadefclaPeer :: CODCLA => 'Código',
            FadefclaPeer :: DESCLA => 'Nombre',
        );
    }

    public function Facturacion_Fadefgru($params = array()){
        $this->c = new Criteria();

        $this->columnas = array(
            FadefgruPeer :: CODGRU => 'Código',
            FadefgruPeer :: DESGRU => 'Nombre',
        );
    }

    public function Caregart_Materiales($params = array()) {
        $longitud = $params[0];
        $this->c = new Criteria();
        $this->sql = "length(Codart) = '" . $longitud . "'"; //and tipart='M'";
        $this->c->add(CaregartPeer :: CODART, $this->sql, Criteria :: CUSTOM);

        $this->columnas = array(
            CaregartPeer :: CODART => 'Código',
            CaregartPeer :: DESART => 'Descripción',
        );
    }

    public function Caregart_Equipos($params = array()) {
        $longitud = $params[0];
        $this->c = new Criteria();
        $this->sql = "length(Codart) = '" . $longitud . "'"; //and tipart='E'";
        $this->c->add(CaregartPeer :: CODART, $this->sql, Criteria :: CUSTOM);

        $this->columnas = array(
            CaregartPeer :: CODART => 'Código',
            CaregartPeer :: DESART => 'Descripción',
        );
    }

    public function Nomdefcur_npinstructores($params=array()){
        $this->c = new Criteria();
        if (count($params)>0)
          if ($params[0]=='true')
            $this->c->add(NpinstructoresPeer::TIPPRO,'E');
          else
            $this->c->add(NpinstructoresPeer::TIPPRO,'I');

        $this->columnas = array(
            NpinstructoresPeer :: CEDPRO => 'Cédula',
            NpinstructoresPeer :: NOMPRO => 'Nombre',
        );
    }

    public function Facturacion_Fadefsed($params = array()){
        $this->c = new Criteria();

        $this->columnas = array(
            FadefsedPeer :: CODSED => 'Código',
            FadefsedPeer :: DESSED => 'Nombre',
        );
    }

    public function Facturacion_Facliper($params=array()){
        $this->c = new Criteria();
        if (count($params)>0)
            $this->c->add(FacliperPeer::CODPRO,$params[0]);

        $this->columnas = array(
            FacliperPeer :: NOMPER => 'Nombre',
            FacliperPeer :: TELPER => 'Teléfono',
        );
    }


    public function Cicatpre_Asignar() {
        $this->c = new Criteria();
        $mascara = H::getObtener_FormatoCategoriaIngresos();
        $mask = strlen($mascara);
        $this->c = new Criteria();
        $this->sql = "length(cicatpre.CodCat) = '" . $mask . "'";
        $categoriasusu = sfContext::getInstance()->getUser()->getAttribute('categoriasusu');
        if ($categoriasusu != '') {
            $aux = explode('*', $categoriasusu);
            for ($a = 0; $a < count($aux); $a++) {
                if ($a == 0)
                    $this->sql = $this->sql . " and (" . CicatprePeer::CODCAT . " like '" . $aux[$a] . "%' ";
                else if ($a == (count($aux) - 1))
                    $this->sql = $this->sql . " or " . CicatprePeer::CODCAT . " like '" . $aux[$a] . "%' ";
                else
                    $this->sql = $this->sql . " or " . CicatprePeer::CODCAT . " like '" . $aux[$a] . "%'";
            }
            $this->sql = $this->sql . ")";
        }
        $this->c->add(CicatprePeer :: CODCAT, $this->sql, Criteria :: CUSTOM);

        $this->columnas = array(
            CicatprePeer :: CODCAT => 'Código',
            CicatprePeer :: NOMCAT => 'Descripción',
        );
    }

    public function Nomina_Npuniads($params = array()){
        $this->c = new Criteria();
        if (count($params)>0) {
            $this->c->add(NpasouninivPeer::CODNIV,$params[0]);
            $this->c->addJoin(NpuniadsPeer :: CODUNIADS, NpasouninivPeer::CODUNIADS);
        }

        $this->columnas = array(
            NpuniadsPeer :: CODUNIADS => 'Código',
            NpuniadsPeer :: DESUNIADS => 'Descripción',
        );
    }

    public function Caregart_Servicios($params = array()) {
        $longitud = $params[0];
        $this->c = new Criteria();
        $this->sql = "length(Codart) = '" . $longitud . "' and tipo='S'";
        $this->c->add(CaregartPeer :: CODART, $this->sql, Criteria :: CUSTOM);

        $this->columnas = array(
            CaregartPeer :: CODART => 'Código',
            CaregartPeer :: DESART => 'Descripción',
        );
    }

    public function Mantenimiento_Mantipequ($params = array()){
        $this->c = new Criteria();

        $this->columnas = array(
            MantipequPeer :: CODTEQ => 'Código',
            MantipequPeer :: DESTEQ => 'Descripción',
        );
    }

    public function Mantenimiento_Manidegru($params = array()){
        $this->c = new Criteria();

        $this->columnas = array(
            ManidegruPeer :: CODIDE => 'Código',
            ManidegruPeer :: DESIDE => 'Descripción',
        );
    }

    public function Mantenimiento_Manclaequ($params = array()){
        $this->c = new Criteria();

        $this->columnas = array(
            ManclaequPeer :: CODCLA => 'Código',
            ManclaequPeer :: DESCLA => 'Descripción',
        );
    }

    public function Mantenimiento_Mantipali($params = array()){
        $this->c = new Criteria();

        $this->columnas = array(
            MantipaliPeer :: CODTAL => 'Código',
            MantipaliPeer :: DESTAL => 'Descripción',
        );
    }

    public function Mantenimiento_Mantiptra($params = array()){
        $this->c = new Criteria();

        $this->columnas = array(
            MantiptraPeer :: CODTTA => 'Código',
            MantiptraPeer :: DESTTA => 'Descripción',
        );
    }

    public function Mantenimiento_Mandeffab($params = array()){
        $this->c = new Criteria();

        $this->columnas = array(
            MandeffabPeer :: CODFAB => 'Código',
            MandeffabPeer :: DESFAB => 'Descripción',
        );
    }

    public function Mantenimiento_Mantipgar($params = array()){
        $this->c = new Criteria();

        $this->columnas = array(
            MantipgarPeer :: CODTGA => 'Código',
            MantipgarPeer :: DESTGA => 'Descripción',
        );
    }

    public function Mantenimiento_Manunimed($params = array()){
        $this->c = new Criteria();

        $this->columnas = array(
            ManunimedPeer :: CODUME => 'Código',
            ManunimedPeer :: DESUME => 'Descripción',
        );
    }

    public function Mantenimiento_Manestequ($params = array()){
        $this->c = new Criteria();

        $this->columnas = array(
            ManestequPeer :: CODEST => 'Código',
            ManestequPeer :: DESEST => 'Descripción',
        );
    }

    public function Mantenimiento_Manunipro($params = array()){
        $this->c = new Criteria();

        $this->columnas = array(
            ManuniproPeer :: CODUNI => 'Código',
            ManuniproPeer :: DESUNI => 'Descripción',
        );
    }

    public function Mantenimiento_Mantipcom($params = array()){
        $this->c = new Criteria();

        $this->columnas = array(
            MantipcomPeer :: CODTCO => 'Código',
            MantipcomPeer :: DESTCO => 'Descripción',
        );
    }

    public function Mantenimiento_Mansisope($params = array()){
        $this->c = new Criteria();

        $this->columnas = array(
            MansisopePeer :: CODSIS => 'Código',
            MansisopePeer :: DESSIS => 'Descripción',
        );
    }

    public function Mantenimiento_Caparfabart($params = array()) {
      $this->c = new Criteria();
      $this->c->addJoin(CaparfabartPeer :: CODART, CaregartPeer::CODART);
      $this->c->setDistinct();

      $this->columnas = array(
        CaparfabartPeer :: CODART => 'Código',
        CaregartPeer :: DESART => 'Descripción',
        CaparfabartPeer :: NUMPAR => 'Número de Parte',
        CaparfabartPeer :: CODFAB => 'Fabricante',
    );
    }

    public function Mantenimiento_Mangrutra($params = array()){
        $this->c = new Criteria();

        $this->columnas = array(
            MangrutraPeer :: CODGRU => 'Código',
            MangrutraPeer :: DESGRU => 'Descripción',
        );
    }

    public function Mantenimiento_Mantipman($params = array()){
        $this->c = new Criteria();

        $this->columnas = array(
            MantipmanPeer :: CODTMA => 'Código',
            MantipmanPeer :: DESTMA => 'Descripción',
        );
    }

    public function Mantenimiento_Manesttra($params = array()){
        $this->c = new Criteria();

        $this->columnas = array(
            ManesttraPeer :: CODEST => 'Código',
            ManesttraPeer :: DESEST => 'Descripción',
        );
    }

    public function Mantenimiento_Maninsseg($params = array()){
        $this->c = new Criteria();

        $this->columnas = array(
            ManinssegPeer :: CODINS => 'Código',
            ManinssegPeer :: DESINS => 'Descripción',
        );
    }


    public function Mantenimiento_Mansinfal($params = array()){
        $this->c = new Criteria();

        $this->columnas = array(
            MansinfalPeer :: CODSFA => 'Código',
            MansinfalPeer :: DESSFA => 'Descripción',
        );
    }

    public function Mantenimiento_Mandeffal($params = array()){
        $this->c = new Criteria();

        $this->columnas = array(
            MandeffalPeer :: CODDFA => 'Código',
            MandeffalPeer :: DESDFA => 'Descripción',
        );
    }

    public function Mantenimiento_Manregequ($params = array()){
        $this->c = new Criteria();

        $this->columnas = array(
            ManregequPeer :: NUMEQU => 'Número',
            ManregequPeer :: NOMEQU => 'Nombre',
        );
    }


    public function Mantenimiento_Manactest($params = array()){
        $this->c = new Criteria();

        $this->columnas = array(
            ManactestPeer :: CODACT => 'Número',
            ManactestPeer :: DESACT => 'Descripción',
        );
    }

    public function Mantenimiento_Mangrutre($params = array()){
        $this->c = new Criteria();

        $this->columnas = array(
            MangrutrePeer :: CODGRR => 'Código',
            MangrutrePeer :: DESGRR => 'Descripción',
        );
    }

    public function Mantenimiento_Mantiplub($params = array()){
        $this->c = new Criteria();

        $this->columnas = array(
            MantiplubPeer :: CODTLU => 'Código',
            MantiplubPeer :: DESTLU => 'Descripción',
        );
    }

    public function Mantenimiento_Mantarpro($params = array()){
        $this->c = new Criteria();

        $this->columnas = array(
            MantarproPeer :: CODTAR => 'Código',
            MantarproPeer :: DESTAR => 'Descripción',
        );
    }
    
    public function Almregart_Mancatmat($params = array()){
        $this->c = new Criteria();

        $this->columnas = array(
            MancatmatPeer :: NUMSOL => 'N° de Solicitud',
            MancatmatPeer :: UNISOL => 'Unidad Solicitante',
            MancatmatPeer :: NOMITE => 'Nombre Item',
            MancatmatPeer :: DESITE => 'Descripción Item',
        );
    }

    public function Mantenimiento_Mannumart($params = array()){
        $this->c = new Criteria();

        $this->columnas = array(
            MannumartPeer :: CODART => 'Código',
            MannumartPeer :: DESART => 'Descripción',
        );
    }

    
    public function Mantenimiento_Manestord($params = array()){
        $this->c = new Criteria();

        $this->columnas = array(
            ManestordPeer :: CODSOR => 'Código',
            ManestordPeer :: DESSOR => 'Descripción',
        );
    }

    public function Mantenimiento_Mancaufal($params = array()){
    $this->c = new Criteria();

    $this->columnas = array(
        MancaufalPeer :: CODCFA => 'Código',
        MancaufalPeer :: DESCFA => 'Descripción',            
    ); 
    }

    public function Mantenimiento_Manordtra($params = array()){
    $this->c = new Criteria();

    $this->columnas = array(
        ManordtraPeer :: NUMORD => 'Referencia',
        ManordtraPeer :: DESORD => 'Descripción',            
    ); 
    }

    public function Mantenimiento_Mansinfal2($params = array()){
    $this->c = new Criteria();
    $this->c->add(MansinfalPeer::CODSIS,$params[0]);

    $this->columnas = array(
        MansinfalPeer :: CODSFA => 'Código',
        MansinfalPeer :: DESSFA => 'Descripción',            
    ); 
    }

    public function Mantenimiento_Mandeffal2($params = array()){
        $this->c = new Criteria();
        $this->c->add(MandeffalPeer::CODSFA,$params[0]);
 
         $this->columnas = array(
            MandeffalPeer :: CODDFA => 'Código',
            MandeffalPeer :: DESDFA => 'Descripción',            
        ); 
    }

  public function Mantenimiento_Mancaufal2($params = array()){
    $this->c = new Criteria();
    $this->c->add(MancaufalPeer::CODDFA,$params[0]);

    $this->columnas = array(
        MancaufalPeer :: CODCFA => 'Código',
        MancaufalPeer :: DESCFA => 'Descripción',            
    );   
   } 

   public function Nomina_Nptipgas($params = array()){
    $this->c = new Criteria();

    $this->columnas = array(
        NptipgasPeer :: CODTIPGAS => 'Código',
        NptipgasPeer :: DESTIPGAS => 'Descripción',            
    );   
   }      

   public function Compras_Canivconsnc($params = array()){
    $this->c = new Criteria();

    $this->columnas = array(
        CanivconsncPeer :: CODNIV => 'Código',
        CanivconsncPeer :: DESNIV => 'Descripción',            
    );   
   }

   public function Protartra_Faordtra($params = array()){
    $this->c = new Criteria();
    $this->c->add(FaordtraPeer::RECORDTRA,'S');

    $this->columnas = array(
        FaordtraPeer :: REFORD => 'Código',
        FaordtraPeer :: DESORD => 'Descripción',            
    );   
   } 

       public function Personal_Nphojint($params = array()) {

        $this->c = new Criteria();
        $this->c->add(NpasicarempPeer :: CODCAR, $params[0]);
        $this->c->add(NpasicarempPeer :: STATUS, 'V');
        $this->c->addJoin(NphojintPeer :: CODEMP, NpasicarempPeer :: CODEMP);

        $this->columnas = array(
            NphojintPeer :: CODEMP => 'Codigo',
            NphojintPeer :: NOMEMP => 'Nombre',
            NphojintPeer :: STAEMP => 'Estatus'
        );
    }


}
?>

