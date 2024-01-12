<?php

//Why when we use DIR pb is solved?

require_once(__DIR__ . '/../model/vehiculeModel.php');
require_once(__DIR__ . '/../vue/userVue/accueilVue.php');


class vehiculeController {

    //Utilisation du model pour recuperer le tableau
    public function get_typeVh ()
    {
        $typeVh = new vehiculeModel();
        $res = $typeVh->get_typeVh_table();
        return $res;
    }

   public function get_vehicule ()
   {
        $vh_model = new vehiculeModel();
        $res = $vh_model->get_vehicule_table();
        return $res;
   }

   public function get_caracvh ()
   {
        $caracvh_model = new vehiculeModel();
        $res = $caracvh_model-> get_caracvh_table();
        return $res;
   }

   public function get_carac ()
   {
        $caracvh_model = new vehiculeModel();
        $res = $caracvh_model->get_carac_table();
        return $res;
   }

   public function get_prinvh_v ($ids)
   {
        $prinvh_model = new vehiculeModel();
        $res = $prinvh_model-> get_prinvh_table($ids);
        return $res;
   }
   public function get_vhById ($id_vhc)
   {
        $vh_model = new vehiculeModel();
        $res = $vh_model-> get_veh_byId($id_vhc);
        return $res;
   }
   public function add_vehicule ($marque, $modele, $version, $annee, $image, $type)
   {
        $vhi_model = new vehiculeModel();
        $res = $vhi_model-> add_vehicle_table($marque, $modele, $version, $annee, $image, $type);
        
   }

   public function modify_vehicule ($id_vh, $marque, $modele, $version, $annee, $image)
   {
        $vhe_model = new vehiculeModel();
        $res = $vhe_model-> update_vehicule_table($id_vh, $marque, $modele, $version, $annee, $image);
        
   }


   public function show_website()
   {
    $vue = new accueilVue();
    $vue-> show_website();

   }
}