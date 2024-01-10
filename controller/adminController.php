<?php


require_once(__DIR__ . '/../model/adminModel.php');
require_once(__DIR__ . '/../vue/adminVue/connectionVue.php');


class adminController {


    public function get_admins ()
    {
        $admins = new adminModel();
        $res = $admins->get_admin_table();
        return $res;
    }

   public function show_website()
   {
    $vue = new connectionVue();
    $vue-> show_website();

   }
}