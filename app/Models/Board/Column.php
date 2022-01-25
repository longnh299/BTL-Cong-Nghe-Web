<?php

namespace App\Models\Board;

use App\Models\Task\Task;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'id_board'
    ];

    public function board(){
        return $this->belongsTo(Board::class, 'id_board', 'id');
    }

    public function tasks(){
        return $this->hasMany(Task::class, 'id_column', 'id');
    }
}
