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
        $recipes = Recipe::where('is_approved', 0)->with(['user', 'province'])->paginate(5);
        return view('admin.create', compact('recipes'));
    }

    public function index()
    {
        $recipes = Recipe::where('is_approved', 1)->with(['user', 'province'])->paginate(5);
        return view('admin.index', compact('recipes'));
    }

    public function archives()
    {
        $recipes = Recipe::onlyTrashed()->with(['user', 'province'])->paginate(5);
        return view('admin.archives', compact('recipes'));
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

    public function restore($id)
{
    $recipe = Recipe::withTrashed()->findOrFail($id);
    $recipe->restore();

    return redirect()->route('index.index')
                     ->with('success', 'Recipe restored successfully!');
}

public function delete($id) {
    $recipe = Recipe::withTrashed()->findOrFail($id);
    $recipe->forceDelete();

    return redirect()->route('archives.index')
                     ->with('success', 'Recipe permanently deleted.');
}

    public function update(\Illuminate\Http\Request $request, $id)
    {
        Recipe::where('id', $id)->update($request->except(['_token', '_method']));
        return redirect()->route('index.index')->with('success', 'Recipe updated successfully.');
    }
}
