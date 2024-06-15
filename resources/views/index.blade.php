@extends('layout.app')

@section('title', 'List of tasks')

@section('content')

    <div>
        <a href="{{route('tasks.create')}}" class="font-medium text-gray-700 underline decoration-green-500">Add New Task</a>
    </div>
    
    @forelse($tasks as $task)
        <div>
            <a href="{{route('tasks.show', ['task' => $task->id])}}" 
            @class(['line-through font-bold text-green-600' => true])>{{$task->title}}</a>
        </div>

    @empty
        <div>
            No Task!
        </div>
    @endforelse

    @if($tasks->count())
    <nav>
        {{$tasks->links()}}
    </nav>
    @endif

@endsection