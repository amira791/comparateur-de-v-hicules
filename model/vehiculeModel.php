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
    $query = "SELECT * FROM vehicule Where supp_log = 0"; 

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

// get principales vehicules
public function get_prinvh_table($ids)
{
    // Check if the $ids array is not empty
    if (empty($ids)) {
        return array(); // Return an empty array if no IDs are provided
    }

    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);

    // Create a comma-separated list of IDs for the SQL query
    $idList = implode(',', array_map('intval', $ids));

    $query = "SELECT * FROM vehicule WHERE Id_veh IN ($idList)";
   
    $res = $this->requete($conn, $query);
    $this->deconnect($conn);

    $carvh = array();
    while ($row = $res->fetch_assoc()) {
        $carvh[] = $row;
    }
    return  $carvh;
}


// get vehicule by id 
public function get_veh_byId($id_vehc)
{
    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);
    $query = "SELECT * FROM vehicule WHERE Id_veh = $id_vehc";
   
    $res = $this->requete($conn, $query);
    $this->deconnect($conn);

    $vh = array();
    while ($row = $res->fetch_assoc()) {
        $vh[] = $row;
    }
    return  $vh;
}

// suppresion logique vehicule 
public function supp_log_vh ($id_vh)
{
    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);
    $query = "UPDATE vehicule SET supp_log = '1' WHERE Id_veh = '$id_vh' "; 

    $res = $this->requete($conn, $query);
    $this->deconnect($conn);

}

// add a new vehicle
public function add_vehicle_table($marque, $modele, $version, $annee, $image, $id_type)
{
    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);

    // Handle file upload
    $imageData = file_get_contents($image['tmp_name']);
    
    // Escape special characters in the binary data to prevent SQL injection
    $escapedImageData = mysqli_real_escape_string($conn, $imageData);

    // Insert the image data into the database as a BLOB
    $query = "INSERT INTO vehicule (marque, modele, version, annee, image, type) VALUES ('$marque', '$modele', '$version', '$annee', '$escapedImageData', '$id_type')";

    $res = $this->requete($conn, $query);
    $this->deconnect($conn);
}

// add images to vehicule 
public function add_images_vehicule_table ($id_vh , $image)
{
    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);
    $query = "INSERT INTO image_vehicule (image, id_vehicule) VALUES ('$image', $id_vh)";

    $res = $this->requete($conn, $query);
    $this->deconnect($conn);
}




// In your vehiculeModel.php
public function update_vehicule_table($id_vh, $marque, $modele, $version, $annee, $image)
{
    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);

    // Check if $image is an array
    if (is_array($image) && isset($image['tmp_name'])) { 
   
        $imageData = file_get_contents($image['tmp_name']);
        $escapedImageData = mysqli_real_escape_string($conn, $imageData);
    } else { 
       
        $escapedImageData = mysqli_real_escape_string($conn, $image);
    }

    $query = "UPDATE vehicule 
              SET 
              marque ='$marque',
              modele = '$modele',
              version = '$version',
              annee = '$annee',
              image = '$escapedImageData' 
              WHERE Id_veh = '$id_vh'";

    $res = $this->requete($conn, $query);
    $this->deconnect($conn);
}

// update marque vehicule 
public function update_marque_vehicule ($marque, $id_vh)
{
    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);
    $query = "UPDATE vehicule SET marque ='$marque' WHERE Id_veh = '$id_vh'";
    $res = $this->requete($conn, $query);
    $this->deconnect($conn);

}

// update modele vehicule 
public function update_modele_vehicule ($modele, $id_vh)
{
    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);
    $query = "UPDATE vehicule SET modele ='$modele' WHERE Id_veh = '$id_vh'";
    $res = $this->requete($conn, $query);
    $this->deconnect($conn);

}

// update version vehicule 
public function update_version_vehicule ($version, $id_vh)
{
    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);
    $query = "UPDATE vehicule SET version ='$version' WHERE Id_veh = '$id_vh'";
    $res = $this->requete($conn, $query);
    $this->deconnect($conn);

}

// update annee vehicule 
public function update_annee_vehicule ($annee, $id_vh)
{
    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);
    $query = "UPDATE vehicule SET annee ='$annee' WHERE Id_veh = '$id_vh'";
    $res = $this->requete($conn, $query);
    $this->deconnect($conn);

}

// update image vehicule 
public function update_image_vehicule ($image, $id_vh)
{
    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);
    $query = "UPDATE vehicule SET image ='$image' WHERE Id_veh = '$id_vh'";
    $res = $this->requete($conn, $query);
    $this->deconnect($conn);

}


// add vehicule comme principal 
public function add_vehicule_principal_table ($id_mrq, $id_vh)
{
    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);
    $query = "INSERT INTO principalvehicules (veh_p, marq) VALUES ('$id_vh', '$id_mrq')";

    $res = $this->requete($conn, $query);
    $this->deconnect($conn);

}

// add carac to a vehicule 
public function add_carac_vehicule_table($id_vh, $id_carac, $valeure)
{
    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);
    $query = "INSERT INTO vehicule_carac (id_vh, id_car, value_car) VALUES ('$id_vh', '$id_mrq')";

    $res = $this->requete($conn, $query);
    $this->deconnect($conn);

}






}
?>