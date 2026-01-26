@extends('layout.app')

@push('css')
<link rel="stylesheet" href="{{ asset('css/design.css') }}">
@endpush

@php
    $supabaseUrl = 'https://uoboellrhnbmduyqqunz.supabase.co/storage/v1/object/public/uploads/desains/';
@endphp

@section('navbar')
@endsection

@section('content')

<header class="header-back">
    <div class="container">
        <a href="{{ route('home') }}" class="back-button">
            <span>Back</span>
        </a>
    </div>
</header>

<section class="gallery-section">
        <div class="container">
            <!-- Section Header -->
            <div class="section-header">
                <h1>Portfolio Gallery</h1>
                <p>A collection of featured projects across various design and development categories.</p>
            </div>

            <!-- Gallery Grid -->
            <div class="row g-4">
                @foreach($desains as $desain)
                <!-- Card -->
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="{{ $desain->link }}" class="image-card">
                        <img src="{{ $supabaseUrl . $desain->image }}" alt="{{ $desain->title }}">
                        <div class="card-overlay">
                            <h3 class="card-title">{{ $desain->title }}</h3>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection