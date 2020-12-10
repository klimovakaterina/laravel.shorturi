<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Short Uri</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    </head>
    <body class="antialiased">
        <div class="container p-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <form action="{{ route('short_uri') }}" method="POST">
                @csrf
              <div class="form-group">
                <label for="long_url" class="font-weight-bold">Add url</label>
                <input type="text" class="form-control" id="long_url" name="long_url">
              </div>
              <button type="submit" class="btn btn-primary">Add short uri</button>
            </form>

            @if(count($urls) > 0)
                <h1 class="mt-5">All Urls</h1>
                <ul>
                @foreach($urls as $url)
                        <li><a href="{{ route('get_url', $url->short_url ) }}">http://{{ $url->short_url  }}</a></li>
                 @endforeach
                </ul>
             @endif
        </div>
    </body>
</html>
