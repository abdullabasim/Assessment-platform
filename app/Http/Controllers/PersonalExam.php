<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalQuestion AS personalQuestionModel;
use App\Models\PersonalQuestionAnswer AS personalQuestionAnswerModel;
use App\Models\PersonalQuestionType AS personalQuestionTypeModel;
use App\Models\QuestionLevel AS questionLevelModel;
use App\Models\PersonalAnswerType AS personalAnswerTypeModel;
use App\Http\Requests\PersonalQuestion\addQuestion as addQuestionRequest;
use App\Http\Requests\PersonalQuestion\editQuestionMultiChose as editQuestionMultiChoseRequest;
use App\Http\Requests\PersonalQuestion\editPersoanlQuestionBox as editPersoanlQuestionBoxRequest;


class PersonalExam extends Controller
{
    public function addPersonalQuestionPage()
    {
        if(\Auth::user()->permission != "Admin")
            abort(404);


        $questionParts=personalQuestionTypeModel::all();





        return view('personal_exam.add_question',[
            'questionParts'=>$questionParts,


        ]);
    }

    public function addPersonalQuestion(addQuestionRequest $request)
    {
     //  dd($request->all());
        if(\Auth::user()->permission != "Admin")
            abort(404);



        if ($request->questionPart == 1 )
        {
            \DB::beginTransaction();

            try {
                $personalQuestion=personalQuestionModel::create([

                    'personal_question_type_id'=>$request->questionPart,
                    'title'=>$request->personalMultiChoseQuestion,
                    'question_level_id'=>2
                ]);


                personalQuestionAnswerModel::create([
                    'personal_question_id'=>$personalQuestion->id,
                    'answer1'=>$request->answer1,
                    'answer2'=>$request->answer2,
                    'answer3'=>$request->answer3,
                    'answer4'=>$request->answer4,
                    'correct'=>$request->correctAnswer,
                ]);

                \DB::commit();

                return back()
                    ->with('success', 'Personal Question Add Successfully.');

            }
            catch (\Exception $e)
            {
                dd($e->getMessage());
                \DB::rollBack();

                return back()
                    ->with('error', 'Please Try Again!!.');
            }
        }
        else if ($request->questionPart == 3  )
        {

            \DB::beginTransaction();

            try {



                $personalQuestion=personalQuestionModel::create([

                    'personal_question_type_id'=>$request->questionPart,
                    'title' => $request->questionBody2,
                    'question_level_id'=>2
                ]);



                \DB::commit();

                return back()
                    ->with('success', 'Personal Question Add Successfully.');

            }
            catch (\Exception $e)
            {
                \DB::rollBack();

                return back()
                    ->with('error', 'Please Try Again!!.');
            }
        }
        else if ($request->questionPart == 2  )
        {

            \DB::beginTransaction();

            try {
                $personalQuestion=personalQuestionModel::create([

                    'personal_question_type_id'=>$request->questionPart,
                    'title'=>$request->personalMultiChoseQuestion,
                    'question_level_id'=>2
                ]);


                personalAnswerTypeModel::create([
                    'personal_question_id'=>$personalQuestion->id,
                    'answer1'=>$request->answer1,
                    'answer2'=>$request->answer2,

                ]);

                \DB::commit();

                return back()
                    ->with('success', 'Personal Question Add Successfully.');

            }
            catch (\Exception $e)
            {
                dd($e->getMessage());
                \DB::rollBack();

                return back()
                    ->with('error', 'Please Try Again!!.');
            }
        }

        return back()
            ->with('error', 'Please Try Again!!.');
    }

    public function managePersonalQuestion()
    {
        if(\Auth::user()->permission != "Admin")
            abort(404);


        $personalQuestions= personalQuestionModel::get();

        return view('personal_exam.manage_personal_question',[
            'personalQuestions'=>$personalQuestions
        ]);
    }

    public function PersonalQuestionMultiDetailsPage($id)
    {

        if(\Auth::user()->permission != "Admin")
            abort(404);

        $questionMultiChooses= personalQuestionModel::findOrFail($id);



        $answers =['answer1','answer2','answer3','answer4'];


        return view('personal_exam.edit_personal_question_multi_choose',[
            'questionMultiChooses'=>$questionMultiChooses,
            'answers'=>$answers
        ]);
    }

