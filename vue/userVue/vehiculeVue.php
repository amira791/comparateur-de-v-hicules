<?php

require_once(__DIR__ . '/../../controller/diapormaContoller.php');
require_once(__DIR__ . '/../../controller/menuController.php');
require_once(__DIR__ . '/../../controller/marqueController.php');
require_once(__DIR__ . '/../../controller/vehiculeController.php');
require_once(__DIR__ . '/../../controller/aviController.php');
require_once(__DIR__ . '/../../controller/userController.php');


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
            <button class="gestion" id="mrqq" onclick="window.location.href='http://localhost/tdwProjet/comparateurVehicule/router/userRouter/accueilRouter.php'">Page  Principal</button>
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
        $this->show_button_add_note($id);

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
    <button class="appreciation-button" onclick="openPopupAvi(<?php echo $avis['id_avi_veh']; ?>)">Ajouter Appréciation</button>

</div>
<div id="popupFormm" style="display: none;">
            <form id="registration" onsubmit="validateConnectionUser(); return false;">
            <input type="hidden" id="id_avi" name="id_avi" value="<?php echo  $avis['id_avi_veh']; ?>">
                <label for="user">Username:</label>
                <input type="text" id="user" name="user" required><br>
                <label for="password">Password:</label>
                <input type="pass" id="pass" name="pass" required><br>
                <button type="submit">Submit</button>
            </form>
        </div>
    

<script>
    function openPopupAvi(submittedId) {
        document.getElementById('id_avi').value = submittedId;
        document.getElementById('popupFormm').style.display = 'block';
    }

    function validateConnectionUser() {
        var submittedUsername = document.getElementById('user').value;
        var submittedPassword = document.getElementById('pass').value;
        var submittedId = document.getElementById('id_avi').value;
        var hiddenSelect = document.getElementById('hiddenSelect');

        for (var i = 0; i < hiddenSelect.options.length; i++) {
            var option = hiddenSelect.options[i];

            if (submittedUsername === option.dataset.username && submittedPassword === option.dataset.pass) {
                if (option.dataset.block === '1') {
                    alert('This user is blocked. Please contact support for assistance.');
                } else if (option.dataset.valide === 'Valide') {
                    alert("L'appréciation est bien ajoutée.");
                    window.location.href = 'http://localhost/tdwProjet/comparateurVehicule/router/userRouter/vehiculeRouter.php?action=ajout&id_avi=' + encodeURIComponent(submittedId);

                    document.getElementById('popupFormm').style.display = 'none';  // Close the popup
                    return;
                } else {
                    alert('Inscription n\'est pas encore valide. Please contact support for assistance.');
                }
                document.getElementById('popupFormm').style.display = 'none';  // Close the popup
                return;
            }
        }

        alert('Invalid credentials. Please try again.');
    }
</script>
<?php
    } 
?>
<button class="avi-button" onclick="openPopupAviAdd(<?php echo $id; ?>)">Ajouter Avi</button>
</div>
<div id="popupFormmm" style="display: none;">
            <form id="registration2" onsubmit="validateConnectionUserAvi(); return false;">
            <input type="hidden" id="id_veh" name="id_veh" value="<?php echo  $id; ?>">
                <label for="user">Username:</label>
                <input type="text" id="userr" name="userr" required><br>
                <label for="password">Password:</label>
                <input type="password" id="pass" name="passs" required><br>
                <label for="user">Contenu:</label>
                <input type="text" id="contenu" name="contenu" required><br>
                <button type="submit">Submit</button>
            </form>
        </div>
        <script>
    function openPopupAviAdd(submittedId) {
        document.getElementById('id_veh').value = submittedId;
        document.getElementById('popupFormmm').style.display = 'block';
    }

    function validateConnectionUserAvi() {
        var submittedUsername = document.getElementById('userr').value;
        var submittedPassword = document.getElementById('passs').value;
        var submittedContent = document.getElementById('contenu').value;
        var submittedId = document.getElementById('id_veh').value;
        var hiddenSelect = document.getElementById('hiddenSelect');

        for (var i = 0; i < hiddenSelect.options.length; i++) {
            var option = hiddenSelect.options[i];

            if (submittedUsername === option.dataset.username && submittedPassword === option.dataset.pass) {
                if (option.dataset.block === '1') {
                    alert('This user is blocked. Please contact support for assistance.');
                } else if (option.dataset.valide === 'Valide') {
                    alert("L'appréciation est bien ajoutée.");
                    window.location.href = 'http://localhost/tdwProjet/comparateurVehicule/router/userRouter/vehiculeRouter.php?action=ajoutAvi&id_mrq=' + encodeURIComponent(submittedId) 
                    + '&content=' + encodeURIComponent(submittedContent)+ '&username=' + encodeURIComponent(submittedUsername);

                    document.getElementById('popupFormmm').style.display = 'none';  // Close the popup
                    return;
                } else {
                    alert('Inscription n\'est pas encore valide. Please contact support for assistance.');
                }
                document.getElementById('popupFormmm').style.display = 'none';  // Close the popup
                return;
            }
        }

        alert('Invalid credentials. Please try again.');
    }
