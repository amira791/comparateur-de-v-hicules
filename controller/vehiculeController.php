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

   public function delete_vehicule ($id_vh)
   {
        $vhe_model = new vehiculeModel();
        $res = $vhe_model-> supp_log_vh($id_vh);
        
   }
   public function add_vehicule_principal ($id_mrq, $id_vh)
   {
        $vhe_model = new vehiculeModel();
        $res = $vhe_model-> add_vehicule_principal_table($id_mrq, $id_vh);
        
   }
   public function get_pop ()
   {
        $vhe_model = new vehiculeModel();
        $res = $vhe_model->get_cmp_pop ();
        return $res;
        
   }
   public function get_guide ($id)
   {
        $vhe_model = new vehiculeModel();
        $res = $vhe_model->get_guide_achat ($id);
        return $res;    
   }
   public function get_VehNotes ($id)
   {
        $vhe_model = new vehiculeModel();
        $res = $vhe_model->get_notes_vehicule ($id);
        return $res;    
   }
   public function add_VehNotes ($id_vh, $note, $username)
   {
        $vhe_model = new vehiculeModel();
        $res = $vhe_model->add_marque_note($id_vh, $note, $username );
        
   }
   public function get_VehCar ($id)
   {
        $vhe_model = new vehiculeModel();
        $res = $vhe_model->get_carac_vehicule ($id);
        return $res;    
   }
   public function get_Car ()
   {
        $vhe_model = new vehiculeModel();
        $res = $vhe_model->get_carac ();
        return $res;    
   }
   public function get_listFav ($username)
   {
        $vhe_model = new vehiculeModel();
        $res = $vhe_model->get_fav_user ($username);
        return $res;    
   }
   public function add_listFav ($id_vh, $username)
   {
        $vhe_model = new vehiculeModel();
        $res = $vhe_model->add_fav_user ( $id_vh ,$username);
        return $res;    
   }
   public function get_avis ($id_vh)
   {
        $vhe_model = new aviModel();
        $res = $vhe_model->get_avi_veh_table($id_vh);
        return $res;    
   }
   public function delete_car ($id_car)
   {
        $vhe_model = new vehiculeModel();
        $res = $vhe_model-> supp_car ($id_car);

        
   }
   public function updateCar ($id_car, $value, $id_vh)
   {
        $vhe_model = new vehiculeModel();
        $res = $vhe_model->update_car ($id_car, $value, $id_vh);
        return $res;      
   }
   public function getNoteVh ($id_vh, $username)
   {
        $vhe_model = new vehiculeModel();
        $res = $vhe_model->get_note_vh ($id, $username);
        return $res;      
   }
   public function addVehCarac ($nom_carac)
   {
        $vhe_model = new vehiculeModel();
        $res = $vhe_model->add_veh_car ($nom_carac);
        return $res;      
   }




   public function show_website()
   {
    $vue = new accueilVue();
    $vue-> show_website();

   }
}