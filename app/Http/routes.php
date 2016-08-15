<?php

Route::auth();

/**
 * Home page. Shows all posts
 */
Route::get('/', 'HomeController@index');

/**
 * Shows all posts of current user and gives ability to add new
 */
Route::get('/posts', 'PostController@index');

/**
 * Shows current post by id.
 */
Route::get('/posts/{post}', 'PostController@view');

/**
 * Adds new post.
 */
Route::post('/posts', 'PostController@add');

/**
 * Edit existing post.
 */
Route::put('/posts/{post}', 'PostController@edit');

/**
 * Deletes existing post by id.
 */
Route::delete('/posts/{post}', 'PostController@delete');

/**
 * Search post by title.
 */
Route::get('/search', 'PostController@search');

/**
 * Adds new comment.
 */
Route::post('/comments', 'CommentController@add');

/**
 * Deletes existsing comment by id.
 */
Route::delete('/comments/{comment}', 'CommentController@delete');

/**
 * Edit user profile settings.
 */
Route::put('/settings', 'ProfileController@edit');
Route::get('/settings', 'ProfileController@edit');
