<?php

namespace App\Repositories\Contracts;

interface TaskRepositoryInterface extends RepositoryInterface
{
    public function fetchTaskPaginate($limit, $status, $sortTitle, $sortDate, $searchSaveStatus, $search);
}
