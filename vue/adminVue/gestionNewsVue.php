<?php


require_once(__DIR__ . '/../../controller/newsController.php');
require_once(__DIR__ . '/../../controller/menuController.php');

class gestionNewsVue {

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

    
    private function show_top_bar()
{
    ?>
    <img src="../../images/logo" id="logo">

    <div class="top-bar">
        <button class="gestion" id="mrqq" onclick="window.location.href='http://localhost/tdwProjet/comparateurVehicule/router/adminRouter/gestionRouter.php'">Page Gestion Principal</button>
    </div>
    <?php
}

    public function add_news_form($titre, $contenu, $date_publication,  $image)
    {
        $ctr = new newsController();
        $new_veh = $ctr->add_news ($titre, $contenu, $date_publication,  $image);
    }

    public function modify_news_form($id_new, $titre, $contenu, $date_publication,  $newImage)
    {
        $ctr = new newsController();
        $veh = $ctr->update_news ($id_new, $titre, $contenu, $date_publication, $newImage);
    }

    public function DeleteNews($idToDelete)
    {
        $ctr = new newsController();
        $veh = $ctr->delete_news($idToDelete);
    }


 
    private function show_table_news()
    {
        // get all news
        $ctr1 = new newsController();
        $news = $ctr1->get_news();
    
        echo '<script>
            function openAddNewsPopup() {
                var popup = document.getElementById("addNewsPopup_");
                popup.style.display = "block";
            }
    
            function closeAddNewsPopup() {
                var popup = document.getElementById("addNewsPopup_");
                popup.style.display = "none";
            }
    
            function displayFileName(input) {
                const fileNameSpan = document.getElementById(\'file-name\');
                const fileName = input.files[0]?.name || \'No file chosen\';
                fileNameSpan.textContent = fileName;
            }
    
            function openModifyNewsPopup(id_new) {
                var popup = document.getElementById("modifyNewsPopup_" + id_new);
                popup.style.display = "block";
            }
    
            function closeModifyNewsPopup(id_new) {
                var popup = document.getElementById("modifyNewsPopup_" + id_new);
                popup.style.display = "none";
            }
        </script>';
    
        echo '<div class="news-container">';
        
        echo '<table border="1">';
        echo '<thead>
                <tr>
                    <th>Suppression</th>
                    <th>Modification</th>
                    <th>Date Publication</th>
                    <th>Titre</th>
                    <th>Contenu</th>
                    <th>Image Principal</th>
                    
                </tr>
              </thead>';
    
        foreach ($news as $new) {
            $id_new = $new['id_news'];
            $titre = $new['titre'];
            $contenu = $new['contenu'];
            $date_publication = $new['date_publication'];
            $image = $new['image_pr'];
            $base64Img = base64_encode($image);
            $imgSrc = 'data:image/jpeg;base64,' . $base64Img;
            $contenu_res = strlen($contenu) > 100 ? substr($contenu, 0, 100) . '...' : $contenu;
    
            echo '<tr>';
            echo '<td><a href="../../router/adminRouter/gestionNewsRouter.php?action=delete&id=' . $id_new . '">Suppression</a></td>';
            echo '<td><a href="#" onclick="openModifyNewsPopup(' . $id_new . ')" class="modify-button">Modification</a></td>';
            echo '<td>' . $date_publication . '</td>';
            echo '<td>' . $titre . '</td>';
            echo '<td>' . $contenu_res . '</td>';
            echo '<td><img src="' . $imgSrc . '" alt="Vehicle Image" style="max-width: 100px; max-height: 100px;"></td>';
            echo '</tr>';
    
            /***************  The modification form **************/
            echo '<div id="modifyNewsPopup_' . $id_new . '" class="popup">';
            echo '<div class="popup-content">';
            echo '<span class="close" onclick="closeModifyNewsPopup(' . $id_new . ');">&times;</span>';
            echo '<form action="../../router/adminRouter/gestionNewsRouter.php" method="post" enctype="multipart/form-data" class="modify-vehicle-form">';
            echo '<input type="hidden" name="id_news" value="' . $id_new . '">';
            echo '<label for="titre"> Titre:</label>';
            echo '<input type="text" name="titre" value="' . htmlspecialchars($titre) . '" required class="form-input">';
            echo '<label for="contenu"> Contenu:</label>';
            echo '<input type="text" name="contenu" value="' . htmlspecialchars($contenu) . '" required class="form-input">';
            echo '<label for="date_publication"> Date Publication:</label>';
            echo '<input type="date" name="date_publication" value="' . htmlspecialchars($date_publication) . '" required class="form-input">';
            echo '<div class="current-image-container">';
                echo '<label for="image">Current Image:</label>';
                echo '<img src="data:image/jpeg;base64,' . base64_encode($image) . '" alt="Current Image" class="current-image">';
                echo '<input type="hidden" name="currentImage" value="' . base64_encode($image) . '">';
                echo '</div>';
                echo '<label for="newImage" class="file-label">Choose a New Image:</label>';
                echo '<div class="file-input-container">';
                echo '<input type="file" name="newImage" accept="image/*" class="file-input" onchange="displayFileName(this)">';
                echo '<span id="file-name" class="file-name">No file chosen</span>';
                echo '</div>';
            echo '<input type="hidden" name="action" value="modify">';
            echo '<button type="submit" class="modify-news-button">Modify Marque</button>';
            echo '</form>';
            echo '</div>';
            echo '</div>';
            /********************************************* */
    
        }
        echo '<button onclick="openAddNewsPopup()" class="add-news-button">Add a New</button>';
        echo '</div>';
        echo '<div id="addNewsPopup_" class="popup">';
        echo '<div class="popup-content">';
        echo '<span class="close" onclick="closeAddNewsPopup();">&times;</span>';
        echo '<form action="../../router/adminRouter/gestionNewsRouter.php" method="post" enctype="multipart/form-data" class="add-vehicle-form">';
    
        echo '<label for="titre">Titre:</label>';
        echo '<input type="text" name="titre" required class="form-field">';
        echo '<label for="contenu">Contenu:</label>';
        echo '<input type="text" name="contenu" required class="form-field">';
        $date_publication = date('Y-m-d');
        echo '<input type="hidden" name="date_publication" value="' . $date_publication . '">';
        
        echo '<label for="image_pr" class="file-input-container">';
        echo '<input type="file" name="image_pr" accept="image/*" required class="file-input" onchange="displayFileName(this)">';
        echo '<span class="file-label">Choose a File</span>';
        echo '<span id="file-name"></span>';
        echo '</label>';
        echo '<br>';
        echo '<input type="hidden" name="action" value="add">';
        echo '<button type="submit" class="add-news-button">Submit</button>';
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
        $this->show_table_news();
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
