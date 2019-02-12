<?php

namespace App\Http\Controllers;

use App\Models\MsQuestion;
use Illuminate\Http\Request;
use App\Models\MsQuestion as msQuestionModel;
use App\Models\MsQuestionAnswer as msQuestionAnswerModel;
use App\Models\MsAnaswerType as msAnswerTypeModel;
use App\Models\MsQuestionType as msQuestionTypeModel ;
use App\Models\QuestionLevel as questionLevelModel ;
use App\Models\MsQuestionSection as msQuestionSectionModel ;


use Illuminate\Support\Facades\Input;

class MsExam extends Controller
{


    public function addMsQuestionPage()
    {
        if(\Auth::user()->permission != "Admin")
            abort(404);

        $questionTypes=msQuestionTypeModel::all();

        $answerTypes=msAnswerTypeModel::all();

        $difficulties =questionLevelModel::all();

        $questionSection =msQuestionSectionModel::all();

        return view('ms_exam.add_question',[
            'questionTypes'=>$questionTypes,
            'answerTypes'=>$answerTypes,
            'difficulties'=>$difficulties,
            'questionSections'=>$questionSection
        ]);
    }

    public function addMsQuestion(Request $request)
    {

        if(\Auth::user()->permission != "Admin")
            abort(404);



        if ($request->answerType == 1 )
        {
            \DB::beginTransaction();

            try {

                if(isset($request->image))
                {
                    $fileName = sha1(uniqid(mt_rand(), TRUE)) . "." . (Input::file('image')->getClientOriginalExtension());

                    if(Input::file('image')->move(public_path() . '/upload/Images', $fileName))
                    {

                        $msQuestion=msQuestionModel::create([

                            'ms_question_type_id'=>$request->questionType,
                            'ms_answer_type_id'=>$request->answerType,
                            'title'=>$request->questionBody,
                            'question_level_id'=>2,
                            'image_path'=>$fileName,
                            'ms_question_section_id'=>$request->questionSection
                        ]);
                    }
                    else
                     {
                        abort(404);
                    }
                }

                else
                {
                    $msQuestion=msQuestionModel::create([

                        'ms_question_type_id'=>$request->questionType,
                        'ms_answer_type_id'=>$request->answerType,
                        'title'=>$request->questionBody,
                        'question_level_id'=>2,
                        'ms_question_section_id'=>$request->questionSection

                    ]);
                }





                msQuestionAnswerModel::create([
                    'ms_question_id'=>$msQuestion->id,
                    'answer1'=>$request->answer1,
                    'answer2'=>$request->answer2,
                    'answer3'=>$request->answer3,
                    'answer4'=>$request->answer4,
                    'correct'=>$request->correctAnswer,
                ]);

                \DB::commit();

                return back()
                    ->with('success', 'Microsoft Question Add Successfully.');

            }
            catch (\Exception $e)
            {
                dd($e->getMessage());
                \DB::rollBack();

                return back()
                    ->with('error', 'Please Try Again!!.');
            }
        }
        else if ($request->answerType == 2  )
        {

            \DB::beginTransaction();

            try {



                if(isset($request->image))
                {
                    $fileName = sha1(uniqid(mt_rand(), TRUE)) . "." . (Input::file('image')->getClientOriginalExtension());

                    if(Input::file('image')->move(public_path() . '/upload/Images', $fileName))
                    {

                        $msQuestion=msQuestionModel::create([

                            'ms_question_type_id'=>$request->questionType,
                            'ms_answer_type_id'=>$request->answerType,
                            'title'=>$request->questionBody,
                            'question_level_id'=>2,
                            'image_path'=>$fileName,
                            'ms_question_section_id'=>$request->questionSection
                        ]);
                    }
                    else
                    {
                        abort(404);
                    }
                }

                else
                {
                    $msQuestion=msQuestionModel::create([

                        'ms_question_type_id'=>$request->questionType,
                        'ms_answer_type_id'=>$request->answerType,
                        'title'=>$request->questionBody,
                        'question_level_id'=>2,
                        'ms_question_section_id'=>$request->questionSection

                    ]);
                }



                \DB::commit();

                return back()
                    ->with('success', 'Microsoft Question Add Successfully.');

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

    public function manageMsQuestion()
    {
        if(\Auth::user()->permission != "Admin")
            abort(404);


        $msQuestions= msQuestionModel::get();

        return view('ms_exam.manage_ms_question',[
            'msQuestions'=>$msQuestions
        ]);
    }

    public function deleteMsQuestion($id,$type,$answerType)
    {
        if(\Auth::user()->permission != "Admin")
            abort(404);

        try {

            if($type == 2)
            {
                $question = msQuestionModel::findOrFail($id);

                \File::delete('upload/Images/'. $question->image_path);
            }

            if($answerType == 1)

            {
                $question = msQuestionModel::findOrFail($id);

                msQuestionAnswerModel::where('ms_question_id',$question->id)->
                delete();

                msQuestionModel::where('id',$id)->delete();

                return redirect('/manageMsQuestion')
                    ->with('success', 'Microsoft Office Question Deleted Successfully.');
            }
            elseif($answerType == 2)
            {
                msQuestionModel::where('id',$id)->delete();

                return redirect('/manageMsQuestion')
                    ->with('success', 'Microsoft Office Question Deleted Successfully.');
            }

        }
        catch (\Exception $e)
        {

            return back()
                ->with('error', 'Please Try Again!!.');
        }
    }

    public function MsQuestionMultiDetailsPage($id)
    {


        if(\Auth::user()->permission != "Admin")
            abort(404);

        $questionMultiChooses= msQuestionModel::findOrFail($id);

        $questionSection =msQuestionSectionModel::all();

        $answers =['answer1','answer2','answer3','answer4'];


        return view('ms_exam.edit_ms_question_multi_choose',[
            'questionMultiChooses'=>$questionMultiChooses,
            'questionSections'=>$questionSection,
            'answers'=>$answers
        ]);
    }

    public function questionMultiDetails(Request $request)
    {

      //  dd($request->all());
        if(\Auth::user()->permission != "Admin")
            abort(404);

        try {

            \DB::beginTransaction();

            $question = msQuestionModel::where('id',$request->questionId)->first();

            if(isset($request->image))
            {


                \File::delete('upload/Images/'. $question->image_path);


                $fileName = sha1(uniqid(mt_rand(), TRUE)) . "." . (Input::file('image')->getClientOriginalExtension());

                if(Input::file('image')->move(public_path() . '/upload/Images', $fileName))
                {
                    msQuestionModel::where('id',$request->questionId)->update([
                        'title'=>$request->title,
                        'question_level_id'=>2,
                        'image_path'=>$fileName,
                        'ms_question_section_id'=>$request->questionSection
                    ]);

                    msQuestionAnswerModel::where('ms_question_id',$request->questionId)->update([
                        'answer1'=>$request->answer1,
                        'answer2'=>$request->answer2,
                        'answer3'=>$request->answer3,
                        'answer4'=>$request->answer4,
                        'correct'=>$request->correct,
                    ]);
                    \DB::commit();


                    return redirect('/manageMsQuestion')
                        ->with('success', 'Microsoft Office Question Edit Successfully.');
                }

                else
                {
                    abort(404);
                }




            }
            else
            {
                msQuestionModel::where('id',$request->questionId)->update([
                    'title'=>$request->title,
                    'question_level_id'=>2,
                    'ms_question_section_id'=>$request->questionSection
                ]);

                msQuestionAnswerModel::where('ms_question_id',$request->questionId)->update([
                    'answer1'=>$request->answer1,
                    'answer2'=>$request->answer2,
                    'answer3'=>$request->answer3,
                    'answer4'=>$request->answer4,
                    'correct'=>$request->correct,
                ]);

                \DB::commit();


                return redirect('/manageMsQuestion')
                    ->with('success', 'Microsoft Office Question Edit Successfully.');
            }






        }
        catch (\Exception $e)
        {

            \DB::rollBack();

            return back()
                ->with('error', 'Please Try Again!!.');
        }
    }

    public function editMsBoxQuestionPage($id)
    {

        if(\Auth::user()->permission != "Admin")
            abort(404);

        $questionBox= msQuestionModel::findOrFail($id);


        $questionSection =msQuestionSectionModel::all();
        return view('ms_exam.edit_ms_question_box',[
            'questionBox'=>$questionBox,
            'questionSections'=>$questionSection
        ]);

    }

    public function editMsBoxQuestion(Request $request)
    {
        if(\Auth::user()->permission != "Admin")
            abort(404);

        try {

            $question = MsQuestion::where('id',$request->questionId)->first();


            if(isset($request->image))
            {
                \File::delete('upload/Images/'. $question->image_path);


                $fileName = sha1(uniqid(mt_rand(), TRUE)) . "." . (Input::file('image')->getClientOriginalExtension());

                if(Input::file('image')->move(public_path() . '/upload/Images', $fileName))
                {
                    msQuestionModel::where('id', $request->questionId)->update([
                        'title' => $request->title,
                        'question_level_id' => 2,
                        'image_path' => $fileName,
                        'ms_question_section_id'=>$request->questionSection
                    ]);

                    return redirect('/manageMsQuestion')
                        ->with('success', 'Microsoft Office Question Edit Successfully.');

                }
                else
                {
                    abort(404);
                }
            }

             else
             {
                 msQuestionModel::where('id',$request->questionId)->update([
                     'title'=>$request->title,
                     'question_level_id'=>2,
                     'ms_question_section_id'=>$request->questionSection

                 ]);

                 return redirect('/manageMsQuestion')
                     ->with('success', 'Microsoft Office Question Edit Successfully.');
             }






        }
        catch (\Exception $e)
        {


            return back()
                ->with('error', 'Please Try Again!!.');
        }
    }

}
