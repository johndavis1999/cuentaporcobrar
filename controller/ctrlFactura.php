<?php
    // Se define la clase controladorFactura
    class controladorFactura{
        
        // Se define una propiedad privada $model que contendrá un objeto de la clase Factura
        private $model;
        
        // Se define el constructor de la clase, el cual requiere el archivo que contiene la clase Factura
        // y crea una instancia de dicha clase
        public function __construct(){
            require_once("c://xampp/htdocs/cuentasporcobrar/model/Factura.php");
            $this->model = new Factura();
        }
        
        // Este método se encarga de obtener todas las facturas del sistema
        public function index(){
            // Si el método index() de la clase Factura retorna algún resultado, se retorna dicho resultado.
            // De lo contrario, se retorna false.
            return ($this->model->index()) ? $this->model->index() : false;
        }
        
        // Este método se encarga de obtener los datos de una factura en particular, a partir de su número de factura
        public function getDatosFactura($num_fact){
            // Si el método getDatosFactura() de la clase Factura retorna algún resultado, se retorna dicho resultado.
            // De lo contrario, se retorna false.
            return ($this->model->getDatosFactura($num_fact)) ? $this->model->getDatosFactura($num_fact) : false;
        }
        
    }
?>
