<?php 

namespace App\Controllers;
use App\Core\Controller;

class HomeController extends Controller {

    public function index() {
        $data = ['title' => 'Welcome to ProKey'];
        return $this->view('home', $data);
    }
}