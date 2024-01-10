<?php

class adminModel {

    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "admin";

    
    // Connection avec la base de donnes
    private function connect($servername, $username, $password, $database) {
        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }
    
    // Deconnection
    private function deconnect(&$conn) {
        if ($conn) {
            $conn->close();
        }
    }

    // Preparation et execution du requete
    private function requete($conn, $r) 
    {
        $stmt = $conn->prepare($r);
        if (!$stmt) {
            die("Error: " . $conn->error);
        }
        $stmt->execute();
        return $stmt->get_result();
    }


    // get admin table 
    public function get_admin_table()
   {
    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);
    $query = "SELECT * FROM admin_table"; 

    $res = $this->requete($conn, $query);
    $this->deconnect($conn);

    $adm = array();
    while ($row = $res->fetch_assoc()) {
        $adm[] = $row;
    }
    return $adm;
   }





}
?>