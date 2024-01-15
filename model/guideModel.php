<?php

class guideModel {

    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "tdw";

    
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


    // get guide table 
    public function get_guide_table()
   {
    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);
    $query = "SELECT * FROM guideachat"; 

    $res = $this->requete($conn, $query);
    $this->deconnect($conn);

    $guide = array();
    while ($row = $res->fetch_assoc()) {
        $guide[] = $row;
    }
    return $guide;
   }

    // get guide by id_veh
    public function get_guide_ById($id_vh)
   {
    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);
    $query = "SELECT * FROM guideachat Where veh_g = '$id_vh'"; 

    $res = $this->requete($conn, $query);
    $this->deconnect($conn);

    $guide = array();
    while ($row = $res->fetch_assoc()) {
        $guide[] = $row;
    }
    return $guide;
   }






}
?>