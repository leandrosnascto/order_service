<?php
    require_once('ConnectDBClass.php');

    Class UpdateRegisterClass {

        public $conn;

        function __construct() {
            $getConnection = new ConnectDBClass();
            $this->conn = $getConnection->connection();
        }

        public function updateClient( $name, $cpf, $address, $keyClient ) {
            $sql = "UPDATE CLIENT SET NAME = '".$name."', CPF = '".$cpf."', ADDRESS = '".$address."' WHERE KEY_CLIENT = ".$keyClient;
            return $this->conn->query($sql);
        }
    
        public function updateProduct( $code, $description, $status, $warranty, $key_product ) {

            $data = str_replace("/", "-", $warranty);
            $convertData = date('Y-m-d', strtotime($data));

            $sql = "UPDATE PRODUCT SET CODE = '".$code."', DESCRIPTION = '".$description."', STATUS = '".$status."',
            TIME_WARRANTY = '".$convertData."'
            WHERE KEY_PRODUCT = ". $key_product;
            return $this->conn->query($sql);
        }
    
        public function updateServiceOrdem($numberOrder,$keyProduct,$keyService) {
            $sql = "UPDATE ORDEM SET NUMBER_ORDER = '".$numberOrder."', KEY_PRODUCT = '".$keyProduct."'
            WHERE KEY_ORDEM = ". $keyService;
            return $this->conn->query($sql);

        }
    }

?>