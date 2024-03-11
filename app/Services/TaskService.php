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

    /**
     * Create for task
     *
     * @param $data
     *
     * @return Task $task
     */
    public function create($data)
    {
        $data = array_merge($data, [
            'user_id' => Auth::id()
        ]);
        return $this->taskRepository->create($data);
    }

    /**
     * Update for task
     *
     * @param $id   id of the Task
     * @param $data the data that to be updated
     *
     * @return Task $task
     */
    public function update($id, $data)
    {
        $task = $this->taskRepository->findById($id);
        return $this->taskRepository->update($task, $data);
    }

    /**
     * Soft Delete for task
     *
     * @param $id   id of the Task
     *
     * @return void
     */
    
    public function remove($id)
    {
        $task = $this->taskRepository->findById($id);
        $task->removed = 1;
        $task->removed_at = \Carbon\Carbon::now();
        $task->save();
    }

    
    /**
     * Getting the paginated data
     *
     * @param $limit    filter limit the task display per page
     * @param $status   filter status for the tasks data
     * @param $sortTitle sorting of data base on title
     * @param $sortDate sorting of data base on date created
     * @param $searchSaveStatus filter data based on search save status
     * @param $search   filter data base on search by title    
     *
     * @return Task data
     */
    public function getTasksPaginate($limit, $status, $sortTitle, $sortDate, $searchSaveStatus, $search)
    {
        return $this->taskRepository->fetchTaskPaginate($limit, $status, $sortTitle, $sortDate, $searchSaveStatus, $search);
    }
}
