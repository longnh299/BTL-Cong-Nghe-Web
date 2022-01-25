@extends('layouts.app')

@section('content')
    <div class="container">
        @if(!count($board->columns))
            <h2>This board has no column</h2>
        @else
            <div class="m-8">
                <table>
                    <tr>
                        <th>Column name</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                    </tr>
                    <tbody>
                        @foreach($board->columns as $column)
                        <tr>
                            <td><a class="task-button text-black" href="/columns/{{$column->id}}">{{$column->name}}</a></td>
                            <td>{{$column->created_at}}</td>
                            <td>{{$column->updated_at}}</td>
                            <td>
                            <form method="post" action="/columns/{{$column->id}}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-red">Delete</button>
                            </form>
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                <table>
            </div>
        @endif
        <div class="m-8">
            <form action="/boards/{{$board->id}}/columns" method="post" class="m-8">
                @csrf
                <input class="input_bar m-8" placeholder="Column name" name="name" type="text"></input>
                <div><button class="btn">Add column</button></div>
            </form>
            @if($errors->any())
                @foreach($errors->all() as $item)
                <p class="text-red">{{$item}}</p>
                @endforeach
            @endif
        </div>
        <a class="btn m-8" href="/workspace/board/{{$board->id}}">Back</a>
    </div>
@endsection
