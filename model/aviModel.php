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
   public function get_avis_table($id_mrq)
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

      // get avi_vh table valide
      public function get_avi_table()
      {
       $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);
       $query = "SELECT * FROM avi_veh Where status_avi_veh ='Valide' "; 
   
       $res = $this->requete($conn, $query);
       $this->deconnect($conn);
   
       $avi = array();
       while ($row = $res->fetch_assoc()) {
           $avi[] = $row;
       }
       return  $avi;
      }

   // get avi_vh table 
   public function get_avi_table_admin()
   {
    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);
    $query = "SELECT * FROM avi_veh "; 

    $res = $this->requete($conn, $query);
    $this->deconnect($conn);

    $avi = array();
    while ($row = $res->fetch_assoc()) {
        $avi[] = $row;
    }
    return  $avi;
   }


   // Refuser un avi pour vehicule
   public function refuse_avi_vh_table ($id_avi)
   {
    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);
       $query = "UPDATE avi_veh SET status_avi_veh ='Non Valide' WHERE id_avi_veh = '$id_avi'";
    
   
       $res = $this->requete($conn, $query);
       $this->deconnect($conn);
   }

   // Refuser un avi pour marque
   public function refuse_avi_mrq_table ($id_avi)
   {
    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);
       $query = "UPDATE avi_mrq SET status_avi_mrq ='Non Valide' WHERE id_avi_mrq = '$id_avi'";
    
   
       $res = $this->requete($conn, $query);
       $this->deconnect($conn);
   }

      // get  les all avis pour une vehicule 
      public function get_avi_veh_table($id_vh)
      {
       $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);
       $query = "SELECT * FROM avi_veh WHERE id_veh = $id_vh AND status_avi_veh = 'Valide'";
    
   
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
       $query = "SELECT * FROM avi_veh WHERE id_veh = $id_vh AND status_avi_veh = 'Valide' ORDER BY nb_appreciation_veh DESC LIMIT 3";

    
   
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
   



    // add appreciaton mrq 
    public function add_appreciation_mrq ($id_avi)
    {
        $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);
        $query = "UPDATE avi_mrq
        SET nb_appreciation_mrq = nb_appreciation_mrq + 1 where id_avi_mrq = '$id_avi' ";
 
        $res = $this->requete($conn, $query);
        $this->deconnect($conn);

    }

     // add appreciaton vh
     public function add_appreciation_veh ($id_avi)
     {
         $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);
         $query = "UPDATE avi_veh
        SET nb_appreciation_veh = nb_appreciation_veh + 1 where id_avi_veh = '$id_avi'";
  
         $res = $this->requete($conn, $query);
         $this->deconnect($conn);
 
     }
     public function add_avi_mrq ($content, $id_mrq, $username)
   {
    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);
    $query = "INSERT INTO avi_mrq (contenu_mrq, status_avi_mrq, nb_appreciation_mrq, username, id_mrq ) VALUES ('$content', 'Valide' , '0', '$username' , '$id_mrq')";

    $res = $this->requete($conn, $query);
    $this->deconnect($conn);
            
   }
   public function add_avi_veh ($content, $id_veh, $username)
   {
    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);
    $query = "INSERT INTO avi_veh (contenu_veh, status_avi_veh, nb_appreciation_veh, username, id_veh ) VALUES ('$content', 'Valide' , '0', '$username' , '$id_veh')";
    $res = $this->requete($conn, $query);
    $this->deconnect($conn);
            
   }



}
?>