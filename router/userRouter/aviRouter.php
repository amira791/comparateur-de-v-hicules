<?php
require_once('../../vue/userVue/aviVue.php');

$vue = new aviVue();
$vue->show_website();

$router = new aviRouter();

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



class aviRouter 
{
    public function show_details($id) {
        $aviVue = new aviVue();
        $aviVue->show_details_marque($id);
       
    }
    public function is_connected($username) {
        $aviVue = new aviVue();
        $aviVue->show_top_bar($username);
        $aviVue->show_menu($username);
      
    }
  
}
?>
