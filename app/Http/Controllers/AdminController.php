<?php

namespace App\Http\Controllers;

use App\Models\Recipe;

class AdminController extends Controller
{
    public function edit($id)
    {
        $recipe = Recipe::findOrFail($id);
        return view('admin.edit', compact('recipe'));
    }

    public function create()
    {
        $recipes = Recipe::where('is_approved', 0)->with(['user', 'province'])->get();
        return view('admin.create', compact('recipes'));
    }

    public function index()
    {
        $recipes = Recipe::where('is_approved', 1)->with(['user', 'province'])->get();
        return view('admin.index', compact('recipes'));
    }

    public function approve($id)
    {
        Recipe::where('id', $id)->update(['is_approved' => true]);
        return redirect()->back()->with('success', 'Recipe approved!');
    }

    public function remove($id)
    {
        Recipe::destroy($id);
        return redirect()->back()->with('success', 'Recipe removed.');
    }

    public function update(\Illuminate\Http\Request $request, $id)
    {
        Recipe::where('id', $id)->update($request->except(['_token', '_method']));
        return redirect()->route('index.index')->with('success', 'Recipe updated successfully.');
    }
}
