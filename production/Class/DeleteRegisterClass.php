<?php
    require_once('ConnectDBClass.php');

    Class DeleteRegisterClass {

        public $conn;

        function __construct() {
            $getConnection = new ConnectDBClass();
            $this->conn = $getConnection->connection();
        }

        public function deleteClient($keyClient) {
            $sql = "DELETE FROM CLIENT WHERE KEY_CLIENT = ".$keyClient;
            return $this->conn->query($sql);
            
        }
    
        public function deleteProduct($keyProduct) {
            $sql = "DELETE FROM PRODUCT WHERE KEY_PRODUCT = ". $keyProduct;
            return $this->conn->query($sql);
        }
    
        public function deleteServiceOrdem($keyService) {
            $sql = "DELETE FROM ORDEM WHERE KEY_ORDEM = ". $keyService;
            return $this->conn->query($sql);
        }
    }

?>