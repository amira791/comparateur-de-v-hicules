<?php
require_once('../../vue/adminVue/gestionVehiculeVue.php');

$router = new gestionVehiculeRouter();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = isset($_POST["action"]) ? $_POST["action"] : null;

    if ($action === "add") {
        // Add vehicle logic
        $id_mrq = $_POST["id_mrq"];
        $modele = $_POST["modele"];
        $version = $_POST["version"];
        $annee = $_POST["annee"];
        $id_type = $_POST["id_type"];
        $image = $_FILES["image"];

        $router->add_vh($id_mrq, $modele, $version, $annee, $image, $id_type);
    } elseif ($action === "modify") {
        
        $id_vh = $_POST["id_vh"];
        $id_mrq = $_POST["id_mrq"];
        $modele = $_POST["modele"];
        $version = $_POST["version"];
        $annee = $_POST["annee"];

        if (!empty($_FILES["newImage"]["name"])) {
            $newImage = $_FILES["newImage"];
        } else {
            $newImage = base64_decode($_POST["currentImage"] ?? '');
        }

        // Call the method to modify the vehicle
        $router->modify_vh($id_vh, $id_mrq, $modele, $version, $annee, $newImage);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $action = isset($_GET["action"]) ? $_GET["action"] : null;

    if ($action === "delete") {
        $idToDelete = isset($_GET["id"]) ? $_GET["id"] : null;
        $router->deleteVehicle($idToDelete);
    } elseif ($action === "addAsMain") {
        $idToAddAsMain = isset($_GET["id_vh"]) ? $_GET["id_vh"] : null;
        $id_mrq = isset($_GET["id_mrq"]) ? $_GET["id_mrq"] : null;
        $router->addVehicleAsMain($id_mrq, $idToAddAsMain);
        
    }
}

$vue = new gestionVehiculeVue();
$vue->show_website();

class gestionVehiculeRouter 
{
    public function add_vh($id_mrq, $modele, $version, $annee, $image, $id_type) {
        $ges_vh = new gestionVehiculeVue();
        $ges_vh->add_vehicule_form($id_mrq, $modele, $version, $annee, $image, $id_type);
    }

    public function modify_vh($id_vh, $id_mrq, $modele, $version, $annee, $newImage) {
        $ges_vh = new gestionVehiculeVue();
        $ges_vh->modify_vehicule_form($id_vh,$id_mrq, $modele, $version, $annee, $newImage);
    }

    public function deleteVehicle($idToDelete) {
        $ges_vh = new gestionVehiculeVue();
        $ges_vh->delete_vehicule_form($idToDelete);
    }
    public function addVehicleAsMain($id_mrq, $idToAddAsMain) {
        $ges_vh = new gestionVehiculeVue();
        $ges_vh->add_principal_vehicule_form($id_mrq, $idToAddAsMain);
       
    }
}
?>
