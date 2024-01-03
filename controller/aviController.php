<?php

//Why when we use DIR pb is solved?

require_once(__DIR__ . '/../model/aviModel.php');
require_once(__DIR__ . '/../vue/userVue/aviVue.php');


class aviController {

    //Utilisation du model pour recuperer le tableau
    public function get_all_avi_mrq ($id_mrq)
    {
        $avi_mrq = new aviModel();
        $res = $avi_mrq->get_avi_mrq_table($id_mrq);
        return $res;
    }

   public function get_trois_avi_mrq ($id_mrq)
   {
        $avi_mrq3 = new aviModel();
        $res = $avi_mrq3->get_troisMrq_vh($id_mrq);
        return $res;
   }



   public function show_website()
   {
    $vue = new accueilVue();
    $vue-> show_website();

   }
}