<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Notification;
use App\Core\Validator;
use App\Repositories\ProjectRepository;
use App\Repositories\PasswordRepository;

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
        $validated = Validator::make($_POST, [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000'
        ]);

        if (!$validated) {
            Notification::add('error', 'Données invalides. Veuillez vérifier les informations fournies.');
            header('Location: ' . url('/projects'));
            exit();
        }

        $this->projectRepository->create($_POST);
        header('Location: ' . url('/projects'));
        exit();
    }

    public function show($id)
    {
        $project = $this->projectRepository->getById($id);

        if(!$project) {
            return $this->view('errors/404', ['title' => 'Projet non trouvé']);
        }

        $passwordRepository = new PasswordRepository();
        $passwords = $passwordRepository->allByProjectId($id);

        $this->view('project/show', [
            'title'=> $project['name'], 
            'project_id'=> $project['id'], 
            'project' => $project,
            'passwords' => $passwords,
        ]);
    }

    public function edit($id)
    {
        $project = $this->projectRepository->getById($id);

        if(!$project) {
            return $this->view('errors/404', ['title' => 'Projet non trouvé']);
        }

        $this->view('project/edit', [
            'title'=> 'Éditer le projet', 
            'project' => $project
        ]);
    }

    public function update($id)
    {
        $validated = Validator::make($_POST, [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000'
        ]);

        if (!$validated) {
            Notification::add('error', 'Données invalides. Veuillez vérifier les informations fournies.');
            header('Location: ' . url('/projects/' . $id . '/show'));
            exit();
        }

        $this->projectRepository->update($id, $_POST);

        header('Location: ' . url('/projects/' . $id . '/show'));
        exit();
    }

    public function destroy($id)
    {
        $this->projectRepository->delete($id);

        header('Location: ' . url('/projects'));
        exit();
    }


}