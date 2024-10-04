@extends('layouts.app')

@section('title','Home')

@section('content')

<link rel="stylesheet" href="{{ asset('css/home.css') }}">

<div class="rectangle">
    <header class="container py-3">
        <div class="d-flex justify-content-between align-items-center pt-1 px-2">
            <div>
                <svg width="26" height="17" viewBox="0 0 26 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="26" height="3" fill="#EFF0F3"/>
                    <rect y="7" width="21" height="3" fill="#EFF0F3"/>
                    <rect y="14" width="16" height="3" fill="#EFF0F3"/>
                </svg> 
            </div>
            <div class="">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="border border-2 rounded-circle p-1">
                                @if (Auth::guard('player')->check())
                                    <img src="{{ asset('images/' . Auth::guard('player')->user()->image) }}" class="rounded-circle" alt="" width="30px" height="30px">
                                @elseif(isset($sessionData))
                                    <img src="{{ asset('images/' . $sessionData->image) }}" class="rounded-circle" alt="" width="30px" height="30px">
                                @endif
                            </div>
                        </a>
                        <ul class="dropdown-menu px-0">
                            <form action="{{ route('logoutPage') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item fw-medium">Logout</button>
                            </form>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <section class="container box-landing">
        <article class="px-2">
            <h6 class="fw-light">Bonjour {{ Auth::guard('player')->check() ? Auth::guard('player')->user()->name : $sessionData->name }},</h6>
            <h3 class="fw-semibold mt-3">Choisissez une catégorie parmi nos options</h3>
            <div class="button text-center rounded-4 mt-4 fw-semibold p-2 w-100">
                <a href="#" class="text-decoration-none text-white">
                    <span>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.75 3.56V2C16.75 1.59 16.41 1.25 16 1.25C15.59 1.25 15.25 1.59 15.25 2V3.5H8.74999V2C8.74999 1.59 8.40999 1.25 7.99999 1.25C7.58999 1.25 7.24999 1.59 7.24999 2V3.56C4.54999 3.81 3.23999 5.42 3.03999 7.81C3.01999 8.1 3.25999 8.34 3.53999 8.34H20.46C20.75 8.34 20.99 8.09 20.96 7.81C20.76 5.42 19.45 3.81 16.75 3.56Z" fill="white"/>
                            <path d="M20 9.84H4C3.45 9.84 3 10.29 3 10.84V17C3 20 4.5 22 8 22H12.93C13.62 22 14.1 21.33 13.88 20.68C13.68 20.1 13.51 19.46 13.51 19C13.51 15.97 15.98 13.5 19.01 13.5C19.3 13.5 19.59 13.52 19.87 13.57C20.47 13.66 21.01 13.19 21.01 12.59V10.85C21 10.29 20.55 9.84 20 9.84ZM9.21 17.71C9.11 17.8 9 17.87 8.88 17.92C8.76 17.97 8.63 18 8.5 18C8.37 18 8.24 17.97 8.12 17.92C8 17.87 7.89 17.8 7.79 17.71C7.61 17.52 7.5 17.26 7.5 17C7.5 16.94 7.51 16.87 7.52 16.81C7.53 16.74 7.55 16.68 7.58 16.62C7.6 16.56 7.63 16.5 7.67 16.44C7.7 16.39 7.75 16.34 7.79 16.29C7.89 16.2 8 16.13 8.12 16.08C8.36 15.98 8.64 15.98 8.88 16.08C9 16.13 9.11 16.2 9.21 16.29C9.25 16.34 9.3 16.39 9.33 16.44C9.37 16.5 9.4 16.56 9.42 16.62C9.45 16.68 9.47 16.74 9.48 16.81C9.49 16.87 9.5 16.94 9.5 17C9.5 17.26 9.39 17.52 9.21 17.71ZM9.21 14.21C9.11 14.3 9 14.37 8.88 14.42C8.76 14.47 8.63 14.5 8.5 14.5C8.37 14.5 8.24 14.47 8.12 14.42C7.99 14.37 7.89 14.3 7.79 14.21C7.61 14.02 7.5 13.76 7.5 13.5C7.5 13.24 7.61 12.98 7.79 12.79C7.89 12.7 8 12.63 8.12 12.58C8.36 12.48 8.64 12.48 8.88 12.58C9 12.63 9.11 12.7 9.21 12.79C9.25 12.84 9.3 12.89 9.33 12.94C9.37 13 9.4 13.06 9.42 13.12C9.45 13.18 9.47 13.24 9.48 13.3C9.49 13.37 9.5 13.44 9.5 13.5C9.5 13.76 9.39 14.02 9.21 14.21ZM12.71 14.21C12.52 14.39 12.27 14.5 12 14.5C11.87 14.5 11.74 14.47 11.62 14.42C11.49 14.37 11.39 14.3 11.29 14.21C11.11 14.02 11 13.76 11 13.5C11 13.44 11.01 13.37 11.02 13.3C11.03 13.24 11.05 13.18 11.08 13.12C11.1 13.06 11.13 13 11.17 12.94C11.21 12.89 11.25 12.84 11.29 12.79C11.66 12.42 12.33 12.42 12.71 12.79C12.75 12.84 12.79 12.89 12.83 12.94C12.87 13 12.9 13.06 12.92 13.12C12.95 13.18 12.97 13.24 12.98 13.3C12.99 13.37 13 13.44 13 13.5C13 13.76 12.89 14.02 12.71 14.21Z" fill="white"/>
                            <path d="M21.83 16.17C20.27 14.61 17.73 14.61 16.17 16.17C14.61 17.73 14.61 20.27 16.17 21.83C17.73 23.39 20.27 23.39 21.83 21.83C23.39 20.27 23.39 17.73 21.83 16.17ZM21.07 19.56C20.94 19.7 20.75 19.78 20.54 19.78H19.8V20.56C19.8 20.77 19.72 20.95 19.58 21.09C19.44 21.23 19.26 21.31 19.05 21.31C18.64 21.31 18.3 20.97 18.3 20.56V19.78H17.55C17.14 19.78 16.8 19.45 16.8 19.03C16.8 18.62 17.14 18.28 17.55 18.28H18.3V17.57C18.3 17.16 18.63 16.82 19.05 16.82C19.46 16.82 19.8 17.16 19.8 17.57V18.28H20.54C20.96 18.28 21.29 18.62 21.29 19.03C21.29 19.24 21.21 19.43 21.07 19.56Z" fill="white"/>
                        </svg>                                           
                    </span>
                    <span>
                        Demande de rendez-vous
                    </span>
                </a>    
            </div>    
        </article>
    </section>        
