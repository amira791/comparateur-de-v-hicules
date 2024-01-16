<?php
require_once('../../vue/userVue/inscriptionVue.php');

$router = new InscriptionRouter();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST['username']) && isset($_POST['password']) &&
        isset($_POST['confirmPassword']) && isset($_POST['nom']) &&
        isset($_POST['prenom']) && isset($_POST['sexe']) &&
        isset($_POST['dateNaissance'])
    ) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $sexe = $_POST['sexe'];
        $dateNaissance = $_POST['dateNaissance'];

        if ($password === $confirmPassword) {
            $router->inscription($username, $password, $nom, $prenom, $sexe, $dateNaissance);
        } else {
            echo '<script>alert("Password and Confirm Password do not match.");</script>';
        }
    } else {
        echo '<script>alert("Missing required fields.");</script>';
    }
}

$vue = new InscriptionVue();
$vue->show_website();

class InscriptionRouter
{
    public function inscription($username, $password, $nom, $prenom, $sexe, $dateNaissance)
    {
        $ins = new InscriptionVue();
        $ins->inscrire($username, $password, $nom, $prenom, $sexe, $dateNaissance);
    }
}
?>
