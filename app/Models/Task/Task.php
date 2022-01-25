<?php

namespace App\Models\Task;

use App\Models\Board\Column;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'due_date',
        'id_column'
    ];

    public function column(){
        return $this->belongsTo(Column::class,'id_column','id');
    }

    public function usersTasks(){
        return $this->hasMany(Users_task::class,'id_task','id');
    }

    public function comments() {
        return $this->hasMany(Comment::class, 'id_task', 'id');
    }

    public function is_late() {
        $due_date = new \DateTime($this->due_date);
        $now = new \DateTime("now");
        return $now > $due_date;
    }

    public function is_near_due_date() {
        $due_date = new \DateTime($this->due_date);
        $now = new \DateTime("now");
        $diff=date_diff($now,$due_date);
        if($diff->d < 2) {
            return true;
        }
        else {
            return false;
        }
    }
}