    public function PersonalQuestionMultiDetails2answerPage($id)
    {

        if(\Auth::user()->permission != "Admin")
            abort(404);

        $questionMultiChooses= personalQuestionModel::findOrFail($id);



        $answers =['answer1','answer2'];


        return view('personal_exam.edit_personal_question_multi_choose(2Answer)',[
            'questionMultiChooses'=>$questionMultiChooses,
            'answers'=>$answers
        ]);
    }

    public function questionMultiDetails(editQuestionMultiChoseRequest $request)
    {
        if(\Auth::user()->permission != "Admin")
            abort(404);

        try {

            $question = personalQuestionModel::where('id',$request->questionId)->first();

            \DB::beginTransaction();

            personalQuestionModel::where('id',$request->questionId)->update([
                'title'=>$request->title,
                'question_level_id'=>2
            ]);

            personalQuestionAnswerModel::where('personal_question_id',$request->questionId)->update([
                'answer1'=>$request->answer1,
                'answer2'=>$request->answer2,
                'answer3'=>$request->answer3,
                'answer4'=>$request->answer4,
                'correct'=>$request->correct,
            ]);

            \DB::commit();


                return redirect('/managePersonalQuestion')
                    ->with('success', 'Personal Question Edit Successfully.');


        }
        catch (\Exception $e)
        {

            \DB::rollBack();

            return back()
                ->with('error', 'Please Try Again!!.');
        }
    }

    public function questionMultiDetails2answer(Request $request)
    {

        if(\Auth::user()->permission != "Admin")
            abort(404);

        try {

            $question = personalQuestionModel::findOrFail($request->questionId);

            \DB::beginTransaction();

            personalQuestionModel::where('id',$question->id)->update([
                'title'=>$request->title,
                'question_level_id'=>2
            ]);

            personalAnswerTypeModel::where('personal_question_id',$question->id)->update([
                'answer1'=>$request->answer1,
                'answer2'=>$request->answer2,

            ]);

            \DB::commit();


            return redirect('/managePersonalQuestion')
                ->with('success', 'Personal Question Edit Successfully.');


        }
        catch (\Exception $e)
        {

            \DB::rollBack();

            return back()
                ->with('error', 'Please Try Again!!.');
        }
    }

    public function editPersonalBoxQuestionPage($id)
    {

        if(\Auth::user()->permission != "Admin")
            abort(404);

        $questionBox= personalQuestionModel::findOrFail($id);




        return view('personal_exam.edit_personal_question_box',[
            'questionBox'=>$questionBox,

        ]);

    }

    public function editPersonalBoxQuestion(editPersoanlQuestionBoxRequest $request)
    {
        if(\Auth::user()->permission != "Admin")
            abort(404);

        try {


            $question = personalQuestionModel::where('id',$request->questionId)->first();

            personalQuestionModel::where('id',$request->questionId)->update([
                'title'=>$request->title,
                'question_level_id'=>2
            ]);



            return redirect('/managePersonalQuestion')
                ->with('success', 'Personal Question Edit Successfully.');

        }
        catch (\Exception $e)
        {


            return back()
                ->with('error', 'Please Try Again!!.');
        }
    }

    public function deletePersonalQuestion($id,$type)
    {
        if(\Auth::user()->permission != "Admin")
            abort(404);

        try {

            if($type == 1)

            {
                $question = personalQuestionModel::findOrFail($id);

                personalQuestionAnswerModel::where('personal_question_id',$question->id)->
                                             delete();

                personalQuestionModel::where('id',$id)->delete();

                return redirect('/managePersonalQuestion')
                    ->with('success', 'Personal Question Deleted Successfully.');
            }
            elseif($type == 3)
            {
                personalQuestionModel::where('id',$id)->delete();

                return redirect('/managePersonalQuestion')
                    ->with('success', 'Personal Question Deleted Successfully.');
            }

            elseif($type == 2)
            {
                $question = personalQuestionModel::findOrFail($id);

                personalAnswerTypeModel::where('personal_question_id',$question->id)->
                delete();

                personalQuestionModel::where('id',$id)->delete();

                return redirect('/managePersonalQuestion')
                    ->with('success', 'Personal Question Deleted Successfully.');
            }

        }
        catch (\Exception $e)
        {

            return back()
                ->with('error', 'Please Try Again!!.');
        }
    }

}
