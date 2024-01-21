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

        <h2>ACER - Diagnostic Reports</h2>
        <p>{{$reportData['studentname']}} recently completed Numeracy assessment
            on {{$reportData['completeddate']}} </p>
        <p> He got {{$reportData['correct']}} questions right out of {{$reportData['total']}}. Details by strand given
            below:
        @foreach ($reportData['stats'] as $key=>$val)
            <p>{{$key}} : {{$val['correct'] }} out of {{$val['total'] }} </p>
        @endforeach
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
