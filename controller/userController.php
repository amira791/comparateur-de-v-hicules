<?php

//Why when we use DIR pb is solved?

require_once(__DIR__ . '/../model/userModel.php');
require_once(__DIR__ . '/../vue/userVue/connectionVue.php');


class userController {

    //Utilisation du model pour recuperer le tableau
    public function get_users ()
    {
        $users = new userModel();
        $res = $users->get_user_table();
        return $res;
    }


   public function user_block ($username)
   {
        $user = new userModel();
        $res = $user->block_user($username);
        return $res;
   }

   public function  add_user($username, $password)
   {
    $new_user = new userModel();
    $new_user->add_user_table($username, $password);
    
   }



   public function show_website()
   {
    $vue = new connectionVue();
    $vue-> show_website();

   }
}