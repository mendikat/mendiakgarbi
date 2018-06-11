<!DOCTYPE html>
<html lang="{{$lang}}" prefix="og: http://ogp.me/ns#">
<head>
<title>{{$app_name}} &rarr; {{$page_title}}</title>
@include('sections/head/meta') {{-- The meta tags section --}}
@section('css')
@show {{-- The custom css --}}
<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->   
</head>
<body>

@section('body')
@show {{-- The custom body --}}

@include('sections/scripts') {{-- The application main scripts --}}    
@section('scripts')
@show {{-- The custom scripts --}}
</body>
</html>
