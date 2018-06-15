@extends('layouts/home') {{-- Load the master layout --}}
@section('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key={{$app_google_maps_key}}"></script>
<script src="resources/js/main.js"></script>
<script src="resources/js/home.js"></script>
@stop