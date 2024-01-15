<?php

require_once(__DIR__ . '/../../controller/contactController.php');
require_once(__DIR__ . '/../../controller/menuController.php');

class contactVue {

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
        <link rel="stylesheet" type="text/css" href="../../styling/contact.css">
        <?php
    }

    private function define_library()
    {
        ?>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <?php
    }

    private function show_top_bar()
    {
        ?>
        <img src="../../images/logo" id="logo">
    
        <div class="top-bar">
            <button class="gestion" id="mrqq" onclick="window.location.href='http://localhost/tdwProjet/comparateurVehicule/router/adminRouter/gestionRouter.php'">Page Gestion Principal</button>
        </div>
        <?php
    }

    private function show_menu()
    {
        $ctr = new menuController();
        $table = $ctr->get_menu();
        ?>
        <div class="menu">
            <?php
            foreach ($table as $row) {
                $designation = htmlspecialchars($row['designation']);
                $champLocation = htmlspecialchars($row['location']);

                // Link each menu item to its champ location with white text color
                echo '<div class="menu-item"><a href="' . $champLocation . '" style="color: white;">' . $designation . '</a></div>';
            }
            ?>
        </div>
        <?php
    }

    private function show_general_guideAchat()
{
    ?>
    <div class="description-box">
        <h1>Marka - Comparateur de Véhicules</h1>
        <p>Découvrez l'excellence avec Marka, votre compagnon dans le monde des choix automobiles. Notre site comparateur de véhicules offre une expérience immersive, alliant beauté et fonctionnalité.</p>
    </div>
    <?php
}

    private function show_contacts()
    {
        $ctr = new contactController();
        $table = $ctr->get_contact();
        ?>
        <h1> Contactez Nous </h1>
        <div class="con">
            <?php
            $images = array();

            foreach ($table as $row) {
                $images[] = array('logo' => $row['image_res'], 'nom' => $row['nom_res'], 'lien' => $row['lien_res']);
            }
            $rows = array_chunk($images, 3);

            foreach ($rows as $rowImages) {
                echo '<div class="logo-row">';

                foreach ($rowImages as $brandData) {
                    $base64Img = base64_encode($brandData['logo']);
                    $imgSrc = 'data:image/jpeg;base64,' . $base64Img;

                    echo '<div class="brand-container">';
                    echo '<a href="' . $brandData['lien'] . '">';
                    echo '<img src="' . $imgSrc . '" alt="Image">';
                    echo '</a>';
                    echo '<div class="brand-name">' . htmlspecialchars($brandData['nom']) . '</div>';
                    echo '</div>';
                }

                echo '</div>';
            }
            ?>
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
        $this->show_menu();
        $this->show_description();
        $this->show_contacts(); 
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
