@extends('layout.app')

@push('css')
<link rel="stylesheet" href="{{ asset('css/design.css') }}">
@endpush

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
                <p>Koleksi karya terbaik kami dalam berbagai kategori desain dan pengembangan</p>
            </div>

            <!-- Gallery Grid -->
            <div class="row g-4">
                @foreach($videos as $video)
                <!-- Card -->
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="{{ $video->link }}" class="image-card">
                        <img src="{{ asset('storage/' . $video->image) }}">
                        <div class="card-overlay">
                            <h3 class="card-title">{{ $video->title }}</h3>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection