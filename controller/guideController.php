<?php

//Why when we use DIR pb is solved?

require_once(__DIR__ . '/../model/guideModel.php');
require_once(__DIR__ . '/../vue/userVue/guideAchatVue.php');


class guideController {

    //Utilisation du model pour recuperer le tableau
    public function get_guide ()
    {
        $ctc_model = new guideModel();
        $res = $ctc_model->get_guide_table();
        return $res;
    }
    public function  get_guide_ById($id_vh)
    {
        $ctc_model = new guideModel();
        $res = $ctc_model->get_guide_table();
        return $res;
    }

   public function show_website()
   {
    $vue = new contactVue();
    $vue-> show_website();

   }
}