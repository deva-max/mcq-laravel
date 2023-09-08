@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Multiple Choice Questions</h1>
    
    <a href="{{ route('questions.create') }}" class="btn btn-success">Create New Question</a>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Question Text</th>
                <th>Options</th>
                <th>Correct Option</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($questions as $question)
                <tr>
                    <td>{{ $question->id }}</td>
                    <td>{{ $question->question_text }}</td>
                    <td>
                        A. {{ $question->option_a }}<br>
                        B. {{ $question->option_b }}<br>
                        C. {{ $question->option_c }}<br>
                        D. {{ $question->option_d }}
                    </td>
                    <td>{{ $question->correct_option }}</td>
                    <td>
                        <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-primary">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
