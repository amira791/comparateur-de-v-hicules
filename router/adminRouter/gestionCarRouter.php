<?php

require_once('../../vue/adminVue/gestionCarVue.php');

$router = new gestionCarRouter();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $action = isset($_GET["action"]) ? $_GET["action"] : null;

    if ($action === "car") {
        $idToCar = isset($_GET["id"]) ? $_GET["id"] : null;
        $router->CarVehicle($idToCar);
    } 
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $action = isset($_GET["action"]) ? $_GET["action"] : null;

    if ($action === "suppression") {
        $idToCar = isset($_GET["id"]) ? $_GET["id"] : null;
        $router->suppCar($idToCar);
    } 
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $action = isset($_GET["action"]) ? $_GET["action"] : null;

    if ($action === "modf") {
        $idToCar = isset($_GET["id"]) ? $_GET["id"] : null;
        $value = isset($_GET["modifiedValue"]) ? $_GET["modifiedValue"] : null;
        $id= isset($_GET["id_vehicule"]) ? $_GET["id_vehicule"] : null;
        $router->modfCar($idToCar, $value, $id);
       
    } 
}



$vue = new gestionCarVue();
$vue->show_website();

class gestionCarRouter 
{

    public function CarVehicle($idToCar) {
        
        $ges_car = new gestionCarVue();
        $ges_car->gestion_car($idToCar);
       
    }
    public function suppCar($idToCar) {
        
        $ges_car = new gestionCarVue();
        $ges_car->supp_car($idToCar);
    }
    
    public function modfCar($idToCar, $value, $id) {
        
        $ges_car = new gestionCarVue();
        $ges_car->modifier_car($idToCar, $value, $id);
       
    }
}
?>
