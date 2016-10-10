<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    <meta name="description" content="@yield('meta_description')">
    <meta name="keywords" content="@yield('meta_keywords')">
    <meta name="author" content="@yield('meta_author')">
    
    <!-- Styles -->
    {{ Html::style( '/css/all.css' ) }}

    {{-- Views Style Sheets --}}
    @stack('styles')

    <!-- Javascript -->
    <script>
        
        // Global Javascript Variables
        var baseUrl = '{{ URL::to('/') }}';

        // Register Routes
        @if( isset($routes) )
            var routes = JSON.parse( '{!! json_encode( $routes ) !!}' );
        @endif

        // Register Token
        var csrfToken = '{{ csrf_token() }}';

    </script>

    {{ Html::script( '/js/all.js' ) }}

</head>
<body class="topnav-fixed">

    <!-- WRAPPER -->
    <div id="wrapper" class="wrapper">
        {{-- To Navbar --}}
        @include( 'includes.topnav' )
       
        <!-- MAIN CONTENT WRAPPER -->
        <div id="main-content-wrapper" class="content-wrapper">
            
            {{-- Main Content --}}
            @include( 'includes.maincontent' )
        
            {{-- Footer --}}
            @include( 'includes.footer' )

        </div>
        <!-- END CONTENT WRAPPER -->

    </div>

    <!-- JavaScripts -->
    @stack( 'scripts' )
    {{-- {{ Html::script( '/js/script.js' ) }} --}}
    {{ Html::script( '/js/script.min.js' ) }}
    
</body>
</html>