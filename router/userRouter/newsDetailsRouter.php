<?php
require_once('../../vue/userVue/NewsDetailsVue.php');

$vue = new NewsDetailsVue();
$vue->show_website();

$router = new newsDetailsRouter();

if (isset($_GET['id'])) {
   
    $id_news = $_GET['id'];
    $router->show_details_news($id_news);

   
    echo '<h1>Selected Marque ID: ' . htmlspecialchars($id_news) . '</h1>';
} else {
   
    echo '<h1>No News </h1>';
}


class newsDetailsRouter 
{
    public function show_details_news($id) {
        $marqueVue = new NewsDetailsVue();
        $marqueVue->show_details($id);
    }
}
?>
