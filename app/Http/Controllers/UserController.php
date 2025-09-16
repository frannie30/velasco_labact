<?php

namespace App\Http\Controllers;

use App\Models\Provinces;
use App\Models\Recipe;
use Carbon\Carbon;
use Illuminate\Support\Str;
use \Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        $provinces = Provinces::all();
        return view('dashboard', compact('provinces'));
    }

    public function showProvince( $request)
    {
        $provinceName = $request->input('province') ?? session('province');
        if ($provinceName) {
            session(['province' => $provinceName]);
        }

        $provinces = Provinces::all();
        $province = Provinces::where('name', $provinceName)->first();

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
        $provinces = Provinces::all();
        return view('users.submitrecipe', compact('provinces'));
    }

    public function showRecipe(\Illuminate\Http\Request $request)
    {
        $province = $request->input('province');
        $dish = $request->input('dish');
        $provinceModel = Provinces::where('name', $province)->first();

        $recipe = $provinceModel
            ? Recipe::where('province_id', $provinceModel->id)
                ->where('name', $dish)
                ->where('is_approved', 1)
                ->first()
            : null;

        return view('users.recipe', compact('province', 'recipe'));
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $provinceName = Str::title($request->province);
        $province = Provinces::where('name', $provinceName)->first();
        $province_id = $province ? $province->id : null;

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