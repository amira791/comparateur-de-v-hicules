<?php

class marqueModel {

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


    // get diaporma table 
    public function get_marque_table()
   {
    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);
    $query = "SELECT * FROM marque"; 

    $res = $this->requete($conn, $query);
    $this->deconnect($conn);

    $marq = array();
    while ($row = $res->fetch_assoc()) {
        $marq[] = $row;
    }
    return $marq;
   }

// get marques a partir le type 
public function get_marq_typ_table( $idType)
{

        $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);

        // Use a prepared statement to prevent SQL injection
        $query = "SELECT * FROM marque_typevh WHERE id_typ = ?";
        $res = $this->requete($conn, $query);
        $this->deconnect($conn);

        $marques = array();
        while ($row = $res->fetch_assoc()) {
            $marques[] = $row;
        }

      return $marques ; 
    
}


// get table marque 
public function get_mrqType_table ()
{
    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);
    $query = "SELECT * FROM marque_typevh"; 

    $res = $this->requete($conn, $query);
    $this->deconnect($conn);

    $marq_typ = array();
    while ($row = $res->fetch_assoc()) {
        $marq_typ[] = $row;
    }
    return  $marq_typ;

}


   





}
?>