</div>
<!-- <section class="circle position-relative py-3">
    <div class="box-white rounded-circle">
    </div>
</section> -->
<section class="container">
    <section class="box-items">
        <div class="d-flex justify-content-between py-5">
            <div class="d-flex flex-column flex-md-row gap-3 px-1">
                <a class="" href="/quiz">
                    <div class="item card bg-transparent border border-0">
                        <img src="{{asset('images/quiz.jpg')}}" class="rounded" alt="" height="200px">
                        <h6 class="position-absolute text-white fw-bold bottom-0 py-1 px-2">Tester vos connaissances</h6>
                    </div>
                </a>
                <div class="">
                    <div class="item card bg-transparen border border-0">
                        <img src="{{asset('images/documentation.jpg')}}" class="rounded" alt="" height="200px">
                        <h6 class="position-absolute text-white fw-bold bottom-0 py-1 px-2">Formulaires et documentation</h6>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column flex-md-row gap-3 px-1 pt-4 pt-md-0">
                <div class="">                        
                    <div class="item card bg-transparent border border-0">    
                        <img src="{{asset('images/saviez-vous.jpg')}}" class="rounded" alt="" height="200px">
                        <h6 class="position-absolute text-white fw-bold bottom-0 py-1 px-2">Le saviez-vous ?</h6>
                    </div>
                </div>
                <div class="">
                    <div class="item card bg-transparent border border-0">
                        <img src="{{asset('images/boutique.jpg')}}" class="rounded" alt="" height="200px">
                        <h6 class="position-absolute text-white fw-bold bottom-0 py-1 px-2">Boutique</h6>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
<section class="container actualités p-3">
    <h4 class="fw-bold mb-4">Actualités</h4>
