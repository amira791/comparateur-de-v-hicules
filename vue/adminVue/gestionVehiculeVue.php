<?php

require_once(__DIR__ . '/../../controller/vehiculeController.php');
require_once(__DIR__ . '/../../controller/marqueController.php');
require_once(__DIR__ . '/../../controller/menuController.php');

class gestionVehiculeVue {

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
        <link rel="stylesheet" type="text/css" href="../../styling/gestion_vh.css">
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

    private function show_table_vehicule()
    { 
        // get all marques 
        $ctr1 = new marqueController();
        $marques = $ctr1->get_marque();
       
        foreach ($marques as $mrq)
        {
            $id_mrq = $mrq['id_mrq'];
            $nom_mrq = $mrq['Nom'];
            $ctr2 = new marqueController();
            $vehicules = $ctr1->get_allVh($id_mrq); // get vehi for a specified marque
        
            // Output the selected marque information within a container div

            echo '<div class="marque-container">';
            echo '<h1> La marque: ' . htmlspecialchars($nom_mrq) . '</h1>';
            
            // Create a table for the vehicles of the current marque
            echo '<table border="1">';
            echo '<tr>
                    <th>Suppression</th>
                    <th>Modification</th>
                    <th>Modele</th>
                    <th>Version</th>
                    <th>Annee</th>
                    <th>Image</th>
                    <th>Caracteristique</th>
                  </tr>';
    
            foreach ($vehicules as $vh)
            {
                $id_vh = $vh['Id_veh'];
                $modele = $vh['modele'];
                $version = $vh['version'];
                $annee = $vh['annee'];
                $image = $vh['image'];
                $base64Img = base64_encode($image);
                $imgSrc = 'data:image/jpeg;base64,' . $base64Img;
    
                // Output a row for each vehicle
                echo '<tr>';
                echo '<td><a href="delete_vehicle.php?id=' . $id_vh . '">Suppression</a></td>';
                echo '<td><a href="edit_vehicle.php?id=' . $id_vh . '">Modification</a></td>';
                echo '<td>' . $modele . '</td>';
                echo '<td>' . $version . '</td>';
                echo '<td>' . $annee . '</td>';
                echo '<td><img src="' . $imgSrc . '" alt="Vehicle Image" style="max-width: 100px; max-height: 100px;"></td>';
                echo '<td><a href="vehicle_details.php?id=' . $id_vh . '">Caracteristique</a></td>';
                echo '</tr>';
            }
    
            echo '</table>';
            echo '</div>'; // Close the container div
        }
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
        $this->show_table_vehicule();
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
