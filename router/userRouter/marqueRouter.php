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
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $action = isset($_GET["action"]) ? $_GET["action"] : null;

    if ($action === "ajout") {
        $SubmittedIdAvi = isset($_GET['id_avi']) ? $_GET['id_avi'] : '';
        $router->addApp($SubmittedIdAvi);
    } 
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    

  
        $submittedId = isset($_GET['id_mrq']) ? $_GET['id_mrq'] : '';
        $submittedContent = isset($_GET['contenu']) ? $_GET['contenu'] : '';
        $submittedUsername = isset($_GET['userr']) ? $_GET['userr'] : ''; 
        $router->addAvi($submittedContent, $submittedId, $submittedUsername);
     
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

    public function addApp($SubmittedIdAvi) {
        $marque = new MarqueVue();
        $marque->ajout_app ($SubmittedIdAvi) ;
     
    }
    public function addAvi($submittedContent, $submittedId, $submittedUsername) {
        $marque = new MarqueVue();
        $marque->ajout_avi ($submittedContent, $submittedId, $submittedUsername) ;
     
    }
}
?>
