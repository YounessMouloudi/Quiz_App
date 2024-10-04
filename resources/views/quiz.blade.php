@extends('layouts.app')

@section('title','Quiz')

@section('content')

<link rel="stylesheet" href="{{ asset('css/quiz.css') }}">

<meta name="csrf-token" content="{{ csrf_token() }}">

<header class="container pt-3 pb-5 my-3">
    <div class="position-relative mx-3">
        <div class="position-absolute ms-4 top-0 start-0 translate-middle">
            <a class="text-decoration-none fw-bold" href="{{ route('home') }}">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.3 17.3L8.7 12.7C8.6 12.6 8.52934 12.4917 8.488 12.375C8.44667 12.2583 8.42567 12.1333 8.425 12C8.425 11.8667 8.446 11.7417 8.488 11.625C8.53 11.5083 8.60067 11.4 8.7 11.3L13.3 6.69999C13.4833 6.51665 13.7167 6.42499 14 6.42499C14.2833 6.42499 14.5167 6.51665 14.7 6.69999C14.8833 6.88332 14.975 7.11665 14.975 7.39999C14.975 7.68332 14.8833 7.91665 14.7 8.09999L10.8 12L14.7 15.9C14.8833 16.0833 14.975 16.3167 14.975 16.6C14.975 16.8833 14.8833 17.1167 14.7 17.3C14.5167 17.4833 14.2833 17.575 14 17.575C13.7167 17.575 13.4833 17.4833 13.3 17.3Z" fill="#004643"/>
                </svg> 
                <span>
                    Retour
                </span>
            </a>
        </div>
        <div class="position-absolute top-0 start-50 translate-middle">
            <h6 class="fw-bold mt-2"><span class="quest_num">0</span>/<span class="quest_count">0</span></h6>
        </div>
    </div>
</header>
<section class="box-quiz my-5">
    <div class="position-relative">
        <div class="box-num position-absolute top-0 start-50 translate-middle">
            <div class="box-border rounded-circle">
                <div class="box-timer border-line bg-white rounded-circle fw-bold fs-4"></div>
            </div>
        </div>
        <div class="container py-3">
            <div class="px-1">
                <div class="box-question card rounded-4 py-5">
                    <p class="question px-2 fs-6 pt-3 fw-bold"></p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="container pb-5">
    <div class="quiz px-1">
        <div class="box_reponses"></div>
        <button type="button" class="validBtn btn rounded-4 mt-5 fw-semibold text-white p-1 w-100">
            Valider
        </button>
        <button type="button" class="nextBtn d-none btn rounded-4 mt-5 fw-semibold text-white p-1 w-100">
            Suivant
        </button>
    </div>
</section>

<script src="{{asset('js/quiz.js')}}"></script>

@endsection