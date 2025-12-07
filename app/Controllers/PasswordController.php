<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Notification;
use App\Core\Validator;
use App\Repositories\PasswordRepository;
use App\Repositories\PasswordTypeRepository;
use App\Repositories\PasswordTypeFieldRepository;
use App\Services\EncryptionService;

class PasswordController extends Controller
{
    protected $passwordRepository;

    public function __construct()
    {
        $this->passwordRepository = new PasswordRepository();
    }

    public function create($project_id)
    {
        $passwordTypeRepo = new PasswordTypeRepository();
        $password_types = $passwordTypeRepo->getAll();

        $selected_type = $_GET['password_type_id'] ?? null;

        $fields = [];
        if ($selected_type) {
            $passwordTypeFieldRepo = new PasswordTypeFieldRepository();
            $fields = $passwordTypeFieldRepo->getFieldsByType($selected_type);
        }

        $this->view(
            'password/create',
            [
                'title' => 'Ajouter un mot de passe',
                'project_id' => $project_id,
                'selected_type' => $selected_type,
                'password_types' => $password_types,
                'fields' => $fields,
            ]
        );
    }

    public function store()
    {

        $validated = Validator::make($_POST, [
            'project_id' => 'required|number',
            'password_type_id' => 'required|number',
            'label' => 'required|string|max:255',
            'extra' => 'required'
        ]);

        if (!$validated) {
            Notification::add('error', 'Données invalides. Veuillez vérifier les informations fournies.');
            header('Location: ' . url('/projects/' . $_POST['project_id'] . '/show'));
            exit();
        }

        $extra = $_POST['extra'];
        $extraJSON = json_encode($extra);

        $extraEncrypted = EncryptionService::encrypt($extraJSON);

        $data = [
            'project_id' => $_POST['project_id'],
            'type_id' => $_POST['password_type_id'],
            'label' => $_POST['label'],
            'extra' => $extraEncrypted,
        ];

        $passwordId = $this->passwordRepository->create($data);

        // --- Upload du fichier ---
        if (!empty($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $fileInfo = \App\Services\FileService::upload($_FILES['file']);

            if ($fileInfo) {
                $fileRepository = new \App\Repositories\FileRepository();
                $fileRepository->create([
                    'password_id' => $passwordId,
                    'filename'    => $fileInfo['filename'],
                    'stored_name' => $fileInfo['stored_name'],
                    'mime_type'   => $fileInfo['mime_type'],
                    'size'        => $fileInfo['size'],
                    'encrypted'   => 0
                ]);
            }
        }

        header('Location: ' . url('/projects/' . $_POST['project_id'] . '/show'));
        exit();
    }

    public function edit($project_id, $id)
    {
        $password = $this->passwordRepository->getById($id);
        if (!$password) {
            $this->view('errors/404', ['title' => 'Mot de passe non trouvé']);
            return;
        }

        $passwordTypeRepo = new PasswordTypeRepository();
        $password_types = $passwordTypeRepo->getAll();

        $passwordTypeFieldRepo = new PasswordTypeFieldRepository();
        $fields = $passwordTypeFieldRepo->getFieldsByType($password['type_id']);

        $extra = json_decode($password['extra'], true) ?? [];

        $this->view(
            'password/edit',
            [
                'title' => 'Editer le mot de passe',
                'project_id' => $project_id,
                'password' => $password,
                'password_types' => $password_types,
                'fields' => $fields,
                'extra' => $extra,
            ]
        );
    }

    public function update($project_id, $id)
    {
        $password = $this->passwordRepository->getById($id);
        if (!$password) {
            $this->view('errors/404', ['title' => 'Mot de passe non trouvé']);
            return;
        }

        // Transformer extra en JSON string
        $extraArray = $_POST['extra'] ?? [];
        $extraJSON = json_encode($extraArray);

        // données pour validation
        $toValidate = [
            "type_id" => $_POST["password_type_id"],
            "label" => $_POST["label"],
            "extra" => $extraJSON
        ];

        // Validation
        $validated = Validator::make($toValidate, [
            'type_id' => 'required|number',
            'label' => 'required|string|max:255',
            'extra' => 'required|string'
        ]);

        if (!$validated) {
            Notification::add('error', 'Données invalides. Veuillez vérifier les informations fournies.');
            header('Location: ' . url('/projects/' . $project_id . '/show'));
            exit();
        }


        $data = [
            'type_id' => $_POST['password_type_id'],
            'label' => $_POST['label'],
            'extra' => EncryptionService::encrypt($extraJSON),
        ];

        $this->passwordRepository->update($id, $data);


        if (!empty($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $fileInfo = \App\Services\FileService::upload($_FILES['file']);

            if ($fileInfo) {
                $fileRepository = new \App\Repositories\FileRepository();
                $fileRepository->create([
                    'password_id' => $id,
                    'filename'    => $fileInfo['filename'],
                    'stored_name' => $fileInfo['stored_name'],
                    'mime_type'   => $fileInfo['mime_type'],
                    'size'        => $fileInfo['size'],
                    'encrypted'   => 0
                ]);
            }
        }

        header('Location: ' . url('/projects/' . $project_id . '/show'));
        exit();
    }


    public function destroy($project_id, $id)
    {
        $password = $this->passwordRepository->getById($id);
        if (!$password) {
            $this->view('errors/404', ['title' => 'Mot de passe non trouvé']);
            return;
        }

        $this->passwordRepository->delete($id);

        header('Location: ' . url('/projects/' . $project_id . '/show'));
        exit();
    }
}
