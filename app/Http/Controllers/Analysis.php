<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use Illuminate\Http\Request;
use App\User as userModel;
use App\Models\ExamQuestion AS ExamQuestionModel;
use App\Models\PersonalExamQuestion AS PersonalExamQuestionModel;
use App\Models\MsQuestionExam AS MsQuestionExamModel;
use App\Models\UserAnswer AS UserAnswerModel;
use App\Models\MsUserAnswer AS MsUserAnswerModel;
use App\Models\PersonalUserAnswer AS PersonalUserAnswerModel;
use App\Models\Exam AS ExamModel;
use function PHPSTORM_META\type;

class Analysis extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function main()
    {
        if(\Auth::user()->permission != "Admin")
            abort(404);

        $notMadeExam = 0;

        $allCandidates =userModel::where('permission','Candidate')->get();

        $totalCandidates = userModel::where('permission','Candidate')->count();

        $englishTotalCandidates = ExamQuestionModel::select('exam_id')->distinct()->get()->count();

        $personalTotalCandidates = PersonalExamQuestionModel::select('exam_id')->distinct()->get()->count();

        $msTotalCandidates = MsQuestionExamModel::select('ms_exam_id')->distinct()->get()->count();

        $madeEnglishExamTotal = UserAnswerModel::select('exam_id')->distinct()->get()->count();

        $madePersonalExamTotal =PersonalUserAnswerModel::select('personal_exam_id')->distinct()->get()->count();

        $madeMsExamTotal =MsUserAnswerModel::select('ms_exam_id')->distinct()->get()->count();

        foreach ($allCandidates as $allCandidate)
        {
            $exam = ExamModel::where('user_id',$allCandidate->id)->first();

            if($exam == null)
                $notMadeExam ++;


        }

        $results =  $this->resultChart();






        return view('analysis.analysis',[
            'totalCandidates'=>$totalCandidates,
            'englishTotalCandidates'=>$englishTotalCandidates,
            'msTotalCandidates'=>$msTotalCandidates,
            'personalTotalCandidates'=>$personalTotalCandidates,
            'madeEnglishExamTotal'=>$madeEnglishExamTotal,
            'madePersonalExamTotal'=>$madePersonalExamTotal,
            'madeMsExamTotal'=>$madeMsExamTotal,
            'results'=>$results,
            'notMadeExam'=>$notMadeExam
        ]);
    }

    protected function resultChart()
    {
        if(\Auth::user()->permission != "Admin")
            abort(404);

        $exams = ExamModel::get();

        $results['Beginner'] = 0;
        $results['Intermediate'] = 0;
        $results['Advance'] = 0;


        foreach ($exams as $exam)
        {
           $englishExam = UserAnswerModel::where('exam_id',$exam->id)->whereNotNull('score')->sum('score');



           $personalExam = PersonalUserAnswerModel::where('personal_exam_id',$exam->id)->whereNotNull('score')->sum('score');

           $msExam = MsUserAnswerModel::where('ms_exam_id',$exam->id)->whereNotNull('score')->sum('score');

          $score =  Helper::getTotalScore($englishExam,$personalExam,$msExam);

          $result = Helper::getResult($score);



          if($result == 'Beginner')
              $results['Beginner'] +=  1;
          elseif($result == 'Intermediate')
              $results['Intermediate']  +=  1;
          elseif($result == 'Advance')
              $results['Advance']  +=  1;






        }

        $res = [];
        $res[] = [
            'title'=>'Beginner',
            'litres'=>$results['Beginner']
        ];


       $res[]= ['title'=>'Intermediate','litres'=>$results['Intermediate']];

       $res[]= ['title'=>'Advance','litres'=>$results['Advance']];

      //dd($res);
        return $res;

    }

}
