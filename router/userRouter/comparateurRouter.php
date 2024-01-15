<?php

require_once('../../vue/userVue/comparateurVue.php');
$router = new comparateurRouter();

if (isset($_GET['tableData'])) {
    $decodedTableData = urldecode($_GET['tableData']);
    $router->show_accueil($decodedTableData);
   
} else
{
    echo "<h3> No table </h3>";
}

if (isset($_GET['username'])) {
    
    $username = $_GET['username'];
    $router->is_connected($username);

} else {
    $username = "NoUser";
    $router->is_connected($username);
}
$vue = new comparateurVue();
$vue->show_website();

class comparateurRouter
{
    public function show_accueil( $decodedTableData)
    {
        $ins = new comparateurVue();
        $ins->show_accueil_table($decodedTableData);
    }
    public function is_connected($username) {
        $contact = new contactVue();
        $contact->show_top_bar($username);
        $contact->show_menu($username);
    }
}

?>
