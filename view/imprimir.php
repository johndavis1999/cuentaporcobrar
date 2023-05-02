<?php
require_once("c://xampp/htdocs/cuentasporcobrar/controller/controladorConvenio.php");
// Creamos un objeto de la clase controladorConvenio
$obj = new controladorConvenio(); 
$convValues = $obj->getConvenio($_GET['id_convenio']);
$convCuotas = $obj->getConvenioCuotas($_GET['id_convenio']);


$output = '';
$output .= '<table width="100%" border="1" cellpadding="5" cellspacing="0">
	<tr>
	<td colspan="2" align="center" style="font-size:18px"><b>Convenio</b></td>
	</tr>
	<tr>
	<td colspan="2">
	<table width="100%" cellpadding="5">
	<tr>
	<td width="65%">
	REALIZADO,<br />
	<b>Convenio realizado a:</b><br />
	Cliente : ' . $convValues['cliente_nombre']  . ' ' .$convValues['cliente_apellido'] .' <br /> 
	Telefono : ' . $convValues['cliente_telefono'] . '<br />
	</td>
	<td width="70%">         
	Convenio no. : #' . $convValues['id_convenio'] . '<br />
	Fecha : ' . $convValues['fecha'] . '<br />
	</td>
	</td>
	<td width="70%">         
	Valor convenio : ' . '$' . $convValues['total'] . '<br />
	Total cuotas : ' . '' . $convValues['cuotas'] . '<br />
	</td>
	</tr>
	</table>
	<br />
	<table width="100%" border="1" cellpadding="5" cellspacing="0">
	<tr>
	<th align="left"># Cuota</th>
	<th align="left">Valor pagados</th>
	<th align="left">Total cuota</th>
	<th align="left">Estado</th> 
	</tr>';
$count = 0;
foreach ($convCuotas as $convCuota) {
	$count++;
	$output .= '
	<tr>
	<td align="left">' . $convCuota["num_cuota_convenio"] . '</td>
	<td align="left">' . '$' . $convCuota["valor_pagado"] . '</td>
	<td align="left">' . '$'. $convCuota["valor_cuota"] . '</td>
	<td align="left">' . '' .  ($convCuota["estado"] == 1 ? "Pagado" : "Pendiente") . '</td>
	</tr>';
}

$output .= '
	</table>
	</td>
	</tr>
	</table>';
// create pdf of invoice	
$invoiceFileName = 'Cuenta por corbrar' . $convValues['id_convenio'] . '.pdf';
require_once '../dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml(html_entity_decode($output));
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream($invoiceFileName, array("Attachment" => false));
