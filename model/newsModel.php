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


    // get diaporma table 
    public function get_news_table()
   {
    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);
    $query = "SELECT * FROM news WHERE type = 'news'"; 

    $res = $this->requete($conn, $query);
    $this->deconnect($conn);

    $new = array();
    while ($row = $res->fetch_assoc()) {
        $new[] = $row;
    }
    return $new;
   }
    


   //get news pay id 
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




}
?>