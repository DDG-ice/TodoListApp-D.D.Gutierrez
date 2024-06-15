@extends('layout.app')
@section('title', isset($task) ? 'Edit Task' : 'Add Task')

@section('style')
    <style>
        .error-message{
            color: red;
            font-size: 3mm;
        }
    </style>
@endsection

@section('content')

<form method="POST" action="{{ isset($task) ? route('tasks.update',['task' => $task->id]) : route('tasks.store') }}">
    @csrf
    @isset($task)
        @method('PUT')
    @endisset
    <div>
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="{{$task->title ?? old('title')}}"/>
        @error('title')
            <p class="error-message">{{$message}}</p>
        @enderror
    </div>
    <div>
        <label for="description">Description</label>
        <textarea name="description" id="description" rows="5">{{$task->description ?? old('description')}}</textarea>
        @error('description')
            <p class="error-message">{{$message}}</p>
        @enderror
    </div>
    <div>
        <label for="long_desc">Long Description</label>
        <textarea name="long_desc" id="long_desc" rows="10">{{$task->long_desc ?? old('long_desc')}}</textarea>
        @error('long_desc')
            <p class="error-message">{{$message}}</p>
        @enderror
    </div>
    <div>
        <button type="submit">
            @isset($task)
                Update Task
            @else
                Add Task
            @endisset
        </button>
    </div>
</form>

@endsection