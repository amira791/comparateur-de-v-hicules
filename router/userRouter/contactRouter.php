<?php
require_once('../../vue/userVue/contactVue.php');

$router = new contactRouter();

if (isset($_GET['username'])) {
    
    $username = $_GET['username'];
    $router->is_connected($username);

} else {
    $username = "NoUser";
    $router->is_connected($username);
}
$vue = new contactVue();
$vue->show_website();

class contactRouter 
    {
        public function is_connected($username) {
            $contact = new contactVue();
            $contact->show_top_bar($username);
            $contact->show_menu($username);
        }
    }

?>
