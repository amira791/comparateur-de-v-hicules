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
}



?>
