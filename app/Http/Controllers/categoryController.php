<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\book;
use App\Models\category_book;
use App\Models\mock;
use App\Models\mock_category;
use App\Models\question;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = category::where('delete', 0)->get();
        return view('admin.Category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.Category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'name_auth' => 'required',
        ]);
        $category  = new category();
        $category->name = $request->name;
        $category->name_auth = $request->name_auth;
        $category->save();
        return redirect()->route('category.index')->with('success', true);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category  =  category::find($id);
        $category->name = $request->name;
        $category->update();
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function softDelete(string $id)
    {
        $category = category::find($id);
        $category->delete = 1;
        $category->update();
        $question = question::where('category_id', $id);
        $question->update(['delete' => 1]);
        $category_book = category_book::where('category_id', $id);
        $category_book->update(['delete' => 1]);
        $category_mock = mock_category::where('category_id', $id);
        $category_mock->update(['delete' => 1]);
        return redirect()->route('category.index');
    }
    public function destroy(string $id)
    {
        category::find($id)->delete();
        return redirect()->route('category.index');
    }
}
