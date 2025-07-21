<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Deposite;
use App\Models\MatchModel;
use App\Models\RoomModel;
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
            'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rules' => 'required|string'
        ]);

        if ($request->hasFile('category_image')) {
            $file = $request->file('category_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('categories'), $filename);
            $imagePath = 'categories/' . $filename;
        }


        $category = Category::create([
            'name' => $request->category_name,
            'image' => $imagePath,
            'rules' => $request->rules,
        ]);

        return response()->json($category, 201);
    }
    // Update category
    public function updateCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'category_name' => 'required|string|max:255',
            'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rules' => 'nullable|string'
        ]);

        $category->name = $request->category_name;
        $category->rules = $request->rules;

        if ($request->hasFile('category_image')) {
            // Optionally delete old image
            if ($category->image && file_exists(public_path($category->image))) {
                unlink(public_path($category->image));
            }

            $file = $request->file('category_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('categories'), $filename);
            $imagePath = 'categories/' . $filename;
            // Save new image path
            $category->image = $imagePath;
        }

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
        do {
            $matchId = rand(100, 999); // Generates 3-digit number between 100–999
        } while (MatchModel::where('match_id', $matchId)->exists());

        $validated = $request->validate([
            'match_name'     => 'required|string|max:255',
            'category_id'    => 'required|string',
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
        $validated['match_id'] = $matchId;

        $match = MatchModel::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Match created successfully',
            'data'    => $match,
        ]);
    }
    // Get all matches
    public function getMatches()
    {
        $matches = MatchModel::with('category')->get();
        return response()->json($matches);
    }
    // get match by id
    public function getMatchById($id)
    {
        $match = MatchModel::with('category')->findOrFail($id);
        return response()->json($match);
    }
    // Update match
    public function updateMatch(Request $request, $id)
    {
        $match = MatchModel::findOrFail($id);
        $validated = $request->validate([
            'match_name'     => 'required|string|max:255',
            'category_id'    => 'required',
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
        $match->update($validated);
        return response()->json([
            'success' => true,
            'message' => 'Match updated successfully',
            'data'    => $match,
        ]);
    }
    // Delete match
    public function destroyMatch($id)
    {
        $match = MatchModel::findOrFail($id);
        $match->delete();
        return response()->json(['message' => 'Match deleted successfully']);
    }
    // Get all rooms
    public function getRooms()
    {
        $rooms = RoomModel::with('match')->get();
        return response()->json($rooms);
    }
    // Store new room
    public function storeRoom(Request $request)
    {
        $request->validate([
            'match_id' => 'required|exists:match_models,id',
            'room_id' => 'required|string',
            'room_password' => 'required|string',
        ]);

        $room = RoomModel::create([
            'match_id' => $request->match_id,
            'room_id' => $request->room_id,
            'room_password' => $request->room_password,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Room details saved successfully',
            'data' => $room
        ]);
    }
    // Update room
    public function updateRoom(Request $request, $id)
    {
        $room = RoomModel::findOrFail($id);
        $request->validate([
            'match_id' => 'required|exists:match_models,id',
            'room_id' => 'required|string',
            'room_password' => 'required|string',
        ]);
        $room->update([
            'match_id' => $request->match_id,
            'room_id' => $request->room_id,
            'room_password' => $request->room_password,
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Room updated successfully',
            'data' => $room
        ]);
    }
    // Delete room
    public function destroyRoom($id)
    {
        $room = RoomModel::findOrFail($id);
        $room->delete();
        return response()->json(['message' => 'Room deleted successfully']);
    }
    // store deposite
    public function storeDeposite(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'payment_method' => 'required|string|max:255',
            'payment_phone_number' => 'required|string|max:20',
            'transaction_id' => 'required|string|max:255|unique:deposites,transaction_id',
            'amount' => 'required|string|min:0',
        ]);

        $payment = Deposite::create($request->all());

        return response()->json([
            'message' => 'Payment recorded successfully',
            'payment' => $payment,
        ], 201);
    }
    // get all deposites
    public function getDeposit()
    {
        $deposits = Deposite::all();
        return response()->json($deposits);
    }
    // update deposite
    public function updateDeposite(Request $request, $id, $status)
    {
        $deposite = Deposite::findOrFail($id);

        $request->validate([
            'status' => 'required|max:50',
        ]);

        $deposite->update($request->all());

        return response()->json([
            'message' => 'Deposite updated successfully',
            'deposite' => $deposite,
        ]);
    }
    // need deposite amount sum by same user_id where status is 1
    public function getDepositByUserId($userId)
    {
        $deposits = Deposite::where('user_id', $userId)->where('status', 1)->get();
        $totalAmount = $deposits->sum('amount');

        return response()->json([
            'user_id' => $userId,
            'total_deposit' => $totalAmount,
            'deposits' => $deposits
        ]);
    }
}
