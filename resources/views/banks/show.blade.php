@extends('adminlte::page')

@section('title', 'Detail Bank BNI')

@section('content_header')
<h1 class="m-0 text-dark">Detail Bank BNI</h1>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
@stop

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">{{ $bank->namabank }}</h3>
                <p class="card-text"><strong>Alamat:</strong> {{ $bank->alamat }}</p>
                <p class="card-text"><strong>Jam Operasional:</strong> {{ $bank->jam_operasional}}</p>
                <p class="card-text"><strong>Call Center:</strong> {{ $bank->call_center}}</p>
                <p class="card-text" data-longitude="{{ $bank->longitude }}"><strong>Longitude:</strong> {{ $bank->longitude }}</p>
                <p class="card-text" data-latitude="{{ $bank->latitude }}"><strong>Latitude:</strong> {{ $bank->latitude }}</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('banks.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div id="map" style="height: 300px; border-radius: 8px; border: 1px solid #ddd;"></div>
            </div>
        </div>
    </div>
</div>
@stop

@push('css')
<style>
    #map {
        width: 100%;
        height: 100%;
    }
</style>
@endpush

@push('js')
<script>
    var latitude = document.querySelector('p[data-latitude]').getAttribute('data-latitude');
    var longitude = document.querySelector('p[data-longitude]').getAttribute('data-longitude');

    var map = L.map('map').setView([latitude, longitude], 17);

    var marker = L.marker([latitude, longitude]).addTo(map);
    L.tileLayer('https://{s}.google.com/vt?lyrs=m&x={x}&y={y}&z={z}', {
        maxZoom: 19,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
    }).addTo(map);
</script>
@endpush