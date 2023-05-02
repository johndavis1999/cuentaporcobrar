<?php
    // Se requiere el archivo que contiene la clase controladorConvenio
    require_once("c://xampp/htdocs/cuentasporcobrar/controller/controladorConvenio.php");
    // Se instancia el objeto controladorConvenio
    $obj = new controladorConvenio();
    // Se obtienen los datos enviados por el método POST
    $id_asesor = $_POST['id_asesor'];
    $num_fact = $_POST['num_fact'];
    $id_cliente = $_POST['id_cliente'];
    $total = $_POST['total'];
    $cuotas = $_POST['cuotas'];
    $estado = $_POST['estado'];
    // Se llama al método guardarConvenio() del objeto controladorConvenio para guardar la información del convenio en la base de datos
    $obj->guardarConvenio($id_asesor, $num_fact, $id_cliente, $total, $cuotas, $estado);
?>