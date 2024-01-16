<?php

require_once(__DIR__ . '/../../controller/newsController.php');
require_once(__DIR__ . '/../../controller/menuController.php');

class newsVue {

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
        <link rel="stylesheet" type="text/css" href="../../styling/news.css">
        <?php
    }

    private function define_library()
    {
        ?>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <?php
    }

    public function show_top_bar($username)
    {
        ?>
        
        <img src="../../images/logo" id="logo">
        <div class="top-bar"> 
            <?php
            if ($username == "NoUser") {
                ?>
                <button class="auth" id="connec" onclick="window.location.href='http://localhost/tdwProjet/comparateurVehicule/router/userRouter/connectionRouter.php'">Connection</button>
                <button class="auth" id="ins" onclick="window.location.href='http://localhost/tdwProjet/comparateurVehicule/router/userRouter/inscriptionRouter.php'">Inscription</button>
                <button class="auth" id="admin" onclick="window.location.href='http://localhost/tdwProjet/comparateurVehicule/router/adminRouter/connectionRouter.php'">Connection as Admin</button>
                </div>
                <?php
            } else {
                ?>
              <h1 id="username">
    <a href="../../router/userRouter/userRouter.php?username=<?php echo urlencode($username); ?>">
        <img src="../../images/userIcon.png" alt="Avatar">
        <?php echo htmlspecialchars($username); ?>
    </a>
</h1>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }
    public function show_menu($username)
    {
        
        $ctr = new menuController();
        $table = $ctr->get_menu();
        ?>
            <?php
            if ($username == "NoUser") {
                ?>
                <div class="menu">
            <?php
            foreach ($table as $row) {
                $designation = htmlspecialchars($row['designation']);
                $champLocation = htmlspecialchars($row['location']); 
                echo '<div class="menu-item"><a href="' . $champLocation . '" style="color: white;">' . $designation . '</a></div>';
            }
            ?>
        </div> 
                <?php
            } else {
                ?>
                <div class="menu">
            <?php
            foreach ($table as $row) {
                $designation = htmlspecialchars($row['designation']);
                $champLocation = htmlspecialchars($row['location'] . '?username=' . urlencode($username));
                echo '<div class="menu-item"><a href="' . $champLocation . '" style="color: white;">' . $designation . '</a></div>';
            }
            ?>
        </div>
                <?php
            }
    }

    private function show_contacts()
    {
        $ctr = new contactController();
        $table = $ctr->get_contact();
        ?>
        <h1> Contactez Nous </h1>
        <div class="con">
            <?php
            $images = array();

            foreach ($table as $row) {
                $images[] = array('logo' => $row['image_res'], 'nom' => $row['nom_res'], 'lien' => $row['lien_res']);
            }
            $rows = array_chunk($images, 3);

            foreach ($rows as $rowImages) {
                echo '<div class="logo-row">';

                foreach ($rowImages as $brandData) {
                    $base64Img = base64_encode($brandData['logo']);
                    $imgSrc = 'data:image/jpeg;base64,' . $base64Img;
                    echo '<div class="brand-container">';
                    echo '<a href="' . $brandData['lien'] . '">';
                    echo '<img src="' . $imgSrc . '" alt="Image">';
                    echo '</a>';
                    echo '<div class="brand-name">' . htmlspecialchars($brandData['nom']) . '</div>';
                    echo '</div>';
                }

                echo '</div>';
            }
            ?>
        </div>
        <?php
    }

    private function show_news()
{
    $ctr = new newsController();
    $table = $ctr->get_news();

    // Split the news items into pairs
    $pairs = array_chunk($table, 2);

    foreach ($pairs as $pair) {
        echo '<div class="news-row">';
        
        foreach ($pair as $row) {
            $id = $row['id_news'];
            $title = $row['titre'];
            $content = $row['contenu'];
            $date_pub = $row['date_publication'];
            
           
            $imageBlob = $row['image_pr'];
            $imgSrc = 'data:image/png;base64,' . base64_encode($imageBlob);

            $shortContent = substr($content, 0, 150);

            echo '<div class="news-item">';
            echo '<h2>' . $title . '</h2>';
            echo '<p>' . $shortContent . '...</p>';
            echo '<img src="' . $imgSrc . '" alt="Image">';
            echo '<p>Date de publication: ' . $date_pub . '</p>';
            echo '<a href="../../router/userRouter/newsDetailsRouter.php?id=' . $id . '">Plus de détails</a>';
            echo '</div>';
        }

        echo '</div>';
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
        $this->show_news();
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
