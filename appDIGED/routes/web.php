<?php

//peticiones get
Route::get('/', 'Authentication\authController@index');

Route::get('/dashboard', 'content\dashboarController@dashboard')->name('dashboard');

Route::get('/createR', 'content\CreateRController@createR')->name('createR');

Route::get('/personalinf', 'content\PersonalInfController@personalinf')->name('personalinf');

Route::get('/viewRequest/{slug}', 'content\CreateRController@viewRequest')->name('viewRequest');
Route::get('/viewRequestM/{slug}', 'content\CreateRController@viewRequestM');

Route::get('/viewFile/{slug}', 'content\fileController@viewFile');
Route::get('/downloadFile/{slug}/{todos?}', 'content\fileController@downloadFile');
Route::get('/viewdFileDeal/{slug}', 'content\fileController@viewdFileDeal')->name('viewdFileDeal');

Route::get('/sendMail', 'Mail\MailController@sendMail');


//petisiones post
Route::post('login', 'Authentication\authController@loginWs')->name('login');
//Route::post('login', 'Authentication\authController@login')->name('login');
Route::post('logout', 'Authentication\authController@logout')->name('logout');

Route::post('saveRequest', 'content\CreateRController@saveRequest')->name('saveRequest');
Route::post('changeState', 'content\CreateRController@changeState')->name('changeState');

Route::post('loadFiles', 'content\fileController@loadFiles')->name('loadFiles');
Route::post('deleteFiles', 'content\fileController@deleteFiles')->name('deleteFiles');
Route::post('createDealFile', 'content\fileController@createDealFile')->name('createDealFile');

Route::post('updateinf', 'content\PersonalInfController@updateinf')->name('updateinf');
