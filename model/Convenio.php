<?php
    class Convenio{
        private $PDO; // Objeto PDO que se utilizará para conectarse a la base de datos.
        private $id_asesor; // Identificador del asesor que lleva el convenio.
        private $num_fact; // Número de factura asociado al convenio.
        private $id_cliente; // Identificador del cliente que ha suscrito el convenio.
        private $total; // Total del convenio, es decir, la suma de todas las cuotas.
        private $cuotas; // Número total de cuotas en las que se ha dividido el convenio.
        private $estado; // Estado de la cuota (por ejemplo, si está pagada o no).
        
        // Atributos para las cuotas:
        private $id_convenio; // Identificador del convenio al que pertenece la cuota.
        private $num_cuota_convenio; // Número de cuota en el convenio.
        private $valor_pagado; // Valor total pagado por el cliente hasta el momento.
        private $valor_cuota; // Valor de cada cuota.

        public function __construct()
        {
            require_once("c://xampp/htdocs/cuentasporcobrar/conexion/conexion.php"); // Se requiere el archivo que contiene la clase "conexion".
            $con = new conexion(); // Se crea un objeto de la clase "conexion".
            $this->PDO = $con->conexion(); // Se obtiene una conexión PDO y se asigna a la variable $PDO.
        }

        /*public function index(){
            // Se prepara una consulta SQL que selecciona todos los campos de la tabla "convenio", así como los nombres y apellidos del cliente y del asistente de cobranza, obtenidos mediante un LEFT JOIN con las tablas "cliente" y "asistente_cobranza".
            $statement = $this->PDO->prepare("SELECT convenio.*, cliente.nombre AS cliente_nombre, cliente.apellido AS cliente_apellido,
                                                    asistente_cobranza.nombre AS asistente_nombre, 
                                                    asistente_cobranza.apellido AS asistente_apellido 
                                                    FROM convenio 
                                                    LEFT JOIN cliente ON convenio.id_cliente = cliente.id_cliente 
                                                    LEFT JOIN asistente_cobranza ON convenio.id_asesor = asistente_cobranza.id 
                                                    ORDER BY convenio.id_convenio DESC;");
            
            // Si se ejecuta la consulta sin errores, se devuelve un array con todas las filas del resultado.
            // Si ocurre un error, se devuelve false.
            return ($statement->execute()) ? $statement->fetchAll() : false;    
        }*/
        public function index(){
            $statement = $this->PDO->prepare("SELECT convenio.*, cliente.nombre AS cliente_nombre, cliente.apellido AS cliente_apellido,
                                                asistente_cobranza.nombre AS asistente_nombre, 
                                                asistente_cobranza.apellido AS asistente_apellido 
                                                FROM convenio 
                                                LEFT JOIN cliente ON convenio.id_cliente = cliente.id_cliente 
                                                LEFT JOIN asistente_cobranza ON convenio.id_asesor = asistente_cobranza.id 
                                                WHERE convenio.estado != 100
                                                ORDER BY convenio.id_convenio DESC;");
            
            // Si se ejecuta la consulta sin errores, se devuelve un array con todas las filas del resultado.
            // Si ocurre un error, se devuelve false.
            if($statement->execute()) {
                $resultados = $statement->fetchAll();
                
                // Para cada resultado, obtenemos la cantidad de cuotas pagadas y lo agregamos como un nuevo elemento al array.
                foreach ($resultados as $i => $convenio) {
                    $cantidad_cuotas_pagadas = $this->contarcuotaspagadas($convenio['id_convenio']);
                    $resultados[$i]['cantidad_cuotas_pagadas'] = $cantidad_cuotas_pagadas;
                }
                
                return $resultados;
            } else {
                return false;
            }
        }
        

        public function contarcuotaspagadas($id_convenio){
            $statement = $this->PDO->prepare("SELECT COUNT(*) FROM cuotas_convenio WHERE id_convenio = :id_convenio AND valor_cuota = valor_pagado;");
            $statement->bindParam(':id_convenio', $id_convenio, PDO::PARAM_INT);
                    
            // Si se ejecuta la consulta sin errores, se devuelve la cantidad de filas que cumplen con las condiciones.
            // Si ocurre un error, se devuelve false.
            return ($statement->execute()) ? $statement->fetchColumn() : false;    
        }
        
        
        
        public function guardarConvenio($POST) {
            // Se obtienen los datos del formulario y se asignan a las propiedades del objeto Convenio.
            $this->id_asesor = $POST['id_asesor'];
            $this->num_fact = $POST['num_fact'];
            $this->id_cliente = $POST['id_cliente'];
            $this->total = $POST['total'];
            $this->cuotas = $POST['cuotas'];
            $this->estado = $POST['estado'];
        
            // Se prepara una consulta SQL que inserta un nuevo registro en la tabla "convenio" con los valores correspondientes.
            $stament = $this->PDO->prepare("INSERT INTO convenio (id_asesor, num_fact, id_cliente, total, cuotas, estado) 
                        VALUES (:id_asesor, :num_fact, :id_cliente, :total, :cuotas, :estado)");
            $stament->bindParam(':id_asesor', $this->id_asesor);
            $stament->bindParam(':num_fact', $this->num_fact);
            $stament->bindParam(':id_cliente', $this->id_cliente);
            $stament->bindParam(':total', $this->total);
            $stament->bindParam(':cuotas', $this->cuotas);
            $stament->bindParam(':estado', $this->estado);
            $stament->execute();
        
            // Se obtiene el ID del registro recién insertado.
            $lastInsertId = $this->PDO->lastInsertId();
        
            // Se llama a la función "guardarCuotaConvenio" para insertar las cuotas correspondientes a este convenio.
            $this->guardarCuotaConvenio($lastInsertId, $POST);
        
            // Se devuelve el ID del registro insertado.
            return $lastInsertId;
        }
        
        private function guardarCuotaConvenio($lastInsertId, $POST) {
            
            // Ciclo que recorre todas las cuotas del convenio
            for ($i = 0; $i < count($POST['num_cuota_convenio']); $i++) {
                
                // Se prepara el statement para insertar los datos de una cuota en la tabla cuotas_convenio
                $statement = $this->PDO->prepare("INSERT INTO cuotas_convenio (id_convenio, num_cuota_convenio, valor_pagado, valor_cuota) 
                                VALUES (:id_convenio, :num_cuota_convenio, :valor_pagado, :valor_cuota)");
                
                // Se asignan los valores a los parámetros del statement
                $statement->bindParam(':id_convenio', $lastInsertId);
                $statement->bindParam(':num_cuota_convenio', $POST['num_cuota_convenio'][$i]);
                $statement->bindParam(':valor_pagado', $POST['valor_pagado'][$i]);
                $statement->bindParam(':valor_cuota', $POST['valor_cuota'][$i]);
                
                // Se ejecuta el statement para insertar los datos de la cuota en la tabla cuotas_convenio
                $statement->execute();
            }
        }

        // Función encargada de eliminar un convenio de la base de datos, dado su id
        public function deleteConvenio($id_convenio){
            require_once("c://xampp/htdocs/cuentasporcobrar/conexion/conexion.php");
            $con = new conexion();
            $PDO = $con->conexion();

            // Preparación de la consulta SQL para eliminar el convenio
            $stament = $PDO->prepare("DELETE FROM convenio WHERE id_convenio = :id_convenio");
            $stament->bindParam(":id_convenio",$id_convenio);
            
            // Ejecución de la consulta para eliminar el convenio
            if ($stament->execute()) {
                // Si la eliminación del convenio es exitosa, se llama a la función encargada de eliminar las cuotas del convenio
                $this->deleteConvenioCuotas($id_convenio, $PDO);
                return true;
            } else {
                // En caso de que la eliminación del convenio falle, se retorna false
                return false;
            }
        }
        public function deleteLogico($id_convenio){
            require_once("c://xampp/htdocs/cuentasporcobrar/conexion/conexion.php");
            $con = new conexion();
            $PDO = $con->conexion();
            $stament = $PDO->prepare("UPDATE convenio SET estado = 100 WHERE id_convenio = :id_convenio");
            $stament->bindParam(":id_convenio",$id_convenio);
            if ($stament->execute()) {
                // Llamada a la función deleteOrdenItems()
                return true;
            } else {
                return false;
            }
        }

        // Función encargada de eliminar las cuotas asociadas a un convenio, dado su id
        public function deleteConvenioCuotas($id_convenio, $PDO)
        {
            // Preparación de la consulta SQL para eliminar las cuotas del convenio
            $stament = $PDO->prepare("
                DELETE FROM cuotas_convenio
                WHERE id_convenio = :id_convenio");
            $stament->bindParam(":id_convenio",$id_convenio);

            // Ejecución de la consulta para eliminar las cuotas del convenio
            $stament->execute();
        }

        
        public function getConvenio($id_convenio){
            $statement = $this->PDO->prepare("SELECT convenio.*, cliente.nombre AS cliente_nombre, cliente.apellido AS cliente_apellido, cliente.telefono AS cliente_telefono,
                                                    asistente_cobranza.nombre AS asistente_nombre, 
                                                    asistente_cobranza.apellido AS asistente_apellido 
                                                    FROM convenio 
                                                    LEFT JOIN cliente ON convenio.id_cliente = cliente.id_cliente 
                                                    LEFT JOIN asistente_cobranza ON convenio.id_asesor = asistente_cobranza.id
                                                    WHERE convenio.id_convenio =:id_convenio;");
            $statement->bindParam(":id_convenio",$id_convenio);
            $statement->execute();
            $convenio = $statement->fetch(PDO::FETCH_ASSOC);
            
            $cantidad_cuotas_pagadas = $this->contarcuotaspagadas($convenio['id_convenio']);
            $convenio['cantidad_cuotas_pagadas'] = $cantidad_cuotas_pagadas;
            
            return $convenio;
        }
        

        public function getConvenioCuotas($id_convenio){
            $statement = $this->PDO->prepare("SELECT  *  FROM cuotas_convenio WHERE id_convenio = :id_convenio");
            $statement->bindParam(":id_convenio", $id_convenio);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        public function updateConv($POST){
            
            $con = new conexion();
            $PDO = $con->conexion();
            $this->id_asesor = $POST['id_asesor'];
            $this->num_fact = $POST['num_fact'];
            $this->id_cliente = $POST['id_cliente'];
            $this->total = $POST['total'];
            $this->cuotas = $POST['cuotas'];
            $this->estado = $POST['estado'];
            $id_convenio = $POST['id_convenio'];
        
            $stament = $this->PDO->prepare("UPDATE convenio SET 
                id_asesor = :id_asesor, num_fact = :num_fact, id_cliente = :id_cliente, total = :total, cuotas = :cuotas, estado = :estado
                WHERE id_convenio = :id_convenio");
        
            // Vincular los parámetros con los valores correspondientes
            $stament->bindParam(':id_asesor', $POST['id_asesor']);
            $stament->bindParam(':num_fact', $POST['num_fact']);
            $stament->bindParam(':id_cliente', $POST['id_cliente']);
            $stament->bindParam(':total', $POST['total']);
            $stament->bindParam(':cuotas', $POST['cuotas']);
            $stament->bindParam(':estado', $POST['estado']);
            $stament->bindParam(':id_convenio', $id_convenio);
            $this->deleteConvenioCuotas($id_convenio, $PDO);
            // Ejecutar la consulta SQL
            $stament->execute(); 
            //seccion para manipular detalles
            for ($i = 0; $i < count($POST['id_convenio']); $i++) {
                $stament = $this->PDO->prepare("INSERT INTO cuotas_convenio (id_convenio, num_cuota_convenio, valor_pagado, valor_cuota) 
                VALUES ('" . $POST['id_convenio'] . "', '" . $POST['num_cuota_convenio'][$i] . "', '" . $POST['valor_pagado'][$i] . "', '" . $POST['valor_cuota'][$i] . "')");
                
                $stament->execute();
            }
        }

    }
?>