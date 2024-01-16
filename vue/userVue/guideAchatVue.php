<?php

require_once(__DIR__ . '/../../controller/contactController.php');
require_once(__DIR__ . '/../../controller/menuController.php');
require_once(__DIR__ . '/../../controller/vehiculeController.php');
require_once(__DIR__ . '/../../controller/marqueController.php');

class guideAchatVue {

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
           <link rel="stylesheet" type="text/css" href="../../styling/guide.css">
           <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
           <meta charset="UTF-8">
           <meta http-equiv="X-UA-Compatible" content="IE=edge">
           <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="pragma" content="no cache" />
           <?php
        }

    private function define_library()
    {
        ?>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <?php
    }

    public function show_top_bar($username)
    {
        ?>
        
        <img src="../../images/logo" id="logo">
        <div class="top-bar"> 
            <?php
            if ($username == "NoUser") {
                ?>
                <button class="auth" id="connec" onclick="window.location.href='http://localhost/tdwProjet/comparateurVehicule/router/userRouter/connectionRouter.php'">Connection</button>
                <button class="auth" id="ins" onclick="window.location.href='http://localhost/tdwProjet/comparateurVehicule/router/userRouter/inscriptionRouter.php'">Inscription</button>
                <button class="auth" id="admin" onclick="window.location.href='http://localhost/tdwProjet/comparateurVehicule/router/adminRouter/connectionRouter.php'">Connection as Admin</button>
                </div>
                <?php
            } else {
                ?>
                <h1 id="username"><img src="../../images/userIcon.png" alt="Avatar"><?php echo htmlspecialchars($username); ?></h1>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }

    public function show_menu($username)
    {

        $ctr = new menuController();
        $table = $ctr->get_menu();
        ?>
            <?php
            if ($username == "NoUser") {
                ?>
                <div class="menu">
            <?php
            foreach ($table as $row) {
                $designation = htmlspecialchars($row['designation']);
                $champLocation = htmlspecialchars($row['location']); 
                echo '<div class="menu-item"><a href="' . $champLocation . '" style="color: white;">' . $designation . '</a></div>';
            }
            ?>
        </div> 
                <?php
            } else {
                ?>
                <div class="menu">
            <?php
            foreach ($table as $row) {
                $designation = htmlspecialchars($row['designation']);
                $champLocation = htmlspecialchars($row['location'] . '?username=' . urlencode($username));
                echo '<div class="menu-item"><a href="' . $champLocation . '" style="color: white;">' . $designation . '</a></div>';
            }
            ?>
        </div>
                <?php
            }
    }
    public function show_details_guide($id) {
        $ctr1 = new vehiculeController();
        $guide = $ctr1->get_guide($id);
        $contenu = $guide[0]['contenu_guide'];
    
        $ctr2 = new vehiculeController();
        $veh = $ctr2->get_vhById($id);
        $id = $veh[0]['marque'];
        $ctr2 = new marqueController();
        $id_vh = $veh[0]['Id_veh'];
        $marque_table = $ctr2->get_details($id);
        $marque = $marque_table[0]['Nom'];
        $modele = $veh[0]['modele'];
        $version = $veh[0]['version'];
        $annee = $veh[0]['annee'];
    
        ?>
        <div class="contenu_guide">
        <h1><?php echo "$marque - $modele - $version - $annee"; ?></h1>
        <p><strong>Guide Contenu:</strong></p>
        <p><?php echo $contenu; ?></p>
    </div>
        <?php
    }
    
 
private function show_general_guideAchat()
{
?>

<div class="container">
    <h1>Guide d'Achat de Véhicules</h1>

    <section class="step">
        <h2><i class="fas fa-lightbulb"></i> Déterminez vos besoins</h2>
        <p>Avant de commencer à rechercher des voitures, identifiez clairement vos besoins...</p>
        <img src="../../images/guide1.jpg" alt="Personnes discutant de leurs besoins">
    </section>

    <section class="step">
        <h2><i class="fas fa-money-bill-wave"></i> Fixez un budget</h2>
        <p>Déterminez combien vous êtes prêt à dépenser pour votre nouvelle voiture...</p>
        <img src="../../images/guide2.avif" alt="Calculation de budget">
    </section>

    <section class="step">
        <h2><i class="fas fa-car"></i> Recherchez les modèles</h2>
        <p>Faites des recherches sur les modèles de voitures qui répondent à vos besoins...</p>
        <img src="../../images/guide3.jpg" alt="Personne faisant des recherches sur des modèles de voitures">
    </section>

    <section class="step">
        <h2><i class="fas fa-car-side"></i> Véhicule neuf ou d'occasion</h2>
        <p>Décidez si vous préférez acheter un véhicule neuf ou d'occasion...</p>
        <img src="../../images/guide4.jpg" alt="Nouveau ou d'occasion">
    </section>

    <section class="step">
        <h2><i class="fas fa-history"></i> Historique du véhicule (pour les voitures d'occasion)</h2>
        <p>Obtenez un rapport d'historique du véhicule pour toute voiture d'occasion...</p>
        <img src="../../images/guide5.webp" alt="Rapport d'historique du véhicule">
    </section>

    <!-- Ajoutez d'autres sections au besoin -->

    <div class="navigation-links">
        <h2>Guide Achat Personnalisee</h2>

        <select id="g">
            <option value="" selected>Choisir un véhicule</option>
            <?php
            $ctr = new vehiculeController();
            $veh = $ctr->get_vehicule();
            foreach ($veh as $row) {
                $id = $row['marque'];
                $ctr2 = new marqueController();
                $id_vh = $row['Id_veh'];
                $marque_table = $ctr2->get_details($id);
                $marque = $marque_table['Nom'];
                $modele = $row['modele'];
                $version = $row['version'];
                $annee = $row['annee'];

                echo "<option value='$id_vh'>$marque - $modele - $version - $annee</option>";
                // Debugging statement
                echo "ID_vh: $id_vh<br>";
            }
            ?>
        </select>
    </div>
</div>

<script>
    jQuery(document).ready(function ($) {
        $("#g").on("change", function () {
            var selectedId = $("#g").val();
            console.log("Redirecting to detail...", selectedId);
        
                window.location.href = "../../router/userRouter/guideAchatRouter.php?id_vh=" + selectedId;
            
        });
    });
</script>

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
        $this->show_general_guideAchat();
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
