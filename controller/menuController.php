<?php

//Why when we use DIR pb is solved?

require_once(__DIR__ . '/../model/menuModel.php');
require_once(__DIR__ . '/../vue/userVue/accueilVue.php');


class menuController {

    //Utilisation du model pour recuperer le tableau
    public function get_menu ()
    {
        $diap_model = new menuModel();
        $res = $diap_model->get_menu_table();
        return $res;
    }

   public function show_website()
   {
    $vue = new accueilVue();
    $vue-> show_website();

   }
}