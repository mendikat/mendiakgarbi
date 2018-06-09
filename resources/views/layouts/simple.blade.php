<!DOCTYPE html>
<html lang="{{$lang}}">
<head>
<title>{{$app_name}} &rarr; {{$page_title}}</title>
@include('sections/head/meta') {{-- The meta tags section --}}
@include('sections/head/css') {{-- The application main css files --}}
<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->   
</head>
<body class="mobile-shift">
@include('sections/body/header') {{-- The header section --}}

@include('sections/body/form') {{-- The form section --}}

@include('sections/body/footer') {{-- The footer section --}}

@include('sections/scripts') {{-- The application main scripts --}}    
@section('scripts')
@show {{-- The custom scripts --}}
</body>
</html>
