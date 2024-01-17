<?php

require_once(__DIR__ . '/../../controller/diapormaContoller.php');
require_once(__DIR__ . '/../../controller/menuController.php');
require_once(__DIR__ . '/../../controller/marqueController.php');
require_once(__DIR__ . '/../../controller/vehiculeController.php');
require_once(__DIR__ . '/../../controller/aviController.php');
require_once(__DIR__ . '/../../controller/userController.php');


class aviVue {

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
       <link rel="stylesheet" type="text/css" href="../../styling/marque.css">
       <?php
    } 
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
              <h1 id="username">
    <a href="../../router/userRouter/userRouter.php?username=<?php echo urlencode($username); ?>">
        <img src="../../images/userIcon.png" alt="Avatar">
        <?php echo htmlspecialchars($username); ?>
    </a>
</h1>
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

    private function show_marque()
    {
        $ctr = new marqueController();
        $table = $ctr->get_marque();
        ?>
        <div class="after" >
        <h1> Toutes les marques  </h1>
        <div class="marque">
            <?php
            $images = array();
    
            foreach ($table as $row) {
                $images[] = array('logo' => $row['logo'], 'nom' => $row['Nom'], 'id_mrq' => $row['id_mrq']);
            }
            
    
      
            $rows = array_chunk($images, 4);
    

    foreach ($rows as $rowImages) {
        echo '<div class="logo-row">';

        
        foreach ($rowImages as $brandData) {
            $base64Img = base64_encode($brandData['logo']);
            $imgSrc = 'data:image/jpeg;base64,' . $base64Img;
        
            echo '<div class="brand-container">';
            
          
            echo '<a href="../../router/userRouter/aviRouter.php?id_mrq=' . $brandData['id_mrq'] . '">';
            echo '<img src="' . $imgSrc . '" alt="Image">';
            echo '</a>';
            
            echo '<div class="brand-name">' . htmlspecialchars($brandData['nom']) . '</div>';
            echo '</div>';
        }
        

        echo '</div>';
    }
    ?>
</div>
</div>

        <?php
    }


  //  $prinVh =  $ctr2->get_prinvh_v ($ids);
    

    public function show_details_marque ($id)
    {
    
        $ctr = new marqueController();
        $ctr2 = new vehiculeController();
        $marqueDetails = $ctr->get_details($id);
        $ids = $ctr->get_princVh ($id);
       
        $allVh =  $ctr->get_allVh ($id);



        if (!empty($marqueDetails)) {
            $marqueDetails = $marqueDetails[0]; // Assuming you want to use the first result if there are multiple rows
    
            // Display the details
            ?>
            
            <div class="marque-details">
                <img src="data:image/jpeg;base64,<?php echo base64_encode($marqueDetails['logo']); ?>" alt="Marque Logo">
                <p>Name: <?php echo htmlspecialchars($marqueDetails['Nom']); ?></p>
                <p>Country of Origin: <?php echo htmlspecialchars($marqueDetails['pays_origine']); ?></p>
                <p>Headquarters: <?php echo htmlspecialchars($marqueDetails['siege_social']); ?></p>
                <p>Year of Creation: <?php echo htmlspecialchars($marqueDetails['annee_creation']); ?></p>
                <p>History: <?php echo htmlspecialchars($marqueDetails['histoire']); ?></p>
                <p>Founders: <?php echo htmlspecialchars($marqueDetails['Fondateurs']); ?></p>
                <p>Slogan: <?php echo htmlspecialchars($marqueDetails['Slogan']); ?></p>
                <p>Products: <?php echo htmlspecialchars($marqueDetails['Produits']); ?></p>
                <p>Website: <a href="<?php echo htmlspecialchars($marqueDetails['Site_web']); ?>" target="_blank"><?php echo htmlspecialchars($marqueDetails['Site_web']); ?></a></p>

            <?php
              
             ?>   
               
            </div>
            <?php
        } else {
            // Handle the case where no details are found for the given ID
            ?>
            <h1>No details found for Marque <?php echo htmlspecialchars($marqueId); ?></h1>
            <?php
        }

        
        ?>
       
       ?>
<h2>Liste de tous les véhicules</h2>
<select id="vhSelector" onchange="redirectToDetails()">
    <option value="" selected>Sélectionner un véhicule</option> 
    <?php
    foreach ($allVh as $row) {
        $id_vh = $row['Id_veh'];
        $modele = $row['modele'];
        $version = $row['version'];
        $annee = $row['annee'];
        echo "<option value='$id_vh'>$modele $version $annee</option>";
    }
    ?>
</select>

<script>
    function redirectToDetails() {
        var selectedId = document.getElementById("vhSelector").value;
        if (selectedId) {
            window.location.href = "../../router/userRouter/vehiculeRouter.php?id_vhh=" + selectedId;
        }
    }
</script>
<?php



   


?>
<h1><h2>Principales vehicules </h2>
 </h1>
<div class="prinVh">
    <?php
    $images = array();
    foreach ($ids as $row) {
        $idp = $row['veh_p'];
        $prinVh =  $ctr2->get_vhById($idp);
        foreach ($prinVh as $vh) {
            $images[] = array('image' => $vh['image'], 'modele' => $vh['modele'], 'version' => $vh['version'], 'annee' => $vh['annee'] , 'Id_veh' => $vh['Id_veh']);
        }
    }


    $rows = array_chunk($images, 2 );

foreach ($rows as $rowImages) {
echo '<div class="logo-row">';

// Loop through each image in the row
foreach ($rowImages as $vehData) {
    $base64Img = base64_encode($vehData['image']);
    $imgSrc = 'data:image/jpeg;base64,' . $base64Img;

    echo '<div class="brand-container">';
    
    // Create a link with the correct id_mrq in the URL
    echo '<a href="../../router/userRouter/vehiculeRouter.php?id_vehh=' . $vehData['Id_veh'] . '">';
    echo '<img src="' . $imgSrc . '" alt="Image">';
    echo '</a>';
    
    echo '<div class="brand-name">' . htmlspecialchars($vehData['modele']) . '</div>';
    echo '<div class="brand-name">' . htmlspecialchars($vehData['version']) . '</div>';
    echo '<div class="brand-name">' . htmlspecialchars($vehData['annee']) . '</div>';
    echo '</div>';
}


echo '</div>';
}
 }

    public function show_marque_note($id) {
        $ctr3 = new marqueController();
        $notes = $ctr3->get_mrqNotes($id);
    
        if ($notes) {
            $allNotes = array();
            foreach ($notes as $row) {
                $note = $row['note'];
                $allNotes[] = $note;
            }
    
            // Calculate the average note
            $note_moyenne = array_sum($allNotes) / count($allNotes);
            ?>
            <div class="marque-note-container">
                <div class="marque-note-box">
                    <h1>Note de la marque : <span><?php echo number_format($note_moyenne, 1); ?></span></h1>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="marque-note-container">
                <div class="marque-note-box">
                    <h1>Note de la marque : <span>12.0</span></h1>
                </div>
            </div>
            <?php
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
                            window.location.href = 'http://localhost/tdwProjet/comparateurVehicule/router/userRouter/marqueRouter.php?username=' + encodeURIComponent(submittedUsername) + '&note=' + encodeURIComponent(submittedNote) + '&idd=' + encodeURIComponent(submittedId);

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
    

    
    public function add_note ($id_mrq, $note, $username) 
    {
        $ctr = new marqueController();
        $table = $ctr->add_NoteMrq($id_mrq, $note, $username );
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
        $this->show_marque();
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