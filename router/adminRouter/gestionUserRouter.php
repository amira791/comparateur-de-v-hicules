<?php
require_once('../../vue/adminVue/gestionUserVue.php');

$router = new gestionUserRouter();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $action = isset($_GET["action"]) ? $_GET["action"] : null;

    if ($action === "block") {
        $idToBlock = isset($_GET["id"]) ? $_GET["id"] : null;
        $router->blockUser($idToBlock);
    } elseif ($action === "valider") {
        $username = isset($_GET["id"]) ? $_GET["id"] : null;
        $router->ValideUser($username);
        
    }
}

$vue = new gestionUserVue();
$vue->show_website();

class gestionUserRouter 
{
  

    public function blockUser($idToBlock) {
        $ges_us =  new gestionUserVue();
        $ges_us->blockUserT($idToBlock);
    }
    public function ValideUser($username) {
        $ges_us =  new gestionUserVue();
        $ges_us->ValiderUser($username);
    }

  
}
?>
