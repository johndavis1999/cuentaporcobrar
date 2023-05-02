<?php
// Incluimos el archivo que contiene la clase controladorConvenio
require_once("c://xampp/htdocs/cuentasporcobrar/controller/controladorConvenio.php");
// Creamos un objeto de la clase controladorConvenio
$obj = new controladorConvenio();
$convValues = $obj->getConvenio($_GET['id_convenio']);
$convCuotas = $obj->getConvenioCuotas($_GET['id_convenio']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CUENTAS POR COBRAR</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <!-- Esta seccion es el navbar se uso bootstrap para optimizar el diseño y añadir los desplegables-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary" aria-label="Offcanvas navbar large">
        <div class="container-fluid">

            <a href="/cuentasporcobrar/index.php" class="d-flex align-items-center text-dark text-decoration-none">
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
    <div class=" text-center">
        
        <h1>Editar convenio #<?= $convValues['id_convenio'] ?></h1>
    </div>
    <div class="">
        <!-- Se muestra el número de factura correspondiente -->
        <h4 class="mb-3">Info Factura relacionada: Fact. #<?= $convValues['num_fact'] ?></h4>
        <!-- Botón para actualizar cuotas -->
        <!-- Formulario para agregar convenio -->
        <form class="" action="addconvenio.php" method="POST">
            <!-- Se agrega el número de factura correspondiente como un input oculto -->
            <input type="hidden" name="num_fact" value="<?= $convValues['num_fact'] ?>">
            <div class="row">
                <div class="col-4">
                    <!-- Se muestra el nombre del asesor de cobranzas asignado -->
                    <div class="mb-3">
                        <label for="firstName" class="form-label">Asesor Cobranzas asignado: </label>
                        <input type="text" name="" class="form-control" value="Miguel Salvatierra" readonly>
                        <!-- Se agrega el id del asesor de cobranzas como un input oculto -->
                        <input type="hidden" name="id_asesor" class="form-control" value="1" readonly>
                    </div>
                    <!-- Se muestra el nombre del cliente correspondiente -->
                    <div class="mb-3">
                        <label for="firstName" class="form-label">Cliente:</label>
                        <input type="text" class="form-control" value="<?php echo $convValues['cliente_nombre']  . ' ' .$convValues['cliente_apellido']?>" readonly>
                        <!-- Se agrega el id del cliente correspondiente como un input oculto -->
                        <input type="hidden" name="id_cliente" value="<?=$convValues['id_cliente'] ?>">
                    </div>
                    <!-- Se muestra el valor total de la factura correspondiente -->
                    <div class="mb-3">
                        <label for="firstName" class="form-label">Total facturado:</label>
                        <input type="text" class="form-control" value="$<?php echo $convValues['total']?>" id="<?php echo $convValues['total']?>" readonly>
                        <!-- Se agrega el valor total de la factura como un input oculto -->
                        <input type="hidden" name="total" value="<?=$convValues['total'] ?>">
                        <input type="hidden" name="cuotas" value="<?=$convValues['cuotas'] ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="CodigoCliente" class="col-lg-3 col-form-label">Estado:</label>
                        <div class="">
                            <select class="form-select" name="estado" id="estado" aria-label="Disabled select example" required>
                                <option value="1" <?= $convValues['estado']=='1'? 'selected' : ''?>>Pagado</option>
                                <option value="2" <?= $convValues['estado']=='2'? 'selected' : ''?>>Pago Parcial</option>
                                <option value="3" <?= $convValues['estado']=='3'? 'selected' : ''?>>Pendiente</option>
                                <option value="4" <?= $convValues['estado']=='4'? 'selected' : ''?>>Incobrable</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="text-center">
                        <h4>Cuotas Conveio</h4>
                        <h5>Cuotas pagadas: <?php echo $convValues['cantidad_cuotas_pagadas'] ?></h5>
                        <?php $pendientes =  $convValues['cuotas'] - $convValues['cantidad_cuotas_pagadas'] ?></h5>
                        <h5>Cuotas pendientes: <?php echo $pendientes ?></h5>
                    </div>
                    <div class="row">
                        <!-- Se muestra una tabla para las cuotas del convenio -->
                        <table class="table table-bordered table-hover" id="convenioCuotas">
                            <thead>
                                <th width="15%">No. Cuota</th>
                                <th width="20%">Valor cuota</th>
                                <th width="20%">Valor pagado</th>
                            </thead>
                            <small id="mensaje-error" style="color:red;">Importante; debe genear minimo un cuota para poder registrar el convenio</small>
                            <?php
                            // Iteramos a través de la lista de elementos de la orden
                            
                            $count = 0;
                            foreach ($convCuotas as $convCuota) {
                                $count++;
                                $num_cuota_convenio = $convCuota["num_cuota_convenio"];
                                $valor_pagado = $convCuota["valor_pagado"];
                                $valor_cuota = $convCuota["valor_cuota"];
                            ?>
                            <tr>
                                <td><input type="text" value="<?php echo $num_cuota_convenio;?>" name="num_cuota_convenio[]" value='+i+' id="num_cuota_convenio_'+i+'" class="form-control" autocomplete="off" readonly></td>
                                <!-- Creamos un campo de entrada para la cantidad de producto -->
                                <td><input type="number" value="<?php echo $valor_pagado;?>" name="valor_pagado[]" id="valor_pagado_<?php echo $count; ?>" class="form-control valor_pagado" autocomplete="off" pattern="[0-9]" min="1" step="0.01" max="<?= $valor_cuota?>" ></td>
                                <td><input type="number" value="<?= $valor_cuota;?>" name="valor_cuota[]" id="valor_cuota_<?php echo $count; ?>" class="form-control valor_cuota" autocomplete="off" readonly></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div> 
                <div class=" text-center">
                    <button type="submit"  class="btn btn-primary">Guardar convenio</button>
                </div>
            </div>
        </form>
    </div>

</body>
 
</html>

<script>
    $(document).ready(function(){  
        // Se cuenta el número de filas existentes al cargar la página
        var count = $(".itemRow").length;
        $(document).on('click', '#actualizarCuotas', function() {
            // Al hacer clic en el botón con id "actualizarCuotas", se aumenta el contador en uno
            count++;
            // Se remueven todas las filas de la tabla con id "convenioCuotas" para reemplazarlas con nuevas filas
            $("#convenioCuotas tbody tr").remove();
            // Se lee el valor del input de tipo número y se convierte a un número entero utilizando la función parseInt
            var cuotas = parseInt($('input[type=number]').val());
            // Se obtiene el valor total de la factura mediante una variable PHP pasada al JavaScript utilizando la función json_encode
            var total = <?= json_encode($factura['total']) ?>;
            var htmlRows = '';
            // Se crea un ciclo for para crear tantas filas como cuotas se indique
            for (var i = 1; i <= cuotas; i++) {
                // Se calcula el valor de la cuota dividiendo el valor total entre el número de cuotas y redondeando a dos decimales con la función toFixed
                var valorCuota = (total / cuotas).toFixed(2);

                // Se agregan los inputs necesarios a cada fila, incluyendo un input de tipo texto para el número de cuota (que se muestra como texto), un input de tipo número para el valor de la cuota (que se muestra como número), un input de tipo texto para el valor pagado (que se deja vacío para ser llenado posteriormente), y un input de tipo número para el estado de la cuota (que también se deja vacío)
                htmlRows += '<tr>';
                htmlRows += '<td><input type="text" name="num_cuota_convenio[]" value='+i+' id="num_cuota_convenio_'+i+'" class="form-control" autocomplete="off" readonly></td>';
                htmlRows += '<td><input type="number" name="valor_cuota[]" id="valor_cuota_'+i+'"  value="' + valorCuota + '" class="form-control valor_cuota" autocomplete="off" readonly></td>';
                htmlRows += '<td><input type="number" name="valor_pagado[]" id="valor_pagado_'+i+'" class="form-control" autocomplete="off" pattern="[0-9]" min="1" max="' + valorCuota + '"></td>';
                htmlRows += '</tr>';

            }
            // Se agrega el contenido generado a la tabla con id "convenioCuotas"
            $('#convenioCuotas').append(htmlRows);

                // Agregamos la validación para asegurarnos de que el valor pagado no exceda el valor de la cuota
                var valorPagadoInput = document.getElementById('valor_pagado_'+i);
                var valorCuotaInput = document.getElementById('valor_cuota_'+i);

                valorPagadoInput.addEventListener('blur', function() {
                    var valorPagado = parseFloat(valorPagadoInput.value);
                    var valorCuota = parseFloat(valorCuotaInput.value);
                    if (valorPagado > valorCuota) {
                        alert('El valor pagado no puede ser mayor que el valor de la cuota.');
                        valorPagadoInput.value = '';
                        valorPagadoInput.focus();
                    }
                });
        });
    });	
</script>

    