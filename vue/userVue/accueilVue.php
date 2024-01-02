<?php

require_once(__DIR__ . '/../../controller/diapormaContoller.php');
require_once(__DIR__ . '/../../controller/menuController.php');
require_once(__DIR__ . '/../../controller/marqueController.php');
require_once(__DIR__ . '/../../controller/vehiculeController.php');






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
       <?php
    }

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
      <div class="topBar" id="top">
             <img src="../../images/logo" id="logo"   >
             <button class="auth" id="connec"> Sign In </button>
             <button class="auth" id="ins"> Sign Up </button>       
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
        $images = array();
    
        foreach ($table as $row) {
            $images[] = $row['image_diap']; 
        }
    
        foreach ($images as $imgData) {
            $base64Img = base64_encode($imgData);
            $imgSrc = 'data:image/jpeg;base64,' . $base64Img;
            echo '<img src="' . $imgSrc . '" alt="Image">';
        }
        ?>
        </div>
        <?php
    }

    private function show_menu()
    {
        $ctr = new menuController();
        $table = $ctr->get_menu();
        ?>
        <div class="menu">
            <?php
            $menu_items = array();
    
            foreach ($table as $row) {
                $menu_items[] = $row['designation'];
            }
    
            foreach ($menu_items as $item) {
                echo '<div class="menu-item">' . htmlspecialchars($item) . '</div>';
            }
            ?>
        </div>
        <?php
    }

    private function show_marque()
    {
        $ctr = new marqueController();
        $table = $ctr->get_marque();
        ?>
        <h1> Les principales marques </h1> 
        <div class="marque">
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
        <h2>Selectionner le type du vehicule</h2>
        <select id="typeSelector">
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
    <select id="mrqSelector">
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
            var originalOptions = $("#mrqSelector").html();

            // Listen for changes in the type selector
            $("#typeSelector").change(function () {
                // Get the selected type ID
                var selectedType = $("#typeSelector").val();

                // If a type is selected, filter the options
                if (selectedType) {
                    // Filter the options based on the selected type
                    var filteredOptions = $(originalOptions).filter("[data-type='" + selectedType + "']");
                    $("#mrqSelector").html(filteredOptions);
                } else {
                    // If no type is selected, reset to the original options
                    $("#mrqSelector").html(originalOptions);
                }
            });
        });
    </script>
    <?php

     $ctr = new vehiculeController();
     $table_vehicule = $ctr->get_vehicule(); //this table contient tous les combinaisons possible mrq-modele-version-annee
     ?>
     <h4>Selectionner le modele </h4>
    <select id="modSelector">
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
            var originalOptions = $("#modSelector").html();

            // Listen for changes in the type selector
            $("#mrqSelector").change(function () {
                // Get the selected type ID
                var selectedmrq = $("#mrqSelector").val();

                // If a type is selected, filter the options
                if (selectedmrq) {
                    // Filter the options based on the selected type
                    var filteredOptions = $(originalOptions).filter("[data-mrq='" + selectedmrq + "']");
                    $("#modSelector").html(filteredOptions);
                } else {
                    // If no type is selected, reset to the original options
                    $("#modSelector").html(originalOptions);
                }
            });
        });
    </script>
     <?php
     $ctr = new vehiculeController();
     $table_vehicule = $ctr->get_vehicule(); //this table contient tous les combinaisons possible mrq-modele-version-annee
     ?>
     <h4>Selectionner la version </h4>
    <select id="verSelector">
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
            var originalOptions = $("#verSelector").html();

            // Listen for changes in the type selector
            $("#modSelector").change(function () {
                // Get the selected type ID
                var selectedmod = $("#modSelector").val();
                var selectedmrq = $("#mrqSelector").val();

                // If a type is selected, filter the options
                if (selectedmod && selectedmrq ) {
                    // Filter the options based on the selected type
                    var filteredOptions = $(originalOptions).filter("[data-mod='" + selectedmod + "'][data-mrq='" + selectedmrq + "']");
                    $("#verSelector").html("<option value='' selected>version</option>");
                    $("#verSelector").append(filteredOptions);
                } else {
                    // If no type is selected, reset to the original options
                    $("#verSelector").html(originalOptions);
                }
            });
        });
    </script>
     <?php
     $ctr = new vehiculeController();
     $table_vehicule = $ctr->get_vehicule(); //this table contient tous les combinaisons possible mrq-modele-version-annee
     ?>
     <h4>Selectionner l'annee  </h4>
    <select id="anSelector">
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
            var originalOptions = $("#anSelector").html();

            // Listen for changes in the type selector
            $("#verSelector").change(function () {
                // Get the selected type ID
                var selectedmod = $("#modSelector").val();
                var selectedmrq = $("#mrqSelector").val();
                var selectedver = $("#verSelector").val();
                

                // If a type is selected, filter the options
                if (selectedmod && selectedmrq && selectedver ) {
                    // Filter the options based on the selected type
                    var filteredOptionsAnnee = $(originalOptions).filter("[data-mod='" + selectedmod + "'][data-mrq='" + selectedmrq + "'][data-ver='" + selectedver + "']");
                    $("#anSelector").html(filteredOptionsAnnee);
                } else {
                    // If no type is selected, reset to the original options
                    $("#anSelector").html(originalOptions);
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
    <select id="mrqSelector">
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
            var originalOptions = $("#mrqSelector").html();

            // Listen for changes in the type selector
            $("#typeSelector").change(function () {
                // Get the selected type ID
                var selectedType = $("#typeSelector").val();

                // If a type is selected, filter the options
                if (selectedType) {
                    // Filter the options based on the selected type
                    var filteredOptions = $(originalOptions).filter("[data-type='" + selectedType + "']");
                    $("#mrqSelector").html(filteredOptions);
                } else {
                    // If no type is selected, reset to the original options
                    $("#mrqSelector").html(originalOptions);
                }
            });
        });
    </script>
    <?php

     $ctr = new vehiculeController();
     $table_vehicule = $ctr->get_vehicule(); //this table contient tous les combinaisons possible mrq-modele-version-annee
     ?>
     <h4>Selectionner le modele </h4>
    <select id="modSelector">
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
            var originalOptions = $("#modSelector").html();

            // Listen for changes in the type selector
            $("#mrqSelector").change(function () {
                // Get the selected type ID
                var selectedmrq = $("#mrqSelector").val();

                // If a type is selected, filter the options
                if (selectedmrq) {
                    // Filter the options based on the selected type
                    var filteredOptions = $(originalOptions).filter("[data-mrq='" + selectedmrq + "']");
                    $("#modSelector").html(filteredOptions);
                } else {
                    // If no type is selected, reset to the original options
                    $("#modSelector").html(originalOptions);
                }
            });
        });
    </script>
     <?php
     $ctr = new vehiculeController();
     $table_vehicule = $ctr->get_vehicule(); //this table contient tous les combinaisons possible mrq-modele-version-annee
     ?>
     <h4>Selectionner la version </h4>
    <select id="verSelector">
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
            var originalOptions = $("#verSelector").html();

            // Listen for changes in the type selector
            $("#modSelector").change(function () {
                // Get the selected type ID
                var selectedmod = $("#modSelector").val();
                var selectedmrq = $("#mrqSelector").val();

                // If a type is selected, filter the options
                if (selectedmod && selectedmrq ) {
                    // Filter the options based on the selected type
                    var filteredOptions = $(originalOptions).filter("[data-mod='" + selectedmod + "'][data-mrq='" + selectedmrq + "']");
                    $("#verSelector").html("<option value='' selected>version</option>");
                    $("#verSelector").append(filteredOptions);
                } else {
                    // If no type is selected, reset to the original options
                    $("#verSelector").html(originalOptions);
                }
            });
        });
    </script>
     <?php
     $ctr = new vehiculeController();
     $table_vehicule = $ctr->get_vehicule(); //this table contient tous les combinaisons possible mrq-modele-version-annee
     ?>
     <h4>Selectionner l'annee  </h4>
    <select id="anSelector">
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
            var originalOptions = $("#anSelector").html();

            // Listen for changes in the type selector
            $("#verSelector").change(function () {
                // Get the selected type ID
                var selectedmod = $("#modSelector").val();
                var selectedmrq = $("#mrqSelector").val();
                var selectedver = $("#verSelector").val();
                

                // If a type is selected, filter the options
                if (selectedmod && selectedmrq && selectedver ) {
                    // Filter the options based on the selected type
                    var filteredOptionsAnnee = $(originalOptions).filter("[data-mod='" + selectedmod + "'][data-mrq='" + selectedmrq + "'][data-ver='" + selectedver + "']");
                    $("#anSelector").html(filteredOptionsAnnee);
                } else {
                    // If no type is selected, reset to the original options
                    $("#anSelector").html(originalOptions);
                }
            });
        });
    </script>
   
  </form>
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
        $this->show_top_bar();
        $this->show_diaporma();
        $this->show_menu();
        $this->show_marque();
        $this->show_list_type();
        // First line of forms
        '<div class="form-container1">';
        $this->show_form1();
        echo '<div class="form-space"></div>';
        $this->show_form1();
        echo '</div>';

        // Second line of forms
        echo '<div class="form-container2">';
        $this->show_form1();
        echo '<div class="form-space"></div>';
        $this->show_form1();
        echo '</div>';
 
        
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