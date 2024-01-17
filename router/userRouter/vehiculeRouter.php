<?php
require_once('../../vue/userVue/vehiculeVue.php');

$vue = new vehiculeVue();
$vue->show_website();

$router = new vehiculeRouter();


if (isset($_GET['id_veh'])) {
   
    $id_vh = $_GET['id_veh'];
    $router->show_details_vehicule_pr($id_vh);
   

}

if (isset($_GET['id_vh'])) {
    $id_vh = $_GET['id_vh'];
    $router->show_details_vehicule($id_vh);

}

if (isset($_GET['id_vehh'])) {
   
    $id_vh = $_GET['id_vehh'];
    $router->show_details_vehicule_avi($id_vh);
   

}

if (isset($_GET['id_vhh'])) {
    $id_vh = $_GET['id_vhh'];
    $router->show_details_vehicule_avi($id_vh);

}
if (isset($_GET['username'])) {
    $submittedUsername = $_GET['username'];
    $submittedNote = isset($_GET['note']) ? $_GET['note'] : '';
    $submittedId = isset($_GET['idd']) ? $_GET['idd'] : ''; 
    

    $router->addNote($submittedId, $submittedNote, $submittedUsername);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $action = isset($_GET["action"]) ? $_GET["action"] : null;

    if ($action === "ajout") {
        $SubmittedIdAvi = isset($_GET['id_avi']) ? $_GET['id_avi'] : '';
        $router->addApp($SubmittedIdAvi);
    } 
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    

  
    $submittedId = isset($_GET['id_veh']) ? $_GET['id_veh'] : '';
    $submittedContent = isset($_GET['contenu']) ? $_GET['contenu'] : '';
    $submittedUsername = isset($_GET['userr']) ? $_GET['userr'] : ''; 
    $router->addAvi($submittedContent, $submittedId, $submittedUsername);
 
}
class vehiculeRouter {
    public function show_details_vehicule_pr($id_vh) {
        $vehiculeVue = new vehiculeVue();
        $vehiculeVue->show_vhNote($id_vh);
        $vehiculeVue->show_details_vh_pr($id_vh);
        $vehiculeVue->show_avi_vh($id_vh);
        
        
    }

    public function show_details_vehicule($id_vh) {
        $vehiculeVue = new vehiculeVue();
        $vehiculeVue->show_vhNote($id_vh);
        $vehiculeVue->show_details_vh($id_vh);
        $vehiculeVue->show_avi_vh($id_vh);
    }

    public function show_details_vehicule_avi($id_vh) {
        $vehiculeVue = new vehiculeVue();
        $vehiculeVue->show_details_vh_avi($id_vh);
    }
    public function addNote($submittedId, $submittedNote, $submittedUsername) {
        $marque = new VehiculeVue();
        $marque->add_note_veh ($submittedId, $submittedNote, $submittedUsername) ;
     
    }
    public function addApp($SubmittedIdAvi) {
        $marque = new  VehiculeVue();
        $marque->ajout_app_veh ($SubmittedIdAvi) ;
     
    }
    public function addAvi($submittedContent, $submittedId, $submittedUsername) {
        $marque = new VehiculeVue();
        $marque->ajout_avi_veh ($submittedContent, $submittedId, $submittedUsername) ;
     
    }
}



?>
