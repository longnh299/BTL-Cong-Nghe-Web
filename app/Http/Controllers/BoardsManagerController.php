<?php

namespace App\Http\Controllers;

use App\Models\Board\Board;
use App\Models\Board\Column;
use App\Models\Board\Users_board;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class BoardsManagerController extends Controller
{
    public function index(Request $request){
        $id = $request->user()->id;
        $boards_own = Board::where('id_user', $id)->get();
        $boards_join = Users_board::where('id_user', $id)->get()->map(function($user_board) {return $user_board->board;});

        return view('boards/index')->with([
            'boards' => $boards_own->merge($boards_join),
        ]);
    }

    public function search(Request $request) {
        $id = $request->user()->id;
        $boards_own = Board::where('id_user', $id)->where('name', 'like', '%' . $request->input('query'). '%')->get();
        $boards_join = Users_board::join('boards' , 'users_boards.id_board', '=', 'boards.id')->where('users_boards.id_user', $id)->where('boards.name', 'like', '%' . $request->input('query'). '%')->get();
        return view('boards/index')->with("boards", $boards_own->merge($boards_join));
    }

    public function create(Request $request) {
        $request->validate([
            'name' => 'required|unique:boards'
        ]);

        $id = $request->user()->id;

        $board = Board::create([
            'name' => $request->input('name'),
            'id_user' => $id
        ]);
        return redirect(route('boards'));
    }

    public function edit($id) {
        $board = Board::where('id', $id)->first();
        return view('boards/detail')->with("board", $board);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|unique:boards',
        ]);

        $user = $request->user();
        $board_owner = Board::find($id)->user;

        if($user->id != $board_owner->id) {
            throw ValidationException::withMessages(['error' => 'You\'re not the owner']);

        }

        $board = Board::where('id', $id)->update([
            'name' => $request->input('name')
        ]);

        return redirect(route('board.edit', $id));
    }

    public function delete(Request $request, $id) {
        $user = $request->user();
        $board_owner = Board::find($id)->user;

        if($user->id != $board_owner->id) {
            throw ValidationException::withMessages(['error' => 'You\'re not the owner']);

        }
        $board = Board::where('id', $id)->delete();

        return redirect(route('boards'));
    }

    public function invite(Request $request, $id) {
        $owner = Board::find($id)->user;
        $members = Users_board::where('id_board', $id)->get()->map(function($user_board) {return $user_board->user;});
        $board = Board::find($id);
        return view('boards/invite')->with([
            'owner' => $owner,
            'members' => $members,
            'user' => $request->user(),
            'board' => $board
        ]);
    }

    public function inviteCreate(Request $request, $id) {
        $request->validate([
            'email' => 'required|email'
        ]);

        $email = $request->input('email');
        $user = User::where('email', $email)->first();
        if(!$user) {
             throw ValidationException::withMessages(['error' => 'Email not found']);
        }

        if(Users_board::where('id_user', $user->id)->where('id_board', $id)->first()) {
            throw ValidationException::withMessages(['error' => 'This member already in this board']);
        }

        $user_board = Users_board::create([
            'id_user' => $user->id,
            'id_board'=> $id
        ]);

        return redirect(route('board.invite', ['board_id' => $id]));
    }


    public function kick(Request $request, $board_id, $user_id) {
        $user_board = Users_board::where('id_user', $user_id)->where('id_board', $board_id)->delete();

        return redirect(route('board.invite', ['board_id' => $board_id]));
    }


    public function columns(Request $request, $id) {

        $board = Board::find($id);
        return view('boards/columns')->with([
            'board' => $board
        ]);
    }

    public function add(Request $request, $id) {
        $column = Column::create([
            'name' => $request->input('name'),
            'id_board' => $id
        ]);

        return redirect(route('board.columns', ['board_id' => $id]));

    }

}
