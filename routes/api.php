<?php

use App\Http\Controllers\Api\Genral\GenralContrller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Api\ApiController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Users\UsersController;
use Illuminate\Http\Request;

Route::get('/chart/comments_chart',             [ApiController::class, 'comments_chart']);
Route::get('/chart/users_chart',                [ApiController::class, 'users_chart']);



//////////// Start Api ////////////////
Route::get('/all_posts',                        [GenralContrller::class, 'get_posts']);
Route::get('/post/{slug}',                      [GenralContrller::class, 'show_post']);
Route::post('/post/{slug}',                     [GenralContrller::class, 'store_comment']);
Route::get('/search',                           [GenralContrller::class, 'search']);
Route::get('/category/{category_slug}',         [GenralContrller::class, 'category']);
Route::get('/tag/{tag_slug}',                   [GenralContrller::class, 'tag']);
Route::get('/archive/{date}',                   [GenralContrller::class, 'archive']);
Route::get('/author/{username}',                [GenralContrller::class, 'author']);
Route::post('/contact-us',                      [GenralContrller::class, 'do_contact']);


Route::post('register',                         [AuthController::class, 'register']);
Route::post('login',                            [AuthController::class, 'login']);
Route::post('refresh_token',                    [AuthController::class, 'refresh_token']);


Route::group(['middleware' => ['auth:api']] , function(){

    Route::any('/notifications/get',            [UsersController::class, 'getNotifications']);
    Route::any('/notifications/read',           [UsersController::class, 'markAsRead']);

    Route::get('/user_information',             [UsersController::class, 'user_information']);
    Route::patch('/edit_user_information',      [UsersController::class, 'update_user_information']);
    Route::patch('/edit_user_password',         [UsersController::class, 'update_user_password']);


    Route::get('/my_posts',                     [UsersController::class, 'my_posts']);
    Route::get('/my_posts/create',              [UsersController::class, 'create_post']);
    Route::post('/my_posts/create',             [UsersController::class, 'store_post']);
    Route::get('/my_posts/{post}/edit',         [UsersController::class, 'edit_post']);
    Route::patch('/my_posts/{post}/edit',       [UsersController::class, 'update_post']);
    Route::delete('/my_posts/{post}',           [UsersController::class, 'delete_post']);
    Route::post('/delete_post_media/{media_id}',[UsersController::class, 'delete_post_media']);


    Route::get('all_comments',                  [UsersController::class, 'all_comments']);
    Route::get('/comments/{id}/edit',           [UsersController::class, 'edit_comment']);
    Route::patch('/comments/{id}/edit',         [UsersController::class, 'update_comment']);
    Route::delete('/comments/{id}',             [UsersController::class, 'delete_comment']);

    Route::post('logout' ,                      [UsersController::class, 'logout']);


});



