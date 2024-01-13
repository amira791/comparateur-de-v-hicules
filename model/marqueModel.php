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

// get  marque details 
public function get_mrq_details ($id)
{
    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);
    $query = "SELECT * FROM marque WHERE id_mrq = $id"; 

    $res = $this->requete($conn, $query);
    $this->deconnect($conn);

    $marq = array();
    while ($row = $res->fetch_assoc()) {
        $marq[] = $row;
    }
    return  $marq;

}


// get les vehicule principales pour une marques 
public function get_princp_veh ($id)
{
    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);
    $query = "SELECT * FROM principalvehicules WHERE marq = $id"; 

    $res = $this->requete($conn, $query);
    $this->deconnect($conn);

    $prin = array();
    while ($row = $res->fetch_assoc()) {
        $prin[] = $row;
    }
    return  $prin;
 
}

      // get all veh a partir une marque  
      public function get_all_vh($id)
      {
       $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);
       $query = "SELECT * FROM vehicule  WHERE marque = $id AND  supp_log = 0"; 
   
       $res = $this->requete($conn, $query);
       $this->deconnect($conn);
   
       $vehs = array();
       while ($row = $res->fetch_assoc()) {
        $vehs[] = $row;
       }
       return  $vehs;
   
   
      }

      // suppresion logique marque
public function supp_log_vh ($id_mrq)
{
    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);
    $query = "UPDATE marque SET supp_logique = '0' WHERE id_mrq = '$id_mrq' "; 

    $res = $this->requete($conn, $query);
    $this->deconnect($conn);

}

// add a new marque
public function add_marque_table($logo, $Nom, $pays_origine, $siege_social, $annee_creation, $histoire
, $Fondateurs, $Slogan, $Produits, $Site_web )
{
    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);

    // Handle file upload
    $imageData = file_get_contents($logo['tmp_name']);
    
    // Escape special characters in the binary data to prevent SQL injection
    $escapedImageData = mysqli_real_escape_string($conn, $imageData);

    // Insert the image data into the database as a BLOB
    $query = "INSERT INTO marque (logo, Nom, pays_origine, siege_social, annee_creation, histoire, Fondateurs, Slogan, Produits, Site_web) 
    VALUES ('$escapedImageData', '$Nom', '$pays_origine', '$siege_social', '$annee_creation', '$histoire' , '$Fondateurs', '$Slogan', '$Produits', '$Site_web')";

    $res = $this->requete($conn, $query);
    $this->deconnect($conn);
}



// update marque
public function update_marque_table($id_mrq, $logo, $Nom, $pays_origine, $siege_social, $annee_creation, $histoire
, $Fondateurs, $Slogan, $Produits, $Site_web)
{
    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);

    
    if (is_array($logo) && isset($logo['tmp_name'])) { 
   
        $imageData = file_get_contents($logo['tmp_name']);
        $escapedImageData = mysqli_real_escape_string($conn, $imageData);
    } else { 
       
        $escapedImageData = mysqli_real_escape_string($conn, $logo);
    }

    $query = "UPDATE marque
              SET 
              logo ='$escapedImageData',
              Nom = '$Nom',
              pays_origine = '$pays_origine',
              siege_social = '$siege_social',
              pays_origine = '$pays_origine',
              annee_creation = '$annee_creation',
              pays_origine = '$pays_origine',
              Fondateurs = '$Fondateurs',
              Slogan = '$Slogan', 
              Produits = '$Produits',
              Site_web = '$Site_web'
              WHERE id_mrq = '$id_mrq'";

    $res = $this->requete($conn, $query);
    $this->deconnect($conn);
}
 



public function get_mrq_Id ($id)
{
     
     if (empty($id)) {
        return array(); 
    }

    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);

   

    $query = "SELECT * FROM marque WHERE id_mrq = $id";
   
    $res = $this->requete($conn, $query);
    $this->deconnect($conn);

    $mrq = array();
    while ($row = $res->fetch_assoc()) {
        $mrq[] = $row;
    }
    return  $mrq;

}





}
?>