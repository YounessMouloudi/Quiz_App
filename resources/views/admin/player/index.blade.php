@extends('admin.app')

@section('title','Players')

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
                <h4>List Players</h4>
                <a href="{{ route('players.create') }}">
                    <button class="btn btn-primary">New Player</button>
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table text-center table-striped table-bordered table-hover">
                    <thead>
                        <tr>                                           
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Image</th>
                            <th>Score</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($players as $player)
                            <tr>
                                <td>{{$player->id}}</td>   
                                <td>{{$player->name}}</td>   
                                <td>{{$player->email}}</td>   
                                <td>{{$player->phone}}</td>
                                <td> 
                                    <img src="{{asset('images/'.$player->image)}}" class="rounded-circle" width="40" height="40" alt="{{$player->image}}">
                                </td>
                                <td>{{ $player->score ?? 0}}</td> 
                                <td class="d-flex justify-content-center">
                                    <a href="{{ route('players.edit', $player->id) }}">
                                        <button class="btn btn-success me-3">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                    </a>   
                                    <form action="{{ route('players.destroy',$player->id) }}" method="post">
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
    {{ $players->links() }}
</div>

@endsection