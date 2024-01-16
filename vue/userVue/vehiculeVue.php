<?php

require_once(__DIR__ . '/../../controller/diapormaContoller.php');
require_once(__DIR__ . '/../../controller/menuController.php');
require_once(__DIR__ . '/../../controller/marqueController.php');
require_once(__DIR__ . '/../../controller/vehiculeController.php');
require_once(__DIR__ . '/../../controller/aviController.php');


class vehiculeVue {

    private function show_title_page()
    {
        ?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Marka_Vehicule Compartor </title>
        <?php
    }

    private function show_styling() {
        {
           ?>
           <link rel="stylesheet" type="text/css" href="../../styling/vehicule.css">
           <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
           <meta charset="UTF-8">
           <meta http-equiv="X-UA-Compatible" content="IE=edge">
           <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="pragma" content="no cache" />
           <?php
        }
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
                echo '<div class="menu-item"><a href="' . $champLocation . '" style="color: white;">' . $designation . '</a></div>';
            }
            ?>
        </div>
        <?php
    }

   



    public function show_details_vh ($id)
    {

       
        $ctr = new vehiculeController();
        $vehicule = $ctr->get_vhById($id);
    
        $ctr1 = new vehiculeController();
        $vehicule_car = $ctr1->get_VehCar($id);
    
        $ctr2 = new vehiculeController();
        $car = $ctr2->get_Car();
    
        $ctr2 = new marqueController();
        $id = $vehicule[0]['marque'];
        $marque_table = $ctr2->get_details($id);
        $marque = $marque_table[0]['Nom'];
    
        if (!empty($vehicule)) {
            $vehicule = $vehicule[0];
            ?>
            <h1>Details for Vehicule </h1>
    
            <div class="vehicule-details">
                <img src="data:image/jpeg;base64,<?php echo base64_encode($vehicule['image']); ?>" alt="Vehicule Photo">
                <p>Marque: <?php echo htmlspecialchars($marque); ?></p>
                <p>Modele: <?php echo htmlspecialchars($vehicule['modele']); ?></p>
                <p>Version: <?php echo htmlspecialchars($vehicule['version']); ?></p>
                <p>Annee: <?php echo htmlspecialchars($vehicule['annee']); ?></p>
            </div>
    
            <h1> Plus de details </h1>
            <table>
                <thead>
                    <tr>
                        <th>Carateristique</th>
                        <th>Valeur</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($car as $row) {
                        $carac = $row['nom_carac'];
                        $id_car = $row['id_carac'];
                        $valueFound = false;
    
                        foreach ($vehicule_car as $row1) {
                            if ($id_car == $row1['id_car'] ) {
                                $valueFound = true;
                                $value = $row1['value_car'];
                                echo "<tr><td>$carac</td><td>$value</td></tr>";
                                break;
                            }
                        }
    
                        if (!$valueFound) {
                            echo "<tr><td>$carac</td><td>None</td></tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
    
        <?php
        } else {
            ?>
            <h1>No details found for Vehicule <?php echo htmlspecialchars($marqueId); ?></h1>
        <?php
        }

    }

    public function show_details_vh_pr($id)
    {
    
       
        $ctr = new vehiculeController();
        $vehicule = $ctr->get_vhById($id);
    
        $ctr1 = new vehiculeController();
        $vehicule_car = $ctr1->get_VehCar($id);
    
        $ctr2 = new vehiculeController();
        $car = $ctr2->get_Car();
    
        $ctr2 = new marqueController();
        $id = $vehicule[0]['marque'];
        $marque_table = $ctr2->get_details($id);
        $marque = $marque_table[0]['Nom'];
    
        if (!empty($vehicule)) {
            $vehicule = $vehicule[0];
            ?>
            <h1>Details for Vehicule </h1>
    
            <div class="vehicule-details">
                <img src="data:image/jpeg;base64,<?php echo base64_encode($vehicule['image']); ?>" alt="Vehicule Photo">
                <p>Marque: <?php echo htmlspecialchars($marque); ?></p>
                <p>Modele: <?php echo htmlspecialchars($vehicule['modele']); ?></p>
                <p>Version: <?php echo htmlspecialchars($vehicule['version']); ?></p>
                <p>Annee: <?php echo htmlspecialchars($vehicule['annee']); ?></p>
            </div>
    
            <h1> Plus de details </h1>
            <table>
                <thead>
                    <tr>
                        <th>Carateristique</th>
                        <th>Valeur</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($car as $row) {
                        $carac = $row['nom_carac'];
                        $id_car = $row['id_carac'];
                        $valueFound = false;
    
                        foreach ($vehicule_car as $row1) {
                            if ($id_car == $row1['id_car'] ) {
                                $valueFound = true;
                                $value = $row1['value_car'];
                                echo "<tr><td>$carac</td><td>$value</td></tr>";
                                break;
                            }
                        }
    
                        if (!$valueFound) {
                            echo "<tr><td>$carac</td><td>None</td></tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
    
        <?php
        } else {
            ?>
            <h1>No details found for Vehicule <?php echo htmlspecialchars($marqueId); ?></h1>
        <?php
        }
    }
    
    public function show_vhNote($id) {
        $ctr3 = new vehiculeController();
        $notes = $ctr3->get_VehNotes($id);
    
        if ($notes) {
            $allNotes = array();
            foreach ($notes as $row) {
                $note = $row['note'];
                $allNotes[] = $note;
            }
    
            // Calculate the average note
            $note_moyenne = array_sum($allNotes) / count($allNotes);
            ?>
            <div class="vehicule-note-container">
                <div class="vehicule-note-box">
                    <h1>Note de la Vehicule : <span><?php echo number_format($note_moyenne, 1); ?></span></h1>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="vehicule-note-container">
                <div class="vehicule-note-box">
                    <h1>Note de la Vehicule : <span>12.0</span></h1>
                </div>
            </div>
            <?php
        }


    }  
    
    
    public function show_avi_vh ($id)
    {
        $ctr3 = new aviController();
        $avi3 = $ctr3->get_avi_tois_Vh($id);
?>
<h2> Les avis </h2>
<?php
foreach ($avi3 as $avis) {
   
    $userName = $avis['username'];
    $reviewContent = $avis['contenu_veh'];
    $appreciationCount = $avis['nb_appreciation_veh'];
?>
<div class="avis">
<div class="user-icon">
    <img src="../../images/userIcon.jpg" >
    </div>
    <div class="user-name"><?php echo $userName; ?></div>
    <div class="review-content"><?php echo $reviewContent; ?></div>
    <div class="appreciation-count">Appréciation : <?php echo $appreciationCount; ?></div>
    <button class="appreciation-button" onclick="addAppreciation(<?php echo $avis['id_avi_veh']; ?>)">Ajouter Appréciation</button>
</div>
<?php
    } }

    
    public function show_details_vh_avi($id)
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
            <h1>Details for Vehicule </h1>
    
            <div class="vehicule-details">
                <img src="data:image/jpeg;base64,<?php echo base64_encode($vehicule['image']); ?>" alt="Vehicule Photo">
                <p>Marque: <?php echo htmlspecialchars($marque); ?></p>
                <p>Modele: <?php echo htmlspecialchars($vehicule['modele']); ?></p>
                <p>Version: <?php echo htmlspecialchars($vehicule['version']); ?></p>
                <p>Annee: <?php echo htmlspecialchars($vehicule['annee']); ?></p>
                
                <p><a href="../../router/userRouter/vehiculeRouter.php?id_vh=<?php echo $id; ?>">Description</a></p>
            </div>
        <?php
        }
        $ctr = new vehiculeController();
$avis = $ctr->get_avis($id);
foreach ($avis as $row) {
    $userName = $row['username'];
    $reviewContent = $row['contenu_veh'];
    $appreciationCount = $row['nb_appreciation_veh'];
    ?>
    <div class="avis">
        <div class="user-icon">
            <img src="../../images/userIcon.jpg" >
        </div>
        <div class="user-name"><?php echo $userName; ?></div>
        <div class="review-content"><?php echo $reviewContent; ?></div>
        <div class="appreciation-count">Appréciation : <?php echo $appreciationCount; ?></div>
        <button class="appreciation-button" onclick="addAppreciation(<?php echo $row['id_avi_veh']; ?>)">Ajouter Appréciation</button>
    </div>
    <?php
} }
    

    public function Head_Page ()
    {
        echo '<head>';
        $this-> show_title_page();
        $this-> define_library();
        $this-> show_styling();
        echo '</head>';
    }

    public function Body_Page()
    {
        echo '<body>';
        $this->show_top_bar();
        $this->show_menu();
        echo '</body>';
    }
    public function show_website ()
    {
       echo '<html>'; 
       $this->Head_Page();
       $this->Body_Page();
       echo '</html>'; 
  
    }
}

?>