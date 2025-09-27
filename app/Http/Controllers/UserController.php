<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\Recipe;
use Carbon\Carbon;
use Illuminate\Support\Str;
use \Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard(Request $request)
    {
        $search = $request->get('search');
        
        if ($search) {
            $provinces = Province::where('name', 'LIKE', '%' . $search . '%')->get();
        } else {
            $provinces = Province::all();
        }
        
        return view('dashboard', compact('provinces', 'search'));
    }

    public function showProvince(Request $request)
    {
        $provinceName = $request->input('province') ?? session('province');
        if ($provinceName) {
            session(['province' => $provinceName]);
        }

        $provinces = Province::all();
        $province = Province::where('name', $provinceName)->first();

        $recipes = $province
            ? $province->recipes()->where('is_approved', 1)->get()
            : collect();

        return view('users.province', [
            'province' => $provinceName,
            'provinces' => $provinces,
            'recipes' => $recipes,
        ]);
    }

    public function submitRecipe()
    {
        $provinces = Province::all();
        return view('users.submitrecipe', compact('provinces'));
    }

    public function showRecipe(Request $request)
    {
        $province = $request->input('province');
        $dish = $request->input('dish');
        $provinceModel = Province::where('name', $province)->first();

        $recipe = $provinceModel
            ? Recipe::where('province_id', $provinceModel->id)
                ->where('name', $dish)
                ->where('is_approved', 1)
                ->first()
            : null;

        return view('users.recipe', compact('province', 'recipe'));
    }


    public function store(Request $request)
    {
        $provinceName = Str::title($request->province);
        $province = Province::where('name', $provinceName)->first();
        $province_id = $province ? $province->id : null;

         $validated = $request->validate([
            'province_id' => 'nullable|exists:provinces,id',
            'province' => 'required',
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:255',
            'ingredients'   => 'required|array|min:1|max:50',
            'ingredients.*' => 'required|string|max:100',
            'recipe'   => 'required|array|min:1|max:100',
            'recipe.*' => 'required|string|max:255',
         ]);

        Recipe::create([
            'province_id' => $province_id,
            'name' => $request->name,
            'description' => $request->description,
            'ingredients' => $request->ingredients,
            'recipe' => $request->recipe,
            'user_id' => auth()->user()->id,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Recipe created successfully.');
    }

    
}