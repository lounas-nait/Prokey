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

    public function create()
    {   
        $this->view('project/create', ['title' => 'Créer un projet']);
    }

    public function store()
    {
        $this->projectRepository->create($_POST);
        header('Location: ' . url('/projects'));
        exit();
    }

    public function show()
    {
        $id = $_GET['id'];

        $project = $this->projectRepository->getById($id);

        if(!$project) {
            return $this->view('errors/404', ['title' => 'Projet non trouvé']);
        }

        $this->view('project/show', [
            'title'=> $project['name'], 
            'project' => $project
        ]);
    }

    public function edit()
    {
        $id = $_GET['id'];

        $project = $this->projectRepository->getById($id);

        if(!$project) {
            return $this->view('errors/404', ['title' => 'Projet non trouvé']);
        }

        $this->view('project/edit', [
            'title'=> 'Éditer le projet', 
            'project' => $project
        ]);
    }

    public function update()
    {
        $id = $_GET['id'];
        $this->projectRepository->update($id, $_POST);

        header('Location: ' . url('/projects/show?id=' . $id));
        exit();
    }


}