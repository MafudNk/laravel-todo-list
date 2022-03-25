<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class todoController extends Controller
{
    public function index()
    {
        $data['tods'] = Todo::orderBy('id', 'desc')->paginate(5);
        return view('todo.index', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todo.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);
        $todo = new Todo();
        $todo->title = $request->title;
        $todo->detail = $request->detail;
        $todo->status = 'Waiting';
        $todo->save();
        return redirect()->route('todos.index')
            ->with('success', 'Todo has been created successfully.');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        return view('todo.edit', compact('todo'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
        ]);
        $todo = Todo::find($id);
        $todo->title = $request->title;
        $todo->detail = $request->detail;
        $todo->save();
        return redirect()->route('todos.index')
            ->with('success', 'Todo Has Been updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->route('todos.index')
            ->with('success', 'Todo has been deleted successfully');
    }
    public function proses($id)
    {
        $todo = Todo::find($id);
        $todo->status = 'On Process';
        $todo->save();
        return redirect()->route('todos.index');
    }
    public function done($id)
    {
        $todo = Todo::find($id);
        $todo->status = 'Done';
        $todo->save();
        return redirect()->route('todos.index');
    }
}
