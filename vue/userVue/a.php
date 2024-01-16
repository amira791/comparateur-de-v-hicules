<?php
require_once('../../vue/userVue/marqueVue.php');

$vue = new marqueVue();
$vue->show_website();

$router = new marqueRouter();

// Log the entire $_SERVER array
error_log("Incoming Request: " . print_r($_SERVER, true));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the data is received
    $postData = file_get_contents("php://input");
    error_log("Received POST request with data: " . $postData);

    // Decode JSON data if present
    $jsonData = json_decode($postData, true);

    if ($jsonData !== null) {
        if (isset($jsonData['marqueId'])) {
            $id = $jsonData['marqueId'];

            if (!empty($id)) {
                $router->show_details($id);
            } else {
                echo 'Invalid ID provided.';
            }
        } else {
            echo 'ID not provided or not in the expected format.';
        }
    } else {
        echo 'Error decoding JSON data.';
    }
} else {
    echo 'Invalid request method.';
}

class marqueRouter 
{
    public function show_details($id) {
        $marqueVue = new marqueVue();
        $marqueVue->show_details_marque($id);
    }
}




private function show_marque()
{
    $ctr = new marqueController();
    $table = $ctr->get_marque();
    ?>
    <h1> Les principales marques </h1>
    <div class="marque">
        <?php
        $images = array();

        foreach ($table as $row) {
            $images[] = array('id' => $row['id_mrq'], 'logo' => $row['logo'], 'nom' => $row['Nom']);
        }

        // Split the images into rows of 4
        $rows = array_chunk($images, 4);

        // Loop through each row
// Loop through each row
foreach ($rows as $rowImages) {
    echo '<div class="logo-row">';

    // Loop through each image in the row
    foreach ($rowImages as $brandData) {
        $base64Img = base64_encode($brandData['logo']);
        $imgSrc = 'data:image/jpeg;base64,' . $base64Img;

        echo '<div class="brand-container">';
        // Link around the logo with the marque ID as a parameter
        echo '<a href="#" onclick="redirectToMarqueDetails(' . $brandData['id'] . '); return false;">';
        echo '<img src="' . $imgSrc . '" alt="Image">';
        echo '</a>';
        echo '<div class="brand-name">' . htmlspecialchars($brandData['nom']) . '</div>';
        echo '</div>';
    }

    echo '</div>';
}
?>
</div>
<script>
function redirectToMarqueDetails(marqueId) {
console.log("test");
console.log(marqueId);

function send(callback) {
    // Create a JSON object with the data
    var data = {
        marqueId: marqueId
    };

    // Convert the data to a JSON string
    var jsonData = JSON.stringify(data);

    // Send a POST request to the PHP router
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../../router/userRouter/marqueRouter.php', true);

    // Set the appropriate headers
    xhr.setRequestHeader('Content-Type', 'application/json');

    // Set up the callback for handling the response
    xhr.onload = function () {
        if (xhr.status === 200) {
            // If the request was successful, call the callback with the response
            callback(null, xhr.responseText);
        } else {
            // If there was an error, call the callback with an error message
            callback('Error: ' + xhr.status);
        }
    };

    // Send the JSON data
    xhr.send(jsonData);
}

// Call the send function with a callback
send(function (error, response) {
    if (error) {
        console.error(error);
    } else {
        console.log('Response:', response);
        // You can do something with the response here
    }
});
}




</script>
    <?php
}

?>








<h1> Les principales vehicules </h1>
        <div class="vhicule">
            <?php
            $images = array();
    
            foreach ($prinVh as $row) {
                $images[] = array('image' => $row['image'], 'modele' => $row['modele'],'version' => $row['version'], 'annee' => $row['annee'], 'Id_veh' => $row['Id_veh']);
            }
            
    
            // Split the images into rows of 4
            $rows = array_chunk($images, 2);
    
            // Loop through each row
    // Loop through each row
    foreach ($rows as $rowImages) {
        echo '<div class="img-row">';

        // Loop through each image in the row
        foreach ($rowImages as $brandData) {
            $base64Img = base64_encode($brandData['image']);
            $imgSrc = 'data:image/jpeg;base64,' . $base64Img;
        
            echo '<div class="brand-container">';
            
            // Create a link with the correct id_mrq in the URL
            echo '<a href="../../router/userRouter/vehiculeRouter.php?id_vh=' . $brandData['id_vh'] . '">';
            echo '<img src="' . $imgSrc . '" alt="Image">';
            echo '</a>';
            
            echo '<div class="brand-name">' . htmlspecialchars($brandData['modele']) . '</div>';
            echo '<div class="brand-name">' . htmlspecialchars($brandData['version']) . '</div>';
            echo '<div class="brand-name">' . htmlspecialchars($brandData['annee']) . '</div>';
            echo '</div>';
        }
        

        echo '</div>';
    }
    ?>
