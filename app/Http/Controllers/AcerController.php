<?php

namespace App\Http\Controllers;

use App\Services\DiagnosticReport;
use App\Services\FeedbackReport;
use App\Services\ProgressReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Mpdf\Tag\Progress;

class AcerController extends Controller
{

    public function Reports()
    {
        $studentsList = File::json(public_path() . '/data/students.json', JSON_THROW_ON_ERROR);
        return view('reports', compact(['studentsList']));
    }

    public function Tests()
    {
        $studentsList = File::json(public_path() . '/data/students.json', JSON_THROW_ON_ERROR);
        return view('tests', compact(['studentsList']));
    }

    public function getReports(Request $request)
    {
        $studentId = $request->input('studentid');
        $reportId = $request->input('reportid');
        $data = array("studentid" => $studentId,
            "reportid" => $reportId);
        switch ($reportId) {
            case 1:
                $reportService = new DiagnosticReport();
                $view = 'partials/diagnostic';
                break;
            case 2:
                $reportService = new ProgressReport();
                $view = 'partials/progress';
                break;
            case 3:
                $reportService = new FeedbackReport();
                $view = 'partials/feedback';
                break;
        }
        $reportData = $reportService->getData($data);
        return view($view, compact(['reportData']));

    }

    public function getTests()
    {


    }

    public function Report()
    {


    }
}
