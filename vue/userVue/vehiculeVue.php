<?php

require_once(__DIR__ . '/../../controller/diapormaContoller.php');
require_once(__DIR__ . '/../../controller/menuController.php');
require_once(__DIR__ . '/../../controller/marqueController.php');
require_once(__DIR__ . '/../../controller/vehiculeController.php');


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
                <button class="auth" id="connec">Connection</button>
                <button class="auth" id="ins">Inscription</button>
            
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
                $champLocation = htmlspecialchars($row['location']); 
                echo '<div class="menu-item"><a href="' . $champLocation . '" style="color: white;">' . $designation . '</a></div>';
            }
            ?>
        </div>
        <?php
    }

   


  



    public function show_details_vh ($id)
    {

        echo "Details for Vehicule : $id";
        $ctr = new vehiculeController();
        $vehicule = $ctr->get_vhById ($id);




        if (!empty($vehicule)) {
            $vehicule = $vehicule[0]; 
    
    
            ?>
            <h1>Details for Vehicule <?php echo htmlspecialchars($id); ?></h1>
            <div class="vehicule-details">
                <img src="data:image/jpeg;base64,<?php echo base64_encode($vehicule['image']); ?>" alt="Vehicule Photo">
                <p>Marque: <?php echo htmlspecialchars($vehicule['marque']); ?></p>
                <p>Modele: <?php echo htmlspecialchars($vehicule['modele']); ?></p>
                <p>Version: <?php echo htmlspecialchars($vehicule['version']); ?></p>
                <p>Annee: <?php echo htmlspecialchars($vehicule['annee']); ?></p>
              
               
            </div>
            <?php
        } else {
           
            ?>
            <h1>No details found for Marque <?php echo htmlspecialchars($marqueId); ?></h1>
            <?php
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