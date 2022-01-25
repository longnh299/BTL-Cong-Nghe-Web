<?php

namespace App\Models\Task;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users_task extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_task',
        'isFollow'
    ];

    public function task(){
        return $this->belongsTo(Task::class,'id_task','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'id_user','id');
    }

    public function comment(){
        return $this->hasMany(Comment::class,['id_task','id_user'],['id_task','id_user']);
    }
}
