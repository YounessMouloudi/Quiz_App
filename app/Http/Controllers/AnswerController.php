<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Quiz;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function index()
    {
        $answers = Answer::paginate(8);
        
        return view('admin.answer.index',compact("answers"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $quizzes = Quiz::all();
        
        return view("admin.answer.add",compact("quizzes"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'answer' => "required|string",
            'question_id' => 'required|exists:quizzes,id',
            'is_correct' => 'required|boolean',
        ]);

        Answer::create($fields);

        return redirect()->route('answers.index')->with('message', 'answer created successfully');

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
        $answer = Answer::findOrFail($id);
        
        $quizzes = Quiz::all();

        return view("admin.answer.edit",compact("answer","quizzes"));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $fields = $request->validate([
            'answer' => "required|string",
            'question_id' => 'required|exists:quizzes,id',
            'is_correct' => 'required|boolean',
        ]);

        $answer = Answer::findOrFail($id);

        $answer->update($fields);

        return redirect()->route('answers.index')->with('message', 'answer updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $answer = Answer::findOrFail($id);

        $answer->delete();

        return redirect()->route('answers.index')->with('message', 'answer deleted successfully');

    }
}
