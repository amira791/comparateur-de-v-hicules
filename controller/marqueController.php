<?php




//Why when we use DIR pb is solved?

require_once(__DIR__ . '/../model/marqueModel.php');
require_once(__DIR__ . '/../vue/userVue/accueilVue.php');


class marqueController {

    


    //Utilisation du model pour recuperer le tableau
    public function get_marque ()
    {
        $mrq_model = new marqueModel();
        $res = $mrq_model->get_marque_table();
        return $res;
    }
    public function get_marque_pr ()
    {
        $mrq_model = new marqueModel();
        $res = $mrq_model->get_marque_principal_table();
        return $res;
    }


   public function get_mrqType ()
   {
        $mrq_model = new marqueModel();
        $res = $mrq_model->get_mrqType_table();
        return $res;
   }

   public function get_details ($id)
   {
        $mrq_model = new marqueModel();
        $res = $mrq_model->get_mrq_details ($id);
        return $res;
   }

   public function get_princVh ($id)
   {
        $mrq_model = new marqueModel();
        $res = $mrq_model->get_princp_veh ($id);
        return $res;
   }

   public function get_allVh ($id)
   {
        $mrq_model = new marqueModel();
        $res = $mrq_model->get_all_vh($id);
        return $res;
   }

   public function add_marque ($logo, $Nom, $pays_origine, $siege_social, $annee_creation, $histoire
   , $Fondateurs, $Slogan, $Produits, $Site_web)
   {
        $mrq_model = new marqueModel();
        $res = $mrq_model->add_marque_table($logo, $Nom, $pays_origine, $siege_social, $annee_creation, $histoire
        , $Fondateurs, $Slogan, $Produits, $Site_web);
        return $res;
   }

   public function modify_marque ($id_mrq,$logo, $Nom, $pays_origine, $siege_social, $annee_creation, $histoire
   , $Fondateurs, $Slogan, $Produits, $Site_web)
   {
        $mrq_model = new marqueModel();
        $res = $mrq_model->update_marque_table($id_mrq,$logo, $Nom, $pays_origine, $siege_social, $annee_creation, $histoire
        , $Fondateurs, $Slogan, $Produits, $Site_web);
        return $res;
   }

   public function delete_marque ($id_mrq)
   {
        $mrq_model = new marqueModel();
        $res = $mrq_model->supp_log_vh($id_mrq);
        return $res;
   }

   public function get_marque_ById ($id)
   {
        $mrq_model = new marqueModel();
        $res = $mrq_model->get_mrq_details ($id);
        return $res;
   }
    

   public function show_website()
   {
        $vue = new accueilVue();
        $vue->show_website();
   }
}

?>

