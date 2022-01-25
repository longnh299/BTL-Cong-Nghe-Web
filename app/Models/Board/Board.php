<?php

namespace App\Models\Board;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'id_user'
    ];

    public function columns()
    {
        return $this->hasMany(Column::class, 'id_board', 'id');
    }

    public function usersBoards(){
        return $this->hasMany(Users_board::class, 'id_board', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }
}
