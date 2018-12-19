<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TodosController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Todo::paginate(10);

        return view('todos.index', ['items' => $items]);
    }

    /**
     * @param Todo $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $item)
    {
        return view('todos.edit', ['item' => $item]);
    }

    /**
     * @param Request $request
     * @param Todo $item
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Todo $item)
    {
        $this->validate($request, [
            'userId' => 'required',
            'title' => 'required',
            'completed' => 'required',
        ]);

        $item->update($request->all());

        Session::flash('success', 'Item updated successfully');

        return redirect()->route('todosEdit', ['id' => $item->id]);
    }

    /**
     * @param Todo $item
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete(Todo $item)
    {
        $item->delete();

        Session::flash('success', 'Item deleted successfully');

        return redirect()->route('todosIndex');
    }
}
