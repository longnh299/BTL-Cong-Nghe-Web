@extends('layouts.app')

@section('content')
<div id="main">
    <div id="board-list">
        <div id="board-list-head">
            <svg id="head-color-square">
                <rect x="0" y="0" width="100%" height="100%"/>
            </svg>
            <h1>Workspace</h1>
        </div>
        <hr />
        <div id="board-list-body">
            <!-- Phần là list các board -->
            <div id="new-board">
                <h2>New board</h2>
                <a id="plus-button" href={{route('boards')}}><img class="img-button" src="{{asset('images/plus.svg')}}"></a>
            </div>
            @foreach ($board_own as $item_own)
                <div class="board-items">
                    <svg class="color-square">
                        <rect x="0" y="0" width="100%" height="100%"/>
                    </svg>
                    <a href="/workspace/board/{{$item_own->id}}" class="{{Request::path() == 'workspace/board/' . $item_own->id ? 'active': 'text-black'}}"><h3>{{$item_own->name}}</h3></a>
                    <a id="more-board-button" href="/boards/{{$item_own->id}}"><img src="{{asset('images/three-dots.svg')}}"></a>
                </div>
            @endforeach
            @foreach ($board_join as $item_join)
                <div class="board-items">
                    <svg class="color-square">
                        <rect x="0" y="0" width="100%" height="100%"/>
                    </svg>
                    <a href="/workspace/board/{{$item_join->id}}" class="{{Request::path() == 'workspace/board/' . $item_join->id ? 'active': 'text-black'}}"><h3>{{$item_join->name}}</h3></a>
                    <a id="more-board-button" href="/boards/{{$item_join->id}}"><img src="{{asset('images/three-dots.svg')}}"></a>
                </div>
            @endforeach
        </div>
    </div>
    <div id="workspace">
        <div id="workspace-head">
            <a class="link-button" href="/boards/{{$board->id}}">{{$board->name}}</a>
            <a class="link-button" href="/boards/{{$board->id}}/invite">Invite</a>
        </div>
        <div id="workspace-body">
            <!-- Phần này là các task -->
            @foreach($board->columns as $column)
                <div class="task-box">
                    <div class="task-box-head">
                        <h2 class="work-name">{{$column->name}}</h2>
                        <a class="task-button" href="/columns/{{$column->id}}"><img src="{{asset('images/three-dots.svg')}}"></a>
                    </div>
                    @foreach($column->tasks as $task)
                        <div class="task">
                            <div class="task-head">
                            <a href="/tasks/{{$task->id}}" class="text-black">
                                <p>{{$task->name}}</p>
                            </a>
                                <div class="ms-auto">
                                    <img class="user-avatar" src="{{asset('images/user-avatar.png')}}">
                                    <span class="my-auto h-10">{{count($task->usersTasks)}}</span>
                                </div>
                            </div>
                            <div class="task-body">
                                <a id="comment-button" href="#"><img class="img-button" src="{{asset('images/comment.png')}}"></a>
                                <p id="number-of-comment">{{count($task->comments)}}</p>
                                {{-- <a id="attach-button"  href="#"><img class="img-button" src="{{asset('images/clipper.png')}}"></a>
                                <p id="number-of-attachment">0</p> --}}
                                <p class="task-date {{$task->is_done == "0" ? ($task->is_late() ? 'bg-red' : ($task->is_near_due_date() ? 'bg-yellow': null) ): 'bg-green'}}">{{$task->due_date}}</p>
                            </div>
                        </div>

                    @endforeach
                    <div class="task-box-footer">
                        <a id="more-task-button" href="/columns/{{$column->id}}/tasks"><img class="img-button" src="{{asset('images/plus.svg')}}"><span>Add a task</span></a>
                    </div>
                </div>
            @endforeach
            <a id="add-work-button" class="link-button" href="/boards/{{$board->id}}/columns">Add column</a>
        </div>
    </div>

</div>
@endsection
