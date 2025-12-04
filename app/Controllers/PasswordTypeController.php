<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Notification;
use App\Core\Validator;
use App\Repositories\PasswordTypeRepository;

class PasswordTypeController extends Controller
{
    protected $passwordTypesRepository;

    public function __construct()
    {
        $this->passwordTypesRepository = new PasswordTypeRepository();
    }

    public function index()
    {
        $password_types = $this->passwordTypesRepository->getAll();
        $this->view('password_types/index', ['password_types' => $password_types]);
    }

    public function create()
    {   
        $this->view('password_types/create', ['title' => 'Créer un type de mot de passe']);
    }

    public function store()
    {   
        $validated = Validator::make($_POST, [
            'label' => 'required|string|max:255',
            'color' => 'string|max:7'
        ]);

        if (!$validated) {
            Notification::add('error', 'Données invalides. Veuillez vérifier les informations fournies.');
            header('Location: ' . url('/password-types'));
            exit();
        }

        $this->passwordTypesRepository->create($_POST);
        header('Location: ' . url('/password-types'));
        exit();
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $password_type = $this->passwordTypesRepository->getById($id);

        if(!$password_type) {
            return $this->view('errors/404', ['title' => 'Type de mot de passe non trouvé']);
        }

        $this->view('password_types/edit', [
            'title'=> 'Éditer le projet', 
            'password_type' => $password_type
        ]);
    }

    public function update($id)
    {   
        $validated = Validator::make($_POST, [
            'label' => 'required|string|max:255',
            'color' => 'string|max:7'
        ]);

        if (!$validated) {
            Notification::add('error', 'Données invalides. Veuillez vérifier les informations fournies.');
            header('Location: ' . url('/password-types/' . $id . '/show'));
            exit();
        }

        $this->passwordTypesRepository->update($id, $_POST);

        header('Location: ' . url('/password-types/' . $id . '/show'));
        exit();
    }

    public function destroy($id)
    {
        $this->passwordTypesRepository->delete($id);

        header('Location: ' . url('/password-types'));
        exit();
    }


}