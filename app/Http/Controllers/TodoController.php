<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{

    protected $rules = [
        "name" => "required|max:255"
    ];

    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        $todos = auth()->user()->todos()->latest()->get();
        return view("todos.index", compact("todos"));
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules);

        $data['user_id'] = auth()->id();
        $data['status'] = 0;

        $todo = Todo::create($data);

        if ($request->ajax()) {
            return response()->json(["todo" => $todo]);
        }

        return back()->withSuccess("Todo created successfully !");
    }

    public function edit(Todo $todo)
    {
        $this->authorize("modify", $todo);

        if (request()->ajax()) {
            return response()->json(["todo" => $todo]);
        }

        return view("todos.edit", compact("todo"));
    }

    public function update(Todo $todo)
    {
        $this->authorize("modify", $todo);

        $data = request()->validate($this->rules);

        $todo->update($data);

        if (request()->ajax()) {
            return response()->json(["todo" => $todo]);
        }

        return back()->withSuccess("Todo updated successfully !");
    }

    public function destroy(Todo $todo)
    {
        $this->authorize("modify", $todo);

        $todo->delete();

        if (request()->ajax()) {
            $count = auth()->user()->todos()->count();
            return response()->json(["count" => $count]);
        }

        return back()->withSuccess("Todo deleted successfully !");
    }

    public function markCompleted(Todo $todo)
    {
        $this->authorize("modify", $todo);

        $todo->status = 1;
        $todo->save();

        if (request()->ajax()) {
            return response()->json(["todo" => $todo]);
        }

        return back()->withSuccess("Todo status changed successfully !");;
    }

    public function markUncompleted(Todo $todo)
    {
        $this->authorize("modify", $todo);

        $todo->status = 0;
        $todo->save();

        if (request()->ajax()) {
            return response()->json(["todo" => $todo]);
        }

        return back()->withSuccess("Todo status changed successfully !");;
    }


}
