<?php

namespace App\Repositories;

use App\Models\File;

class FileRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new File());
    }

    public function allByPassword($passwordId)
    {
        return $this->model->query(
            "SELECT * FROM files WHERE password_id = ? ORDER BY created_at DESC",
            [$passwordId]
        );
    }

    public function getById($id)
    {
        $results = $this->model->query("SELECT * FROM files WHERE id = ?", [$id]);
        return $results[0] ?? null;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function delete($id)
    {
        return $this->model->delete($id);
    }
}
