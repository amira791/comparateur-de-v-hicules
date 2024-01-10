<?php

//Why when we use DIR pb is solved?

require_once(__DIR__ . '/../model/newsModel.php');
require_once(__DIR__ . '/../vue/userVue/newsVue.php');


class newsController {

    //Utilisation du model pour recuperer le tableau
    public function get_news ()
    {
        $new_model = new newsModel();
        $res = $new_model->get_news_table();
        return $res;
    }

   public function show_website()
   {
    $vue = new newsVue();
    $vue-> show_website();

   }
}