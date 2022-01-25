<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task\Comment;

class CommentManagerController extends Controller
{
    public function update(Request $request, $id) {
        $user = $request->user();
        $comment = Comment::find($id);

        $comment->update([
            'content' => $request->content
        ]);


        return redirect(route('task.index', ['task_id' => $comment->task->id]));
    }

    public function delete(Request $request, $id) {
        $comment = Comment::find($id);
        $task = $comment->task;
        $comment->delete();
        return redirect(route('task.index', ['task_id' => $task->id]));
    }
}
