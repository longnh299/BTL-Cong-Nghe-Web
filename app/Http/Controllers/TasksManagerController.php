<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task\Task;
use App\Models\Task\Users_task;
use App\Models\Task\Comment;
use Illuminate\Validation\ValidationException;

class TasksManagerController extends Controller
{
    public function index(Request $request, $id) {
        $task = Task::where('id', $id)->first();
        $is_join = Users_task::where('id_task', $id)->where('id_user', $request->user()->id)->first();

        return view('tasks.index')->with([
            'task' => $task,
            'is_join' => $is_join
        ]);
    }

    public function update(Request $request, $id) {
        $task = Task::where('id', $id)->first();
        $description = $request->input('description') != "" ? $request->input('description') : $task->description;
        $name = $request->input('name') != "" ? $request->input('name') : $task->name;
        $is_done = $request->input('is_done') != "" ? $request->input('is_done') : $task->is_done;
        $due_date = $request->input('due_date');

        if($request->input('is_done') == "") {
            if($request->input('due_date')) {
                $due_date = new \DateTime($request->input('due_date'));
                $now = new \DateTime("now");

                if($now > $due_date) {
                     throw ValidationException::withMessages(['error' => 'Due date is not valid']);
                }
            }
        }

        $task = Task::where('id', $id)->update([
            'description' => $description,
            'name' => $name,
            'due_date' => $due_date,
            'is_done' => $is_done
        ]);

        return redirect(route('task.index', ['task_id' => $id]));
    }

    public function join(Request $request, $task_id) {
        $user_id = $request->user()->id;
        $users_tasks = Users_task::create([
            'id_task' => $task_id,
            'id_user' => $user_id
        ]);

        return redirect(route('task.index', ['task_id' => $task_id]));
    }

    public function unjoin(Request $request, $task_id) {
        $user_id = $request->user()->id;
        $users_tasks = Users_task::where('id_task', $task_id)->where('id_user', $user_id)->delete();

        return redirect(route('task.index', ['task_id' => $task_id]));
    }

    public function delete(Request $request, $task_id) {
        $task = Task::where('id_column', $column_id)->where('id', $task_id)->delete();
        return redirect(route('column', ['column_id' => $column_id]));
    }

    public function comment(Request $request, $id) {
        $request->validate([
            'content' => 'required'
        ]);

        $comment = Comment::create([
            'content' => $request->input('content'),
            'id_task' => $id,
            'id_user' => $request->user()->id
        ]);

        return redirect(route('task.index', ['task_id' => $id]));
    }

}
