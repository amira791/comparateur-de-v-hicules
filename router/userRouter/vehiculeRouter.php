<?php
require_once('../../vue/userVue/vehiculeVue.php');

$vue = new vehiculeVue();
$vue->show_website();

$router = new vehiculeRouter();


if (isset($_GET['id_veh'])) {
   
    $id_vh = $_GET['id_veh'];
    $router->show_details_vehicule($id_vh);

    
    echo '<h1>Selected Marque ID: ' . htmlspecialchars($id_vh) . '</h1>';
} else {
    
    echo '<h1>No Marque ID specified</h1>';
}

class vehiculeRouter 
{
    public function show_details_vehicule($id_vh) {
        $vehiculeVue = new vehiculeVue();
        $vehiculeVue->show_details_vh($id_vh);
    }
}


?>
