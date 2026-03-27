<?php 
/**
 * 
 * @author Emilio Hernandez Sosa
 * 
 * 
 */
    class mainClass{
        private string $db;
        private string $server;
        private string $username;
        private string $password;
        function __construct($db, $server, $username, $password) {
            $this->db = $db;
            $this->server = $server;
            $this->username = $username;
            $this->password = $password;
        }

        private function getConnection(){
            $connection = null;
            try{
                $connection = new PDO("pgsql:host=".$this->server.";port=5432;dbname=".$this->db.";user=".$this->username.";password=".$this->password);
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, true );
            }catch(PDOException $e){
                return null;
            }
            return $connection;
        }

        public function getData($table, $fields, $condition = null, $params = null){
            $cursor = [];
            $strFields = implode(',', $fields);
            $query = "SELECT $strFields FROM $table" . ($condition ? " WHERE $condition" : "");
            try{
                $cnx = $this->getConnection();
                $pcmd = $cnx->prepare($query);
                
                if ($params) {
                    foreach ($params as $index => $param) {
                        $pcmd->bindValue($index + 1, $param, PDO::PARAM_STR);
                    }
                }
                
                $pcmd->execute();

                while ($row = $pcmd->fetch(PDO::FETCH_ASSOC)) {
                    $cursor[] = $row; // Cada fila es un arreglo asociativo
                }

                $pcmd = null; // Cierra el statement/command
                $cnx = null; // Cierra la conexión

                return $cursor;
            } catch (PDOException $ex) {
                error_log("Error al ejecutar la consulta: " . $ex->getMessage());
                return null;
            }
        }

        public function insertData($table, $fields,$params){
            $strFields = implode(',', $fields);
            $strParams = rtrim(str_repeat('?,', count($fields)), ','); 

            $query = "INSERT INTO public.$table ($strFields) VALUES ($strParams)";
            $cnx = $this->getConnection();
            try {
                // Desactiva el autocommit para manejo manual de transacciones.
                $cnx->beginTransaction();

                $pcmd = $cnx->prepare($query);

                foreach ($params as $index => $param) {
                    $pcmd->bindValue($index + 1, $param, PDO::PARAM_STR); // Vincula cada parámetro.
                }
                
                $pcmd->execute();
                $lastInsertId = $cnx->lastInsertId(); 

                $cnx->commit(); 

                $pcmd = null; 
                $cnx = null; 

                return $lastInsertId;
            } catch (PDOException $ex) {
                // Si ocurre un error, hacemos rollback.
                if ($cnx->inTransaction()) {
                    $cnx->rollBack();
                }
                error_log("Error al insertar la fila: " . $ex->getMessage());
                return false;
            }
        }
    }