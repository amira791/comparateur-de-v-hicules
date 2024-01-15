<?php

require_once('../../vue/userVue/accueilVue.php');

$router = new accueilRouter();

if (isset($_GET['username'])) {
    
    $username = $_GET['username'];
    $router->is_connected($username);

} else {
    $username = "NoUser";
    $router->is_connected($username);
}
$vue = new accueilVue();
$vue->show_website();


class accueilRouter 
    {
        public function is_connected($username) {
            $accueil = new accueilVue();
            $accueil->show_top_bar($username);
            $accueil->show_menu($username);
        }
    }

?>
