<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\TaskRepositoryInterface;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskRepository extends BaseRepository implements TaskRepositoryInterface
{
    public function __construct(Task $model)
    {
        parent::__construct($model);
    }

    public function fetchTaskPaginate($limit, $status, $sortTitle, $sortDate, $searchSaveStatus, $search) {
        $query = $this->newQuery()->where(['user_id' => Auth::id(), 'removed' => 0]);

        if ($status != 'all') {
            $query = $query->where('status', $status);
        }

        if ($searchSaveStatus != 'all') {
            $query = $query->where('save_status', $searchSaveStatus);
        }

        if ($search) {
            $query = $query->where('title', 'like', '%'.$search.'%');
        }

        return $query->orderBy('title', $sortTitle)
                    ->orderBy('created_at', $sortDate)->paginate($limit);
    }
}
