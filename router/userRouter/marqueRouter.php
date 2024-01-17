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

if (isset($_GET['username'])) {
    $submittedUsername = $_GET['username'];
    $submittedNote = isset($_GET['note']) ? $_GET['note'] : '';
    $submittedId = isset($_GET['idd']) ? $_GET['idd'] : ''; 
    

    $router->addNote($submittedId, $submittedNote, $submittedUsername);
}
if (isset($_GET['username'])) {
    $submittedUsername = $_GET['username'];
    $submittedNote = isset($_GET['comment']) ? $_GET['comment'] : '';
    $submittedId = isset($_GET['iddd']) ? $_GET['iddd'] : ''; 
    

    $router->addComment($submittedId, $submittedNote, $submittedUsername);
}


class marqueRouter 
{
    public function show_details($id) {
        $marqueVue = new marqueVue();
        $marqueVue->show_details_marque($id);
        $marqueVue->show_marque_note($id);
    }
    public function is_connected($username) {
        $marque = new MarqueVue();
        $marque->show_top_bar($username);
        $marque->show_menu($username);
      
    }
    public function addNote($submittedId, $submittedNote, $submittedUsername) {
        $marque = new MarqueVue();
        $marque->add_note ($submittedId, $submittedNote, $submittedUsername) ;
     
    }
    public function addComment($submittedId, $submittedNote, $submittedUsername) {
        $marque = new MarqueVue();
        $marque->add_comment ($submittedId, $submittedNote, $submittedUsername) ;
     
    }
}
?>
