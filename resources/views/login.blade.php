@extends('layouts.app')

@section('title','Login')

@section('content')

<link rel="stylesheet" href="{{ asset('css/login.css') }}">

<header class="py-5 position-relative">
    <div class="box-image position-absolute rounded-circle">
        <a href="{{ route("login") }}">
            <img src="{{asset('images/logo.png')}}" class="position-absolute" alt="Association">
        </a>
    </div>
</header>
<section class="container py-5">
    <div class="box-one">
        <div class="logo text-center position-relative rounded-circle mx-auto my-3">
            <h1 class="text-uppercase position-absolute fw-bold top-50 start-50 translate-middle">Logo</h1>
        </div>
        <div class="box-title">
            <h5 class="text-center px-4 lh-base">Bienvenue Dans le portail Web de la Clinique</h5>
            <h6 class="text-center fw-light">Prêt à tester vos connaissances ?</h6>
        </div>
    </div>
    <div class="box-two pt-3">
        <form class="mx-3" method="POST" action="{{ route('custom-register') }}">
            @csrf
            <div class="mb-2">
                <label for="name" class="form-label fw-light">Votre Name</label>
                <input type="text" id="name" class="form-control bg-transparent text-white rounded-4 py-2 @error('name') is-invalid @enderror" name="name" value="{{old('name')}}">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong class="bg-white">{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-2">
                <label for="email" class="form-label fw-light">Votre mail</label>
                <input type="email" id="email" class="form-control bg-transparent text-white rounded-4 py-2 @error('email') is-invalid @enderror" name="email" value="{{old('email')}}">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong class="bg-white">{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-2">
                <label for="phone" class="form-label fw-light">Votre numéro de téléphone</label>
                <input type="text" id="phone" class="form-control bg-transparent text-white rounded-4 py-2 @error('phone') is-invalid @enderror" name="phone" value="{{old('phone')}}">
                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong class="bg-white">{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn mt-5 fw-bold text-white rounded-4 p-2 w-100">S'inscrire</button>
        </form>
        <h6 class="text-center mt-4">
            <form action="{{ route('continue') }}" method="POST">
                @csrf
                <button type="submit" class="btn-continue text-decoration-none fw-light text-white border-0 p-0">
                    Continuer sans s'inscrire >
                </button>
            </form>
        </h6>
    </div>
</section>

@endsection