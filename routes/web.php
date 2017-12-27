<?php

Route::get('/', 'IndexController@index');

Auth::routes();

Route::get('/dashboard', 'UserController@index')->name('dashboard');
Route::get('/user/{user}', 'UserController@single')->name('user');
Route::get('/settings', 'UserController@settings')->name('settings');

Route::get('/issues', 'IssueController@index')->name('issues');
Route::get('/issues/{issue}', 'IssueController@single')->name('issue_single');
Route::get('/issues/new/{type?}', 'IssueController@create')->name('new_issue');
Route::post('/issues/new', 'IssueController@createPost')->name('new_issue_post');
Route::get('/issues/{issue}/edit', 'IssueController@edit')->name('issue_edit');
Route::post('/issues/{issue}/edit', 'IssueController@editPost')->name('issue_edit_post');
Route::post('/issues/{issue}/toggleClose', 'IssueController@toggleClose')->name('issue_toggle_close');
