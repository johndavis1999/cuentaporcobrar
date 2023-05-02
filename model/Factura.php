<?php
    class Factura{
        private $PDO;
        public function __construct()
        {
            // Se requiere la conexión a la base de datos
            require_once("c://xampp/htdocs/cuentasporcobrar/conexion/conexion.php");
            // Se crea una instancia de la conexión
            $con = new conexion();
            // Se obtiene la conexión a través del método de la instancia
            $this->PDO = $con->conexion();
        }
        
        public function index(){
            // Se prepara la consulta para obtener todas las facturas con sus datos
            $statement = $this->PDO->prepare("SELECT f.*, c.nombre as c_nombre, c.apellido as c_apellido, mp.nombre as metodo  
                                                FROM factura f 
                                                LEFT JOIN cliente c ON f.id_cliente = c.id_cliente
                                                LEFT JOIN metodo_pago mp ON f.metodo_pago = mp.id_num
                                                ORDER BY f.num_fact  DESC");
            // Se ejecuta la consulta
            return ($statement->execute()) ? $statement->fetchAll() : false;    
        }
        
        public function getDatosFactura($num_factura) {
            // Se prepara la consulta para obtener los datos de una factura específica
            $statement = $this->PDO->prepare("SELECT f.*, c.nombre as c_nombre, c.apellido as c_apellido, mp.nombre as metodo  
                                                        FROM factura f 
                                                        LEFT JOIN cliente c ON f.id_cliente = c.id_cliente
                                                        LEFT JOIN metodo_pago mp ON f.metodo_pago = mp.id_num
                                                        WHERE f.num_fact = :num_factura");
            // Se bindea el valor del número de factura a la consulta
            $statement->bindParam(':num_factura', $num_factura);
            // Se ejecuta la consulta
            $statement->execute();
            // Se obtiene el resultado de la consulta
            $result = $statement->fetch();
            // Se retorna el resultado
            return $result;
        }
    }
?>
