<!DOCTYPE html>
<html>
<head>
    <title>Show Question</title>
</head>
<body>
    <h1>Question Details</h1>
    <p>Question Text: {{ $question->question_text }}</p>
    <p>Options:</p>
        <ul>
            @foreach($question->options as $option)
                <li>{{ $option }}</li>
            @endforeach
        </ul>
    <p>Correct Option: {{ $question->correct_option }}</p>
</body>
</html>
