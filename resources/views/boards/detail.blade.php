@extends('layouts.app')

@section('content')
    <div class="container my-8">
    @if(empty($board))
        <p>Board not found</p>
    @else
    <div class="container w-75">
        <div>
            <h1>Board properties</h1>
           <table>
                <tr>
                    <th>Name</th>
                    <th>Onwer</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                </tr>
                <tbody>
                    <tr>
                        <td><a href="/workspace/board/{{$board->id}}" class="text-black">{{$board->name}}</a></td>
                        <td>{{$board->user->email}}</td>
                        <td>{{$board->created_at}}</td>
                        <td>{{$board->updated_at}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div>
            <form method="post" action="/boards/{{$board->id}}">
                @csrf
                @method('put')
                <input class="input_bar m-8" placeholder="Change board name" name="name" type="text"></input>
                <button class="btn" type="submit">Change name</button>
            </form>
            <form method="post" action="/boards/{{$board->id}}" >
                @csrf
                @method('delete')
                <button class="btn btn-red" type="submit">Delete board</button>
            </form>
        <div>
        <hr />
         <div class="m-8">
            @if(!count($board->usersBoards))
                <h2>This board has no member</h2>
            @else
                <h1>Board members</h1>
                <table>
                    <tr>
                        <th>User name</th>
                        <th>User email</th>
                        <th>Join at</th>
                    </tr>
                    <tbody>
                        @foreach($board->usersBoards as $item)
                            <tr>
                                <td>{{$item->user->name}}</td>
                                <td>{{$item->user->email}}</td>
                                <td>{{$item->created_at}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <a href="/boards/{{$board->id}}/invite"class="btn mx-4">Invite</a>
    </div>
        @if($errors->any())
            @foreach($errors->all() as $item)
            <p class="text-red">{{$item}}</p>
            @endforeach
        @endif
    @endif
    </div>
@endsection
