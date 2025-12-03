<?php

namespace App\Repositories;
use App\Models\Password;
use App\Core\Database;

class PasswordRepository extends BaseRepository
{
    protected $model;

    public function __construct()
    {
        parent::__construct(new Password());
    }

    public function allByProjectId($projectId)
    {
        return $this->model->query("SELECT p.*, t.label AS type_label, t.color AS type_color
                             FROM passwords p
                             JOIN password_types t ON p.type_id = t.id
                             WHERE p.project_id = ?", [$projectId]);
    }

    

}



