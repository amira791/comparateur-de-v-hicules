<?php

require_once(__DIR__ . '/../../controller/gestionController.php');


class gestionVue {

    private function show_title_page()
    {
        ?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Marka_Vehicule Comparateur </title>
        <?php
    }

    private function show_styling()
    {
        ?>
        <link rel="stylesheet" type="text/css" href="../../styling/gestion.css">
        <?php
    }

    private function define_library()
    {
        ?>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <?php
    }


  

    private function show_cadres ()
    {
        ?>
   <a href="../../router/adminRouter/gestionVehiculeRouter.php" class="cadre">
        <h3>Gestion des « Véhicules »</h3>
        <img src="../../images/gestion.png" alt="Image Cadre 1">
    </a>

    <a href="../../router/adminRouter/gestionAvisRouter.php" class="cadre">
        <h3>Gestion des « Avis »</h3>
        <img src="../../images/gestion.png" alt="Image Cadre 2">
    </a>

    <a href="../../router/adminRouter/gestionNewsRouter.php" class="cadre">
        <h3>Gestion des « News »</h3>
        <img src="../../images/gestion.png" alt="Image Cadre 3">
    </a>

    <a href="../../router/adminRouter/gestionUserRouter.php" class="cadre">
        <h3>La gestion des utilisateurs</h3>
        <img src="../../images/gestion.png" alt="Image Cadre 4">
    </a>

    <a href="../../router/adminRouter/gestionParametreRouter.php" class="cadre">
        <h3>Gestion des paramètres</h3>
        <img src="../../images/gestion.png" alt="Image Cadre 5">
    </a>
        <?php
    }
   
    public function Head_Page()
    {
        echo '<head>';
        $this->show_title_page();
        $this->define_library();
        $this->show_styling();
        echo '</head>';
    }

    public function Body_Page()
    {
        echo '<body>';
        $this->show_cadres();

        echo '</body>';
    }

    public function show_website()
    {
        echo '<html>';
        $this->Head_Page();
        $this->Body_Page();
        echo '</html>';
    }
}

?>
