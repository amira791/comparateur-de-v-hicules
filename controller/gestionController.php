<?php

//Why when we use DIR pb is solved?


require_once(__DIR__ . '/../vue/adminVue/gestionVue.php');


class gestionController {

   

   public function show_website()
   {
    $vue = new gestionVue();
    $vue-> show_website();

   }
}