<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EnglishQuestionPart AS EnglishQuestionPartModel;
use App\Models\EnglishQuestionType AS EnglishQuestionTypeModel;
use App\Models\QuestionLevel AS QuestionLevelModel;
use App\Models\EnglishMainQuestion AS EnglishMainQuestionModel;
use App\Models\EnglishQuestion AS EnglishQuestionModel;
use App\Models\EnglishQuestionAnswer AS EnglishQuestionAnswerModel;
use App\Http\Requests\EnglishExam\addMainQuesation AS AddMainQuestionRequest;
use App\Http\Requests\EnglishExam\getQuestions AS getQuestionsRequest;
use App\Http\Requests\EnglishExam\addSubQuesation AS addSubQuesationRequest;
use App\Http\Requests\EnglishExam\editGrammarQuestionBox AS editGrammarQuestionBoxRequest;
use App\Http\Requests\EnglishExam\editGrammarMultiChoose AS editGrammarMultiChooseRequest;
use App\Http\Requests\EnglishExam\editParagraphMainQuestion AS editParagraphMainQuestionRequest;
use App\Http\Requests\EnglishExam\editAudioQuuestion AS editAudioQuuestionRequest;
use App\User as userModel;
use Auth;
use Illuminate\Support\Facades\Input;

class EnglishExam extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');



    }

    public function addEnglishQuestionPage()
    {
        if(\Auth::user()->permission != "Admin")
          abort(404);


        $questionParts=EnglishQuestionPartModel::all();

        $questionTypes = EnglishQuestionTypeModel::all();



        return view('english_exam.add_main_question',[
           'questionParts'=>$questionParts,
           'questionTypes'=>$questionTypes,

        ]);
    }

    public function addEnglishMainQuestion(AddMainQuestionRequest $request)
    {

        if(\Auth::user()->permission != "Admin")
            abort(404);


        switch ($request->question)
        {
            case 'grammar':
                $check =  $request->questionPart == null  || $request->answer1 == null
                           || $request->answer2 == null ||$request->answer3 == null || $request->answer4 == null || $request->correctAnswer == null;
                if( ! $check)

                {
                    \DB::beginTransaction();

                    try {
                  $englishMainQuestion=  EnglishMainQuestionModel::create([
                        'english_question_part_id'=>$request->questionPart,
                        'title'=>$request->grammarQuestion,
                    ]);

                  $englishQuestion=  EnglishQuestionModel::create([
                        'english_main_question_id'=>$englishMainQuestion->id,
                        'english_question_type_id'=>1,
                        'title'=>$request->grammarQuestion,
                        'question_level_id'=>2,
                    ]);

                  $answers = EnglishQuestionAnswerModel::create([
                      'english_question_id'=>$englishQuestion->id,
                      'answer1'=>$request->answer1,
                      'answer2'=>$request->answer2,
                      'answer3'=>$request->answer3,
                      'answer4'=>$request->answer4,
                      'correct'=>$request->correctAnswer,

                  ]);
                        \DB::commit();

                        return redirect('/')
                            ->with('success', 'Grammar Question Add Successfully.');

                    }
                    catch (\Exception $e)
                    {
                        \DB::rollBack();

                        return back()
                            ->with('error', 'Please Try Again!!.');
                    }

                }

                 else
                 {
                     return back()
                         ->with('error', 'Please Fill All Fields!!.');
                 }

                  break;

            case 'written':
                $check =  $request->questionPart == null || $request->questionBody2 == null ;
                if(! $check) {
                    \DB::beginTransaction();

                    try {

                        $englishMainQuestion=  EnglishMainQuestionModel::create([
                            'english_question_part_id'=>$request->questionPart,
                            'title'=>$request->questionBody2,
                        ]);

                        $englishQuestion=  EnglishQuestionModel::create([
                            'english_main_question_id'=>$englishMainQuestion->id,
                            'english_question_type_id'=>2,
                            'title'=>$request->questionBody2,
                            'question_level_id'=>2,
                        ]);

                        \DB::commit();

                        return back()
                            ->with('success', 'Paragraph Questions Question Add Successfully.');
                      }
                    catch (\Exception $e)
                    {
                        \DB::rollBack();

                        return back()
                            ->with('error', 'Please Try Again!!.');
                    }
                }
                else
                {
                    return back()
                        ->with('error', 'Please Fill All Fields!!.');
                }

                break;
            case 'audio':
                $check =  $request->questionPart == null || $request->audioFile == null ;
                if(! $check)
                {
                    $extension = $request->audioFile->getClientOriginalExtension();

                    if ($extension == "mp3" || $extension == "wav")
                    {
                        try
                        {

                            $fileName = sha1(uniqid(mt_rand(), TRUE)) . "." . (Input::file('audioFile')->getClientOriginalExtension());

                            if(Input::file('audioFile')->move(public_path() . '/upload/Audio', $fileName))
                            {
                                $englishMainQuestion=  EnglishMainQuestionModel::create([
                                    'english_question_part_id'=>$request->questionPart,
                                    'title'=>$request->questionBody3,
                                    'path'=>$fileName
                                ]);
                                return back()
                                    ->with('success', 'Audio Question Add Successfully.');
                            }

                        }
                        catch (\Exception $e)
                        {
                            return back()
                                ->with('error', 'Something Not Correct,Please Try Again.');
                        }

                    }
                    else
                    {
                        return back()
                            ->with('error', 'Please Enter Correct Audio Format');
                    }
                }
                else
                {
                    return back()
                        ->with('error', 'Please Fill All Fields!!.');
                }
                break;
        }

    }

    public function addEnglishSubQuestionPage()
    {
        if(\Auth::user()->permission != "Admin")
            abort(404);

        $questionTitles = EnglishMainQuestionModel::where('english_question_part_id',2)->orderBy('id', 'DESC')->get();


        $questionTypes = EnglishQuestionTypeModel::all();

        return view('english_exam.add_sub_question_para',[
            'questionTitles'=>$questionTitles,

            'questionTypes'=>$questionTypes,

        ]);
    }


    public function addEnglishSubQuestion(addSubQuesationRequest $request)
    {
        if(\Auth::user()->permission != "Admin")
            abort(404);

        $mainQuestion =EnglishMainQuestionModel::where('english_question_part_id',$request->mainQuestionType)->
                                                 where('title',$request->questionTtile)->first();

        if ($request->questionType == 1 && $mainQuestion != null)
        {
            \DB::beginTransaction();

            try {
            $englishQuestion=EnglishQuestionModel::create([
                'english_main_question_id'=>$mainQuestion->id,
                'english_question_type_id'=>$request->questionType,
                'title'=>$request->titleQuestion,
                'question_level_id'=>2
            ]);


            EnglishQuestionAnswerModel::create([
                'english_question_id'=>$englishQuestion->id,
                'answer1'=>$request->answer1,
                'answer2'=>$request->answer2,
                'answer3'=>$request->answer3,
                'answer4'=>$request->answer4,
                'correct'=>$request->correctAnswer,
            ]);

            \DB::commit();

            return back()
                ->with('success', 'Sub Question Add Successfully.');

            }
            catch (\Exception $e)
            {
                \DB::rollBack();

                return back()
                    ->with('error', 'Please Try Again!!.');
            }
        }
        else if ($request->questionType == 2  && $mainQuestion != null)
        {

            \DB::beginTransaction();

            try {

            $englishQuestion = EnglishQuestionModel::create([
                'english_main_question_id' => $mainQuestion->id,
                'english_question_type_id' => $request->questionType,
                'title' => $request->questionBody2,
                'question_level_id' => 2
            ]);
            \DB::commit();

            return back()
                ->with('success', 'Sub Question Add Successfully.');

        }
    catch (\Exception $e)
            {
                \DB::rollBack();

                return back()
                    ->with('error', 'Please Try Again!!.');
            }
        }

        return back()
            ->with('error', 'Please Try Again!!.');
    }

    public function getQuestions(getQuestionsRequest $request)
    {
        if(\Auth::user()->permission != "Admin")
            abort(404);

       $questions = EnglishMainQuestionModel::where('english_question_part_id',$request->questionTypeId)->orderBy('id', 'DESC')-> pluck('title')->unique();

           // dd($client);
            return response()->json($questions);
    }


    public function manageGrammarQuestion()
    {
        if(\Auth::user()->permission != "Admin")
            abort(404);

        $request="";
       $grammarQuestions= EnglishQuestionModel::WhereHas('englishMainQuestion.englishQuestionPart',function ( $query )use ( $request ){
           $query->where('id',1 );
       })->get();

        return view('english_exam.manage_grammar_question',[
            'grammarQuestions'=>$grammarQuestions
        ]);
    }

    public function editGrammarBoxQuestionPage($id)
    {
        if(\Auth::user()->permission != "Admin")
            abort(404);

        $questionBox= EnglishQuestionModel::findOrFail($id);

        $difficulties =QuestionLevelModel::all();


        return view('english_exam.edit_grammar_question_box',[
            'questionBox'=>$questionBox,
            'difficulties'=>$difficulties
        ]);

    }

    public function editGrammarBoxQuestion(editGrammarQuestionBoxRequest $request)
    {
        if(\Auth::user()->permission != "Admin")
            abort(404);

        try {

        $question = EnglishQuestionModel::where('id',$request->questionId)->first();

        EnglishQuestionModel::where('id',$request->questionId)->update([
            'title'=>$request->title,
            'question_level_id'=>2
        ]);

            

            if($question->englishMainQuestion->englishQuestionPart->id == 1)
            {
                return redirect('/manageGrammarQuestion')
                    ->with('success', 'Grammar Question Edit Successfully.');
            }
            elseif($question->englishMainQuestion->englishQuestionPart->id == 2)
            {
                return redirect('/manageSubParagraphQuestion/'.$question->englishMainQuestion->id)
                    ->with('success', 'Paragraph Question Edit Successfully.');
            }
            elseif($question->englishMainQuestion->englishQuestionPart->id == 3)
            {
                return redirect('/manageSubAudioQuestion/'.$question->englishMainQuestion->id)
                    ->with('success', 'Audio Question Edit Successfully.');
            }

        }
        catch (\Exception $e)
        {


            return back()
                ->with('error', 'Please Try Again!!.');
        }
    }

    public function deleteGrammarQuestion($id)
    {
        if(\Auth::user()->permission != "Admin")
            abort(404);

        try {
            EnglishQuestionModel::where('id',$id)->delete();

            return redirect('/manageGrammarQuestion')
                ->with('success', 'Grammar Question Deleted Successfully.');
        }
        catch (\Exception $e)
        {


            return back()
                ->with('error', 'Please Try Again!!.');
        }
    }

    public function questionMultiDetailsPage($id)
    {
        if(\Auth::user()->permission != "Admin")
            abort(404);

        $questionMultiChooses= EnglishQuestionModel::findOrFail($id);

        $difficulties =QuestionLevelModel::all();

        $answers =['answer1','answer2','answer3','answer4'];

        return view('english_exam.edit_grammar_question_multi_choose',[
            'questionMultiChooses'=>$questionMultiChooses,
            'difficulties'=>$difficulties,
            'answers'=>$answers
        ]);
    }

    public function questionMultiDetails(editGrammarMultiChooseRequest $request)
    {
        if(\Auth::user()->permission != "Admin")
            abort(404);

        try {

            $question = EnglishQuestionModel::where('id',$request->questionId)->first();

            \DB::beginTransaction();

        EnglishQuestionModel::where('id',$request->questionId)->update([
            'title'=>$request->title,

        ]);

        EnglishQuestionAnswerModel::where('english_question_id',$request->questionId)->update([
            'answer1'=>$request->answer1,
            'answer2'=>$request->answer2,
            'answer3'=>$request->answer3,
            'answer4'=>$request->answer4,
            'correct'=>$request->correct,
        ]);

            \DB::commit();

           if($question->englishMainQuestion->englishQuestionPart->id == 1)
           {
               return redirect('/manageGrammarQuestion')
                   ->with('success', 'Grammar Question Edit Successfully.');
           }
           elseif($question->englishMainQuestion->englishQuestionPart->id == 2)
           {
               return redirect('/manageSubParagraphQuestion/'.$question->englishMainQuestion->id)
                   ->with('success', 'Paragraph Question Edit Successfully.');
           }
           elseif($question->englishMainQuestion->englishQuestionPart->id == 3)
           {
               return redirect('/manageSubAudioQuestion/'.$question->englishMainQuestion->id)
                   ->with('success', 'Audio Question Edit Successfully.');
           }

        }
        catch (\Exception $e)
        {

            \DB::rollBack();

            return back()
                ->with('error', 'Please Try Again!!.');
        }
    }

    public function manageParagraphQuestion()
    {
        if(\Auth::user()->permission != "Admin")
            abort(404);

        $request="";
        $paragraphQuestions= EnglishMainQuestionModel::WhereHas('englishQuestionPart',function ( $query )use ( $request ){
            $query->where('id',2 );
        })->get();

        return view('english_exam.manage_pharagrph_question',[
            'paragraphQuestions'=>$paragraphQuestions
        ]);
    }

    public function editParagraphMainQuestionPage($id)
    {
        if(\Auth::user()->permission != "Admin")
            abort(404);

        $questionParagraph= EnglishMainQuestionModel::findOrFail($id);


        return view('english_exam.edit_main_paragrph_question',[
            'questionParagraph'=>$questionParagraph,

        ]);

    }

    public function editParagraphMainQuestion(editParagraphMainQuestionRequest $request)
    {
        if(\Auth::user()->permission != "Admin")
            abort(404);

        try {
            EnglishMainQuestionModel::where('id',$request->questionId)->update([
                'title'=>$request->title,
            ]);

            return redirect('manageParagraphQuestion')
                ->with('success', 'Paragraph Main Question Update Successfully.');
        }
        catch (\Exception $e)
        {


            return back()
                ->with('error', 'Please Try Again!!.');
        }
    }

    public function deleteParagraphMainQuestion($id)
    {
        if(\Auth::user()->permission != "Admin")
            abort(404);
        try {

            EnglishQuestionModel::where('english_main_question_id',$id)->delete();

            EnglishMainQuestionModel::where('id',$id)->delete();

            return redirect('/manageParagraphQuestion')
                ->with('success', 'Paragraph Question Deleted Successfully.');
        }
        catch (\Exception $e)
        {


            return back()
                ->with('error', 'Please Try Again!!.');
        }
    }

    public function manageSubParagraphQuestionPage($id)
    {
        if(\Auth::user()->permission != "Admin")
            abort(404);

        $paragraphQuestions= EnglishQuestionModel::WhereHas('englishMainQuestion',function ( $query )use ( $id ){
            $query->where('id',$id );
        })->get();


        return view('english_exam.manage_sub_pharagrph_question',[
            'paragraphQuestions'=>$paragraphQuestions
        ]);
    }

    public function manageAudioQuestion()
    {
        if(\Auth::user()->permission != "Admin")
            abort(404);

        $request="";
        $audioQuestions= EnglishMainQuestionModel::WhereHas('englishQuestionPart',function ( $query )use ( $request ){
            $query->where('id',3 );
        })->get();

        return view('english_exam.manage_audio_question',[
            'audioQuestions'=>$audioQuestions
        ]);
    }

    public function manageSubAudioQuestionPage($id)
    {
        if(\Auth::user()->permission != "Admin")
            abort(404);

        $audioQuestions= EnglishQuestionModel::WhereHas('englishMainQuestion',function ( $query )use ( $id ){
            $query->where('id',$id );
        })->get();


        return view('english_exam.manage_sub_audio_question',[
            'audioQuestions'=>$audioQuestions
        ]);
    }

    public function deleteAudioMainQuestion($id)
    {
        if(\Auth::user()->permission != "Admin")
            abort(404);

        try {


            $audio=EnglishMainQuestionModel::find($id);

            \File::delete('upload/Audio/'. $audio->path);


            EnglishQuestionModel::where('english_main_question_id',$id)->delete();

            EnglishMainQuestionModel::where('id',$id)->delete();

            return redirect('/manageAudioQuestion')
                ->with('success', 'Audio Question Deleted Successfully.');
        }
        catch (\Exception $e)
        {


            return back()
                ->with('error', 'Please Try Again!!.');
        }
    }

    public function editAudioMainQuestionPage($id)
    {
        if(\Auth::user()->permission != "Admin")
            abort(404);

        $questionAudio= EnglishMainQuestionModel::findOrFail($id);


        return view('english_exam.edit_main_audio_question',[
            'questionAudio'=>$questionAudio,

        ]);

    }

    public function editAudioMainQuestion(editAudioQuuestionRequest $request)
    {
        if(\Auth::user()->permission != "Admin")
            abort(404);

        try {

            if(! isset($request->audioFile))
            {
                EnglishMainQuestionModel::where('id',$request->questionId)->update([
                    'title'=>$request->title,
                ]);

                return redirect('manageAudioQuestion')
                    ->with('success', 'Audio Main Question Update Successfully.');
            }
            else
            {
                $audio=EnglishMainQuestionModel::find($request->questionId);

                \File::delete('upload/Audio/'. $audio->path);

                $fileName = sha1(uniqid(mt_rand(), TRUE)) . "." . (Input::file('audioFile')->getClientOriginalExtension());

                if(Input::file('audioFile')->move(public_path() . '/upload/Audio', $fileName))
                {
                    $englishMainQuestion=  EnglishMainQuestionModel::where('id',$request->questionId)->update([

                        'title'=>$request->title,
                        'path'=>$fileName
                    ]);
                    return redirect('manageAudioQuestion')
                        ->with('success', 'Audio Question Add Successfully.');
                }
            }

        }
        catch (\Exception $e)
        {


            return back()
                ->with('error', $e->getMessage());
        }
    }

    public function showCandidates()
    {
        if(\Auth::user()->permission != "Admin")
            abort(404);

        $users=userModel:: where('permission','Candidate')->
        orderBy('id', 'DESC')->
        get();


        return view('exam.manage_candidate',[
            'users'=>$users
        ]);


    }

}
