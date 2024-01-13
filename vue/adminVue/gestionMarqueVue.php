<?php

require_once(__DIR__ . '/../../controller/vehiculeController.php');
require_once(__DIR__ . '/../../controller/marqueController.php');
require_once(__DIR__ . '/../../controller/menuController.php');

class gestionMarqueVue {

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
        <link rel="stylesheet" type="text/css" href="../../styling/gestion_mrq.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
        <?php
    }

    private function define_library()
    {
        ?>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <?php
    }

    private function show_top_bar ()
    {
        ?>
       <img src="../../images/logo" id="logo">
       <div class="top-bar"></div>
       <?php

    }

    public function add_marque_form ($logo, $Nom, $pays_origine, $siege_social, $annee_creation, $histoire
    , $Fondateurs, $Slogan, $Produits, $Site_web)
    {
        $ctr = new marqueController();
        $new_veh = $ctr->add_marque($logo, $Nom, $pays_origine, $siege_social, $annee_creation, $histoire
        , $Fondateurs, $Slogan, $Produits, $Site_web);
    }

    public function modify_marque_form ($id_mrq,$logo, $Nom, $pays_origine, $siege_social, $annee_creation, $histoire
    , $Fondateurs, $Slogan, $Produits, $Site_web)
    {
        $ctr = new marqueController();
        $veh = $ctr->modify_marque($id_mrq,$logo, $Nom, $pays_origine, $siege_social, $annee_creation, $histoire
        , $Fondateurs, $Slogan, $Produits, $Site_web);
    }

    public function delete_marque_form ($id_mrq)
    {
        $ctr = new marqueController();
        $veh = $ctr->delete_marque($id_mrq);
    }


 
    private function show_table_vehicule()
    {
        // get all marques
        $ctr1 = new marqueController();
        $marques = $ctr1->get_marque();
    
        echo '<script>
            function openAddMarquePopup() {
                var popup = document.getElementById("addMarquePopup_");
                popup.style.display = "block";
            }
    
            function closeAddMarquePopup() {
                var popup = document.getElementById("addMarquePopup_");
                popup.style.display = "none";
            }
    
            function displayFileName(input) {
                const fileNameSpan = document.getElementById(\'file-name\');
                const fileName = input.files[0]?.name || \'No file chosen\';
                fileNameSpan.textContent = fileName;
            }
    
            function openModifyMarquePopup(id_mrq) {
                var popup = document.getElementById("modifyMarquePopup_" + id_mrq);
                popup.style.display = "block";
            }
    
            function closeModifyMarquePopup(id_mrq) {
                var popup = document.getElementById("modifyMarquePopup_" + id_mrq);
                popup.style.display = "none";
            }
        </script>';
    
        echo '<div class="marque-container">';
        // Create a table for the vehicles of the current marque
        echo '<table border="1">';
        echo '<thead>
                <tr>
                    <th>Suppression</th>
                    <th>Modification</th>
                    <th>Logo</th>
                    <th>Nom</th>
                    <th>Pays Origine</th>
                    <th>Siege Social</th>
                    <th>Annee Creation</th>
                    <th>Histoire</th>
                    <th>Fondateurs</th>
                    <th>Slogan</th>
                    <th>Produits</th>
                    <th>Site_web</th>
                </tr>
              </thead>';
    
        foreach ($marques as $mrq) {
            $id_mrq = $mrq['id_mrq'];
            $nom_mrq = $mrq['Nom'];
            $pays_origine = $mrq['pays_origine'];
            $siege_social = $mrq['siege_social'];
            $annee_creation = $mrq['annee_creation'];
            $histoire = $mrq['histoire'];
            $Fondateurs = $mrq['Fondateurs'];
            $Slogan = $mrq['Slogan'];
            $Produits = $mrq['Produits'];
            $Site_web = $mrq['Site_web'];
            $logo = $mrq['logo'];
            $base64Img = base64_encode($logo);
            $imgSrc = 'data:image/jpeg;base64,' . $base64Img;
            $histoire_tronquee = strlen($histoire) > 100 ? substr($histoire, 0, 100) . '...' : $histoire;
    
            echo '<tr>';
            echo '<td><a href="../../router/adminRouter/gestionMarqueRouter.php?action=delete&id=' . $id_mrq . '">Suppression</a></td>';
            echo '<td><a href="#" onclick="openModifyMarquePopup(' . $id_mrq . ')" class="modify-button">Modification</a></td>';
            echo '<td><img src="' . $imgSrc . '" alt="Vehicle Image" style="max-width: 100px; max-height: 100px;"></td>';
            echo '<td>' . $nom_mrq . '</td>';
            echo '<td>' . $pays_origine . '</td>';
            echo '<td>' . $siege_social . '</td>';
            echo '<td>' . $annee_creation . '</td>';
            echo '<td>' . $histoire_tronquee . '</td>';
            echo '<td>' . $Fondateurs . '</td>';
            echo '<td>' . $Slogan . '</td>';
            echo '<td>' . $Produits . '</td>';
            echo '<td><a href="' . $Site_web . '" target="_blank">' . $Site_web . '</a></td>';

            echo '</tr>';
    
            /***************  The modification form **************/
            echo '<div id="modifyMarquePopup_' . $id_mrq . '" class="popup">';
            echo '<div class="popup-content">';
            echo '<span class="close" onclick="closeModifyMarquePopup(' . $id_mrq . ');">&times;</span>';
    
            echo '<form action="../../router/adminRouter/gestionMarqueRouter.php" method="post" enctype="multipart/form-data" class="modify-vehicle-form">';
            echo '<input type="hidden" name="id_mrq" value="' . $id_mrq . '">';
            echo '<label for="nom_mrq"> Nom Marque:</label>';
            echo '<input type="text" name="nom_mrq" value="' . htmlspecialchars($nom_mrq) . '" required class="form-input">';
            echo '<label for="pays_origine"> Pays Origine:</label>';
            echo '<input type="text" name="pays_origine" value="' . htmlspecialchars($pays_origine) . '" required class="form-input">';
            echo '<label for="siege_social"> Siege Social:</label>';
            echo '<input type="text" name="siege_social" value="' . htmlspecialchars($siege_social) . '" required class="form-input">';
            echo '<label for="annee_creation"> Annee Creation:</label>';
            echo '<input type="text" name="annee_creation" value="' . htmlspecialchars($annee_creation) . '" required class="form-input">';
            echo '<label for="histoire"> Histoire:</label>';
            echo '<input type="text" name="histoire" value="' . htmlspecialchars($histoire) . '" required class="form-input">';
            echo '<label for="Fondateurs"> Fondateurs:</label>';
            echo '<input type="text" name="Fondateurs" value="' . htmlspecialchars($Fondateurs) . '" required class="form-input">';
            echo '<label for="Slogan">Slogan:</label>';
            echo '<input type="text" name="Slogan" value="' . htmlspecialchars($Slogan) . '" required class="form-input">';
            echo '<label for="siege"> Produits:</label>';
            echo '<input type="text" name="Produitse" value="' . htmlspecialchars($Produits) . '" required class="form-input">';
            echo '<label for="Produits"> Site_web:</label>';
            echo '<input type="text" name="Site_web" value="' . htmlspecialchars($Site_web) . '" required class="form-input">';
            echo '<div class="current-image-container">';
            echo '<label for="image">Current Image:</label>';
            echo '<img src="data:image/jpeg;base64,' . base64_encode($logo) . '" alt="Current Image" class="current-image">';
            echo '<input type="hidden" name="currentImage" value="' . base64_encode($logo) . '">';
            echo '</div>';
            echo '<label for="newImage" class="file-label">Choose a New Image:</label>';
            echo '<div class="file-input-container">';
            echo '<input type="file" name="newImage" accept="image/*" class="file-input" onchange="displayFileName(this)">';
            echo '<span id="file-name" class="file-name">No file chosen</span>';
            echo '</div>';
            echo '<input type="hidden" name="action" value="modify">';
            echo '<button type="submit" class="modify-marque-button">Modify Marque</button>';
            echo '</form>';
            echo '</div>';
            echo '</div>';
            /********************************************* */
    
        }
        echo '<button onclick="openAddMarquePopup()" class="add-marque-button">Add a new Marque</button>';
        echo '</div>';
        echo '<div id="addMarquePopup_" class="popup">';
        echo '<div class="popup-content">';
        echo '<span class="close" onclick="closeAddMarquePopup();">&times;</span>';
        echo '<form action="../../router/adminRouter/gestionMarqueRouter.php" method="post" enctype="multipart/form-data" class="add-vehicle-form">';
    
        echo '<label for="name">Nom Marque:</label>';
        echo '<input type="text" name="name" required class="form-field">';
        echo '<label for="pay">Pays Origine:</label>';
        echo '<input type="text" name="pay" required class="form-field">';
        echo '<label for="siege">Siege Social:</label>';
        echo '<input type="text" name="siege" required class="form-field">';
        echo '<label for="annee">Annee Creation:</label>';
        echo '<input type="number" name="annee" required class="form-field">';
        echo '<label for="histoire">Histoire:</label>';
        echo '<input type="text" name="histoire" required class="form-field">';
        echo '<label for="fondateur">Fondateurs:</label>';
        echo '<input type="text" name="fondateur" required class="form-field">';
        echo '<label for="slogan">Slogan:</label>';
        echo '<input type="text" name="slogan" required class="form-field">';
        echo '<label for="produits">Produits:</label>';
        echo '<input type="text" name="produits" required class="form-field">';
        echo '<label for="site"> Site_web:</label>';
        echo '<a href="#" name="site" class="form-link" id="siteLink" target="_blank"></a>';
        echo '<input type="text" name="site" required class="form-field" onchange="displaySiteLink(this)">';

        echo '<script>
    function displaySiteLink(input) {
        const siteLink = document.getElementById(\'siteLink\');
        siteLink.href = input.value;
    }
</script>';
        echo '<label for="logo" class="file-input-container">';
        echo '<input type="file" name="logo" accept="image/*" required class="file-input" onchange="displayFileName(this)">';
        echo '<span class="file-label">Choose a File</span>';
        echo '<span id="file-name"></span>';
        echo '</label>';
        echo '<br>';
        echo '<input type="hidden" name="action" value="add">';
        echo '<button type="submit" class="add-marque-button">Submit</button>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</table>';
        echo '</div>';
        echo '</div>';
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
        $this->show_table_vehicule();
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
