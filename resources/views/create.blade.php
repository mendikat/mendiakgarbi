@extends('layouts/simple') {{-- Load the simple layout --}}
@section('scripts')
<script src="resources/js/create.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{$app_google_maps_key}}"></script>
@stop