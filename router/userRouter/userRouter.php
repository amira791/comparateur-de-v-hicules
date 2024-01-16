<?php
require_once('../../vue/userVue/userrVue.php');

$router = new userRouter();

if (isset($_GET['username'])) {
    $username = $_GET['username'];
    $router->is_connected($username);
}

$vue = new userVue();
$vue->show_website();

class userRouter 
{
    public function is_connected($username) {
        $user = new userVue();
        $user->show_info($username); 
        $user->show_list_fav($username);
    }
}
?>
