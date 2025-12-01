<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Repositories\ProjectRepository;

class ProjectController extends Controller
{
    protected $projectRepository;

    public function __construct()
    {
        $this->projectRepository = new ProjectRepository();
    }

    public function index()
    {
        $projects = $this->projectRepository->getAll();
        $this->view('project/index', ['projects' => $projects]);
    }

}