</section>
<div class="rectangle">
    <section class="container py-2">
        <div class="swiper tranding-slider position-relative">
          <div class="swiper-wrapper">
            <!-- Slide-start -->
            <div class="swiper-slide tranding-slide">
              <div class="tranding-slide-img">
                <iframe src="https://www.youtube.com/embed/o25Z39xDR38" frameborder="0" allowfullscreen></iframe>
                {{-- <div class="px-1">
                    <div class="position-absolute text-white bottom-0 py-1 px-2">
                        <h6 class="smallTitre my-1">Une douleur non traitée occasionnée par</h6>
                        <h6 class="titre fw-bold">la compression du nerf médian</h6>
                    </div>
                </div> --}}
              </div>
            </div>
            <div class="swiper-slide tranding-slide">
              <div class="tranding-slide-img">
                <iframe src="https://www.youtube.com/embed/KO8B8Lrljw4" frameborder="0" allowfullscreen></iframe>
              </div>
            </div>
            <div class="swiper-slide tranding-slide">
              <div class="tranding-slide-img">
                <iframe src="https://www.youtube.com/embed/BsdJjvUv-6Y" frameborder="0" allowfullscreen></iframe>
              </div>
            </div>
            <div class="swiper-slide tranding-slide">
              <div class="tranding-slide-img">
                <iframe src="https://www.youtube.com/embed/m3qGCM2O5Rs" frameborder="0" allowfullscreen></iframe>
              </div>
            </div>
            <!-- Slide-end -->
          </div>      
        </div>
    </section>
  
    <section class="container">
        <div class="py-3 box-medias">
            <h6 class="text-center mb-3 fs-6">Suivez-nous sur</h6>
            <div class="row mx-auto">
                <div class="col-3">
                    <svg width="30" height="30" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 0C8.9544 0 0 8.9544 0 20C0 29.3792 6.4576 37.2496 15.1688 39.4112V26.112H11.0448V20H15.1688V17.3664C15.1688 10.5592 18.2496 7.404 24.9328 7.404C26.2 7.404 28.3864 7.6528 29.2808 7.9008V13.4408C28.8088 13.3912 27.9888 13.3664 26.9704 13.3664C23.6912 13.3664 22.424 14.6088 22.424 17.8384V20H28.9568L27.8344 26.112H22.424V39.8536C32.3272 38.6576 40.0008 30.2256 40.0008 20C40 8.9544 31.0456 0 20 0Z" fill="white"/>
                    </svg>                  
                </div>
                <div class="col-3">
                    <svg width="30" height="30" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_330_207)">
                        <path d="M20 3.60156C25.3438 3.60156 25.9766 3.625 28.0781 3.71875C30.0313 3.80469 31.0859 4.13281 31.7891 4.40625C32.7188 4.76563 33.3906 5.20313 34.0859 5.89844C34.7891 6.60156 35.2188 7.26563 35.5781 8.19531C35.8516 8.89844 36.1797 9.96094 36.2656 11.9062C36.3594 14.0156 36.3828 14.6484 36.3828 19.9844C36.3828 25.3281 36.3594 25.9609 36.2656 28.0625C36.1797 30.0156 35.8516 31.0703 35.5781 31.7734C35.2188 32.7031 34.7813 33.375 34.0859 34.0703C33.3828 34.7734 32.7188 35.2031 31.7891 35.5625C31.0859 35.8359 30.0234 36.1641 28.0781 36.25C25.9688 36.3438 25.3359 36.3672 20 36.3672C14.6563 36.3672 14.0234 36.3438 11.9219 36.25C9.96875 36.1641 8.91406 35.8359 8.21094 35.5625C7.28125 35.2031 6.60938 34.7656 5.91406 34.0703C5.21094 33.3672 4.78125 32.7031 4.42188 31.7734C4.14844 31.0703 3.82031 30.0078 3.73438 28.0625C3.64063 25.9531 3.61719 25.3203 3.61719 19.9844C3.61719 14.6406 3.64063 14.0078 3.73438 11.9062C3.82031 9.95312 4.14844 8.89844 4.42188 8.19531C4.78125 7.26563 5.21875 6.59375 5.91406 5.89844C6.61719 5.19531 7.28125 4.76563 8.21094 4.40625C8.91406 4.13281 9.97656 3.80469 11.9219 3.71875C14.0234 3.625 14.6563 3.60156 20 3.60156ZM20 0C14.5703 0 13.8906 0.0234375 11.7578 0.117188C9.63281 0.210938 8.17188 0.554687 6.90625 1.04688C5.58594 1.5625 4.46875 2.24219 3.35938 3.35938C2.24219 4.46875 1.5625 5.58594 1.04688 6.89844C0.554688 8.17188 0.210938 9.625 0.117188 11.75C0.0234375 13.8906 0 14.5703 0 20C0 25.4297 0.0234375 26.1094 0.117188 28.2422C0.210938 30.3672 0.554688 31.8281 1.04688 33.0938C1.5625 34.4141 2.24219 35.5312 3.35938 36.6406C4.46875 37.75 5.58594 38.4375 6.89844 38.9453C8.17188 39.4375 9.625 39.7812 11.75 39.875C13.8828 39.9688 14.5625 39.9922 19.9922 39.9922C25.4219 39.9922 26.1016 39.9688 28.2344 39.875C30.3594 39.7812 31.8203 39.4375 33.0859 38.9453C34.3984 38.4375 35.5156 37.75 36.625 36.6406C37.7344 35.5312 38.4219 34.4141 38.9297 33.1016C39.4219 31.8281 39.7656 30.375 39.8594 28.25C39.9531 26.1172 39.9766 25.4375 39.9766 20.0078C39.9766 14.5781 39.9531 13.8984 39.8594 11.7656C39.7656 9.64063 39.4219 8.17969 38.9297 6.91406C38.4375 5.58594 37.7578 4.46875 36.6406 3.35938C35.5313 2.25 34.4141 1.5625 33.1016 1.05469C31.8281 0.5625 30.375 0.21875 28.25 0.125C26.1094 0.0234375 25.4297 0 20 0Z" fill="white"/>
                        <path d="M20 9.72656C14.3281 9.72656 9.72656 14.3281 9.72656 20C9.72656 25.6719 14.3281 30.2734 20 30.2734C25.6719 30.2734 30.2734 25.6719 30.2734 20C30.2734 14.3281 25.6719 9.72656 20 9.72656ZM20 26.6641C16.3203 26.6641 13.3359 23.6797 13.3359 20C13.3359 16.3203 16.3203 13.3359 20 13.3359C23.6797 13.3359 26.6641 16.3203 26.6641 20C26.6641 23.6797 23.6797 26.6641 20 26.6641Z" fill="white"/>
                        <path d="M33.0781 9.32025C33.0781 10.6484 32 11.7187 30.6797 11.7187C29.3516 11.7187 28.2812 10.6406 28.2812 9.32025C28.2812 7.99213 29.3594 6.92181 30.6797 6.92181C32 6.92181 33.0781 7.99994 33.0781 9.32025Z" fill="white"/>
                        </g>
                        <defs>
                        <clipPath id="clip0_330_207">
                            <rect width="40" height="40" fill="white"/>
                        </clipPath>
                        </defs>
                    </svg>                            
                </div>
                <div class="col-3">
                    <svg width="30" height="30" viewBox="0 0 23 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16.3333 40C10.3333 40 5.83334 36.9167 5.83334 29.5V17.6667H0.333344V11.25C6.33334 9.66667 8.83334 4.5 9.16668 0H15.4167V10.1667H22.6667V17.6667H15.4167V28C15.4167 31.0833 17 32.1667 19.5 32.1667H23V40H16.3333Z" fill="white"/>
                    </svg>                            
                </div>
                <div class="col-3">
                    <svg width="30" height="30" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M37.0391 0H2.95312C1.32031 0 0 1.28906 0 2.88281V37.1094C0 38.7031 1.32031 40 2.95312 40H37.0391C38.6719 40 40 38.7031 40 37.1172V2.88281C40 1.28906 38.6719 0 37.0391 0ZM11.8672 34.0859H5.92969V14.9922H11.8672V34.0859ZM8.89844 12.3906C6.99219 12.3906 5.45312 10.8516 5.45312 8.95312C5.45312 7.05469 6.99219 5.51562 8.89844 5.51562C10.7969 5.51562 12.3359 7.05469 12.3359 8.95312C12.3359 10.8438 10.7969 12.3906 8.89844 12.3906ZM34.0859 34.0859H28.1562V24.8047C28.1562 22.5938 28.1172 19.7422 25.0703 19.7422C21.9844 19.7422 21.5156 22.1562 21.5156 24.6484V34.0859H15.5938V14.9922H21.2812V17.6016H21.3594C22.1484 16.1016 24.0859 14.5156 26.9688 14.5156C32.9766 14.5156 34.0859 18.4688 34.0859 23.6094V34.0859Z" fill="white"/>
                    </svg>   
                </div>
            </div>
        </div>
    </section>
