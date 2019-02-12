<?php

namespace App\Http\Controllers;

use App\Models\PersonalQuestionAnswer as PersonalQuestionAnswerModel;
use Illuminate\Http\Request;
use App\Models\EnglishQuestionPart AS EnglishQuestionPartModel;
use App\Models\EnglishQuestionType AS EnglishQuestionTypeModel;
use App\Models\QuestionLevel AS QuestionLevelModel;
use App\Models\EnglishMainQuestion AS EnglishMainQuestionModel;
use App\Models\EnglishQuestion AS EnglishQuestionModel;
use App\Models\EnglishQuestionAnswer AS EnglishQuestionAnswerModel;
use App\Models\PersonalUserAnswer AS PersonalUserAnswerModel;
use App\Models\Exam AS ExamModel;
use App\Models\ExamQuestion AS ExamQuestionModel;
use App\Models\PersonalExamQuestion AS PersonalExamQuestionModel;
use App\Models\MsQuestionExam AS MsQuestionExamModel;
use App\Models\MsUserAnswer AS MsUserAnswerModel;
use App\Models\MsQuestionAnswer as MsQuestionAnswerModel;
use Excel;
use App\Exports\CollectionExport;
use App\Models\UserAnswer AS UserAnswerModel;
use App\User as userModel;
use Auth;
use App\Helper\Helper;
use App\Http\Requests\EnglishExam\saveAnswers AS saveAnswersRequest;
use App\Http\Requests\EnglishExam\CorrectAnswer AS correctAnswerRequest;

use App\Http\Requests\PersonalQuestion\SavePersonalAnswer as SavePersonalAnswerRequest;
use App\Http\Requests\MsExam\SaveMsAnswer as SaveMsAnswerRequest;

use App\Models\PersonalQuestion AS PersonalQuestionModel;
use App\Models\MsQuestion AS MsQuestionModel;
use App\Models\MsQuestionExam AS MsExamQuestionModel;
use Carbon\Carbon;

