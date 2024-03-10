<?php

namespace App\Services\Contracts;

interface TaskServiceInterface
{
    public function create($data);
    public function getTasksPaginate($limit, $status, $sortTitle, $sortDate, $searchSaveStatus, $search);
    public function update($id, $data);
    public function remove($id);
}
