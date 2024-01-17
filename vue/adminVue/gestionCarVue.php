<?php

require_once(__DIR__ . '/../../controller/vehiculeController.php');
require_once(__DIR__ . '/../../controller/marqueController.php');
require_once(__DIR__ . '/../../controller/menuController.php');

class gestionCarVue {

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
        <link rel="stylesheet" type="text/css" href="../../styling/gestion_car.css">
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
        <button class="gestion" id="mrqq" onclick="window.location.href='http://localhost/tdwProjet/comparateurVehicule/router/adminRouter/gestionMarqueRouter.php'">Gestion Marque</button>
        <button class="gestion" id="mrqq" onclick="window.location.href='http://localhost/tdwProjet/comparateurVehicule/router/adminRouter/gestionRouter.php'">Page Gestion Principal</button>
    </div>
    <?php
}





    public function modifier_car ($id_car, $value, $id_vh)
    {
        $ctr = new vehiculeController();
        $veh = $ctr->updateCar ($id_car, $value, $id_vh);
    //     echo "<p>ID Car: $id_car</p>";
    // echo "<p>Modified Value: $value</p>"; 
    }
   
    public function supp_car ($id_car)
    {
        $ctr = new vehiculeController();
        $veh = $ctr->delete_car ($id_car); 
    }
 
    
    public function gestion_car($id)
    {
        $ctr = new vehiculeController();
        $vehicule = $ctr->get_vhById($id);
    
        $ctr1 = new vehiculeController();
        $vehicule_car = $ctr1->get_VehCar($id);
    
        $ctr2 = new vehiculeController();
        $car = $ctr2->get_Car();
    
        $ctr2 = new marqueController();
        $marqueId = $vehicule[0]['marque'];
        $marque_table = $ctr2->get_details($marqueId);
        $marque = $marque_table[0]['Nom'];
    
        if (!empty($vehicule)) {
            $vehicule = $vehicule[0];
            ?>
            <div class="popup" id="modificationPopup">
                <form id="modificationForm" onsubmit="submitModification(); return false;">
                    <label for="modifiedValue">Modified Value:</label>
                    <input type="text" id="modifiedValue" name="modifiedValue" required><br>
    
                    <!-- Hidden input for id_car -->
                    <input type="hidden" id="idCarModification" name="idCarModification" value="">
    
                    <button type="submit">Submit Modification</button>
                </form>
                <button onclick="closeModificationPopup()">Close</button>
            </div>
    
            <div class="vehicule-details">
                <img src="data:image/jpeg;base64,<?php echo base64_encode($vehicule['image']); ?>" alt="Vehicule Photo">
                <p>Marque: <?php echo htmlspecialchars($marque); ?></p>
                <p>Modele: <?php echo htmlspecialchars($vehicule['modele']); ?></p>
                <p>Version: <?php echo htmlspecialchars($vehicule['version']); ?></p>
                <p>Annee: <?php echo htmlspecialchars($vehicule['annee']); ?></p>
            </div>
    
            <table>
                <thead>
                    <tr>
                        <th>Caracteristique</th>
                        <th>Valeur</th>
                        <th>Suppression</th>
                        <th>Modification</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($car as $row) {
                        $carac = $row['nom_carac'];
                        $id_car = $row['id_carac'];
                        $valueFound = false;
    
                        foreach ($vehicule_car as $row1) {
                            if ($id_car == $row1['id_car']) {
                                $valueFound = true;
                                $value = $row1['value_car'];
    
                                // Add links for Suppression and Modification
                                echo "<tr><td>$carac</td><td>$value</td>";
                                echo "<td><a href='../../router/adminRouter/gestionCar.php?id=$id_car&action=suppression'>Supprimer</a></td>";
                                echo "<td><a href='#' onclick='openModificationPopup($id_car)'>Modifier</a></td></tr>";
                                break;
                            }
                        }
    
                        if (!$valueFound) {
                            // Add links for Suppression and Modification with None value
                            echo "<tr><td>$carac</td><td>None</td>";
                            echo "<td><a href='gestion.php?id=$id_car&action=suppression'>Supprimer</a></td>";
                            echo "<td><a href='#' onclick='openModificationPopup($id_car)'>Modifier</a></td></tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
    
            <script>
                function openModificationPopup(idCar) {
                  
                    document.getElementById('idCarModification').value = idCar;
                    
                    document.getElementById('modificationPopup').style.display = 'block';
                }
    
                function closeModificationPopup() {
                  
                    document.getElementById('modificationPopup').style.display = 'none';
                }
    
                function submitModification() {
                    // Get the modified value and id_car
                    var modifiedValue = document.getElementById('modifiedValue').value;
                    var idCar = document.getElementById('idCarModification').value;
                    var idVehicule = <?php echo json_encode($id); ?>; 
    
                    // Add any validation or processing here if needed
    
                    // Redirect to gestionCarRouter.php with the modified value and id_car
                    window.location.href = 'gestionCarRouter.php?id=' + encodeURIComponent(idCar) + '&modifiedValue=' + encodeURIComponent(modifiedValue) + '&id_vehicule=' + encodeURIComponent(idVehicule);
    
                    // Close the popup
                    closeModificationPopup();
                }
            </script>
            <?php
        } else {
            ?>
            <h1>No details found for Vehicule <?php echo htmlspecialchars($marqueId); ?></h1>
            <?php
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
