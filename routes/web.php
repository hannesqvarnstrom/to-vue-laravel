<?php

use App\Models\Todo;
use App\Models\TodoList;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    $todo = Todo::find(1);
    echo (" Before changes: in list \n $todo->todo_list \n, at place $todo->order");
    $todo->move_in_list(TodoList::find(1), 5);
    echo ("After changes: in list" . "\n" . $todo->todo_list . "\n at place $todo->order");
    echo ('List is now ordered like this:' . "\n" . $todo->todo_list->todos()->orderBy('order')->get());
});
