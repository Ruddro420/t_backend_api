<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\MatchModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{

    // Show all categories
    public function getCategory()
    {
        return response()->json(Category::all());
    }
    // Store new category
    public function storeCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePath = null;

        if ($request->hasFile('category_image')) {
            $imagePath = $request->file('category_image')->store('categories', 'public');
        }

        $category = Category::create([
            'name' => $request->category_name,
            'image' => $imagePath
        ]);

        return response()->json($category, 201);
    }
    // Update category
    public function updateCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'category_name' => 'required|string|max:255',
            'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('category_image')) {
            // Delete old image if exists
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }

            $imagePath = $request->file('category_image')->store('categories', 'public');
            $category->image = $imagePath;
        }

        $category->name = $request->category_name;
        $category->save();

        return response()->json($category);
    }
    // Delete category
    public function destroyCategory($id)
    {
        $category = Category::findOrFail($id);

        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return response()->json(['message' => 'Category deleted successfully']);
    }
    // match store
     public function storeMatch(Request $request)
    {
        $validated = $request->validate([
            'match_name'     => 'required|string|max:255',
            'category'       => 'required|string',
            'max_player'     => 'required|integer',
            'map_name'       => 'required|string',
            'version'        => 'required|string',
            'game_type'      => 'nullable|string',
            'game_mood'      => 'nullable|string',
            'time'           => 'required',
            'date'           => 'required|date',
            'win_price'      => 'required|numeric',
            'kill_price'     => 'required|numeric',
            'entry_fee'      => 'required|numeric',
            'second_prize'   => 'nullable|numeric',
            'third_prize'    => 'nullable|numeric',
            'fourth_prize'   => 'nullable|numeric',
            'fifth_prize'    => 'nullable|numeric',
            'total_prize'    => 'required|numeric',
        ]);

        $match = MatchModel::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Match created successfully',
            'data'    => $match,
        ]);
    }
}
