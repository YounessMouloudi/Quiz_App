@extends('layouts.app')

@section('title','Score')

@section('content')

<link rel="stylesheet" href="{{ asset('css/score.css') }}">

<header class="container py-4">
    <div class="px-3">
        <a href="{{ route('home')}}">
            <svg width="13" height="22" viewBox="0 0 13 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.3833 20.7167L0.949967 12.2833C0.766633 12.1 0.637078 11.9014 0.5613 11.6875C0.485523 11.4736 0.447023 11.2445 0.445801 11C0.445801 10.7556 0.4843 10.5264 0.5613 10.3125C0.6383 10.0986 0.767856 9.90001 0.949967 9.71667L9.3833 1.28334C9.71941 0.94723 10.1472 0.779175 10.6666 0.779175C11.1861 0.779175 11.6139 0.94723 11.95 1.28334C12.2861 1.61945 12.4541 2.04723 12.4541 2.56667C12.4541 3.08612 12.2861 3.5139 11.95 3.85001L4.79997 11L11.95 18.15C12.2861 18.4861 12.4541 18.9139 12.4541 19.4333C12.4541 19.9528 12.2861 20.3806 11.95 20.7167C11.6139 21.0528 11.1861 21.2208 10.6666 21.2208C10.1472 21.2208 9.71941 21.0528 9.3833 20.7167Z" fill="white"/>
            </svg>
        </a>
    </div>
</header>
<section class="container py-3">
    <div class="px-3">
        <h6 class="message px-1 text-white text-center mb-3"></h6>
        <div class="score-total p-2 text-center mx-auto">
            <h6 class="my-2">Votre score : <span class="fw-bold text-black"><span class="score">{{$score}}</span>/<span class="total">10</span></span></h6>
        </div>
        <form action="{{ route('score') }}" method="POST">
            @csrf
            @method("delete")
            <button type="submit" class="button text-center text-white border-0 rounded-4 mt-5 fs-5 fw-semibold p-2 w-100">
                Recommencer
            </button>
        </form>
    </div>
</section>
<section class="container circle position-relative py-3">
    <div class="box-white rounded-circle">
    </div>
