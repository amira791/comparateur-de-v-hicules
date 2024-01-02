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
            foreach ($table as $row) {
                $designation = htmlspecialchars($row['designation']);
                $champLocation = htmlspecialchars($row['location']); // Assuming 'champ_location' is the column name in your database
    
                // Link each menu item to its champ location with white text color
                echo '<div class="menu-item"><a href="' . $champLocation . '" style="color: white;">' . $designation . '</a></div>';
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
      
        $this->show_form1();
   
        $this->show_form2();
     

        // Second line of forms
 
        $this->show_form3();

        $this->show_form4();
        $this->show_button_comparer();
     
 
        
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