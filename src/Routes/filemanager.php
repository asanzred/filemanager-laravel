<?php

Route::get('show',        'FilemanagerController@getShow')->name('filemanager.show');
Route::get('connectors',  'FilemanagerController@getConnectors')->name('filemanager.get.connector');
Route::post('connectors', 'FilemanagerController@postConnectors')->name('filemanager.post.connector');
Route::fallback(          'FilemanagerController@getStatics')->name('filemanager.get.statics');
