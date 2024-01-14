<?php

require_once(__DIR__ . '/../../controller/vehiculeController.php');
require_once(__DIR__ . '/../../controller/aviController.php');
require_once(__DIR__ . '/../../controller/userController.php');


class gestionAvisVue {

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
        <link rel="stylesheet" type="text/css" href="../../styling/gestionAviVh.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
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
        <button class="gestion" id="mrqq" onclick="window.location.href='http://localhost/tdwProjet/comparateurVehicule/router/adminRouter/gestionAviMrqRouter.php'">Gestion Avis Marque</button>
        <button class="gestion" id="mrqq" onclick="window.location.href='http://localhost/tdwProjet/comparateurVehicule/router/adminRouter/gestionRouter.php'">Page Gestion Principal</button>
    </div>
    <?php
}


    public function refus_avi_table($idToRef)
    {
        $ctr = new aviController();
        $new_veh = $ctr->refuse_avi_vh ($idToRef);
    }

    public function blockUserVh($idToBlock)
    {
        $ctr = new  aviController();
        $veh = $ctr->user_block ($idToBlock);
    }



 
    private function show_avi_vh_table()
    {
        // get all avis for vehicule
        $ctr1 = new aviController();
        $avis = $ctr1->get_avi_adminVh();
        
        echo '<div class="aviVh-container">';
        echo '<table border="1">';
        echo '<thead>
                <tr>
                    <th>Block User</th>
                    <th>Refuse</th>
                    <th>Contenu</th>
                    <th>Nb Appreciation</th>
                    <th>Vehicule</th>
                    <th>Utilisateur</th>
                    <th>Status</th>
                </tr>
              </thead>';
    
        foreach ($avis as $row) {
            $id_avi = $row['id_avi_veh'];
            $contenu_veh = $row['contenu_veh'];
            $status_avi_veh = $row['status_avi_veh'];
            $nb_appreciation_veh = $row['nb_appreciation_veh'];
            $username = $row['username'];
            $id_veh = $row['id_veh'];
            
            $ctr2 = new vehiculeController();
            $veh = $ctr2->get_vhById($id_veh);
            
            $marque = $veh[0]['marque'];
            $modele = $veh[0]['modele'];
            $version = $veh[0]['version'];
            $annee = $veh[0]['annee'];
    
            // Dans l'affichage, je dois afficher les avis qui sont valides avant après qui sont non valides
    
            echo '<tr>';
            echo '<td><a href="../../router/adminRouter/gestionAviVhRouter.php?action=block&id=' . $username . '">Block User</a></td>';
            echo '<td><a href="../../router/adminRouter/gestionAviVhRouter.php?action=refuse&id=' . $id_avi . '">Refuse</a></td>';
            echo '<td>' . $contenu_veh . '</td>';
            echo '<td>' . $nb_appreciation_veh . '</td>';
            echo '<td>' . $marque . ' ' . $modele . ' ' . $version . ' ' . $annee . '</td>';
            echo '<td>' . $username . '</td>';
            echo '<td>' . $status_avi_veh . '</td>';
    
            echo '</tr>';
        }
    
        echo '</table>';
        echo '</div>';
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
        $this->show_avi_vh_table();
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
