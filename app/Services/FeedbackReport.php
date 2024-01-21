<?php


namespace App\Services;

use Illuminate\Support\Facades\File;
use Carbon\Carbon;


class FeedbackReport
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
                } else {
                    $studentResponse['timestamp'] = NULL;
                }
                $students[] = $studentResponse;
            }

        }
        usort($students, function ($a, $b) {
            return $b['timestamp'] <=> $a['timestamp'];
        });

        $recentAssessment = $students[0];
        $response = array();
        foreach ($recentAssessment['responses'] as $resp) {
            $response[$resp['questionId']] = $resp['response'];
        }
        $strandCounts = array_count_values(
            array_column($questionsList, 'strand')
        );
        $report = array();
//        foreach($strandCounts as $key=>$val)
//        {
//            $report['stats'][$key]['total']=$val;
//            $report['stats'][$key]['wrong']=0;
//
//
//        }
        $correct = 0;
        $wrongList = array();
        foreach ($questionsList as $question) {
            $ansKey = $response[$question['id']];
            $correctKey = $question['config']['key'];
            if ($correctKey !== $ansKey) {

                $temp = array();
                $temp['question'] = $question['stem'];
                $options = $question['config']['options'];
//                dd($options);

                $arr = array_filter($options, function ($ar) use ($correctKey) {
//                    dd($ar);
                    return ($ar['id'] == $correctKey);
                    //return ($ar['name'] == 'cat 1' AND $ar['id'] == '3');// you can add multiple conditions
                });
                $arr = array_values($arr);

                $temp['correctanswer'] = $arr[0]['label'] . ' with value ' . $arr[0]['label'];
                $arr = array_filter($options, function ($ar) use ($ansKey) {
//                    dd($ar);
                    return ($ar['id'] == $ansKey);
                    //return ($ar['name'] == 'cat 1' AND $ar['id'] == '3');// you can add multiple conditions
                });
                $arr = array_values($arr);

                $temp['youranswer'] = $arr[0]['label'] . ' with value ' . $arr[0]['label'];
                $temp['hint'] = $question['config']['hint'];
                $wrongList[] = $temp;
//                $correct++;
//                $report['stats'][$question['strand']]['wrong']++;
            } else {
                $correct++;
            }
        }
        $report['data'] = $wrongList;
        $completedDate = Carbon::createFromFormat('d/m/Y H:i:s', $recentAssessment['completed']);
        $completedDate = $completedDate->format('d M Y H:i');
        $report['studentname'] = $studentsList[$studentKey]['firstName'] . ' ' . $studentsList[$studentKey]['lastName'];
        $report['total'] = count($questionsList);
        $report['completeddate'] = $completedDate;
        $report['correct'] = $correct;

        return $report;


    }


}