</div>













<?php
require_once('../../vue/adminVue/gestionVehiculeVue.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id_mrq = $_POST["id_mrq"];
    $modele = $_POST["modele"];
    $version = $_POST["version"];
    $annee = $_POST["annee"];
    $image = $_POST["image"];
  



// Checking if the file was uploaded successfully
if(isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {
    $imageBlob = file_get_contents($_FILES["image"]["tmp_name"]);

    // For illustration purposes, you can echo the received data
    echo "ID_MRQ: " . $id_mrq . "<br>";
    echo "Modele: " . $modele . "<br>";
    echo "Version: " . $version . "<br>";
    echo "Annee: " . $annee . "<br>";

    
    $targetDir = "C:/Users/DELL/Desktop/2CS/TDW/Projet/img_dev/"; // Change this to your desired directory
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        echo "File uploaded successfully.";
    } else {
        echo "Error uploading file.";
    }
} else {
    echo "Error: No file uploaded or an error occurred.";
}


} 

$vue = new gestionVehiculeVue();
$vue->show_website();

class accueilRouter 
    {
        public function is_connected($username) {
            $accueil = new accueilVue();
            $accueil->show_top_bar($username);
        }
    }


?>









/***************  The modifiction form **************/
                echo '<div id="modifyMarquePopup_' . $id_mrq . '" class="popup">';
                echo '<div class="popup-content">';
                echo '<span class="close" onclick="closeModifyMarquePopup(' . $id_mrq . ');">&times;</span>';
            
                echo '<form action="../../router/adminRouter/gestionMarqueRouter.php" method="post" enctype="multipart/form-data" class="modify-vehicle-form">';
                echo '<input type="hidden" name="id_mrq" value="' . $id_mrq . '">';
                echo '<label for="nom_mrq"> Nom Marque:</label>';
                echo '<input type="text" name="nom_mrq" value="' . htmlspecialchars($nom_mrq) . '" required class="form-input">';
                echo '<label for="pays_origine"> Pays Origine:</label>';
                echo '<input type="text" name="pays_origine" value="' . htmlspecialchars($pays_origine) . '" required class="form-input">';
                echo '<label for="$siege_social"> Siege Social:</label>';
                echo '<input type="text" name="$siege_social" value="' . htmlspecialchars($siege_social) . '" required class="form-input">';
                echo '<label for="annee_creation"> Annee Creation:</label>';
                echo '<input type="text" name="annee_creation" value="' . htmlspecialchars($annee_creation) . '" required class="form-input">';
                echo '<label for="histoire"> Histoire:</label>';
                echo '<input type="text" name="histoire" value="' . htmlspecialchars($histoire) . '" required class="form-input">';
                echo '<label for="Fondateurs"> Fondateurs:</label>';
                echo '<input type="text" name="Fondateurs" value="' . htmlspecialchars($Fondateurs) . '" required class="form-input">';
                echo '<label for="Slogan">Slogan:</label>';
                echo '<input type="text" name="Slogan" value="' . htmlspecialchars($Slogan) . '" required class="form-input">';
                echo '<label for="siege"> Produits:</label>';
                echo '<input type="text" name="Produitse" value="' . htmlspecialchars($Produits) . '" required class="form-input">';
                echo '<label for="Produits"> Site_web:</label>';
                echo '<input type="text" name="Site_web" value="' . htmlspecialchars($Site_web) . '" required class="form-input">';
                echo '<div class="current-image-container">';
                echo '<label for="image">Current Image:</label>';
                echo '<img src="data:image/jpeg;base64,' . base64_encode($logo) . '" alt="Current Image" class="current-image">';
                echo '<input type="hidden" name="currentImage" value="' . base64_encode($logo) . '">';
                echo '</div>';
                echo '<label for="newImage" class="file-label">Choose a New Image:</label>';
                echo '<div class="file-input-container">';
                echo '<input type="file" name="newImage" accept="image/*" class="file-input" onchange="displayFileName(this)">';
                echo '<span id="file-name" class="file-name">No file chosen</span>';
                echo '</div>';
                echo '<input type="hidden" name="action" value="modify">';
                echo '<button type="submit" class="modify-marque-button">Modify Marque</button>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
            


                /************* Ajout Form ******************************** */
            echo '<button onclick="openAddVMarquePopup(' . $id_mrq . ')" class="add-marque-button">Add a new Marque</button>';
            echo '</div>'; 


        echo '<div id="addMarquePopup_' . $id_mrq . '" class="popup">';
        echo '<div class="popup-content">';
        echo '<span class="close" onclick="closeAddVehiclePopup(' . $id_mrq . ');">&times;</span>';
        echo '<form action="../../router/adminRouter/gestionMarqueRouter.php" method="post" enctype="multipart/form-data" class="add-vehicle-form">';
    