</section>
<section class="container py-5">
    <div class="position-relative">
        <div class="box-title py-3">
            <h5 class="text-center fw-bold">Classement</h5>
        </div>
        <div class="box-cards d-flex flex-column gap-4 px-2 py-3">
            @forelse($topPlayers as $index => $players)
                <div class="card p-2 rounded-4">
                    <div class="d-flex justify-content-between align-items-center px-1">
                        <div class="d-flex align-items-center gap-3 fw-bold">
                            <div class="fs-5">{{ $index + 1 }}</div>
                            @if (session()->has("sessionData"))
                                <img src="{{ asset('images/'.$players->image ) }}" class="rounded-circle" width="42px" height="42px" alt="">
                            @else
                                <img src="{{ asset('images/'.$players->player->image ) }}" class="rounded-circle" width="42px" height="42px" alt=""> 
                            @endif
                            @if (session()->has("sessionData"))
                                <div class="box-name">{{ $players->name }}</div>
                            @else
                                <div class="box-name">{{ $players->player->name }}</div>
                            @endif
                        </div>
                        <div class="fw-semibold">
                            <div class="box-score">{{$players->score}}/10</div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="py-5">
                    <h4 class="text-danger text-center fw-bold py-5">Aucun joueur n'a encore participé</h4>
                </div>                
            @endforelse
            {{-- <div class="card p-2 rounded-4">
                <div class="d-flex justify-content-between align-items-center px-1">
                    <div class="d-flex align-items-center gap-3 fw-bold">
                        <div class="fs-5">2</div>
                        <img src="{{ asset('images/profile.jpg') }}" class="rounded-circle" width="42px" height="42px" alt="">
                        <div class="box-name">Thierry</div>
                    </div>
                    <div class="fw-semibold">
                        <div class="box-score">10/10</div>
                    </div>
                </div>
            </div>
            <div class="card p-2 rounded-4">
                <div class="d-flex justify-content-between align-items-center px-1">
                    <div class="d-flex align-items-center gap-3 fw-bold">
                        <div class="fs-5">3</div>
                        <img src="{{ asset('images/profile.jpg') }}" class="rounded-circle" width="42px" height="42px" alt="">
                        <div class="box-name">Thierry</div>
                    </div>
                    <div class="fw-semibold">
                        <div class="box-score">10/10</div>
                    </div>
                </div>
            </div>
            <div class="card p-2 rounded-4">
                <div class="d-flex justify-content-between align-items-center px-1">
                    <div class="d-flex align-items-center gap-3 fw-bold">
                        <div class="fs-5">4</div>
                        <img src="{{ asset('images/profile.jpg') }}" class="rounded-circle" width="42px" height="42px" alt="">
                        <div class="box-name">Thierry</div>
                    </div>
                    <div class="fw-semibold">
                        <div class="box-score">10/10</div>
                    </div>
                </div>
            </div>
            <div class="card p-2 rounded-4">
                <div class="d-flex justify-content-between align-items-center px-1">
                    <div class="d-flex align-items-center gap-3 fw-bold">
                        <div class="fs-5">5</div>
                        <img src="{{ asset('images/profile.jpg') }}" class="rounded-circle" width="42px" height="42px" alt="">
                        <div class="box-name">Thierry</div>
                    </div>
                    <div class="fw-semibold">
                        <div class="box-score">10/10</div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</section>
<section class="container pb-4 position-relative">
    <div class="p-3">
        <div class="down-menu rounded-pill py-2 px-3">
            <div class="row text-center px-4">
                <div class="col-3">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 10L3 8M3 8L10 1L17 8M3 8V18C3 18.2652 3.10536 18.5196 3.29289 18.7071C3.48043 18.8946 3.73478 19 4 19H7M17 8L19 10M17 8V18C17 18.2652 16.8946 18.5196 16.7071 18.7071C16.5196 18.8946 16.2652 19 16 19H13M7 19C7.26522 19 7.51957 18.8946 7.70711 18.7071C7.89464 18.5196 8 18.2652 8 18V14C8 13.7348 8.10536 13.4804 8.29289 13.2929C8.48043 13.1054 8.73478 13 9 13H11C11.2652 13 11.5196 13.1054 11.7071 13.2929C11.8946 13.4804 12 13.7348 12 14V18C12 18.2652 12.1054 18.5196 12.2929 18.7071C12.4804 18.8946 12.7348 19 13 19M7 19H13" stroke="#EEEFF2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>    
                </div>
                <div class="col-3">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 17H4C3.46957 17 2.96086 16.7893 2.58579 16.4142C2.21071 16.0391 2 15.5304 2 15V5C2 4.46957 2.21071 3.96086 2.58579 3.58579C2.96086 3.21071 3.46957 3 4 3H20C20.5304 3 21.0391 3.21071 21.4142 3.58579C21.7893 3.96086 22 4.46957 22 5V15C22 15.5304 21.7893 16.0391 21.4142 16.4142C21.0391 16.7893 20.5304 17 20 17H19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 15L17 21H7L12 15Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>                            
                </div>
                <div class="col-3">
                    <svg width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16.75 3.56V2C16.75 1.59 16.41 1.25 16 1.25C15.59 1.25 15.25 1.59 15.25 2V3.5H8.74999V2C8.74999 1.59 8.40999 1.25 7.99999 1.25C7.58999 1.25 7.24999 1.59 7.24999 2V3.56C4.54999 3.81 3.23999 5.42 3.03999 7.81C3.01999 8.1 3.25999 8.34 3.53999 8.34H20.46C20.75 8.34 20.99 8.09 20.96 7.81C20.76 5.42 19.45 3.81 16.75 3.56Z" fill="white"/>
                        <path d="M20 9.84003H4C3.45 9.84003 3 10.29 3 10.84V17C3 20 4.5 22 8 22H12.93C13.62 22 14.1 21.33 13.88 20.68C13.68 20.1 13.51 19.46 13.51 19C13.51 15.97 15.98 13.5 19.01 13.5C19.3 13.5 19.59 13.52 19.87 13.57C20.47 13.66 21.01 13.19 21.01 12.59V10.85C21 10.29 20.55 9.84003 20 9.84003ZM9.21 17.71C9.11 17.8 9 17.87 8.88 17.92C8.76 17.97 8.63 18 8.5 18C8.37 18 8.24 17.97 8.12 17.92C8 17.87 7.89 17.8 7.79 17.71C7.61 17.52 7.5 17.26 7.5 17C7.5 16.94 7.51 16.87 7.52 16.81C7.53 16.74 7.55 16.68 7.58 16.62C7.6 16.56 7.63 16.5 7.67 16.44C7.7 16.39 7.75 16.34 7.79 16.29C7.89 16.2 8 16.13 8.12 16.08C8.36 15.98 8.64 15.98 8.88 16.08C9 16.13 9.11 16.2 9.21 16.29C9.25 16.34 9.3 16.39 9.33 16.44C9.37 16.5 9.4 16.56 9.42 16.62C9.45 16.68 9.47 16.74 9.48 16.81C9.49 16.87 9.5 16.94 9.5 17C9.5 17.26 9.39 17.52 9.21 17.71ZM9.21 14.21C9.11 14.3 9 14.37 8.88 14.42C8.76 14.47 8.63 14.5 8.5 14.5C8.37 14.5 8.24 14.47 8.12 14.42C7.99 14.37 7.89 14.3 7.79 14.21C7.61 14.02 7.5 13.76 7.5 13.5C7.5 13.24 7.61 12.98 7.79 12.79C7.89 12.7 8 12.63 8.12 12.58C8.36 12.48 8.64 12.48 8.88 12.58C9 12.63 9.11 12.7 9.21 12.79C9.25 12.84 9.3 12.89 9.33 12.94C9.37 13 9.4 13.06 9.42 13.12C9.45 13.18 9.47 13.24 9.48 13.3C9.49 13.37 9.5 13.44 9.5 13.5C9.5 13.76 9.39 14.02 9.21 14.21ZM12.71 14.21C12.52 14.39 12.27 14.5 12 14.5C11.87 14.5 11.74 14.47 11.62 14.42C11.49 14.37 11.39 14.3 11.29 14.21C11.11 14.02 11 13.76 11 13.5C11 13.44 11.01 13.37 11.02 13.3C11.03 13.24 11.05 13.18 11.08 13.12C11.1 13.06 11.13 13 11.17 12.94C11.21 12.89 11.25 12.84 11.29 12.79C11.66 12.42 12.33 12.42 12.71 12.79C12.75 12.84 12.79 12.89 12.83 12.94C12.87 13 12.9 13.06 12.92 13.12C12.95 13.18 12.97 13.24 12.98 13.3C12.99 13.37 13 13.44 13 13.5C13 13.76 12.89 14.02 12.71 14.21Z" fill="white"/>
                        <path d="M21.83 16.17C20.27 14.61 17.73 14.61 16.17 16.17C14.61 17.73 14.61 20.27 16.17 21.83C17.73 23.39 20.27 23.39 21.83 21.83C23.39 20.27 23.39 17.73 21.83 16.17ZM21.07 19.56C20.94 19.7 20.75 19.78 20.54 19.78H19.8V20.56C19.8 20.77 19.72 20.95 19.58 21.09C19.44 21.23 19.26 21.31 19.05 21.31C18.64 21.31 18.3 20.97 18.3 20.56V19.78H17.55C17.14 19.78 16.8 19.45 16.8 19.03C16.8 18.62 17.14 18.28 17.55 18.28H18.3V17.57C18.3 17.16 18.63 16.82 19.05 16.82C19.46 16.82 19.8 17.16 19.8 17.57V18.28H20.54C20.96 18.28 21.29 18.62 21.29 19.03C21.29 19.24 21.21 19.43 21.07 19.56Z" fill="white"/>
                    </svg>
                </div>
                <div class="col-3">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21.328 7.99998H18.4L17.776 4.27198C17.6503 3.70793 17.3742 3.18845 16.977 2.7687C16.5798 2.34896 16.0763 2.04461 15.52 1.88798C14.9612 1.70818 14.379 1.61115 13.792 1.59998H10.208C9.62107 1.61115 9.0389 1.70818 8.48004 1.88798C7.92378 2.04461 7.42032 2.34896 7.02311 2.7687C6.6259 3.18845 6.34977 3.70793 6.22404 4.27198L5.60004 7.99998H2.67204C2.54602 7.99921 2.42161 8.02823 2.30893 8.08466C2.19625 8.1411 2.0985 8.22335 2.02364 8.32473C1.94878 8.4261 1.89893 8.54373 1.87814 8.66802C1.85736 8.79232 1.86623 8.91976 1.90404 9.03998L4.91204 19.12C5.06518 19.6069 5.36959 20.0324 5.78105 20.3345C6.19251 20.6366 6.68958 20.7997 7.20004 20.8H16.8C17.3078 20.7963 17.8012 20.6317 18.2095 20.3298C18.6177 20.0279 18.9197 19.6043 19.072 19.12L22.08 9.03998C22.1175 8.92105 22.1266 8.79502 22.1066 8.67195C22.0867 8.54888 22.0382 8.43217 21.9652 8.33114C21.8921 8.23011 21.7965 8.14755 21.6859 8.09005C21.5752 8.03256 21.4527 8.00171 21.328 7.99998ZM7.23204 7.99998L7.80804 4.52798C7.87118 4.24449 8.01766 3.98637 8.22865 3.78679C8.43964 3.58721 8.70549 3.45528 8.99204 3.40798C9.38564 3.28318 9.79524 3.21438 10.208 3.19998H13.792C14.2096 3.21278 14.624 3.28318 15.024 3.40798C15.3106 3.45528 15.5764 3.58721 15.7874 3.78679C15.9984 3.98637 16.1449 4.24449 16.208 4.52798L16.768 7.99998H7.16804H7.23204Z" fill="#F8F8F8"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <svg width="134" height="5" viewBox="0 0 134 5" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect width="134" height="5" rx="2.5" fill="#333333"/>
        </svg>      
    </div>
</section> 

<script src="{{asset('js/reponse_score.js')}}"></script>

@endsection