</div>
<section class="container">
    <div class="d-flex justify-content-center align-items-center px-1">
        <div class="box-google px-2">
            <div class="card p-3 rounded-4">
                <div class="text-center px-2">
                    <svg width="158" height="65" viewBox="0 0 158 65" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <rect width="158" height="65" fill="url(#pattern0_346_32)"/>
                        <defs>
                        <pattern id="pattern0_346_32" patternContentUnits="objectBoundingBox" width="1" height="1">
                        <use xlink:href="#image0_346_32" transform="matrix(0.001 0 0 0.00243077 0 -0.00681538)"/>
                        </pattern>
                        <image id="image0_346_32" width="1000" height="417" xlink:href="data:image/png;base64,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"/>
                        </defs>
                    </svg>               
                    <p class="text mt-3 fw-semibold">
                        Avez vous apprécier votre visite ? 
                        Partager votre expérience sur 
                        Google pour aider les autre !
                    </p>
                    <div class="button text-center rounded mt-2 fs-6 fw-semibold p-2 w-100">
                        <a href="" class="text-decoration-none text-white">
                            Laissez nous un avis
                        </a>    
                    </div>            
                </div>
            </div>
        </div>
    </div>
</section>
<section class="container pb-4">
    <div class="px-3 pt-5 pb-3">
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

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="{{asset('js/home.js')}}"></script>

@endsection