<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::all();
        
        return view('admin.quiz.index',compact("quizzes"));
    }

    public function quizForm()
    {
        $player = Auth::guard('player')->user();
        
        $sessionData = session()->get('sessionData');

        if ($player) {

            Score::where('player_id', $player->id)->delete();

        } else if ($sessionData) {

            $sessionData->score = 0;
            session()->put('sessionData', $sessionData);
        }
                        
        return view('quiz');

        // if(Auth::guard('player')->check() || session()->has('sessionData')) {
        // }
        // else {
        //     return redirect()->route('loginPage');
        // }
    }
    public function create()
    {
        return view('admin.quiz.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'question' => "required|string",
        ]);

        Quiz::create($fields);

        return redirect()->route('quizzes.index')->with('message', 'quiz created successfully');
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
        $quiz = Quiz::findOrFail($id);
                        
        return view("admin.quiz.edit",compact("quiz"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $fields = $request->validate([
            'question' => "required|string",
        ]);

        $quiz = Quiz::findOrFail($id);

        $quiz->update($fields);

        return redirect()->route('quizzes.index')->with('message', 'quiz updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $quiz = Quiz::findOrFail($id);

        $quiz->delete();

        return redirect()->route('quizzes.index')->with('message', 'quiz deleted successfully');
    }

    public function getQuestions() {
                
        $questions = Quiz::with('answers')->get()->map(function ($quiz) {
            return [
                'quest_id' => $quiz->id,
                'question' => $quiz->question,
                'reponses' => $quiz->answers->map(function ($answer) {
                    return [
                        'id' => $answer->id,
                        'texte' => $answer->answer,
                        'is_correct' => $answer->is_correct,
                    ];
                }),
            ];
        });

        // avec Arrow Function
        // $questions = Quiz::with('answers')->get()->map(fn ($quiz) => [
        //     'quest_id' => $quiz->id,
        //     'question' => $quiz->question,
        //     'reponses' => $quiz->answers->map(fn ($answer) => [
        //             'id' => $answer->id,
        //             'texte' => $answer->answer,
        //             'is_correct' => $answer->is_correct,
        //     ]),
        // ]);

        return response()->json([
            'questions' => $questions,
        ]);
    }
}
