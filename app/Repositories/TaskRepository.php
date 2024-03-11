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

    /**
     * fetching the paginated data
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
