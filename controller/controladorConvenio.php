<?php
    class controladorConvenio{
        private $model;

        public function __construct(){
            // Se incluye el modelo Convenio.php en el controlador
            require_once("c://xampp/htdocs/cuentasporcobrar/model/Convenio.php");
            // Se crea una instancia del modelo Convenio
            $this->model = new Convenio();
        }

        // Función para mostrar el listado de convenios
        public function index(){
            // Se verifica si se puede obtener la lista de convenios, si es así se retorna, de lo contrario se retorna falso
            return ($this->model->index()) ? $this->model->index() : false;
        }
        
        // Función para guardar un convenio
        public function guardarConvenio($id_asesor, $num_fact, $id_cliente, $total, $cuotas, $estado){
            // Se crea un arreglo POST con los datos del convenio
            $POST = array(
                'id_asesor' => $id_asesor,
                'num_fact' => $num_fact,
                'id_cliente' => $id_cliente,
                'total' => $total, 
                'cuotas' => $cuotas,   
                'estado' => $estado,  
                'num_cuota_convenio' => $_POST['num_cuota_convenio'],
                'valor_pagado' => $_POST['valor_pagado'],
                'valor_cuota' => $_POST['valor_cuota']
            );
            if(($_POST['num_cuota_convenio']==null)&&($_POST['valor_pagado']==null)){
                header("Location: crear.php?num_fact=$num_fact");
            }else{
                // Se llama a la función guardarConvenio del modelo para guardar los datos del convenio
                $this->model->guardarConvenio($POST);
                // Se redirecciona al listado de convenios
                return header("Location:convenios.php");
            }
        }

        // Función para eliminar un convenio
        public function deleteConvenio($id_convenio){
            // Se llama a la función deleteConvenio del modelo para eliminar el convenio
            // Si se logra eliminar el convenio se redirecciona al listado de convenios, de lo contrario también se redirecciona al listado de convenios
            return ($this->model->deleteConvenio($id_convenio)) ? header("Location:convenios.php") : header("Location:convenios.php") ;
        }
        // Función para eliminar visual
        public function deleteLogico($id_convenio){
            // Se llama a la función deleteConvenio del modelo para eliminar el convenio
            // Si se logra eliminar el convenio se redirecciona al listado de convenios, de lo contrario también se redirecciona al listado de convenios
            return ($this->model->deleteLogico($id_convenio)) ? header("Location:convenios.php") : header("Location:convenios.php") ;
        }

        public function getConvenio($id_convenio){
            // Devuelve el resultado de la consulta
            return $this->model->getConvenio($id_convenio);
        }

        public function getConvenioCuotas($id_convenio){
            // Devuelve el resultado de la consulta
            return $this->model->getConvenioCuotas($id_convenio);
        }
        public function updateConv($id_convenio, $id_asesor, $num_fact, $id_cliente, $total, $cuotas, $estado){
            $POST = array(
                'id_convenio' => $id_convenio,
                'id_asesor' => $id_asesor,
                'num_fact' => $num_fact,
                'id_cliente' => $id_cliente,
                'total' => $total,
                'cuotas' => $cuotas,
                'estado' => $estado,
                'num_cuota_convenio' => $_POST['num_cuota_convenio'],
                'valor_pagado' => $_POST['valor_pagado'],
                'valor_cuota' => $_POST['valor_cuota']
            );
            if($_POST['producto_id'] == null){
                header("Location:edit_fact.php?id_convenio=$id_convenio");
                exit;
            } else {
                $this->model->updateConv($POST);
                return header("Location:convenios.php");
            }
        }
    }
?>