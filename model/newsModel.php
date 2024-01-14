<?php

class newsModel {

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


    // get news table 
    public function get_news_table()
   {
    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);
    $query = "SELECT * FROM news WHERE type = 'news' and supp_log = 0"; 

    $res = $this->requete($conn, $query);
    $this->deconnect($conn);

    $new = array();
    while ($row = $res->fetch_assoc()) {
        $new[] = $row;
    }
    return $new;
   }
    


   //get news by id 
   public function get_news_byId($id)
   {
    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);
    $query = "SELECT * FROM news WHERE id_news = '$id'"; 

    $res = $this->requete($conn, $query);
    $this->deconnect($conn);

    $news = array();
    while ($row = $res->fetch_assoc()) {
        $news[] = $row;
    }
    return $news;
   }


   // rajouter news 
   public function add_news_table($titre, $contenu, $date_publication, $image_pr)
{
    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);

    // Handle file upload
    $imageData = file_get_contents($image_pr['tmp_name']);
    
    // Escape special characters in the binary data to prevent SQL injection
    $escapedImageData = mysqli_real_escape_string($conn, $imageData);

    // Insert the image data into the database as a BLOB
    $query = "INSERT INTO news (titre, contenu, date_publication, type, image_pr) VALUES ('$titre', '$contenu', '$date_publication', 'news', '$escapedImageData')";

    $res = $this->requete($conn, $query);
    $this->deconnect($conn);                                                          
}


// modifier news 
public function update_news_table($id_new, $titre, $contenu, $date_publication,  $image_pr)
{
    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);

    // Check if $image is an array
    if (is_array($image_pr) && isset($image_pr['tmp_name'])) { 
   
        $imageData = file_get_contents($image_pr['tmp_name']);
        $escapedImageData = mysqli_real_escape_string($conn, $imageData);
    } else { 
       
        $escapedImageData = mysqli_real_escape_string($conn, $image_pr);
    }
    
    $query = "UPDATE news
              SET 
              titre ='$titre',
              contenu = '$contenu',
              date_publication = '$date_publication',
              type = 'news',
              image_pr = '$escapedImageData' 
              WHERE id_news = '$id_new'";

    $res = $this->requete($conn, $query);
    $this->deconnect($conn);
}

// suppresion logique vehicule 
public function supp_log_new ($id_new)
{
    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);
    $query = "UPDATE news SET supp_log = '1' WHERE id_news = '$id_new' "; 

    $res = $this->requete($conn, $query);
    $this->deconnect($conn);

}






}
?>