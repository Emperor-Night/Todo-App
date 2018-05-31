<?php

Auth::routes();

Route::get('/', "TodoController@index");

Route::patch('/todos/{todo}/markCompleted', "TodoController@markCompleted")->name("todo.markCompleted");
Route::patch('/todos/{todo}/markUncompleted', "TodoController@markUncompleted")->name("todo.markUncompleted");

Route::resource("todos","TodoController");

