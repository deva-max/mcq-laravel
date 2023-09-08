<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use Countable;
use Illuminate\Contracts\Session\Session;

class QuestionController extends Controller
{
    public function create()
    {
        return view('questions.create');
    }

    public function errors()
    {
        return view('questions.errors');
    }

    public function store(Request $request)
    {
        $questions = new Question();

        $questions->question_text = request('question_text');
        $questions->options = request('options');
        $questions->correct_option = request('correct_option');

        $questions->save();

        return redirect()->route('questions.show', ['question' => $questions->id])
        ->with('success', 'Question created successfully.');
    }
    
    public function edit($id)
    {
        $question = Question::findOrFail($id);
        $options = [];

        if (is_string($question->options)) {
            $options = json_decode($question->options, true);
        } elseif (is_array($question->options)) {
            $options = $question->options;
        }

        $newOptions = [1]; 

        return view('questions.edit', compact('question', 'options', 'newOptions'));
    }

    
    public function update(Request $request, $id)
    {
    
        $question = Question::findOrFail($id);
    
        $question->question_text = $request->input('question_text');
    
        
        $additionalOptions = $request->input('new_options', []);
    
      
        $additionalOptions = is_array($additionalOptions) ? $additionalOptions : [];
    
       
        $existingOptions = is_array($question->options) ? $question->options : [];
    
       
        $mergedOptions = array_values(array_unique(array_merge($existingOptions, $additionalOptions)));
    
        
        $question->options = $mergedOptions;
    
        $question->save();
    
        return redirect()->route('questions.index')
            ->with('success', 'Question updated successfully.');
    }
        
                        
    
    public function show(Question $question)
    {
        return view('questions.show', compact('question'));
    }

    public function index()
    {
        $questions = Question::all(); 
        return view('questions.index', compact('questions'));
    }

}
