<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\ArticleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/tokens/create', function () {
    $user = User::find(1);
    $token = $user->createToken("test");

    echo $token->plainTextToken;
});


Route::get('/articles', [ArticleController::class, 'allArticles']);
Route::get('/articles/{article}', [ArticleController::class, 'getArticle']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/articles', [ArticleController::class, 'createArticle']);
    Route::put('/articles/{article}', [ArticleController::class, 'updateArticle']);
    Route::delete('/articles/{article}', [ArticleController::class, 'deleteArticle']);
});

Route::get('/create', function () {

    User::forceCreate([

        'name' => 'john',
        'email' => 'john@gmail.com',
        'password' => Hash::make('abcd1234')

    ]);

    User::forceCreate([

        'name' => "jane",
        'email' => "jane@gmail.com",
        'password' => Hash::make('abcd1234')
    ]);
});
