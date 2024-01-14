<?php

require_once(__DIR__ . '/../../controller/userController.php');


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
            $ctr = new userController();
            $table = $ctr->get_users();
         
    
            ?>
            <select id="hiddenSelect" style="display:none;"> <!-- Hidden to store all users -->
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
    
            <div class="login-container">
                <h2>Connection</h2>
                <form id="loginForm" action="login_process.php" method="post">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
    
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
    
                    <button type="submit">Login</button>
                    <button class="return-button" onclick="window.location.href='http://localhost/tdwProjet/comparateurVehicule/router/userRouter/accueilRouter.php'">Revenir au page accueil</button>
                </form>
            </div>
    
            <script>
        document.getElementById('loginForm').addEventListener('submit', function (event) {
    event.preventDefault();

    var hiddenSelect = document.getElementById('hiddenSelect');
    var submittedUsername = document.getElementById('username').value;
    var submittedPassword = document.getElementById('password').value;

    for (var i = 0; i < hiddenSelect.options.length; i++) {
        var option = hiddenSelect.options[i];
        console.log('Checking:', option.dataset.username, option.dataset.pass);

        if (submittedUsername === option.dataset.username && submittedPassword === option.dataset.pass) {
            console.log('Match found:', submittedUsername, submittedPassword);
            if (option.dataset.block === '1') {
                alert('This user is blocked. Please contact support for assistance.');
            } else if (option.dataset.valide === 'Valide') {
                window.location.href = 'http://localhost/tdwProjet/comparateurVehicule/router/userRouter/accueilRouter.php?username=' + encodeURIComponent(submittedUsername);
            } else {
                alert('Inscription n\'est pas encore valide. Please contact support for assistance.');
            }
            return;  // Exit the loop once a match is found
        }
    }

    // If no match is found
    alert('Invalid username or password');
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