<?php

//Why when we use DIR pb is solved?

require_once(__DIR__ . '/../model/marqueModel.php');
require_once(__DIR__ . '/../vue/userVue/accueilVue.php');


class marqueController {

    //Utilisation du model pour recuperer le tableau
    public function get_marque ()
    {
        $diap_model = new marqueModel();
        $res = $diap_model->get_marque_table();
        return $res;
    }

   public function show_website()
   {
    $vue = new accueilVue();
    $vue-> show_website();

   }
}