<?php

require_once(__DIR__ . '/../../controller/diapormaContoller.php');
require_once(__DIR__ . '/../../controller/menuController.php');
require_once(__DIR__ . '/../../controller/marqueController.php');
require_once(__DIR__ . '/../../controller/vehiculeController.php');


class marqueVue {

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

    private function show_top_bar()
    {
        ?>
        <div class="background-container">
            
                <img src="../../images/logo" id="logo">
                <button class="auth" id="connec">Sign In</button>
                <button class="auth" id="ins">Sign Up</button>
            
            <div class="background-rectangle"></div>
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
                $champLocation = htmlspecialchars($row['location']); // Assuming 'champ_location' is the column name in your database
    
                // Link each menu item to its champ location with white text color
                echo '<div class="menu-item"><a href="' . $champLocation . '" style="color: white;">' . $designation . '</a></div>';
            }
            ?>
        </div>
        <?php
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
                $images[] = array('logo' => $row['logo'], 'nom' => $row['Nom'], 'id_mrq' => $row['id_mrq']);
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
            
            // Create a link with the correct id_mrq in the URL
            echo '<a href="../../router/userRouter/marqueRouter.php?id_mrq=' . $brandData['id_mrq'] . '">';
            echo '<img src="' . $imgSrc . '" alt="Image">';
            echo '</a>';
            
            echo '<div class="brand-name">' . htmlspecialchars($brandData['nom']) . '</div>';
            echo '</div>';
        }
        

        echo '</div>';
    }
    ?>
</div>

        <?php
    }


  //  $prinVh =  $ctr2->get_prinvh_v ($ids);
    

    public function show_details_marque ($id)
    {
        echo "Details for Marque with ID: $id";
        $ctr = new marqueController();
        $ctr2 = new vehiculeController();
        $marqueDetails = $ctr->get_details($id);
        $ids = $ctr->get_princVh ($id);
       
        $allVh =  $ctr->get_allVh ($id);



        if (!empty($marqueDetails)) {
            $marqueDetails = $marqueDetails[0]; // Assuming you want to use the first result if there are multiple rows
    
            // Display the details
            ?>
            <h1>Details for Marque <?php echo htmlspecialchars($id); ?></h1>
            <div class="marque-details">
                <img src="data:image/jpeg;base64,<?php echo base64_encode($marqueDetails['logo']); ?>" alt="Marque Logo">
                <p>Name: <?php echo htmlspecialchars($marqueDetails['Nom']); ?></p>
                <p>Country of Origin: <?php echo htmlspecialchars($marqueDetails['pays_origine']); ?></p>
                <p>Headquarters: <?php echo htmlspecialchars($marqueDetails['siege_social']); ?></p>
                <p>Year of Creation: <?php echo htmlspecialchars($marqueDetails['annee_creation']); ?></p>
                <p>Experience with Clients: <?php echo htmlspecialchars($marqueDetails['exp_client']); ?></p>
                <p>History: <?php echo htmlspecialchars($marqueDetails['histoire']); ?></p>
                <p>Founders: <?php echo htmlspecialchars($marqueDetails['Fondateurs']); ?></p>
                <p>Slogan: <?php echo htmlspecialchars($marqueDetails['Slogan']); ?></p>
                <p>Products: <?php echo htmlspecialchars($marqueDetails['Produits']); ?></p>
                <p>Website: <a href="<?php echo htmlspecialchars($marqueDetails['Site_web']); ?>" target="_blank"><?php echo htmlspecialchars($marqueDetails['Site_web']); ?></a></p>
                <!-- Add more details as needed -->
            </div>
            <?php
        } else {
            // Handle the case where no details are found for the given ID
            ?>
            <h1>No details found for Marque <?php echo htmlspecialchars($marqueId); ?></h1>
            <?php
        }
        
        ?>
       
<h2>Liste de tous les vehicules</h2>
<select id="vhSelector">
    <option value="" selected>vehicule</option> 
    <?php
    foreach ($allVh as $row) {
       
        $modele = $row['modele'];
        $version = $row['version'];
        $annee = $row['annee'];
        echo "<option value='$id'>$modele $version $annee</option>";
    }
    ?>
</select>
<?php
  //  $prinVh =  $ctr2->get_prinvh_v ($ids);

    ?>
<h2>Principales marques test</h2>
<select id="pr">
    <option value="" selected>vehicule</option> 
    <?php
    foreach ($ids as $row) {
       
            $idp = $row['veh_p'];
            echo "<option value='$idp'> $idp</option>";
    }
    ?>
</select>
        <?php
    
    ?>
<h2>Principales vehicules</h2>
<select id="p">
    <option value="" selected>vehicule</option> 
    <?php
    foreach ($ids as $row) {
            $idp = $row['veh_p'];
            $prinVh =  $ctr2->get_vhById($idp);
            foreach ($prinVh as $vh) {
       
                $modele = $vh['modele'];
                $version = $vh['version'];
                $annee = $vh['annee'];
                echo "<option value='$id'>$modele $version $annee</option>";
            }
    }
    ?>
</select>
        <?php

?>
<h1><h2>Principales vehicules 22 </h2>
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
    echo '<a href="../../router/userRouter/vehiculeRouter.php?id_veh=' . $vehData['Id_veh'] . '">';
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