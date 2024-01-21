<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Acer - Reports</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/d3.v4.js"></script>


</head>
<body class="bg-light">
<div class="container">
    <div class="py-3 text-center">

        <h2>ACER - Progress Reports</h2>


        <p> {{$reportData['studentname']}} has completed Numeracy assessment {{count($reportData['data'])}} times in
            total. Date and raw score given below:</p>
        <p>
        @foreach ($reportData['data'] as $data)
            <p>Date: {{$data['finished'] }} , Raw Score: {{ $data['rawscore']}} out of {{ $data['total']}} </p>
            @endforeach

            </p>

            <p>Tony Stark got 9 more correct in the recent completed assessment than the oldest</p>


    </div>

    <div class="container">
        <div class="py-3 text-center">

            <p>
                <a href="/reports" class="btn btn-primary">Back to Reports</a>
            </p>
        </div>

    </div>
</div>


</body>
</html>
