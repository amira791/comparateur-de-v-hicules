<?php


require_once(__DIR__ . '/../../controller/userController.php');


class gestionUserVue {

    private function show_title_page()
    {
        ?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Marka_Vehicule Comparateur </title>
        <?php
    }

    private function show_styling()
    {
        ?>
        <link rel="stylesheet" type="text/css" href="../../styling/gestion_user.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
        <?php
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
    <img src="../../images/logo" id="logo">

    <div class="top-bar">
        <button class="gestion" id="mrqq" onclick="window.location.href='http://localhost/tdwProjet/comparateurVehicule/router/adminRouter/gestionRouter.php'">Page Gestion Principal</button>
    </div>
    <?php
}


   

    public function blockUserT($idToBlock)
    {
        $ctr = new  userController();
        $veh = $ctr->user_block ($idToBlock);
    }

    public function ValiderUser($username)
    {
        $ctr = new  userController();
        $veh = $ctr->valide_user ($username);
    }



 
    private function show_user_table()
    {
        // get all users
        $ctr1 = new userController();
        $users = $ctr1->get_users();
    
        ?>
        <h2>Filtrer la table</h2>
        <select id="filter">
    <option value="" selected>Filter par</option>
    <option value="blockee">Utilisateurs blockés</option>
    <option value="non_valide">Utilisateurs Inscription non encore validée</option>
</select>

    
        <div class="user-container">
            <table border="1">
                <thead>
                    <tr>
                        <th>Block</th>
                        <th>Inscrition Valide ?</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Est blocké ?</th>
                        <th>Validite Inscription</th>
                        <th>Profil</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($users as $row) {
                        $username = $row['username'];
                        $password = $row['password'];
                        $est_blockee = $row['est_blockee'];
                        $Valide_ins = $row['Valide_ins'];
    
                        if ($est_blockee == 1) {
                            $block = "Blocké";
                        } else {
                            $block = "Marche";
                        }
                        echo '<tr class="user-row">';
                        echo '<td><a href="../../router/adminRouter/gestionUserRouter.php?action=block&id=' . $username . '">Block</a></td>';
                        echo '<td><a href="../../router/adminRouter/gestionUserRouter.php?action=valider&id=' . $username . '">Valider Inscription</a></td>';
                        echo '<td>' . $username . '</td>';
                        echo '<td>' . $password . '</td>';
                        echo '<td>' . $block . '</td>';
                        echo '<td>' . $Valide_ins . '</td>';
                        echo '<td><a href="../../router/userRouter/userRouter.php?action=valider&id=' . $username . '">Profil</a></td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    
        <script>
            document.getElementById('filter').addEventListener('change', function() {
                var selectedValue = this.value;
                var userRows = document.getElementsByClassName('user-row');
    
                for (var i = 0; i < userRows.length; i++) {
                    var userRow = userRows[i];
    
                    // Show all rows by default
                    userRow.style.display = 'table-row';
    
                    // Hide rows based on the selected filter
                    if (selectedValue === 'blockee' && userRow.childNodes[4].textContent !== 'Blocké') {
                        userRow.style.display = 'none';
                    } else if (selectedValue === 'non_valide' && userRow.childNodes[5].textContent !== 'Non Valide') {
                        userRow.style.display = 'none';
                    }
                }
            });
        </script>
    
        <?php
    }
    

    
    
    

    
    
    
    
    
    
     
   

    public function Head_Page()
    {
        echo '<head>';
        $this->show_title_page();
        $this->define_library();
        $this->show_styling();
        echo '</head>';
    }

    public function Body_Page()
    {
        echo '<body>';
        $this->show_top_bar();
        $this->show_user_table();
        echo '</body>';
    }

    public function show_website()
    {
        echo '<html>';
        $this->Head_Page();
        $this->Body_Page();
        echo '</html>';
    }
}

?>
