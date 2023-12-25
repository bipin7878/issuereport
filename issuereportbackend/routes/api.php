<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IssuereportController;
use App\Http\Controllers\IssuesolveController;
use App\Http\Controllers\ShowdetailsissueController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\IssuerecordController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
 Route::Post('issues', [IssuereportController::class, 'store_issuereportform']);
 Route::Get('issusesolves', [IssuesolveController::class, 'issue_solve']);

 Route::get('issusesolves/{id}', [ShowdetailsissueController::class, 'show']);
 
 //comment route
 Route::Post('comments', [CommentsController::class, 'store_comments']);
 Route::Get('comments', [CommentsController::class, 'show_comments']);

//issuerecords route 
 Route::Post('issuerecords', [IssuerecordController::class, 'store']);
 Route::get('shows', [IssuerecordController::class, 'show']);


