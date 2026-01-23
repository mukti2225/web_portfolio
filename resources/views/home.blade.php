@extends('layout.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/beranda.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tentang.css') }}">
    <link rel="stylesheet" href="{{ asset('css/skill.css') }}">
    <link rel="stylesheet" href="{{ asset('css/kontak.css') }}">
    <link rel="stylesheet" href="{{ asset('css/portfolio.css') }}">
@endpush

@section('content')

    <section id="beranda">
        @include('components.beranda')
    </section>

    <section id="tentang">
        @include('components.tentang')
    </section>

    <section id="skill">
        @include('components.skill')
    </section>

    <section id="portfolio">
        @include('components.portfolio')
    </section>

    <section id="kontak">
        @include('components.kontak')
    </section>

@endsection

@push ('js')
<script> AOS.init(); </script>
@endpush