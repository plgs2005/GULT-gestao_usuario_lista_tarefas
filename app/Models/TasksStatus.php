<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TasksStatus extends Model
{
    protected $table = 'tasks_status';

    protected $fillable = ['status','id'];
  
    public function getStatus($name = null)
    {
      if (!$name)
        return $this->get();
  
      return $this->where('status', 'LIKE', "%{$name}%")->get();
    }
     
  //produtos seria as tarefas
    public function list()
    {
      
       return $this->hasMany(TasksList::class, 'task_status_id'); 
    }
  
}
