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