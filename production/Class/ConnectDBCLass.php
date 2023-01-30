<?php

Class ConnectDBClass {

    public function connection () {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "ordem_servico";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        return $conn->connect_error ? $conn->connect_error : $conn;    
    }

}

?>