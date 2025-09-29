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
        $search = $request->input('search');
        $regions = \App\Models\Province::select('region')->distinct()->pluck('region');
        $provinces = \App\Models\Province::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })->paginate(8);

        return view('dashboard', [
            'provinces' => $provinces,
            'regions' => $regions,
            'selectedRegion' => null,
            'search' => $search,
        ]);
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
        $recipe = $request->input('recipe');
        $provinceModel = Province::where('name', $province)->first();

        $recipe = $provinceModel
            ? Recipe::where('province_id', $provinceModel->id)
                ->where('name', $recipe)
                ->first()
            : null;

        return view('users.recipe', compact('province', 'recipe'));
    }


    public function store(Request $request)
    {
        $provinceName = Str::title($request->province);
        $province = Province::where('name', $provinceName)->first();

        if (!$province) {
            return back()
                ->withInput()
                ->withErrors(['province' => 'Choose an existing province.']);
        }

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
            'province_id' => $province->id,
            'name' => $request->name,
            'description' => $request->description,
            'ingredients' => $request->ingredients,
            'recipe' => $request->recipe,
            'user_id' => auth()->user()->id,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Recipe created successfully. Awaiting admin approval.');
    }

    public function filterProvincesByRegion(Request $request)
    {
        $region = $request->input('region');
        $regions = Province::select('region')->distinct()->pluck('region');

        if ($region && $region !== 'all') {
            $provinces = Province::where('region', $region)->paginate(8);
        } else {
            $provinces = Province::paginate(8);
        }

        return view('dashboard', [
            'provinces' => $provinces,
            'regions' => $regions,
            'selectedRegion' => $region,
            'search' => null,
        ]);
    }
}