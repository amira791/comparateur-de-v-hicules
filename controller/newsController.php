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
    public function get_news_Id ($id)
    {
        $news_model = new newsModel();
        $res = $news_model->get_news_byId($id);
        return $res;
    }

    public function add_news ($titre, $contenu, $date_publication, $image_pr)
    {
        $news_model = new newsModel();
        $res = $news_model->add_news_table($titre, $contenu, $date_publication,  $image_pr);
        return $res;
    }
    public function update_news ($id_new, $titre, $contenu, $date_publication,  $image_pr)
    {
        $news_model = new newsModel();
        $res = $news_model->update_news_table($id_new, $titre, $contenu, $date_publication, $image_pr);
        return $res;
    }
    public function delete_news ($id_new)
    {
        $news_model = new newsModel();
        $res = $news_model->supp_log_new ($id_new);
        return $res;
    }

    

   public function show_website()
   {
    $vue = new newsVue();
    $vue-> show_website();

   }
}