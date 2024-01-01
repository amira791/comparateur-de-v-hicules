<?php

require_once('../../controller/diapormaContoller.php');
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
             <img src="../../images/logo"   >
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