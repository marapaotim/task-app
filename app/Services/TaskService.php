<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use App\Services\Contracts\TaskServiceInterface;
use App\Repositories\Contracts\TaskRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class TaskService implements TaskServiceInterface
{
	private $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function create($data)
    {
        $data = array_merge($data, [
            'user_id' => Auth::id()
        ]);
        return $this->taskRepository->create($data);
    }

    public function update($id, $data)
    {
        $task = $this->taskRepository->findById($id);
        return $this->taskRepository->update($task, $data);
    }

    public function remove($id)
    {
        $task = $this->taskRepository->findById($id);
        $task->removed = 1;
        $task->removed_at = \Carbon\Carbon::now();
        $task->save();
    }

    public function getTasksPaginate($limit, $status, $sortTitle, $sortDate, $searchSaveStatus, $search)
    {
        return $this->taskRepository->fetchTaskPaginate($limit, $status, $sortTitle, $sortDate, $searchSaveStatus, $search);
    }
}
