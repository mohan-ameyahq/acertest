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
        <h2>ACER - Reports</h2>
        <p>
            <a href="/reports" class="btn btn-primary my-2">Reports</a>
            <a href="/tests" class="btn btn-secondary my-2">Tests</a>
        </p></div>
    <div class="container">
        <div class="row">

            <form
                id="reportForm"
                action="{{ route('getReports') }}"
                method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>
                <div class="row">
                    <div class="container">
                        <label for="studentList" class="form-label fw-bold">Select Student:</label>
                        <input name="studentid" class="form-control" onchange="resetIfInvalid(this);"
                               list="studentOptions"
                               id="studentList" required placeholder="Type student ID or Name...">
                        <datalist id="studentOptions">
                            @foreach ($studentsList as $student)
                                <option
                                    value="{{$student['id']}}"> {{$student['firstName']}} {{$student['lastName']}}  </option>
                            @endforeach
                        </datalist>

                        <div class="mt-4"></div>
                        <label for="reportList" class="form-label fw-bold">Select Report:</label>
                        <select name="reportid" class="form-select" aria-label="reportSelect" required>

                            <option value="1">Diagnostic</option>
                            <option value="2">Progress</option>
                            <option value="3">Feedback</option>
                        </select>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <button
                        type="submit"
                        class="uppercase btn btn-success btn-round m-auto p-2">
                        Get Report
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function resetIfInvalid(el) {
        //just for beeing sure that nothing is done if no value selected
        if (el.value == "")
            return;
        var options = el.list.options;
        for (var i = 0; i < options.length; i++) {
            if (el.value == options[i].value)
                //option matches: work is done
                return;
        }
        //no match was found: reset the value
        el.value = "";
    }
</script>

</body>
</html>
