<?php
require_once('../../vue/userVue/newsVue.php');
$router = new newsRouter();

if (isset($_GET['username'])) {
    
    $username = $_GET['username'];
    $router->is_connected($username);

} else {
    $username = "NoUser";
    $router->is_connected($username);
}

$vue = new newsVue();
$vue->show_website();

class newsRouter 
    {
        public function is_connected($username) {
            $news = new newsVue();
            $news->show_top_bar($username);
            $news->show_menu($username);
        }
    }
?>
