<?php

namespace App\Http\Controllers;

use App\Models\Board\Board;
use App\Models\Board\Users_board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkspaceController extends Controller
{
    public function index(Request $request, $id){
        $id_user = $request->user()->id;
        $board_own = Board::where('id_user',$id_user)->get();
        $board_join = Users_board::where('id_user', $id_user)->get()->map(function($user_board) {return $user_board->board;});
        $board = Board::find($id);
        return view('pages.workspace')->with([
            'board' => $board,
            'board_join' => $board_join,
            'board_own' => $board_own
        ]);
    }
}
