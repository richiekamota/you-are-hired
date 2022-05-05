<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>MZT test assignment</title>
        <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600;700&display=swap" rel="stylesheet">
      <style>
        body {
          font-family: 'Roboto', sans-serif;
        }
     </style>
     <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <h3>You Are Hired</h3>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">                        
                        <li class="nav-item dropdown">
                            <select id="mySelect" onchange="companyTrack()">  
                                @if (request()->get('id') == NULL))                            
                                <option selected="selected" value="">Select your company</option>   
                                @endif
                                @foreach ($companies as $company)                                          
                                    <option <?php echo request()->get('id') == $company->id ? 'selected' : ''; ?> value="{{$company->id}}">{{$company->name}}</option>
                                @endforeach                                                             
                            </select>
                        </li>                               
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script>
        function companyTrack() {
        var id = document.getElementById("mySelect").value;
        document.location.replace('/home?&id='+id);
        }
    </script>
</body>
</html>
