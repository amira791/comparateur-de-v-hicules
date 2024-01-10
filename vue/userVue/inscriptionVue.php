<?php

require_once(__DIR__ . '/../../controller/userController.php');


class inscriptionVue {

    private function show_title_page()
    {
        ?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Marka_Vehicule Compartor </title>
        <?php
    }



    
   
    
    private function show_form_inscription() {
        ?>
        <div class="registration-container">
            <h2>User Registration</h2>
            <form action="inscriptionRouter.php" method="post" id="registerForm">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
    
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
    
                <label for="confirmPassword">Confirm Password:</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required>
    
                <button type="submit">Register</button>
                <button class="return-button" onclick="window.location.href='http://localhost/tdwProjet/comparateurVehicule/router/userRouter/accueilRouter.php'">Revenir au page accueil</button>
            </form>
        </div>
        <?php
    }
    
    


    public function inscrire($username, $password)
    {
        if ($username && $password) {
            $ctr = new userController();
            $ctr->add_user($username, $password);
            echo '<script>alert("Vous êtes inscrit avec succès");</script>';
        } else {
            echo '<script>alert("Information manquante: username or password");</script>';
        }
    }
    
    
    
 
    
        



    private function show_styling() {
    {
       ?>
       <link rel="stylesheet" type="text/css" href="../../styling/connection.css">
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
        $this->show_form_inscription();
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