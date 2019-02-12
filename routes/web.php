<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/exportResult', 'Exam@exportResult');

Route::get('/', 'Exam@showCandidates');

Route::get('/addEnglishMainQuestion', 'EnglishExam@addEnglishQuestionPage');

Route::post('/addEnglishMainQuestion', 'EnglishExam@addEnglishMainQuestion');

Route::get('/addEnglishSubQuestion', 'EnglishExam@addEnglishSubQuestionPage');

Route::post('/addEnglishSubQuestion', 'EnglishExam@addEnglishSubQuestion');

Route::post('/getQuestions', 'EnglishExam@getQuestions');

Route::get('/manageGrammarQuestion', 'EnglishExam@manageGrammarQuestion');

Route::get('/editGrammarBoxQuestion/{id}', 'EnglishExam@editGrammarBoxQuestionPage');

Route::post('/editGrammarBoxQuestion', 'EnglishExam@editGrammarBoxQuestion');

Route::get('/deleteGrammarQuestion/{id}', 'EnglishExam@deleteGrammarQuestion');

Route::get('/questionMultiDetails/{id}', 'EnglishExam@questionMultiDetailsPage');

Route::post('/questionsMultiDetails', 'EnglishExam@questionMultiDetails');

Route::get('/manageParagraphQuestion', 'EnglishExam@manageParagraphQuestion');

Route::get('/editParagraphMainQuestion/{id}', 'EnglishExam@editParagraphMainQuestionPage');

Route::post('/editParagraphMainQuestion', 'EnglishExam@editParagraphMainQuestion');

Route::get('/deleteParagraphMainQuestion/{id}', 'EnglishExam@deleteParagraphMainQuestion');

Route::get('/manageSubParagraphQuestion/{id}', 'EnglishExam@manageSubParagraphQuestionPage');

Route::get('/manageAudioQuestion', 'EnglishExam@manageAudioQuestion');

Route::get('/manageSubAudioQuestion/{id}', 'EnglishExam@manageSubAudioQuestionPage');

Route::get('/deleteAudioMainQuestion/{id}', 'EnglishExam@deleteAudioMainQuestion');

Route::get('/editAudioMainQuestion/{id}', 'EnglishExam@editAudioMainQuestionPage');

Route::post('/editAudioMainQuestion/', 'EnglishExam@editAudioMainQuestion');

Route::get('/showCandidates', 'EnglishExam@showCandidates');




Route::get('/userExam', 'Exam@userExamPage');

Route::get('/setEnglishExam', 'Exam@setEnglishExam');

Route::post('/englishExamAnswer', 'Exam@englishExamAnswer');

Route::get('/examCandidate/{id}', 'Exam@showCandidateEnglishExam');

Route::get('/examCandidatePersonal/{id}', 'Exam@showCandidatePersonalExam');



Route::post('/candidateEnglishExamCorrect', 'Exam@candidateEnglishExamCorrect');

Route::post('/personalExamAnswer', 'Exam@personalExamAnswer');

Route::get('/setPersonalExam', 'Exam@setPersonalExam');







Route::get('/addPersonalQuestion', 'PersonalExam@addPersonalQuestionPage');

Route::post('/addPersonalQuestion', 'PersonalExam@addPersonalQuestion');

Route::get('/managePersonalQuestion', 'PersonalExam@managePersonalQuestion');

Route::get('/PersonalQuestionMultiDetails/{id}', 'PersonalExam@PersonalQuestionMultiDetailsPage');

Route::get('/PersonalQuestionMultiDetails2answer/{id}', 'PersonalExam@PersonalQuestionMultiDetails2answerPage');

Route::post('/questionMultisDetails', 'PersonalExam@questionMultiDetails');

Route::post('/questionMultiDetails2answer', 'PersonalExam@questionMultiDetails2answer');

Route::get('/editPersonalBoxQuestion/{id}', 'PersonalExam@editPersonalBoxQuestionPage');

Route::post('/editPersonalBoxQuestion', 'PersonalExam@editPersonalBoxQuestion');

Route::get('/deletePersonalQuestion/{id}/{type}', 'PersonalExam@deletePersonalQuestion');

Route::post('/candidatePersonalExamCorrect', 'Exam@candidatePersonalExamCorrect');













Route::get('/addMsQuestion', 'MsExam@addMsQuestionPage');

Route::post('/addMsQuestion', 'MsExam@addMsQuestion');

Route::get('/manageMsQuestion', 'MsExam@manageMsQuestion');

Route::get('/deleteMsQuestion/{id}/{type}/{answerType}', 'MsExam@deleteMsQuestion');

Route::get('/MsQuestionMultiDetails/{id}', 'MsExam@MsQuestionMultiDetailsPage');

Route::post('questionMultiDetails', 'MsExam@questionMultiDetails');

Route::get('/editMsBoxQuestion/{id}', 'MsExam@editMsBoxQuestionPage');

Route::post('/editMsBoxQuestion', 'MsExam@editMsBoxQuestion');

Route::get('/setMsExam', 'Exam@setMsExam');

Route::post('/msExamAnswer', 'Exam@msExamAnswer');

Route::get('/examCandidateMs/{id}', 'Exam@showCandidateMsExam');


Route::post('/candidateMsExamCorrect', 'Exam@candidateMsExamCorrect');




Route::get('/analysis', 'Analysis@main');







Route::get('/assignExam', 'Exam@assignExamPage');

Route::get('/assignEnglishExam/{id}', 'Exam@assignEnglishExam');

Route::get('/assignPersonalExam/{id}', 'Exam@assignPersonalExam');

Route::get('/assignMsExam/{id}', 'Exam@assignMsExam');






Auth::routes();

Route::get('/home', 'EnglishExam@addEnglishQuestionPage')->name('home');


Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
