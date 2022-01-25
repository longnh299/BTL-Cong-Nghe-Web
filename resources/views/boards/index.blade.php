@extends('layouts.app')

@section('content')
    <div class="container my-8">
        @if(!count($boards))
            <p>You don't have any board</p>
        @else
            <h1>My board</h1>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Owner</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                </tr>
                <tbody>
                @foreach ($boards as $item)
                    <tr>
                        <td>
                            <a href="/boards/{{$item->id}}" class="text-black">
                                {{$item->name}}
                            </a>
                        </td>
                        <td>{{$item->user->email}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>{{$item->updated_at}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
    <div class="container">
        <form action={{route('board.create')}} method="post">
            @csrf
            <div class="m-4"><input class="input_bar" name="name" type="text" placeholder="Board name"></input></div>
            <div class="m-4"><button class="btn" type="submit">Create new board</button></div>
        </form>

        @if($errors->any())
            @foreach($errors->all() as $error)
            <p class="text-red">{{$error}}</p>
            @endforeach
        @endif
    </div>
@endsection
