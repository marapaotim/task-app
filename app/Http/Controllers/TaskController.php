<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Contracts\TaskServiceInterface;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    /**
     * @var TaskService
     */
    private $taskService;

    public function __construct(TaskServiceInterface $taskService)
    {
        $this->taskService = $taskService;
    }

    public function create(TaskRequest $request)
    {
        $this->taskService->create($request->all());
        return response()->json([
            'message' => 'Successfully Created'
        ]);
    }

    public function update($id, TaskRequest $request)
    {
        $data = $this->taskService->update($id, $request->all());
        return response()->json([
            'message' => 'Successfully Updated',
            'data' => $data
        ]);
    }

    public function remove($id)
    {
        $data = $this->taskService->remove($id);
        return response()->json([
            'message' => 'Successfully Remove'
        ]);
    }

    public function getTasksPaginate($limit, $status, $sortTitle, $sortDate, $searchSaveStatus, $search = null)
    {
        $data = $this->taskService->getTasksPaginate($limit, $status, $sortTitle, $sortDate, $searchSaveStatus, $search);
        return response()->json($data);
    }
}
