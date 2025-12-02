<?php

namespace App\Repositories;
use App\Models\Password;
use App\Core\Database;

class PasswordRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new Password();
    }

    public function getAll()
    {
        return $this->model->getAll();
    }

    public function getById($id)
    {
        return $this->model->getById($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        return $this->model->update($id, $data);
    }   

    public function delete($id)
    {
        return $this->model->delete($id);
    }

    public function allByProjectId($projectId)
    {
        return $this->model->query("SELECT p.*, t.label AS type_label, t.color AS type_color
                             FROM passwords p
                             JOIN password_types t ON p.type_id = t.id
                             WHERE p.project_id = ?", [$projectId]);
    }

}



