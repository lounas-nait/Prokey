<?php 

namespace App\Core;
class Controller {
   
    public function view($entity, $viewName, $data = []) {
        return View::render($entity, $viewName, $data);  
    }
}