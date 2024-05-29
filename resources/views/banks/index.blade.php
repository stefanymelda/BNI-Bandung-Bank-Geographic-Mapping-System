@extends('adminlte::page')

@section('title', 'Data Bank')

@section('content_header')
<div class="card bg-info text-white">
    <div class="card-body text-center p-4">
        <h1>DATA BANK BNI DI BANDUNG</h1>
        <br>
        <h3>{{ \App\Models\Bank::count() }} Lokasi</h3>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if (session('success_message'))
                <div class="alert alert-success">
                    {{ session('success_message') }}
                </div>
                @endif

                <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
                <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

                <div id="map" class="mx-auto" style="width:100%; height:400px;"></div>

                <style>
                    #map {
                        width: 100%;
                        height: 400px;
                    }
                </style>

                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-striped" id="example2">
                        <thead class="thead-dark">
                            <tr>
                                <th>Nama Bank</th>
                                <th>Alamat</th>
                                <th>Jam Operasional</th>
                                <th>Call Center</th>
                                <th>Longitude</th>
                                <th>Latitude</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($banks as $bank)
                            <tr>
                                <td>{{ $bank->namabank }}</td>
                                <td>{{ $bank->alamat }}</td>
                                <td>{{ $bank->jam_operasional }}</td>
                                <td>{{ $bank->call_center }}</td>
                                <td>{{ $bank->longitude }}</td>
                                <td>{{ $bank->latitude }}</td>
                                <td>
                                    <a href="{{ route('banks.show', $bank->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('banks.edit', $bank->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $bank->id }}')"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <p class="mb-0"></p>
            </div>
        </div>
    </div>
</div>
@stop

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    var banksData = @json($banks);

    var map = L.map('map').setView([-6.900707, 107.615868], 13);
    L.tileLayer('https://{s}.google.com/vt?/lyrs=p&x={x}&y={y}&z={z}', {
        maxZoom: 19,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
    }).addTo(map);

    banksData.forEach(function(bank) {
        var marker = L.marker([bank.latitude, bank.longitude]).addTo(map);
        marker.bindPopup("<b>" + bank.namabank + "</b><br>Alamat: " + bank.alamat +
            "<br>Jam Operasional: " + bank.jam_operasional + "<br>Call Center: " + bank.call_center +
            "<br>Latitude: " + bank.latitude + "<br>Longitude: " + bank.longitude).openPopup();
    });

    map.on('click', function onMapClick(e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;
        document.getElementById('InputLatitude').value = lat;
        document.getElementById('InputLongitude').value = lng;
    });
</script>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Anda tidak dapat mengembalikan data yang sudah dihapus!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endpush