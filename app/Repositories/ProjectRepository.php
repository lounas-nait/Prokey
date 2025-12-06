<?php

namespace App\Repositories;
use App\Models\Project;
use App\Core\Database;

class ProjectRepository extends BaseRepository
{
    protected $db;
    protected $model;

    public function __construct()
    {
        $this->db = new Database(); 
        parent::__construct(new Project());
    }
    

public function getAllByUser($userId)
    {
        return $this->model->query(
            "SELECT * FROM projects WHERE user_id = ?",
            [$userId]
        );
    }

}
