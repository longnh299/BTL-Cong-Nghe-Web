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
                        <td>{{$column->name}}</td>
                        <td>{{$column->created_at}}</td>
                        <td>{{$column->updated_at}}</td>
                    </tr>
                </tbody>
            </table>
            <div class="m-4">
                <form method="post" action="/columns/{{$column->id}}">
                    @csrf
                    @method('put')
                    <input class="input_bar m-8" placeholder="Column name" name="name" type="text"></input>
                    <div><button class="btn">Change name</button></div>
                </form>
                <form method="post" action="/columns/{{$column->id}}" class="m-8">
                    @csrf
                    @method('delete')
                    <button class="btn btn-red" type="submit">Delete column</button>
                </form>
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
                        <th>Is done</th>
                    </tr>
                    <tbody>
                        @foreach($column->tasks as $task)
                            <tr>
                                <td><a class="text-black" href="/tasks/{{$task->id}}">{{$task->description}}</td>
                                <td>{{$task->due_date}}</td>
                                <td>{{$task->created_at}}</td>
                                <td>{{$task->updated_at}}</td>
                                <td>{{$task->is_done ? 'Yes': 'No'}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
            <div class="m-8">
                <a class="btn m-8" href="/columns/{{$column->id}}/tasks">Add task</a>
                <a class="btn m-8" href="/workspace/board/{{$column->board->id}}">Back</a>
            </div>
        </div>
    </div>
@endsection
