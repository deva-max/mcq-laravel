@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Multiple Choice Question</h1>

    <form method="POST" action="{{ route('questions.store') }}">
    @csrf
    <div class="form-group">
        <label for="question_text">Question Text</label>
        <input type="text" name="question_text" class="form-control" required>
    </div>
    
    <div class="form-group">
        <label for="options">Options</label>
        <input type="text" name="options[]" class="form-control" required>
        <input type="text" name="options[]" class="form-control" required>
        <!-- Add more options fields as needed -->
    </div>

    <div class="form-group">
        <label for="correct_option">Correct Option</label>
        <input type="text" name="correct_option" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Create Question</button>
</form>

</div>
@endsection
