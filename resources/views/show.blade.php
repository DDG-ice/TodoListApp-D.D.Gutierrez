@extends('layout.app')

@section('title', $task->title)

@section('content')
    <p>{{$task->description}}</p>

    @if($task->long_desc)
        <p>{{$task->long_desc}}</p>
    @endif

    <p>Created {{$task->created_at->diffForHumans()}} * Updated {{$task->updated_at->diffForHumans()}}</p>

    @if ($task->completed)
        <span>
            COMPLETED
        </span>
    @else
        <span>
            Not Completed
        </span>
    @endif

    <div>
        <a href="{{(route('tasks.edit', ['task' => $task]))}}">Edit</a>
    </div>

    <form method="POST" action="{{route('tasks.toggle-complete', ['task' => $task])}}">
        @csrf
        @method('PUT')
        <button type="submit">
            Marks as {{$task->completed ? 'Not Completed' : 'Completed'}}
        </button>
    </form>

    <div>
        <form action="{{route('tasks.destroy',['task' => $task])}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </div>

@endsection