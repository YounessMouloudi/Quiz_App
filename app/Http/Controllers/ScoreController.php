<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScoreController extends Controller
{
    public function index()
    {
        $sessionData = session()->get('sessionData');

        $player = Auth::guard('player')->user();

        if ($player) {
            $score = Score::where("player_id",$player->id)->first();
        }
        else if($sessionData) {

            $score = $sessionData->score;
        }

        $topPlayers = Score::with('player')->orderBy('score', 'desc')->take(5)->get();
        

        if ($sessionData && $score > 0) {
                
            $topPlayers->push((object) [
                'id' => $sessionData->sessionId,
                'name' => $sessionData->name,
                'image' => $sessionData->image,
                'score' => $score,
            ]);    
        }

        $topPlayers = $topPlayers->sortByDesc('score')->take(5);
        // dd($topPlayers);
        
        return view('score',[
            "score" => $score,
            "topPlayers" => $topPlayers,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'score' => 'required|integer',
        ]);

        $sessionData = $request->session()->get('sessionData');
        
        if(Auth::guard('player')->check()) {

            $player = Auth::guard('player')->user();
        
            Score::create([
                'player_id' => $player->id,
                'score' => $validated['score'],
            ]);
        }
        else if($sessionData) {
            $sessionData->score = $validated['score'];
            $request->session()->put('sessionData', $sessionData);
        }
    
        return response()->json(['message' => 'Score enregistré avec succès'], 200);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        $player = Auth::guard('player')->user();

        $sessionData = session()->get('sessionData');

        if ($player) {

            Score::where('player_id', $player->id)->delete();

        } else if ($sessionData) {

            $sessionData->score = 0;
            session()->put('sessionData', $sessionData);
        }

        return redirect()->route('quiz');
    }

    public function showReponse() {

        $sessionData = session()->get('sessionData');

        $player = Auth::guard('player')->user();

        $totalQuestions = Quiz::count();

        if($player || $sessionData) {

            $score = $player ? Score::where("player_id",$player->id)->first() : $sessionData->score;
        }

        return view('reponse',[
            "score" => $score,
            "totalQuestions" => $totalQuestions
        ]);

    }

}
