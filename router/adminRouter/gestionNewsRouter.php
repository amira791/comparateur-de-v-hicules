<?php
require_once('../../vue/adminVue/gestionNewsVue.php');

$router = new gestionNewsRouter();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = isset($_POST["action"]) ? $_POST["action"] : null;

    if ($action === "add") {
        // Add vehicle logic
        $titre = $_POST["titre"];
        $contenu = $_POST["contenu"];
        $date_publication = $_POST["date_publication"];
        $image = $_FILES["image_pr"];

        $router->AddNews($titre, $contenu, $date_publication, $image);
    } elseif ($action === "modify") {
        
        $id_new = $_POST["id_news"];
        $titre = $_POST["titre"];
        $contenu = $_POST["contenu"];
        $date_publication = $_POST["date_publication"];
        

        if (!empty($_FILES["newImage"]["name"])) {
            $newImage = $_FILES["newImage"];
        } else {
            $newImage = base64_decode($_POST["currentImage"] ?? '');
        }

        // Call the method to modify the vehicle
        $router->UpdateNews($id_new, $titre, $contenu, $date_publication, $newImage);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $action = isset($_GET["action"]) ? $_GET["action"] : null;

    if ($action === "delete") {
        $idToDelete = isset($_GET["id"]) ? $_GET["id"] : null;
        $router->DeleteNews($idToDelete);
    } 
}

$vue = new gestionNewsVue();
$vue->show_website();

class gestionNewsRouter 
{
    public function AddNews($titre, $contenu, $date_publication,  $image) {
        $ges_vh = new gestionNewsVue();
        $ges_vh->add_news_form($titre, $contenu, $date_publication,  $image);
    }

    public function UpdateNews($id_new, $titre, $contenu, $date_publication, $newImage) {
        $ges_vh = new gestionNewsVue();
        $ges_vh->modify_news_form($id_new, $titre, $contenu, $date_publication, $newImage);
    }

    public function DeleteNews($idToDelete) {
        $ges_vh = new gestionNewsVue();
        $ges_vh->delete_news_form($idToDelete);
    }
 
}
?>
