<?php

require_once('../../controller/diapormaContoller.php');
require_once('../../controller/menuController.php');
require_once('../../controller/marqueController.php');
require_once('../../controller/vehiculeController.php');
class AccueilVue {


    private function show_title_page()
    {
        ?>
        <title> Marka_Vehicule Compartor </title>
        <?php
    }

    private function show_styling() {
    {
       ?>
       <link rel="stylesheet" type="text/css" href="../../styling/accueil.css">
       <?php
    }

    }

    private function show_top_bar ()
    {
        ?>
      <div class="topBar" id="top">
             <img src="../../images/logo" id="logo"   >
             <button class="auth" id="connec"> Sign In </button>
             <button class="auth" id="ins"> Sign Up </button>       
      </div>
       <?php
        
    }

    private function show_diaporma()
    {
        $ctr = new diapormaController();
        $table = $ctr->get_diaporma();
        ?>
        <div class="diap">
        <?php
        $images = array();
    
        foreach ($table as $row) {
            $images[] = $row['image_diap']; 
        }
    
        foreach ($images as $imgData) {
            $base64Img = base64_encode($imgData);
            $imgSrc = 'data:image/jpeg;base64,' . $base64Img;
            echo '<img src="' . $imgSrc . '" alt="Image">';
        }
        ?>
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
            $menu_items = array();
    
            foreach ($table as $row) {
                $menu_items[] = $row['designation'];
            }
    
            foreach ($menu_items as $item) {
                echo '<div class="menu-item">' . htmlspecialchars($item) . '</div>';
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
            $images[] = $row['logo']; 
        }
    
        // Split the images into rows of 4
        $rows = array_chunk($images, 4);
    
        // Loop through each row
        foreach ($rows as $rowImages) {
            echo '<div class="logo-row">';
    
            // Loop through each image in the row
            foreach ($rowImages as $imgData) {
                $base64Img = base64_encode($imgData);
                $imgSrc = 'data:image/jpeg;base64,' . $base64Img;
                echo '<img src="' . $imgSrc . '" alt="Image">';
            }
    
            echo '</div>';
        }
        ?>
        </div>
        <?php
    }
    

    private function show_list_type()
{
    $ctr = new vehiculeController();
    $table = $ctr->get_typeVh();
    ?>
    <h2> Selectionner le type du vehicule </h2> 
    <select>
        <?php
        foreach ($table as $row) {
            $type = $row['type'];
            echo "<option value='$type'>$type</option>";
        }
        ?>
    </select>
    <?php
}

    
   
    public function Head_Page ()
    {
        echo '<head>';
        $this-> show_title_page();
        $this-> show_styling();
        echo '</head>';
    }

    public function Body_Page()
    {
        echo '<body>';
        $this->show_top_bar();
        $this->show_diaporma();
        $this->show_menu();
        $this->show_marque();
        $this->show_list_type();
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