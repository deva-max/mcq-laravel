<?php
// app/Models/Question.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';

    protected $casts = [
        'options' => 'array'
    ];

    public static function createQuestion($questionText, $options, $correctOption)
    {
        try {
            return self::create([
                'question_text' => $questionText,
                'options' => $options, // Store the array directly
                'correct_option' => $correctOption,
            ]);
        } catch (\Exception $e) {
            // Handle the exception or return an error response to the user
            // For debugging purposes, you can return null
            return null;
        }
    }
}