class Exam extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //candidate
    public function userExamPage()
    {
        if (Auth::user()->permission == "Candidate") {

            $exam = ExamModel::where('user_id', Auth::user()->id)->first();


            $english = false;

            $englishStatus = "";


            $personal = false;

            $personalStatus = "";

            $ms = false;

            $msStatus = "";

            if ($exam != null) {

                $english = true;

                $userAnswer = UserAnswerModel::where('exam_id', $exam->id)->first();

                $personalExamAnswer = PersonalUserAnswerModel::where('personal_exam_id', $exam->id)->first();

                $msExamAnswer = MsUserAnswerModel::where('ms_exam_id', $exam->id)->first();


                if(examQuestionModel::where('exam_id',$exam->id)->first() != null)
                {
                    if ($userAnswer != null) {
                        $englishStatus = "The Candidate is already make this exam ";
                    }
                    else
                        $englishStatus = "Can Exam";
                }


                if(PersonalExamQuestionModel::where('exam_id',$exam->id)->first() != null)
                {

                    if ($personalExamAnswer != null) {

                        $personalStatus = "The Candidate is already make this exam ";
                    }
                    else
                        $personalStatus = "Can Exam";
                }

                if(MsExamQuestionModel::where('ms_exam_id',$exam->id)->first() != null)
                {
                    if ($msExamAnswer != null) {
                        $msStatus = "The Candidate is already make this exam ";
                    }
                    else
                        $msStatus = "Can Exam";
                }

            }

            //  dd($msStatus);
//            if ($exam != null) {
//
//                $english = true;
//
//                $userAnswer = UserAnswerModel::where('exam_id', $exam->id)->first();
//
//                $personalExamAnswer = PersonalUserAnswerModel::where('personal_exam_id', $exam->id)->first();
//
//                $msExamAnswer = MsUserAnswerModel::where('ms_exam_id', $exam->id)->first();
//
//
//                if ($userAnswer != null) {
//                    $englishStatus = "The Candidate is already make this exam ";
//                }
//
//                if ($personalExamAnswer != null) {
//                    $personalStatus = "The Candidate is already make this exam ";
//                }
//
//                if ($msExamAnswer != null) {
//                    $msStatus = "The Candidate is already make this exam ";
//                }
//            }



            return view('exam.manage_candidate_exam', [
                'english' => $english,
                'englishStatus' => $englishStatus,
                'personal' => $personal,
                'personalStatus' => $personalStatus,
                'ms' => $ms,
                'msStatus' => $msStatus
            ]);


        }

        return redirect('/')
            ->with('error', 'You do not have permission to do this operation.');
    }
    //candidate
    public function setEnglishExam()
    {

        $exam = ExamModel::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get()[0];


        if ((Auth::user()->permission == "Candidate") && $exam != null) {

            if (UserAnswerModel::where('exam_id', $exam->id)->first() != null)
                return back()
                    ->with('error', 'You Have already made this Exam.');

            $request = "";
            $grammarEnglishQuestions = ExamQuestionModel::where('exam_id', $exam->id)->
            WhereHas('englishQuestion.englishMainQuestion', function ($query) use ($request) {
                $query->where('english_question_part_id', 1);
            })->get();


            $listeningEnglishQuestions = ExamQuestionModel::where('exam_id', $exam->id)->
            WhereHas('englishQuestion.englishMainQuestion', function ($query) use ($request) {
                $query->where('english_question_part_id', 3);
            })->get();

            $paragraphEnglishQuestions = ExamQuestionModel::where('exam_id', $exam->id)->
            WhereHas('englishQuestion.englishMainQuestion', function ($query) use ($request) {
                $query->where('english_question_part_id', 2);
            })->get();

            if($grammarEnglishQuestions->count() == 0 && $listeningEnglishQuestions->count() ==  0 && $paragraphEnglishQuestions->count() == 0)
                return redirect('/userExam')
                    ->with('error', 'You do not  Have  this Exam.');
            $counter = 1;
            return view('exam.english_exam', [
                'grammarEnglishQuestions' => $grammarEnglishQuestions,
                'listeningEnglishQuestions' => $listeningEnglishQuestions,
                'paragraphEnglishQuestions' => $paragraphEnglishQuestions,
                'counter' => $counter,
                'ex' => $exam->id
            ]);

        }

        return redirect('/setEnglishExam')
            ->with('error', 'You do not have permission to do this operation.');
    }
    //candidate
    public function setPersonalExam()
    {

        $exam = ExamModel::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get()[0];


        if ((Auth::user()->permission == "Candidate") && $exam != null) {

            $request = "";
            $personalExamQuestions = PersonalExamQuestionModel::where('exam_id', $exam->id)->
            get();


            if (PersonalUserAnswerModel::where('personal_exam_id', $exam->id)->first() != null)
                return back()
                    ->with('error', 'You Have already made this Exam.');

            if($personalExamQuestions->count() == 0)
                return redirect('/userExam')
                    ->with('error', 'You do not  Have  this Exam.');

            $counter = 1;
            return view('exam.personal_exam', [
                'personalExamQuestions' => $personalExamQuestions,
                'counter' => $counter,
                'ex' => $exam->id
            ]);

        }

        return back()
            ->with('error', 'You do not have permission to do this operation.');
    }
    //candidate
    public function setMsExam()
    {

        $exam = ExamModel::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get()[0];


        if ((Auth::user()->permission == "Candidate") && $exam != null) {

            $msExamQuestions = MsQuestionExamModel::where('ms_exam_id', $exam->id)->
            get();

            if (MsUserAnswerModel::where('ms_exam_id', $exam->id)->first() != null)
                return back()
                    ->with('error', 'You Have already made this Exam.');

            if($msExamQuestions->count() == 0)
                return redirect('/userExam')
                    ->with('error', 'You do not  Have  this Exam.');

            $counter = 1;
            return view('exam.ms_exam', [
                'msExamQuestions' => $msExamQuestions,
                'counter' => $counter,
                'ex' => $exam->id
            ]);

        }

        return back()
            ->with('error', 'You do not have permission to do this operation.');
    }
     //candidate
    public function englishExamAnswer(saveAnswersRequest $request)
    {
        //    dd($request->all());
        \DB::beginTransaction();
        try {
            foreach ($request->grammar as $key => $grammarItem) {
                $userAnswer = UserAnswerModel::create([
                    'english_question_id' => $key,
                    'answer' => $grammarItem,
                    'exam_id' => $request->dumy
                ]);

                $answer = EnglishQuestionAnswerModel::where('english_question_id', $key)->first();

                switch ($answer->correct) {
                    case 'answer1':
                        if ($answer->answer1 == $grammarItem)
                            UserAnswerModel::where('id', $userAnswer->id)->update([
                                'score' => 1
                            ]);
                        else
                            UserAnswerModel::where('id', $userAnswer->id)->update([
                                'score' => 0
                            ]);
                        break;

                    case 'answer2':
                        if ($answer->answer2 == $grammarItem)
                            UserAnswerModel::where('id', $userAnswer->id)->update([
                                'score' => 1
                            ]);
                        else
                            UserAnswerModel::where('id', $userAnswer->id)->update([
                                'score' => 0
                            ]);
                        break;

                    case 'answer3':
                        if ($answer->answer3 == $grammarItem)
                            UserAnswerModel::where('id', $userAnswer->id)->update([
                                'score' => 1
                            ]);
                        else
                            UserAnswerModel::where('id', $userAnswer->id)->update([
                                'score' => 0
                            ]);
                        break;

                    case 'answer4':
                        if ($answer->answer4 == $grammarItem)
                            UserAnswerModel::where('id', $userAnswer->id)->update([
                                'score' => 1
                            ]);
                        else
                            UserAnswerModel::where('id', $userAnswer->id)->update([
                                'score' => 0
                            ]);
                        break;
                }
            }

            if (isset($request->listingTextArea)) {
                foreach ($request->listingTextArea as $key => $listingTextAreaItem) {
                    UserAnswerModel::create([
                        'english_question_id' => $key,
                        'answer' => $listingTextAreaItem,
                        'exam_id' => $request->dumy
                    ]);
                }
            }

            if (isset($request->listeningRadio)) {
                foreach ($request->listeningRadio as $key => $listeningRadioItem) {
                    $userAnswer = UserAnswerModel::create([
                        'english_question_id' => $key,
                        'answer' => $listeningRadioItem,
                        'exam_id' => $request->dumy
                    ]);


                    $answer = EnglishQuestionAnswerModel::where('english_question_id', $key)->first();

                    switch ($answer->correct) {
                        case 'answer1':
                            if ($answer->answer1 == $listeningRadioItem)
                                UserAnswerModel::where('id', $userAnswer->id)->update([
                                    'score' => 2
                                ]);
                            else
                                UserAnswerModel::where('id', $userAnswer->id)->update([
                                    'score' => 0
                                ]);
                            break;

                        case 'answer2':
                            if ($answer->answer2 == $listeningRadioItem)
                                UserAnswerModel::where('id', $userAnswer->id)->update([
                                    'score' => 2
                                ]);
                            else
                                UserAnswerModel::where('id', $userAnswer->id)->update([
                                    'score' => 0
                                ]);
                            break;

                        case 'answer3':
                            if ($answer->answer3 == $listeningRadioItem)
                                UserAnswerModel::where('id', $userAnswer->id)->update([
                                    'score' => 2
                                ]);
                            else
                                UserAnswerModel::where('id', $userAnswer->id)->update([
                                    'score' => 0
                                ]);
                            break;

                        case 'answer4':
                            if ($answer->answer4 == $listeningRadioItem)
                                UserAnswerModel::where('id', $userAnswer->id)->update([
                                    'score' => 2
                                ]);
                            else
                                UserAnswerModel::where('id', $userAnswer->id)->update([
                                    'score' => 0
                                ]);
                            break;
                    }
                }
            }

            UserAnswerModel::create([
                'english_question_id' => $request->para,
                'answer' => $request->paraArea,
                'exam_id' => $request->dumy
            ]);

            \DB::commit();

            return redirect('/userExam')
                ->with('success', 'you Have Complete English Exam.');
        } catch (\Exception $e) {


            \DB::rollBack();

            return back()
                ->with('error', $e->getMessage());
        }

    }
    //candidate
    public function personalExamAnswer(SavePersonalAnswerRequest $request)
    {
        // dd($request->all());
        \DB::beginTransaction();
        try {
            foreach ($request->personal as $key => $personalItem) {
                $userAnswer = PersonalUserAnswerModel::create([
                    'personal_question_id' => $key,
                    'answer' => $personalItem,
                    'personal_exam_id' => $request->dumy
                ]);

                $answer = PersonalQuestionAnswerModel::where('personal_question_id', $key)->first();

                switch ($answer->correct) {
                    case 'answer1':
                        if ($answer->answer1 == $personalItem)
                            PersonalUserAnswerModel::where('id', $userAnswer->id)->update([
                                'score' => 1
                            ]);
                        else
                            PersonalUserAnswerModel::where('id', $userAnswer->id)->update([
                                'score' => 0
                            ]);
                        break;

                    case 'answer2':
                        if ($answer->answer2 == $personalItem)
                            PersonalUserAnswerModel::where('id', $userAnswer->id)->update([
                                'score' => 1
                            ]);
                        else
                            PersonalUserAnswerModel::where('id', $userAnswer->id)->update([
                                'score' => 0
                            ]);
                        break;

                    case 'answer3':
                        if ($answer->answer3 == $personalItem)
                            PersonalUserAnswerModel::where('id', $userAnswer->id)->update([
                                'score' => 1
                            ]);
                        else
                            PersonalUserAnswerModel::where('id', $userAnswer->id)->update([
                                'score' => 0
                            ]);
                        break;

                    case 'answer4':
                        if ($answer->answer4 == $personalItem)
                            PersonalUserAnswerModel::where('id', $userAnswer->id)->update([
                                'score' => 1
                            ]);
                        else
                            PersonalUserAnswerModel::where('id', $userAnswer->id)->update([
                                'score' => 0
                            ]);
                        break;
                }
            }

            if (isset($request->personTextArea)) {
                foreach ($request->personTextArea as $key => $personTextAreaItem) {
                    PersonalUserAnswerModel::create([
                        'personal_question_id' => $key,
                        'answer' => $personTextAreaItem,
                        'personal_exam_id' => $request->dumy
                    ]);
                }
            }

            if (isset($request->personal2)) {
                foreach ($request->personal2 as $key => $personal22) {
                    PersonalUserAnswerModel::create([
                        'personal_question_id' => $key,
                        'answer' => $personal22,
                        'personal_exam_id' => $request->dumy
                    ]);
                }
            }


            \DB::commit();

            return redirect('/userExam')
                ->with('success', 'you Have Complete Personal Exam.');
        } catch (\Exception $e) {


            \DB::rollBack();

            return back()
                ->with('error', $e->getMessage());
        }

    }
    //candidate
    public function msExamAnswer(SaveMsAnswerRequest $request)
    {
        //  dd($request->all());
        \DB::beginTransaction();
        try {
            foreach ($request->ms as $key => $msItem) {
                $userAnswer = MsUserAnswerModel::create([
                    'ms_question_id' => $key,
                    'answer' => $msItem,
                    'ms_exam_id' => $request->dumy
                ]);

                $answer = MsQuestionAnswerModel::where('ms_question_id', $key)->first();

                switch ($answer->correct) {
                    case 'answer1':
                        if ($answer->answer1 == $msItem)
                            MsUserAnswerModel::where('id', $userAnswer->id)->update([
                                'score' => 2
                            ]);
                        else
                            MsUserAnswerModel::where('id', $userAnswer->id)->update([
                                'score' => 0
                            ]);
                        break;

                    case 'answer2':
                        if ($answer->answer2 == $msItem)
                            MsUserAnswerModel::where('id', $userAnswer->id)->update([
                                'score' => 2
                            ]);
                        else
                            MsUserAnswerModel::where('id', $userAnswer->id)->update([
                                'score' => 0
                            ]);
                        break;

                    case 'answer3':
                        if ($answer->answer3 == $msItem)
                            MsUserAnswerModel::where('id', $userAnswer->id)->update([
                                'score' => 2
                            ]);
                        else
                            MsUserAnswerModel::where('id', $userAnswer->id)->update([
                                'score' => 0
                            ]);
                        break;

                    case 'answer4':
                        if ($answer->answer4 == $msItem)
                            MsUserAnswerModel::where('id', $userAnswer->id)->update([
                                'score' => 2
                            ]);
                        else
                            MsUserAnswerModel::where('id', $userAnswer->id)->update([
                                'score' => 0
                            ]);
                        break;
                }
            }

            if (isset($request->msTextArea)) {
                foreach ($request->msTextArea as $key => $msTextAreaItem) {
                    MsUserAnswerModel::create([
                        'ms_question_id' => $key,
                        'answer' => $msTextAreaItem,
                        'ms_exam_id' => $request->dumy
                    ]);
                }
            }


            \DB::commit();

            return redirect('/userExam')
                ->with('success', 'you Have Complete Microsoft Office Exam.');
        } catch (\Exception $e) {


            \DB::rollBack();

            return back()
                ->with('error', $e->getMessage());
        }

    }

    public function showCandidates()
    {


        if(\Auth::user()->permission != "Admin")
            return redirect('/userExam');

        $users = userModel:: where('permission', 'Candidate')->
        orderBy('id', 'DESC')->
        get();

        return view('exam.manage_candidate', [
            'users' => $users
        ]);


    }

    public function exportResult(Request $request)
    {
        if(\Auth::user()->permission != "Admin")
            return redirect('/userExam');

        $endDate = Carbon::parse($request->endDate)->addHour(23)->addMinute(59);
        $result =[];
        $users = userModel:: where('permission', 'Candidate')
            ->whereBetween('created_at', array($request->startDate,$endDate))
            ->orderBy('id', 'DESC')
            ->get();


        foreach($users as $key=>$user)
        {
            if(! Helper::evaCheckerEnglish($user->exam->id)  || ! Helper::evaCheckerPersonals($user->exam->id)  || ! Helper::evaCheckerMs($user->exam->id) )
            {
                $result[$key][0] = $user->name;
                $result[$key][1] = $user->email;
                $result[$key][2] = Carbon::parse($user->created_at)->format('Y-m-d');
                if(! Helper::evaCheckerEnglish($user->exam->id))
                {
                    $result[$key][3] = Helper::getEvaCheckerEnglish($user->exam->id);
                }
                else
                {

                    $result[$key][3] = 'Not Attend till now';
                }


                if(! Helper::evaCheckerPersonals($user->exam->id))
                {
                    $result[$key][4] = Helper::getEvaCheckerPersonal($user->exam->id);
                }
                else
                {
                    $result[$key][4] = 'Not Attend till now';
                }

                if(! Helper::evaCheckerMs($user->exam->id))
                {
                    $result[$key][5] = (string)Helper::getEvaCheckerMs($user->exam->id);
                }
                else
                {
                    $result[$key][5] = 'Not Attend till now';
                }
            }


        }

     //  dd($result);

        $header = [

            'Full Name',
            'Email',
            'Creation Account Date',
            'English Exam ',
            'Personal Exam',
            'M.s Office Exam',


        ];



        return Excel::download(new CollectionExport($result,$header), 'Report_'.date("Y-m-d").'.xlsx');
    }

    public function showCandidateEnglishExam($id)
    {
        if(\Auth::user()->permission != "Admin")
            abort(404);
        $exam = ExamModel::find($id);


        $request = "";
        $grammarEnglishQuestions = ExamQuestionModel::where('exam_id', $exam->id)->
        WhereHas('englishQuestion.englishMainQuestion', function ($query) use ($request) {
            $query->where('english_question_part_id', 1);
        })->get();


        $listeningEnglishQuestions = ExamQuestionModel::where('exam_id', $exam->id)->
        WhereHas('englishQuestion.englishMainQuestion', function ($query) use ($request) {
            $query->where('english_question_part_id', 3);
        })->get();

        $paragraphEnglishQuestions = ExamQuestionModel::where('exam_id', $exam->id)->
        WhereHas('englishQuestion.englishMainQuestion', function ($query) use ($request) {
            $query->where('english_question_part_id', 2);
        })->get();


        $counter = 1;
        return view('exam.admin_manage_candidate_english_exam', [
            'grammarEnglishQuestions' => $grammarEnglishQuestions,
            'listeningEnglishQuestions' => $listeningEnglishQuestions,
            'paragraphEnglishQuestions' => $paragraphEnglishQuestions,
            'counter' => $counter,
            'ex' => $exam->id,
            'user' => userModel::find($exam->user_id)
        ]);
    }

    public function showCandidatePersonalExam($id)
    {
        if(\Auth::user()->permission != "Admin")
            abort(404);
        $exam = ExamModel::find($id);


        $request = "";
        $personalQuestion = PersonalExamQuestionModel::where('exam_id', $exam->id)
            ->get();


        $counter = 1;
        return view('exam.admin_manage_candidate_personal_exam', [
            'personalExamQuestions' => $personalQuestion,

            'counter' => $counter,
            'ex' => $exam->id,
            'user' => userModel::find($exam->user_id)
        ]);
    }

    public function showCandidateMsExam($id)
    {
        if(\Auth::user()->permission != "Admin")
            abort(404);

        $exam = ExamModel::find($id);


        $request = "";
        $msQuestion = MsQuestionExamModel::where('ms_exam_id', $exam->id)
            ->get();


        $counter = 1;
        return view('exam.admin_manage_candidate_ms_exam', [
            'msExamQuestions' => $msQuestion,

            'counter' => $counter,
            'ex' => $exam->id,
            'user' => userModel::find($exam->user_id)
        ]);
    }

    public function candidateEnglishExamCorrect(correctAnswerRequest $request)
    {
        if(\Auth::user()->permission != "Admin")
            abort(404);
        \DB::beginTransaction();
        try {
  if(isset($request->score))
        {
            foreach ($request->score as $key => $scoreItem) {

                UserAnswerModel::where('exam_id', $request->dumy)->
                where('english_question_id', $key)->update([
                    'score' => $scoreItem
                ]);
            }
        }

        if(isset($request->written))
        {
            foreach ($request->written as $key => $writtenItem) {

                UserAnswerModel::where('exam_id', $request->dumy)->
                where('english_question_id', $key)->update([
                    'score' => $writtenItem
                ]);
            }
        }
            \DB::commit();

            return redirect('/showCandidates')
                ->with('success', 'you Have Complete Answer Correct.');
        } catch (\Exception $e) {


            \DB::rollBack();

            return back()
                ->with('error', $e->getMessage());
        }
    }

    public function candidatePersonalExamCorrect(correctAnswerRequest $request)
    {
        if(\Auth::user()->permission != "Admin")
            abort(404);

        \DB::beginTransaction();
        try {

            if(isset($request->score))
            foreach ($request->score as $key => $scoreItem) {

                PersonalUserAnswerModel::where('personal_exam_id', $request->dumy)->
                where('personal_question_id', $key)->update([
                    'score' => $scoreItem
                ]);
            }


            \DB::commit();

            return redirect('/showCandidates')
                ->with('success', 'you Have Complete Answer Correct.');
        } catch (\Exception $e) {


            \DB::rollBack();

            return back()
                ->with('error', $e->getMessage());
        }
    }

    public function candidateMsExamCorrect(correctAnswerRequest $request)
    {
        if(\Auth::user()->permission != "Admin")
            abort(404);

        \DB::beginTransaction();
        try {
            if(isset($request->score))
            foreach ($request->score as $key => $scoreItem) {


                MsUserAnswerModel::where('ms_exam_id', $request->dumy)->
                where('ms_question_id', $key)->update([
                    'score' => $scoreItem
                ]);
            }


            \DB::commit();

            return redirect('/showCandidates')
                ->with('success', 'you Have Complete Answer Correct.');
        } catch (\Exception $e) {


            \DB::rollBack();

            return back()
                ->with('error', $e->getMessage());
        }
    }



    public function assignExamPage()
    {
        if (Auth::user()->permission == "Admin") {

            $users = userModel::where('permission', 'Candidate')->orderBy('id')->get();
            return view('exam.assign_exam', [
                'users' => $users,

            ]);


        }

        return redirect('/')
            ->with('error', 'You do not have permission to do this operation.');
    }

    public function assignEnglishExam($id)
    {
        if(\Auth::user()->permission != "Admin")
            abort(404);
        \DB::beginTransaction();
 try{

         $user = userModel::find($id);

        $exam = examModel::where('user_id',$user->id)->first();


         if($exam == null)
         {
             $exam = examModel::create([
                 'user_id' => $user->id,
             ]);
         }


         if(examQuestionModel::where('exam_id',$exam->id)->first() != null)
             return back()
                 ->with('error', "Candidate Already have Exam");





        $request = "";



        $grammarMediumQuestions = EnglishQuestionModel::WhereHas('englishMainQuestion', function ($query) use ($request) {
            $query->where('english_question_part_id', 1);
        })->where('question_level_id', 2)->inRandomOrder()->take(18)->get();

        foreach ($grammarMediumQuestions as $grammarMediumQuestion) {
            examQuestionModel::create([
                'english_question_id' => $grammarMediumQuestion->id,
                'exam_id' => $exam->id
            ]);
        }


        $listeningMainQuestion = EnglishMainQuestionModel::where('english_question_part_id', 3)->inRandomOrder()->take(1)->get()[0];

        $listeningMediumQuestions = EnglishQuestionModel::where('english_main_question_id', $listeningMainQuestion->id)->
        where('question_level_id', 2)->inRandomOrder()->take(6)->get();

        foreach ($listeningMediumQuestions as $listeningMediumQuestion) {
            examQuestionModel::create([
                'english_question_id' => $listeningMediumQuestion->id,
                'exam_id' => $exam->id
            ]);
        }



        $paragraphMainQuestion = EnglishMainQuestionModel::where('english_question_part_id', 2)->inRandomOrder()->take(1)->get()[0];


        $paragraphQuestions = EnglishQuestionModel::where('english_main_question_id', $paragraphMainQuestion->id)->
        where('question_level_id', 2)->inRandomOrder()->take(1)->get();



        foreach ($paragraphQuestions as $paragraphQuestion) {
            examQuestionModel::create([
                'english_question_id' => $paragraphQuestion->id,
                'exam_id' => $exam->id
            ]);


        }
         \DB::commit();


     return redirect('/assignExam')
         ->with('success', 'English Exam Add to Candidate.');
            }



        catch (\Exception $e)
        {

            \DB::rollBack();

            //userModel::where('id',$user->id)->delete();

          //  dd($e->getMessage());
            return back()
                ->with('error', 'Please Try Again!!.');
        }


    }

    public function assignPersonalExam($id)
    {
        if(\Auth::user()->permission != "Admin")
            abort(404);
        \DB::beginTransaction();
        try{

            $user = userModel::find($id);

            $exam = examModel::where('user_id',$user->id)->first();


            if($exam == null)
            {
                $exam = examModel::create([
                    'user_id' => $user->id,
                ]);
            }


            if(PersonalExamQuestionModel::where('exam_id',$exam->id)->first() != null)
                return back()
                    ->with('error', "Candidate Already have Exam");


            $medPersonalQuestions = PersonalQuestionModel:: where('question_level_id',2)->inRandomOrder()->take(25)->get();

            foreach ($medPersonalQuestions as $medPersonalQuestion)
            {
                PersonalExamQuestionModel::create([
                    'personal_question_id'=>$medPersonalQuestion->id,
                    'exam_id'=>$exam->id
                ]);
            }


            \DB::commit();


            return redirect('/assignExam')
                ->with('success', 'Personal Exam Add to Candidate.');
        }



        catch (\Exception $e)
        {

            \DB::rollBack();

            //userModel::where('id',$user->id)->delete();

            //  dd($e->getMessage());
            return back()
                ->with('error', 'Please Try Again!!.');
        }


    }

    public function assignMsExam($id)
    {
        if(\Auth::user()->permission != "Admin")
            abort(404);

        \DB::beginTransaction();
        try{

            $user = userModel::find($id);

            $exam = examModel::where('user_id',$user->id)->first();


            if($exam == null)
            {
                $exam = examModel::create([
                    'user_id' => $user->id,
                ]);
            }


            if(MsExamQuestionModel::where('ms_exam_id',$exam->id)->first() != null)
                return back()
                    ->with('error', "Candidate Already have Exam");


            $med1MsQuestions = MsQuestionModel:: where('question_level_id',2)
                ->where('ms_question_section_id',1)
                ->inRandomOrder()->take(4)->get();

            foreach ($med1MsQuestions as $medMsQuestion)
            {
                MsExamQuestionModel::create([
                    'ms_question_id'=>$medMsQuestion->id,
                    'ms_exam_id'=>$exam->id
                ]);
            }

            $med2MsQuestions = MsQuestionModel:: where('question_level_id',2)
                ->where('ms_question_section_id',2)
                ->inRandomOrder()->take(15)->get();

            foreach ($med2MsQuestions as $medMsQuestion)
            {
                MsExamQuestionModel::create([
                    'ms_question_id'=>$medMsQuestion->id,
                    'ms_exam_id'=>$exam->id
                ]);
            }


            $med3MsQuestions = MsQuestionModel:: where('question_level_id',2)
                ->where('ms_question_section_id',3)
                ->inRandomOrder()->take(6)->get();

            foreach ($med3MsQuestions as $medMsQuestion)
            {
                MsExamQuestionModel::create([
                    'ms_question_id'=>$medMsQuestion->id,
                    'ms_exam_id'=>$exam->id
                ]);
            }

            \DB::commit();


            return redirect('/assignExam')
                ->with('success', 'Microsoft Office Exam Add to Candidate.');
        }



        catch (\Exception $e)
        {

            \DB::rollBack();

            dd($e->getMessage());
            return back()
                ->with('error', 'Please Try Again!!.');
        }


    }

}
