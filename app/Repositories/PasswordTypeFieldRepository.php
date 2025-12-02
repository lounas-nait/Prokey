<?php

namespace App\Repositories;
use App\Models\Project;
use App\Core\Database;

class PasswordTypeFieldRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new PasswordTypeField();
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

}



