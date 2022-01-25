<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board\Column;
use App\Models\Task\Task;
use Illuminate\Validation\ValidationException;

class ColumnsManagerController extends Controller
{
    public function index($id) {
        $column = Column::find($id);
        return view('columns.index')->with([
            'column' => $column
        ]);
    }

    public function edit(Request $request, $column_id) {
        $column = Column::where('id', $column_id)->first();
        return view('columns.detail')->with([
            'column' => $column
        ]);
    }

    public function update(Request $request, $column_id) {
        $column = Column::where('id', $column_id)->update(
            ['name' => $request->input('name')]
        );

        return redirect(route('column.edit', [
            'column_id' => $column_id
        ]));
    }

    public function delete(Request $request, $column_id) {
        $column = Column::where('id', $column_id)->first();
        $board_id = $column->id_board;
        $column->delete();
        return redirect(route('board.columns', ['board_id' => $board_id]));
    }

    public function createTask(Request $request, $id) {
        $request->validate([
            'name' => 'required'
        ]);

        if($request->input('due_date')) {
            $due_date = new \DateTime($request->input('due_date'));
            $now = new \DateTime("now");

            if($now > $due_date) {
                 throw ValidationException::withMessages(['error' => 'Due date is not valid']);
            }
        }

        $task = Task::create([
            'id_column' => $id,
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'due_date' => $request->input('due_date'),
        ]);

        return redirect(route('column.tasks', ['column_id' => $id]));
    }

    public function deleteTask(Request $request, $column_id, $task_id) {
        $task = Task::where('id_column', $column_id)->where('id', $task_id)->delete();
        return redirect(route('column.tasks', ['column_id' => $column_id]));
    }
}
