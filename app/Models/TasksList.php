<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TasksList extends Model
{
    
    protected $fillable = ['name', 'descripition', 'completionDate', 'user_id', 'task_status_id',];


    public function getResult($data, $total)
    {
        if (!isset($data['filter']) && !isset($data['name']) && !isset($data['descripition']))
            return $this->paginate($total);


        return $this->where(function ($query) use ($data) {
            if (isset($data['filter'])) {
                $filter = $data['filter'];
                $query->where('name', $filter);
                $query->orWhere('descripition', 'LIKE', "%{$filter}%");
            }

            if (isset($data['name'])) {
                $query->where('name', $data['name']);
            }

            if (isset($data['descripition'])) {
                $descripition = $data['descripition'];
                $query->where('descripition', $descripition);
                $query->orWhere('descripition', 'LIKE', "%{$descripition}%");
            }
        })->paginate($total);
    }

    //retorna a categoria desta tarefa **categorie seria o Status
    public function status()
    {
      
    return $this->belongsTo(TasksStatus::class, 'id'); 
    }
}
