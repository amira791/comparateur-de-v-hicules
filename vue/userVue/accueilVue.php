<?php 
class AccueilVue {


    private function show_title_page()
    {
        ?>
        <title> Marka_Vehicule Compartor </title>
        <?php
    }

    private function show_styling()
    {
       ?>
       <link rel="stylesheet" type="text/css" href="../../styling/template.css">
       <?php
    }
    private function show_logo()
    {
        ?>
        <div class="logo">
        <img src="../../images/logo">
        </div>
       <?php
        
    }

    private function show_button_connec()
    {
        ?>
        <button class="auth" id="connec"> Sign In </button>
        <button class="auth" id="ins"> Sign Up </button>
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
        $this->show_logo();
        $this->show_button_connec();
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