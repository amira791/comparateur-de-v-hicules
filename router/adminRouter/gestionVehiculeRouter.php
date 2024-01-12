<?php
require_once('../../vue/adminVue/gestionVehiculeVue.php');

$router = new gestionVehiculeRouter();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST["action"];

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
      
        $id_mrq = $_POST["id_mrq"];
        $modele = $_POST["modele"];
        $version = $_POST["version"];
        $annee = $_POST["annee"];

        if (!empty($_FILES["newImage"]["name"])) {
            $newImage = $_FILES["newImage"];
        } else {
            $newImage = null;
        }

        // Call the method to modify the vehicle
        $router->modify_vh($id_mrq, $modele, $version, $annee, $newImage);
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

    public function modify_vh($id_mrq, $modele, $version, $annee, $newImage) {
        $ges_vh = new gestionVehiculeVue();
        $ges_vh->modify_vehicule_form($id_mrq, $modele, $version, $annee, $image);
    }
}
?>
