<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ScoreController extends Controller
{
    public function index()
    {
        $scores = Score::orderBy('score', 'asc')->take(10)->get();
        return response()->json($scores);
    }

    public function showByGame($game_name)
    {

    $lowerIsBetterGames = ['Tebak Angka', 'Puzzle Geser', 'Minesweeper'];
    $orderDirection = in_array($game_name, $lowerIsBetterGames) ? 'asc' : 'desc';
    $scores = Score::where('game_name', $game_name)
                    ->orderBy('score', $orderDirection)
                    ->take(5) 
                    ->get();

    return response()->json($scores);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'player_name' => 'required|string|max:255',
            'game_name' => 'required|string|max:255',
            'score' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $score = Score::create($request->all());

        return response()->json([
            'message' => 'Skor berhasil disimpan!',
            'data' => $score
        ], 201);
    }
}
