<?php

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return redirect()->route('tasks.index');
});

// Route::get('/', function () {
//     return view('index',[
//         'name' => 'Juan'
//     ]);
// });

Route:: delete('tasks/{task}', function (Task $task){
    $task->delete();
    return redirect()->route('tasks.index')->with('success', 'Deleted successfully!');
})->name('tasks.destroy');

Route::post('tasks', function(Task $task, TaskRequest $request){

    $data = $request->validated();

    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_desc = $data['long_desc'];
    $task->save();

    return redirect()->route('tasks.show',['id' => $task->id])->with('success', 'Created successfully!');

})->name('tasks.store');

Route::put('tasks/{task}', function(Task $task, TaskRequest $request){

    $data = $request->validated();

    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_desc = $data['long_desc'];
    $task->save();

    return redirect()->route('tasks.show',['task' => $task->id])->with('success', 'Updated successfully!');

})->name('tasks.update');

Route::view('/tasks/create', 'create')->name('tasks.create');

Route::get('/tasks', function () {
    return view('index', [
        'tasks' => Task::latest()->paginate(10)
    ]);
})->name('tasks.index');

Route::get('/tasks/{task}', function (Task $task) {
    return view('show',[
        'task' => $task
    ]);
})->name('tasks.show'); 

Route::get('/tasks/{task}/edit', function (Task $task) {
    return view('edit',[
        'task' => $task
    ]);
})->name('tasks.edit');

Route::put('tasks/{task}/toggle-complete', function (Task $task){
    $task->toggleComplete();
    return redirect()->back()->with('success', 'Task Completed!');
})->name('tasks.toggle-complete');

Route::fallback(function(){
    return 'No existing page';
});