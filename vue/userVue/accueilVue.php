<?php

require_once(__DIR__ . '/../../controller/diapormaContoller.php');
require_once(__DIR__ . '/../../controller/menuController.php');
require_once(__DIR__ . '/../../controller/marqueController.php');
require_once(__DIR__ . '/../../controller/vehiculeController.php');
require_once(__DIR__ . '/../../controller/contactController.php');






class AccueilVue {


    private function show_title_page()
    {
        ?>
        <title> Marka_Vehicule Compartor </title>
        <?php
    }

    private function show_styling() {
    {
       ?>
       <link rel="stylesheet" type="text/css" href="../../styling/accueil.css">
       <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
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
                <h1 id="username"><img src="../../images/userIcon.png" alt="Avatar"><?php echo htmlspecialchars($username); ?></h1>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }
    



   
    private function show_diaporma()
    {
        $ctr = new diapormaController();
        $table = $ctr->get_diaporma();
        ?>
    
        <div class="diap">
            <?php
            foreach ($table as $index => $row) {
                $base64Img = base64_encode($row['image_diap']);
                $imgSrc = 'data:image/jpeg;base64,' . $base64Img;
                echo '<img class="diap-img" src="' . $imgSrc . '" alt="Image" style="display: ' . ($index === 0 ? 'block' : 'none') . ';">';
            }
            ?>
        </div>
    
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var currentIndex = 0;
                var images = document.querySelectorAll('.diap-img');
                
                function showNextImage() {
                    images[currentIndex].style.display = 'none';
                    currentIndex = (currentIndex + 1) % images.length;
                    images[currentIndex].style.display = 'block';
                }
    
                setInterval(showNextImage, 3000); // Change image every 5 seconds
            });
        </script>
    <?php
    }
   
    


    public function show_menu($username)
    {
        $this->show_diaporma();
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

    private function show_pied_page()
    {
        ?>
        <footer>
            <div class="footer-content">
              
    
                <div class="menuu" >
                    <?php
                    $ctr = new menuController();
                    $table = $ctr->get_menu();
    
                    foreach ($table as $row) {
                        $designation = htmlspecialchars($row['designation']);
                        $champLocation = htmlspecialchars($row['location']); // Assuming 'location' is the column name in your database
    
                        // Link each menu item to its champ location with white text color
                        echo '<li class="menu-item"><a href="' . $champLocation . '">' . $designation . '</a></li>';
                    }
                ?>
                </div>
                <?php
                    
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
                
            </div>
        </footer>
        <?php

    
     
    }


    private function show_button_guide ()
    {
        ?>
        <button  id="guide" onclick="window.location.href='http://localhost/tdwProjet/comparateurVehicule/router/guideRouter/connectionRouter.php'"> Guide Achat</button>
        <?php
    }

    private function show_popular_comp()
    {
        ?>
        <h1 id="cmp" > Les comparaisons les plus recherches </h1>
        <?php
        $ctr = new vehiculeController();
        $cmp = $ctr->get_pop(); 
    
        // Check if $cmp is not null and is an array
        if (is_array($cmp) && count($cmp) > 0) {
            foreach ($cmp as $row) {
                echo '<div class="comparison-frame">';
    
                for ($i = 1; $i <= 4; $i++) {
                    $id_vh = $row["id_vh$i"];
                    
                    if ($id_vh !== 0) {
                        $ctr_vh = new vehiculeController();
                        $vh = $ctr_vh->get_vhById($id_vh);
                        
                        if ($vh) {
                            $marque = $vh[0]['marque'];
                            $modele = $vh[0]['modele'];
                            $version = $vh[0]['version'];
                            $annee = $vh[0]['annee'];
                            $image = $vh[0]['image'];
                            $base64Img = base64_encode($image);
                            $imgSrc = 'data:image/jpeg;base64,' . $base64Img;
    
                            // Display each vehicle in a container
                            echo '<div class="vehicle-container">';
                            echo '<img src="' . $imgSrc . '" alt="Vehicle Image">';
                            echo '<p>Marque: ' . $marque . '</p>';
                            echo '<p>Modèle: ' . $modele . '</p>';
                            echo '<p>Version: ' . $version . '</p>';
                            echo '<p>Année: ' . $annee . '</p>';
                            echo '</div>';
                        }
                    }
                }
    
                echo '</div>'; // Close the comparison-frame
            }
        } else {
            echo 'No popular comparisons available.';
        }
    }
    
    

    private function show_marque()
    {
        $ctr = new marqueController();
        $table = $ctr->get_marque_pr();
        ?>
       
        <div class="marque">
        <h1> Les principales marques </h1> 
        <?php
        $images = array();
    
        foreach ($table as $row) {
            $images[] = $row['logo']; 
        }
    
        // Split the images into rows of 4
        $rows = array_chunk($images, 4);
    
        // Loop through each row
        foreach ($rows as $rowImages) {
            echo '<div class="logo-row">';
    
            // Loop through each image in the row
            foreach ($rowImages as $imgData) {
                $base64Img = base64_encode($imgData);
                $imgSrc = 'data:image/jpeg;base64,' . $base64Img;
                echo '<img src="' . $imgSrc . '" alt="Image">';
            }
    
            echo '</div>';
        }
        ?>
        </div>
        <?php
    }
 


    

    private function show_list_type()
    {
        $ctr = new vehiculeController();
        $table = $ctr->get_typeVh();
        ?>
        
        <select id="typeSelector" >
        <h2>Selectionner le type du vehicule</h2>
        <option value="" selected>type</option> 
            <?php
            foreach ($table as $row) {
                $id_type = $row['id_type'];
                $type = $row['type'];
                echo "<option value='$id_type'>$type</option>";
            }
            ?>
        </select>
        <?php
    }
    
    private function show_form1()
{
    ?>
     <form action="" method="post"> 
    <?php
    $ctr = new marqueController();
    $table_marque_type = $ctr->get_mrqType();
    
    ?>
    <h4>Selectionner la marque </h4>
    <select id="mrqSelector1">
    <option value="" selected>marque</option> 
        <?php
        foreach ($table_marque_type as $row) {
            $id_mrq = $row['id_mrq'];
            $id_typ = $row['id_typ'];
            $mrq = $row['val_mrq'];
            echo "<option data-type='$id_typ' value='$id_mrq'>$mrq</option>";
        }
        ?>
    </select>

    <script>
        $(document).ready(function () {
            // Store the original options for reference
            var originalOptions = $("#mrqSelector1").html();

            // Listen for changes in the type selector
            $("#typeSelector").change(function () {
                // Get the selected type ID
                var selectedType = $("#typeSelector").val();

                // If a type is selected, filter the options
                if (selectedType) {
                    // Filter the options based on the selected type
                    var filteredOptions = $(originalOptions).filter("[data-type='" + selectedType + "']");
                    $("#mrqSelector1").html(filteredOptions);
                } else {
                    // If no type is selected, reset to the original options
                    $("#mrqSelector1").html(originalOptions);
                }
            });
        });
    </script>
    <?php

     $ctr = new vehiculeController();
     $table_vehicule = $ctr->get_vehicule(); //this table contient tous les combinaisons possible mrq-modele-version-annee
     ?>
     <h4>Selectionner le modele </h4>
    <select id="modSelector1">
    <option value="" selected> modele</option> 
        <?php
        foreach ($table_vehicule as $row) {
            $id_mrq = $row['marque'];
            $modele = $row['modele'];
            echo "<option data-mrq='$id_mrq' value='$modele'>$modele</option>";
        }
        ?>
    </select>
    <script>
        $(document).ready(function () {
            // Store the original options for reference
            var originalOptions = $("#modSelector1").html();

            // Listen for changes in the type selector
            $("#mrqSelector1").change(function () {
                // Get the selected type ID
                var selectedmrq = $("#mrqSelector1").val();

                // If a type is selected, filter the options
                if (selectedmrq) {
                    // Filter the options based on the selected type
                    var filteredOptions = $(originalOptions).filter("[data-mrq='" + selectedmrq + "']");
                    $("#modSelector1").html(filteredOptions);
                } else {
                    // If no type is selected, reset to the original options
                    $("#modSelector1").html(originalOptions);
                }
            });
        });
    </script>
     <?php
     $ctr = new vehiculeController();
     $table_vehicule = $ctr->get_vehicule(); //this table contient tous les combinaisons possible mrq-modele-version-annee
     ?>
     <h4>Selectionner la version </h4>
    <select id="verSelector1">
    <option value="" selected> version</option> 
        <?php
        foreach ($table_vehicule as $row) {
            $modele = $row['modele'];
            $marque = $row['marque'];
            $version= $row['version'];
            echo "<option data-mod='$modele' data-mrq='$marque' value='$version'>$version</option>";
        }
        ?>
    </select>
    <script>
        $(document).ready(function () {
            // Store the original options for reference
            var originalOptions = $("#verSelector1").html();

            // Listen for changes in the type selector
            $("#modSelector1").change(function () {
                // Get the selected type ID
                var selectedmod = $("#modSelector1").val();
                var selectedmrq = $("#mrqSelector1").val();

                // If a type is selected, filter the options
                if (selectedmod && selectedmrq ) {
                    // Filter the options based on the selected type
                    var filteredOptions = $(originalOptions).filter("[data-mod='" + selectedmod + "'][data-mrq='" + selectedmrq + "']");
                    $("#verSelector1").html("<option value='' selected>version</option>");
                    $("#verSelector1").append(filteredOptions);
                } else {
                    // If no type is selected, reset to the original options
                    $("#verSelector1").html(originalOptions);
                }
            });
        });
    </script>
     <?php
     $ctr = new vehiculeController();
     $table_vehicule = $ctr->get_vehicule(); //this table contient tous les combinaisons possible mrq-modele-version-annee
     ?>
     <h4>Selectionner l'annee  </h4>
    <select id="anSelector1">
    <option value="" selected>l'annee</option> 
        <?php
        foreach ($table_vehicule as $row) {
            $modele = $row['modele'];
            $marque = $row['marque'];
            $version= $row['version'];
            $annee= $row['annee'];
            echo "<option data-mod='$modele' data-mrq='$marque' data-ver='$version' value='$annee'>$annee</option>";
        }
        ?>
    </select>
    <script>
        $(document).ready(function () {
            // Store the original options for reference
            var originalOptions = $("#anSelector1").html();

            // Listen for changes in the type selector
            $("#verSelector1").change(function () {
                // Get the selected type ID
                var selectedmod = $("#modSelector1").val();
                var selectedmrq = $("#mrqSelector1").val();
                var selectedver = $("#verSelector1").val();
                

                // If a type is selected, filter the options
                if (selectedmod && selectedmrq && selectedver ) {
                    // Filter the options based on the selected type
                    var filteredOptionsAnnee = $(originalOptions).filter("[data-mod='" + selectedmod + "'][data-mrq='" + selectedmrq + "'][data-ver='" + selectedver + "']");
                    $("#anSelector1").html("<option value='' selected>annee</option>");
                    $("#anSelector1").append(filteredOptionsAnnee);
                } else {
                    // If no type is selected, reset to the original options
                    $("#anSelector1").html(originalOptions);
                }
            });
        });
    </script>
   
  </form>
    <?php
} 

    
private function show_form2()
{
    ?>
     <form action="" method="post"> 
    <?php
    $ctr = new marqueController();
    $table_marque_type = $ctr->get_mrqType();
    
    ?>
    <h4>Selectionner la marque </h4>
    <select id="mrqSelector2">
    <option value="" selected>marque</option> 
        <?php
        foreach ($table_marque_type as $row) {
            $id_mrq = $row['id_mrq'];
            $id_typ = $row['id_typ'];
            $mrq = $row['val_mrq'];
            echo "<option data-type='$id_typ' value='$id_mrq'>$mrq</option>";
        }
        ?>
    </select>

    <script>
        $(document).ready(function () {
            // Store the original options for reference
            var originalOptions = $("#mrqSelector2").html();

            // Listen for changes in the type selector
            $("#typeSelector").change(function () {
                // Get the selected type ID
                var selectedType = $("#typeSelector").val();

                // If a type is selected, filter the options
                if (selectedType) {
                    // Filter the options based on the selected type
                    var filteredOptions = $(originalOptions).filter("[data-type='" + selectedType + "']");
                    $("#mrqSelector2").html(filteredOptions);
                } else {
                    // If no type is selected, reset to the original options
                    $("#mrqSelector2").html(originalOptions);
                }
            });
        });
    </script>
    <?php

     $ctr = new vehiculeController();
     $table_vehicule = $ctr->get_vehicule(); //this table contient tous les combinaisons possible mrq-modele-version-annee
     ?>
     <h4>Selectionner le modele </h4>
    <select id="modSelector2">
    <option value="" selected> modele</option> 
        <?php
        foreach ($table_vehicule as $row) {
            $id_mrq = $row['marque'];
            $modele = $row['modele'];
            echo "<option data-mrq='$id_mrq' value='$modele'>$modele</option>";
        }
        ?>
    </select>
    <script>
        $(document).ready(function () {
            // Store the original options for reference
            var originalOptions = $("#modSelector2").html();

            // Listen for changes in the type selector
            $("#mrqSelector2").change(function () {
                // Get the selected type ID
                var selectedmrq = $("#mrqSelector2").val();

                // If a type is selected, filter the options
                if (selectedmrq) {
                    // Filter the options based on the selected type
                    var filteredOptions = $(originalOptions).filter("[data-mrq='" + selectedmrq + "']");
                    $("#modSelector2").html(filteredOptions);
                } else {
                    // If no type is selected, reset to the original options
                    $("#modSelector2").html(originalOptions);
                }
            });
        });
    </script>
     <?php
     $ctr = new vehiculeController();
     $table_vehicule = $ctr->get_vehicule(); //this table contient tous les combinaisons possible mrq-modele-version-annee
     ?>
     <h4>Selectionner la version </h4>
    <select id="verSelector2">
    <option value="" selected> version</option> 
        <?php
        foreach ($table_vehicule as $row) {
            $modele = $row['modele'];
            $marque = $row['marque'];
            $version= $row['version'];
            echo "<option data-mod='$modele' data-mrq='$marque' value='$version'>$version</option>";
        }
        ?>
    </select>
    <script>
        $(document).ready(function () {
            // Store the original options for reference
            var originalOptions = $("#verSelector2").html();

            // Listen for changes in the type selector
            $("#modSelector2").change(function () {
                // Get the selected type ID
                var selectedmod = $("#modSelector2").val();
                var selectedmrq = $("#mrqSelector2").val();

                // If a type is selected, filter the options
                if (selectedmod && selectedmrq ) {
                    // Filter the options based on the selected type
                    var filteredOptions = $(originalOptions).filter("[data-mod='" + selectedmod + "'][data-mrq='" + selectedmrq + "']");
                    $("#verSelector2").html("<option value='' selected>version</option>");
                    $("#verSelector2").append(filteredOptions);
                } else {
                    // If no type is selected, reset to the original options
                    $("#verSelector2").html(originalOptions);
                }
            });
        });
    </script>
     <?php
     $ctr = new vehiculeController();
     $table_vehicule = $ctr->get_vehicule(); //this table contient tous les combinaisons possible mrq-modele-version-annee
     ?>
     <h4>Selectionner l'annee  </h4>
    <select id="anSelector2">
    <option value="" selected>l'annee</option> 
        <?php
        foreach ($table_vehicule as $row) {
            $modele = $row['modele'];
            $marque = $row['marque'];
            $version= $row['version'];
            $annee= $row['annee'];
            echo "<option data-mod='$modele' data-mrq='$marque' data-ver='$version' value='$annee'>$annee</option>";
        }
        ?>
    </select>
    <script>
        $(document).ready(function () {
            // Store the original options for reference
            var originalOptions = $("#anSelector2").html();

            // Listen for changes in the type selector
            $("#verSelector2").change(function () {
                // Get the selected type ID
                var selectedmod = $("#modSelector2").val();
                var selectedmrq = $("#mrqSelector2").val();
                var selectedver = $("#verSelector2").val();
                

                // If a type is selected, filter the options
                if (selectedmod && selectedmrq && selectedver ) {
                    // Filter the options based on the selected type
                    var filteredOptionsAnnee = $(originalOptions).filter("[data-mod='" + selectedmod + "'][data-mrq='" + selectedmrq + "'][data-ver='" + selectedver + "']");
                    $("#anSelector2").html("<option value='' selected>annee</option>");
                    $("#anSelector2").append(filteredOptionsAnnee);
                } else {
                    // If no type is selected, reset to the original options
                    $("#anSelector2").html(originalOptions);
                }
            });
        });
    </script>
   
  </form>
    <?php
}

private function show_form3()
{
    ?>
     <form action="" method="post"> 
    <?php
    $ctr = new marqueController();
    $table_marque_type = $ctr->get_mrqType();
    
    ?>
    <h4>Selectionner la marque </h4>
    <select id="mrqSelector3">
    <option value="" selected>marque</option> 
        <?php
        foreach ($table_marque_type as $row) {
            $id_mrq = $row['id_mrq'];
            $id_typ = $row['id_typ'];
            $mrq = $row['val_mrq'];
            echo "<option data-type='$id_typ' value='$id_mrq'>$mrq</option>";
        }
        ?>
    </select>

    <script>
        $(document).ready(function () {
            // Store the original options for reference
            var originalOptions = $("#mrqSelector3").html();

            // Listen for changes in the type selector
            $("#typeSelector").change(function () {
                // Get the selected type ID
                var selectedType = $("#typeSelector").val();

                // If a type is selected, filter the options
                if (selectedType) {
                    // Filter the options based on the selected type
                    var filteredOptions = $(originalOptions).filter("[data-type='" + selectedType + "']");
                    $("#mrqSelector3").html(filteredOptions);
                } else {
                    // If no type is selected, reset to the original options
                    $("#mrqSelector3").html(originalOptions);
                }
            });
        });
    </script>
    <?php

     $ctr = new vehiculeController();
     $table_vehicule = $ctr->get_vehicule(); //this table contient tous les combinaisons possible mrq-modele-version-annee
     ?>
     <h4>Selectionner le modele </h4>
    <select id="modSelector3">
    <option value="" selected> modele</option> 
        <?php
        foreach ($table_vehicule as $row) {
            $id_mrq = $row['marque'];
            $modele = $row['modele'];
            echo "<option data-mrq='$id_mrq' value='$modele'>$modele</option>";
        }
        ?>
    </select>
    <script>
        $(document).ready(function () {
            // Store the original options for reference
            var originalOptions = $("#modSelector3").html();

            // Listen for changes in the type selector
            $("#mrqSelector3").change(function () {
                // Get the selected type ID
                var selectedmrq = $("#mrqSelector3").val();

                // If a type is selected, filter the options
                if (selectedmrq) {
                    // Filter the options based on the selected type
                    var filteredOptions = $(originalOptions).filter("[data-mrq='" + selectedmrq + "']");
                    $("#modSelector3").html(filteredOptions);
                } else {
                    // If no type is selected, reset to the original options
                    $("#modSelector3").html(originalOptions);
                }
            });
        });
    </script>
     <?php
     $ctr = new vehiculeController();
     $table_vehicule = $ctr->get_vehicule(); //this table contient tous les combinaisons possible mrq-modele-version-annee
     ?>
     <h4>Selectionner la version </h4>
    <select id="verSelector3">
    <option value="" selected> version</option> 
        <?php
        foreach ($table_vehicule as $row) {
            $modele = $row['modele'];
            $marque = $row['marque'];
            $version= $row['version'];
            echo "<option data-mod='$modele' data-mrq='$marque' value='$version'>$version</option>";
        }
        ?>
    </select>
    <script>
        $(document).ready(function () {
            // Store the original options for reference
            var originalOptions = $("#verSelector3").html();

            // Listen for changes in the type selector
            $("#modSelector3").change(function () {
                // Get the selected type ID
                var selectedmod = $("#modSelector3").val();
                var selectedmrq = $("#mrqSelector3").val();

                // If a type is selected, filter the options
                if (selectedmod && selectedmrq ) {
                    // Filter the options based on the selected type
                    var filteredOptions = $(originalOptions).filter("[data-mod='" + selectedmod + "'][data-mrq='" + selectedmrq + "']");
                    $("#verSelector3").html("<option value='' selected>version</option>");
                    $("#verSelector3").append(filteredOptions);
                } else {
                    // If no type is selected, reset to the original options
                    $("#verSelector3").html(originalOptions);
                }
            });
        });
    </script>
     <?php
     $ctr = new vehiculeController();
     $table_vehicule = $ctr->get_vehicule(); //this table contient tous les combinaisons possible mrq-modele-version-annee
     ?>
     <h4>Selectionner l'annee  </h4>
    <select id="anSelector3">
    <option value="" selected>l'annee</option> 
        <?php
        foreach ($table_vehicule as $row) {
            $modele = $row['modele'];
            $marque = $row['marque'];
            $version= $row['version'];
            $annee= $row['annee'];
            echo "<option data-mod='$modele' data-mrq='$marque' data-ver='$version' value='$annee'>$annee</option>";
        }
        ?>
    </select>
    <script>
        $(document).ready(function () {
            // Store the original options for reference
            var originalOptions = $("#anSelector3").html();

            // Listen for changes in the type selector
            $("#verSelector3").change(function () {
                // Get the selected type ID
                var selectedmod = $("#modSelector3").val();
                var selectedmrq = $("#mrqSelector3").val();
                var selectedver = $("#verSelector3").val();
                

                // If a type is selected, filter the options
                if (selectedmod && selectedmrq && selectedver ) {
                    // Filter the options based on the selected type
                    var filteredOptionsAnnee = $(originalOptions).filter("[data-mod='" + selectedmod + "'][data-mrq='" + selectedmrq + "'][data-ver='" + selectedver + "']");
                    $("#anSelector3").html("<option value='' selected>annee</option>");
                    $("#anSelector3").append(filteredOptionsAnnee);
                    
                } else {
                    // If no type is selected, reset to the original options
                    $("#anSelector3").html(originalOptions);
                }
            });
        });
    </script>
   
  </form>
    <?php
}


private function show_form4()
{
    ?>
     <form action="" method="post"> 
    <?php
    $ctr = new marqueController();
    $table_marque_type = $ctr->get_mrqType();
    
    ?>
    <h4>Selectionner la marque </h4>
    <select id="mrqSelector4">
    <option value="" selected>marque</option> 
        <?php
        foreach ($table_marque_type as $row) {
            $id_mrq = $row['id_mrq'];
            $id_typ = $row['id_typ'];
            $mrq = $row['val_mrq'];
            echo "<option data-type='$id_typ' value='$id_mrq'>$mrq</option>";
        }
        ?>
    </select>

    <script>
        $(document).ready(function () {
            // Store the original options for reference
            var originalOptions = $("#mrqSelector4").html();

            // Listen for changes in the type selector
            $("#typeSelector").change(function () {
                // Get the selected type ID
                var selectedType = $("#typeSelector").val();

                // If a type is selected, filter the options
                if (selectedType) {
                    // Filter the options based on the selected type
                    var filteredOptions = $(originalOptions).filter("[data-type='" + selectedType + "']");
                    $("#mrqSelector4").html(filteredOptions);
                } else {
                    // If no type is selected, reset to the original options
                    $("#mrqSelector4").html(originalOptions);
                }
            });
        });
    </script>
    <?php

     $ctr = new vehiculeController();
     $table_vehicule = $ctr->get_vehicule(); //this table contient tous les combinaisons possible mrq-modele-version-annee
     ?>
     <h4>Selectionner le modele </h4>
    <select id="modSelector4">
    <option value="" selected> modele</option> 
        <?php
        foreach ($table_vehicule as $row) {
            $id_mrq = $row['marque'];
            $modele = $row['modele'];
            echo "<option data-mrq='$id_mrq' value='$modele'>$modele</option>";
        }
        ?>
    </select>
    <script>
        $(document).ready(function () {
            // Store the original options for reference
            var originalOptions = $("#modSelector4").html();

            // Listen for changes in the type selector
            $("#mrqSelector4").change(function () {
                // Get the selected type ID
                var selectedmrq = $("#mrqSelector4").val();

                // If a type is selected, filter the options
                if (selectedmrq) {
                    // Filter the options based on the selected type
                    var filteredOptions = $(originalOptions).filter("[data-mrq='" + selectedmrq + "']");
                    $("#modSelector4").html(filteredOptions);
                } else {
                    // If no type is selected, reset to the original options
                    $("#modSelector4").html(originalOptions);
                }
            });
        });
    </script>
     <?php
     $ctr = new vehiculeController();
     $table_vehicule = $ctr->get_vehicule(); //this table contient tous les combinaisons possible mrq-modele-version-annee
     ?>
     <h4>Selectionner la version </h4>
    <select id="verSelector4">
    <option value="" selected> version</option> 
        <?php
        foreach ($table_vehicule as $row) {
            $modele = $row['modele'];
            $marque = $row['marque'];
            $version= $row['version'];
            echo "<option data-mod='$modele' data-mrq='$marque' value='$version'>$version</option>";
        }
        ?>
    </select>
    <script>
        $(document).ready(function () {
            // Store the original options for reference
            var originalOptions = $("#verSelector4").html();

            // Listen for changes in the type selector
            $("#modSelector4").change(function () {
                // Get the selected type ID
                var selectedmod = $("#modSelector4").val();
                var selectedmrq = $("#mrqSelector4").val();

                // If a type is selected, filter the options
                if (selectedmod && selectedmrq ) {
                    // Filter the options based on the selected type
                    var filteredOptions = $(originalOptions).filter("[data-mod='" + selectedmod + "'][data-mrq='" + selectedmrq + "']");
                    $("#verSelector4").html("<option value='' selected>version</option>");
                    $("#verSelector4").append(filteredOptions);
                } else {
                    // If no type is selected, reset to the original options
                    $("#verSelector4").html(originalOptions);
                }
            });
        });
    </script>
     <?php
     $ctr = new vehiculeController();
     $table_vehicule = $ctr->get_vehicule(); //this table contient tous les combinaisons possible mrq-modele-version-annee
     ?>
     <h4>Selectionner l'annee  </h4>
    <select id="anSelector4">
    <option value="" selected>l'annee</option> 
        <?php
        foreach ($table_vehicule as $row) {
            $modele = $row['modele'];
            $marque = $row['marque'];
            $version= $row['version'];
            $annee= $row['annee'];
            echo "<option data-mod='$modele' data-mrq='$marque' data-ver='$version' value='$annee'>$annee</option>";
        }
        ?>
    </select>
    <script>
        $(document).ready(function () {
            // Store the original options for reference
            var originalOptions = $("#anSelector4").html();

            // Listen for changes in the type selector
            $("#verSelector4").change(function () {
                // Get the selected type ID
                var selectedmod = $("#modSelector4").val();
                var selectedmrq = $("#mrqSelector4").val();
                var selectedver = $("#verSelector4").val();
                

                // If a type is selected, filter the options
                if (selectedmod && selectedmrq && selectedver ) {
                    // Filter the options based on the selected type
                    var filteredOptionsAnnee = $(originalOptions).filter("[data-mod='" + selectedmod + "'][data-mrq='" + selectedmrq + "'][data-ver='" + selectedver + "']");
                    $("#anSelector4").html("<option value='' selected>annee</option>");
                    $("#anSelector4").append(filteredOptionsAnnee);
                } else {
                    // If no type is selected, reset to the original options
                    $("#anSelector4").html(originalOptions);
                }
            });
        });
    </script>
   
  </form>
    <?php
}

// foreach ($table as $row) {
//     $images[] = $row['image_diap']; 
// }

// foreach ($images as $imgData) {
//     $base64Img = base64_encode($imgData);
//     $imgSrc = 'data:image/jpeg;base64,' . $base64Img;
//     echo '<img src="' . $imgSrc . '" alt="Image">';
// }
  // Methodes pour construre le tableau comparatif a partir les donnes selctionnes dans les inputs 



  private function show_button_comparer()
  {
      $ctr = new vehiculeController();
      $table_vehicule = $ctr->get_vehicule(); // to get id veh + prix + image
      $table_caracvh = $ctr->get_caracvh(); // to get tous les id carac tech a partir id veh
      $table_carac =  $ctr->get_carac(); // to get tous les cara a partir le id
      ?>
      <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
      <script>
          $(document).ready(function () {
              var images = [];
  
              function filterAndStoreImages(object) {
                  var hiddenSelect = $("#hiddenSelect");
  
                  // Clear existing options
                  hiddenSelect.empty();
  
                  // Add all options to the hidden select
                  <?php foreach ($table_vehicule as $row) {
                      $modele = $row['modele'];
                      $marque = $row['marque'];
                      $version = $row['version'];
                      $annee = $row['annee'];
                      $image = base64_encode($row['image']);
                      echo "hiddenSelect.append(\"<option data-mod='$modele' data-mrq='$marque' data-ver='$version' data-an='$annee' data-img='data:image/jpeg;base64,$image'>$modele - $marque - $version - $annee</option>\");";
                  } ?>
  
                  // Log all the option elements in the hiddenSelect
                  console.log($("#hiddenSelect option"));
  
                  // Filter options based on the selected values
                  $("#hiddenSelect option").each(function () {
                      var data = $(this).data();
                      console.log(data.mrq);
                      console.log(data.mod);
                      console.log(data.ver);
                      console.log(data.an);
                      if (
                          data.mrq == object.selectedMrq &&
                          data.mod == object.selectedMod &&
                          data.ver == object.selectedVer &&
                          data.an == object.selectedAn
                      ) {
                          // Append the option to the filteredSelect
                          $(this).appendTo("#filteredSelect");
  
                          // Push the corresponding image
                          images.push(data.img);
                      }
                  });
  
                  console.log("Final Images Array:", images);
              }
  
              function handleButtonClick() {
                var object1 = {
        selectedMrq: $("#mrqSelector1").val(),
        selectedMod: $("#modSelector1").val(),
        selectedVer: $("#verSelector1").val(),
        selectedAn: $("#anSelector1").val()
    };
    filterAndStoreImages(object1);
    console.log(object1);

    var object2 = {
        selectedMrq: $("#mrqSelector2").val(),
        selectedMod: $("#modSelector2").val(),
        selectedVer: $("#verSelector2").val(),
        selectedAn: $("#anSelector2").val()
    };
    filterAndStoreImages(object2);
    console.log(object2);

    var object3 = {
        selectedMrq: $("#mrqSelector3").val(),
        selectedMod: $("#modSelector3").val(),
        selectedVer: $("#verSelector3").val(),
        selectedAn: $("#anSelector3").val()
    };
    filterAndStoreImages(object3);
    console.log(object3);

    var object4 = {
        selectedMrq: $("#mrqSelector4").val(),
        selectedMod: $("#modSelector4").val(),
        selectedVer: $("#verSelector4").val(),
        selectedAn: $("#anSelector4").val()
    };
    filterAndStoreImages(object4);
    console.log(object4);

    console.log("Final Images Array:", images);
              }
  
              // Your existing code for handleButtonClick function
  
              // Your existing HTML button
              $("#myButton").on("click", handleButtonClick);
          });
      </script>
  
      <!-- Add your HTML structure for selectors and hiddenSelect here -->
      <select id="hiddenSelect"></select>
      <select id="filteredSelect"></select>
      <button id="myButton">Comparer</button>
      <!-- Add your other HTML elements here -->
      
      <?php
  }
  
  private function show_comparaison_table()
  {
      ?>
      <select id="hiddenSelect"></select>   <!-- hidden to store all vehicules-->
      <select id="filteredSelect"></select> <!-- hidden to store filtered vehicules-->
      <button  id="myButton">Comparer</button>
      <table id="comparisonTable" style="display: none;"></table>
      <?php
  
      $ctr = new vehiculeController();
      $table_vehicule = $ctr->get_vehicule(); // table all vehicule
      $table_carac =  $ctr->get_carac();   // table features 
      $table_caracvh = $ctr->get_caracvh(); // table feature_vehicule
      $caracvhValues = [];

    foreach ($table_caracvh as $row) {
    $caracvhValues[] = [
        'id_car' => $row['id_car'],
        'id_vh' => $row['id_vh'],
        'value_car' => $row['value_car']
    ];
    echo "<script>var caracvhValues = " . json_encode($caracvhValues) . ";</script>";
}
  
      ?>
      <script>
          $(document).ready(function () {
              var images = [];
              var ids = [];

              function getCaracvhValue(featureId, vehicleId) {
              var value = "";

    for (var i = 0; i < caracvhValues.length; i++) {
        var row = caracvhValues[i];
        
  
       
        if (String(row.id_car).trim() === String(featureId).trim() && String(row.id_vh).trim() === String(vehicleId).trim()) {
   
    value = row.value_car;
    break;
} else {
    console.log("No match");
}
    }

    return value;
}
  
              function create_table() {
                  // get all objects submitted in the form 
                  var objects = [];

for (var i = 1; i <= 4; i++) {
    var selectedMrq = $("#mrqSelector" + i).val();
    var selectedMod = $("#modSelector" + i).val();
    var selectedVer = $("#verSelector" + i).val();
    var selectedAn = $("#anSelector" + i).val();

    // Check if any of the selected values is empty
    if (selectedMrq !== "" && selectedMod !== "" && selectedVer !== "" && selectedAn !== "") {
        var object = {
            selectedMrq: selectedMrq,
            selectedMod: selectedMod,
            selectedVer: selectedVer,
            selectedAn: selectedAn
        };

        // Add the object to the array
        objects.push(object);
    } 
}
if (objects.length < 2) {
        
        alert("Vous devez remplir au moins deux formulaires");
        return;
    }   else {             
                  // get all features 
                  var features = [
                      <?php foreach ($table_carac as $row): ?>
                      { id: "<?php echo $row['id_carac']; ?>", name: "<?php echo $row['nom_carac']; ?>" },
                      <?php endforeach; ?>
                  ];
  
                  // fill hidden select with all vehicles
                  var hiddenSelect = $("#hiddenSelect");
                  hiddenSelect.empty();
                  <?php foreach ($table_vehicule as $row) {
                      $id = $row['Id_veh'];
                      $modele = $row['modele'];
                      $marque = $row['marque'];
                      $version = $row['version'];
                      $annee = $row['annee'];
                      $image = base64_encode($row['image']);
                      echo "hiddenSelect.append(\"<option data-id='$id' data-mod='$modele' data-mrq='$marque' data-ver='$version' data-an='$annee' data-img='data:image/jpeg;base64,$image'>$modele - $marque - $version - $annee</option>\");";
                  } ?>
  
                  // create hidden select filtered by id objects
                  var filteredSelect = $("#filteredSelect");
                  filteredSelect.empty();
  
                  for (var i = 0; i < objects.length; i++) {
                      $("#hiddenSelect option").each(function () {
                          var data = $(this).data();
                          if (
                              data.mrq == objects[i].selectedMrq &&
                              data.mod == objects[i].selectedMod &&
                              data.ver == objects[i].selectedVer &&
                              data.an == objects[i].selectedAn
                          ) {
                              // Append the option to the filteredSelect
                              $(this).appendTo("#filteredSelect");
  
                              // Push the corresponding image and id
                              images.push(data.img);
                              ids.push(data.id);
                             
                          }
                      });
                  }
  
                  // creation comparaison table 
                  var headerRow = "<tr><th>Features</th>";
                  for (var i = 0; i < objects.length; i++) {
                 headerRow += "<th>" + objects[i].selectedMrq + " " + objects[i].selectedMod + " " + objects[i].selectedVer + " " + objects[i].selectedAn + "</th>";
                  }
                headerRow += "</tr>";
                $("#comparisonTable").append(headerRow);

                 for (var j = 0; j < features.length; j++) {
                 var tableRow = "<tr><td>" + features[j].name + "</td>";
                 

                 console.log(ids);
    for (var i = 0; i < objects.length; i++) {
        var featureId = features[j].id;
        var vehicleId = ids[i];
       
        if (vehicleId !== undefined) {
            // Retrieve the value from $table_caracvh using featureId and vehicleId
            var value = getCaracvhValue(featureId, vehicleId);
            tableRow += "<td>" + value + "</td>";
        } else {
            console.error("Vehicle ID not available.");
            // or alert("Vehicle ID not available.");
        }
    }

    tableRow += "</tr>";
    $("#comparisonTable").append(tableRow);
}
return $("#comparisonTable").html();

               } }
  
              // Call the function when the button is clicked
              $("#myButton").on("click", function () {
                var generatedTableHTML = create_table();
               var encodedTableData = encodeURIComponent(generatedTableHTML);
               window.location.href = 'http://localhost/tdwProjet/comparateurVehicule/router/userRouter/comparateurRouter.php?tableData=' + encodedTableData;
              
              });
          });
      </script>
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
       
        $this->show_marque();
        $this->show_list_type();
      
      
        $this->show_form1();
   
        $this->show_form2();
 
        $this->show_form3();

        $this->show_form4();
        $this->show_comparaison_table();
        $this->show_button_guide();
        $this->show_popular_comp();
        $this->show_pied_page();
       
     
 
        
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