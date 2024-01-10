<?php

require_once(__DIR__ . '/../../controller/adminController.php');


class connectionVue {

    private function show_title_page()
    {
        ?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Marka_Vehicule Compartor </title>
        <?php
    }



    
   
    
        private function show_form_connection() {
            $ctr = new adminController();
            $table = $ctr->get_admins();
            if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
                // User is already logged in, redirect to accueilRouter.php
                header('Location: http://localhost/tdwProjet/comparateurVehicule/router/userRouter/accueilRouter.php');
                exit;
            }
    
            ?>
            <select id="hiddenSelect" style="display:none;"> <!-- Hidden to store all users -->
                <?php
                foreach ($table as $row) {
                    $username = $row['name'];
                    $password = $row['password'];
                    echo "<option data-username='$username' data-pass='$password' >$username - $password  </option>";
                }
                ?>
            </select>
    
            <div class="login-container">
                <h2>Connection As Admin</h2>
                <form id="loginForm" action="login_process.php" method="post">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
    
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
    
                    <button type="submit">Login</button>
                </form>
            </div>
    
            <script>
                document.getElementById('loginForm').addEventListener('submit', function (event) {
                    event.preventDefault();
    
                   
                    var hiddenSelect = document.getElementById('hiddenSelect');
                    var selectedOption = hiddenSelect.options[hiddenSelect.selectedIndex];
    
                    
                    var submittedUsername = document.getElementById('username').value;
                    var submittedPassword = document.getElementById('password').value;
    
                    
                    if (submittedUsername === selectedOption.dataset.username && submittedPassword === selectedOption.dataset.pass) {
                       
                        window.location.href = 'http://localhost/tdwProjet/comparateurVehicule/router/adminRouter/gestionRouter.php?name=' + encodeURIComponent(submittedUsername);
                    } else {
    
                        alert('Invalid username or password');
                    }
                });
            </script>
            <?php
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
        $this->show_form_connection();
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