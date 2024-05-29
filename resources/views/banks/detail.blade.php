<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Detail Bank BNI</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.svg" />

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <style>
        #map {
            height: 300px;
        }
    </style>
</head>

<body style="background-color: #ff6b81;">
    <!-- Start Bank Detail Section -->
    <section id="bankDetail" class="about-info-area section-gap">
        <div class="container" style="padding-top: 120px;">
            <div class="row">
                <div class="col-md-7" data-aos="fade-up" data-aos-delay="200">
                    <div class="card panel panel-info panel-dashboard">
                        <div class="card-header centered">
                            <h2 class="card-title panel-title text-center"><strong>Bank Detail</strong></h2>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th>Detail</th>
                                </tr>
                                <tr>
                                    <td>Nama Bank</td>
                                    <td>
                                        <h5>{{ $bank->namabank }}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>
                                        <h5>{{ $bank->alamat }}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jam Operasional</td>
                                    <td>
                                        <h5>{{ $bank->jam_operasional }}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Call Center</td>
                                    <td>
                                        <h5>{{ $bank->call_center }}</h5>
                                    </td>
                                </tr>
                            </table>
                            <!-- Tombol Back -->
                            <div class="text-right mt-3">
                                <a href="{{ route('welcome') }}" class="btn btn-warning">Back</a>
                            </div>
                            <!-- Akhir Tombol Back -->
                        </div>
                    </div>
                </div>

                <div class="col-md-5" data-aos="zoom-in">
                    <div class="card panel panel-info panel-dashboard">
                        <div class="card-header centered">
                            <h2 class="card-title panel-title text-center"><strong>Lokasi</strong></h2>
                        </div>
                        <div class="card-body">
                            <!-- Elemen untuk peta -->
                            <div id="map" style="width:100%; height:467px;"></div>
                            <!-- Akhir Elemen untuk peta -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- End Bank Detail Section -->

    <!-- ========================= JS here ========================= -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>

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
</script>

</html>