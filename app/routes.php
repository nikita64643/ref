<?php
//добавить содержимое в свой файл

	

	post('/ref', 'RefController@Ref');
	
Route::group(['middleware' => 'auth'], function () {
	

	
	get('/ref', ['as' => 'ref.index', 'uses' => 'RefController@Ref']);

	
});



