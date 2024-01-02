<?php

class vehiculeModel {

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


    // get type vehicule table 
    public function get_typeVh_table()
   {
    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);
    $query = "SELECT * FROM typevehicule"; 

    $res = $this->requete($conn, $query);
    $this->deconnect($conn);

    $type = array();
    while ($row = $res->fetch_assoc()) {
        $type[] = $row;
    }
    return $type;
   }
  
   // get vehicule table 
   public function get_vehicule_table()
   {
    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);
    $query = "SELECT * FROM vehicule"; 

    $res = $this->requete($conn, $query);
    $this->deconnect($conn);

    $veh = array();
    while ($row = $res->fetch_assoc()) {
        $veh[] = $row;
    }
    return  $veh;


   }

   // get carac table 
   public function get_carac_table()
   {
    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);
    $query = "SELECT * FROM caracteristique"; 

    $res = $this->requete($conn, $query);
    $this->deconnect($conn);

    $carac = array();
    while ($row = $res->fetch_assoc()) {
        $carac[] = $row;
    }
    return  $carac;


   }

   // get carac_vh table 
   public function get_caracvh_table()
   {
    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);
    $query = "SELECT * FROM vehicule_carac"; 

    $res = $this->requete($conn, $query);
    $this->deconnect($conn);

    $carvh = array();
    while ($row = $res->fetch_assoc()) {
        $carvh[] = $row;
    }
    return  $carvh;


   }





}
?>