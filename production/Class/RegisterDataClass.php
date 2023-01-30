<?php
    require_once('ConnectDBClass.php');

    Class RegisterDataClass {

        public $conn;

        function __construct() {
            $getConnection = new ConnectDBClass();
            $this->conn = $getConnection->connection();
        }

        public function client ($name, $cpf, $address) {

            // Verifica se já existe o CPF cadastrado
            $sqlVerifyCpf = "SELECT * FROM CLIENT 
            WHERE regexp_replace(cpf, '[^0-9]', '') = ". preg_replace( '/[^0-9]/', '', $cpf ) ." LIMIT 1";

            $result = $this->conn->query($sqlVerifyCpf);
            if ($result->num_rows > 0) {
            
                return false;
            }
       
            $sql = "INSERT INTO CLIENT (name, cpf, address) VALUES ('$name','$cpf','$address')";
            return $this->conn->query($sql);        
        }

        public function product ($code, $description, $status, $warranty) {

            $data = str_replace("/", "-", $warranty);
            $convertData = date('Y-m-d', strtotime($data));

            $sql = "INSERT INTO PRODUCT (code,description,status,time_warranty) 
            VALUES ('$code', '$description', '$status', '$convertData')";
            return $this->conn->query($sql);  
        }

        public function serviceOrdem( $numberOrder,$dateOpening,$name,$cpf,$keyProduct) {

            $sqlVerifyCpf = "SELECT * FROM CLIENT 
            WHERE regexp_replace(cpf, '[^0-9]', '') = ". preg_replace( '/[^0-9]/', '', $cpf ) ." LIMIT 1";

            $result = $this->conn->query($sqlVerifyCpf);

            if ($result->num_rows == 0) {
      
                $address = 'Rua sem endereço (Atualizar)';

                $sqlInsert = "INSERT INTO CLIENT (name, cpf, address) VALUES ('$name','$cpf','$address')";

                if($this->conn->query($sqlInsert) === TRUE) {
                    //Last ID inserted
                    $keyClient = $this->conn->insert_id;
                } 
            } else {

                $row = $result->fetch_assoc();
                $keyClient = $row['KEY_CLIENT'];
            }

            $data = str_replace("/", "-", $dateOpening);
            $convertData = date('Y-m-d', strtotime($data));

            $sql = "INSERT INTO ORDEM (number_order,date_opening,KEY_CLIENT,cpf,KEY_PRODUCT) 
            VALUES ('$numberOrder','$convertData','$keyClient','$cpf','$keyProduct')";
            return $this->conn->query($sql);   
        }
    }
?>