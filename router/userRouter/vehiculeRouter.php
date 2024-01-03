<?php
require_once('../../vue/userVue/marqueVue.php');

$vue = new marqueVue();
$vue->show_website();



if (isset($_GET['id_veh'])) {
    // Get the id_mrq value from the URL
    $id_vh = $_GET['id_veh'];

    
    echo '<h1>Selected Marque ID: ' . htmlspecialchars($id_vh) . '</h1>';
} else {
    // Handle the case when id_mrq is not present in the URL
    echo '<h1>No Marque ID specified</h1>';
}


?>
