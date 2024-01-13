<?php
require_once('../../vue/adminVue/gestionMarqueVue.php');
$router = new gestionMarqueRouter();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = isset($_POST["action"]) ? $_POST["action"] : null;

    if ($action === "add") {
        $nom_mrq = $_POST["name"];
        $pay = $_POST["pay"];
        $siege = $_POST["siege"];
        $annee = $_POST["annee"];
        $histoire = $_POST["histoire"];
        $fondateur = $_POST["fondateur"];
        $slogan = $_POST["slogan"];
        $produits = $_POST["produits"];
        $site = $_POST["site"];
        $logo = $_FILES["logo"];

        $router->add_mrq($logo, $nom_mrq, $pay, $siege, $annee, $histoire, $fondateur, $slogan, $produits, $site);
    } elseif ($action === "modify") {
        $id_mrq = $_POST["id_mrq"];
        $nom_mrq = $_POST["nom_mrq"];
        $pays_origine = $_POST["pays_origine"];
        $siege_social = $_POST["siege_social"];
        $annee_creation = $_POST["annee_creation"];
        $histoire = $_POST["histoire"];
        $Fondateurs = $_POST["Fondateurs"];
        $Slogan = $_POST["Slogan"];
        $Produits = $_POST["Produitse"];
        $Site_web = $_POST["Site_web"];

        if (!empty($_FILES["newImage"]["name"])) {
            $newImage = $_FILES["newImage"];
        } else {
            $newImage = base64_decode($_POST["currentImage"] ?? '');
        }

        $router->modify_mrq( $id_mrq,$newImage, $nom_mrq, $pays_origine, $siege_social, $annee_creation, $histoire, $Fondateurs, $Slogan, $Produits, $Site_web);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $action = isset($_GET["action"]) ? $_GET["action"] : null;

    if ($action === "delete") {
        $idToDelete = isset($_GET["id"]) ? $_GET["id"] : null;
        $router->delete_mrq($idToDelete);
    }
}

$vue = new gestionMarqueVue();
$vue->show_website();

class gestionMarqueRouter 
{
    public function add_mrq($logo, $nom_mrq, $pay, $siege, $annee, $histoire, $fondateur, $slogan, $produits, $site) {
        $ges_mrq = new gestionMarqueVue();
        $ges_mrq->add_marque_form($logo, $nom_mrq, $pay, $siege, $annee, $histoire, $fondateur, $slogan, $produits, $site);
    }

    public function modify_mrq($id_mrq,  $newImage, $nom_mrq, $pays_origine, $siege_social, $annee_creation, $histoire, $Fondateurs, $Slogan, $Produits, $Site_web) {
        $ges_mrq = new gestionMarqueVue();
        $ges_mrq->modify_marque_form($id_mrq, $newImage, $nom_mrq, $pays_origine, $siege_social, $annee_creation, $histoire, $Fondateurs, $Slogan, $Produits, $Site_web);
    }

    public function delete_mrq($idToDelete) {
        $ges_mrq = new gestionMarqueVue();
        $ges_mrq->delete_marque_form($idToDelete);
    }
}
?>
