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
    

   public function show_website()
   {
        $vue = new accueilVue();
        $vue->show_website();
   }
}

?>

