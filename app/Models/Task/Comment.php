<?php

namespace App\Models\Task;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_task',
        'content'
    ];

    public function task(){
        return $this->belongsTo(Task::class, 'id_task');
    }

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }
}
