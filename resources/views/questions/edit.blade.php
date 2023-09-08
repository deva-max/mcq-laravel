@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Multiple Choice Question</h1>

    <form method="POST" action="{{ route('questions.update', $question->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="question_text">Question Text</label>
            <input type="text" name="question_text" class="form-control" value="{{ $question->question_text }}" required>
        </div>

        <!-- Display existing options -->
        @foreach ($options as $index => $option)
        <div class="form-group">
            <label for="options[{{ $index }}]">Option {{ $index + 1 }}</label>
            <input type="text" name="options[]" class="form-control" value="{{ $option }}" required>
        </div>
        @endforeach

        <div id="additional-options">
            <!-- Display newly added options -->
            @foreach ($newOptions as $index => $newOption)
            <div class="form-group option-template">
                <label for="new_options[{{ $index }}]">New Option {{ $index + 1 }}</label>
                <div class="input-group">
                    <input type="text" name="new_options[]" class="form-control" value="{{ $newOption }}">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-danger delete-option">Delete</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <button type="button" class="btn btn-success" id="add-option">Add Option</button>
        <button type="submit" class="btn btn-primary">Update Question</button>
    </form>
</div>

<script>
            document.addEventListener('DOMContentLoaded', function () {
        const addOptionButton = document.getElementById('add-option');
        const additionalOptions = document.getElementById('additional-options');
        const optionTemplate = document.querySelector('.option-template');

        // Hide the option template initially
        optionTemplate.style.display = 'none';

        let optionCounter = {{ count($newOptions) }}; // Set the initial option count

        // Use a Set to store unique values
        const mergedOptions = new Set();

        // Add existing options to the mergedOptions Set
        @foreach ($options as $option)
        mergedOptions.add('{{ $option }}');
        @endforeach

        addOptionButton.addEventListener('click', function () {
            optionCounter++; // Increment the option counter

            // Clone the option template
            const newOption = optionTemplate.cloneNode(true);
            newOption.style.display = 'block'; // Make the cloned element visible

            // Update input field names and IDs to make them unique
            newOption.querySelectorAll('input').forEach(function (input) {
                const newName = `new_options[${optionCounter}]`;
                const newId = `new_options_${optionCounter}`;
                input.name = newName;
                input.id = newId;
                input.value = ''; 

                
                input.removeAttribute('required');

                
                input.addEventListener('blur', function () {
                    input.setAttribute('required', 'required');
                });
            });

            additionalOptions.appendChild(newOption);
        });

        additionalOptions.addEventListener('click', function (event) {
            if (event.target.classList.contains('delete-option')) {
                event.target.closest('.option-template').remove();
            }
        });

        // Convert Set to Array and then to JSON
        const mergedOptionsArray = Array.from(mergedOptions);
        const mergedOptionsJSON = JSON.stringify(mergedOptionsArray);

        // Set the merged options as a hidden input value
        const mergedOptionsInput = document.createElement('input');
        mergedOptionsInput.type = 'hidden';
        mergedOptionsInput.name = 'options';
        mergedOptionsInput.value = mergedOptionsJSON;
        document.querySelector('form').appendChild(mergedOptionsInput);
    });


</script>


@endsection
