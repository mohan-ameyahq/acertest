<?php


namespace App\Services;

use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class ProgressReport
{

    function getData($data)
    {
        $studentsList = File::json(public_path() . '/data/students.json', JSON_THROW_ON_ERROR);
        $assessmentsList = File::json(public_path() . '/data/assessments.json', JSON_THROW_ON_ERROR);
        $studentResponsesList = File::json(public_path() . '/data/student-responses.json', JSON_THROW_ON_ERROR);
        $questionsList = File::json(public_path() . '/data/questions.json', JSON_THROW_ON_ERROR);

        $studentKey = array_search($data['studentid'], $studentsList);

//        dd($studentResponsesList);
        $students = array();
        $assessments = array();
        foreach ($studentResponsesList as $studentResponse) {
            if ($studentResponse['student']['id'] !== $data['studentid'])
                continue;
            else {
                if (isset($studentResponse['completed'])) {
                    $ts = Carbon::createFromFormat('d/m/Y H:i:s', $studentResponse['completed']);
                    $studentResponse['timestamp'] = $ts->timestamp;
                    $studentResponse['finished'] = $ts->format('d M Y H:i');;
                    $studentResponse['rawscore'] = $studentResponse['results']['rawScore'];
                    $studentResponse['total'] = count($questionsList);
                } else {
                    continue;
                }
                $students[] = $studentResponse;
            }

        }
        usort($students, function ($a, $b) {
            return $b['timestamp'] <=> $a['timestamp'];
        });

        $report['data'] = $students;

//        dd($studentsList);
//        $completedDate = Carbon::createFromFormat('d/m/Y H:i:s', $recentAssessment['completed']);
//        $completedDate= $completedDate->format('d M Y H:i');
        $report['studentname'] = $studentsList[$studentKey]['firstName'] . ' ' . $studentsList[$studentKey]['lastName'];
        $report['totalcompleted'] = count($students);
//        $report['completeddate']=$completedDate;
        return $report;

    }
}
