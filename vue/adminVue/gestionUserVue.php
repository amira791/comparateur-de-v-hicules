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
        <link rel="stylesheet" type="text/css" href="../../styling/gestionAviVh.css">
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
        // get all avis for vehicule
        $ctr1 = new userController();
        $users = $ctr1->get_users();
    
        echo '<div class="user-container">';
        
        echo '<table border="1">';
        echo '<thead>
                <tr>
                    <th>Block</th>
                    <th> Inscrition Valide ?</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Est blocke ?</th>
                    <th>Profil</th>       
                    
                </tr>
              </thead>';
        foreach ($users as $row) {
            $username = $row['username'];
            $password = $row['password'];
            $est_blockee = $row['est_blockee'];
            $Valide_ins = $row['Valide_ins'];

            if ($est_blockee == 1)
            {
                $block = "Blocke";
            } else {
                $block = "Marche";

            }
            echo '<tr>';
            echo '<td><a href="../../router/adminRouter/gestionUserRouter.php?action=block&id=' . $username . '">Block</a></td>';
            echo '<td><a href="../../router/adminRouter/gestionUserRouter.php?action=valider&id=' . $username . '">Valider Inscription</a></td>';
            echo '<td>' . $username . '</td>';
            echo '<td>' . $password . '</td>';
            echo '<td>' . $block . '</td>';
            echo '<td>' . $Valide_ins . '</td>';
            echo '</tr>';     
    
        }
   
   
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
