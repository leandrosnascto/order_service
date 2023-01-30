<?php
require_once('ConnectDBClass.php');

Class ListDataClass {


    public $conn;

    function __construct() {
        $getConnection = new ConnectDBClass();
        $this->conn = $getConnection->connection();
    }

    public function querySelect($consult) {
        $result = $this->conn->query($consult);
        return $result->num_rows > 0 ? $result : [];      
    }

    public function listClient() {
        return $this->querySelect("SELECT * FROM CLIENT");
    }

    public function listProduct() {
        return $this->querySelect("SELECT * FROM PRODUCT");
    }

    public function listServiceOrdem() {
        $sql = "SELECT * FROM ORDEM O 
        LEFT JOIN CLIENT C ON regexp_replace(O.CPF, '[^0-9]', '') = regexp_replace(C.CPF, '[^0-9]', '')
        LEFT JOIN PRODUCT P ON O.KEY_PRODUCT = P.KEY_PRODUCT";
        return $this->querySelect($sql);
    }

    public function listProductActive() {
        return $this->querySelect("SELECT * FROM PRODUCT WHERE STATUS = 1");
    }

    public function listAllClients() {
        return $this->querySelect("SELECT * FROM CLIENT");
    }

    //lista um registro especifico

    public function getClient($keyClient) {
        return $this->querySelect("SELECT * FROM CLIENT WHERE KEY_CLIENT =". $keyClient);
    }

    public function getProduct($keyProduct) {
        return $this->querySelect("SELECT * FROM PRODUCT WHERE KEY_PRODUCT =". $keyProduct);
    }

    public function getService($keyService) {
        return $this->querySelect("SELECT O.*, C.NAME FROM ORDEM O 
        INNER JOIN CLIENT C ON O.KEY_CLIENT = C.KEY_CLIENT
        WHERE O.KEY_ORDEM =". $keyService);
    }

}

?>