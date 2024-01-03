<?php

class aviModel {

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


  
   // get  les all avis pour une marque 
   public function get_vehicule_table($id_mrq)
   {
    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);
    $query = "SELECT * FROM avi_mrq WHERE id_mrq = $id_mrq AND avi_status_mrq = 'Valide'";
 

    $res = $this->requete($conn, $query);
    $this->deconnect($conn);

    $avis_mrq = array();
    while ($row = $res->fetch_assoc()) {
        $avis_mrq[] = $row;
    }
    return  $avis_mrq;


   }

      // get  les all avis pour une vehicule 
      public function get_avi_mrq_table($id_vh)
      {
       $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);
       $query = "SELECT * FROM avi_vh WHERE id_vh = $id_vh AND avi_status_mrq = 'Valide'";
    
   
       $res = $this->requete($conn, $query);
       $this->deconnect($conn);
   
       $avis_mrq = array();
       while ($row = $res->fetch_assoc()) {
           $avis_mrq[] = $row;
       }
       return  $avis_mrq;
   
   
      }

      // get  les troi avis les plus apprecies pour une vehicule 
      public function get_troisAvi_vh($id_vh)
      {
       $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);
       $query = "SELECT * FROM avi_mrq WHERE id_vh = $id_vh AND avi_status_mrq = 'Valide' ORDER BY nb_appreciation_mrq DESC LIMIT 3";

    
   
       $res = $this->requete($conn, $query);
       $this->deconnect($conn);
   
       $avis_mrq = array();
       while ($row = $res->fetch_assoc()) {
           $avis_mrq[] = $row;
       }
       return  $avis_mrq;
   
   
      }

      // get  les troi avis les plus apprecies pour une marque 
      public function get_troisMrq_vh($id_mrq)
      {
       $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);
       $query = "SELECT * FROM avi_mrq WHERE id_mrq = $id_mrq AND status_avi_mrq = 'Valide' ORDER BY nb_appreciation_mrq DESC LIMIT 3";

    
   
       $res = $this->requete($conn, $query);
       $this->deconnect($conn);
   
       $avis_mrq = array();
       while ($row = $res->fetch_assoc()) {
           $avis_mrq[] = $row;
       }
       return  $avis_mrq;
   
   
      }
   





}
?>