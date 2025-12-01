<?php

namespace App\Repositories;
use App\Models\Project;

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

   
}



