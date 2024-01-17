<?php

require_once(__DIR__ . '/../../controller/userController.php');
require_once(__DIR__ . '/../../controller/menuController.php');
require_once(__DIR__ . '/../../controller/vehiculeController.php');

class userVue {

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
        <link rel="stylesheet" type="text/css" href="../../styling/user.css">
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


public function show_info ($username)
{
    ?>
    <section class="profile-section">
    <div class="profile-info">
        <?php
        $ctr = new userController();
        $table = $ctr->get_user($username);

        $nom = $table[0]['nom'];
        $prenom = $table[0]['prenom'];
        $sexe = $table[0]['sexe'];
        $date_naissance = $table[0]['date_naissance'];
        

        echo "<img src='../../images/userIcon.png' id='av' alt='Avatar'>";
        echo "<h2>$prenom $nom</h2>";
        echo "<p>Sexe: $sexe</p>";
        echo "<p>Date de Naissance: $date_naissance</p>";
        ?>
    </div>
</section> 
<?php

}

public function show_list_fav ($username)
{
    ?>
     <h1 > Liste des vehicules favoris </h1>
    <?php
    ?>
    <section class="favorite-list-section">
   
    <?php
    $ctr = new vehiculeController();
    $table = $ctr->get_listFav($username);

    foreach ($table as $row) {
        $id_vh = $row['id_vh'];
        $ctr1 = new vehiculeController();
        $vehicule = $ctr1->get_vhById($id_vh);
        $ctr2 = new marqueController();
        $marque_table = $ctr2->get_details($vehicule[0]['marque']);
        $marque = $marque_table[0]['Nom'];
        $modele = $vehicule[0]['modele'];
        $version = $vehicule[0]['version'];
        $annee = $vehicule[0]['annee'];
        $ctr2 = new vehiculeController();
        $n = $ctr1->getNoteVh($id_vh, $username); 
        
        

        echo "<div class='vehicle-card'>";
        echo "<img src='data:image/jpeg;base64," . base64_encode($vehicule[0]['image']) . "' alt='Vehicle Photo' id='vh'>";
        echo "<h2>$marque $modele</h2>";
        echo "<p>Version: $version</p>";
        echo "<p>Année: $annee</p>";
        if (!empty($n) && isset($n[0]['note'])) {
            $note = $n[0]['note'];
            echo "<p> Votre Note: $note</p>";
        } else {
            echo "<p> Aucune note disponible</p>";
        }
       

     
        echo "</div>";
        echo "</div>";
        
    }
    ?>
</section>

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
