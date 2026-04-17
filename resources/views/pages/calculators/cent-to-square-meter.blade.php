@extends('layouts.app')
@section('title', 'Cent to Square Meter - ZendoIndia')
@section('content')
<style>
.about-banner-section{position:relative;background-image:url('https://zendoindia.com/new-home/zendo/assets/images/bg/cta-bg.jpg');background-size:cover;background-position:center;padding:160px 0 80px;color:#fff}
.about-banner-overlay{position:absolute;top:0;left:0;width:100%;height:100%;background:rgb(0 0 0/62%)}
.about-banner-container{position:relative;max-width:1250px;margin:auto;padding:0 20px}
.about-banner-heading{font-size:48px;font-weight:700;margin-bottom:15px}
.about-breadcrumb{display:flex;align-items:center;gap:8px;font-size:16px}
.about-breadcrumb a{color:#fff;text-decoration:none;font-weight:500}
.about-breadcrumb p{margin:0;opacity:.8}
@media(max-width:767px){.about-banner-heading{font-size:32px}.about-banner-section{padding:130px 0 60px}}
</style>

<section class="about-banner-section">
    <div class="about-banner-overlay"></div>
    <div class="about-banner-container">
        <h1 class="about-banner-heading">Cent to Square Meter</h1>
        <div class="about-breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span>/</span>

            <p>Cent to Square Meter</p>
        </div>
    </div>
</section>

<div style="max-width:900px;margin:60px auto;padding:0 20px;">
    {{-- Content will be added manually --}}
</div>
@endsection
