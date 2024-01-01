<?php

//Why when we use DIR pb is solved?

require_once(__DIR__ . '/../model/vehiculeModel.php');
require_once(__DIR__ . '/../vue/userVue/accueilVue.php');


class vehiculeController {

    //Utilisation du model pour recuperer le tableau
    public function get_typeVh ()
    {
        $diap_model = new vehiculeModel();
        $res = $diap_model->get_typeVh_table();
        return $res;
    }

   public function show_website()
   {
    $vue = new accueilVue();
    $vue-> show_website();

   }
}