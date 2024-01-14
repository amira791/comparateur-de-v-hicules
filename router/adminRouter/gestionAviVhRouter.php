<?php
require_once('../../vue/adminVue/gestionAvisVue.php');

$router = new gestionAviVhRouter();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $action = isset($_GET["action"]) ? $_GET["action"] : null;

    if ($action === "refuse") {
        $idToRef = isset($_GET["id"]) ? $_GET["id"] : null;
        $router->refusAviVh($idToRef);
    } elseif ($action === "block") {
        $idToBlock = isset($_GET["id"]) ? $_GET["id"] : null;
        $router->blockUserVh($idToBlock);
        
    }
}

$vue = new gestionAvisVue();
$vue->show_website();

class gestionAviVhRouter 
{
    public function refusAviVh($idToRef) {
        $ges_avi = new gestionAvisVue();
        $ges_avi->refus_avi_table($idToRef);
    }

    public function blockUserVh($idToBlock) {
        $ges_vh =  new gestionAvisVue();
        $ges_vh->blockUserVh($idToBlock);
    }

  
}
?>
