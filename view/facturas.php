<?php
    // Se incluye el archivo ctrlFactura.php para poder utilizar la clase controladorFactura
    require_once("c://xampp/htdocs/cuentasporcobrar/controller/ctrlFactura.php");

    // Se crea una instancia de la clase controladorFactura
    $obj = new controladorFactura();

    // Se llama al método index de la instancia creada, que devuelve todas las facturas registradas
    $facturas = $obj->index();
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
    <div class="cabecera-doc card mb-4 rounded-3 shadow-sm">
      <div class="row">
        <div class="card-header py-3">
          <h3 class="my-0 fw-build"> Buscar Facturas Emitidas</h3>
        </div>
        <h1 class="divider"></h1>
        <div>
            <!-- Se crea una tabla para mostrar las facturas -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Factura</th>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>F. Pago</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($facturas): ?>
                        <?php
                        // Se recorren todas las facturas obtenidas y se muestra la información de cada una en la tabla
                        foreach ($facturas as $factura) {
                        ?>
                        <tr>
                            <!-- Se muestra el número de la factura -->
                            <td><?php echo $factura['num_fact'] ?></td>
                            <!-- Se muestra el nombre y apellido del cliente asociado a la factura -->
                            <td><?php echo $factura['c_nombre'] . ' ' . $factura['c_apellido']?></td>
                            <!-- Se muestra la fecha y hora en que se registró la factura -->
                            <td><?php echo $factura['fechahora'] ?></td>
                            <!-- Se muestra el total de la factura -->
                            <td>$<?php echo $factura['total'] ?></td>
                            <!-- Se muestra el método de pago utilizado para la factura -->
                            <td><?php echo $factura['metodo'] ?></td>
                            <!-- Se muestra un botón para crear un convenio de pago si el método de pago es 3 (crédito) -->
                            <td class="text-center">
                                <?php 
                                // Si el método de pago es crédito (valor 3), se muestra el botón para crear un convenio de pago
                                if($factura['metodo_pago']==3){
                                ?>
                                    <a type="button" class="btn btn-primary btn-sm botonborrar" id="<?= $factura["num_fact"]?>" href="crear.php?num_fact=<?=$factura["num_fact"]?>">
                                        Crear convenio
                                    </a>
                                <?php
                                } 
                                // Si el método de pago no es crédito, se muestra "N/A"
                                else{
                                    echo 'N/A';
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    <?php else: ?>
                        <!-- Si no hay facturas registradas, se muestra un mensaje indicándolo -->
                        <tr>
                            <td colspan="12" class="text-center">No hay facturas registradas</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
      </div>
    </div>
</body>
</html>