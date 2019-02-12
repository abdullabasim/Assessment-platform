<?php

namespace App\Helper;

use Illuminate\Http\Request;
use App\Models\UserAnswer AS UserAnswerModel;
use Carbon\Carbon;
use Auth;
use App\Models\EnglishQuestion AS EnglishQuestionModel;
use App\Models\EnglishQuestionAnswer AS EnglishQuestionAnswerModel;
use App\Models\PersonalUserAnswer AS personalUserAnswerModel;
use App\Models\PersonalQuestionAnswer AS personalQuestionAnswerModel;
use App\Models\MsQuestionAnswer as MsQuestionAnswerModel;
use App\Models\MsUserAnswer as MsUserAnswerModel;
use App\User as userModel;
use App\Models\Exam AS ExamModel;
use App\Models\ExamQuestion AS ExamQuestionModel;
use App\Models\PersonalExamQuestion AS PersonalExamQuestionModel;
use App\Models\MsQuestionExam AS MsExamQuestionModel;

Class Helper {


    public static function getEvaCheckerEnglish($exam_id)
    {
        $request = "";

        $checker = UserAnswerModel::where('exam_id',$exam_id)
                                   ->WhereHas('englishQuestion',function ( $query )use ( $request ){
                                   $query->where('english_question_type_id', 2 );
                                   })
                                   ->whereNull('score')->first();



        if($checker != null)
        {

            return "Please Correct the Candidate Answers";
        }
        else
        {
            return UserAnswerModel::where('exam_id',$exam_id)->
                                   where('score','>',0)
                                   ->sum('score');
        }

    }

    public static function getEvaCheckerPersonal($exam_id)
    {

        $request = "";

        $checker = personalUserAnswerModel::where('personal_exam_id',$exam_id)

            ->whereNull('score')->first();


       // dd($checker);
        if($checker != null)
        {
           // dd("aaaa");
            return "Please Correct the Candidate Answers";
        }
        else
        {



            return  personalUserAnswerModel::where('personal_exam_id',$exam_id)->
            where('score','>',0)
                ->sum('score');
        }

    }

    public static function getEvaCheckerMs($exam_id)
    {

        $request = "";

        $checker = MsUserAnswerModel::where('ms_exam_id',$exam_id)

            ->whereNull('score')->first();



        if($checker != null)
        {
            return "Please Correct the Candidate Answers";
        }
        else
        {
            $correct = MsUserAnswerModel::where('ms_exam_id',$exam_id)->
            where('score','>',0)->
            get();


            return  MsUserAnswerModel::where('ms_exam_id',$exam_id)->
            where('score','>',0)
                ->sum('score');
        }

    }

    public static function evaCheckerEnglish($exam_id)
    {


        $chkecker = UserAnswerModel::where('exam_id',$exam_id)
                                    ->first();

        if($chkecker != null)
        {
            return false;
        }
        else
        {
            return true;
        }

    }

    public static function evaCheckerPersonals($exam_id)
    {


        $chkecker = personalUserAnswerModel::where('personal_exam_id',$exam_id)
            ->first();


        if($chkecker != null)
        {
            return false;
        }
        else
        {
            return true;
        }

    }

    public static function evaCheckerMs($exam_id)
    {


        $chkecker = MsUserAnswerModel::where('ms_exam_id',$exam_id)
            ->first();


        if($chkecker != null)
        {
            return false;
        }
        else
        {
            return true;
        }

    }

    public static function  getCorrectAnswer($id)
    {
        $answer= EnglishQuestionAnswerModel::where('english_question_id',$id)
                        ->first();

        switch ($answer->correct)
        {
            case 'answer1':

                return $answer->answer1;
                break;

            case 'answer2':


                return $answer->answer2;
                break;

            case 'answer3':

                return $answer->answer3;
                break;

            case 'answer4':

                return $answer->answer4;
                break;
        }



    }

    public static function  getCorrectAnswerPersonal($id)
    {
       // dd($id);
        $answer= personalQuestionAnswerModel::where('personal_question_id',$id)
            ->first();



        switch ($answer->correct)
        {
            case 'answer1':

                return $answer->answer1;
                break;

            case 'answer2':


                return $answer->answer2;
                break;

            case 'answer3':

                return $answer->answer3;
                break;

            case 'answer4':

                return $answer->answer4;
                break;
        }



    }

    public static function  getUserAnswer($examId , $questionId)
    {
        $userAnswer= UserAnswerModel::where('exam_id',$examId)
                                        ->where('english_question_id',$questionId)
                                        ->first();
        if($userAnswer != null)
        return $userAnswer->answer;
        else
            return"";

    }

    public static function  getUserAnswerPersonal($examId , $questionId)
    {
      //  dd("aaa");
        $userAnswer= personalUserAnswerModel::where('personal_exam_id',$examId)
            ->where('personal_question_id',$questionId)
            ->first();
        if($userAnswer != null)
            return $userAnswer->answer;
        else
            return"";

    }


    public static function  getScore($examId , $questionId)
    {
        $userAnswer= UserAnswerModel::where('exam_id',$examId)
            ->where('english_question_id',$questionId)
            ->first();

        if($userAnswer != null)
        return $userAnswer->score;
        else
            return"";
    }

    public static function  getScorePersonal($examId , $questionId)
    {

        $userAnswer= personalUserAnswerModel::where('personal_question_id',$questionId)->
                                                  where('personal_exam_id',$examId)
                                                    ->first();

        if($userAnswer != null)
            return $userAnswer->score;
        else
            return"";
    }


    public static function  getCorrectAnswerMs($id)
    {
        // dd($id);
        $answer= MsQuestionAnswerModel::where('ms_question_id',$id)
            ->first();



        switch ($answer->correct)
        {
            case 'answer1':

                return $answer->answer1;
                break;

            case 'answer2':


                return $answer->answer2;
                break;

            case 'answer3':

                return $answer->answer3;
                break;

            case 'answer4':

                return $answer->answer4;
                break;
        }



    }

    public static function  getUserAnswerMs($examId , $questionId)
    {

     //   dd($examId."aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa");
        $userAnswer= MsUserAnswerModel::where('ms_exam_id',$examId)
            ->where('ms_question_id',$questionId)
            ->first();


        if($userAnswer != null)
            return $userAnswer->answer;
        else
            return"";

    }

    public static function  getScoreMs($examId , $questionId)
    {

        $userAnswer= MsUserAnswerModel::where('ms_question_id',$questionId)->
        where('ms_exam_id',$examId)
            ->first();

        if($userAnswer != null)
            return $userAnswer->score;
        else
            return"";
    }

    public static function getTotalScore($english,$personal,$ms)
    {
        $sum = 0;

        if(is_numeric($english))
            $sum += $english;
        else
            return "Please correct the Candidate Answers";

        if(is_numeric($personal))
            $sum += $personal;
        else
            return "Please correct the Candidate Answers";

        if(is_numeric($ms))
            $sum += $ms;
        else
            return "Please correct the Candidate Answers";

        return $sum;
    }

    public static function getResult($score)
    {
        if($score > 0 && $score <= 20)
            return "Beginner";
        elseif($score >= 21 && $score <= 32)
            return "Intermediate";
        elseif($score >= 33 && $score <= 40 )
            return "Advance";

    }


    public static function assignEnglishExamChecker($id)
    {
        $user = userModel::find($id);

        $exam = examModel::where('user_id',$user->id)->first();


        if($exam == null)
        {
            return "not have exam";
        }

        if(examQuestionModel::where('exam_id',$exam->id)->first() != null)
            return "have exam";
        else
            return "not have exam";

    }

    public static function assignPersonalExamChecker($id)
    {
        $user = userModel::find($id);

        $exam = examModel::where('user_id',$user->id)->first();


        if($exam == null)
        {
            return "not have exam";
        }

        if(PersonalExamQuestionModel::where('exam_id',$exam->id)->first() != null)
            return "have exam";
        else
            return "not have exam";

    }

    public static function assignMsExamChecker($id)
    {
        $user = userModel::find($id);

        $exam = examModel::where('user_id',$user->id)->first();


        if($exam == null)
        {
            return "not have exam";
        }

        if(MsExamQuestionModel::where('ms_exam_id',$exam->id)->first() != null)
            return "have exam";
        else
            return "not have exam";

    }

}