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


    public function add_vehicule_form ($marque, $modele, $version, $annee, $image, $type)
    {
        $ctr = new vehiculeController();
        $new_veh = $ctr->add_vehicule($marque, $modele, $version, $annee, $image, $type);
    }

    public function modify_vehicule_form ($id_vh, $marque, $modele, $version, $annee, $image)
    {
        $ctr = new vehiculeController();
        $veh = $ctr->modify_vehicule($id_vh, $marque, $modele, $version, $annee, $image);
    }

    public function delete_vehicule_form ($id_vh)
    {
        $ctr = new vehiculeController();
        $veh = $ctr->delete_vehicule($id_vh);
    }

    private function show_table_vehicule()
    { 
        // get all marques 
        $ctr1 = new marqueController();
        $marques = $ctr1->get_marque();

        echo '<script>
        function openAddVehiclePopup(id_mrq) {
            var popup = document.getElementById("addVehiclePopup_" + id_mrq);
            popup.style.display = "block";
        }

        function closeAddVehiclePopup(id_mrq) {
            var popup = document.getElementById("addVehiclePopup_" + id_mrq);
            popup.style.display = "none";
        }

        function displayFileName(input) {
            const fileNameSpan = document.getElementById(\'file-name\');
            const fileName = input.files[0]?.name || \'No file chosen\';
            fileNameSpan.textContent = fileName;
        }
        function openModifyVehiclePopup(id_vh) {
            var popup = document.getElementById("modifyVehiclePopup_" + id_vh);
            popup.style.display = "block";
        }

        function closeModifyVehiclePopup(id_vh) {
            var popup = document.getElementById("modifyVehiclePopup_" + id_vh);
            popup.style.display = "none";
        }
      </script>';

       
        foreach ($marques as $mrq)
        {
            $id_mrq = $mrq['id_mrq'];
            $nom_mrq = $mrq['Nom'];
            $ctr2 = new marqueController();
            $vehicules = $ctr1->get_allVh($id_mrq); // get vehi for a specified marque
        
            // Output the selected marque information within a container div
            echo '<div class="marque-container">';
            echo '<a href="../../router/adminRouter/gestionMarqueRouter.php?id_mrq=' . $id_mrq . '">';
            echo '<h1> La marque: ' . htmlspecialchars($nom_mrq) . '</h1>';
            echo '</a>';
            
            // Create a table for the vehicles of the current marque
            echo '<table border="1">';
            echo '<tr>
                    <th>Suppression</th>
                    <th>Modification</th>
                    <th>Ajout comme Principal</th> <!-- Ajouter comme vehicule principal -->
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
                // La suppression
                echo '<td><a href="../../router/adminRouter/gestionVehiculeRouter.php?action=delete&id=' . $id_vh . '">Suppression</a></td>';
                echo '<td><a href="#" onclick="openModifyVehiclePopup(' . $id_vh . ')" class="modify-button">Modification</a></td>';
                echo '<td><a href="add_vehicle_princp.php?id_mrq=' . $id_mrq . '">Ajout</a></td>'; 
                echo '<td>' . $modele . '</td>';
                echo '<td>' . $version . '</td>';
                echo '<td>' . $annee . '</td>';
                echo '<td><img src="' . $imgSrc . '" alt="Vehicle Image" style="max-width: 100px; max-height: 100px;"></td>';
                echo '<td><a href="vehicle_details.php?id=' . $id_vh . '">Caracteristique</a></td>';
                echo '</tr>';

                /***************  The modifiction form **************/
                echo '<div id="modifyVehiclePopup_' . $id_vh . '" class="popup">';
                echo '<div class="popup-content">';
                echo '<span class="close" onclick="closeModifyVehiclePopup(' . $id_vh . ');">&times;</span>';
            
                echo '<form action="../../router/adminRouter/gestionVehiculeRouter.php" method="post" enctype="multipart/form-data" class="modify-vehicle-form">';
                echo '<input type="hidden" name="id_vh" value="' . $id_vh . '">';
                echo '<input type="hidden" name="id_mrq" value="' . $id_mrq . '">';
                echo '<input type="text" name="modele" value="' . htmlspecialchars($modele) . '" required class="form-input">';
                echo '<label for="version">Version:</label>';
                echo '<input type="text" name="version" value="' . htmlspecialchars($version) . '" required class="form-input">';
                echo '<label for="annee">Annee:</label>';
                echo '<input type="text" name="annee" value="' . htmlspecialchars($annee) . '" required class="form-input">';
                echo '<div class="current-image-container">';
                echo '<label for="image">Current Image:</label>';
                echo '<img src="data:image/jpeg;base64,' . base64_encode($image) . '" alt="Current Image" class="current-image">';
                echo '<input type="hidden" name="currentImage" value="' . base64_encode($image) . '">';
                echo '</div>';
                echo '<label for="newImage" class="file-label">Choose a New Image:</label>';
                echo '<div class="file-input-container">';
                echo '<input type="file" name="newImage" accept="image/*" class="file-input" onchange="displayFileName(this)">';
                echo '<span id="file-name" class="file-name">No file chosen</span>';
                echo '</div>';
                echo '<input type="hidden" name="action" value="modify">';
                echo '<button type="submit" class="modify-vehicle-button">Modify Vehicle</button>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
            
            }
    
        /************* Ajout Form ******************************** */
            echo '</table>';
            echo '<button onclick="openAddVehiclePopup(' . $id_mrq . ')" class="add-vehicle-button">Add a new vehicle</button>';
            echo '</div>'; 


        echo '<div id="addVehiclePopup_' . $id_mrq . '" class="popup">';
        echo '<div class="popup-content">';
        echo '<span class="close" onclick="closeAddVehiclePopup(' . $id_mrq . ');">&times;</span>';

        echo '<form action="../../router/adminRouter/gestionVehiculeRouter.php" method="post" enctype="multipart/form-data" class="add-vehicle-form">';
    
// Hidden input for $id_mrq
echo '<input type="hidden" name="id_mrq" value="' . $id_mrq . '">';
    
echo '<label for="modele">Modele:</label>';
echo '<input type="text" name="modele" required class="form-field">';
    
echo '<label for="version">Version:</label>';
echo '<input type="text" name="version" required class="form-field">';
    
echo '<label for="annee">Annee:</label>';
echo '<input type="text" name="annee" required class="form-field">';
    
$ctr = new vehiculeController();
$table = $ctr->get_typeVh();
?>
<h2>Selectionner le type du vehicule</h2>
<select name="id_type" id="typeSelector" required>
    <option value="" selected>Choose a type</option> 
    <?php
    foreach ($table as $row) {
        $id_type = $row['id_type'];
        $type = $row['type'];
        echo "<option value='$id_type'>$type</option>";
    }
    ?>
</select>

<?php
// Add input for id_type
echo '<input type="hidden" name="id_type" value="" id="hidden_id_type">';
echo '<label for="image" class="file-input-container">';
echo '<input type="file" name="image" accept="image/*" required class="file-input" onchange="displayFileName(this)">';
echo '<span class="file-label">Choose a File</span>';
echo '<span id="file-name"></span>';
echo '</label>';

echo '<br>';
echo '<br>';
echo '<input type="hidden" name="action" value="add">';
echo '<button type="submit" class="add-vehicle-button">Submit</button>';
echo '</form>';
?>
<script>
    // JavaScript to update the hidden input with the selected id_type
    document.getElementById('typeSelector').addEventListener('change', function() {
        document.getElementById('hidden_id_type').value = this.value;
    });
</script>
<?php

    
        echo '</div>';
        echo '</div>';
        
        echo '</div>';
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
