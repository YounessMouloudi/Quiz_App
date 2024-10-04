@extends('admin.app')

@section('title','Quizzes')

@section('content')

<div class="container py-5">
    @if (session('message'))
        <div class="alert alert-success mb-3">
            {{ session('message') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h4>List Quizzes</h4>
                <a href="{{ route('quizzes.create') }}">
                    <button class="btn btn-primary">New Quizz</button>
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table text-center table-striped table-responsive table-bordered table-hover">
                <thead>
                    <tr>                                           
                        <th>Id</th>
                        <th>Question</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($quizzes as $quizze)
                        <tr>
                            <td>{{$quizze->id}}</td>   
                            <td>{{$quizze->question}}</td>   
                            <td class="d-flex justify-content-center">
                                <a href="{{ route('quizzes.edit', $quizze->id) }}">
                                    <button class="btn btn-success me-3">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                </a>   
                                <form action="{{ route('quizzes.destroy',$quizze->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn-danger btn" onclick="return confirm('vous voulez supprimer ?')" >
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>   
                        </tr>                
                    @empty
                        <tr>
                            <td colspan="6" class="text-danger fw-bold">liste vide</td>
                        </tr>                
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection