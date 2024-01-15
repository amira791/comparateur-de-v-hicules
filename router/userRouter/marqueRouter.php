<?php
require_once('../../vue/userVue/marqueVue.php');

$vue = new marqueVue();
$vue->show_website();

$router = new marqueRouter();

if (isset($_GET['id_mrq'])) {
   
    $id_mrq = $_GET['id_mrq'];
    $id = $id_mrq;
    $router->show_details($id);

   
   
} 
if (isset($_GET['username'])) {
    
    $username = $_GET['username'];
    $router->is_connected($username);

} else {
    $username = "NoUser";
    $router->is_connected($username);
}


class marqueRouter 
{
    public function show_details($id) {
        $marqueVue = new marqueVue();
        $marqueVue->show_details_marque($id);
    }
    public function is_connected($username) {
        $contact = new contactVue();
        $contact->show_top_bar($username);
        $contact->show_menu($username);
    }
}
?>
