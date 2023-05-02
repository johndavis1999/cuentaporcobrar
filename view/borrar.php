<?php
    // Se requiere el archivo del controlador
    require_once("c://xampp/htdocs/cuentasporcobrar/controller/controladorConvenio.php");
    // Se crea una nueva instancia del controlador
    $obj = new controladorConvenio();
    // Se llama a la función deleteConvenio() del controlador y se pasa el parámetro id_convenio
    //$obj->deleteConvenio($_GET['id_convenio']);
    $obj->deleteLogico($_GET['id_convenio']);
?>