</script>
<?php
}

    
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
}
 }
private function show_popular_comp()
{
    ?>
    <h1 id="cmp" > Les comparaisons les plus recherches </h1>
    <?php
    $ctr = new vehiculeController();
    $cmp = $ctr->get_pop(); 

    // Check if $cmp is not null and is an array
    if (is_array($cmp) && count($cmp) > 0) {
        foreach ($cmp as $row) {
            echo '<div class="comparison-frame">';

            for ($i = 1; $i <= 4; $i++) {
                $id_vh = $row["id_vh$i"];
                
                if ($id_vh !== 0) {
                    $ctr_vh = new vehiculeController();
                    $vh = $ctr_vh->get_vhById($id_vh);
                    
                    if ($vh) {
                        $marque = $vh[0]['marque'];
                        $modele = $vh[0]['modele'];
                        $version = $vh[0]['version'];
                        $annee = $vh[0]['annee'];
                        $image = $vh[0]['image'];
                        $base64Img = base64_encode($image);
                        $imgSrc = 'data:image/jpeg;base64,' . $base64Img;

                        // Display each vehicle in a container
                        echo '<div class="vehicle-container">';
                        echo '<img src="' . $imgSrc . '" alt="Vehicle Image">';
                        echo '<p>Marque: ' . $marque . '</p>';
                        echo '<p>Modèle: ' . $modele . '</p>';
                        echo '<p>Version: ' . $version . '</p>';
                        echo '<p>Année: ' . $annee . '</p>';
                        echo '</div>';
                    }
                }
            }

            echo '</div>'; // Close the comparison-frame
        }
    } else {
        echo 'No popular comparisons available.';
    }
    
}
private function show_button_add_note($id)
    {
        $ctr = new userController();
        $table = $ctr->get_users();
        ?>
        <select id="hiddenSelect" style="display:none;">
            <?php
            foreach ($table as $row) {
                $username = $row['username'];
                $password = $row['password'];
                $block = $row['est_blockee'];
                $valide = $row['Valide_ins'];
                echo "<option data-username='$username' data-pass='$password' data-block='$block' data-valide='$valide'>$username - $password - $block - $valide </option>";
            }
            ?>
        </select>
        <?php
        // Display the button
        ?>
       <button onclick="openPopup(<?php echo $id; ?>)" type="button">Add Note</button>
    
        <!-- Popup form -->
        <div id="popupForm" style="display: none;">
            <form id="registrationForm" onsubmit="validateConnection(); return false;">
            <input type="hidden" id="submittedId" name="submittedId" value="<?php echo $id; ?>">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required><br>
    
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required><br>
    
                <label for="note">Note:</label>
                <input type="number" id="note" name="note" required><br>
    
                <button type="submit">Submit</button>
            </form>
        </div>
    
        <script>
            function openPopup(submittedId) {
                document.getElementById('submittedId').value = submittedId;
        document.getElementById('popupForm').style.display = 'block';
              
            }
    
            function validateConnection() {
                var hiddenSelect = document.getElementById('hiddenSelect');
        var submittedUsername = document.getElementById('username').value;
        var submittedPassword = document.getElementById('password').value;
        var submittedNote = document.getElementById('note').value;
        var submittedId = document.getElementById('submittedId').value;
    
                for (var i = 0; i < hiddenSelect.options.length; i++) {
                    var option = hiddenSelect.options[i];
                    console.log('Checking:', option.dataset.username, option.dataset.pass);
    
                    if (submittedUsername === option.dataset.username && submittedPassword === option.dataset.pass) {
                        console.log('Match found:', submittedUsername, submittedPassword);
                        if (option.dataset.block === '1') {
                            alert('This user is blocked. Please contact support for assistance.');
                        } else if (option.dataset.valide === 'Valide') {
                            alert("La note est attribuee: " + submittedNote);
                            window.location.href = 'http://localhost/tdwProjet/comparateurVehicule/router/userRouter/vehiculeRouter.php?username=' + encodeURIComponent(submittedUsername) + '&note=' + encodeURIComponent(submittedNote) + '&idd=' + encodeURIComponent(submittedId);

document.getElementById('popupForm').style.display = 'none';  // Close the popup
return;
                        } else {
                            alert('Inscription n\'est pas encore valide. Please contact support for assistance.');
                        }
                        document.getElementById('popupForm').style.display = 'none';  // Close the popup
                        return;  // Exit the loop once a match is found
                    }
                }
    
                alert('Invalid credentials. Please try again.');
            }
        </script>
        <?php
    }

public function add_note_veh ($id_mrq, $note, $username) 
{
    $ctr = new vehiculeController();
    $table = $ctr->add_NoteVeh($id_mrq, $note, $username );
}

public function ajout_app_veh ($id_avi)
{
    $ctr = new aviController();
    $table = $ctr-> addApprAvi_Veh ($id_avi);

}
public function ajout_avi_veh ($content, $id_veh, $username)
{
    $ctr = new aviController();
    $table = $ctr-> addAvi_Veh ($content, $id_veh, $username);

}

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