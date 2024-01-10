<?php

require_once('../../vue/userVue/inscriptionVue.php');

$router = new inscriptionRouter();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirmPassword'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
      

        if ($password === $confirmPassword) {
            $router->inscription($username, $password);
        } else {
            echo '<script>alert("Password and Confirm Password do not match.");</script>';
        }
    } else {
        echo '<script>alert("Missing username, password, or confirm password.");</script>';
    }
}

$vue = new inscriptionVue();
$vue->show_website();

class inscriptionRouter
{
    public function inscription($username, $password)
    {
        $ins = new inscriptionVue();
        $ins->inscrire($username, $password);
    }
}
?>
