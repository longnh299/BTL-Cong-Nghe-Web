@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Board owner</h1>
        <table>
            <tr>
                <th>User name</th>
                <th>User email</th>
            </tr>
            <tbody>
                <td>{{$owner->name}}</td>
                <td>{{$owner->email}}</td>
            </tbody>
        </table>
        @if(!count($members))
            <h2>This board has no member</h2>
        @else
        <h1>Board members</h1>
            <table>
                <tr>
                    <th>User name</th>
                    <th>User email</th>
                </tr>
                <tbody>
                    @foreach($members as $item)
                    <tr>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        @if($owner->id == $user->id)
                        <td>
                            <form method="post" action="/boards/{{$board->id}}/kick/{{$item->id}}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-red">Kick</button>
                            </form>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        <form method="post" action="{{URL::current()}}" class="m-8">
            @csrf
            <input class="input_bar m-8" placeholder="Email" name="email" type="email"></input>
            <div><button class="btn">Invite</button></div>
        </form>
        <a class="btn" href="/workspace/board/{{$board->id}}">Back</a>
         @if($errors->any())
            @foreach($errors->all() as $item)
            <p class="text-red m-8">{{$item}}</p>
            @endforeach
        @endif
    </div>
@endsection
