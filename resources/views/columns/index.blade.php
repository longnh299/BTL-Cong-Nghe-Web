@extends('layouts.app')

@section('content')
<div class="container">
    <div class="m-8">
        <table>
            <tr>
                <th>Column name</th>
                <th>Created at</th>
                <th>Updated at</th>
            </tr>
            <tbody>
                <tr>
                    <td><a class="text-black" href="/columns/{{$column->id}}">{{$column->name}}</a></td>
                    <td>{{$column->created_at}}</td>
                    <td>{{$column->updated_at}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <hr />
       @if(!count($column->tasks))
            <h2>This column has no task</h2>
        @else
            <h1>List task</h1>
            <table>
                <tr>
                    <th>Task name</th>
                    <th>Due date</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                </tr>
                <tbody>
                    @foreach($column->tasks as $task)
                        <tr>
                            <td><a href="/tasks/{{$task->id}}" class="text-black">{{$task->name}}</a></td>
                            <td>{{$task->due_date}}</td>
                            <td>{{$task->created_at}}</td>
                            <td>{{$task->updated_at}}</td>
                            <td>
                                <form action="{{route('column.deleteTask', ['task_id' => $task->id, 'column_id' => $column->id])}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-red" type="submit">Delete task</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <form method="post" action="/columns/{{$column->id}}/tasks" class="m-8">
            @csrf
            <div><input class="input_bar" placeholder="Name", type="text" name="name"></input></div>
            <div><input class="input_bar m-8" placeholder="Description" type="text" name="description"></input></div>
            <div><input class="input_bar" placeholder="Due date", type="date" name="due_date"></input></div>
            <div class="m-8"><button class="btn" type="submit">Create task</button></div>
        </form>
        @if($errors->any())
                @foreach($errors->all() as $item)
                <p class="text-red">{{$item}}</p>
                @endforeach
        @endif
        <div class="m-8"><a class="btn" href="/workspace/board/{{$column->board->id}}">Back</a></div>
</div>
@endsection
