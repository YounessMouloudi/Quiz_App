@extends('admin.app')

@section('title','Edit Answer')

@section('content')

<div class="container py-5">
    <div class="col-md-8 offset-md-2">
        @if (session('info'))
            <div class="alert alert-warning mb-3">
                {{ session('info') }}
            </div>
        @endif
        <div class="row mb-2">
            <a href="{{ route('answers.index') }}" class="text-decoration-none text-white fw-medium"><span class="fw-bold">&lt;</span> Retour</a>
        </div>
        <div class="card">
            <div class="card-header">Edit Answer : </div>
            <div class="card-body">
                <form id="answerForm" class="mt-2" action="{{ route('answers.update',$answer->id)}}" method="POST">
                    @csrf
                    @method("PUT")
                    <div class="mb-3">
                        <label for="answer" class="form-label">Answer</label>
                        <input type="text" class="form-control @error('answer') is-invalid @enderror" id="answer" name="answer" value="{{old('answer',$answer->answer)}}">
                        @error('answer')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="question_id" class="form-label">Question</label>
                        <select class="form-select @error('question_id') is-invalid @enderror" name="question_id">
                            <option selected>Select Question</option>
                            @foreach ($quizzes as $quiz)
                                <option value="{{$quiz->id}}" {{old('question_id', $answer->question_id) == $quiz->id ? "selected" : ""}}>{{$quiz->question}}</option>
                            @endforeach
                        </select>                        
                        @error('question_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="is_correct" class="form-label">Correct</label>
                        <select class="form-select @error('is_correct') is-invalid @enderror" name="is_correct">
                            <option>Select</option>
                            <option value="1" {{old('is_correct', $answer->is_correct) == 1 ? "selected" : ""}}>True</option>
                            <option value="0" {{old('is_correct', $answer->is_correct) == 0 ? "selected" : ""}}>False</option>
                        </select>                        
                        @error('is_correct')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" id="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection