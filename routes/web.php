<?php

Route::get('/', 'IndexController@index');

Auth::routes();

Route::get('/dashboard', 'UserController@index')->name('dashboard');
Route::get('/user/{user}', 'UserController@single')->name('user');

Route::get('/issues', 'IssueController@index')->name('issues');
Route::get('/issues/{issue}', 'IssueController@single')->name('issue_single');
Route::get('/issues/new/{type?}', 'IssueController@create')->name('new_issue');
Route::post('/issues/new', 'IssueController@createPost')->name('new_issue_post');
