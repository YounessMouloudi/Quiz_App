@extends('admin.app')

@section('title','Answers')

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
                <h4>List Answers</h4>
                <a href="{{ route('answers.create') }}">
                    <button class="btn btn-primary">New Answer</button>
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table text-center table-striped table-bordered table-hover">
                    <thead>
                        <tr>                                           
                            <th>Id</th>
                            <th>Answer</th>
                            <th>Question</th>
                            <th>Correct</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($answers as $answer)
                            <tr>
                                {{-- <td>{{$key + 1}}</td>  --}}
                                {{-- <td>{{$answer->id}}</td>  --}}
                                {{-- hadi hia la meilleur methode pour fair l'id ou l'indexation --}}
                                <td>{{$answers->firstItem() + $loop->index}}</td>   
                                <td>{{$answer->answer}}</td>   
                                <td>{{$answer->question->question}} (id : {{$answer->question_id}})</td>   
                                <td>{{$answer->is_correct == 1 ? "True" : "False"}}</td>   
                                <td class="d-flex justify-content-center">
                                    <a href="{{ route('answers.edit', $answer->id) }}">
                                        <button class="btn btn-success me-3">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                    </a>   
                                    <form action="{{ route('answers.destroy',$answer->id) }}" method="post">
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
                                <td colspan="5" class="text-danger fw-bold">liste vide</td>
                            </tr>                
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{ $answers->links() }}
</div>

@endsection