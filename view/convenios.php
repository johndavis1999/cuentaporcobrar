<?php
// Incluimos el archivo que contiene la clase controladorConvenio
require_once("c://xampp/htdocs/cuentasporcobrar/controller/controladorConvenio.php");
// Creamos un objeto de la clase controladorConvenio
$obj = new controladorConvenio(); 
// Obtenemos un arreglo con todos los convenios usando el método index() de la clase controladorConvenio
$convenios = $obj->index();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!-- Agregar la biblioteca de iconos de Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/bootstrap-icons.min.css" integrity="sha512-8j6U1b6u+7GGNNJp6u9f5C5E18m5mDQ2e6G1M7yU6bDEuV7WeC6i9u5RY5K5E5uVwQGirb5uOblE2SqrKjiz3A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Esta seccion es el navbar se uso bootstrap para optimizar el diseño y añadir los desplegables-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary" aria-label="Offcanvas navbar large">
        <div class="container-fluid">

            <a href="../index.php" class="d-flex align-items-center text-dark text-decoration-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                </svg>
                <span class="fs-4">SISTEMA CUENTAS POR COBRAR</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar2">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasNavbar2" aria-labelledby="offcanvasNavbar2Label">

                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbar2Label">Menú</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </nav>

    <h1 class="divider"></h1>
    <!-- Generar convenio -->
    <div class="cabecera-doc card mb-4 rounded-3 shadow-sm">
      <div class="row">
        <div class="card-header py-3">
          <h3 class="my-0 fw-build"> Buscar Convenios creados</h3>
        </div>
        <h1 class="divider"></h1>
        <div>
            <!-- Creamos una tabla para mostrar los convenios -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>N. Convenio</th>
                        <th>Asesor</th>
                        <th>Factura</th>
                        <th>Cliente</th>
                        <th>Total convenio</th>
                        <th>Cant. Cuotas</th>
                        <th>Estado</th>
                        <th>Opc.</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($convenios): ?>
                    <?php
                    // Iteramos sobre el arreglo de convenios y mostramos la información en cada fila de la tabla
                    foreach ($convenios as $convenio) {
                    ?>
                    <tr>
                        <td><?php echo $convenio['id_convenio'] ?></td>
                        <td><?php echo $convenio['asistente_nombre'] . ' ' . $convenio['asistente_apellido']?></td>
                        <td><?php echo $convenio['num_fact'] ?></td>
                        <td><?php echo $convenio['cliente_nombre'] . ' ' . $convenio['cliente_apellido']?></td>
                        <td>$<?php echo $convenio['total'] ?></td>
                        <td><?= 'Pagadas: ' . $convenio['cantidad_cuotas_pagadas'] . '/'. $convenio['cuotas'] ?></td>
                        <td><?php  
                                    if($convenio['estado']==1){
                                        echo "Pagado";
                                    }elseif($convenio['estado']==2){
                                        echo "Pago parcial";
                                    }elseif($convenio['estado']==3){
                                        echo "Pendiente";
                                    }elseif($convenio['estado']==4){
                                        echo "Incobrable";
                                    }
                        ?></td>
                        <td>
                            <!-- Botón para actualizar el convenio. Al hacer clic en este botón se dispara un evento JavaScript que se encarga de mostrar el formulario para actualizar el convenio -->
                            <a class="btn btn-primary btn-sm botonimprimir" role="button" href="edit_conv.php?id_convenio=<?=$convenio["id_convenio"]?>">Actualizar</a>
                            <a class="btn btn-success btn-sm botonimprimir" role="button" href="imprimir.php?id_convenio=<?=$convenio["id_convenio"]?>">Generar pdf</a>
                            <!-- Botón para eliminar el convenio. Al hacer clic en este botón se muestra un modal con un mensaje de confirmación antes de eliminar el convenio -->
                            <button type="button" class="btn btn-danger btn-sm botonborrar" data-bs-toggle="modal" data-bs-target="#id_convenio<?=$convenio['id_convenio']?>" id="<?= $convenio["id_convenio"]?>">
                                Eliminar
                            </button>
                            <!-- ModalConfirmarBorrar -->
                            <!-- Este es el modal que se muestra al hacer clic en el botón de eliminar. Tiene un mensaje de confirmación y dos botones: uno para confirmar y otro para cancelar la operación -->
                            <div class="modal fade"  id="id_convenio<?=$convenio['id_convenio']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" style="max-width: 600px" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1>¿Desea borrar el conveio #<?=$convenio['id_convenio']?>?</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="borrar.php?id_convenio=<?= $convenio['id_convenio']?>" class="btn btn-success">Confirmar</a>
                                            <button type="button" data-bs-dismiss="modal" class="btn btn-success">Cancelar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="12" class="text-center">No hay bolo</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
      </div>
    </div>
</body>
</html>