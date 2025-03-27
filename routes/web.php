<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SurveyFormController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\DefaultQuestionController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
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

Route::get('/survey/{id}/{surveylink}', [SurveyFormController::class, 'surveyformRead'])->name('surveyformRead');
Route::post('/survey/form/create', [SurveyFormController::class, 'surveyformCreate'])->name('surveyformCreate');
Route::get('/surveyform/submitted', [SurveyFormController::class, 'submitted_surveyformRead'])->name('submitted_surveyformRead');

Route::group(['middleware'=>['guest']], function(){
     Route::get('/', function () {
        return view('login');
     });

    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'getLogin'])->name('getLogin');

});

Route::group(['middleware'=>['login_auth']], function(){
    Route::get('/dashboard', [MasterController::class, 'home'])->name('home');
    
    
    Route::prefix('forms')->group(function () {
        Route::get('/list/question/survey/default', [DefaultQuestionController::class, 'defquestionStore'])->name('defquestionStore');
        Route::post('/list/question/survey/default/add', [DefaultQuestionController::class, 'defquestionCreate'])->name('defquestionCreate');


        Route::get('/list', [FormsController::class, 'formRead'])->name('formRead');
        Route::post('/add', [FormsController::class, 'formCreate'])->name('formCreate');
        Route::get('/list/view/add/question/{id}', [FormsController::class, 'formQuestion'])->name('formQuestion');
        Route::post('list/view/addquestion', [FormsController::class, 'formquestionCreate'])->name('formquestionCreate');
        Route::post('/update-question/{id}', [FormsController::class, 'updateQuestion'])->name('updateQuestion');
        Route::delete('/form/{id}', [FormsController::class, 'formDelete'])->name('formDelete');
        Route::delete('/question/{id}', [FormsController::class, 'deleteQuestion'])->name('deleteQuestion');
        

        Route::get('list/view/question/pdf/{id}', [FormsController::class, 'PDFSurveyShowTemplate'])->name('PDFSurveyShowTemplate');
    });
    
    Route::prefix('forms')->group(function () {
        Route::get('/users/list', [UserController::class, 'userRead'])->name('userRead');
        Route::post('/users/add', [UserController::class, 'userCreate'])->name('userCreate');
        Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
        Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
        Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
    });

    Route::prefix('reports')->group(function () {
        Route::get('/list/evaluation', [ReportController::class, 'reportRead'])->name('reportRead');
        Route::get('/list/evaluation/view/{id}', [ReportController::class, 'reportViewSurvey'])->name('reportViewSurvey');
        Route::get('/list/evaluation/view/result/pdf/{id}', [ReportController::class, 'PDFreportViewSurveyresult'])->name('PDFreportViewSurveyresult');
        Route::get('list/evaluation/view/result/rated/pdf/{id}', [ReportController::class, 'PDFSurveyRatedTemplate'])->name('PDFSurveyRatedTemplate');
    });

    Route::get('/logout', [MasterController::class, 'logout'])->name('logout');
});