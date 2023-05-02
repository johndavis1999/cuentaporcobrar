<?php
    class conexion{
        private $host= "localhost"; // Dirección del servidor de base de datos
        private $dbname="db_dsn08"; // Nombre de la base de datos
        private $user="root"; // Nombre de usuario de la base de datos
        private $password=""; // Contraseña de la base de datos
        public function conexion(){
            try{
                // Se crea una instancia de la clase PDO, pasando como parámetros los datos necesarios para establecer la conexión
                $PDO = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname,$this->user,$this->password);
                // Se devuelve el objeto PDO creado para que pueda ser utilizado posteriormente en la conexión
                return $PDO;
            }catch(PDOException $e){
                // En caso de que se produzca un error en la conexión, se devuelve el mensaje de error generado por PDOException
                return $e->getMessage();
            }
        }
    }
?>
