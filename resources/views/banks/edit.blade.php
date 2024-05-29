@extends('adminlte::page')

@section('title', 'Edit BANK')

@section('content_header')
<h1 class="m-0 text-dark">Edit BANK</h1>
@stop

@section('content')
<form action="{{ route('banks.update', $bank->id) }}" method="post" id="bankForm">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body" style="overflow:auto">
                    <table style="width:100%">
                        <tr>
                            <td><label for="InputNama">Nama Bank</label></td>
                            <td><input type="text" size="70" id="InputNama" placeholder="Nama Bank" name="namabank" value="{{ $bank->namabank }}"></td>
                        </tr>
                        <tr>
                            <td><label for="InputAlamat">Alamat</label></td>
                            <td><input type="text" size="70" id="InputAlamat" placeholder="Alamat" name="alamat" value="{{ $bank->alamat }}"></td>
                        </tr>
                        <tr>
                            <td><label for="InputJamOperasional">Jam Operasional</label></td>
                            <td><input type="text" size="70" id="InputJamOperasional" placeholder="Jam Operasional" name="jam_operasional" value="{{ $bank->jam_operasional }}"></td>
                        </tr>
                        <tr>
                            <td><label for="InputCallCenter">Call Center</label></td>
                            <td><input type="text" size="70" id="InputCallCenter" placeholder="Call Center" name="call_center" value="{{ $bank->call_center }}"></td>
                        </tr>
                        <tr>
                            <td><label for="InputLatitude">Latitude</label></td>
                            <td><input type="text" size="70" id="InputLatitude" placeholder="Latitude" name="latitude" value="{{ $bank->latitude }}"></td>
                        </tr>
                        <tr>
                            <td><label for="InputLongitude">Longitude</label></td>
                            <td><input type="text" size="70" id="InputLongitude" placeholder="Longitude" name="longitude" value="{{ $bank->longitude }}"></td>
                        </tr>
                    </table>

                    <br>

                    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

                    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                    <style>
                        #map {
                            height: 400px;
                        }
                    </style>

                    <div id="map"></div>

                </div>

                <div class="card-footer">
                    <button type="button" class="btn btn-success" id="simpanButton">Simpan</button>
                    <a href="{{ route('banks.index') }}" class="btn btn-default">Batal</a>
                </div>
            </div>
        </div>
    </div>
</form>
@stop

