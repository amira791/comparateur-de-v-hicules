<?php

require_once('../../vue/userVue/guideAchatVue.php');

$router = new guideRouter();

if (isset($_GET['username'])) {
    
    $username = $_GET['username'];
    $router->is_connected($username);

} else {
    $username = "NoUser";
    $router->is_connected($username);
}

if (isset($_GET['id_vh'])) {
    
    $id = $_GET['id_vh'];
    $router->displayDetails($id);

} 
$vue = new guideAchatVue();
$vue->show_website();


class guideRouter 
    {
        public function is_connected($username) {
            $guide = new guideAchatVue();
            $guide->show_top_bar($username);
            $guide->show_menu($username);
        }
        public function displayDetails($id) {
            $guide = new guideAchatVue();
            $guide->show_details_guide($id);
            
        }
    }

?>
