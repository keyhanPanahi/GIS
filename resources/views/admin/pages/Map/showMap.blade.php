@extends('admin.layouts.master')

@section('title','مکان ها - نقشه')

@section('vendor-css')
    <!--map -->
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/leaflet/leaflet.css') }}"/>
@endsection

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a class="text-primary" href="{{ route('admin.dashboard') }}">داشبورد</a></li>
        <li class="breadcrumb-item"><a class="text-primary" href="{{ route('admin.place.index') }}">فهرست مکان</a></li>
        <li class="breadcrumb-item active">نقشه</li>
    </ol>


    <div class="card mt-3">
        <div class="card-body">

            <div class="col-md-12 mb-3" data-select2-id="45">
                <div id="map" style="height: 550px; border-radius: 15px;"></div>
            </div>

        </div>
    </div>
@endsection

@section('vendor-js')

    <!--map -->
    <script src="{{ asset('admin-assets/vendor/libs/leaflet/leaflet.js') }}"></script>
    <script>

        const map = L.map('map').setView([32.854799, 59.217939], 14);

        const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);


    </script>

    @foreach ($points as $point)

        <script>
            L.marker([{{$point->point}}]).addTo(map)
                .bindPopup('<b> {{ $point->owner_fname . ' ' . $point->owner_lname }} </b> ');

        </script>
    @endforeach

@endsection

