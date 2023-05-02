<?php
    // Incluimos el archivo que contiene la clase controladorConvenio
    require_once("c://xampp/htdocs/cuentasporcobrar/controller/controladorConvenio.php");
    // Creamos un objeto de la clase controladorConvenio
    $obj = new controladorConvenio(); 
    $id_convenio = $_POST['id_convenio'];
    $id_asesor = $_POST['id_asesor'];;
    $num_fact = $_POST['num_fact'];
    $id_cliente = $_POST['id_cliente'];
    $total = $_POST['total'];
    $cuotas = $_POST['cuotas'];
    $estado = $_POST['estado'];
    $obj->updateConv($id_convenio, $id_asesor, $num_fact, $id_cliente, $total, $cuotas, $estado);