@push('js')
<script>
    var latitude = <?= $bank->latitude ?>;
    var longitude = <?= $bank->longitude ?>;
    // Inisialisasi peta menggunakan Leaflet
    var map = L.map('map').setView([latitude, longitude], 18);
    // Menambahkan layer peta dari Google Maps menggunakan Leaflet
    L.tileLayer('https://{s}.google.com/vt?/lyrs=p&x={x}&y={y}&z={z}', {
        maxZoom: 19,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        // attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    // //MARKER

    var marker = L.marker([latitude, longitude]).addTo(map); // Variabel untuk menyimpan marker

    // Menangkap event klik pada peta
    map.on('click', function onMapClick(e) {
        // Mendapatkan koordinat dari event klik
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;

        // Mengisi nilai input latitude dan longitude
        document.getElementById('InputLatitude').value = lat;
        document.getElementById('InputLongitude').value = lng;

        // Menghapus marker sebelumnya jika ada
        if (marker) {
            map.removeLayer(marker);
        }
        marker = L.marker([lat, lng]).addTo(map); // Menambahkan marker baru pada peta
    });


    // //POLYLINE DENGAN MARKER

    // var markers = [];           // Variabel untuk menyimpan array marker
    // var polylineWithMarker;     // Variabel untuk menyimpan polyline

    // // Menangkap event klik pada peta
    // map.on('click', function onMapClick(e) {
    //     // Mendapatkan koordinat dari event klik
    //     var lat = e.latlng.lat;
    //     var lng = e.latlng.lng;

    //     // Mengisi nilai input latitude dan longitude
    //     document.getElementById('InputLatitude').value = lat;
    //     document.getElementById('InputLongitude').value = lng;

    //     // Membuat marker baru untuk setiap klik
    //     var marker = L.marker([lat, lng]).addTo(map);
    //     markers.push(marker);

    //     // Menghapus polyline sebelumnya jika ada
    //     if (polylineWithMarker) {
    //         map.removeLayer(polylineWithMarker);
    //     }
    //     polylineWithMarker = L.polyline(markers.map(marker => marker.getLatLng()), { color: 'red' }).addTo(map);     // Membuat atau memperbarui polyline dengan posisi marker
    // });

    // //POLYLINE TANPA MARKER

    // var lineArrayWithoutMarker = [];    // Variabel untuk menyimpan array titik polyline
    // var polylineWithoutMarker;          // Variabel untuk menyimpan polyline

    // // Menangkap event klik pada peta
    // map.on('click', function onMapClick(e) {
    //     // Mendapatkan koordinat dari event klik
    //     var lat = e.latlng.lat;
    //     var lng = e.latlng.lng;

    //     // Mengisi nilai input latitude dan longitude
    //     document.getElementById('InputLatitude').value = lat;
    //     document.getElementById('InputLongitude').value = lng;

    //     // Menambahkan titik ke array titik polyline
    //     lineArrayWithoutMarker.push([lat, lng]);

    //     // Menghapus polyline sebelumnya jika ada
    //     if (polylineWithoutMarker) {
    //         map.removeLayer(polylineWithoutMarker);
    //     }
    //     polylineWithoutMarker = L.polyline(lineArrayWithoutMarker, { color: 'red' }).addTo(map);        // Membuat atau memperbarui polyline tanpa marker
    // });

    // //POLYGON DENGAN MARKER

    // var markersForPolygon = [];     // Variabel untuk menyimpan array marker
    // var polygonWithMarker;          // Variabel untuk menyimpan polygon

    // // Menangkap event klik pada peta
    // map.on('click', function onMapClick(e) {
    //     // Mendapatkan koordinat dari event klik
    //     var lat = e.latlng.lat;
    //     var lng = e.latlng.lng;

    //     // Mengisi nilai input latitude dan longitude
    //     document.getElementById('InputLatitude').value = lat;
    //     document.getElementById('InputLongitude').value = lng;

    //     // Membuat marker baru untuk setiap klik
    //     var marker = L.marker([lat, lng]).addTo(map);
    //     markersForPolygon.push(marker);

    //     // Menghapus polygon sebelumnya jika ada
    //     if (polygonWithMarker) {
    //         map.removeLayer(polygonWithMarker);
    //     }
    //     polygonWithMarker = L.polygon(markersForPolygon.map(marker => marker.getLatLng()), { color: 'red' }).addTo(map);        // Membuat atau memperbarui polygon dengan posisi marker
    // });

    // //POLYGON TANPA MARKER

    // var lineArrayWithoutMarkerForPolygon = [];  // Variabel untuk menyimpan array titik polygon
    // var polygonWithoutMarker;                   // Variabel untuk menyimpan polygon

    // // Menangkap event klik pada peta
    // map.on('click', function onMapClick(e) {
    //     // Mendapatkan koordinat dari event klik
    //     var lat = e.latlng.lat;
    //     var lng = e.latlng.lng;

    //     // Mengisi nilai input latitude dan longitude
    //     document.getElementById('InputLatitude').value = lat;
    //     document.getElementById('InputLongitude').value = lng;

    //     // Menambahkan titik ke array titik polygon
    //     lineArrayWithoutMarkerForPolygon.push([lat, lng]);

    //     // Menghapus polygon sebelumnya jika ada
    //     if (polygonWithoutMarker) {
    //         map.removeLayer(polygonWithoutMarker);
    //     }
    //     polygonWithoutMarker = L.polygon(lineArrayWithoutMarkerForPolygon, { color: 'red' }).addTo(map);    // Membuat atau memperbarui polygon tanpa marker
    // });

    // // CIRCLE

    // var markerForCircle;    // Variabel untuk menyimpan marker
    // var circle;             // Variabel untuk menyimpan lingkaran

    // // Menangkap event klik pada peta
    // map.on('click', function onMapClick(e) {
    //     // Mendapatkan koordinat dari event klik
    //     var lat = e.latlng.lat;
    //     var lng = e.latlng.lng;

    //     // Mengisi nilai input latitude dan longitude
    //     document.getElementById('InputLatitude').value = lat;
    //     document.getElementById('InputLongitude').value = lng;

    //     // Menghapus marker sebelumnya jika ada
    //     if (markerForCircle) {
    //         map.removeLayer(markerForCircle);
    //     }
    //     // Menghapus lingkaran sebelumnya jika ada
    //     if (circle) {
    //         map.removeLayer(circle);
    //     }
    //     markerForCircle = L.marker([lat, lng]).addTo(map);     // Membuat marker baru untuk posisi klik
    //     circle = L.circle([lat, lng], { color: 'green', radius: 50 }).addTo(map);        // Membuat lingkaran dengan radius 50
    // });

    document.getElementById('simpanButton').addEventListener('click', function() {
        // Validasi kolom tidak boleh kosong
        var namaBank = document.getElementById('InputNama').value;
        var alamatBank = document.getElementById('InputAlamat').value;
        var latitude = document.getElementById('InputLatitude').value;
        var longitude = document.getElementById('InputLongitude').value;

        if (!namaBank || !alamatBank || !latitude || !longitude) {
            Swal.fire({
                title: 'Data Tidak Lengkap',
                text: 'Harap lengkapi semua kolom sebelum menyimpan!',
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
            return; // Hentikan proses jika ada kolom yang kosong
        }

        Swal.fire({
            title: 'Simpan Perubahan Bank',
            text: 'Apakah Anda yakin ingin menyimpan perubahan bank?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Simpan!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('bankForm').submit();
            }
        });
    });
</script>
@endpush