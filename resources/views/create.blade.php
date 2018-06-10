@extends('layouts/simple') {{-- Load the simple layout --}}
@section('scripts')
<script src="resources/js/create.js"></script>
<script src="resources/vendor/holdon/HoldOn.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{$app_google_maps_key}}"></script>
<script src="https://www.google.com/recaptcha/api.js?hl={{$lang}}"></script>
@stop