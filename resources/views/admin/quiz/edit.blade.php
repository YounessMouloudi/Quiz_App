@extends('admin.app')

@section('title','Edit Quiz')

@section('content')

<div class="container py-5">
    <div class="col-md-8 offset-md-2">
        @if (session('info'))
            <div class="alert alert-warning mb-3">
                {{ session('info') }}
            </div>
        @endif
        <div class="row mb-2">
            <a href="{{ route('quizzes.index') }}" class="text-decoration-none text-white fw-medium"><span class="fw-bold"><</span> Retour</a>
        </div>
        <div class="card">
            <div class="card-header">Edit Quiz : </div>
            <div class="card-body">
                <form id="quizForm" class="mt-2" action="{{ route('quizzes.update',$quiz->id)}}" method="POST">
                    @csrf
                    @method("PUT")
                    <div class="mb-3">
                        <label for="question" class="form-label">Question</label>
                        <input type="text" class="form-control @error('question') is-invalid @enderror" id="question" name="question" value="{{old('question',$quiz->question)}}">
                        @error('question')
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