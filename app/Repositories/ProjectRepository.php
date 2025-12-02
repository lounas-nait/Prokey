<?php

namespace App\Repositories;
use App\Models\Project;
use App\Core\Database;

class ProjectRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new Project();
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
    

}



