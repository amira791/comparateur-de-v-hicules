<?php

//Why when we use DIR pb is solved?

require_once(__DIR__ . '/../model/contactModel.php');
require_once(__DIR__ . '/../vue/userVue/contactVue.php');


class contactController {

    //Utilisation du model pour recuperer le tableau
    public function get_contact ()
    {
        $ctc_model = new contactModel();
        $res = $ctc_model->get_contact_table();
        return $res;
    }

   public function show_website()
   {
    $vue = new contactVue();
    $vue-> show_website();

   }
}