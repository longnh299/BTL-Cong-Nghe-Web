@extends('layouts.app')

@section('content')
    <div class="container">
        @if($errors->any())
            @foreach($errors->all() as $item)
            <p class="text-red m-8">{{$item}}</p>
            @endforeach
        @endif
        <div class="m-8">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Task description</th>
                    <th>Due date</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                </tr>
                <tr>
                    <td>{{$task->name}}</td>
                    <td>{{$task->description}}</td>
                    <td>{{$task->due_date}}</td>
                    <td>{{$task->created_at}}</td>
                    <td>{{$task->updated_at}}</td>
                    <td>
                        @if($task->is_done == "0")
                            <form action="/tasks/{{$task->id}}" method="post">
                                @csrf
                                @method('put')
                                <input class="d-none" name="is_done" type="text" value="1"></input>
                                <input class="d-none" name="due_date" type="hidden" value={{$task->due_date}}></input>
                                <button class="btn btn-red">Not Done</button>
                            </form>
                        @else
                            <form action="/tasks/{{$task->id}}" method="post">
                                @csrf
                                @method('put')
                                <input class="d-none" name="due_date" type="hidden" value={{$task->due_date}}></input>
                                <input class="d-none" name="is_done" type="text" value="0"></input>
                                <button class="btn btn-green">Done</button>
                            </form>
                        @endif
                    </td>
                    <td>
                        @if($is_join)
                            <form action="/tasks/{{$task->id}}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-red">Unjoin</button>
                            </form>
                        @else
                            <form action="/tasks/{{$task->id}}" method="post">
                                @csrf
                                <button class="btn">Join</button>
                            </form>
                        @endif
                    </td>
                </tr>
            </table>
            <form method="post" action="/tasks/{{$task->id}}">
                @csrf
                @method('put')
                <div><input class="input_bar m-4" placeholder="Change name" name="name" type="text"></input></div>
                <div><input class="input_bar m-4" placeholder="Change description" name="description" type="text"></input></div>
                <div><input class="input_bar m-4" placeholder="Change due date" name="due_date" type="date" value={{$task->due_date}}></input></div>
                <button class="btn" type="submit">Change task</button>
            </form>
             <form class="m-4" method="post" action="/columns/{{$task->column->id}}/tasks/{{$task->id}}">
                @csrf
                @method('delete')
                <button class="btn btn-red" type="submit">Delete task</button>
            </form>

        </div>
        <hr />
        <div>
            @if(!count($task->usersTasks))
                <h2>No one join this task</h2>
            @else
                <h1>People in charge</h1>
                <table>
                    <tr>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Join at</th>
                    </tr>
                    <tbody>
                        @foreach($task->usersTasks as $item)
                            <tr>
                                <td>{{$item->user->name}}</td>
                                <td>{{$item->user->email}}</td>
                                <td>{{$item->user->created_at}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <hr />
        <div>
            @if(!count($task->comments))
                <h2>There is no comment</h2>
            @else
                <h1>Comment</h1>
                <div class="col4 m-4">
                    @foreach($task->comments as $comment)
                        <div class="text-left">
                            <p class="m-4 text-left text-black"><span class="text-bold">{{$comment->user->email}}</span>. {{$comment->created_at}} <span class="m-4 text-small text-grey">{{$comment->created_at == $comment->updated_at ?  "" : "Updated at  ." . $comment->updated_at}}</span></p>
                        </div>
                        <div class="text-left">
                            <form class="m-4 d-inline" method="post" action="/comments/{{$comment->id}}">
                                @csrf
                                @method('put')
                                <input class="input_bar" name="content" value={{$comment->content}} {{Auth::user()->id == $comment->user->id ? null : "disabled"}}></input>
                            </form>
                            @if(Auth::user()->id == $comment->user->id)
                                <form class="d-inline" method="post" action="/comments/{{$comment->id}}">
                                    @csrf
                                    @method('delete')
                                    <button class="btn-red btn">Delete</button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
            <form method="post" action="/tasks/{{$task->id}}/comment">
                @csrf
                <input class="input_bar m-8" placeholder="Type here" name="content" type="text"></input>
                <button class="btn" type="submit">Create comment</button>
            </form>
        </div>
        <a class="btn" href="/workspace/board/{{$task->column->board->id}}">Back</a>
    </div>
@endsection
