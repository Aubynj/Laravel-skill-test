<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public $primaryKey = 'project_id';


    public function tasks(){
        return $this->hasMany(Task::class, 'project_id');
    }

    public function owner(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
