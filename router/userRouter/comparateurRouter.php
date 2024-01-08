<?php

require_once('../../vue/userVue/comparateurVue.php');

if (isset($_GET['tableData'])) {
    $decodedTableData = urldecode($_GET['tableData']);
    echo "<table>" . $decodedTableData . "</table>";
} else {
    
    echo "Table data not available.";
}

$vue = new comparateurVue();
$vue->show_website();

?>