// Hidden input for $id_mrq
        echo '<input type="hidden" name="id_mrq" value="' . $id_mrq . '">';
    
        echo '<label for="modele">Nom Marque:</label>';
        echo '<input type="text" name="name" required class="form-field">';
    
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
echo '<button type="submit" class="add-marque-button">Submit</button>';
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






        public function update_marque_table($id_mrq, $logo, $Nom, $pays_origine, $siege_social, $annee_creation, $histoire, $Fondateurs, $Slogan, $Produits, $Site_web)
{
    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);

    // Check if $logo is an array and contains the 'tmp_name' key
    if (is_array($logo) && isset($logo['tmp_name'])) {
        // Read image data from file
        $imageData = file_get_contents($logo['tmp_name']);
    } else {
        // Assume $logo is already binary image data
        $imageData = $logo;
    }

    // Use prepared statement to update the database
    $query = "UPDATE marque
              SET 
              logo = ?,
              Nom = ?,
              pays_origine = ?,
              siege_social = ?,
              annee_creation = ?,
              histoire = ?,
              Fondateurs = ?,
              Slogan = ?, 
              Produits = ?,
              Site_web = ?
              WHERE id_mrq = ?";

    $stmt = mysqli_prepare($conn, $query);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, 'bsssssssssi', $imageData, $Nom, $pays_origine, $siege_social, $annee_creation, $histoire, $Fondateurs, $Slogan, $Produits, $Site_web, $id_mrq);

    // Execute the statement
    $res = mysqli_stmt_execute($stmt);

    // Check for errors
    if ($res === false) {
        // Handle errors as needed
        echo "Error: " . mysqli_error($conn);
    }

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    $this->deconnect($conn);
}

 



public function get_mrq_Id ($id)
{
     
     if (empty($id)) {
        return array(); 
    }

    $conn = $this->connect($this->servername, $this->username, $this->password, $this->database);

   

    $query = "SELECT * FROM marque WHERE id_mrq = $id";
   
    $res = $this->requete($conn, $query);
    $this->deconnect($conn);

    $mrq = array();
    while ($row = $res->fetch_assoc()) {
        $mrq[] = $row;
    }
    return  $mrq;

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
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>

            <label for="note">Note:</label>
            <input type="number" id="note" name="note" required><br>
            <input type="hidden" id="submittedId" name="submittedId" value="<?php echo $id; ?>">

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

// Correct way to get the submittedId value
var submittedId = document.getElementById('submittedId').value;

for (var i = 0; i < hiddenSelect.options.length; i++) {
    var option = hiddenSelect.options[i];
    console.log('Checking:', option.dataset.username, option.dataset.pass);

    if (submittedUsername === option.dataset.username && submittedPassword === option.dataset.pass) {
        console.log('Match found:', submittedUsername, submittedPassword);
        if (option.dataset.block === '1') {
            alert('This user is blocked. Please contact support for assistance.');
        } else if (option.dataset.valide === 'Valide') {
            alert("La note est bien attribue: " + submittedNote);
            window.location.href = 'http://localhost/tdwProjet/comparateurVehicule/router/userRouter/marqueRouter.php?username=' + encodeURIComponent(submittedUsername) + '&note=' + encodeURIComponent(submittedNote) + '&id=' + encodeURIComponent(submittedId);

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