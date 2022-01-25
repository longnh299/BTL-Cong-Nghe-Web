<?php

namespace App\Models\Board;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users_board extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_board',
        'id_user'
    ];

    public function board(){
        return $this->belongsTo(Board::class,'id_board','id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }
}
