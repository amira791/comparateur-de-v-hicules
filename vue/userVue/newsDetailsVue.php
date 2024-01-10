<?php

require_once(__DIR__ . '/../../controller/newsController.php');
require_once(__DIR__ . '/../../controller/menuController.php');

class newsDetailsVue {

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

    private function show_top_bar()
    {
        ?>
        <div class="top-bar">
            <img src="../../images/logo" id="logo">
            <button class="auth" id="connec">Sign In</button>
            <button class="auth" id="ins">Sign Up</button>
        </div>
        <div class="background-rectangle"></div>
        <?php
    }

    private function show_menu()
    {
        $ctr = new menuController();
        $table = $ctr->get_menu();
        ?>
        <div class="menu">
            <?php
            foreach ($table as $row) {
                $designation = htmlspecialchars($row['designation']);
                $champLocation = htmlspecialchars($row['location']);

                // Link each menu item to its champ location with white text color
                echo '<div class="menu-item"><a href="' . $champLocation . '" style="color: white;">' . $designation . '</a></div>';
            }
            ?>
        </div>
        <?php
    }

    public function show_details ($id)
    {
        $ctr = new newsController();
        $table = $ctr->get_news_Id($id);
    

            echo '<div class="news-row">';
             
                $title = $table['titre'];
                $content = $table['contenu'];
                $date_pub = $table['date_publication'];
                $imageBlob = $table['image_pr'];
                $imgSrc = 'data:image/png;base64,' . base64_encode($imageBlob);

                echo '<div class="news-item">';
                echo '<h2>' . $title . '</h2>';
                echo '<p>' . $content . '...</p>';
                echo '<img src="' . $imgSrc . '" alt="Image">';
                echo '<p>Date de publication: ' . $date_pub . '</p>';
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
        $this->show_menu();
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
