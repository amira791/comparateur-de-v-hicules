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
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
        <?php
    }

    private function define_library()
    {
        ?>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <?php
    }


    private function show_top_bar ()
    {
        ?>
       <img src="../../images/logo" id="logo">
       <div class="top-bar"></div>
       <?php

    }


  

    private function show_cadres()
    {
        ?>
       <div class="top-bar"></div>
        <div class="cadre-container">
            <a href="../../router/adminRouter/gestionVehiculeRouter.php" class="cadre">
                <h3>Gestion Véhicules </h3>
                <img src="../../images/gestionveh.png" alt="Image Cadre 1">
            </a>
    
            <a href="../../router/adminRouter/gestionAviVhRouter.php" class="cadre">
                <h3>Gestion Avis </h3>
                <img src="../../images/gestionavii.webp" alt="Image Cadre 2">
            </a>
    
            <a href="../../router/adminRouter/gestionNewsRouter.php" class="cadre">
                <h3>Gestion News </h3>
                <img src="../../images/news.webp" alt="Image Cadre 3">
            </a>
    
            <a href="../../router/adminRouter/gestionUserRouter.php" class="cadre">
                <h3>La gestion Users</h3>
                <img src="../../images/gestionuser.png" alt="Image Cadre 4">
            </a>
    
            <a href="../../router/adminRouter/gestionParametreRouter.php" class="cadre">
                <h3>Gestion Paramètres</h3>
                <img src="../../images/gestion.png" alt="Image Cadre 5">
            </a>
        </div>
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
        $this->show_top_bar();
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
