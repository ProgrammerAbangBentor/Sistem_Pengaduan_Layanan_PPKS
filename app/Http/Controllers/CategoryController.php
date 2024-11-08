<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('pages.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('pages.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
            'description' => 'nullable',
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }



    public function edit(Category $category)
    {
        return view('pages.categories.edit', compact('category'));
    }

     // Memperbarui kategori
     public function update(Request $request, Category $category)
     {
         $request->validate([
             'name' => 'required|max:255|unique:categories,name,' . $category->id,
             'description' => 'nullable',
         ]);

         $category->update($request->all());

         return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
     }


    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
